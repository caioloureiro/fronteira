<?php

$sql_formularios = "SELECT * FROM formularios WHERE ativo = 1";

$formularios_tabela = $conn->query( $sql_formularios );

$formularios_array = array();

while( $formularios_montado = $formularios_tabela->fetch_assoc() ){
	
	$formularios_array[] = $formularios_montado;
	
}

//dd( $formularios_array );

?>