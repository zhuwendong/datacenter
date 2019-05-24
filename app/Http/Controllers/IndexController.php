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
        var_dump($token);
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
        $year = DB::table('syear')->get();
        $orgniza = DB::table('orgniza')->get();
        View()->share('year',$year);
        View()->share('campus',$campuss);
        View()->share('grade',$grades);
        View()->share('bclass',$bclasss);
        View()->share('orgniza',$orgniza);
        View()->share('url','http://39.98.42.52:7082');
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
        //借书类型及数量折线图
        $borrow = $this->getHttpResult("http://39.98.42.52:7082/OPAC.ashx?op=getSubjectCategoryStatistics");

        //教师/学生籍贯分布
        $jiguan = DB::select('select count(*) as count,s_jiguan from bp_sxd_student_info group by s_jiguan');
        
        //一卡通近7日消费额
        $ykt_time = [date('m/d'),date('m/d',strtotime('-1 day')),date('m/d',strtotime('-2 day')),date('m/d',strtotime('-3 day')),date('m/d',strtotime('-4 day')),date('m/d',strtotime('-5 day')),date('m/d',strtotime('-6 day'))];
        $ykt_time = array_reverse($ykt_time);

        //分类及金融占比
        $data = DB::select('select * from bp_assets_classify where pid =0');
        foreach($data as &$value){
            $classify = DB::table('assets_classify')->where(['pid'=>$value->id])->pluck('id');
            $classify = json_decode(json_encode($classify), true);
            // var_dump($classify);
            $pluck = DB::table('assets')->whereIn('assets_classify_id',$classify)->count();
            $value->count = $pluck;
        }

        //考勤时间段及打卡人数柱状图

        //今日考勤时间段及打卡人数柱状图

        
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
        return view('index',['sex1'=>$sex1,'sex2'=>$sex2,'teacher'=>$teacher,'results'=>$results,'jiguan'=>$jiguan,'ykt_time'=>$ykt_time,'data'=>$data,'borrow'=>$borrow['list']]);
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
    public function stubase2(request $request){
        $data = DB::select('select count(*) as count,s_xuejizhuangtai from bp_sxd_student_info group by s_xuejizhuangtai');
        foreach($data as &$value){
            if($value->s_xuejizhuangtai == 1){
                $value->name = '未毕业';
            }else{
                $value->name = '已毕业';
            }
        }
        $count  = DB::table('admin')->where([
            ['ad_status','=',1],
            ['rs_id','=',3]
        ])->count();
        return view('stubase2',['data'=>$data,'count'=>$count]);
    }

    public function stubase4(){
        $data = DB::table('grade')->get();
        foreach($data as &$value){
            $ad_num = DB::table('admin')->where(['gd_id'=>$value->gd_id])->pluck('ad_num');
            $value->count = DB::table('sxd_reward')->whereIn('xuehao',$ad_num)->count();
        }
        $count  = DB::table('admin')->where([
            ['ad_status','=',1],
            ['rs_id','=',3]
        ])->count();
        return view('stubase4',['data'=>$data,'count'=>$count]);
    }

    public function stubase3(Request $request){
        $count  = DB::table('admin')->where([
            ['ad_status','=',1],
            ['rs_id','=',3]
        ])->count();
        return view('stubase3',['count'=>$count]);
    }
    
    public function stubase5(){
        $count  = DB::table('admin')->where([
            ['ad_status','=',1],
            ['rs_id','=',3]
        ])->count();
        return view('stubase5',['count'=>$count]);
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
    public function stufee(Request $request){
        $years = $request->get('year');
        $semesters = DB::table('semester')->where(['sy_id'=>$years])->get();
        return view('stufee',['semesters'=>$semesters]);
    }
    public function stufee1(Request $request){
        $years = $request->get('year');
        $semesters = DB::table('semester')->where(['sy_id'=>$years])->get();
        return view('stufee1',['semesters'=>$semesters]);
    }
    public function stufee2(Request $request){
        $years = $request->get('year');
        $semesters = DB::table('semester')->where(['sy_id'=>$years])->get();
        return view('stufee2',['semesters'=>$semesters]);
    }
    public function stufee3(Request $request){
        $years = $request->get('year');
        $semesters = DB::table('semester')->where(['sy_id'=>$years])->get();
        return view('stufee3',['semesters'=>$semesters]);
    }
    public function stufee4(Request $request){
        $years = $request->get('year');
        $semesters = DB::table('semester')->where(['sy_id'=>$years])->get();
        return view('stufee4',['semesters'=>$semesters]);
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
    public function tsgbase(request $request){

        $years = $request->get('year');
        $semesters = DB::table('semester')->where(['sy_id'=>$years])->get();
        $time1 = '';
        $time2 = '';
        if(isset($years) && !empty($years)){
            $time = DB::table('syear')->where(['sy_id'=>$years])->first();
            $time1 = date('Y-m-d',$time->sy_stime);
            $time2 = date('Y-m-d',$time->sy_etime);
        }

        $semester = $request->get('semester');
        if(isset($semester) && !empty($semester)){
            $time =  DB::table('semester')->where(['se_id'=>$semester])->first();
            $time1 = date('Y-m-d',$time->se_stime);
            $time2 = date('Y-m-d',$time->se_etime);
        }
        return view('tsgbase',['semesters'=>$semesters,'time1'=>$time1,'time2'=>$time2]);
    }
    public function tsgbase1(Request $request){
        $years = $request->get('year');
        $semesters = DB::table('semester')->where(['sy_id'=>$years])->get();
        $time1 = '';
        $time2 = '';
        if(isset($years) && !empty($years)){
            $time = DB::table('syear')->where(['sy_id'=>$years])->first();
            $time1 = date('Y-m-d',$time->sy_stime);
            $time2 = date('Y-m-d',$time->sy_etime);
        }

        $semester = $request->get('semester');
        if(isset($semester) && !empty($semester)){
            $time =  DB::table('semester')->where(['se_id'=>$semester])->first();
            $time1 = date('Y-m-d',$time->se_stime);
            $time2 = date('Y-m-d',$time->se_etime);
        }
        return view('tsgbase1',['semesters'=>$semesters,'time1'=>$time1,'time2'=>$time2]);
    }
    public function tsgbase2(Request $request){
        $years = $request->get('year');
        $semesters = DB::table('semester')->where(['sy_id'=>$years])->get();
        $time1 = '';
        $time2 = '';
        if(isset($years) && !empty($years)){
            $time = DB::table('syear')->where(['sy_id'=>$years])->first();
            $time1 = date('Y-m-d',$time->sy_stime);
            $time2 = date('Y-m-d',$time->sy_etime);
        }

        $semester = $request->get('semester');
        if(isset($semester) && !empty($semester)){
            $time =  DB::table('semester')->where(['se_id'=>$semester])->first();
            $time1 = date('Y-m-d',$time->se_stime);
            $time2 = date('Y-m-d',$time->se_etime);
        }
        return view('tsgbase2',['semesters'=>$semesters,'time1'=>$time1,'time2'=>$time2]);
    }
    public function tsgbase3(Request $request){
        $years = $request->get('year');
        $semesters = DB::table('semester')->where(['sy_id'=>$years])->get();
        $time1 = '';
        $time2 = '';
        if(isset($years) && !empty($years)){
            $time = DB::table('syear')->where(['sy_id'=>$years])->first();
            $time1 = date('Y-m-d',$time->sy_stime);
            $time2 = date('Y-m-d',$time->sy_etime);
        }

        $semester = $request->get('semester');
        if(isset($semester) && !empty($semester)){
            $time =  DB::table('semester')->where(['se_id'=>$semester])->first();
            $time1 = date('Y-m-d',$time->se_stime);
            $time2 = date('Y-m-d',$time->se_etime);
        }
        return view('tsgbase3',['semesters'=>$semesters,'time1'=>$time1,'time2'=>$time2]);
    }
    public function ykt(Request $request){
        $time1 = $request->get('time1');
        $time2 = $request->get('time2');
        if(empty($time1) || empty($time2)){
            $time1 = date('Y-m-d',strtotime('-7 day'));
            $time2 = date('Y-m-d');
        }
        $time11 = date('Y/m/d',strtotime($time1));
        $time22 = date('Y/m/d',strtotime($time2));
        $data = $this->getHttpResult("http://39.98.42.52:7083/getInfo.ashx?str={'cmd':'getkx_cw_liushui','pageSize':'10'}",$method = 'GET');
        
        $data1 = $this->getHttpResult("http://39.98.42.52:7083/getInfo.ashx?str={'cmd':'getCardTypeConsumStatistics'}",$method = 'GET');
        
        $data2 = $this->getHttpResult("http://39.98.42.52:7083/getInfo.ashx?str={'cmd':'getRoleConsumStatistics'}",$method = 'GET');
        return view('ykt',['time1'=>$time1,'time2'=>$time2,'time11'=>$time11,'time22'=>$time22,'data'=>$data,'data1'=>$data1,'data2'=>$data2]);
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
        $data = DB::table('setting_msg')->paginate(5);
        return view('msg',['data'=>$data]);
    }
    public function set(){
        $data = DB::table('setting')->paginate(5);
        foreach($data as &$value){
            $value->time = date('Y-m-d H:i:s',$value->add_time);
        }
        return view('set',['data'=>$data]);
    }

    public function addset(Request $request){
        $rq = $request->all();
        $rq['add_time'] = time();
        $res = DB::table('setting')->insert($rq);
        if($res){
            
        }
    }

    public function deleteset(Request $request){
        $id = $request->get('id');
        $res = DB::table('setting')->where('id','=',$id)->delete();
       
    }

    public function editset(Request $request){
        $id = $request->get('id');
        $data = DB::table('setting')->where('id','=',$id)->first();
        
        return view('editset',['data'=>$data]);
    }

    public function updateset(Request $request){
        $rq = $request->all();
        $rq['add_time'] = time();
        $res = DB::table('setting')->where('id',$rq['id'])->update($rq);
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

    //根据年级获取班级
    public function getclass(request $request){
        $id = $request->get('id');
        $data = DB::table('bclass')->where(['gd_id'=>$id])->get();
        return response()->json(['status'=>200,'data'=>$data])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
