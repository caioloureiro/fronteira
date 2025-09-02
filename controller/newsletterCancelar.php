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

$counter = 0;

//echo 'recaptcha: '. $recaptcha;

if( $recaptcha == '' ){ exit; }

foreach( $newsletter_array as $item ){
	
	if( $item['email'] == $email ){
		
		$sql = '';

		$sql = "UPDATE newsletter SET ativo = 0 WHERE id = ". $item['id'] .";";

		$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $email ." - ". $_SERVER['REMOTE_ADDR'] ."','Cancelou assinatura em newsletter: ". $email ." e ID: ". $item['id'] ."','". date( 'Y-m-d H:i:s' ) ."');";
		$conn->multi_query( $sql );
		$conn->close();
		
		$counter++;
		
	}

}

if( $counter > 0 ){ echo 'Assinatura cancelada para o e-mail: '. $email .'.'; }

if( $counter == 0 ){ echo 'O e-mail: '. $email .' não está cadastrado em nosso sistema.'; }

?>