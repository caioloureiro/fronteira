<?php

$sql_menu = "SELECT * FROM menu WHERE ativo = 1";

$menu_tabela = $conn->query( $sql_menu );

$menu_array = array();

while( $menu_montado = $menu_tabela->fetch_assoc() ){
	
	$menu_array[] = $menu_montado;
	
}

usort($menu_array, function( $a, $b ){//Função responsável por ordenar

	$al = mb_strtolower($a['nome']);
	$bl = mb_strtolower($b['nome']);
	
	if ($al == $bl){
		return 0;
	}
	
	return ($bl < $al) ? +1 : -1;
	
});

//dd( $menu_array );

?>