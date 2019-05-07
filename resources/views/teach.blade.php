@extends('layouts.app')
@section('body')
<div style="padding: 15px;">
    <div class='route-box'>
        <span class='icon icon-position'></span>
        <span class='title'>当前位置：</span>
        <span>数据基础分析</span>
        <span>></span>
        <span><a href="">数据成绩分析</a></span>
    </div>
    <form>
    <div style="margin-top: 20px;padding-left: 10px;">
        <label for="">校区：</label>
        <select class='ipt ipt-xs' name="campus" id="">
            <option value="">请选择</option>
            @foreach ($campus as $vo)
                <option @isset($_REQUEST["campus"]) @if ($_REQUEST["campus"] == 1) selected @endif @endisset value="{{ $vo->cp_id }}">{{ $vo->cp_name }}</option>
            @endforeach
        </select>
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
    <hr class="line">
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
    var data = new Array();
    @foreach ($exam as $vo)
    data.push('{{ $vo->name }}');
    @endforeach
    
    var data1 = new Array();
    @foreach ($data1 as $vo)
    data1.push({{ $vo }});
    @endforeach

    var data2 = new Array();
    @foreach ($data2 as $vo)
    data2.push({{ $vo }});
    @endforeach

    var data3 = new Array();
    @foreach ($data3 as $vo)
    data3.push({{ $vo }});
    @endforeach

    var data4 = new Array();
    @foreach ($data4 as $vo)
    data4.push({{ $vo }});
    @endforeach

    var data5 = new Array();
    @foreach ($data5 as $vo)
    data5.push({{ $vo }});
    @endforeach

    var data6 = new Array();
    @foreach ($data6 as $vo)
    data6.push({{ $vo }});
    @endforeach
    Charts.getBar({
        dom:".charts-1",
        title:"教学成绩分析",
        xData:data,
        legend:['一年级','二年级','三年级','四年级','五年级','六年级'],

        yData:[{
            type: 'bar',
            name:"一年级",
            data: data1,
            barWidth:'20',
            color: ['#c23432'],
        },{
            type: 'bar',
            name:"二年级",
            data: data2,
            barWidth:'20',
            color: ['#d48161'],
        },{
            type: 'bar',
            name:"三年级",
            data: data3,
            barWidth:'20',
            color: ['#90c6ae'],
        },{
            type: 'bar',
            name:"四年级",
            data: data4,
            barWidth:'20',
            color: ['#6c6f74'],
        },{
            type: 'bar',
            name:"五年级",
            data: data5,
            barWidth:'20',
            color: ['#c23432'],
        },{
            type: 'bar',
            name:"六年级",
            data: data6,
            barWidth:'20',
            color: ['#d48161'],
        }]
    })

    function addItem(id) {
        layer.open({
            id: 'insert-form',
            type: 1, // 页面层
            title: '选择时间',
            maxmin: false,
            area: ['840px' , '460px'],
            scrollbar: false, //禁止浏览器滚动
            content: $('#layerContentId'),
            btn: ['保存', '取消'],
            btnAlign: 'c',
            end:function(){
                $("#layerContentId").hide();
            },
            yes: function(index, layero) {

            }
            /*,btn2: function(index, layero) {
            //按钮【按钮二】的回调
            }*/

            ,cancel: function(){
                //右上角关闭回调

                //return false 开启该代码可禁止点击该按钮关闭
            }
        });
    }
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