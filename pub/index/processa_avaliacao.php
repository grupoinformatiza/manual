<?php
define('ROOT_PATH', '../../');
require "../../config.php";

if(isset($_POST['acao'])){
    switch($_POST['acao']){
        case 'gravar':
            try{
                $estatistica = new Entidade\Estatistica();          
                $estatistica->Topico = Servico\TopicoDAO::getTopico($_POST['topico']);
                $estatistica->Positivo = $_POST['positivo'];
                $estatistica->Comentario = $_POST['comentario'];
                Servico\EstatisticaDAO::gravar($estatistica);
                $ret['status'] = true;
            } catch (Exception $ex) {
                $ret['status'] = false;
                $ret['erro'] = $ex->getMessage();
            }                                
            break;       
    }  
    die(json_encode($ret));
}