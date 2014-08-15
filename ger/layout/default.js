$(function(){
    setTimeout(function(){
        $('.alert-success').fadeOut("slow",function(){
            $(this).remove();
        })
    },2500);
})