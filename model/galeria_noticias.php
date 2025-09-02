<?php

$sql_galeria_noticias = "SELECT * FROM galeria_noticias WHERE ativo = 1";

$galeria_noticias_tabela = $conn->query( $sql_galeria_noticias );

$galeria_noticias_array = array();

while( $galeria_noticias_montado = $galeria_noticias_tabela->fetch_assoc() ){
	
	$galeria_noticias_array[] = $galeria_noticias_montado;
	
}

//dd( $galeria_noticias_array );

?>