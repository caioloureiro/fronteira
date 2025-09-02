<?php

$sql_prefeitos = "SELECT * FROM prefeitos WHERE ativo = 1";

$prefeitos_tabela = $conn->query( $sql_prefeitos );

$prefeitos_array = array();

while( $prefeitos_montado = $prefeitos_tabela->fetch_assoc() ){
	
	$prefeitos_array[] = $prefeitos_montado;
	
}

//dd( $prefeitos_array );

?>