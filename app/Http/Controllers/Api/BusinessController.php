<?php

namespace App\Http\Controllers\Api;

use App\Models\Business;
use Illuminate\Http\Request;
use App\Http\Requests\BusinessRequest;
use Illuminate\Support\Facades\DB;

class BusinessController extends Controller
{
    // 添加
    /*
        type
        1 企业营业执照 
        2 企业三证合一 
        3 个体营业执照 
        4 个体三证合一
    */
    public function add(Request $request){
        Business::create($request->all());
        return $this->message('添加成功');
    }

    // 批量添加
    public function adds(Request $request){
        $arr = [
            [ "name" => "宝石花医疗健康投资控股集团有限公司", "license" => "91350200MA2Y2YLQ19", "type" => 2 ],
            [ "name" => "厦门安居集团有限公司", "license" => "913502000658928472", "type" => 2 ],
        ];
        DB::table('businesses')->insert($arr);
        return $this->message('批量添加成功');
    }


    // 获取 count数量的数据
    public function list(BusinessRequest $request){
        $count = $request->get('count');
        if ($count>20) 
            return  $this->failed('最多只能20个', 200);
        $count = $count ? $count : "1";
        $businesses = Business::inRandomOrder()->take($count)->get();
        return $this->success($businesses);
    }
}
