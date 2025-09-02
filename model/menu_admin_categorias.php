<?php

$sql_menu_admin_categorias = "SELECT * FROM menu_admin_categorias WHERE ativo = 1";
$menu_admin_categorias_tabela = $conn->query( $sql_menu_admin_categorias );

$menu_admin_categorias_array = array();

while( $menu_admin_categorias_montado = $menu_admin_categorias_tabela->fetch_assoc() ){
	
	$menu_admin_categorias_array[] = $menu_admin_categorias_montado;
	
}

//dd( $menu_admin_categorias_array );

?>