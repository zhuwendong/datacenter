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
	<link id="skin_change" rel="stylesheet" href="../css/skin_{{ $color }}.css">
	<style>
	.change-skin-box{
		box-sizing: border-box;
		padding:10px;
		position:absolute;
		width:320px;
		/*height:240px;*/
		background-color:#fff;
		z-index:999;
		right:10px;
		top:52px;
		overflow:auto;
	}
	.change-skin-box  .change-skin-item {
		position: relative;
		display:inline-block;
		width:120px;
		height:70px;
		border:1px solid #01a165;
		cursor: pointer;
		margin-bottom:10px;
		margin-left:10px;
	}
	.change-skin-box  .change-skin-item span{
		position: absolute;
		bottom:-40px;
		left:46px;
		color:#333;
	}
	.item-icon{
        height: 16px;
        width: 16px;
        /* background: url(../images/oa.png) no-repeat center; */
        background-size:100% 100%;
        display:inline-block;
        vertical-align: middle;
        margin-right: 6px;
    }
	</style>
    <title>Document</title>
    @yield('header')
</head>
<!-- {{ Request::path() }} -->
<body class="layui-layout-body">
	<div class="layui-layout layui-layout-admin">
		<div style='' class='row clearfix basic-desktop-container'>
			<!-- 头部导航栏 -->
			<div class='topbar-box default-style-color col-lg-12'>
	            <div class='menu-btn'>
	                <span class='icon-menu'></span>
	                <ul class='menu-child-list hide'>
                        @foreach($sonList as $k=>$v)
						<a href="{{$v['sd_url']}}"><li><span class="item-icon" style="background: url(/icon/{{$v['icon']}}) no-repeat center;"></span>{{$v['sd_name']}}</li></a>
                        @endforeach
                    </ul>
	            </div>
	            <div class='topbar col-lg-12 clearfix'>
	                <div style='' class='pull-left'>
	                    <h3 style='margin-left:70px;font-size:24px;color:#f5f5f5'>欢迎来到数据中心系统</h3>
	                </div>
	                <div class='pull-right '>
	                    <div class='user-box'>
	                        <a href="{{config('api.sso.host_url')}}/home/index/usermodify" style="color:#fff;">
	                            <span class='icon-user'></span>
	                        </a>
	                        <a href="{{config('api.sso.host_url')}}/admin/index/index" style="color:#fff;">
	                            <span class='welcome'>欢迎您，{{ $ad_name }}</span>
	                        </a>
	                    </div>
	                    <span class='c-line-1'>|</span>
	                    <div class='topbar-btn-list'>
	                        <span class='btn-item icon-email'></span>
	                        <span class='btn-item icon-question'></span>
	                        <span class='btn-item icon-skin'></span>
	                        <a href="{{config('api.sso.ssoLogout')}}"><span id='login_out'  class='btn-item icon-close t'></span></a>
						    <div class='change-skin-box hide'>
								<div sk="1" style='background-color:#1c2127;' class='change-skin-item' type="black">
									<!--<span class='icon-hook'></span>-->
									<span>商务黑</span>
								</div>
								<div sk="2" style='background-color:#d9181b;' class='change-skin-item' type="red">
									<!--<span class='icon-hook'></span>-->
									<span>中国红</span>
								</div>
								<div sk="3" style='background-color:#01a165;'  class='change-skin-item' type="green">
									<!--<span class='icon-hook'></span>-->
									<span>圣诞绿</span>
								</div>
								<div sk="4" style='background-color:#0b9ade;'  class='change-skin-item' type="blue">
									<!--<span class='icon-hook'></span>-->
									<span>科技蓝</span>
								</div>
								<div sk="5" style='background-color:#e45394;'  class='change-skin-item' type="pink">
									<!--<span class='icon-hook'></span>-->
									<span>花瓣粉</span>
								</div>
							</div>
						</div>
	                </div>
	            </div>
	        </div>
			
			<!-- 左侧边栏 -->
	        <div class="layui-side layui-bg-gray">
		        <div class="layui-side-scroll">
		          <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
		          <ul class="layui-nav layui-nav-tree main-nav-tree"  lay-filter="test">
				    @if (in_array(Request::path(), ['/']))
					    <li class="layui-nav-item layui-nav-itemed">
					@else
					    <li class="layui-nav-item">
					@endif
		                <span class='icon icon-ksfx'></span>
		                <a class='c-link' data-url=''  href="javascript:void(0);">首页</a>
		                <dl class="layui-nav-child">
						    @if (Request::path() == '/')
		                    <dd class='layui-this'>
							@else
							<dd class=''>
							@endif
							<a class='c-link' data-url='12' href="{{ url('/') }}">首页</a></dd>
		                </dl>
		            </li>
		            @if (in_array(Request::path(), ['stubase','stubase1','stubase2','stubase3','stubase4','stubase5','teacherbase',
					'teacherbase1','teacherbase2','teacherbase3','teacherbase4','stufee','stufee1','stufee2','stufee3','stufee4','zcbase','zcbase1','zcbase2','zcbase3','zcbase4','doombase','doombase1','doombase2','doombase3','tsgbase','tsgbase1','tsgbase2','tsgbase3','ykt','kq','teach']))
					    <li class="layui-nav-item layui-nav-itemed">
					@else
					    <li class="layui-nav-item">
					@endif
		                <span class='icon icon-ksfx'></span>
		                <a class='c-link' data-url=''  href="javascript:void(0);">数据基础分析</a>
		                <dl class="layui-nav-child">
						@if (in_array(Request::path(), ['stubase','stubase1','stubase2','stubase3','stubase4','stubase5']))
		                    <dd class='layui-this'>
							@else
							<dd class=''>
							@endif<a class='c-link' data-url='12' href="{{ url('stubase') }}">学生基础分析</a></dd>
		                    @if (in_array(Request::path(), ['teacherbase','teacherbase1','teacherbase2','teacherbase3','teacherbase4']))
		                    <dd class='layui-this'>
							@else
							<dd class=''>
							@endif<a class='c-link' data-url='as2212' href="{{ url('teacherbase') }}">教职工基础分析</a></dd>
		                    @if (in_array(Request::path(), ['stufee','stufee1','stufee2','stufee3','stufee4']))
		                    <dd class='layui-this'>
							@else
							<dd class=''>
							@endif<a class='c-link' data-url=asds77'' href="{{ url('stufee') }}">学生费用分析</a></dd>
		                    @if (in_array(Request::path(), ['zcbase','zcbase1','zcbase2','zcbase3','zcbase4',]))
		                    <dd class='layui-this'>
							@else
							<dd class=''>
							@endif<a class='c-link' data-url=asds77'' href="{{ url('zcbase') }}">资产基础分析</a></dd>
		                    @if (in_array(Request::path(), ['doombase','doombase1','doombase2','doombase3',]))
		                    <dd class='layui-this'>
							@else
							<dd class=''>
							@endif<a class='c-link' data-url=asds77'' href="{{ url('doombase') }}">宿舍基础分析</a></dd>
		                    @if (in_array(Request::path(), ['tsgbase','tsgbase1','tsgbase2','tsgbase3',]))
		                    <dd class='layui-this'>
							@else
							<dd class=''>
							@endif<a class='c-link' data-url=asds77'' href="{{ url('tsgbase') }}">图书馆基础分析</a></dd>
		                    @if (in_array(Request::path(), ['ykt']))
		                    <dd class='layui-this'>
							@else
							<dd class=''>
							@endif<a class='c-link' data-url=asds77'' href="{{ url('ykt') }}">一卡通消费分析</a></dd>
		                    @if (in_array(Request::path(), ['kq']))
		                    <dd class='layui-this'>
							@else
							<dd class=''>
							@endif<a class='c-link' data-url=asds77'' href="{{ url('kq') }}">考勤出勤分析</a></dd>
		                    @if (in_array(Request::path(), ['teach']))
		                    <dd class='layui-this'>
							@else
							<dd class=''>
							@endif<a class='c-link' data-url=asds77'' href="{{ url('teach') }}">教学成绩分析</a></dd>
		                </dl>
		            </li>
						@if (in_array(Request::path(), ['msg','set']))
							<li class="layui-nav-item layui-nav-itemed">
						@else
							<li class="layui-nav-item">
						@endif
		                <span class='icon icon-setting'></span>
		                <a class='c-link' data-url='1' href="javascript:void(0);">预警信息</a>
		                <dl class="layui-nav-child">
						@if (in_array(Request::path(), ['msg']))
		                    <dd class='layui-this'>
							@else
							<dd class=''>
							@endif<a data-url='' href="{{ url('msg') }}">预警消息</a></dd>
		                    @if (in_array(Request::path(), ['set']))
		                    <dd class='layui-this'>
							@else
							<dd class=''>
							@endif<a data-url='2' href="{{ url('set') }}">预警设置</a></dd>
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
	<script src="{{ asset('datacenter/js/jq_extend.js') }}"></script>
	@yield('footer')
    <script src="{{ asset('datacenter/js/main.js') }}"></script>
	<script>
	$('.menu-btn').hover(function(){
		// alert(1);
		$('.menu-child-list').removeClass('hide');
	},function(){
		$('.menu-child-list').addClass('hide');
	})
	// 换肤
	$(".icon-skin").on("click",function(event){
			$(".change-skin-box").removeClass("hide");
			document.body.style.overflow="hidden";
			var event=event||window.event;
			if(event&&event.stopPropagation){
				event.stopPropagation();
			}else{
				event.cancelBubble=true;
			}
		});
		$(".change-skin-box").on("mouseleave",function(){
			$(".change-skin-box").addClass("hide");
		});
		$('.change-skin-item').on('click', function(){
			var type = $(this).attr('type');
			console.log(type);
            var sk = $(this).attr('sk');
            $.ajax({
				url: '/changeskin',
				type: 'get',
				data: {cvalue: sk,_token:"{{csrf_token()}}"},
				dataType: "json",
				success: function(re){
					
				}
			})
			$("#skin_change").attr('href', '../css/skin_'+ type +'.css');
			$(".change-skin-box").addClass("hide");
		});

		$(".change-skin-box,.icon-triangle").on("click",function(e){
			e.stopPropagation();//阻止事件冒泡
		})
		
	</script>
</body>
</html>