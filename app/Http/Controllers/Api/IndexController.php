<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{

    //教室接口
    public function bclass(){
        $data = DB::table('classset')->get();
        $data = json_decode(json_encode($data), true);
        return response()->json(['status'=>200,'data'=>$data])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    //年级人数分布柱状图
    public function index(){
        return response()->json(['status'=>200,'data'=>[128, 25, 38, 24, 35, 26]])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        // $grade = DB::table('grade')->select('gd_id','gd_name')->get();
        // $grade = json_decode(json_encode($grade), true);
        // $sex = [];
        // foreach($grade as $key => $value){
        //     $map['gd_id'] = $value['gd_id'];
        //     $map['ad_sex'] = 1;
        //     $dt['sex1'] = DB::table('admin')->where($map)->count();
        //     $map['ad_sex'] = 2;
        //     $dt['sex2'] = DB::table('admin')->where($map)->count();
        //     $grade[$key]['sex'] = $dt;
        // }
        // return response()->json(['status'=>200,'data'=>$grade])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
    
    //科目教师数量柱状图
    public function subjectTeacher(){
        $results = DB::select('select `course`, `coursedetail`,count(`course`) as number from `bp_pk_coursedetail` group by `course` order by `course` asc');
        $results = json_decode(json_encode($results), true);
        return response()->json(['status'=>200,'data'=>$results])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    //各年级最近一场考试总分平均数柱状图
    public function avg(){
        $results = DB::table('grade')->get();
        $results = json_decode(json_encode($results), true);
        foreach($results as &$value){
            $exam = DB::table('exam')->where(['gd_id'=>$value['gd_id']])->pluck('id');
            $exam = json_decode(json_encode($exam), true);
            $avg = Db::table('score')->whereIn('exam_id',$exam)->avg('score');
            $value['avg'] = round($avg,2);
        }
        return response()->json(['status'=>200,'data'=>$results])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

}
