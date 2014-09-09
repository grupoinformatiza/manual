$(function(){
    $('#cmbTutorial').change(listarPorTutorial);
});

function listarPorTutorial(){
    var tut = $('#cmbTutorial').val();
    
    if(tut != ''){
        $.post(
            'lista_tutorial.php',
            {acao:'listarPorTutorial',
             estado:est
            },
            function(retorno){
                if(retorno)
                    $('#cmbTutorial').html(retorno);
            },
            'html'
        );
    }else{
        $('#cmbTutorial').html("<option value=''>-- Selecione um Estado --</option>");
    }    
    
}
        