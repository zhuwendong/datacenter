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
                <label for="">校区：</label>
                <select class='ipt ipt-xs' name="" id="">
                    <option value="">请选择</option>
                </select>
                <label for="">机构：</label>
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
                    <option value="">教职工籍贯统计</option>
                    <option value="">教职工来源分析</option>
                </select>
            </div>
            <div class='charts-container clearfix'>
                <div style='width:100%' class='charts-1 p-l'></div>
            </div>
            <div class='charts-container clearfix'>
                <div style='width:100%' class='charts-2 p-l'></div>
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
    Charts.getMap({
        dom:".charts-1",
        container_width:500,
        chart_width:480,
        title:"本校籍贯分布",
        data:[{
                    "name": "上海",
                    "value": "67"
                },
                {
                    "name": "西藏",
                    "value": "20"
                }, 
                {
                    "name": "南海诸岛",
                    "value": "20"
                },{
                    "name": "云南",
                    "value": "20"
                }, {
                    "name": "内蒙古",
                    "value": "49"
                }, {
                    "name": "北京",
                    "value": "540"
                }, {
                    "name": "台湾",
                    "value": "1"
                }, {
                    "name": "吉林",
                    "value": "38"
                }, {
                    "name": "四川",
                    "value": "103"
                }, {
                    "name": "天津",
                    "value": "257"
                }, {
                    "name": "宁夏",
                    "value": "5"
                }, {
                    "name": "安徽",
                    "value": "281"
                }, {
                    "name": "山东",
                    "value": "83"
                }, {
                    "name": "山西",
                    "value": "294"
                }, {
                    "name": "广东",
                    "value": "1418"
                }, {
                    "name": "广西",
                    "value": "80"
                }, {
                    "name": "新疆",
                    "value": "14"
                }, {
                    "name": "江苏",
                    "value": "397"
                }, {
                    "name": "江西",
                    "value": "136"
                }, {
                    "name": "河北",
                    "value": "468"
                }, {
                    "name": "河南",
                    "value": "218"
                }, {
                    "name": "浙江",
                    "value": "234"
                }, {
                    "name": "海南",
                    "value": "297"
                }, {
                    "name": "湖北",
                    "value": "139"
                }, {
                    "name": "湖南",
                    "value": "240"
                }, {
                    "name": "甘肃",
                    "value": "4"
                }, {
                    "name": "福建",
                    "value": "165"
                }, {
                    "name": "贵州",
                    "value": "163"
                }, {
                    "name": "辽宁",
                    "value": "238"
                }, {
                    "name": "重庆",
                    "value": "20"
                }, {
                    "name": "陕西",
                    "value": "95"
                }, {
                    "name": "青海",
                    "value": "1"
                }, {
                    "name": "香港",
                    "value": "7"
                }, {
                    "name": "黑龙江",
                    "value": "46"
                }]
    })
    Charts.getBar({
        dom:".charts-2",
        title:"本校籍贯分布统计",
        h1:400,
        h2:380,
        xData:['北京','上海','广州','广东','福建','新疆','山东','安徽','甘肃','青海','吉林','辽宁','湖南'],
        yData:[{
                name: '教职工分布',
                type: 'bar',
                data: [24, 25, 31, 34, 31,23,34,5,42,23,66,22,49],
                barWidth:'20',     
            }]

    });
    
    </script>
    <script>
        $('#tj').change(function(){
            window.location.href="/teacherbase4";
        })
    </script>
@endsection