@extends('layouts.app')
@section('body')
<div style="padding: 15px;">
    <div class='route-box'>
        <span class='icon icon-position'></span>
        <span class='title'>当前位置：</span>
        <span>数据基础分析</span>
        <span>></span>
        <span><a href="javascript:;">宿舍基础分析</a></span>
    </div> 
    <div style='margin:20px 0' class='nav-tab-box-2'>
        <a href="/doombase"><span class="tab-item on">入住详细</span></a>
        <a href="/doombase1"><span class="tab-item">出入分时段</span></a>
        <a href="/doombase2"><span class="tab-item">宿舍分布</span></a>
    </div>
    <div class=''>
        <label for="">校区：</label>
        <select class='ipt ipt-xs' name="" id="">
            <option value="">请选择</option>
        </select>
        <button class="btn btn-info">查询</button>
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
        title:"入住详细",
        dom:".charts-1",
        h1:400,
        h2:380,
        type:"1",
        yValue:"（数量：件）",
        data1:{
            legend:['非住宿','住宿'],
            xData:['一年级', '二年级', '三年级', '四年级', '五年级', '六年级'],
            yData:[
                {
                    name: '非住宿',
                    type: 'bar',
                    barWidth:40,
                    stack: '用户数',
                    data: [1200, 1320, 1010, 1340, 900, 500]
                },
                {
                    name: '住宿',
                    type: 'bar',
                    barWidth:40,
                    stack: '用户数',
                    data: [220, 182, 191, 234, 290, 300]
                }
                
            ]
        },
        data2:{
            series_name:"年级",
            xData:['非住宿','住宿'],
            data:[{
                value: 46,
                name: '非住宿',
                selected: true
            },
            {
                value: 54,
                name: '住宿',
                selected: true
            }]
        }
    });
    </script>
@endsection