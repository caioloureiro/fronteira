<?php

$sql_concursos = "SELECT * FROM concursos WHERE ativo = 1";

$concursos_tabela = $conn->query( $sql_concursos );

$concursos_array = array();

while( $concursos_montado = $concursos_tabela->fetch_assoc() ){
	
	$concursos_array[] = $concursos_montado;
	
}

//dd( $concursos_array );

?>