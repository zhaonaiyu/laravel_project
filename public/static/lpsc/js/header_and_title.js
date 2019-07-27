$(function(){

    $(".header_nav_all").mouseover(function(){
        $(".header_nav_all_main").css("display","block")
    }).mouseout(function(){
        $(".header_nav_all_main").css("display","none")        
    })
    $(".header_nav_all_one").each(function () {
        $(this).mouseover(function () {
            $(".header_nav_all_one_right").css("display", "none")
            $(this).find(".header_nav_all_one_right").css("display", "flex")
        }).mouseout(function () {
            $(".header_nav_all_one_right").css("display", "none")
        })
    })


    $(".index_banner_left_one").each(function () {
        $(this).mouseover(function () {
            $(".index_banner_left_one_right").css("display", "none")
            $(this).find(".index_banner_left_one_right").css("display", "flex")
        }).mouseout(function () {
            $(".index_banner_left_one_right").css("display", "none")
        })
    })



})