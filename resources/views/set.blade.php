@extends('layouts.app')
@section('header')
<link rel="stylesheet" href="{{ asset('datacenter/css/layout.css') }}">
<link rel="stylesheet" href="{{ asset('datacenter/css/bootstrap.min.css') }}">
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
                <!-- <td>预警状态</td> -->
                <td>操作</td>
            </tr>
            @foreach ($data as $vo)
            <tr>
                <td>{{$vo->name}}</td>
                <td>{{$vo->yj}}</td>
                <td>{{$vo->jk}}</td>
                <td>{{$vo->time}}</td>
                <!-- <td>
                    <div class="checkBox">
                        <input type="checkbox" checked>
                        <label></label>
                    </div>
                </td> -->
                <td><a style="cursor:pointer;" class="edit" data-id="{{$vo->id}}">修改</a>&nbsp;&nbsp;&nbsp;&nbsp;<a style="cursor:pointer" class="delete" data-id="{{$vo->id}}" >删除</a></td>
            </tr>
            @endforeach
            </tbody></table>
    </div>
    {{ $data->links() }}
    <!-- <div class="total-pages pull-left"><span>共3158条记录</span></div>
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
    </nav> -->
</div>
</div>
		</div>
	</div>
	<div id="layerContentId" style="display: none;padding: 20px 0">
		<div class="filter-group" style="width: 100%;">
			<div class="filter-items" style="width: 100%;">
				<div class="filter-title">
					<span>预警名称：</span>
				</div>
				<div class="filter-content" style="width: calc(100% - 130px);">
					<input class="form-control name" type="text" name="" placeholder="请输入位置" style="width: 100%;">
				</div>
			</div>
		</div>

		<div class="filter-group" style="width: 100%;">
			<div class="filter-items" style="width: 100%;">
				<div class="filter-title">
					<span>预警类型：</span>
				</div>
				<div class="filter-content" style="width: calc(100% - 130px);">
					<select class="form-control yj" style="width: 100%;">
                        <option value="" selected="">请选择</option>
                        <option value="学生基础分析">学生基础分析</option>
                        <option value="教职工基础分析">教职工基础分析</option>
                        <option value="学生费用分析">学生费用分析</option>
                        <option value="资产基础分析">资产基础分析</option>
                        <option value="考勤出勤分析">考勤出勤分析</option>
                        <option value="教学基础分析">教学基础分析</option>
                        <option value="一卡通消费分析">一卡通消费分析</option>
					</select>
				</div>
			</div>
		</div>

		<div class="filter-group" style="width: 100%;">
			<div class="filter-items" style="width: 100%;">
				<div class="filter-title">
					<span>选择监控指标：</span>
				</div>
				<div class="filter-content" style="width: calc(100% - 130px);">
					<select class="form-control jk" style="width: 100%;">
						<option value="" selected="">请选择</option>
					</select>
				</div>
			</div>
		</div>

		<div class="filter-group" style="width: 100%;">
			<div class="filter-items" style="width: 100%;">
				<div class="filter-title">
					<span>预警设置：</span>
				</div>
				<div class="filter-content" style="width: calc(100% - 130px);">
					当指标&nbsp;&nbsp;
					<select class="form-control zb" style="width: 25%;">
                        <option value="大于">大于</option>
                        <option value="等于">等于</option>
                        <option value="小于">小于</option>
					</select>&nbsp;&nbsp;
					<input class="form-control tm" type="text" name="" placeholder="请输入数值" style="width: 30%;">&nbsp;&nbsp;次，则预警
				</div>
			</div>
		</div>
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
            area: ['700px' , '420px'],
            scrollbar: false, //禁止浏览器滚动
            content: $('#layerContentId'),
            btn: ['确定', '取消'],
            btnAlign: 'c',
            end:function(){
                $("#layerContentId").hide();
            },
            yes: function(index, layero) {
                var name = $('.name').val();
                var yj   = $('.yj').val();
                var jk   = $('.jk').val();
                var zb   = $('.zb').val();
                var tm   = $('.tm').val();
                $.ajax({
                    type: "GET",
                    url: "/addset",
                    data: {"name":name,"yj":yj,"jk":jk,"zb":zb,"tm":tm},
                    success: function(data){
                        layer.msg('提交成功',{icon: 1,time:2000});
                        setTimeout(function(){ 
                            window.location.reload();
                        }, 2000);
                    }
                });
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
    $(".edit").on("click",function(){
            var id = $(this).attr('data-id');
            layer.open({
                type: 2,
                title: '编辑',
                area: ['700px', '420px'],
                resize:false,
                content: "/editset?id="+id,
                // btn: ['确定', '取消'],
                btnAlign: 'c',
                yes: function(index, layero) {
                // var name = $(parent).find('.name1').val();
                // var yj   = $('.yj1').val();
                // var jk   = $('.jk1').val();
                // var zb   = $('.zb1').val();
                // var tm   = $('.tm1').val();
                // $.ajax({
                //     type: "GET",
                //     url: "/addset",
                //     data: {"name":name,"yj":yj,"jk":jk,"zb":zb,"tm":tm},
                //     success: function(data){
                //         layer.msg('提交成功',{icon: 1,time:2000});
                //         setTimeout(function(){ 
                //             window.location.reload();
                //         }, 2000);
                //     }
                // });
            }
            });
        });
    $('.delete').click(function(){
        var id = $(this).attr('data-id');
        layer.confirm('确定删除日志吗？', {
        btn: ['确定','取消'] //按钮
        }, function(){
            $.ajax({
                type: "get",
                url: "/deleteset",
                data: {"id":id},
                success: function(data){
                    // if(data.code == 200){
                    //     layer.msg('删除成功',{icon: 1,time:2000});
                    //     setTimeout(function(){ 
                    //     window.location.reload();
                    // }, 2000);         
                    // }else{
                    //     layer.msg(data.msg,{icon: 2,time:2000});
                    // }
                    layer.msg('删除成功',{icon: 1,time:2000});
                    setTimeout(function(){ 
                        window.location.reload();
                    }, 2000);
                }
            });
        },function(){
            layer.closeAll();
        });
    })
    $('.yj').change(function(){
        $('.jk').children().remove();
        
        var value = $(this).val();
        if(value == ''){
            $('.jk').append('<option value="" selected="">请选择</option>');
        }else if(value == '学生基础分析'){
            $('.jk').append('<option value="违纪处分" >违纪处分</option>');
        }else if(value == '教职工基础分析'){
            $('.jk').append('<option value="评价分数" >评价分数</option>');
        }else if(value == '学生费用分析'){
            $('.jk').append('<option value="欠费总额" >欠费总额</option>');
        }else if(value == '资产基础分析'){
            $('.jk').append('<option value="单类维修次数" >单类维修次数</option>');
        }else if(value == '考勤出勤分析'){
            $('.jk').append('<option value="缺勤人数" >缺勤人数</option>');
            $('.jk').append('<option value="迟到人数" >迟到人数</option>');
        }else if(value == '教学基础分析'){
            $('.jk').append('<option value="总分均分" >总分均分</option>');
        }else if(value == '一卡通消费分析'){
            $('.jk').append('<option value="消费总额" >消费总额</option>');
        }
    })
</script>
@endsection