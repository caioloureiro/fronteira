<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

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

$remetente_nome = 'Prefeitura de cidade - SP';
$destinatario_nome = 'Responsável pelos contatos da Prefeitura de cidade - SP';
$assunto = 'E-mail recebido da página Contato do portal da Prefeitura de cidade - SP.';
$caio = 'caio.loureiro@hotmail.com';

$email = $db_email;
$email_porta = 465;

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: ". $remetente_nome ." <". $db_smtp .">\r\n";
$headers .= "Reply-To: <". $db_smtp .">\r\n";
$headers .= "Subject: ". $assunto ."\r\n";
$headers .= "X-Mailer: PHP/". phpversion() ."\r\n";

//dd( $_POST );

$msg = '
<p>E-mail recebido da página Contato do portal da Prefeitura de cidade - SP.</p>

<p>Dados do formulário:</p>

<p>Nome: '. $_POST['nome'] .'</p>
<p>E-mail: '. $_POST['email'] .'</p>
<p>Telefone: '. $_POST['telefone'] .'</p>
<p>Endereço: '. $_POST['endereco'] .'</p>
<p>Departamento: '. $_POST['departamento'] .'</p>
<p>Mensagem: '. $_POST['mensagem'] .'</p>
';

//dd( $msg );

mail( $email, $assunto, $msg, $headers );

?>