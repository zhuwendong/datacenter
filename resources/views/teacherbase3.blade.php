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
                <a href="/teacherbase2"><span class="tab-item">在校状态统计</span></a>
                <a href="/teacherbase3"><span class="tab-item on">调动统计</span></a>
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
    Charts.getBar({
        dom:".charts-1",
        title:"人数性别分布",
        h1:400,
        h2:380,
        xData:['语文', '数学', '英语', '政治', '历史','地理','化学'],
        yData:[{
                name: '学科人数',
                type: 'bar',
                data: [530, 500, 200, 125, 310,230,300],
                barWidth:'20',     
            }]
    })
    Charts.getTPie({
        dom:".charts-2",
        title:"学科人数分布",
        h1:650,
        h2:300,
        series_name_1:"在编教师",
        series_name_3:"年级",
        type:"3",
        xData1:['在编教师'],
        xData2:[{
                name: '职业教师',
                max: 100
            }, {
                name: '工勤人员',
                max: 100
            }, {
                name: '兼职教师',
                max: 100
            }, {
                name: '行政人员',
                max: 100
            }, {
                name: '技术人员',
                max: 100
            },{
                name: '专职教师',
                max: 100
            }],
        xData3:['一年级','二年级','三年级','四年级','五年级'],
        data1:[{
            value: 453,
            name: '在编教师',
            selected: true
        },{
            value: 212,
            "itemStyle": {
                "normal": {
                    "label": {
                        "show": false
                    },
                    "labelLine": {
                        "show": false
                    },
                    "color": 'rgba(0,0,0,0)',
                    "borderColor": 'rgba(0,0,0,0)',
                    "borderWidth": 0
                },
                "emphasis": {
                    "color": 'rgba(0,0,0,0)',
                    "borderColor": 'rgba(0,0,0,0)',
                    "borderWidth": 0
                }
            },
            name: '其他',
            selected: true
        }],
        data2:[30, 32, 61,87,70,54],
        data3:[{
            value: 335,
            name: '一年级',
            selected: true
        },
        {
            value: 310,
            name: '二年级',
            selected: true
        }, {
            value: 280,
            name: '三年级',
            selected: true
        },{
            value: 200,
            name: '四年级',
            selected: true
        },{
            value: 223,
            name: '五年级',
            selected: true
        }],
    })
    
    </script>
@endsection