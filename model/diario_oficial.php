<?php

$sql_diario_oficial = "SELECT * FROM diario_oficial WHERE ativo = 1";

$diario_oficial_tabela = $conn->query( $sql_diario_oficial );

$diario_oficial_array = array();

while( $diario_oficial_montado = $diario_oficial_tabela->fetch_assoc() ){
	
	$diario_oficial_array[] = $diario_oficial_montado;
	
}

//dd( $diario_oficial_array );

?>