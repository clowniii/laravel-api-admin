<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin\AdminAuthGroupAccess;
use App\Models\Admin\AdminAuthGroup;
use App\Models\Admin\AdminAuthRule;
use App\Models\Admin\AdminMenu;
use App\tools\ReturnCode;
use App\tools\Tools;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthGroupController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $limit    = $this->request->get('size', config('laravelapi.limit_default'));
        $start    = $this->request->get('page', 1);
        $keywords = $this->request->get('keywords', '');
        $status   = $this->request->get('status', '');

        $obj = new AdminAuthGroup();
        if (strlen($status)) {
            $obj = $obj->where('status', $status);
        }
        if ($keywords) {
            $obj = $obj->where('name', "like", "%{$keywords}%");
        }

        $listObj = $obj->paginate($limit, ['*'], 'page', $start);

        return $this->buildSuccess([
            'list'  => $listObj->items(),
            'count' => $listObj->total()
        ]);
    }

    public function getGroups(): array
    {
        $listInfo = (new AdminAuthGroup())->where(['status' => 1])->orderBy('id', 'DESC')->select()->toArray();
        $count    = count($listInfo);

        return $this->buildSuccess([
            'list'  => $listInfo,
            'count' => $count
        ]);
    }

    public function getRuleList(): array
    {
        $groupId = $this->request->get('group_id', 0);
        $list    = (new AdminMenu())->orderBy('sort', 'ASC')->get()->toArray();
        $list    = Tools::listToTree($list);

        $rules = [];
        if ($groupId) {
            $rules = (new AdminAuthRule())->where(['group_id' => $groupId])->select()->toArray();
            $rules = array_column($rules, 'url');
        }
        $newList = $this->buildList($list, $rules);

        return $this->buildSuccess([
            'list' => $newList
        ]);
    }

    private function buildList($list, $rules): array
    {
        $newList = [];
        foreach ($list as $key => $value) {
            $newList[$key]['title'] = $value['title'];
            $newList[$key]['key']   = $value['url'];
            if (isset($value['children'])) {
                $newList[$key]['expand']   = true;
                $newList[$key]['children'] = $this->buildList($value['children'], $rules);
            } else {
                if (in_array($value['url'], $rules)) {
                    $newList[$key]['checked'] = true;
                }
            }
        }

        return $newList;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return array
     */
    public function create()
    {
        $res = AdminAuthGroup::create([
            'name'        => $this->request->post('name', ''),
            'description' => $this->request->post('description', '')
        ]);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR);
        }

        return $this->buildSuccess();
    }

    public function changeStatus(): array
    {
        $id     = $this->request->get('id');
        $status = $this->request->get('status');

        $res = $this->_changeStatus([
            'id'     => $id,
            'status' => $status
        ], (new AdminAuthGroup()));
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
    public function edit()
    {
        $res = (new AdminAuthGroup())->update([
            'id'          => $this->request->post('id', 0),
            'name'        => $this->request->post('name', ''),
            'description' => $this->request->post('description', '')
        ]);
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
    public function destroy()
    {
        $id = $this->request->get('id');
        if (!$id) {
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS, '缺少必要参数');
        }

        $listInfo = (new AdminAuthGroupAccess())->where('find_in_set("' . $id . '", `group_id`)')->select();
        if ($listInfo) {
            foreach ($listInfo as $value) {
                $oldGroupArr = explode(',', $value->group_id);
                $key         = array_search($id, $oldGroupArr);
                unset($oldGroupArr[$key]);
                $newData         = implode(',', $oldGroupArr);
                $value->group_id = $newData;
                $value->save();
            }
        }

        AdminAuthGroup::destroy($id);
        AdminAuthRule::destroy(['group_id' => $id]);

        return $this->buildSuccess();
    }

    public function delMember(): array
    {
        $gid = $this->request->get('gid', 0);
        $uid = $this->request->get('uid', 0);
        if (!$gid || !$uid) {
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS, '缺少必要参数');
        }
        $oldInfo     = (new AdminAuthGroupAccess())->where('uid', $uid)->first()->toArray();
        $oldGroupArr = explode(',', $oldInfo['group_id']);
        $key         = array_search($gid, $oldGroupArr);
        unset($oldGroupArr[$key]);
        $newData = implode(',', $oldGroupArr);
        $res     = AdminAuthGroupAccess::update([
            'group_id' => $newData
        ], [
            'uid' => $uid
        ]);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR);
        }

        return $this->buildSuccess();
    }

    public function editRule(): array
    {
        $id    = $this->request->post('id', 0);
        $rules = $this->request->post('rules', []);
        if (is_array($rules)) {
            $needAdd = [];
            $has     = (new AdminAuthRule())->where(['group_id' => $id])->select()->toArray();
            $hasRule = array_column($has, 'url');
            $needDel = array_flip($hasRule);
            foreach ($rules as $key => $value) {
                if (!empty($value)) {
                    if (!in_array($value, $hasRule)) {
                        $data['url']      = $value;
                        $data['group_id'] = $id;
                        $needAdd[]        = $data;
                    } else {
                        unset($needDel[$value]);
                    }
                }
            }
            if (count($needAdd)) {
                (new AdminAuthRule())->insert($needAdd);
            }
            if (count($needDel)) {
                $urlArr = array_keys($needDel);
                (new AdminAuthRule())->whereIn('url', $urlArr)->where('group_id', $id)->delete();
            }
        }

        return $this->buildSuccess();
    }
}
