<?php

$sql_redes_sociais = "SELECT * FROM redes_sociais WHERE ativo = 1";

$redes_sociais_tabela = $conn->query( $sql_redes_sociais );

$redes_sociais_array = array();

while( $redes_sociais_montado = $redes_sociais_tabela->fetch_assoc() ){
	
	$redes_sociais_array[] = $redes_sociais_montado;
	
}

//dd( $redes_sociais_array );

?>