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
        <label for="">校区：</label>
        <select class='ipt ipt-xs' name="" id="">
            <option value="">请选择</option>
        </select>
        <label for="">年级：</label>
        <select class='ipt ipt-xs' name="" id="">
            <option value="">请选择</option>
        </select>
        <label for="">班级：</label>
        <select class='ipt ipt-xs' name="" id="">
            <option value="">请选择</option>
        </select>
        <button class="btn btn-info">查询</button>
    </div>
    <div class='title-box'>
        <span class='icon-student'></span>
        <span>学生人数：</span>
        <span>5000</span>
    </div>
    <div style='margin:15px 0;' class='select-box'>
        <select id="tj" class='ipt ipt-xs' name="" id="">
            <option value="">违纪处分统计</option>
            <option value="">学籍状态统计</option>
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
    Charts.getBarTable({
        title:"违纪处分统计",
        dom:".charts-1",
        h1:720,
        h2:400,
        tableData:{
            head:["序号","姓名","年级","班级","处分原因"],
            data:[
                {
                    d1:['1','郝慧贵','三年级','二班','打架斗殴，严重违反校纪校规']
                },
                {
                    d1:['1','郝慧贵','三年级','二班','打架斗殴，严重违反校纪校规']
                },
                {
                    d1:['1','郝慧贵','三年级','二班','打架斗殴，严重违反校纪校规']
                },
            ]
        },
        barData:{
            xData:['一年级','二年级','三年级','四年级','五年级','六年级'],
            yData:{
                type:"bar",
                data:[0,1,2,3,1,6],
                barWidth:20
            }
        }

    })
</script>
<script>
    $('#tj').change(function(){
        window.location.href="/stubase2";
    })
</script>
@endsection