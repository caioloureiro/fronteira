<?php

$sql_dengue = "SELECT * FROM dengue WHERE ativo = 1";

$dengue_tabela = $conn->query( $sql_dengue );

$dengue_array = array();

while( $dengue_montado = $dengue_tabela->fetch_assoc() ){
	
	$dengue_array[] = $dengue_montado;
	
}

//dd( $dengue_array );

?>