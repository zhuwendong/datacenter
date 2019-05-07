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
        
        //基础信息
        $campuss = DB::table('campus')->get();
        $grades = DB::table('grade')->get();
        $bclasss = DB::table('bclass')->get();
        View()->share('campus',$campuss);
        View()->share('grade',$grades);
        View()->share('bclass',$bclasss);
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
        //分类占比
        $data = DB::select('select * from bp_assets_classify where pid =0');
        foreach($data as &$value){
            $classify = DB::table('assets_classify')->where(['pid'=>$value->id])->pluck('id');
            $classify = json_decode(json_encode($classify), true);
            // var_dump($classify);
            $pluck = DB::table('assets')->whereIn('assets_classify_id',$classify)->count();
            $value->count = $pluck;
        }

        //取得方式占比
        $obtain = DB::table('obtain')->get();
        foreach($obtain as &$value){
            $count = DB::table('assets')->where(['obtain_id'=>$value->id])->count();
            $value->count = $count;
        }

        //处置方式
        $disposal = DB::table('disposal')->get();
        foreach($disposal as &$value){
            $count = DB::table('assets')->where(['disposal_id'=>$value->id])->count();
            $value->count = $count;
        }
        return view('zcbase',['data'=>$data,'obtain'=>$obtain,'disposal'=>$disposal]);
    }
    public function zcbase1(request $request){
        $obtain = DB::table('obtain')->get();
        foreach($obtain as &$value){
            $count = DB::table('assets')->where(['obtain_id'=>$value->id])->count();
            $value->count = $count;
        }
        
        $ob = $request->get('obtain');
        if(!isset($ob) && empty($ob)){
            $ob = DB::table('obtain')->value('id');
        }
        $map['obtain_id'] = $ob;
        $data = DB::select('select * from bp_assets_classify where pid =0');
        foreach($data as $value){
            $classify = DB::table('assets_classify')->where(['pid'=>$value->id])->pluck('id');
            $classify = json_decode(json_encode($classify), true);
            // var_dump($classify);
            $value->count = DB::table('assets')->where($map)->whereIn('assets_classify_id',$classify)->sum('money');
        }
        return view('zcbase1',['obtain'=>$obtain,'ob'=>$ob,'data'=>$data]);
    }
    public function zcbase2(request $request){
        //处置方式
        $disposal = DB::table('disposal')->get();
        $dp = $request->get('dp');
        if(!isset($dp) && empty($dp)){
            $dp = DB::table('disposal')->value('id');
        }
        $data = DB::select('select * from bp_assets_classify where pid =0');
        foreach($data as &$value){
            $classify = DB::table('assets_classify')->where(['pid'=>$value->id])->pluck('id');
            $classify = json_decode(json_encode($classify), true);
            // var_dump($classify);
            $value->count = DB::table('assets')->where(['disposal_id'=>$dp])->whereIn('assets_classify_id',$classify)->sum('money');
        }
        foreach($disposal as &$value){
            $value->count = DB::table('assets')->where(['disposal_id'=>$value->id])->count();
        }
        return view('zcbase2',['disposal'=>$disposal,'dp'=>$dp,'data'=>$data]);
    }
    public function zcbase3(){
        return view('zcbase3');
    }
    public function zcbase4(){
        //分类占比
        $data = DB::select('select * from bp_assets_classify where pid =0');
        foreach($data as &$value){
            $classify = DB::table('assets_classify')->where(['pid'=>$value->id])->pluck('id');
            $classify = json_decode(json_encode($classify), true);
            // var_dump($classify);
            $value->min = DB::table('assets')->whereIn('assets_classify_id',$classify)->min('money');
            $value->max = DB::table('assets')->whereIn('assets_classify_id',$classify)->max('money');
        }
        return view('zcbase4',['data'=>$data]);
    }
    public function doombase(request $request){
        
        $campus = $request->get('campus');
        if(isset($campus) && !empty($campus)){
            $map['cp_id'] = $campus;  
        }
        $grade = DB::table('grade')->get();
        foreach($grade as &$value){
            $map['gd_id'] = $value->gd_id;
            $map['ad_status'] = 1;
            $total = DB::table('admin')->where($map)->count();
            $value->doom = DB::table('dm_stay')->where(['grade_id'=>$value->gd_id])->count();
            $value->undoom = $total-$value->doom;
        }
        $where['ad_status'] = 1;
        $where['rs_id'] = 3;
        $con = [];
        if(isset($campus) && !empty($campus)){
            $where['cp_id'] = $campus;
            $con['campus_id'] = $campus;    
        }
        $total = DB::table('admin')->where($where)->count();
        $doom  = DB::table('dm_stay')->where($con)->count();
        // var_dump($doom);
        return view('doombase',['doom'=>$grade,'dooms'=>$doom,'undooms'=>$total-$doom]);
    }
    public function doombase1(){
        return view('doombase1');
    }
    public function doombase2(request $request){
        $build = DB::table('dm_build')->get();
        foreach($build as &$value){
            $map['build_id'] = $value->id;
            $value->count = DB::table('dm_stay')->where($map)->count();
        }
        $build_id = $request->get('id');
        if(!isset($build_id) || empty($build_id)){
            $build_id = DB::table('dm_build')->value('id');
        }
        $map['build_id'] = $build_id;
        $grade = DB::table('grade')->get();
        foreach($grade as &$value){
            $map['grade_id'] = $value->gd_id;
            $value->count = DB::table('dm_stay')->where($map)->count();
        }
        return view('doombase2',['build'=>$build,'build_id'=>$build_id,'grade'=>$grade]);
    }
    // public function doombase3(){
    //     return view('doombase3');
    // }
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
    public function kq(request $request){
        $orgniza = DB::table('orgniza')->get();
        
        return view('kq',['orgniza'=>$orgniza]);
    }
    public function teach(request $request){
        $year = DB::table('syear')->get();
        $years = $request->get('year');
        $semesters = DB::table('semester')->where(['sy_id'=>$years])->get();
        $exam = DB::table('exam')->get();
        // $grade = DB::table('grade')->get();
        // $grade = json_decode(json_encode($grade), true);
        $class1 = DB::table('bclass')->where(['gd_id'=>17])->pluck('cl_id');
        $data1 = [];
        foreach($exam as $value){
            $map['exam_id'] = $value->id;
            $data1[] = DB::table('score')->where($map)->whereIn('cl_id',$class1)->count();
        }

        $class2 = DB::table('bclass')->where(['gd_id'=>18])->pluck('cl_id');
        $data2 = [];
        foreach($exam as $value){
            $map['exam_id'] = $value->id;
            $data2[] = DB::table('score')->where($map)->whereIn('cl_id',$class2)->count();
        }

        $class3 = DB::table('bclass')->where(['gd_id'=>19])->pluck('cl_id');
        $data3 = [];
        foreach($exam as $value){
            $map['exam_id'] = $value->id;
            $data1[] = DB::table('score')->where($map)->whereIn('cl_id',$class3)->count();
        }

        $class4 = DB::table('bclass')->where(['gd_id'=>20])->pluck('cl_id');
        $data4 = [];
        foreach($exam as $value){
            $map['exam_id'] = $value->id;
            $data4[] = DB::table('score')->where($map)->whereIn('cl_id',$class4)->count();
        }

        $class5 = DB::table('bclass')->where(['gd_id'=>21])->pluck('cl_id');
        $data5 = [];
        foreach($exam as $value){
            $map['exam_id'] = $value->id;
            $data5[] = DB::table('score')->where($map)->whereIn('cl_id',$class5)->count();
        }

        $class6 = DB::table('bclass')->where(['gd_id'=>22])->pluck('cl_id');
        $data6 = [];
        foreach($exam as $value){
            $map['exam_id'] = $value->id;
            $data6[] = DB::table('score')->where($map)->whereIn('cl_id',$class6)->count();
        }
        return view('teach',['year'=>$year,'semesters'=>$semesters,'exam'=>$exam,'data1'=>$data1,
        'data2'=>$data2,'data3'=>$data3,'data4'=>$data4,'data5'=>$data5,'data6'=>$data6]);
    }
    public function msg(){
        return view('msg');
    }
    public function set(){
        return view('set');
    }

    //换肤
    public function changeskin(Request $request){
        // $uid = session('user_id');
        $uid = session('user_id');
        $skin = $request->get('cvalue');
        $data['skin'] = $skin;
        DB::table('admin')->where(['ad_uid'=>$uid])->update($data);
    }

    //根据学年获取学期
    public function getsemester(request $request){
        $id = $request->get('id');
        $data = DB::table('semester')->where(['sy_id'=>$id])->get();
        return response()->json(['status'=>200,'data'=>$data])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
