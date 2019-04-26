@extends('layouts.app')
@section('body')
<div style="padding: 15px;">
    <div class='route-box'>
        <span class='icon icon-position'></span>
        <span class='title'>当前位置：</span>
        <span>数据基础分析</span>
        <span>></span>
        <span><a href="">教职工基础分析</a></span>
    </div>   
    <div style='margin:20px 0' class='nav-tab-box-2'>
        <a href="/teacherbase"><span class="tab-item on">基础统计</span></a>
        <a href="/teacherbase1"><span class="tab-item ">来源分析</span></a>
        <a href="/teacherbase2"><span class="tab-item">评价统计</span></a>
        <a href="/teacherbase3"><span class="tab-item">职业统计</span></a>
    </div>
    <div class=''>
        <label for="">校区：</label>
        <select class='ipt ipt-xs' name="" id="">
            <option value="">请选择</option>
        </select>
        <label for="">机构：</label>
        <select class='ipt ipt-xs' name="" id="">
            <option value="">请选择</option>
        </select>
        <button class="btn btn-info">查询</button>
    </div>
    <div class='title-box'>
        <span class='icon-student'></span>
        <span>教职工人数：</span>
        <span>5000</span>
    </div>
    <div style='margin:15px 0;' class='select-box'>
        <!-- <select class='ipt ipt-xs' name="" id="">
            <option value="">勤工俭学统计</option>
        </select> -->
    </div>
    <div class='charts-container clearfix'>
        <div style='width:100%' class='charts-1 p-l'></div>
    </div>
    <div class='charts-container clearfix'>
        <div style='width:32%' class='charts-2 p-l'></div>
        <div style='width:32%' class='charts-3 p-l'></div>
        <div style='width:32%' class='charts-4 p-l'></div>
    </div>
</div>
@endsection
@section('footer')
<script>
    //JavaScript代码区域
    layui.use(['element','laypage'], function(){
      var element = layui.element;
      var laypage = layui.laypage;
    });
    $(".tab-box").on("click",".tab-item",function(){
        $(this).addClass("on").siblings(".tab-item").removeClass("on")
    })
    var Charts = new Charts();
    Charts.getBarLine({
        dom:".charts-1",
        title:"年龄段分布",
        h1:400,
        h2:375,
        legend:['女生','男生','总人数'],
        xData:['20-25岁', '26-30岁', '31-35岁', '36-40岁','41-45岁','46-50岁','51-55岁'],
        yData:[{
            type: 'bar',
            name:"男生",
            data: [24, 25, 31, 34,21,32,44],
            barWidth:'20',     
        },{
            type: 'bar',
            name:"女生",
            data: [20, 22, 11, 44,31,12,24],
            barWidth:'20',     
        },{
            type: 'line',
            name:"总人数",
            data: [44, 47, 42,78,52,44,66],
            barWidth:'20',     
        }]
    })
    Charts.getPie({
        type:"2",
        dom:".charts-2",
        h1:400,
        h2:375,
        title:"教职工民族分布",
        xData:['汉族','回族','苗族','壮族','满族','维吾尔族'],
        data:[{
                value: 211,
                name: '汉族',
                selected: true
            },
            {
                value: 56,
                name: '回族',
                selected: true
            },
            {
                value: 222,
                name: '苗族',
                selected: true
            },
            {
                value: 156,
                name: '壮族',
                selected: true
            },
            {
                value: 54,
                name: '满族',
                selected: true
            },{
                value: 54,
                name: '维吾尔族',
                selected: true
            }]
    })
    Charts.getPie({
        type:"1",
        dom:".charts-3",
        h1:400,
        h2:375,
        title:"户口性质",
        xData:['农业','非农业'],
        height:400,
        data:[{
                value: 335,
                name: '农业',
                selected: true
            },
            {
                value: 310,
                name: '非农业',
                selected: true
            }]
    })
    Charts.getBar({
        dom:".charts-4",
        title:"政治面貌",
        h1:400,
        h2:375,
        xData:['群众', '少先队员', '团员', '党员'],
        yData:[{
                type: 'bar',
                data: [24, 25, 31, 34],
                barWidth:'20',     
            }]
    })
</script>
@endsection
