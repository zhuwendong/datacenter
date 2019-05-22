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
        <a href="/stubase2"><span class="tab-item ">在校状态统计</span></a>
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
            <option value="">勤工俭学统计</option>
            <option value="">助学金统计</option>
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
    Charts.getBarLineTable({
        title:"勤工俭学统计（勤工俭学人数：500人）",
        dom:".charts-1",
        h1:720,
        h2:400,
        tableData:{
            head:["序号","年级","姓名","岗位","工资（元）"],
            data:[
                {
                    d1:['1','三年级','张吕一','图书管理员','200.00']
                },
                {
                    d1:['1','三年级','张吕一','图书管理员','200.00']
                },
                {
                    d1:['1','三年级','张吕一','图书管理员','200.00']
                },
            ]
        },
        barLineData:{
            xData:['一年级','二年级','三年级','四年级','五年级','六年级'],
            legend:['','',''],
            yData:[
                {
                    name:'人数',
                    type:'bar',
                    barWidth:30,
                    data:[20, 18, 17, 28, 25, 19]
                },
                {
                    name:'金额',
                    type:'line',
                    yAxisIndex: 1,
                    barWidth:30,
                    data:[4522, 4029, 7212, 2312, 1256, 7617]
                }
            ]
        }
    })
</script>

<script>
        $('#tj').change(function(){
            window.location.href="/stubase3";
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