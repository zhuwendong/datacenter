<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{
    //
    public function index(){
        $grade = DB::table('grade')->select('gd_id','gd_name')->get();
        $grade = json_decode(json_encode($grade), true);
        $sex1 = [];
        $sex2 = [];
        foreach($grade as $key => $value){
            $map['gd_id'] = $value['gd_id'];
            $map['ad_sex'] = 1;
            $count1 = DB::table('admin')->where($map)->count();
            $sex1[] = $count1; 
            $map['ad_sex'] = 2;
            $count2 = DB::table('admin')->where($map)->count();
            $sex2[] = $count2;
            // $grade[$key]['sex'] = $dt;
        }
        // var_dump($sex1);
        return view('index',['sex1'=>$sex1,'sex2'=>$sex2]);
    }

    public function stubase(){
        return view('stubase');
    }
    public function teacherbase(){
        return view('teacherbase');
    }
    public function teacherfee(){
        return view('teacherfee');
    }
    public function zcbase(){
        return view('zcbase');
    }
    public function doombase(){
        return view('doombase');
    }
    public function tsgbase(){
        return view('tsgbase');
    }
    public function ykt(){
        return view('ykt');
    }
    public function kq(){
        return view('kq');
    }
    public function teach(){
        return view('teach');
    }
    public function msg(){
        return view('msg');
    }
    public function set(){
        return view('set');
    }
}
