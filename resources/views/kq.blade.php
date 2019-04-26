@extends('layouts.app')
@section('body')
<div style="padding: 15px;">
    <div class='route-box'>
        <span class='icon icon-position'></span>
        <span class='title'>当前位置：</span>
        <span>数据基础分析</span>
        <span>></span>
        <span><a href="">考勤出勤分析</a></span>
    </div>
    <div style="margin-top: 20px;padding-left: 10px;">
        <label for="">校区：</label>
        <select class='ipt ipt-xs' name="" id="">
            <option value="">请选择</option>
        </select>
        <label for="">日期：</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" id="test11" placeholder="请选择">
        </div>
        <label for="">--</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" id="test12" placeholder="请选择">
        </div>
        <button class="btn btn-info">查询</button>
    </div>
    <hr class="line">
    <div class='charts-container clearfix'>
        <div style='width:48%' class='charts-1 p-l'></div>
        <div style='width:48%' class='charts-2 p-l'></div>
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
        $(this).addClass("on").siblings(".tab-item").removeClass("on");
    })
    var Charts = new Charts();
    Charts.getPBar({
        title:"考勤出勤分析",
        dom:".charts-1",
        h1:400,
        h2:380,
        legend:['迟到', '正常','缺勤'],
        xData:['机构1','机构2','机构3','机构4','机构5'],
        data:[
            {
                name: '迟到',
                type: 'bar',
                stack: '总数',
                barWidth:'30',
                color: ['#c23432'],
                data: [120, 132,  230, 210,211,]
            },
            {
                name: '正常',
                type: 'bar',
                stack: '总数',
                barWidth:'30',
                color: ['#fcb448'],
                data: [234, 290, 310,552,121]
            },
            {
                name: '缺勤',
                type: 'bar',
                stack: '总数',
                barWidth:'30',
                color: ['#6ec694'],
                data: [ 290, 330, 310,122,122]
            }

        ]
    })
    Charts.getPie({
        type:"1",
        dom:".charts-2",
        title:"考勤出勤占比",
        height:400,
        color: ['#6ec694','#c23432','#fcb448'],
        data:[{
            value: 215,
            name: '缺勤',
            selected: true
        },
            {
                value: 310,
                name: '迟到',
                selected: true
            },{
                value: 110,
                name: '正常',
                selected: true
            }]
    })

    layui.use('laydate', function(){
        var laydate = layui.laydate;
            //执行一个laydate实例
            laydate.render({
                elem: '#test11',
                format: 'yyyy年MM月dd日'
            });
            laydate.render({
                elem: '#test12',
                format: 'yyyy年MM月dd日'
            });
    });
</script>
@endsection