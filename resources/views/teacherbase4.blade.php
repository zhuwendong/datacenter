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
        <a href="/teacherbase"><span class="tab-item">基础统计</span></a>
        <a href="/teacherbase1"><span class="tab-item on">来源分析</span></a>
        <a href="/teacherbase2"><span class="tab-item">在校状态统计</span></a>
        <a href="/teacherbase3"><span class="tab-item">调动统计</span></a>
    </div>
    <div class=''>
    <form>
    <label for="">校区：</label>
    <select class='ipt ipt-xs' name="campus" id="">
        <option value="">请选择</option>
        @foreach ($campus as $vo)
        <option @isset($_REQUEST["campus"]) @if ($_REQUEST["campus"] == $vo->cp_id) selected @endif @endisset value="{{ $vo->cp_id }}">{{ $vo->cp_name }}</option>
        @endforeach
    </select>
    <label for="">机构：</label>
    <select class='ipt ipt-xs' name="orgniza" id="">
        <option value="">请选择</option>
        @foreach($orgniza as $vo)
        <option @isset($_REQUEST["orgniza"]) @if ($_REQUEST["orgniza"] == $vo->og_id) selected @endif @endisset value="{{ $vo->og_id }}">{{ $vo->og_name }}</option>
        @endforeach
    </select>
    <button class="btn btn-info">查询</button>
    </form>
    </div>
    <div class='title-box'>
        <span class='icon-student'></span>
        <span>学生人数：</span>
        <span>5000</span>
    </div>
    <div style='margin:15px 0;' class='select-box'>
        <select id="tj" class='ipt ipt-xs' name="" id="">
            <option value="">教职工来源分析</option>
            <option value="">教职工籍贯统计</option>
        </select>
    </div>
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
    Charts.getBar({
        dom:".charts-1",
        hasTab:true,
        tab:['应届毕业生','往届毕业生','引进人才'],
        title:"教职工来源分析",
        xData:['大专', '本科', '硕士', '博士'],
        yData:[{
            type: 'bar',
            data: [222, 250, 310, 134],
            barWidth:'20',     
        }]
    })
    Charts.getPie({
        type:"1",
        dom:".charts-2",
        title:"教职工来源分析占比",
        xData:['往届毕业生','应届毕业生','引进人才'],
        height:400,
        data:[{
                value: 215,
                name: '往届毕业生',
                selected: true
            },
            {
                value: 310,
                name: '应届毕业生',
                selected: true
            },{
                value: 110,
                name: '引进人才',
                selected: true
            }]
    })
    
    </script>
    <script>
        $('#tj').change(function(){
            window.location.href="/teacherbase1";
        })
    </script>
@endsection