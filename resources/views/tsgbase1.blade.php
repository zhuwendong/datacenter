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
    <a href="/tsgbase1"><span class="tab-item on">投入占比</span></a>
    <a href="/tsgbase2"><span class="tab-item">借书高峰分析</span></a>
</div>
<form>
    <div style="margin-top: 20px;padding-left: 10px;">
        <!-- <label for="">校区：</label>
        <select class='ipt ipt-xs' name="campus" id="">
            <option value="">请选择</option>
            @foreach ($campus as $vo)
                <option @isset($_REQUEST["campus"]) @if ($_REQUEST["campus"] == 1) selected @endif @endisset value="{{ $vo->cp_id }}">{{ $vo->cp_name }}</option>
            @endforeach
        </select> -->
        <label for="">学年：</label>
        <select id="syear" class='ipt ipt-xs' name="year" id="">
            <option value="">请选择</option>
            @foreach ($year as $vo)
            <option @isset($_REQUEST["year"]) @if ($_REQUEST["year"] == $vo->sy_id) selected @endif @endisset value="{{ $vo->sy_id }}">{{ $vo->sy_name }}</option>
            @endforeach
        </select>
        <label for="">学期：</label>
        <select id="semester" class='ipt ipt-xs' name="semester" id="">
            <option value="">请选择</option>
            @foreach ($semesters as $vo)
            <option @isset($_REQUEST["semester"]) @if ($_REQUEST["semester"] == $vo->se_id) selected @endif @endisset value="{{ $vo->se_id }}">@if ($vo->se_cid == 1)第一学期 @else第二学期@endif</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-info">查询</button>
    </div>
</form>
<hr/>
<div class='charts-container clearfix'>
    <div style='width:54%;' class='charts-1 p-l'></div>
    <div style='width:44%;' class='charts-2 p-r'></div>
</div>
</div>
@endsection
@section('footer')
<script>   
	var Charts = new Charts();
    read();
function read(){
    $.ajax({
        type: "get",
        url:"{{$url}}/OPAC.ashx?op=getSubjectCategoryStatistics&beginDate={{ $time1 }}&endDate={{ $time2 }}",
        data: {},
        dataType: "json",
        success: function(data){
            if(data.ok == true){
                var arr = new Array();
                var arr1 = new Array();
                var arr2 = new Array();
                for(var i=0;i<data.list.length;i++){
                    arr.push(data.list[i].学科类目);
                    arr1.push(data.list[i].金额);
                    arr2.push({
                        value: data.list[i].册数,
                        name: data.list[i].学科类目,
                        selected: true
                    });
                }

                Charts.getBar({
                    dom:".charts-1",
                    title:"投入占比（总投入额："+data.总金额+"元）",
                    yValue:"   （投入资金：万元）",
                    xData:arr,
                    yData:[{
                        type: 'bar',
                        data: arr1,
                        barWidth:'40',
                        itemStyle: {
                            normal: {
                                color: function(params) {
                                    var colorList = ['#438AFE', '#EE4233', '#6DC593', '#DBE548', '#FFC750'];
                                    return colorList[params.dataIndex];
                                },
                            },	
                        },     
                    }]
                });

                Charts.getPie({
                    title:"类别册数占比",
                    dom:".charts-2",
                    color:['#438AFE','#F34334','#67C996','#DAE648','#FEC84E'],
                    type:"3",
                    xDatas: [],
                    data:arr2
                });
                // Charts.getPie({
                //     title:"机构借书占比",
                //     dom:".charts-1",
                //     type:"1",
                //     xDatas:['一号宿舍楼','二号宿舍楼','三号宿舍楼'],
                //     data:arr
                // });
            }else{
                
            }
        }
    });
}
</script>
<script>
    //ajax获取学期
	$("select#syear").change(function(){
	    var semester=document.getElementById('semester');
        var id=$("#syear option:selected").val();
        $.ajax({
          url:"/getsemester",
          data:{id:id},
          async:false,
          success:function(res) {
			//  console.log(res.data);
            $("#semester").empty();
            semester.options.add(new Option("请选择",' '));
            $.each(res.data, function(i, item){     
            if(item.se_cid == 1){
                    // semester.append('<option value='"+item.se_id+"'>第一学期</option>');
                semester.options.add(new Option("第一学期",item.se_id)); 
                }else{
                    // semester.append('<option value='"+item.se_id+"'>第二学期</option>');
                semester.options.add(new Option("第二学期",item.se_id)); 
                }
            });
            console.log(semester);
          }
        }) 
	})
</script>
@endsection