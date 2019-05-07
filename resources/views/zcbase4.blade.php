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
        <a href="/zcbase"><span class="tab-item on">总体统计</span></a>
        <a href="/zcbase1"><span class="tab-item">取得统计</span></a>
        <a href="/zcbase2"><span class="tab-item">处置统计</span></a>
        <a href="/zcbase3"><span class="tab-item">领用统计</span></a>
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
    var data = new Array();
    var min  = new Array();
    var max  = new Array();
    @foreach ($data as $value)
    data.push('{{ $value->name }}');
    min.push({{ $value->min }});
    max.push({{ $value->max }});
    @endforeach
    Charts.getHandstandBar({
        dom: '.charts-1',
        title:"资产价值统计",
        xData:data,
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
                    data: min
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
                    data: max
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