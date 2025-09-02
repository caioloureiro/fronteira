<?php

$sql_menu_admin = "SELECT * FROM menu_admin WHERE ativo = 1";
$menu_admin_tabela = $conn->query( $sql_menu_admin );

$menu_admin_array = array();

while( $menu_admin_montado = $menu_admin_tabela->fetch_assoc() ){
	
	$menu_admin_array[] = $menu_admin_montado;
	
}

usort($menu_admin_array, function( $a, $b ){//Função responsável por ordenar

	$al = mb_strtolower($a['nome']);
	$bl = mb_strtolower($b['nome']);
	
	if ($al == $bl){
		return 0;
	}
	
	return ($bl < $al) ? +1 : -1;
	
});

//dd( $menu_admin_array );

?>