<?php

$sql_formularios_respostas = "SELECT * FROM formularios_respostas WHERE ativo = 1";

$formularios_respostas_tabela = $conn->query( $sql_formularios_respostas );

$formularios_respostas_array = array();

while( $formularios_respostas_montado = $formularios_respostas_tabela->fetch_assoc() ){
	
	$formularios_respostas_array[] = $formularios_respostas_montado;
	
}

//dd( $formularios_respostas_array );

?>