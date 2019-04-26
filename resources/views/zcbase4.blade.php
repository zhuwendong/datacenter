@extends('layouts.app')
@section('body')
<div style="padding: 15px;">
    <div class='route-box'>
        <span class='icon icon-position'></span>
        <span class='title'>当前位置：</span>
        <span>数据基础分析</span>
        <span>></span>
        <span><a href="">总产基础分析</a></span>
    </div>   
    <div style='margin:20px 0' class='nav-tab-box-2'>
        <span class="tab-item on">总体统计</span>
        <span class="tab-item">取得统计</span>
        <span class="tab-item">处置统计</span>
        <span class="tab-item">领用统计</span>
    </div>
    <hr/>
    <div style='margin:15px 0;' class='select-box'>
        <select id="tj" class='ipt ipt-xs' name="" id="">
            <option value="">资产价值统计</option>
            <option value="">基础统计</option>
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
        $(this).addClass("on").siblings(".tab-item").removeClass("on");
    })

    var Charts = new Charts();
    Charts.getHandstandBar({
        dom: '.charts-1',
        title:"资产价值统计",
        xData:['分类1', '分类2', '分类3', '分类4', '分类5','分类6','分类7', '分类8', '分类9', '分类10', '分类11','分类12'],
        legend: ['bar', 'bar2'],
        color: ['#438AFD','#438AFD'],
        yData:[
                
                {
                    name: 'bar',
                    type: 'bar',
                    stack: 'one',
                    itemStyle: {
                        normal: {
                        },
                        emphasis: {
                            barBorderWidth: 1,
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowOffsetY: 0,
                            shadowColor: 'rgba(0,0,0,0.5)'
                        }
                    },
                    barWidth: '30',
                    data: [-52, -9, -18, -75, -54, -30, -18, -66, -54, -18, -50, -19]
                },{
                    name: 'bar2',
                    type: 'bar',
                    stack: 'one',
                    itemStyle: {
                        normal: {
                        },
                        emphasis: {
                            barBorderWidth: 1,
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowOffsetY: 0,
                            shadowColor: 'rgba(0,0,0,0.5)'
                        }
                    },
                    barWidth: '30',
                    data: [20, 28, 35, 30, 42, 15, 48, 36, 20, 32, 44, 44]
                },
            ]
    });
</script>
<script>
    $('#tj').change(function(){
        window.location.href="/zcbase";
    })
</script>
@endsection