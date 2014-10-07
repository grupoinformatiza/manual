<?php

namespace Suporte;
use libs;

/**
 * Classe para enviar e-mails através do PHPMailer
 * @author luiz
 */
class Email {
    
    /**
     * Método cria o PHPMailer e verifica qual o e-mail do remetente (suporta apenas: live, outlook, hotmail, gmail e yahoo.
     * @param string $remetente_nome
     * Nome do remetente (quem enviará o e-mail e será usado para autenticar o envio)
     * @param string $remetente_email
     * E-mail do remetente
     * @param string $remetente_email_senha
     * Senha do e-mail do remetente
     * @param string $destinatario_email
     * E-mail do destinatário (quem receberá a mensagem)
     * @param string $destinatario_nome
     * Nome do destinatário
     * @param string $assunto
     * Assunto da mensagem
     * @param string $mensagem
     * Mensagem - corpo do e-mail
     * @param Integer $SMTPDebug
     * Habilita SMTP debugging (passo-a-passo do que o PHPMailer realiza) - 
     * utilize para testar o método e os parâmetros
     *  0 = desligado (após testado)
     *  1 = mensagens para o cliente
     *  2 = mensagens para o servidor
     */
    public static function enviaEmail($remetente_nome, 
            $remetente_email,
            $remetente_email_senha,
            $destinatario_email,
            $destinatario_nome,
            $assunto,
            $mensagem,
            $SMTPDebug = 0) {
        
        $smtp = '';
        $porta = 0;
        
        $mail = new libs\PHPMailer();
        
        date_default_timezone_set('Etc/UTC');

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = $SMTPDebug;

        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

        //Tipo de sistema de encriptação - ssl (depreciado - não mais usado) ou tls
        $mail->SMTPSecure = 'tls';

        //Indica se usará autenticação SMTP
        $mail->SMTPAuth = true;

        //Nome de usuário - login - para autenticação STMP - endereço de e-mail 
        //completo
        $mail->Username = $remetente_email;

        //Senha para autenticação SMTP
        $mail->Password = $remetente_email_senha;

        //Quem enviará
        $mail->setFrom($remetente_email, $remetente_nome);

        //Endereço alternativo para resposta
        //$mail->addReplyTo('replyto@example.com', 'First Last');

        //Assunto
        $mail->Subject = $assunto;

        //Carrega uma mensagem em HTML de um arquivo externo, converte imagens
        //referenciadas para fixas, converte HTML em texto pleno
        //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

        //Corpo da mensagem
        $mail->Body = $mensagem;
        
        //Anexa uma imagem à mensagem
        //$mail->addAttachment('images/phpmailer_mini.png');
        
        //Para quem a mensagem será enviada
        $mail->addAddress($destinatario_email, $destinatario_nome);

        if (strpos($remetente_email, 'gmail')) {
                
            $smtp = 'smtp.gmail.com';
            $porta = 587;
        }
                
        if (strpos($remetente_email, 'hotmail') || strpos($remetente_email, 'outlook') || strpos($remetente_email, 'live')) {
            
            $smtp = 'smtp-mail.outlook.com';
            $porta = 25;
        }
        
        if (strpos($remetente_email, 'yahoo')) {
            
            $smtp = 'smtp.mail.yahoo.com';
            $porta = 587;
        }
        
        //Set the hostname of the mail server
        $mail->Host = $smtp;
        
        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = $porta;
        
        //Envia a mensagem e verifica se houve erro
        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }        
    }
}
