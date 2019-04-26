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
        <a href="/zcbase"><span class="tab-item on">总体统计</span></a>
        <a href="/zcbase1"><span class="tab-item">取得统计</span></a>
        <a href="/zcbase2"><span class="tab-item">处置统计</span></a>
        <a href="/zcbase3"><span class="tab-item">领用统计</span></a>
    </div>
    <hr/>
    <div style='margin:15px 0;' class='select-box'>
        <select id="tj" class='ipt ipt-xs' name="" id="">
            <option value="">基础统计</option>
            <option value="">资产价值统计</option>
        </select>
    </div>
    <div class='charts-container clearfix'>
        <div style='width:48%' class='charts-1 p-l'></div>
        <div style='width:48%' class='charts-2 p-l'></div>
    </div>
    <div class='charts-container clearfix'>
        <div style='width:48%' class='charts-3 p-l'></div>
        <div style='width:48%' class='charts-4 p-l'></div>
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
    Charts.getQpie({
        dom:".charts-1",
        h1:400,
        h2:375,
        title:"分类及金融占比",
        legend:['电器类','日常消耗品','办公用品类','电器类金额占比','日常消耗品金额占比','办公用品类金额占比'],
        data1:[
            {value:335, name:'电器类'},
            {value:310, name:'日常消耗品'},
            {value:234, name:'办公用品类'},
        ],
        data2:[{
            value: 5425,
            name: '电器类金额占比',
        },
        {
            value: 3100,
            name: '日常消耗品金额占比',
        }, {
            value: 1800,
            name: '办公用品类金额占比',
        }]
    });
    Charts.getPie({
        type:"3",
        dom:".charts-2",
        h1:400,
        h2:375,
        title:"取得方式占比",
        series_name:"取得方式占比",
        xDatas:['购买','受赠','其他'],
        data:[{
                value: 211,
                name: '购买',
                selected: true
            },
            {
                value: 56,
                name: '受赠',
                selected: true
            },
            {
                value: 222,
                name: '其他',
                selected: true
            }]
    })
    Charts.getPie({
        type:"2",
        dom:".charts-3",
        h1:400,
        h2:375,
        title:"处置方式占比",
        series_name:"处置方式占比",
        xDatas:['销毁','赠送','其他'],
        data:[{
                value: 211,
                name: '销毁',
                selected: true
            },
            {
                value: 56,
                name: '赠送',
                selected: true
            },
            {
                value: 222,
                name: '其他',
                selected: true
            }]
    })
    Charts.getQpie2({
        dom:".charts-4",
        h1:400,
        h2:375,
        title:"处置方式占比",
        legend:['','',''],
        series_name:"处置方式占比",
        xDatas:['销毁','赠送','其他'],
        data:[{
                value: 211,
                name: '销毁',
                selected: true
            },
            {
                value: 56,
                name: '赠送',
                selected: true
            },
            {
                value: 222,
                name: '其他',
                selected: true
            }]
    })
</script>
<script>
    $('#tj').change(function(){
        window.location.href="/zcbase4";
    })
</script>
@endsection