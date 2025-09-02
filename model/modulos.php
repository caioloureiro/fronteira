<?php

$sql_modulos = "SELECT * FROM modulos WHERE ativo = 1";
$modulos_tabela = $conn->query( $sql_modulos );

$modulos_array = array();

while( $modulos_montado = $modulos_tabela->fetch_assoc() ){
	
	$modulos_array[] = $modulos_montado;
	
}

//dd( $modulos_array );

?>