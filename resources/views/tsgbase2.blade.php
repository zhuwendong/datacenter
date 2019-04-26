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
    <a href="/tsgbase1"><span class="tab-item ">投入占比</span></a>
    <a href="/tsgbase2"><span class="tab-item on">借书高峰分析</span></a>
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
        <option value="">借书高峰时间段统计</option>
        <option value="">借书高峰周期书类统计</option>
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
	Charts.getHBar({
		dom: '.charts-1',
		title: '借书高峰时间段统计',
		legend: ['一年级', '二年级', '校委会', '董事会', '语文组'],
		xData: [
                {
                    name: '一年级',
                    type: 'bar',
                    stack: '总量',
                    label: {
                        normal: {
                            show: false,
                            position: 'insideRight'
                        }
                    },
                    barWidth: 30,
                    data: [320, 302, 301, 334, 390, 330, 320]
                },
                {
                    name: '二年级',
                    type: 'bar',
                    stack: '总量',
                    label: {
                        normal: {
                            show: false,
                            position: 'insideRight'
                        }
                    },
                    barWidth: 30,
                    data: [120, 132, 101, 134, 90, 230, 210]
                },
                {
                    name: '校委会',
                    type: 'bar',
                    stack: '总量',
                    label: {
                        normal: {
                            show: false,
                            position: 'insideRight'
                        }
                    },
                    barWidth: 30,
                    data: [220, 182, 191, 234, 290, 330, 310]
                },
                {
                    name: '董事会',
                    type: 'bar',
                    stack: '总量',
                    label: {
                        normal: {
                            show: false,
                            position: 'insideRight'
                        }
                    },
                    barWidth: 30,
                    data: [150, 212, 201, 154, 190, 330, 410]
                },
                {
                    name: '语文组',
                    type: 'bar',
                    stack: '总量',
                    label: {
                        normal: {
                            show: false,
                            position: 'insideRight'
                        }
                    },
                    barWidth: 30,
                    data: [820, 832, 901, 934, 1290, 1330, 1320]
                }
            ],
        yData: ['0','1-4','5-8','9-12','13-16','17-20','21-24']
	});
    </script>
    <script>
        $('#tj').change(function(){
            window.location.href="/tsgbase3";
        })
    </script>
@endsection