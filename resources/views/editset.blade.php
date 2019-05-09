
<link rel="stylesheet" href="{{ asset('datacenter/css/layout.css') }}">
<link rel="stylesheet" href="{{ asset('datacenter/css/bootstrap.min.css') }}">
<div id="layerContentId" style="padding: 20px 0">
		<div class="filter-group" style="width: 100%;">
			<div class="filter-items" style="width: 100%;">
				<div class="filter-title">
					<span>预警名称：</span>
				</div>
				<div class="filter-content" style="width: calc(100% - 130px);">
					<input value="{{$data->name}}" class="form-control name" type="text" name="" placeholder="请输入位置" style="width: 100%;">
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
                        <option value="">请选择</option>
                        <option value="学生基础分析" @if ($data->yj == '学生基础分析') selected="" @endif>学生基础分析</option>
                        <option value="教职工基础分析" @if ($data->yj == '教职工基础分析') selected="" @endif>教职工基础分析</option>
                        <option value="学生费用分析" @if ($data->yj == '学生费用分析') selected="" @endif>学生费用分析</option>
                        <option value="资产基础分析" @if ($data->yj == '资产基础分析') selected="" @endif>资产基础分析</option>
                        <option value="考勤出勤分析" @if ($data->yj == '考勤出勤分析') selected="" @endif>考勤出勤分析</option>
                        <option value="教学基础分析" @if ($data->yj == '教学基础分析') selected="" @endif>教学基础分析</option>
                        <option value="一卡通消费分析" @if ($data->yj == '一卡通消费分析') selected="" @endif>一卡通消费分析</option>
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
						<option value="{{$data->jk}}" selected="">{{$data->jk}}</option>
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
                        <option @if ($data->zb == '大于') selected="" @endif value="大于">大于</option>
                        <option @if ($data->zb == '等于') selected="" @endif value="等于">等于</option>
                        <option @if ($data->zb == '小于') selected="" @endif value="小于">小于</option>
					</select>&nbsp;&nbsp;
					<input value="{{$data->tm}}" class="form-control tm" type="text" name="" placeholder="请输入数值" style="width: 30%;">&nbsp;&nbsp;次，则预警
				</div>
			</div>
        </div>
        <div class="layui-layer-btn layui-layer-btn-c">
            <a style="margin-top:40px;" class="layui-layer-btn0">确定</a>
            <a style="margin-top:40px;" class="layui-layer-btn1">取消</a>
        </div>
    </div>
<script src="{{ asset('datacenter/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('datacenter/js/layui/layui.all.js') }}"></script>
<script type="text/javascript">
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
$('.layui-layer-btn0').click(function(){
    var name = $('.name').val();
    var yj   = $('.yj').val();
    var jk   = $('.jk').val();
    var zb   = $('.zb').val();
    var tm   = $('.tm').val();
    var id   = {{$data->id}};
    $.ajax({
        type: "GET",
        url: "/updateset",
        data: {"id":id,"name":name,"yj":yj,"jk":jk,"zb":zb,"tm":tm},
        success: function(data){
            layer.msg('提交成功',{icon: 1,time:2000});
            setTimeout(function(){ 
                window.parent.layer.closeAll();
                parent.location.href="/set";
            }, 2000);
        }
    });
})
$('.layui-layer-btn1').click(function(){
    window.parent.layer.closeAll();
})
</script>