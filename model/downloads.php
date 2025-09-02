<?php

$sql_downloads = "SELECT * FROM downloads WHERE ativo = 1 ORDER BY id DESC LIMIT 30";

$downloads_tabela = $conn->query( $sql_downloads );

$downloads_array = array();

while( $downloads_montado = $downloads_tabela->fetch_assoc() ){
	
	$downloads_array[] = $downloads_montado;
	
}

//dd( $downloads_array );

$sql_downloads_destaque = "SELECT * FROM (SELECT * FROM downloads WHERE ativo = 1 ORDER BY id DESC LIMIT 10) g ORDER BY g.id";

$downloads_destaque_tabela = $conn->query( $sql_downloads_destaque );

$downloads_destaque_array = array();

while( $downloads_destaque_montado = $downloads_destaque_tabela->fetch_assoc() ){
	
	$downloads_destaque_array[] = $downloads_destaque_montado;
	
}

//dd( $downloads_destaque_array );

$sql_downloads_total = "SELECT * FROM downloads WHERE ativo = 1";

$downloads_tabela_total = $conn->query( $sql_downloads_total );

$downloads_array_total = array();

while( $downloads_montado_total = $downloads_tabela_total->fetch_assoc() ){
	
	$downloads_array_total[] = $downloads_montado_total;
	
}

//dd( $downloads_array_total );

?>