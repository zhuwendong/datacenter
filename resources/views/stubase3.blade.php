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
        <a href="/stubase2"><span class="tab-item">在校状态统计</span></a>
        <a href="/stubase3"><span class="tab-item on">调动统计</span></a>
    </div>
    <div class=''>
        <form>
        <label for="">校区：</label>
        <select class='ipt ipt-xs' name="campus" id="">
            <option value="">请选择</option>
            @foreach ($campus as $vo)
            <option value="{{ $vo->cp_id }}">{{ $vo->cp_name }}</option>
            @endforeach
        </select>
        <label for="">年级：</label>
        <select class='ipt ipt-xs' id="grade" name="grade" id="">
            <option value="">请选择</option>
            @foreach ($grade as $vo)
            <option value="{{ $vo->gd_id }}">{{ $vo->gd_name }}</option>
            @endforeach
        </select>
        <label for="">班级：</label>
        <select class='ipt ipt-xs' id="class" name="class" id="">
            <option value="">请选择</option>
            @foreach ($bclass as $vo)
            <option value="{{ $vo->cl_id }}">{{ $vo->cl_name }}</option>
            @endforeach
        </select>
        <button class="btn btn-info">查询</button>
        </form>
    </div>
    <div class='title-box'>
        <span class='icon-student'></span>
        <span>学生人数：</span>
        <span>{{ $count }}</span>
    </div>
    <div style='margin:15px 0;' class='select-box'>
        <select id="tj" class='ipt ipt-xs' name="" id="">
            <option value="">助学金统计</option>
            <option value="">勤工俭学统计</option>
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
    });
    $(".tab-box").on("click",".tab-item",function(){
        $(this).addClass("on").siblings(".tab-item").removeClass("on")
    })
    var Charts = new Charts();
    Charts.getBarPie({
        title:"助学金统计（总金额：80000.00元）",
        dom:".charts-1",
        h1:400,
        h2:370,
        barData:{
            xData:['一年级','二年级','三年级','四年级','五年级','六年级'],
            yData:[100, 152, 200,344,21,233,456],
            
        },
        pieData:{
            type:"1",
            xData:['一年级','二年级','三年级','四年级','五年级','六年级'],
            data:[{
                value: 100,
                name: '一年级',
                selected: true
            },
            {
                value: 152,
                name: '二年级',
                selected: true
            },
            {
                value: 200,
                name: '三年级',
                selected: true
            },{
                value: 200,
                name: '四年级',
                selected: true
            },{
                value: 200,
                name: '五年级',
                selected: true
            },{
                value: 120,
                name: '六年级',
                selected: true
            }]

        }
    })
    </script>
    <script>
        $('#tj').change(function(){
            window.location.href="/stubase5";
        })
    </script>
<script>
//ajax获取班级
$("select#grade").change(function(){
    var classs=document.getElementById('class');
    var id=$("#grade option:selected").val();
    $.ajax({
        url:"/getclass",
        data:{id:id},
        async:false,
        success:function(res) {
            $("#class").empty();
            classs.options.add(new Option("请选择",' '));
            $.each(res.data, function(i, item){
                classs.options.add(new Option(item.cl_name,item.cl_id)); 
            })
        }
    })
})
</script>
@endsection