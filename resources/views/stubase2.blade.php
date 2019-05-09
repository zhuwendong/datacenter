@extends('layouts.app')
@section('body')
<div style="padding: 15px;">
            <div class='route-box'>
                <span class='icon icon-position'></span>
                <span class='title'>当前位置：</span>
                <span>数据基础分析</span>
                <span>></span>
                <span><a href="">学生基础分析</a></span>
            </div>   
            <div style='margin:20px 0' class='nav-tab-box-2'>
                <a href="/stubase"><span class="tab-item">基础统计</span></a>
                <a href="/stubase1"><span class="tab-item ">来源分析</span></a>
                <a href="/stubase2"><span class="tab-item on">在校状态统计</span></a>
                <a href="/stubase3"><span class="tab-item">调动统计</span></a>
            </div>
            <div class=''>
            <form>
                <label for="">校区：</label>
                <select class='ipt ipt-xs' name="campus" id="">
                    <option value="">请选择</option>
                    @foreach ($campus as $vo)
                    <option @isset($_REQUEST["campus"]) @if ($_REQUEST["campus"] == 1) selected @endif @endisset value="{{ $vo->cp_id }}">{{ $vo->cp_name }}</option>
                    @endforeach
                </select>
                <label for="">年级：</label>
                <select class='ipt ipt-xs' name="grade" id="">
                    <option value="">请选择</option>
                    @foreach ($grade as $vo)
                    <option @isset($_REQUEST["grade"]) @if ($_REQUEST["grade"] == $vo->gd_id) selected @endif @endisset value="{{ $vo->gd_id }}">{{ $vo->gd_name }}</option>
                    @endforeach
                </select>
                <label for="">班级：</label>
                <select class='ipt ipt-xs' name="class" id="">
                    <option value="">请选择</option>
                    @foreach ($bclass as $vo)
                    <option @isset($_REQUEST["class"]) @if ($_REQUEST["class"] == $vo->cl_id) selected @endif @endisset value="{{ $vo->cl_id }}">{{ $vo->cl_name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-info">查询</button>
            </form>
            </div>
            <div class='title-box'>
                <span class='icon-student'></span>
                <span>学生人数：</span>
                <span>5000</span>
            </div>
            <div style='margin:15px 0;' class='select-box'>
                <select id="tj" class='ipt ipt-xs' name="" id="">
                    <option value="">学籍状态统计</option>
                    <option  value="">违纪处分统计</option>
                </select>
            </div>
            <div class='charts-container clearfix'>
                <div style='width:100%' class='charts-1 p-l'></div>
            </div>
        </div>
@endsection
@section('footer')
<script>
    //JavaScript代码区域
    layui.use(['element','laypage'], function(){
      var element = layui.element;
      var laypage = layui.laypage;
      //执行一个laypage实例
      laypage.render({
        elem: 'c_page' //注意，这里的 test1 是 ID，不用加 # 号
        ,count: 50 //数据总数，从服务端得到
      });
    });
    $(".tab-box").on("click",".tab-item",function(){
        $(this).addClass("on").siblings(".tab-item").removeClass("on")
    })
    var Charts = new Charts();
    var data = new Array();
    var data1 = new Array();
    var data2 = new Array();
    @foreach ($data as $value)
    data.push('{{ $value->name }}');
    data1.push({{ $value->count }});
    data2.push({
                value: {{ $value->count }},
                name: '{{ $value->name }}',
                selected: true
            });
    @endforeach
    Charts.getBarPie({
        dom:".charts-1",
        title:"学籍状态统计",
        h1:400,
        h2:375,
        barData:{
            xData:data,
            yData:data1
        },
        pieData:{
            type:"1",
            xData:data,
            data:data2

        }
    })
    </script>
    <script>
        $('#tj').change(function(){
            window.location.href="/stubase4";
        })
    </script>
@endsection