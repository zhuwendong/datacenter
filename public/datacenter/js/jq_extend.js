//# sourceURL=jq_extend.js
/**
 * @title JQ方法扩展
 * @description JQ extend
 * @author ChenSiTong
 * @date 2018-07-27
 */
;
(function ($) {
    $.extend({
        "getTable":function(options){
            console.log(options)
            var data = options.data.data,
                dom = options.dom;
            var table_head = options.data.head;
            $(dom).append("<table class='layui-table'>"+
                            "<thead>"+
                                "<tr></tr>"+
                            "</thead>"+
                            "<tbody></tbody>"+
                            +"</table>");
            for(var i =0;i<table_head.length;i++){
                $(dom).find("table thead tr").append("<th style=''>"+table_head[i]+"</th>");
            }
            for(var i =0;i<data.length;i++){
                $(dom).find("table tbody").append(`<tr class='tr-item-`+i+`'>
                         </tr>`);
                (function(oo,obj){
                    for(var z = 0;z<data[oo].d1.length;z++){
                        $(obj).find("table tbody .tr-item-"+oo).append(`<td data-text='`+data[oo].d1[z]+`'>
                            `+data[oo].d1[z]+`
                        </td>`);
                    }
                })(i,dom);
                if(data[0].operation){
                    (function(oo,obj){
                        for(var k = 0;k<data[oo].operation.length;k++){
                            $(obj).find("table tbody .tr-item-"+oo).append("<td data-text='"+data[oo].operation[k]+"' class='oparation-td'><span>"+data[oo].operation[k]+"</span></td>");
                        }
                    })(i,dom)
                    var operation_length = data[0].operation.length;
                    //设置操作的colspan
                    $(dom).find("thead tr th:last-child").attr("colspan",operation_length);
                }   
                
            }
            //如果需要复选框，头部添加
            console.log(options.hasCheckbox)
            if(options.hasCheckbox == true){
                console.log("31313")
                $(dom).find("thead tr,table tbody tr").prepend("<td class='checkbox'><input type='checkbox'></td>");
            }

        },
        "get_layer":function(options){
            //类型1
            if(options.type == "1"){
                layui.use('layer', function(){
                    var layer = layui.layer;
                    layer.open({
                        type: 1, 
                        title:options.title,
                        area: options.area,
                        skin: 'c-layer-class',
                        btn: options.btn_arr,
                        content:options.html,
                        closeBtn:false,
                        yes: function(index, layero){
                            options.btn1();
                            layer.close(index)
                        },
                        btn2: function(index, layero){
                            //按钮【按钮二】的回调
                            //return false 开启该代码可禁止点击该按钮关闭
                            options.btn2();
                        }
                    });
                });  
                $(".layui-layer").append("<span class='c-icon-close'></span>");
                $(".c-icon-close").on("click",function(){
                    layer.closeAll();
                })
            }
        },
        "goPage":function(body,url){
            $(body).load(url);
        }
    });
})(window.jQuery);