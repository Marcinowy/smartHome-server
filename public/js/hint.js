$(document).ready(function() {
    $("body").prepend("<div id=\"hint_container\"></div>");
    $("body").on('mouseenter','.hint',function() {
        var text=$(this).attr("data-hint");
        $("#hint_container").html(text).css("display","block");
    });
    $("body").on('mouseleave','.hint',function() {
        $("#hint_container").css("display","none");
    });
    $("body").on('mousemove','.hint',function(e) {
        $("#hint_container").css({"left":e.clientX + 10,"top":e.clientY + 10});
    });
});