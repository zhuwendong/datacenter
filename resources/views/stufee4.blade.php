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
    <form>
    <div style="margin-top: 20px;padding-left: 10px;">
        <label for="">学年：</label>
        <select id="syear" class='ipt ipt-xs' name="year" id="">
            <option value="">请选择</option>
            @foreach ($year as $vo)
            <option @isset($_REQUEST["year"]) @if ($_REQUEST["year"] == $vo->sy_id) selected @endif @endisset value="{{ $vo->sy_id }}">{{ $vo->sy_name }}</option>
            @endforeach
        </select>
        <label for="">学期：</label>
        <select id="semester" class='ipt ipt-xs' name="semester" id="">
            <option value="">请选择</option>
            @foreach ($semesters as $vo)
            <option @isset($_REQUEST["semester"]) @if ($_REQUEST["semester"] == $vo->se_id) selected @endif @endisset value="{{ $vo->se_id }}">@if ($vo->se_cid == 1)第一学期 @else第二学期@endif</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-info">查询</button>
    </div>
    </form>
    <div class='title-box'>
        <span class='icon-student'></span>
        <span>学生人数：</span>
        <span>5000</span>
    </div>
    <div style='margin:15px 0;' class='select-box'>
        <select id="tj" class='ipt ipt-xs' name="" id="">
            <option value="">收费类型占比</option>
            <option value="">收费总计</option>
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
    Charts.getPBarPie({
        title:"收费类型占比",
        dom:".charts-1",
        h1:400,
        h2:380,
        type:"3",
        data1:{
            legend:['收费类型1','收费类型2','收费类型3'],
            xData:['机构1', '机构2', '机构3', '机构4', '机构5'],
            yData:[
                {
                    name: '收费类型1',
                    type: 'bar',
                    barWidth:20,
                    stack: '用户数',
                    data: [120, 132, 101, 134, 90]
                },
                {
                    name: '收费类型2',
                    type: 'bar',
                    barWidth:20,
                    stack: '用户数',
                    data: [220, 182, 191, 234, 290]
                },{
                    name: '收费类型3',
                    type: 'bar',
                    barWidth:20,
                    stack: '用户数',
                    data: [220, 453, 191, 122, 213]
                }
                
            ]
        },
        data2:{
            series_name:"年级",
            xData:['机构一','机构二','机构三','机构四','机构五'],
            data:[{
                value: 335,
                name: '机构一',
                selected: true
            },
            {
                value: 310,
                name: '机构二',
                selected: true
            }, {
                value: 280,
                name: '机构三',
                selected: true
            },{
                value: 280,
                name: '机构四',
                selected: true
            },{
                value: 280,
                name: '机构五',
                selected: true
            }]
        }
    })
</script>
<script>
    $('#tj').change(function(){
        window.location.href="/stufee";
    })
</script>
<script>
    //ajax获取学期
	$("select#syear").change(function(){
	    var semester=document.getElementById('semester');
        var id=$("#syear option:selected").val();
        $.ajax({
          url:"/getsemester",
          data:{id:id},
          async:false,
          success:function(res) {
			//  console.log(res.data);
            $("#semester").empty();
            semester.options.add(new Option("请选择",' '));
            $.each(res.data, function(i, item){     
            if(item.se_cid == 1){
                    // semester.append('<option value='"+item.se_id+"'>第一学期</option>');
                semester.options.add(new Option("第一学期",item.se_id)); 
                }else{
                    // semester.append('<option value='"+item.se_id+"'>第二学期</option>');
                semester.options.add(new Option("第二学期",item.se_id)); 
                }
            });
            console.log(semester);
          }
        }) 
	})
</script>
@endsection