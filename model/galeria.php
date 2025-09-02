<?php

$sql_galeria = "SELECT * FROM galeria WHERE ativo = 1";

$galeria_tabela = $conn->query( $sql_galeria );

$galeria_array = array();

while( $galeria_montado = $galeria_tabela->fetch_assoc() ){
	
	$galeria_array[] = $galeria_montado;
	
}

//dd( $galeria_array );

?>