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
    <div style="margin-top: 20px;padding-left: 10px;">
        <label for="">校区：</label>
        <select class='ipt ipt-xs' name="" id="">
            <option value="">请选择</option>
        </select>
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
    Charts.getBar({
        dom:".charts-1",
        title:"教学成绩分析",
        xData:['期中考试', '期末考试', '月考', '周考','模拟考'],
        legend:['一年级','二年级','三年级','四年级'],

        yData:[{
            type: 'bar',
            name:"一年级",
            data: [24, 31, 21,32,44],
            barWidth:'20',
            color: ['#c23432'],
        },{
            type: 'bar',
            name:"二年级",
            data: [22, 11, 44,31,24],
            barWidth:'20',
            color: ['#d48161'],
        },{
            type: 'bar',
            name:"三年级",
            data: [20, 22,31,12,24],
            barWidth:'20',
            color: ['#90c6ae'],
        },{
            type: 'bar',
            name:"四年级",
            data: [44,78,52,44,66],
            barWidth:'20',
            color: ['#6c6f74'],
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
@endsection