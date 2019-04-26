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
        <a href="/doombase"><span class="tab-item ">入住详细</span></a>
        <a href="/doombase1"><span class="tab-item on">出入分时段</span></a>
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
        <div style='width:100%' class='charts-1 p-l'>
            <div></div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script>   
var Charts = new Charts();
Charts.getAroundBar({
    title:"出入分时段",
    dom:".charts-1",
    h1:600,
    h2:580,
    legend:['出门','进门'],
    xData:['7', '8', '9', '11', '12', '13', '14', '15', '16'],
    yData:[
        {
            name:'出门',
            type:'bar',
            stack: '总量',
            label: {
                normal: {
                    show: true
                }
            },
            data:[320, 302, 341, 374, 390, 450, 420, 220, 440]
        },
        {
            name:'进门',
            type:'bar',
            stack: '总量',
            label: {
                normal: {
                    show: true,
                    position: 'left'
                }
            },
            data:[-120, -132, -101, -134, -190, -230, -210, -180, -200]
        }
    ]
});
</script>
@endsection