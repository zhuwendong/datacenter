<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
class IndexController extends Controller
{
    public function __CONSTRUCT(){
        $ssoCheckUrl = config('api.sso.ssoCheck');
        $token = Cookie::get('token');
        $ssoData['token'] = $token;
        $data = $this->getHttpResult($ssoCheckUrl ,$method = 'POST', $ssoData);
        if($data['code'] == 1){
            $ssoOfData = $data['data'];
            Session::put('user_id', $ssoOfData['ad_uid']);
            $ad_name = $ssoOfData['ad_name'];
            
        }else{
            $ad_name = '';

        }
        View()->share('ad_name',$ad_name );
        $skin = DB::table('admin')->where(['ad_uid'=>session('user_id')])->value('skin');
        if(empty($skin)){
           $color = 'def';
        }else{
            if($skin == 1){
                $color = 'black';
            }else if($skin == 2){
                $color = 'red';
            }else if($skin == 3){
                $color = 'green';
            }else if($skin == 4){
                $color = 'blue';
            }else if($skin == 5){
                $color = 'pink';
            }
        }
        View()->share('color', $color); 
    }

    /**
     * 发送请求
     */
    public function getHttpResult($url, $method = 'GET', $data = [], $headers = array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // header 数据
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if( $method != 'GET' ){
            // post数据
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        $output = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($output, true);
        return $data;
    }

    
    //首页
    public function index(){
        //年级人数分布柱状图
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
        }

        //科目教师数量柱状图
        $teacher = DB::select('select `course`, `coursedetail`,count(`course`) as number from `bp_pk_coursedetail` group by `course` order by `course` asc');
        $teacher = json_decode(json_encode($teacher), true);

        //各年级最近一场考试总分平均数柱状图
        $results = DB::table('grade')->get();
        $results = json_decode(json_encode($results), true);
        foreach($results as &$value){
            $exam = DB::table('exam')->where(['gd_id'=>$value['gd_id']])->pluck('id');
            $exam = json_decode(json_encode($exam), true);
            $avg = Db::table('score')->whereIn('exam_id',$exam)->avg('score');
            $value['avg'] = round($avg,2);
        }
        return view('index',['sex1'=>$sex1,'sex2'=>$sex2,'teacher'=>$teacher,'results'=>$results]);
    }

    //学生基础分析
    public function stubase(){
        $campus = DB::table('campus')->get();
        $grade  = DB::table('grade')->get();
        $bclass = DB::table('bclass')->get();
        $count  = DB::table('admin')->where([
            ['ad_status','=',1],
            ['rs_id','=',3]
        ])->count();
        //人数性别分布
        $grades = DB::table('grade')->select('gd_id','gd_name')->get();
        $grades = json_decode(json_encode($grades), true);
        $sex1 = [];
        $sex2 = [];
        foreach($grades as $key => $value){
            $map['gd_id'] = $value['gd_id'];
            $map['ad_sex'] = 1;
            $count1 = DB::table('admin')->where($map)->count();
            $sex1[] = $count1; 
            $map['ad_sex'] = 2;
            $count2 = DB::table('admin')->where($map)->count();
            $sex2[] = $count2;
        }
        //户口性质
        $count1 = DB::table('sxd_student_info')->where('s_hukouleixin','=','农业')->count();
        $count2 = DB::table('sxd_student_info')->where('s_hukouleixin','<>','农业')->count();
        //学生民族分布
        $jiguan = DB::table('sxd_student_info')->groupBy('s_jiguan')->select('s_jiguan')->get();
        // $jiguan = json_decode(json_encode($jiguan), true);
        foreach($jiguan as &$value){
            // var_dump($value->s_jiguan);
            $value->count = DB::table('sxd_student_info')->where('s_jiguan',$value->s_jiguan)->count();
        }
        // var_dump($jiguan);

        //

        return view('stubase',['campus'=>$campus,'grade'=>$grade,'class'=>$bclass,
        'count1'=>$count1,'count2'=>$count2,'count'=>$count,'sex1'=>$sex1,'sex2'=>$sex2
        ,'jiguan'=>$jiguan]);
    }
    public function stubase1(Request $request){
        $campuss = DB::table('campus')->get();
        $grades = DB::table('grade')->get();
        $bclasss = DB::table('bclass')->get();
        $count  = DB::table('admin')->where([
            ['ad_status','=',1],
            ['rs_id','=',3]
        ])->count();
        
        //本校籍贯分布
        $map = [];
        $campus=$request->input('campus');
        $grade = $request->input('grade');
        $class = $request->input('class');
        if(isset($campus)){
            $map['cp_id'] = $campus;
        }
        if(isset($grade)){
            $map['gd_id'] = $grade;
        }
        if(isset($class)){
            $map['cl_id'] = $class;
        }
        // $jiguan = DB::table('sxd_student_info')->groupBy('s_jiguan')->select('s_jiguan')->get();
        $jiguan = DB::table('admin')
                  ->join('sxd_student_info','admin.ad_uid','=','sxd_student_info.ad_uid')
                  ->groupBy('s_jiguan')
                  ->where($map)
                  ->select('s_jiguan')
                  ->get();
        foreach($jiguan as &$value){
            $map['s_jiguan'] = $value->s_jiguan;
            $value->count = DB::table('admin')
            ->join('sxd_student_info','admin.ad_uid','=','sxd_student_info.ad_uid')
            ->groupBy('s_jiguan')
            ->where($map)
            ->select('s_jiguan')
            ->count();
        }
        return view('stubase1',['campus'=>$campuss,'grade'=>$grades,'class'=>$bclasss
        ,'count'=>$count,'jiguan'=>$jiguan]);
    }
    public function stubase2(){
        
        return view('stubase2');
    }
    public function stubase3(){
        
        return view('stubase3');
    }

    public function stubase4(){
        return view('stubase4');
    }
    public function stubase5(){
        return view('stubase5');
    }
    public function teacherbase(){
        return view('teacherbase');
    }
    public function teacherbase1(){
        return view('teacherbase1');
    }
    public function teacherbase2(){
        return view('teacherbase2');
    }
    public function teacherbase3(){
        return view('teacherbase3');
    }
    public function teacherbase4(){
        return view('teacherbase4');
    }
    public function stufee(){
        return view('stufee');
    }
    public function stufee1(){
        return view('stufee1');
    }
    public function stufee2(){
        return view('stufee2');
    }
    public function stufee3(){
        return view('stufee3');
    }
    public function stufee4(){
        return view('stufee4');
    }
    public function zcbase(){
        return view('zcbase');
    }
    public function zcbase1(){
        return view('zcbase1');
    }
    public function zcbase2(){
        return view('zcbase2');
    }
    public function zcbase3(){
        return view('zcbase3');
    }
    public function zcbase4(){
        return view('zcbase4');
    }
    public function doombase(){
        return view('doombase');
    }
    public function doombase1(){
        return view('doombase1');
    }
    public function doombase2(){
        return view('doombase2');
    }
    public function doombase3(){
        return view('doombase3');
    }
    public function tsgbase(){
        return view('tsgbase');
    }
    public function tsgbase1(){
        return view('tsgbase1');
    }
    public function tsgbase2(){
        return view('tsgbase2');
    }
    public function tsgbase3(){
        return view('tsgbase3');
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

    public function changeskin(Request $request){
        // $uid = session('user_id');
        $uid = session('user_id');
        $skin = $request->get('cvalue');
        $data['skin'] = $skin;
        DB::table('admin')->where(['ad_uid'=>$uid])->update($data);
    }
}
