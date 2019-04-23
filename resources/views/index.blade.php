@extends('layouts.app')
@section('body')
<div style="padding: 15px;">
    <div class='route-box'>
        <span class='icon icon-position'></span>
        <span class='title'>当前位置：</span>
        <span>首页</span>
    </div>
    <div class='title-box' style="text-align: center;">
        <span>合肥市第一小学</span>
    </div>
    <div class='charts-container clearfix'>
        <div style='width:54%' class='charts-1 p-l'></div>
        <div style='width:44%' class='charts-2 p-r'></div>
    </div>
    <div class='charts-container clearfix'>
        <div style='width:100%' class='charts-3 p-l'></div>
    </div>
    <div class='charts-container clearfix'>
        <div style='width:54%' class='charts-4 p-l'></div>
        <div style='width:44%' class='charts-5 p-r'></div>
    </div>
    <div class='charts-container clearfix'>
        <div style='width:54%' class='charts-6 p-l'></div>
        <div style='width:44%' class='charts-7 p-r'></div>
    </div>
    <div class='charts-container clearfix'>
        <div style='width:54%' class='charts-8 p-l'></div>
        <div style='width:44%' class='charts-9 p-r'></div>
    </div>
</div>
@endsection
@section('footer')
<script>
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
        title:"年级人数分布柱状图",
        yValue:"(人数：人)",
        xData:['一年级', '二年级', '三年级', '四年级', '五年级','六年级'],
        legend:["男","女"],
        yData:[{
                name: '男',
                type: 'bar',
                stack: '人数',
                data: sex1,
                barWidth:'20',     
            }, {
                name: '女',
                type: 'bar',
                stack: '人数',
                data: sex2,
                barWidth:"20"
            },]
    });

    Charts.getLine({
        dom: ".charts-2",
        title: "借书类型及数量折线图",
        yValue:"(数量：本)",
        xData: ['人物', '历史', '文学', '教育', '科学', '其他'],
        legend: ['数量'],
        yData: [{
            name: '数量',
            type: 'line',
            itemStyle: {
                normal: {
                    color: '#ff0000',	// 折点自定义颜色
                    lineStyle: {
                        color: '#ff0000',	// 折线自定义颜色
                    }
                }
            },
            data: [28, 25, 38, 24, 35, 26],
        }], 
    });

    Charts.getMap({
        dom:".charts-3",
        container_width:500,
        chart_width:480,
        title:"教师/学生籍贯分布",
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
    });

    Charts.getLine({
        dom: ".charts-4",
        title: "一卡通近7日消费额",
        yValue:"金额：万元",
        xData: ['11/7', '11/8', '11/9', '11/10', '11/11', '11/12', '11/13'],
        legend: ['消费额'],
        yData: [{
            name: '消费额',
            type: 'line',
            itemStyle: {
                normal: {
                    color: '#ff0000',	// 折点自定义颜色
                    lineStyle: {
                        color: '#ff0000',	// 折线自定义颜色
                    }
                }
            },
            data: [2500, 4600, 3100, 2400, 4700, 4100, 2700],
        }], 
    });

    Charts.getQpie({
        dom:".charts-5",
        h1:400,
        h2:400,
        title:"分类及金融占比",
        legend:['电器类','日常消耗品','办公用品类','电器类金额占比','日常消耗品金额占比','办公用品类金额占比'],
        data1:[
            {value:335, name:'电器类'},
            {value:310, name:'日常消耗品'},
            {value:234, name:'办公用品类'},
        ],
        data2:[{
            value: 5425,
            name: '电器类金额占比',
        },
        {
            value: 3100,
            name: '日常消耗品金额占比',
        }, {
            value: 1800,
            name: '办公用品类金额占比',
        }]
    });

    Charts.getBar({
        dom:".charts-6",
        title:"考勤时间段及打卡人数柱状图",
        yValue:"(人数：人)",
        xData:['0-4', '5-8', '9-12', '13-16', '17-21','22-24'],
        legend:["人数"],
        yData:[{
                name: '人数',
                type: 'bar',
                stack: '人数',
                data: [2, 8, 26, 12, 31, 2],
                barWidth:'20',     
            }]
    });

    Charts.getBar({
        dom:".charts-7",
        title:"今日考勤时间段及打卡人数柱状图",
        yValue:"(人数：人)",
        xData:['0-4', '5-8', '9-12', '13-16', '17-21','22-24'],
        legend:["上班","下班"],
        yData:[{
                name: '上班',
                type: 'bar',
                stack: '人数',
                data: [24, 25, 31, 34, 31,23],
                barWidth:'20',     
            }, {
                name: '下班',
                type: 'bar',
                stack: '人数',
                data: [28, 20, 25, 32, 23,24],
                barWidth:"20"
            },]
    });

    Charts.getBar({
        dom:".charts-8",
        title:"科目教师数量柱状图",
        yValue:"(人数：人)",
        xData:['语文', '数学', '英语', '政治', '历史','地理'],
        legend:["人数"],
        yData:[{
                name: '人数',
                type: 'bar',
                stack: '人数',
                data: [12, 6, 26, 16, 31, 24],
                barWidth:'20',     
            }]
    });

    Charts.getBar({
        dom:".charts-9",
        title:"各年级最近一场考试总分平均数柱状图",
        yValue:"(分数：分)",
        xData:['一年级', '二年级', '三年级', '四年级', '五年级','六年级'],
        legend:["人数"],
        yData:[{
                name: '人数',
                type: 'bar',
                stack: '人数',
                data: [45, 32, 72, 54, 81, 68],
                barWidth:'20',     
            }]
    });
</script>
@endsection