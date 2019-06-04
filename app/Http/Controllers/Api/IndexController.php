<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Admin as AdminModel;
class IndexController extends Controller
{

    //教室接口
    public function bclass(){
        $data = DB::table('classset')->get();
        $data = json_decode(json_encode($data), true);
        foreach($data as &$value){
            $value['cp_name'] = DB::table('campus')->where(['cp_id'=>$value['cp_id']])->value('cp_name');
            //(1:普通教室,2:多媒体教室,3:计算机教室,4:图书馆教室,5:会议室,6:科学实验室,7:仪器室,8:美术教室,9:音乐教室,10:体育室,11:其他
        
        }
        return response()->json(['status'=>200,'data'=>$data])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }


    //年级人数分布柱状图
    public function index(){
        $data = AdminModel::first();
        var_dump($data);
        // return response()->json(['status'=>200,'data'=>[128, 25, 38, 24, 35, 26]])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }


    //返回数据
    public function _return($str){
        return response()->json($str)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    

    //微信公众号绑定
    public function teacherbd(Request $request){
        $ad_num = $request->get('ad_num');
        $ad_pass = $request->get('ad_pass');
        $open_id = $request->get('open_id');
        $res = DB::table('admin')->where(['ad_num'=>$ad_num])->first();
        if($res){
            if(_md5($ad_pass) != $res->ad_pass){
                return $this->_return(['status'=>-200,'data'=>'密码错误']);
            }
            $r = DB::table('admin')->where(['ad_uid'=>$res->ad_uid])->update(['openid'=>$open_id]);
            if($r){
                return $this->_return(['status'=>200,'data'=>'保存成功']);
            }else{
                return $this->_return(['status'=>-200,'data'=>'保存失败']);
            }
        }else{
            return $this->_return(['status'=>-200,'data'=>'账号错误']);
        }
        
    }

    //家长绑定
    public function parentbd(Request $request){
        $ad_tel = $request->get('phone');
        $open_id = $request->get('open_id');
        $result = DB::table('admin')->where(['ad_tel'=>$ad_tel])->first();
        if($result){
            $r = DB::table('admin')->where(['ad_uid'=>$result->ad_uid])->update(['openid'=>$open_id]);
            if($r){
                return $this->_return(['status'=>200,'data'=>'保存成功']);
            }else{
                return $this->_return(['status'=>-200,'data'=>'保存失败']);
            }
        }else{
            return $this->_return(['status'=>-200,'data'=>'账号错误']);
        }
    }

    //账号信息
    public function account(Request $request){
        $open_id = $request->get('open_id');
        $result = DB::table('admin')->where(['openid'=>$open_id])->first();
        if($result){
            return $this->_return(['status'=>200,'data'=>$result]);
        }else{
            return $this->_return(['status'=>-200,'data'=>'查无数据']);
        }
    }

    //解绑
    public function unbd(request $request){
        $uid = $request->get('ad_uid');
        $result = DB::table('admin')->where(['ad_uid'=>$uid])->update(['openid'=>'']);
        if($result){
            return $this->_return(['status'=>200,'data'=>'解绑成功']);
        }else{
            return $this->_return(['status'=>-200,'data'=>'解绑成功']);
        }
    }
    
    //通知公告
    public function notice(){
        $data = DB::table('notice')->get();
        return $this->_return(['status'=>200,'data'=>$data]);
    }

    //学科
    public function subject(){
        $data = DB::table('subject')->get();
        return $this->_return(['status'=>200,'data'=>$data]);
    }

    //根据学科获取教师
    public function getTeacherBysub(request $request){
        $subject = $request->get('sub_name');
        $data = DB::table('jzg_subject_teacher')->where(['sub_name'=>$subject])->get();
        return $this->_return(['status'=>200,'data'=>$data]); 
    }

    //教师详情
    public function teachdetail(request $request){
        $id = $request->get('id');
        $data = DB::table('jzg_teach_experience')->where(['user_id'=>$id])->first();
        return $this->_return(['status'=>200,'data'=>$data]);
    }

    //收费列表
    public function chargeproject(){
        $data = DB::table('stu_charge_project')->get();
        return $this->_return(['status'=>200,'data'=>$data]);
    }

    //收费详情
    public function chargestardard(request $request){
        $id = $request->get('id');
        $map['id'] = $id;
        $data = DB::table('stu_standard')->where($map)->first();
        return $this->_return(['status'=>200,'data'=>$data]);
    }

    



    

}
