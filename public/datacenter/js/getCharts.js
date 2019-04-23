/*
 * @Author: ghostChen 
 * @Date: 2019-02-20 16:22:47 
 * @Last Modified by: ghostChen
 * @Last Modified time: 2019-02-28 11:49:52
 */
;var Charts = function(){};
Charts.prototype = {
    init:function(){
        
    },
    //默认颜色
    detailColor:function(){
        return ["#4789fa","#f34433","#ffc750","#79d532","#4ab37a","#dbe548","#d67ec4"]
    },
    //生成壳子
    creactCharts:function(o,title,h1,h2){
        $(o).append("<div style='border:1px solid #e5e5e5;padding:15px;border-radius:5px;margin:15px 0' class='charts-box'>"+
                        "<div class='charts-title-box'>"+
                            "<span style='top:2.5px;' class='icon-arrow-right-2'></span>"+
                            "<span style='font-size:16px;font-weight:600;color:#333;margin-left:10px;'>"+title+"</span>"+
                        "</div>"+
                        "<div style='margin-top:15px;' class='charts'></div>"+
                    "</div>");
                    $(o).find(".charts-box").height(h1);
                    $(o).find(".charts-box").find(".charts").height(h2);
        
    },
    //生成双表壳子
    creactDCharts:function(o,title,h1,h2){
        $(o).append("<div style='border:1px solid #e5e5e5;padding:15px;border-radius:5px;margin:15px 0' class='charts-box'>"+
                        "<div class='charts-title-box'>"+
                            "<span style='top:2.5px;' class='icon-arrow-right-2'></span>"+
                            "<span style='font-size:16px;font-weight:600;color:#333;margin-left:10px;'>"+title+"</span>"+
                        "</div>"+
                        "<div style='display:flex;justify-content:space-around;'>"+
                            "<div style='margin-top:15px;width:48%' class='charts charts-1'></div>"+
                            "<div style='margin-top:15px;width:48%' class='charts charts-2'></div>"+
                        "</div>"+
                    "</div>");
                    $(o).find(".charts-box").height(h1);
                    $(o).find(".charts-box").find(".charts").height(h2);
    },
    creactTCharts:function(o,title,h1,h2){
        $(o).append("<div style='border:1px solid #e5e5e5;padding:15px;border-radius:5px;margin:15px 0' class='charts-box'>"+
            "<div class='charts-title-box'>"+
                "<span style='top:2.5px;' class='icon-arrow-right-2'></span>"+
                "<span style='font-size:16px;font-weight:600;color:#333;margin-left:10px;'>"+title+"</span>"+
            "</div>"+
            "<div style='display:flex;justify-content:space-around;'>"+
                "<div style='margin-top:15px;width:48%' class='charts charts-1'></div>"+
                "<div style='margin-top:15px;width:48%' class='charts charts-2'></div>"+
            "</div>"+
            "<div style='display:flex;justify-content:flex-start;'>"+
                "<div style='margin-top:15px;width:48%' class='charts charts-3'></div>"+
            "</div>"+
        "</div>");
        $(o).find(".charts-box").height(h1);
        $(o).find(".charts-box").find(".charts").height(h2);
    },
    creactBarTable:function(o,title,h1,h2,data){
        $(o).append("<div style='border:1px solid #e5e5e5;padding:15px;border-radius:5px;margin:15px 0' class='charts-box'>"+
                        "<div class='charts-title-box'>"+
                            "<span style='top:2.5px;' class='icon-arrow-right-2'></span>"+
                            "<span style='font-size:16px;font-weight:600;color:#333;margin-left:10px;'>"+title+"</span>"+
                        "</div>"+
                        "<div style='display:flex;justify-content:center;'>"+
                            "<div style='margin-top:15px;width:100%' class='charts'></div>"+
                        "</div>"+
                        "<div style='width:100%;' class='chart-table-box c-table'></div>"+
                    "</div>");
            $(o).find(".charts-box").height(h1);
            $(o).find(".charts-box").find(".charts").height(h2);
        
        $.getTable({
            dom:$(o).find(".charts-box .c-table"),
            data:data,
            hasCheckbox:false
        }) 
                
    },
    //生成图表中tab切换
    creactTab:function(dom,tab){
        console.log(tab)
        $(dom).find(".charts-title-box").after("<div style='text-align:center;margin:10px 0' class='chart-tab-box'></div>");
        $.each(tab,function(i,item){
            $(dom).find(".chart-tab-box").append(`<span class='tab-item'>`+item+`</span>`);
        })
        $(dom).find(".chart-tab-box .tab-item").css({
            "display":"inline-block",
            "border":"1px solid #e5e5e5",
            "border-right":"none",
            "padding":"2px 15px",
            "cursor":"pointer"
        })
        $(dom).find(".chart-tab-box .tab-item").eq(tab.length-1).css("border-right","1px solid #e5e5e5")
        $(dom).find(".chart-tab-box .tab-item").eq(0).css({
            "backgroundColor":"#2a52b1",
            "color":"#fff"
        })
        $(dom).find(".chart-tab-box .tab-item").on("click",function(){
            $(this).css({
                "backgroundColor":"#2a52b1",
                "color":"#fff"
            }).siblings().css({
                "backgroundColor":"#fff",
                "color":"#333"
            })
        })
        
    },
    //生成条形统计图
    getBar:function(option){
        var _this = this;
        var dom = option.dom,
            h1 = option.h1 || 420,
            h2 = option.h2 || 400,
            title = option.title;
        this.creactCharts(dom,title,h1,h2);
        if(option.hasTab){
            console.log("111")
            _this.creactTab(dom,option.tab);
        }
        var myChart = echarts.init($(dom).find(".charts")[0]);
        console.log(option.xData)
        var _option = {
            tooltip: {
                trigger: 'axis',
                axisPointer: { // 坐标轴指示器，坐标轴触发有效
                    type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            color:option.color || _this.detailColor(),
            legend: {
                data: option.legend,
                align: 'right',
                right: 10
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: [{
                type: 'category',
                data: option.xData
            }],
            yAxis: [{
                type: 'value',
                name: option.yValue || "人数",
                axisLabel: {
                    formatter: '{value}'
                }
            }],
            series: option.yData
        };
        myChart.setOption(_option);
        $(window).on("resize",function(){
            myChart.resize();
        })
        
    },
    //生成折线图
    getLine:function(option){
        var _this = this;
        var dom = option.dom,
            h1 = option.h1 || 420,
            h2 = option.h2 || 400,
            title = option.title;
        this.creactCharts(dom,title,h1,h2);
        var myChart = echarts.init($(dom).find(".charts")[0]);
        var _option = {
            tooltip: {
                trigger: 'axis'
            },
            color:_this.detailColor(),
            legend: {
                data:option.legend,
                bottom: '10px',
            },
            grid: {
                top: option.gridTop || '60px',
                left: '3%',
                right: '4%',
                bottom: '10%',
                containLabel: true
            },
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: option.xData,
                splitLine: {
                        show: false,
                        lineStyle: {
                            // 使用深浅的间隔色
                            color: ['#aaa', '#ddd']
                        }
                    },
            },
            yAxis: {
                type: 'value',
                name: option.yValue || "人数",
                axisTick: {
                        show: false
                    },
                axisLine: {
                    show: false,
                        lineStyle: {
                            color: '#3f7fb2'
                        }
                    },
                    axisLabel: {
                        textStyle: {
                            color: '#000'
                        }
                    },
                splitLine: {
                    show: true,
                }    

            },
            series: option.yData
        };
        myChart.setOption(_option);
        $(window).on("resize",function(){
            myChart.resize();
        })

    },
    //生成饼图
    getPie:function(option){
        var _this = this;
        var dom = option.dom,
            h1 = option.h1 || 420,
            h2 = option.h2 || 400,
            title = option.title;
        this.creactCharts(dom,title,h1,h2);
        var myChart = echarts.init($(dom).find(".charts")[0]);
        var _option = {
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            color:option.color || _this.detailColor(),
            legend: {
                align: 'right',
                right: 10,
                data: option.xDatas
            },
            series : [
                {
                    name:option.title ,
                    type: 'pie',
                    radius : '55%',
                    clockwise: true,
                    roseType:option.type == "2"?"angle":"",
                    selectedMode: 'single',
                    selectedOffset: 2,
                    center: ['56%', '60%'],
                    data:option.data,
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
                //,
                // option.data2?option.data2:[],
                // option.data3?option.data3:[],
            ]
        };
        if(option.type == "3"){
            console.log("---")
            _option.series[0].radius = ['52%','56%'];
            _option.series[0].center = ['52%', '56%'];
            _option.series[0].name = option.series_name;
            for(var i = 0;i<option.data.length;i++){
                _option.series.push({
                    name:option.xDatas[i+1],
                    type: 'pie',
                    radius: [(52-(i+1)*10)+"%", (56-(i+1)*10)+"%"],
                    clockwise: true,
                    selectedMode: 'single',
                    selectedOffset: 2,
                    label: {
                        normal: {
                            position: 'inner'
                        }
                    },
                    center: ['52%', '56%'],
                    data:option.data[i],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                })
            }
            
        }
        console.log(_option)
        myChart.setOption(_option);
        $(window).on("resize",function(){
            myChart.resize();
        })
    },
    //生成嵌套环形表
    getQpie2:function(option){
        var _this = this;
        var dom = option.dom,
            h1 = option.h1 || 420,
            h2 = option.h2 || 400,
            title = option.title;
        this.creactCharts(dom,title,h1,h2);
        var myChart = echarts.init($(dom).find(".charts")[0]);
        var _option = {
            title : {
                text: option.title,
                subtext: '纯属虚构',
                x:'center'
            },
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                left: 'left',
                data: option.legend
            },
            series : [
                {
                    name: '电器类',
                    type: 'pie',
                    radius : ['5%', '10%'],
                    label: {
                        normal: {
                            position: 'inner'
                        }
                    },
                    data:[
                        {
                            value:'967',
                            name:'日常消耗品',
                        },
                        {
                            value:'2800', 
                            itemStyle: {
                                normal: {
                                    color: 'transparent'
                                }
                            }
                        }
                    ]
                },  {
                    name: '办公用品类',
                    type: 'pie',
                    radius : ['15%', '20%'],
                    data:[
                        {
                            value:'825',
                            name:'化学',
                            itemStyle: {
                                emphasis: {
                                    shadowBlur: 10,
                                    shadowOffsetX: 0,
                                    shadowColor: 'rgba(0, 0, 0, 0.5)',
                                    normal: {
                                        color: '#dc1439'
                                    }
                                }
                            }
                        },
                        {
                            value:'500', 
                            itemStyle: {
                                normal: {
                                    color: 'transparent'
                                }
                            }
                        }
                    ]
                }
            ]
        }
        myChart.setOption(_option);
        $(window).on("resize",function(){
            myChart.resize();
        })
    },
    //生成嵌套饼图
    getQpie:function(option){
        var _this = this;
        var dom = option.dom,
            h1 = option.h1 || 420,
            h2 = option.h2 || 400,
            title = option.title;
        this.creactCharts(dom,title,h1,h2);
        var myChart = echarts.init($(dom).find(".charts")[0]);
        var option_1 = {
            color:_this.detailColor(),
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {
                r: 'left',
                data:option.legend
            },
            series: [
                {
                    name:option.series_name_1,
                    type:'pie',
                    selectedMode: 'single',
                    radius: [0, '30%'],
        
                    label: {
                        normal: {
                            position: 'inner'
                        }
                    },
                    labelLine: {
                        normal: {
                            show: false
                        }
                    },
                    data:option.data1
                },
                {
                    name:option.series_name_2,
                    type:'pie',
                    radius: ['40%', '55%'],
        
                    data:option.data2
                }
            ]
        }
        myChart.setOption(option_1);
        $(window).on("resize",function(){
            myChart.resize();
        })
    },
    //生成地图图表
    getMap:function(option){
        var _this = this;
        var dom = option.dom,
            h1 = option.h1 || 420,
            h2 = option.h2 || 400,
            title = option.title;
        this.creactCharts(dom,title,h1,h2);
        var myChart = echarts.init($(dom).find(".charts")[0]);
        var _option ={
            title: {
                text: option.title,
                x: 'center'
            },
            tooltip: {
                trigger: 'item'
            },
            dataRange: {
                min: 0,
                max: 500,
                x: 'left',
                y: 'bottom',
        
                text: ['高', '低'], // 文本，默认为数值文本
                calculable: false,
        
                splitNumber: 0,
        
        
                color: ["#fe3a00","#ec6941","#e7cec6","#fff"]
            },
            toolbox: {
                show: true,
                orient: 'vertical',
                x: 'right',
                y: 'center',
                feature: {
                    mark: {
                        show: true
                    },
                    dataView: {
                        show: true,
                        readOnly: false
                    },
                    dataZoom: {
                        show: true
                    },
                    restore: {
                        show: true
                    },
                    saveAsImage: {
                        show: true
                    }
                }
            },
            roamController: {
                show: true,
                x: 'right',
                mapTypeControl: {
                    'china': true
                }
            },
            series: [{
                name: '人数',
                type: 'map',
                mapType: 'china',
                roam: false,
                itemStyle: {
                    normal: {
                        label: {
                            show: true
                        }
                    },
                    emphasis: {
                        label: {
                            show: true
                        }
                    }
                },
                data: option.data
            }]
        };
        myChart.setOption(_option);
        $(window).on("resize",function(){
            myChart.resize();
        })
    },
    //生成两个表（bar,pie）
    getBarPie:function(option){
        var _this = this;
        var dom = option.dom,
            h1 = option.h1,
            h2 = option.h2,
            title = option.title;
        this.creactDCharts(dom,title,h1,h2);
        var myChart_1 = echarts.init($(dom).find(".charts-1")[0]);
        var option_1 = {
            color: ['#3398DB'],
            "backgroundColor": "#fff",
            tooltip : {
                trigger: 'axis',
                axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                    type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis : [
                {
                    type : 'category',
                    data : option.barData.xData,
                    axisTick: {
                        alignWithLabel: true
                    }
                }
            ],
            yAxis : [
                {
                    type : 'value'
                }
            ],
            series : [
                {
                    name:'',
                    type:'bar',
                    barWidth: '30',
                    data:option.barData.yData,
                    itemStyle: {
                        normal: {
                            color: function(params) {
                                // build a color map as your need.
                                var colorList = _this.detailColor();
                                return colorList[params.dataIndex]
                            },
                            label: {
                                show: false,
                                position: 'top',
                                formatter: '{c}%'
                            }
                        }
                    }
                }
            ]
        }
        myChart_1.setOption(option_1);
        var myChart_2 = echarts.init($(dom).find(".charts-2")[0]);
        var option_2 = {
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            color:_this.detailColor(),
            legend: {
                align: 'right',
                right: 10,
                data: option.pieData.xData
            },
            series : [
                {
                    name:option.title ,
                    type: 'pie',
                    radius : '55%',
                    clockwise: true,
                    roseType:option.pieData.type == "2"?"angle":"",
                    selectedMode: 'single',
                    selectedOffset: 2,
                    center: ['56%', '60%'],
                    data:option.pieData.data,
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        }
        myChart_2.setOption(option_2);
        $(window).on("resize",function(){
            myChart_1.resize();
            myChart_2.resize();
        })
        
    },
    //生成bar,table
    getBarTable:function(option){
        var _this = this;
        var dom = option.dom,
            h1 = option.h1,
            h2 = option.h2,
            tableData = option.tableData,
            title = option.title;
        this.creactBarTable(dom,title,h1,h2,tableData);
        var myChart_1 = echarts.init($(dom).find(".charts")[0]);
        console.log(option.barData.yData)
        var _option = {
            tooltip: {
                trigger: 'axis',
                axisPointer: { // 坐标轴指示器，坐标轴触发有效
                    type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            color:_this.detailColor(),
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: [{
                type: 'category',
                data: option.barData.xData
            }],
            yAxis: [{
                type: 'value',
                axisLabel: {
                    formatter: '{value}'
                }
            }],
            series: option.barData.yData
        }
        myChart_1.setOption(_option)
        $(window).on("resize",function(){
            myChart_1.resize();
        })
    },
    //生成一个堆叠bar和一个pie
    getPBarPie:function(option){
        var _this = this;
        var dom = option.dom,
            h1 = option.h1,
            h2 = option.h2,
            tableData = option.tableData,
            title = option.title;
        this.creactDCharts(dom,title,h1,h2);
        var myChart_1 = echarts.init($(dom).find(".charts-1")[0]);
        var myChart_2 = echarts.init($(dom).find(".charts-2")[0]);
        var option_1 = {
            color:option.color || _this.detailColor(),
            tooltip: {
                trigger: 'axis',
                axisPointer: { // 坐标轴指示器，坐标轴触发有效
                    type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            legend: {
                data: option.data1.legend
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: [{
                type: 'category',
                data: option.data1.xData
            }],
            yAxis: [{
                type: 'value',
                name: option.yValue || '',
            }],
            series: option.data1.yData
        }
        var option_2 = {
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            color:_this.detailColor(),
            legend: {
                align: 'right',
                right: 10,
                data: option.data2.xData
            },
            series : [
                {
                    name:title ,
                    type: 'pie',
                    radius : '55%',
                    clockwise: true,
                    roseType:option.type == "2"?"angle":"",
                    selectedMode: 'single',
                    selectedOffset: 2,
                    center: ['56%', '60%'],
                    data:option.data2.data,
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
                //,
                // option.data2?option.data2:[],
                // option.data3?option.data3:[],
            ]
        }
        if(option.type == "3"){
            option_2.series[0].radius = ['52%','62%'];
            option_2.series[0].center = ['52%', '56%'];
            option_2.series[0].name = option.data2.series_name;
            for(var i = 0;i<option.data2.data.length;i++){
                option_2.series.push({
                    name:option.data2.xData[i+1],
                    type: 'pie',
                    radius: [(52-(i+1)*10)+"%", (66-(i+1)*10)+"%"],
                    clockwise: true,
                    selectedMode: 'single',
                    selectedOffset: 2,
                    label: {
                        normal: {
                            position: 'inner'
                        }
                    },
                    center: ['52%', '56%'],
                    data:option.data2.data[i],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                })
            }
        }
        myChart_1.setOption(option_1);
        myChart_2.setOption(option_2)
        $(window).on("resize",function(){
            myChart_1.resize();
            myChart_2.resize();
        })
        
    },
    //生成barLine,table
    getBarLineTable:function(option){
        var _this = this;
        var dom = option.dom,
            h1 = option.h1,
            h2 = option.h2,
            tableData = option.tableData,
            title = option.title;
        this.creactBarTable(dom,title,h1,h2,tableData);
        var myChart_1 = echarts.init($(dom).find(".charts")[0]);
        var option_1 = {
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'cross',
                    crossStyle: {
                        color: '#999'
                    }
                }
            },
            color:_this.detailColor(),
            legend: {
                data:['人数','金额']
            },
            xAxis: [
                {
                    type: 'category',
                    data: option.xData,
                    axisPointer: {
                        type: 'shadow'
                    }
                }
            ],
            yAxis: [
                {
                    type: 'value',
                    name:option.barLineData.yData[0].name,
                },
                {
                    type: 'value',
                    name: option.barLineData.yData[1].name,
                }
            ],
            series: option.barLineData.yData
        };
        myChart_1.setOption(option_1);
        $(window).on("resize",function(){
            myChart_1.resize();
        })
        
    },
    getBarLine:function(option){
        var _this = this;
        var dom = option.dom,
            h1 = option.h1,
            h2 = option.h2,
            tableData = option.tableData,
            title = option.title;
            this.creactCharts(dom,title,h1,h2);
            var myChart_1 = echarts.init($(dom).find(".charts")[0]);
            var option_1 = {
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross',
                        crossStyle: {
                            color: '#999'
                        }
                    }
                },
                color:_this.detailColor(),
                legend: {
                    data:['人数','金额']
                },
                xAxis: [
                    {
                        type: 'category',
                        data: option.xData,
                        axisPointer: {
                            type: 'shadow'
                        }
                    }
                ],
                yAxis: [
                    {
                        type: 'value',
                        name:option.yData[0].name,
                    },
                    {
                        type: 'value',
                        name: option.yData[1].name,
                    }
                ],
                series: option.yData
            };
            myChart_1.setOption(option_1);
            $(window).on("resize",function(){
                myChart_1.resize();
            })
        
    },
    getDPie:function(option){
        var _this = this;
        var dom = option.dom,
        h1 = option.h1,
        h2 = option.h2,
        data_1 = option.data_1,
        data_2 = option.data_2,
        title = option.title;
        this.creactDCharts(dom,title,h1,h2);
        var myChart_1 = echarts.init($(dom).find(".charts-1")[0]);
        var myChart_2 = echarts.init($(dom).find(".charts-2")[0]);
        var option_1 = {
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            color:_this.detailColor(),
            legend: {
                align: 'right',
                right: 10,
                data: option.xDatas
            },
            series : [
                {
                    name:title ,
                    type: 'pie',
                    radius : '55%',
                    clockwise: true,
                    roseType:option.type == "2"?"angle":"",
                    selectedMode: 'single',
                    selectedOffset: 2,
                    center: ['56%', '60%'],
                    data:option.data_1,
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
                //,
                // option.data2?option.data2:[],
                // option.data3?option.data3:[],
            ]
        };
        var option_2 = {
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            color:_this.detailColor(),
            legend: {
                align: 'right',
                right: 10,
                data: option.xDatas_2
            },
            series : [
                {
                    name:title ,
                    type: 'pie',
                    radius : '55%',
                    clockwise: true,
                    roseType:option.type == "2"?"angle":"",
                    selectedMode: 'single',
                    selectedOffset: 2,
                    center: ['56%', '60%'],
                    data:option.data_2,
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
                //,
                // option.data2?option.data2:[],
                // option.data3?option.data3:[],
            ]
        };
        if(option.type == "3"){
            option_2.series[0].radius = ['52%','62%'];
            option_2.series[0].center = ['52%', '56%'];
            option_2.series[0].name = option.series_name_2;
            for(var i = 0;i<data_2.length;i++){
                option_2.series.push({
                    name:option.xData_2[i+1],
                    type: 'pie',
                    radius: [(52-(i+1)*10)+"%", (66-(i+1)*10)+"%"],
                    clockwise: true,
                    selectedMode: 'single',
                    selectedOffset: 2,
                    label: {
                        normal: {
                            position: 'inner'
                        }
                    },
                    center: ['52%', '56%'],
                    data:option.data_2[i],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                })
            }
            option_1.series[0].radius = ['52%','62%'];
            option_1.series[0].center = ['52%', '56%'];
            option_1.series[0].name = option.series_name_1;
            for(var i = 0;i<data_1.length;i++){
                option_1.series.push({
                    name:option.xData[i+1],
                    type: 'pie',
                    radius: [(52-(i+1)*10)+"%", (66-(i+1)*10)+"%"],
                    clockwise: true,
                    selectedMode: 'single',
                    selectedOffset: 2,
                    label: {
                        normal: {
                            position: 'inner'
                        }
                    },
                    center: ['52%', '56%'],
                    data:option.data_2[i],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                })
            }
        }
        myChart_1.setOption(option_1);
        myChart_2.setOption(option_2);
        $(window).on("resize",function(){
            myChart_1.resize();
        })
    },
    getTPie:function(option){
        var _this = this;
        var dom = option.dom,
        h1 = option.h1,
        h2 = option.h2,
        data1 = option.data1,
        data2 = option.data2,
        data3 = option.data3,
        title = option.title;
        this.creactTCharts(dom,title,h1,h2);
        var myChart_1 = echarts.init($(dom).find(".charts-1")[0]);
        var myChart_2 = echarts.init($(dom).find(".charts-2")[0]);
        var myChart_3 = echarts.init($(dom).find(".charts-3")[0]);
        var option_1 = {
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            color:_this.detailColor(),
            series : [
                {
                    name:title,
                    type: 'pie',
                    radius : '55%',
                    clockwise: true,
                    roseType:option.type == "2"?"angle":"",
                    selectedMode: 'single',
                    selectedOffset: 2,
                    center: ['56%', '60%'],
                    data:option.data1,
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
                //,
                // option.data2?option.data2:[],
                // option.data3?option.data3:[],
            ]
        };
        var option_3 = {
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            color:_this.detailColor(),
            legend: {
                align: 'right',
                right: 10,
                data: option.xData3
            },
            series : [
                {
                    name:title ,
                    type: 'pie',
                    radius : '55%',
                    clockwise: true,
                    roseType:option.type == "2"?"angle":"",
                    selectedMode: 'single',
                    selectedOffset: 2,
                    center: ['56%', '60%'],
                    data:option.data3,
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
                //,
                // option.data2?option.data2:[],
                // option.data3?option.data3:[],
            ]
        };
        if(option.type == "3"){
            option_3.series[0].radius = ['52%','62%'];
            option_3.series[0].center = ['52%', '56%'];
            option_3.series[0].name = option.series_name_3;
            for(var i = 0;i<data3.length;i++){
                option_3.series.push({
                    name:option.xData3[i+1],
                    type: 'pie',
                    radius: [(52-(i+1)*10)+"%", (66-(i+1)*10)+"%"],
                    clockwise: true,
                    selectedMode: 'single',
                    selectedOffset: 2,
                    label: {
                        normal: {
                            position: 'inner'
                        }
                    },
                    center: ['52%', '56%'],
                    data:option.data3[i],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                })
            }
            option_1.series[0].radius = ['52%','62%'];
            option_1.series[0].center = ['52%', '56%'];
            option_1.series[0].name = option.series_name_1;
            for(var i = 0;i<data1.length;i++){
                option_1.series.push({
                    name:option.xData1[i+1],
                    type: 'pie',
                    radius: [(52-(i+1)*10)+"%", (66-(i+1)*10)+"%"],
                    clockwise: true,
                    selectedMode: 'single',
                    selectedOffset: 2,
                    label: {
                        normal: {
                            position: 'inner'
                        }
                    },
                    center: ['52%', '56%'],
                    data:option.data1[i],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                })
            }
        }
        var option_2 = {
            title: {
                text: ''
            },
            tooltip: {},
            radar: {
                // shape: 'circle',
                indicator:option.xData2
            },
            series: [{
                name: '',
                type: 'radar',
                // areaStyle: {normal: {}},
                data: [{
                    value: option.data2,
                    name: ''
                }]
            }]
        }
        myChart_1.setOption(option_1);
        myChart_2.setOption(option_2);
        myChart_3.setOption(option_3);
        $(window).on("resize",function(){
            myChart_1.resize();
            myChart_2.resize();
            myChart_3.resize();
        })
    },
    getPBar:function(option){
        var _this = this;
        var dom = option.dom,
        h1 = option.h1,
        h2 = option.h2,
        title = option.title;
        this.creactCharts(dom,title,h1,h2);
        var myChart_1 = echarts.init($(dom).find(".charts")[0]);
        var option_1 = {
            color:_this.detailColor(),
            tooltip: {
                trigger: 'axis',
                axisPointer: { // 坐标轴指示器，坐标轴触发有效
                    type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            legend: {
                data: option.legend
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: [{
                type: 'category',
                data: option.xData
            }],
            yAxis: [{
                type: 'value',
                name:"元"
            }],
            series:option.data
        }
        myChart_1.setOption(option_1);
        $(window).on("resize",function(){
            myChart_1.resize();
        })
    },
    getPBarLine:function(option){
        var _this = this;
        var dom = option.dom,
        h1 = option.h1,
        h2 = option.h2,
        title = option.title;
        this.creactCharts(dom,title,h1,h2);
        var myChart_1 = echarts.init($(dom).find(".charts")[0]);
        var option = {
            color:_this.detailColor(),
            tooltip: {
                trigger: 'axis',
                axisPointer: { // 坐标轴指示器，坐标轴触发有效
                    type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            legend: {
                data: option.legend
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: [{
                type: 'category',
                data: option.xData
            }],
            yAxis: [{
                type: 'value',
                name:"元"
            }],
            series:option.data
        }
        myChart_1.setOption(option);
        $(window).on("resize",function(){
            myChart_1.resize();
        })
    },
    getHandstandBar:function(option) {
        var _this = this;
        var dom = option.dom,
        h1 = option.h1 || 820,
        h2 = option.h2 || 800,
        title = option.title;
        this.creactCharts(dom,title,h1,h2);
        var myChart_1 = echarts.init($(dom).find(".charts")[0]);
        var option = {
            legend: {
                show: false,
                data: option.legend,
                align: 'left',
                left: 10
            },
            color:option.color || _this.detailColor(),
            tooltip: {},
            xAxis: {
                data: option.xData,
                name: '',
                silent: true,
                axisLine: {onZero: true},
                splitLine: {show: false},
                splitArea: {show: false}
            },
            yAxis: {
                inverse: true,
                splitArea: {show: false}
            },
            grid: {
                left: 100
            },
            series: option.yData
        };
        myChart_1.setOption(option);
        $(window).on("resize",function(){
            myChart_1.resize();
        })
    },
    getAroundBar:function(option) {
        var _this = this;
        var dom = option.dom,
        h1 = option.h1 || 820,
        h2 = option.h2 || 800,
        title = option.title;
        this.creactCharts(dom,title,h1,h2);
        var myChart_1 = echarts.init($(dom).find(".charts")[0]);
        var option = {
            legend: {
                show: true,
                data: option.legend || [],
                left: 'center',
                bottom: '0',
            },
            color:_this.detailColor(),
            tooltip: {},
            xAxis: {
                type: 'value',
            },
            yAxis: [
                {
                    type : 'category',
                    axisTick : {show: false},
                    data : option.xData,
                }
            ],
            grid: {
                left: 100
            },
            series: option.yData
        };
        myChart_1.setOption(option);
        $(window).on("resize",function(){
            myChart_1.resize();
        })
    },
    getHBar:function(option) {
        var _this = this;
        var dom = option.dom,
        h1 = option.h1 || 420,
        h2 = option.h2 || 400,
        title = option.title;
        this.creactCharts(dom,title,h1,h2);
        var myChart_1 = echarts.init($(dom).find(".charts")[0]);
        var option = {
            tooltip : {
                trigger: 'axis',
                axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                    type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            legend: {
                data: option.legend,
                bottom: '10px',
            },
            color: ['#F34334', '#438AFE', '#6EC694', '#DBE548', '#FFC750'],
            grid: {
                top: '3%',
                left: '3%',
                right: '4%',
                bottom: '10%',
                containLabel: true
            },
            xAxis:  {
                type: 'value'
            },
            yAxis: {
                type: 'category',
                data: option.yData,
            },
            series: option.xData,
        };
        myChart_1.setOption(option);
        $(window).on("resize",function(){
            myChart_1.resize();
        })
    },
}