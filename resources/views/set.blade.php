@extends('layouts.app')
@section('header')
<link rel="stylesheet" href="{{ asset('datacenter/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datacenter/css/layout.css') }}">
@endsection
@section('body')
<div style="padding: 15px;">
    <div class='route-box'>
        <span class='icon icon-position'></span>
        <span class='title'>当前位置：</span>
        <span>预警信息</span>
        <span>></span>
        <span><a href="javascript:;">预警设置</a></span>
    </div>
    <hr class="line">
    <div class="filter">
        <a href="javascript:;" onclick="addItem();" class="btn btn-warning pull-right" >添加</a>
    </div>
    <div class="table-content table-responsive text-center">
        <table class="table">
            <tbody><tr>
                <td>预警名称</td>
                <td>预警类型</td>
                <td>预警指标</td>
                <td>预警生效时间</td>
                <td>预警状态</td>
                <td>操作</td>
            </tr>
            <tr>
                <td>低分预警</td>
                <td>学生基础分析</td>
                <td>违纪处分</td>
                <td>2019年2月21日  16：00</td>
                <td>
                    <div class="checkBox">
                        <input type="checkbox" checked>
                        <label></label>
                    </div>
                </td>
                <td><a href="">修改</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="">删除</a></td>
            </tr>
            <tr>
                <td>低分预警</td>
                <td>学生基础分析</td>
                <td>违纪处分</td>
                <td>2019年2月21日  16：00</td>
                <td>
                    <div class="checkBox">
                        <input type="checkbox">
                        <label></label>
                    </div>
                </td>
                <td><a href="">修改</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="">删除</a></td>
            </tr>
            <tr>
                <td>低分预警</td>
                <td>学生基础分析</td>
                <td>违纪处分</td>
                <td>2019年2月21日  16：00</td>
                <td>
                    <div class="checkBox">
                        <input type="checkbox" checked>
                        <label></label>
                    </div>
                </td>
                <td><a href="">修改</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="">删除</a></td>
            </tr>
            </tbody></table>
    </div>
    <div class="total-pages pull-left"><span>共3158条记录</span></div>
    <nav aria-label="Page navigation" class="pages pull-right">
        <ul class="pagination">
            <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">上一页</span>
                </a>
            </li>
            <li><a href="#">1</a></li>
            <li><a href="#">...</a></li>
            <li class="active"><a href="#">5</a></li>
            <li><a href="#">6</a></li>
            <li><a href="#">7</a></li>
            <li><a href="#">...</a></li>
            <li><a href="#">27</a></li>
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">下一页</span>
                </a>
            </li>
        </ul>
        <input class="form-control" type="text" value="">
        <button type="button" class="btn btn-primary">跳转</button>
    </nav>
</div>
@endsection
@section('footer')
<script type="text/javascript">
    function addItem(id) {
        layer.open({
            id: 'insert-form',
            type: 1, // 页面层
            title: '新建预警',
            maxmin: false,
            area: ['580px' , '320px'],
            scrollbar: false, //禁止浏览器滚动
            content: $('#layerContentId'),
            btn: ['确定', '取消'],
            btnAlign: 'c',
            end:function(){
                $("#layerContentId").hide();
            },
            yes: function(index, layero) {

            }
            /*,btn2: function(index, layero) {
            //按钮【按钮二】的回调
            }*/

            ,cancel: function(){
                //右上角关闭回调

                //return false 开启该代码可禁止点击该按钮关闭
            }
        });
    }
</script>
@endsection