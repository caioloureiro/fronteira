<?php

$sql_esic = "SELECT * FROM esic WHERE ativo = 1";

$esic_tabela = $conn->query( $sql_esic );

$esic_array = array();

while( $esic_montado = $esic_tabela->fetch_assoc() ){
	
	$esic_array[] = $esic_montado;
	
}

//dd( $esic_array );

?>