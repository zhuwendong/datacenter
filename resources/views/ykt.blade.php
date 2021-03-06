@extends('layouts.app')
@section('body')
<div style="padding: 15px;">
    <div class='route-box'>
        <span class='icon icon-position'></span>
        <span class='title'>当前位置：</span>
        <span>数据基础分析</span>
        <span>></span>
        <span><a href="javascript:;">一卡通消费分析</a></span>
    </div> 
    <hr/>
    <form>  
    <div style='margin:15px 0;' class='select-box'>
        <input type="text" class="layui-input" name="time1" value="{{ $time1 }}" id="test1" placeholder="请选择时间" style="width: 250px; display: inline-block;">
        <input type="text" class="layui-input" name="time2" value="{{ $time2 }}" id="test2" placeholder="请选择时间" style="width: 250px; display: inline-block;">
        <button type="submit" class="btn btn-info">查询</button>
    </div>
    </form> 
    <div class="flex-container">
        <div class="flex-items">
            <div class="flex-title">
                <span style='top:2.5px;' class='icon-arrow-right-2'></span>
                <span style='font-size:16px;font-weight:600;color:#333;margin-left:10px;'>消费次数</span>
            </div>
            <div class="flex-content">
                <div class="time">
                    <span><a href="javascript:;">{{$time11}}-{{$time22}}</a></span>
                    <!-- <span>今日</span> -->
                </div>
                <div class="count">
                    <span>{{$data['total']}}</span>
                    <span>次</span>
                </div>
                <!-- <div class="float">
                    <span>环比</span>
                    <span class="glyphicon glyphicon-arrow-down"></span>
                    <span>50.72%</span>
                    <span>同比</span>
                    <span class="glyphicon glyphicon-arrow-up"></span>
                    <span>25.19%</span>
                </div> -->
            </div>
        </div>
        <div class="flex-items">
            <div class="flex-title">
                <span style='top:2.5px;' class='icon-arrow-right-2'></span>
                <span style='font-size:16px;font-weight:600;color:#333;margin-left:10px;'>消费人数</span>
            </div>
            <div class="flex-content">
                <div class="time">
                    <span><a href="javascript:;">{{$time11}}-{{$time22}}</a></span>
                    <!-- <span>今日</span> -->
                </div>
                <div class="count">
                    <span>{{$data['number']}}</span>
                    <span>人</span>
                </div>
                <!-- <div class="float">
                    <span>环比</span>
                    <span class="glyphicon glyphicon-arrow-down"></span>
                    <span>50.72%</span>
                    <span>同比</span>
                    <span class="glyphicon glyphicon-arrow-up"></span>
                    <span>25.19%</span>
                </div> -->
            </div>
        </div>
        <div class="flex-items">
            <div class="flex-title">
                <span style='top:2.5px;' class='icon-arrow-right-2'></span>
                <span style='font-size:16px;font-weight:600;color:#333;margin-left:10px;'>消费额</span>
            </div>
            <div class="flex-content">
                <div class="time">
                    <span><a href="javascript:;">2018/11/6-2019/2/21</a></span>
                    <!-- <span>今日</span> -->
                </div>
                <div class="count">
                    <span>{{ $data['summoney'] }}</span>
                    <span>元</span>
                </div>
                <!-- <div class="float">
                    <span>环比</span>
                    <span class="glyphicon glyphicon-arrow-down"></span>
                    <span>50.72%</span>
                    <span>同比</span>
                    <span class="glyphicon glyphicon-arrow-up"></span>
                    <span>25.19%</span>
                </div> -->
            </div>
        </div>
        <div class="flex-items">
            <div class="flex-title">
                <span style='top:2.5px;' class='icon-arrow-right-2'></span>
                <span style='font-size:16px;font-weight:600;color:#333;margin-left:10px;'>人均消费</span>
            </div>
            <div class="flex-content">
                <div class="time">
                    <span><a href="javascript:;">2018/11/6-2019/2/21</a></span>
                    <!-- <span>今日</span> -->
                </div>
                <div class="count">
                    <span>@if(!empty($data['number'])){{ round($data['summoney']/$data['number']) }} @else 0 @endif</span>
                    <span>元</span>
                </div>
                <!-- <div class="float">
                    <span>环比</span>
                    <span class="glyphicon glyphicon-arrow-down"></span>
                    <span>50.72%</span>
                    <span>同比</span>
                    <span class="glyphicon glyphicon-arrow-up"></span>
                    <span>25.19%</span>
                </div> -->
            </div>
        </div>
    </div>
    <div class='charts-container clearfix'>
        <div style='width:50%;position: relative;' class='charts-1 p-l'>
            <div style="position: absolute;top: 80px; left: 50px;">
                <strong>{{$time11}}-{{$time22}}</strong>
            </div>
        </div>
        <div style='width:48%;position: relative;' class='charts-2 p-r'>
            <div style="position: absolute;top: 80px; left: 50px;">
                <strong>{{$time11}}-{{$time22}}</strong>
                <!-- <div class="count" style="padding: 20px;">
                    <span>20.05</span>	
                    <span>万元</span>	
                    <div style="display: inline-block; margin-left: 20px;">
                        <span>环比</span>
                        <span class="glyphicon glyphicon-arrow-down" style="color: green;"></span>
                        <span style="color: green;">50.72%</span><br/>
                        <span>同比</span>
                        <span class="glyphicon glyphicon-arrow-up" style="color: red;"></span>
                        <span style="color: red;">25.19%</span>
                    </div>	
                    <div style="display: inline-block; margin-left: 20px;border-left: 1px solid #ddd; padding-left: 20px;">
                        <span>合计</span>
                        <span>120.7万元</span><br/>
                        <span>均值</span>
                        <span>12.6万元</span>
                    </div>		
                </div> -->
            </div>
        </div>
    </div>
    <div class='charts-container clearfix'>
        <div style='width:50%;position: relative;' class='charts-3 p-l'>
            <div style="position: absolute;top: 100px; left: 50px;">
                <strong>{{$time11}}-{{$time22}}</strong>
            </div>
        </div>
        <div style='width:48%;position: relative;' class='charts-4 p-r'>
            <div style="position: absolute;top: 100px; left: 50px;">
                <strong>{{$time11}}-{{$time22}}</strong>
            </div>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-items">
            <div class="flex-title">
                <span style='top:2.5px;' class='icon-arrow-right-2'></span>
                <span style='font-size:16px;font-weight:600;color:#333;margin-left:10px;'>近7日卡身份类型消费次数量</span>
            </div>
            <div class="flex-content">
                <div class="time">
                    <strong>{{$time11}}-{{$time22}}</strong>
                </div>
                @foreach($data2 as $val)
                   <div class="title">
                        <span></span>
                        <strong>{{$val['角色名称']}}</strong>
                    </div>
                    <div class="count">
                        <span>{{$val['消费次数']}}</span>
                        <strong>次</strong>
                    </div>
                @endforeach
                <!-- <div class="title">
                    <span style="background: #F34334;"></span>
                    <strong>教师</strong>
                </div>
                <div class="count">
                    <span>1000</span>
                    <strong>次</strong>
                </div> -->
                <div id="eChartsId-1" style="height: 300px; width: 100%;"></div>
            </div>
        </div>	
        <div class="flex-items">
            <div class="flex-title">
                <span style='top:2.5px;' class='icon-arrow-right-2'></span>
                <span style='font-size:16px;font-weight:600;color:#333;margin-left:10px;'>近7日卡身份类型消费额</span>
            </div>
            <div class="flex-content">
                <div class="time">
                    <strong>{{$time11}}-{{$time22}}</strong>
                </div>
                <!-- <div class="title">
                    <span></span>
                    <strong>学生</strong>
                </div>
                <div class="count">
                    <span>20.05</span>
                    <strong>万元</strong>
                </div> -->
                @foreach($data2 as $val)
                <div class="title">
                    <span style="background: #F34334;"></span>
                    <strong>{{$val['角色名称']}}</strong>
                </div>
                <div class="count">
                    <span>{{$val['消费额']}}</span>
                    <strong>万元</strong>
                    <!-- <span>合计：120.7万元</span>
                    <span>均值：12.6万元</span> -->
                </div>
                @endforeach
                <div id="eChartsId-2" style="height: 300px; width: 100%;"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script>   
    layui.use('laydate', function(){
		var laydate = layui.laydate;

		//常规用法
		laydate.render({
			elem: '#test1'
		});
        laydate.render({
			elem: '#test2'
		});
	});
	var Charts = new Charts();
    var arr1 = new Array();
    var arr2 = new Array();
    var arr3 = new Array();
    var arr4 = new Array();
    @foreach($data3 as $val){
        arr1.push('{{$val['time']}}');
        arr2.push({{$val['total']}});
        arr3.push({{$val['number']}});
        arr4.push({{$val['summoney']}});
    }

    @endforeach

	Charts.getLine({
        dom:".charts-1",
        title:"近七日消费概况-1",
        h1:400,
        h2:380,
        legend:['消费次数','消费人数'],
        yValue: ' ',
        xData:arr1,
        yData:[       
                {
                    name:'消费次数',
                    type:'line',
                    smooth: false,
                    data:arr2
                },
                {
                    name:'消费人数',
                    type:'line',
                    symbol:'rect',
                    smooth: false,
                    data:arr3,
                },
            ]
    });
    Charts.getLine({
        dom:".charts-2",
        title:"近七日消费概况-2",
        h1:400,
        h2:380,
        gridTop: '150px', 
        yValue: ' ',
        legend:['消费额'],
        xData:arr1,
        yData:[       
                {
                    name:'消费额',
                    type:'line',
                    smooth: false,
                    data:arr4
                },
            ]
    });
    Charts.getPie({
        type:"1",
        dom:".charts-3",
        title:"近7日卡类型消费次数占比",
        xData:['长期卡','临时卡'],
        height:400,
        data:[{
                value: {{$data1['长期卡消费次数']}},
                name: '长期卡',
                selected: true
            },
            {
                value: {{$data1['临时卡消费次数']}},
                name: '临时卡',
                selected: true
            }]
    })
    Charts.getPie({
        type:"1",
        dom:".charts-4",
        title:"近7日卡类型消费额占比",
        xData:['长期卡','临时卡'],
        height:400,
        data:[{
                value: {{$data1['长期卡消费额']}},
                name: '长期卡',
                selected: true
            },
            {
                value: {{$data1['临时卡消费额']}},
                name: '临时卡',
                selected: true
            }]
    });

    var eChartsA = echarts.init(document.getElementById('eChartsId-1'));
    var eChartsB = echarts.init(document.getElementById('eChartsId-2'));
    var data = new Array();
    var data1 = new Array();
    var data2 = new Array();
    @foreach($data2[0]['rows'] as $val)
    data.push('{{$val['vlues']['date']}}');
    data1.push('{{$val['vlues']['number']}}');
    @endforeach
    @foreach($data2[1]['rows'] as $val)
    data2.push('{{$val['vlues']['number']}}');
    @endforeach

    var data3 = new Array();
    var data4 = new Array();
    @foreach($data2[0]['rows'] as $val)
    data3.push('{{$val['vlues']['money']}}');
    @endforeach
    @foreach($data2[1]['rows'] as $val)
    data4.push('{{$val['vlues']['money']}}');
    @endforeach

    var option = {
		tooltip : {
		    trigger: 'axis',
		    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
		        type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
		    }
	    },
	    legend: {
	        data:['学生','教师'],
	        bottom: '0',
	    },
	    color: ['#438AFE', '#F34334'],
	    grid: {
	        left: '3%',
	        right: '4%',
	        bottom: '10%',
	        containLabel: true
	    },
	    xAxis : [
	        {
	            type : 'category',
	            data : data
	        }
	    ],
	    yAxis : [
	        {
	            type : 'value'
	        }
	    ],
	    series: [{
            name: '学生',
            type: 'bar',
            stack: '人数',
            data: data1,
            barWidth:'20',     
        }, {
            name: '教师',
            type: 'bar',
            stack: '人数',
            data: data2,
            barWidth:"20"
        },]
    };
    var option1 = {
		tooltip : {
		    trigger: 'axis',
		    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
		        type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
		    }
	    },
	    legend: {
	        data:['学生','教师'],
	        bottom: '0',
	    },
	    color: ['#438AFE', '#F34334'],
	    grid: {
	        left: '3%',
	        right: '4%',
	        bottom: '10%',
	        containLabel: true
	    },
	    xAxis : [
	        {
	            type : 'category',
	            data : data
	        }
	    ],
	    yAxis : [
	        {
	            type : 'value'
	        }
	    ],
	    series: [{
            name: '学生',
            type: 'bar',
            stack: '人数',
            data: data3,
            barWidth:'20',     
        }, {
            name: '教师',
            type: 'bar',
            stack: '人数',
            data: data4,
            barWidth:"20"
        },]
    };
    eChartsA.setOption(option);
    eChartsB.setOption(option1);
</script>
@endsection