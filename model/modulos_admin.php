<?php

$sql_modulos_admin = "SELECT * FROM modulos_admin WHERE ativo = 1";
$modulos_admin_tabela = $conn->query( $sql_modulos_admin );

$modulos_admin_array = array();

while( $modulos_admin_montado = $modulos_admin_tabela->fetch_assoc() ){
	
	$modulos_admin_array[] = $modulos_admin_montado;
	
}

//dd( $modulos_admin_array );

?>