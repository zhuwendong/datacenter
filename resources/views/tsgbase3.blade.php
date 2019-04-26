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
        <span class="tab-item">机构借书占比</span>
        <span class="tab-item">投入占比</span>
        <span class="tab-item on">借书高峰分析</span>
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
    <div style='margin:15px 0;' class='select-box'>
        <select id="tj" class='ipt' name="" id="">
            <option value="">借书高峰周期书类统计</option>
            <option value="">借书高峰时间段统计</option>
        </select>
    </div>   
    <div class='charts-container clearfix'>
        <div style='width:100%;' class='charts-1 p-l'></div>
    </div>
</div>
@endsection
@section('footer')
<script>   
	var Charts = new Charts();
	Charts.getBar({
        dom:".charts-1",
        title:"借书高峰周期书类统计",
        xData:['第一周', '第二周', '第三周', '第四周', '第五周','第六周', '第七周'],
        legend:["类目1","类目2","类目3","类目4","类目5","类目6","类目7","类目8","其他"],
        color: ["#C23432","#2F4553","#609FA8","#D48064","#90C6AE","#749E82","#C88724","#B9A199","#6F7074"],
        yValue: ' ',
        yData:[{
                name: '类目1',
                type: 'bar',
                data: [400, 580, 610, 300, 710, 390, 610],
                barWidth:'20',     
            }, {
                name: '类目2',
                type: 'bar',
                stack: '数学',
                data: [500, 390, 80, 410, 440, 660, 580],
                barWidth:"20"
            }, {
                name: '类目3',
                type: 'bar',
                stack: '数学',
                data: [500, 390, 80, 410, 440, 660, 580],
                barWidth:"20"
            }, {
                name: '类目4',
                type: 'bar',
                stack: '数学',
                data: [500, 390, 80, 410, 440, 660, 580],
                barWidth:"20"
            },{
                name: '类目5',
                type: 'bar',
                data: [400, 580, 610, 300, 710, 390, 610],
                barWidth:'20',     
            }, {
                name: '类目6',
                type: 'bar',
                stack: '语文',
                data: [500, 390, 80, 410, 440, 660, 580],
                barWidth:"10"
            }, {
                name: '类目7',
                type: 'bar',
                stack: '语文',
                data: [500, 390, 80, 410, 440, 660, 580],
                barWidth:"10"
            }, {
                name: '类目8',
                type: 'bar',
                stack: '语文',
                data: [500, 390, 80, 410, 440, 660, 580],
                barWidth:"10"
            },{
                name: '其他',
                type: 'bar',
                stack: '语文',
                data: [400, 580, 610, 300, 710, 390, 610],
                barWidth:'10',     
            }, ]
    });
</script>
<script>
    $('#tj').change(function(){
        window.location.href="/tsgbase2";
    })
</script>
@endsection