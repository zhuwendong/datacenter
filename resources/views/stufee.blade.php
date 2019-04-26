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
        <a href="/stufee"><span class="tab-item on">基础统计</span></a>
        <a href="/stufee1"><span class="tab-item ">退补费统计</span></a>
        <a href="/stufee2"><span class="tab-item">欠费统计</span></a>
        <a href="/stufee3"><span class="tab-item">收费统计</span></a>
    </div>
    <div class=''>
        <label for="">学年：</label>
        <select class='ipt ipt-xs' name="" id="">
            <option value="">请选择</option>
        </select>
        <label for="">学期：</label>
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
            <option value="">收费总计</option>
            <option value="">收费类型占比</option>
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
    Charts.getPBar({
        title:"收费总计（金额：50000.00元）",
        dom:".charts-1",
        h1:400,
        h2:380,
        legend:['一年级', '二年级','三年级'],
        xData:['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
        data:[
                {
                    name: '一年级',
                    type: 'bar',
                    stack: '收费',
                    data: [120, 132, 101, 134, 90, 230, 210,455,211,124,331,156]
                },
                {
                    name: '二年级',
                    type: 'bar',
                    stack: '收费',
                    data: [220, 182, 191, 234, 290, 330, 310,552,121,521,321,121]
                },
                {
                    name: '三年级',
                    type: 'bar',
                    stack: '收费',
                    data: [220, 182, 191, 234, 290, 330, 310,211,344,122,211,122]
                }
                
            ]
    })
</script>
<script>
    $('#tj').change(function(){
        window.location.href="/stufee4";
    })
</script>
@endsection
