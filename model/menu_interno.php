<?php

$sql_menu_interno = "SELECT * FROM menu_interno WHERE ativo = 1";

$menu_interno_tabela = $conn->query( $sql_menu_interno );

$menu_interno_array = array();

while( $menu_interno_montado = $menu_interno_tabela->fetch_assoc() ){
	
	$menu_interno_array[] = $menu_interno_montado;
	
}

//dd( $menu_interno_array );

?>