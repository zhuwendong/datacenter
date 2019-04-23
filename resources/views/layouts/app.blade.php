<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('datacenter/js/layui/css/layui.css') }}">
    <link rel="stylesheet" href="{{ asset('datacenter/css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('datacenter/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('datacenter/css/main.css') }}">
    <title>Document</title>
    @yield('header')
</head>
<body class="layui-layout-body">
	<div class="layui-layout layui-layout-admin">
		<div style='' class='row clearfix basic-desktop-container'>
			<!-- 头部导航栏 -->
			<div class='topbar-box default-style-color col-lg-12'>
	            <div class='menu-btn'>
	                <span class='icon-menu'></span>
	                    <!-- <ul class='menu-child-list hide'>
	                        {foreach name="systemModel" item="vo"}
	                        <li><a href="{$vo.sd_url}">{$vo.sd_name}</a></li>
	                        {/foreach}
	                    </ul>     -->
	            </div>
	            <div class='topbar col-lg-12 clearfix'>
	                <div style='' class='pull-left'>
	                    <h3 style='margin-left:70px;font-size:24px;color:#f5f5f5'>欢迎来到数据中心系统</h3>
	                </div>
	                <div class='pull-right '>
	                    <div class='user-box'>
	                        <a href="{$Think.config.sso_config.base_url}/home/index/usermodify" style="color:#fff;">
	                            <span class='icon-user'></span>
	                        </a>
	                        <a href="{$Think.config.sso_config.base_url}/admin/index/index" style="color:#fff;">
	                            <span class='welcome'>欢迎您，admin</span>
	                        </a>
	                    </div>
	                    <span class='c-line-1'>|</span>
	                    <div class='topbar-btn-list'>
	                        <span class='btn-item icon-email'></span>
	                        <span class='btn-item icon-question'></span>
	                        <span class='btn-item icon-skin'></span>
	                        <a href="{$logoutUrl}"><span id='login_out'  class='btn-item icon-close t'></span></a>
	                    </div>
	                </div>
	            </div>
	        </div>
			
			<!-- 左侧边栏 -->
	        <div class="layui-side layui-bg-gray">
		        <div class="layui-side-scroll">
		          <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
		          <ul class="layui-nav layui-nav-tree main-nav-tree"  lay-filter="test">
		            <li class="layui-nav-item">
		                <span class='icon icon-ksfx'></span>
		                <a class='c-link' data-url=''  href="javascript:void(0);">首页</a>
		                <dl class="layui-nav-child">
		                    <dd class=''><a class='c-link' data-url='12' href="{{ url('/') }}">首页</a></dd>
		                </dl>
		            </li>
		            <li class="layui-nav-item">
		                <span class='icon icon-ksfx'></span>
		                <a class='c-link' data-url=''  href="javascript:void(0);">数据基础分析</a>
		                <dl class="layui-nav-child">
		                    <dd class=''><a class='c-link' data-url='12' href="{{ url('stubase') }}">学生基础分析</a></dd>
		                    <dd><a class='c-link' data-url='as2212' href="{{ url('teacherbase') }}">教职工基础分析</a></dd>
		                    <dd><a class='c-link' data-url=asds77'' href="{{ url('teacherfee') }}">学生费用分析</a></dd>
		                    <dd><a class='c-link' data-url=asds77'' href="{{ url('zcbase') }}">资产基础分析</a></dd>
		                    <dd><a class='c-link' data-url=asds77'' href="{{ url('doombase') }}">宿舍基础分析</a></dd>
		                    <dd><a class='c-link' data-url=asds77'' href="{{ url('tsgbase') }}">图书馆基础分析</a></dd>
		                    <dd><a class='c-link' data-url=asds77'' href="{{ url('ykt') }}">一卡通消费分析</a></dd>
		                    <dd><a class='c-link' data-url=asds77'' href="{{ url('kq') }}">考勤出勤分析</a></dd>
		                    <dd><a class='c-link' data-url=asds77'' href="{{ url('teach') }}">教学成绩分析</a></dd>
		                </dl>
		            </li>
		              <li style='' class="layui-nav-item">
		                <span class='icon icon-setting'></span>
		                <a class='c-link' data-url='1' href="javascript:void(0);">预警信息</a>
		                <dl class="layui-nav-child">
		                    <dd class=''><a data-url='' href="{{ url('msg') }}">预警消息</a></dd>
		                    <dd><a data-url='2' href="{{ url('set') }}">预警设置</a></dd>
		                </dl>
		            </li>
		            <!-- <li style='' class="layui-nav-item">
		                    <span class='icon icon-setting'></span>
		                    <a class='c-link' data-url='1' href="javascript:void(0);">更多功能</a>
		                    <dl class="layui-nav-child">
		                        <dd class=''><a data-url='' href="javascript:void(0);">测试1</a></dd>
		                        <dd><a data-url='2' href="javascript:;">测试2</a></dd>
		                    </dl>
		                </li> -->
		          </ul>
		        </div>
		    </div>

		    <!-- 内容 -->
		    <div class="layui-body">
                @yield('body') 
		    </div>
		</div>
    </div>
	<!-- js -->
	<script src="{{ asset('datacenter/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('datacenter/js/layui/layui.all.js') }}"></script>
    <script src="{{ asset('datacenter/js/echarts.min.js') }}"></script>
    <script src="{{ asset('datacenter/js/china.js') }}"></script>
	<script src="{{ asset('datacenter/js/getCharts.js') }}"></script>
	@yield('footer')
    <script src="{{ asset('datacenter/js/main.js') }}"></script>
</body>
</html>