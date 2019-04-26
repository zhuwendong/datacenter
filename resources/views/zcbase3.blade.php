@extends('layouts.app')
@section('body')
<div style="padding: 15px;">
    <div class='route-box'>
        <span class='icon icon-position'></span>
        <span class='title'>当前位置：</span>
        <span>数据基础分析</span>
        <span>></span>
        <span><a href="javascript:;">总产基础分析</a></span>
    </div> 
    <div style='margin:20px 0' class='nav-tab-box-2'>
    <a href="/zcbase"><span class="tab-item ">总体统计</span></a>
        <a href="/zcbase1"><span class="tab-item ">取得统计</span></a>
        <a href="/zcbase2"><span class="tab-item ">处置统计</span></a>
        <a href="/zcbase3"><span class="tab-item on">领用统计</span></a>
    </div>
    <hr/>
    <div class='charts-container clearfix'>
        <div style='width:100%' class='charts-1 p-l'></div>
    </div>
</div>
@endsection
@section('footer')
<script>   
	var Charts = new Charts();
	Charts.getPBarPie({
        title:"领用统计",
        dom:".charts-1",
        h1:400,
        h2:380,
        type:"3",
		yValue:"（数量：件）",
		color:['#6CC693','#FEC84E','#77D632'],
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
			color:['#438AFE','#F34334','#6CC693','#FFF7FA','#77D632'],
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
    });
</script>
@endsection