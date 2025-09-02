<?php

$sql_menu_servicos = "SELECT * FROM menu_servicos WHERE ativo = 1";

$menu_servicos_tabela = $conn->query( $sql_menu_servicos );

$menu_servicos_array = array();

while( $menu_servicos_montado = $menu_servicos_tabela->fetch_assoc() ){
	
	$menu_servicos_array[] = $menu_servicos_montado;
	
}

//dd( $menu_servicos_array );

?>