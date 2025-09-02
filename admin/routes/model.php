<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

$raiz_site = '../';
$raiz_admin = '';

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}

//dd( $conn );
	
//require $raiz_site ."model/arrays.php";
require $raiz_site ."model/menu_admin.php";
require $raiz_site ."model/modulos_admin.php";
require $raiz_site ."model/paginas_admin.php";
require $raiz_site ."model/rastrear_usuario.php";
require $raiz_site ."model/admin_user.php";
require $raiz_site ."model/settings_admin.php";
require $raiz_site ."model/menu_admin_categorias.php";
require $raiz_site ."model/menu_admin_sinc.php";
require $raiz_site ."model/menu_admin_start.php";

?>