<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

$raiz_site = '../../';
$raiz_admin = '../';

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}

//session_destroy();
setcookie('fronteira_ADMIN_SESSION_usuario', $_COOKIE['fronteira_ADMIN_SESSION_usuario'], ( time() - 3600 ), '/' ); // tempo negativo e/ou valor vazio: Delete cookie
setcookie('fronteira_ADMIN_SESSION_senha', $_COOKIE['fronteira_ADMIN_SESSION_senha'], ( time() - 3600 ), '/' ); // tempo negativo e/ou valor vazio: Delete cookie

$sql = "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Saiu','". date( 'Y-m-d H:i:s' ) ."');";
$conn->multi_query( $sql ) or die( $conn->error );

echo'<script> alert("Logout efetuado com sucesso."); location.href = "'. $raiz_admin .'" </script>';

?>