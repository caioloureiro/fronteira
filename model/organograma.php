<?php

$sql_organograma = "SELECT * FROM organograma WHERE ativo = 1";

$organograma_tabela = $conn->query( $sql_organograma );

$organograma_array = array();

while( $organograma_montado = $organograma_tabela->fetch_assoc() ){
	
	$organograma_array[] = $organograma_montado;
	
}

//dd( $organograma_array );

?>