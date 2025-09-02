<?php

$sql_menu_admin_sinc = "SELECT * FROM menu_admin_sinc WHERE ativo = 1";
$menu_admin_sinc_tabela = $conn->query( $sql_menu_admin_sinc );

$menu_admin_sinc_array = array();

while( $menu_admin_sinc_montado = $menu_admin_sinc_tabela->fetch_assoc() ){
	
	$menu_admin_sinc_array[] = $menu_admin_sinc_montado;
	
}

//dd( $menu_admin_sinc_array );

$sql_menu_admin_sinc_completo = "SELECT * FROM menu_admin_sinc";
$menu_admin_sinc_tabela_completo = $conn->query( $sql_menu_admin_sinc_completo );

$menu_admin_sinc_array_completo = array();

while( $menu_admin_sinc_montado_completo = $menu_admin_sinc_tabela_completo->fetch_assoc() ){
	
	$menu_admin_sinc_array_completo[] = $menu_admin_sinc_montado_completo;
	
}

//dd( $menu_admin_sinc_array_completo );

?>