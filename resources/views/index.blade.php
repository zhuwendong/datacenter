@extends('layouts.app')
@section('body')
<div style="padding: 15px;">
    <div class='route-box'>
        <span class='icon icon-position'></span>
        <span class='title'>当前位置：</span>
        <span>首页</span>
    </div>
    <!-- <div class='title-box' style="text-align: center;">
        <span>合肥市第一小学</span>
    </div> -->
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

    var arr1 = new Array();
    var arr2 = new Array();
    @foreach ($borrow as $vo)
        arr1.push('{{$vo['学科类目']}}');
        arr2.push('{{$vo['册数']}}');
    @endforeach
    Charts.getLine({
        dom: ".charts-2",
        title: "借书类型及数量折线图",
        yValue:"(数量：本)",
        xData: arr1,
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
            data: arr2,
        }], 
    });

    var data = new Array();
    @foreach ($jiguan as $value)
    data.push({
                    "name": "{{$value->s_jiguan}}",
                    "value": "{{$value->count}}"
                });
    @endforeach
    Charts.getMap({
        dom:".charts-3",
        container_width:500,
        chart_width:480,
        title:"教师/学生籍贯分布",
        data:data
    });
    var time = new Array();
    @foreach($ykt_time as $value){
        time.push('{{ $value }}');
    }
    @endforeach
    Charts.getLine({
        dom: ".charts-4",
        title: "一卡通近7日消费额",
        yValue:"金额：万元",
        xData: time,
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
            data: [0, 0, 0, 0, 0, 0, 0],
        }], 
    });
    var data = new Array();
    var data1 = new Array();
    @foreach ($data as $value)
       data.push('{{ $value->name }}');
       data1.push({
            value: {{ $value->count }},
            name: '{{ $value->name }}',
        });
    @endforeach
    Charts.getQpie({
        dom:".charts-5",
        h1:400,
        h2:400,
        title:"分类及金融占比",
        legend:data,
        // data1:[
        //     {value:335, name:'电器类'},
        //     {value:310, name:'日常消耗品'},
        //     {value:234, name:'办公用品类'},
        // ],
        data2:data1
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
    var subject = new Array();
    var number = new Array();
    @foreach ($teacher as $vo)
    subject.push('{{ $vo['coursedetail'] }}');
    @endforeach
    @foreach ($teacher as $vo)
    number.push({{ $vo['number'] }});
    @endforeach
    Charts.getBar({
        dom:".charts-8",
        title:"科目教师数量柱状图",
        yValue:"(人数：人)",
        xData:subject,
        legend:["人数"],
        yData:[{
                name: '人数',
                type: 'bar',
                stack: '人数',
                data: number,
                barWidth:'20',     
            }]
    });
    var subject = new Array();
    var number = new Array();
    @foreach ($results as $vo)
    subject.push('{{ $vo['gd_name'] }}');
    @endforeach
    @foreach ($results as $vo)
    number.push({{ $vo['avg'] }});
    @endforeach
    Charts.getBar({
        dom:".charts-9",
        title:"各年级最近一场考试总分平均数柱状图",
        yValue:"(分数：分)",
        xData:subject,
        legend:["分数"],
        yData:[{
                name: '分数',
                type: 'bar',
                stack: '分数',
                data: number,
                barWidth:'20',     
            }]
    });
</script>
@endsection