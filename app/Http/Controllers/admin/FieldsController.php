<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin\ApiFields;
use App\Models\Admin\ApiList;
use App\tools\DataType;
use App\tools\ReturnCode;
use App\tools\Tools;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FieldsController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->modelObj = new ApiFields();
    }

    private array $dataType = [
        DataType::TYPE_INTEGER => 'Integer',
        DataType::TYPE_STRING  => 'String',
        DataType::TYPE_BOOLEAN => 'Boolean',
        DataType::TYPE_ENUM    => 'Enum',
        DataType::TYPE_FLOAT   => 'Float',
        DataType::TYPE_FILE    => 'File',
        DataType::TYPE_MOBILE  => 'Mobile',
        DataType::TYPE_OBJECT  => 'Object',
        DataType::TYPE_ARRAY   => 'Array'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        return $this->buildSuccess($this->dataType);
    }

    public function request(): array
    {
        $limit = $this->request->get('size', config('laravelApi.limit_default'));
        $start = $this->request->get('page', 1);
        $hash  = $this->request->get('hash', '');

        if (empty($hash)) {
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS, '缺少必要参数');
        }
        $listObj = (new ApiFields())->where('hash', $hash)->where('type', 0)
            ->paginate($limit, ['*'], 'page', $start);

        $apiInfo = (new ApiList())->where('hash', $hash)->first();

        return $this->buildSuccess([
            'list'     => $listObj->items(),
            'count'    => $listObj->total(),
            'dataType' => $this->dataType,
            'apiInfo'  => $apiInfo
        ]);
    }

    public function response(): array
    {
        $limit = $this->request->get('size', config('laravelApi.limit_default'));
        $start = $this->request->get('page', 1);
        $hash  = $this->request->get('hash', '');

        if (empty($hash)) {
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS, '缺少必要参数');
        }
        $listObj = (new ApiFields())->where('hash', $hash)->where('type', 1)
            ->paginate($limit, ['*'], 'page', $start);

        $apiInfo = (new ApiList())->where('hash', $hash)->first();

        return $this->buildSuccess([
            'list'     => $listObj->items(),
            'count'    => $listObj->total(),
            'dataType' => $this->dataType,
            'apiInfo'  => $apiInfo->toArray()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return array
     */
    public function create(): array
    {
        $postData              = $this->request->post();
        $postData['show_name'] = $postData['field_name'];
        $postData['default']   = $postData['defaults'];
        unset($postData['defaults']);
        $postData = Tools::delEmptyKey($postData);
        $res = ApiFields::create($postData);


        $this->__deleteCacheOfRequestFields($postData['hash']);


        if ($res === false) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR);
        }

        return $this->buildSuccess();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return array
     */
    public function edit(): array
    {
        $postData              = $this->request->post();
        $postData['show_name'] = $postData['field_name'];
        $postData['default']   = $postData['defaults'];
        unset($postData['defaults']);
        unset($postData['isMust']);
        unset($postData['API_ADMIN_USER_INFO']);
        $res = (new ApiFields())->where("id",$postData["id"])->update($postData);


        $this->__deleteCacheOfRequestFields($postData['hash']);

        if ($res === false) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR);
        }

        return $this->buildSuccess();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @return array
     */
    public function destroy(): array
    {
        $id = $this->request->get('id');
        if (!$id) {
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS, '缺少必要参数');
        }

        $fieldsInfo = (new ApiFields())->where('id', $id)->first();


        $this->__deleteCacheOfRequestFields($fieldsInfo->hash);

        ApiFields::destroy($id);

        return $this->buildSuccess();
    }

    /**
     * 批量上传返回字段
     * @return array
     */
    public function upload(): array
    {
        $hash    = $this->request->post('hash');
        $type    = $this->request->post('type');
        $jsonStr = $this->request->post('jsonStr');
        $jsonStr = html_entity_decode($jsonStr);
        $data    = json_decode($jsonStr, true);
        if ($data === null) {
            return $this->buildFailed(ReturnCode::EXCEPTION, 'JSON数据格式有误');
        }
        ApiList::where(['hash' => $hash])->update(['return_str' => json_encode($data)] );
        $dataArr = [];
        $this->handle($data['data'], $dataArr);
        $old    = (new ApiFields())->where('hash', $hash)->where('type', $type)->select();
        $old    = Tools::buildArrFromObj($old);
        $oldArr = array_column($old, 'show_name');
        $newArr = array_column($dataArr, 'show_name');
        $addArr = array_diff($newArr, $oldArr);
        $delArr = array_diff($oldArr, $newArr);
        if ($delArr) {
            $delArr = array_values($delArr);
            (new ApiFields())->whereIn('show_name', $delArr)->delete();
        }
        if ($addArr) {
            $addData = [];
            foreach ($dataArr as $item) {
                if (in_array($item['show_name'], $addArr)) {
                    $addData[] = $item;
                }
            }
            (new ApiFields())->insert($addData);
        }

        $this->__deleteCacheOfRequestFields($hash);

        return $this->buildSuccess();
    }

    private function handle(array $data, &$dataArr, string $prefix = 'data', string $index = 'data'): void
    {
        if (!$this->isAssoc($data)) {
            $addArr    = [
                'field_name' => $index,
                'show_name'  => $prefix,
                'hash'       => $this->request->post('hash'),
                'is_must'    => 1,
                'data_type'  => DataType::TYPE_ARRAY,
                'type'       => $this->request->post('type')
            ];
            $dataArr[] = $addArr;
            $prefix    .= '[]';
            if (isset($data[0]) && is_array($data[0])) {
                $this->handle($data[0], $dataArr, $prefix);
            }
        } else {
            $addArr    = [
                'field_name' => $index,
                'show_name'  => $prefix,
                'hash'       => $this->request->post('hash'),
                'is_must'    => 1,
                'data_type'  => DataType::TYPE_OBJECT,
                'type'       => $this->request->post('type')
            ];
            $dataArr[] = $addArr;
            $prefix    .= '{}';
            foreach ($data as $index => $datum) {
                $myPre  = $prefix . $index;
                $addArr = array(
                    'field_name' => $index,
                    'show_name'  => $myPre,
                    'hash'       => $this->request->post('hash'),
                    'is_must'    => 1,
                    'data_type'  => DataType::TYPE_STRING,
                    'type'       => $this->request->post('type')
                );
                if (is_numeric($datum)) {
                    if (preg_match('/^\d*$/', $datum)) {
                        $addArr['data_type'] = DataType::TYPE_INTEGER;
                    } else {
                        $addArr['data_type'] = DataType::TYPE_FLOAT;
                    }
                    $dataArr[] = $addArr;
                } elseif (is_array($datum)) {
                    $this->handle($datum, $dataArr, $myPre, $index);
                } else {
                    $addArr['data_type'] = DataType::TYPE_STRING;
                    $dataArr[]           = $addArr;
                }
            }
        }
    }

    private function isAssoc(array $arr): bool
    {
        if (array() === $arr) {
            return false;
        }
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    protected function __deleteCacheOfRequestFields($hash): void
    {
        Cache::delete('RequestFields:NewRule:' . $hash);
        Cache::delete('RequestFields:Rule:' . $hash);
        Cache::delete('ResponseFieldsRule:' . $hash);
    }
}
