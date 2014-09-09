function handleFormSubmit(e){
    e.preventDefault();
    $.post(
        $(this).attr('action'),
        $(this).serialize(),
        function(ret){
            if(ret.status){
                $('.msgPlaceholder').html('<div class="alert alert-success">Alterações gravadas com sucesso</div>');
            }else{
                $('.msgPlaceholder').html('<div class="alert alert-danger">'+ret.erro+'</div>');
            }
        },
        'json'
    );
}