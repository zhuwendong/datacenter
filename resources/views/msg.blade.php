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
        <span><a href="javascript:;">预警消息</a></span>
    </div>
    <hr class="line">
    <div class="filter">
        <button type="button" class="btn btn-danger pull-right">删除</button>
    </div>
    <div class="table-content table-responsive text-center">
        <table class="table">
            <tbody><tr>
                <td width="10%">
                    <input type="checkbox" value="">
                </td>
                <td>预警类型</td>
                <td>预警指标</td>
                <td>预警内容</td>
                <td>预警时间</td>
                <td>操作</td>
            </tr>
            <tr>
                <td width="10%">
                    <input type="checkbox" value="" checked="">
                </td>
                <td>教职工基础分析</td>
                <td>评价分数</td>
                <td>评价分数小于60分</td>
                <td>2019年2月21日  16：00</td>
                <td><a href="">删除</a></td>
            </tr>
            <tr>
                <td width="10%">
                    <input type="checkbox" value="">
                </td>
                <td>教职工基础分析</td>
                <td>评价分数</td>
                <td>评价分数小于60分</td>
                <td>2019年2月21日  16：00</td>
                <td><a href="">删除</a></td>
            </tr>
            <tr>
                <td width="10%">
                    <input type="checkbox" value="">
                </td>
                <td>教职工基础分析</td>
                <td>评价分数</td>
                <td>评价分数小于60分</td>
                <td>2019年2月21日  16：00</td>
                <td><a href="">删除</a></td>
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
@endsection