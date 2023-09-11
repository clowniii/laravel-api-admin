<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\admin\BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Facades\Excel;

class Fish extends BaseController
{
    public function uploadExcel(Request $request)
    {
        // 获取上传的文件
        $file = $this->request->file('file');

        // 使用 Laravel Excel 读取 Excel 文件
        $excelData = Excel::toCollection(null, $file);

        $data = $excelData[0]->toArray();
        unset($data[0]);
        $insertData = [];

        foreach ($data as $row) {
            $insertData[] = ["username"=>$row[0],"nickname"=>$row[1],];
        }
        // 解析 Excel 数据并插入数据库
        $dataChunks = array_chunk($insertData, 10000); // 将数据拆分成每批 10000 条

        foreach ($dataChunks as $chunk) {
            DB::table("test")->insert(
                $chunk
            );
        }

        // 数据导入完成后，可以执行其他操作或返回响应
        return $this->buildSuccess();
    }
}
