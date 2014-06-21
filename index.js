//JS da página index...
$(document).ready(function(){
    //Adicionando um evento ao botão de id="botao"
    $("#botao").click(testePostagem);
    $("[data-toggle=menulateral]").click(function(){
        $('.sidebar').toggleClass('active');
    });
});

//testePostagem poderia ser uma função, mas precisamos declarar desta forma
//para pegar o "e" que são os parametros do evento de clique;
var testePostagem = function testePostagem(e){
    e.preventDefault(); //Desativamos a função padrão do botão.
    //Se ao ser clicado este botão enviaria um formulario, agora não enviará mais,
    //pois ao ser clicado o formulario sera postado por aqui.
    //esta é uma boa pratica para acessibilidade, já que o sistema funcionará tambem
    //para quem não possuir javascript ativado,
    //isso é chamado de Javascript não intrusivo.
    
    //Executando uma requisição Ajax de mandeira simplificada utilizando Jquery.
    $.post(
        "config.php", //Página que receberá a requisição.
        {tipo: 'teste'}, //parâmetros. (Neste caso são recuperados no php utilizando $_POST['tipo'] / em alguns casos será $_GET
        function(retorno){ //função de callback
            //Manipulação do retorno da requisição
            if(retorno){
                $('#teste').text(retorno.teste).show();
                $('#teste2').text(retorno.outro).show();
            }else
                alert('erro');
        },
        'json' //tipo de retorno desejado. No caso o mais rapido e mais facil de trabalhar. Facilmente interpretado com js.
    );
};