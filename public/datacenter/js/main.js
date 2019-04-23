/*
 * @Author: GhostChen
 * @Date: 2018-08-29 11:39:10 
 * @Last Modified by: ghostChen
 * @Last Modified time: 2018-12-29 13:20:16
 */


var main = main || {};
main = {
    init:function(){
        $(".layui-nav-item .username").on("mouseover",function(){
            $(this).find("span").css({
                "transform":"rotate(-120deg)"
            })
        })
        $(".layui-nav-item .username").on("mouseout",function(){
            $(this).find("span").css({
                "transform":"rotate(0deg)"
            })
        })
        //main.storageMenu();
        
    },
    storageMenu: function () {
        var storage = window.localStorage;
        $(".layui-side .layui-nav li").find("a.c-link").each(function (i, item) {
            $(item).on("click", function () {
                var this_menu = $(this).attr("data-url");
                storage["this_menu"] = this_menu;
            })
            //获取当前data-url
            var this_url = storage['this_menu'];
            if ($(item).attr("data-url") == this_url) {
                $(item).parents("li").addClass("layui-nav-itemed");
                $(item).parent().addClass("layui-this");
                $(item).siblings(".c-link").removeClass("layui-this").parents("li").siblings("li").find("dd").removeClass("layui-nav-itemed")
            }
        })
    }

}

main.init();