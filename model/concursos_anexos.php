<?php

$sql_concursos_anexos = "SELECT * FROM concursos_anexos WHERE ativo = 1";

$concursos_anexos_tabela = $conn->query( $sql_concursos_anexos );

$concursos_anexos_array = array();

while( $concursos_anexos_montado = $concursos_anexos_tabela->fetch_assoc() ){
	
	$concursos_anexos_array[] = $concursos_anexos_montado;
	
}

//dd( $concursos_anexos_array );

?>