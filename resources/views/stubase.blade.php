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
        <a href="/stubase"><span class="tab-item on">基础统计</span></a>
        <a href="/stubase1"><span class="tab-item">来源分析</span></a>
        <a href="/stubase2"><span class="tab-item">在校状态统计</span></a>
        <a href="/stubase3"><span class="tab-item">调动统计</span></a>
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
            @foreach ($class as $vo)
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
    <div class='charts-container clearfix'>
        <div style='width:54%' class='charts-1 p-l'></div>
        <div style='width:44%' class='charts-2 p-r'></div>
    </div>
    <div class='charts-container clearfix'>
        <div style='width:32%' class='charts-3 p-l'></div>
        <div style='width:32%' class='charts-4 p-l'></div>
        <div style='width:32%' class='charts-5 p-l'></div>
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
        $(this).addClass("on").siblings(".tab-item").removeClass("on")
    })
    var Charts = new Charts();
    var sex1 = new Array();
    var sex2 = new Array();
    @foreach ($sex1 as $vo)
        sex1.push({{ $vo }});
    @endforeach
    @foreach ($sex2 as $vo)
        sex2.push({{ $vo }});
    @endforeach
    Charts.getBar({
        dom:".charts-1",
        title:"人数性别分布",
        xData:['一年级', '二年级', '三年级', '四年级', '五年级','六年级'],
        legend:["男","女"],
        yData:[{
                name: '女',
                type: 'bar',
                data: sex1,
                barWidth:'20',     
            }, {
                name: '男',
                type: 'bar',
                data: sex2,
                barWidth:"20"
            },]
    })
    Charts.getPie({
        type:"1",
        dom:".charts-2",
        title:"户口性质",
        xData:['农业','非农业'],
        height:400,
        data:[{
                value: {{ $count1 }},
                name: '农业',
                selected: true
            },
            {
                value: {{$count2}},
                name: '非农业',
                selected: true
            }]
    })
    var jiguan = new Array();
    @foreach ($jiguan as $vo)
    jiguan.push({
                value: {{$vo->count}},
                name: '{{$vo->s_jiguan}}',
                selected: true
            },);
    @endforeach
    Charts.getPie({
        type:"2",
        dom:".charts-3",
        title:"学生民族分布",
        xData:[],
        data:jiguan
    })
    Charts.getPie({
        type:"3",
        dom:".charts-4",
        title:"年龄段分布",
        xDatas:[],
        data:[{
            value: 15,
            name: '11岁'
        }, {
            value: 12,
            name: '10岁'
        }, {
            value: 8,
            name: '9岁'
        }],
        // data2:[
        //     [{
        //         value: 6,
        //         name: '11岁'
        //     }, {
        //         value: 5,
        //         name: '10岁'
        //     }, {
        //         value: 8,
        //         name: '9岁'
        //     }],
        //     [{
        //         value: 12,
        //         name: '11岁'
        //     }, {
        //         value: 7,
        //         name: '10岁'
        //     }, {
        //         value: 8,
        //         name: '9岁'
        //     }],
        // ]
    })
    
    Charts.getBar({
        dom:".charts-5",
        title:"人数性别分布",
        xData:['群众', '少先队员', '团员', '党员'],
        yData:[{
                type: 'bar',
                data: [24, 25, 31, 34],
                barWidth:'20',     
            }]
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