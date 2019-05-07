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
                @foreach ($obtain as $value)<span class="tab-item @if ($ob == $value->id) on @endif"><a href="/zcbase1?obtain={{ $value->id }}">{{$value->name}}</a></span>@endforeach
            </div>
        </div>
        <div style='width:44%' class='charts-2 p-r'></div>
    </div>
</div>
@endsection
@section('footer')
<script>   
	var Charts = new Charts();
    var data  = new Array();
    var data1 = new Array();
    @foreach ($data as $value)
    data.push('{{ $value->name }}');
    data1.push({{ $value->count }});
    @endforeach 
    Charts.getBar({
        dom:".charts-1",
        title:"取得统计",
        yValue:"（金额：万元）",
        xData:data,
        yData:[{
            type: 'bar',
            data: data1,
            barWidth:'30',     
        }]
    });
    
    var data2 = new Array();
    var data3 = new Array();
    @foreach ($obtain as $value)
    data2.push('{{ $value->name }}');
    data3.push({
            value: {{ $value->id }},
            name: '{{ $value->name }}',
            selected: true
        });
    @endforeach
    Charts.getPie({
        title:"取得方式占比",
        dom:".charts-2",
        type:"1",
        series_name:"年级",
		xDatas:data2,
		color:['#FEC84E','#F34334','#6CC693'],
        data:data3
    });
</script>
@endsection