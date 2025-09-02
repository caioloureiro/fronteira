<?php

$sql_transparencia_grupos = "SELECT * FROM transparencia_grupos WHERE ativo = 1";

$transparencia_grupos_tabela = $conn->query( $sql_transparencia_grupos );

$transparencia_grupos_array = array();

while( $transparencia_grupos_montado = $transparencia_grupos_tabela->fetch_assoc() ){
	
	$transparencia_grupos_array[] = $transparencia_grupos_montado;
	
}

//dd( $transparencia_grupos_array );

?>