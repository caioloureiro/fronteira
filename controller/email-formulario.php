<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

//echo'Entrou no email-formulario.php'; exit; //FREIO

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require '../model/conexao-off.php';

}else{
	
	require '../model/conexao-on.php';
	
}
require 'funcoes.php';

require '../model/email_fale_conosco.php';

foreach( $email_fale_conosco_array as $item ){

	$db_host = $item['host'];
	$db_smtp = $item['smtp'];
	$db_email = $item['email'];
	$db_senha = $item['senha'];

}

//echo $_POST['email']; exit; //FREIO
//echo $_POST['recado_titulo']; exit; //FREIO
//echo $_POST['recado_mensagem']; exit; //FREIO

$destinatario_email = $_POST['email'];
$destinatario_nome = $_POST['email'];
$recado_titulo = $_POST['recado_titulo'];
$recado_mensagem = $_POST['recado_mensagem'];

$remetente_nome = 'Prefeitura de cidade - SP';
$assunto = 'Prefeitura de cidade - '. $recado_titulo; //Vem do formulário
$caio = 'caio.loureiro@hotmail.com';

$email = $db_email;
$email_porta = 465;

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: ". $remetente_nome ." <". $db_smtp .">\r\n";
$headers .= "Reply-To: <". $db_smtp .">\r\n";
$headers .= "Subject: ". $assunto ."\r\n";
$headers .= "X-Mailer: PHP/". phpversion() ."\r\n";

$msg = $recado_mensagem; //vem do formulário

mail( $destinatario_email, $assunto, $msg, $headers );

echo'Você recebeu esta mensagem no e-mail: '. $destinatario_email .'. Anote o protocolo para atendimento.';

?>