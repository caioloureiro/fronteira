<?php

$sql_concursos_situacao = "SELECT * FROM concursos_situacao WHERE ativo = 1";

$concursos_situacao_tabela = $conn->query( $sql_concursos_situacao );

$concursos_situacao_array = array();

while( $concursos_situacao_montado = $concursos_situacao_tabela->fetch_assoc() ){
	
	$concursos_situacao_array[] = $concursos_situacao_montado;
	
}

//dd( $concursos_situacao_array );

?>