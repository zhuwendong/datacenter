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
        <a href="/doombase1"><span class="tab-item ">出入分时段</span></a>
        <a href="/doombase2"><span class="tab-item on">宿舍分布</span></a>
    </div>
    <form>
    <div class=''>
        <label for="">校区：</label>
        <select class='ipt ipt-xs' name="campus" id="">
            <option value="">请选择</option>
            @foreach ($campus as $vo)
                <option @isset($_REQUEST["campus"]) @if ($_REQUEST["campus"] == 1) selected @endif @endisset value="{{ $vo->cp_id }}">{{ $vo->cp_name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-info">查询</button>
    </div>
    </form>
    <hr/>
    <div class='charts-container clearfix'>
        <div style='width:54%;position: relative;' class='charts-1 p-l'>
            <div class='nav-tab-box-3' style="position: absolute;top: 60px;text-align: center;width: 100%;">
            @foreach ($build as $vo)<span class="tab-item @if ($build_id == $vo->id) on @endif">{{ $vo->build_name }}</span>@endforeach
            <!--  <span class="tab-item">二号宿舍楼</span><span class="tab-item">三号宿舍楼</span> -->
            </div>
        </div>
        <div style='width:44%' class='charts-2 p-r'></div>
    </div>
</div>
@endsection
@section('footer')
<script>   
	var Charts = new Charts();
    var data = new Array();
    @foreach ($grade as $vo)
    data.push({{ $vo->count }});
    @endforeach
    Charts.getBar({
        dom:".charts-1",
        title:"住宿分布",
        yValue:"（住宿人数：人）",
        xData:['一年级', '二年级', '三年级', '四年级','五年级','六年级'],
        yData:[{
            type: 'bar',
            data: data,
            barWidth:'40',     
        }]
    });

    var data1 = new Array();
    @foreach ($build as $vo)
    data1.push('{{ $vo->build_name }}');
    @endforeach
    
    var data2 = new Array();
    @foreach ($build as $vo)
    data2.push({
            value: {{ $vo->count }},
            name: '{{$vo->build_name}}',
            selected: true
        });
    @endforeach

    Charts.getPie({
        title:"宿舍占比",
        dom:".charts-2",
        type:"1",
        series_name:"宿舍楼",
        xDatas:data1,
		color:['#FEC84E','#F34334','#6CC693'],
        data:data2
    });
</script>
@endsection