<?php

$sql_cemiterios_arquivos = "SELECT * FROM cemiterios_arquivos WHERE ativo = 1";

$cemiterios_arquivos_tabela = $conn->query( $sql_cemiterios_arquivos );

$cemiterios_arquivos_array = array();

while( $cemiterios_arquivos_montado = $cemiterios_arquivos_tabela->fetch_assoc() ){
	
	$cemiterios_arquivos_array[] = $cemiterios_arquivos_montado;
	
}

//dd( $cemiterios_arquivos_array );

?>