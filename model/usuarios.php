<?php

$sql_usuarios = "SELECT * FROM usuarios WHERE ativo = 1";

$usuarios_tabela = $conn->query( $sql_usuarios );

$usuarios_array = array();

while( $usuarios_montado = $usuarios_tabela->fetch_assoc() ){
	
	$usuarios_array[] = $usuarios_montado;
	
}

//dd( $usuarios_array );

?>