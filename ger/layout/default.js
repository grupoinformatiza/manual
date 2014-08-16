$(function(){
      
    $('.btn-deletar').click(function(e){
        e.preventDefault();           

        var link = $(this).attr('href');
        $('#confirmDelete').find('.btn-danger').attr('href',link);
        $('#confirmDelete').modal({
            keyboard:true
        });

    });
    
    $('#confirmDelete').on('shown.bs.modal', function () {
        $('#btnConfirma').focus();
    })
    
    $('.alert').addClass('in');
    setTimeout(function(){
        $('.alert-success').alert('close');
    },2500);
});