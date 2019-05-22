@extends('layouts.app')
@section('body')
<div style="padding: 15px;">
            <div class='route-box'>
                <span class='icon icon-position'></span>
                <span class='title'>当前位置：</span>
                <span>数据基础分析</span>
                <span>></span>
                <span><a href="">教职工基础分析</a></span>
            </div>   
            <div style='margin:20px 0' class='nav-tab-box-2'>
                <a href="/teacherbase"><span class="tab-item">基础统计</span></a>
                <a href="/teacherbase1"><span class="tab-item">来源分析</span></a>
                <a href="/teacherbase2"><span class="tab-item on">在校状态统计</span></a>
                <a href="/teacherbase3"><span class="tab-item">调动统计</span></a>
            </div>
            <div class=''>
            <form>
            <label for="">校区：</label>
            <select class='ipt ipt-xs' name="campus" id="">
                <option value="">请选择</option>
                @foreach ($campus as $vo)
                <option @isset($_REQUEST["campus"]) @if ($_REQUEST["campus"] == $vo->cp_id) selected @endif @endisset value="{{ $vo->cp_id }}">{{ $vo->cp_name }}</option>
                @endforeach
            </select>
            <label for="">机构：</label>
            <select class='ipt ipt-xs' name="orgniza" id="">
                <option value="">请选择</option>
                @foreach($orgniza as $vo)
                <option @isset($_REQUEST["orgniza"]) @if ($_REQUEST["orgniza"] == $vo->og_id) selected @endif @endisset value="{{ $vo->og_id }}">{{ $vo->og_name }}</option>
                @endforeach
            </select>
            <button class="btn btn-info">查询</button>
            </form>
        </div>
            <div class='title-box'>
                <span class='icon-student'></span>
                <span>学生人数：</span>
                <span>5000</span>
            </div>
            <div style='margin:15px 0;' class='select-box'>
                <select class='ipt ipt-xs' name="" id="">
                    <option value="">教职工籍贯统计</option>
                </select>
            </div>
            <div class='charts-container clearfix'>
                <div style='width:100%' class='charts-1 p-l'></div>
            </div>
            <div class='charts-container clearfix'>
                <div style='width:100%' class='charts-2 p-l'></div>
            </div>
        </div>
@endsection
@section('footer')
<script>
    //JavaScript代码区域
    layui.use(['element','laypage'], function(){
      var element = layui.element;
      var laypage = layui.laypage;
      //执行一个laypage实例
      laypage.render({
        elem: 'c_page' //注意，这里的 test1 是 ID，不用加 # 号
        ,count: 50 //数据总数，从服务端得到
      });
    });
    $(".tab-box").on("click",".tab-item",function(){
        $(this).addClass("on").siblings(".tab-item").removeClass("on");
    })
    var Charts = new Charts();
    Charts.getLine({
        dom:".charts-1",
        title:"评价分析",
        h1:400,
        h2:380,
        legend:['初级','中级','高级'],
        xData:['<60','60-65','71-75','76-80','81-85','86-90','91-95','96-100'],
        yData:[       
                {
                    name:'初级',
                    type:'line',
                    smooth: true,
                    data:[220, 182, 191, 234, 290, 330, 310,222]
                },
                {
                    name:'中级',
                    type:'line',
                    symbol:'rect',
                    smooth: true,
                    data:[150, 232, 201, 154, 190, 330, 410,542],
                },
                {
                    name:'高级',
                    type:'line',
                    smooth: true,
                    symbol:'triangle',
                    data:[320, 332, 301, 334, 390, 330, 320,43],
                },
            ]
    })
    Charts.getDPie({
        type:"3",
        dom:".charts-2",
        series_name_1:"职称",
        series_name_2:"分数段",
        title:"职称及评分图",
        xData:['初级','中级','高级'],
        xData_2:['41-50分','51-60分','61-70分','71-80分','81-90分'],
        h1:400,
        h2:380,
        data_1:[{
            value: 335,
            name: '初级',
            selected: true
        },
        {
            value: 310,
            name: '中级',
            selected: true
        }, {
            value: 280,
            name: '高级',
            selected: true
        }],
        data_2:[{
            value: 213,
            name: '41-50分',
            selected: true
        },
        {
            value: 310,
            name: '51-60分',
            selected: true
        }, {
            value: 280,
            name: '61-70分',
            selected: true
        },{
            value: 280,
            name: '71-80分',
            selected: true
        },{
            value: 280,
            name: '81-90分',
            selected: true
        }]
    })
    
    </script>
@endsection