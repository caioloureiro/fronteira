<?php

$sql_menu_admin_start = "SELECT * FROM menu_admin_start WHERE ativo = 1";
$menu_admin_start_tabela = $conn->query( $sql_menu_admin_start );

$menu_admin_start_array = array();

while( $menu_admin_start_montado = $menu_admin_start_tabela->fetch_assoc() ){
	
	$menu_admin_start_array[] = $menu_admin_start_montado;
	
}

//dd( $menu_admin_start_array );

?>