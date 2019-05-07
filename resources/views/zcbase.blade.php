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
    var data = new Array();
    var data1 = new Array();
    @foreach ($data as $value)
       data.push('{{ $value->name }}');
       data1.push({
            value: {{ $value->count }},
            name: '{{ $value->name }}',
        });
    @endforeach
    Charts.getQpie({
        dom:".charts-1",
        h1:400,
        h2:375,
        title:"分类及金融占比",
        legend:data,
        // data1:[
        //     {value:335, name:'电器类'},
        //     {value:310, name:'日常消耗品'},
        //     {value:234, name:'办公用品类'},
        // ],
        data2:data1
    });
    var data2 = new Array();
    var data3 = new Array();
    @foreach ($obtain as $value)
    data2.push('{{ $value->name }}');
    data3.push({
                value: {{ $value->count }},
                name: '{{ $value->name }}',
                selected: true
            });
    @endforeach
    Charts.getPie({
        type:"3",
        dom:".charts-2",
        h1:400,
        h2:375,
        title:"取得方式占比",
        series_name:"取得方式占比",
        xDatas:data2,
        data:data3
    })
    var data4 = new Array();
    var data5 = new Array();
    @foreach ($obtain as $value)
    data4.push('{{ $value->name }}');
    data5.push({
                value: {{ $value->count }},
                name: '{{ $value->name }}',
                selected: true
            });
    @endforeach
    Charts.getPie({
        type:"2",
        dom:".charts-3",
        h1:400,
        h2:375,
        title:"处置方式占比",
        series_name:"处置方式占比",
        xDatas:data4,
        data:data5
    })
    // Charts.getQpie2({
    //     dom:".charts-4",
    //     h1:400,
    //     h2:375,
    //     title:"处置方式占比",
    //     legend:['','',''],
    //     series_name:"处置方式占比",
    //     xDatas:data4,
    //     data:data5
    // })
</script>
<script>
    $('#tj').change(function(){
        window.location.href="/zcbase4";
    })
</script>
@endsection