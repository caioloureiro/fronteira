<?php

$sql_noticias = "SELECT * FROM noticias WHERE ativo = 1";

$noticias_tabela = $conn->query( $sql_noticias );

$noticias_array = array();

while( $noticias_montado = $noticias_tabela->fetch_assoc() ){
	
	$noticias_array[] = $noticias_montado;
	
}

//dd( $noticias_array );

?>