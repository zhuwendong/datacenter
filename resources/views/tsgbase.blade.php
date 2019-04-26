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
        <a href="/tsgbase"><span class="tab-item on">机构借书占比</span></a>
        <a href="/tsgbase1"><span class="tab-item">投入占比</span></a>
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
        <div style='width:100%;' class='charts-1 p-l'></div>
    </div>
</div>
@endsection
@section('footer')
<script>   
var Charts = new Charts();
Charts.getPie({
    title:"机构借书占比",
    dom:".charts-1",
    type:"1",
    xDatas:['一号宿舍楼','二号宿舍楼','三号宿舍楼'],
    data:[{
        value: 16,
        name: '董事会',
        selected: true
    },
    {
        value: 45,
        name: '一年级',
        selected: true
    },{
        value: 19,
        name: '语文组',
        selected: true
    }, {
        value: 26,
        name: '二年级',
        selected: true
    },]
});
</script>
@endsection