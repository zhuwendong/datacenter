<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{
    public function index(){
        //年级人数分布柱状图
        $grade = DB::table('grade')->select('gd_id','gd_name')->get();
        $grade = json_decode(json_encode($grade), true);
        $sex = [];
        foreach($grade as $key => $value){
            $map['gd_id'] = $value['gd_id'];
            $map['ad_sex'] = 1;
            $dt['sex1'] = DB::table('admin')->where($map)->count();
            $map['ad_sex'] = 2;
            $dt['sex2'] = DB::table('admin')->where($map)->count();
            $grade[$key]['sex'] = $dt;
        }
        return response()->json(['status'=>200,'data'=>$grade])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
