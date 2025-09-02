<?php

$sql_banner = "SELECT * FROM banner WHERE ativo = 1";

$banner_tabela = $conn->query( $sql_banner );

$banner_array = array();

while( $banner_montado = $banner_tabela->fetch_assoc() ){
	
	$banner_array[] = $banner_montado;
	
}

//dd( $banner_array );

?>