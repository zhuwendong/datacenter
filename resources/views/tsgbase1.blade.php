@extends('layouts.app')
@section('body')
<div style="padding: 15px;">
<div class='route-box'>
    <span class='icon icon-position'></span>
    <span class='title'>当前位置：</span>
    <span>数据基础分析</span>
    <span>></span>
    <span><a href="javascript:;">图书馆基础分析</a></span>
</div> 
<div style='margin:20px 0' class='nav-tab-box-2'>
    <a href="/tsgbase"><span class="tab-item ">机构借书占比</span></a>
    <a href="/tsgbase1"><span class="tab-item on">投入占比</span></a>
    <a href="/tsgbase2"><span class="tab-item">借书高峰分析</span></a>
</div>
<div class=''>
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
<hr/>
<div class='charts-container clearfix'>
    <div style='width:54%;' class='charts-1 p-l'></div>
    <div style='width:44%;' class='charts-2 p-r'></div>
</div>
</div>
@endsection
@section('footer')
<script>   
	var Charts = new Charts();
	Charts.getBar({
        dom:".charts-1",
        title:"投入占比（总投入额：5000.00元）",
        yValue:"   （投入资金：万元）",
        xData:['科学', '哲学', '美学', '计算机', '互联网'],
        yData:[{
            type: 'bar',
            data: [75, 42, 52, 65, 18],
            barWidth:'40',
            itemStyle: {
            	normal: {
	            	color: function(params) {
	            		var colorList = ['#438AFE', '#EE4233', '#6DC593', '#DBE548', '#FFC750'];
	            		return colorList[params.dataIndex];
	            	},
	            },	
            },     
        }]
    });

    Charts.getPie({
        title:"类别册数占比",
		dom:".charts-2",
		color:['#438AFE','#F34334','#67C996','#DAE648','#FEC84E'],
        type:"3",
        xDatas: [],
        data:[{
            value: 741,
            name: '科学',
            selected: true
        },
        {
            value: 8897,
            name: '计算机',
            selected: true
        },{
            value: 558,
            name: '互联网',
            selected: true
        }, {
            value: 2258,
            name: '美学',
            selected: true
        }, {
            value: 10158,
            name: '哲学',
            selected: true
        },]
    });
</script>
@endsection