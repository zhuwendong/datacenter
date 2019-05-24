<?php
// $url = 'http://127.0.0.1:8004';
$url = 'http://47.96.171.165:8004';
return [

//    //单点登陆相关地址
    'sso' => [
        'jzg_name' =>'教职工管理系统',

        'host_url' =>$url,

        //'jzg_url' =>'http://47.96.171.165:8007',
        'jzg_url' =>'http://127.0.0.1:8007',

        //基础地址1
        'ssoBase' => 'http://47.96.171.165:8007/ssoCheck',
        // 'ssoBase' => 'http://127.0.0.1:8007/ssoCheck',

        //单点登陆地址

        'sso' => $url.'/sso/login/login.html?directurl=',

        //单点登陆信息验证
        'ssoCheck' => $url.'/sso/login/checktoken.html?token=',

        //单点登陆退出
        'ssoLogout' => $url.'/sso/login/ssologout.html'

    ],





    //数据接口地址
    'url' => [
        'apiKeyId' => 'mpa8wwq1zx2zx6sfjdsl',

        'homeUrl' => $url.'/',

        'centerUrl' => $url.'/home/member/index.html',

        //获取apitoken地址
        'apiTokenUrl' => $url.'/api/Schoolinfo/getApiToken',

        //用户pai
        'userUrl' => $url.'/api/user/userlist',


        //学年信息
        'school_year'=>$url.'/api/syear/getsyearinfo',

        //学期信息获取
        'termlist' => $url.'/api/semester/getSemesterList',

        //学科信息获取
        'subjectlist'=>$url.'/api/subject/subjectlist',

   
         //年级接口

        'gradelist' => $url.'/api/grade/gradelist',
        //班级信息获取
        'classlist' => $url.'/api/bclass/bclasslist',

        //角色获取
        'roleUrl' => $url.'/api/roles/allroles',

        //部门数据
        'deptUrl' => $url.'/api/orgniza/orgnizalist'

    ]


];
