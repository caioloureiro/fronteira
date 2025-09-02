<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

$raiz_site = '../';
$raiz_admin = '../admin/';

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}

require 'funcoes.php';
require $raiz_site .'model/newsletter.php';

$email = $_POST['email'];
$recaptcha = $_POST['recaptcha'];

//echo 'recaptcha: '. $recaptcha;

if( $recaptcha == '' ){ exit; }

foreach( $newsletter_array as $item ){
	
	if( $item['email'] == $email ){
		
		echo 'O e-mail: '. $item['email'] .' já está cadastrado em nosso sistema. Por favor, verifique sua lixeira ou a caixa de SPAM.';
		
		exit;
		
	}

}

$sql = '';

$sql .= "INSERT INTO newsletter (
	email
) VALUES (".
	"'". $email ."' ".
");";

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $email ." - ". $_SERVER['REMOTE_ADDR'] ."','Registrou em newsletter: ". $email ."','". date( 'Y-m-d H:i:s' ) ."');";
$conn->multi_query( $sql );
$conn->close();

echo 'O e-mail: '. $email .' foi cadastrado com sucesso.';

?>