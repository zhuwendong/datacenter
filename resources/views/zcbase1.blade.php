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
        <a href="/zcbase1"><span class="tab-item on">取得统计</span></a>
        <a href="/zcbase2"><span class="tab-item">处置统计</span></a>
        <a href="/zcbase3"><span class="tab-item">领用统计</span></a>
    </div>
    <hr/>
    <div class='charts-container clearfix'>
        <div style='width:54%;position: relative;' class='charts-1 p-l'>
            <div class='nav-tab-box-3' style="position: absolute;top: 60px;text-align: center;width: 100%;">
                <span class="tab-item on">取得方式1</span><span class="tab-item">取得方式2</span><span class="tab-item">取得方式3</span>
            </div>
        </div>
        <div style='width:44%' class='charts-2 p-r'></div>
    </div>
</div>
@endsection
@section('footer')
<script>   
	var Charts = new Charts();
    Charts.getBar({
        dom:".charts-1",
        title:"取得统计",
        yValue:"（金额：万元）",
        xData:['分类1', '分类2', '分类3', '分类4'],
        yData:[{
            type: 'bar',
            data: [24, 40, 52, 52],
            barWidth:'30',     
        }]
    });

    Charts.getPie({
        title:"取得方式占比",
        dom:".charts-2",
        type:"1",
        series_name:"年级",
		xDatas:['取得方式1','取得方式2','取得方式3'],
		color:['#FEC84E','#F34334','#6CC693'],
        data:[{
            value: 335,
            name: '取得方式1',
            selected: true
        },
        {
            value: 310,
            name: '取得方式2',
            selected: true
        }, {
            value: 280,
            name: '取得方式3',
            selected: true
        },]
    });
</script>
@endsection