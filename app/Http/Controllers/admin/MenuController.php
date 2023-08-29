<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin\AdminMenu;
use App\tools\ReturnCode;
use App\tools\Tools;
use Illuminate\Http\Request;

class MenuController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $keywords = $this->request->get('keywords', '');
        $obj      = new AdminMenu();
        if ($keywords) {
            $obj = $obj->where('title', "like", "%{$keywords}%");
        }
        $list = $obj->orderBy('sort', 'ASC')->get()->toArray();
        if (!$keywords) {
            $list = Tools::listToTree($list);
        }

        return $this->buildSuccess([
            'list' => $list
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return array
     */
    public function create()
    {
        $postData = $this->request->post();
        if ($postData['url']) {
            $postData['url'] = 'admin/' . $postData['url'];
        }
        $res = AdminMenu::create($postData);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR);
        } else {
            return $this->buildSuccess();
        }
    }

    public function changeStatus(): array
    {
        $id     = $this->request->get('id');
        $status = $this->request->get('status');
        $res    = AdminMenu::update([
            'id'   => $id,
            'show' => $status
        ]);
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
        $postData = $this->request->post();
        if ($postData['url']) {
            $postData['url'] = 'admin/' . $postData['url'];
        }
        $res = AdminMenu::update($postData);
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
        (new AdminMenu())->whereIn('id', $id)->delete();

        return $this->buildSuccess();
    }
}
