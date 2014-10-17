function handleFormSubmit(e){
    e.preventDefault();
    $.post(
        $(this).attr('action'),
        $(this).serialize(),
        function(ret){
            if(ret.status){
                $("editarTopico").modal("hide");
            }else{
                $('.msgPlaceholder').html('<div class="alert alert-danger">'+ret.erro+'</div>');
            }
        },
        'json'
    );
}