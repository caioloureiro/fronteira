<?php

$sql_rastrear_usuario = "SELECT * FROM rastrear_usuario WHERE ativo = 1";

$rastrear_usuario_tabela = $conn->query( $sql_rastrear_usuario );

$rastrear_usuario_array = array();

while( $rastrear_usuario_montado = $rastrear_usuario_tabela->fetch_assoc() ){
	
	$rastrear_usuario_array[] = $rastrear_usuario_montado;
	
}

?>