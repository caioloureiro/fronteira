<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');
/*
if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require '../model/conexao-off.php';

}else{
	
	require '../model/conexao-on.php';
	
}
*/

setcookie('cidade_SESSION_usuario', $_COOKIE['cidade_SESSION_usuario'], ( time() - 3600 ), '/' ); // tempo negativo e/ou valor vazio: Delete cookie
setcookie('cidade_SESSION_senha', $_COOKIE['cidade_SESSION_senha'], ( time() - 3600 ), '/' ); // tempo negativo e/ou valor vazio: Delete cookie

if(
	isset( $_COOKIE['cidade_SESSION_usuario'] )
	&& isset( $_COOKIE['cidade_SESSION_senha'] )
){
	
	//session_destroy();
	setcookie('cidade_SESSION_usuario', $_COOKIE['cidade_SESSION_usuario'], ( time() - 3600 ), '/' ); // tempo negativo e/ou valor vazio: Delete cookie
	setcookie('cidade_SESSION_senha', $_COOKIE['cidade_SESSION_senha'], ( time() - 3600 ), '/' ); // tempo negativo e/ou valor vazio: Delete cookie
	
	//$sql = "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['cidade_SESSION_usuario'] ."','Saiu','". date( 'Y-m-d H:i:s' ) ."');";
	//$conn->multi_query( $sql ) or die( $conn->error );
	
	//die();
	
	echo'<script> location.href = "../" </script>';

}else{
	
	echo'<script>alert( "A sessão não existe." ); location.href = "../" </script>';
	
}

?>