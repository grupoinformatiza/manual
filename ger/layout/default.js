$(function(){
      
    $('.btn-deletar').click(function(e){
        e.preventDefault();           

        var link = $(this).attr('href');
        $('#confirmDelete').find('.btn-danger').attr('href',link);
        $('#confirmDelete').modal();

    });
    
    
    setTimeout(function(){
        $('.alert-success').fadeOut("slow",function(){
            $(this).remove();
        })
    },2500);
});