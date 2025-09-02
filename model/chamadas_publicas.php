<?php

$sql_chamadas_publicas = "SELECT * FROM chamadas_publicas WHERE ativo = 1 ORDER BY id DESC LIMIT 3";

$chamadas_publicas_tabela = $conn->query( $sql_chamadas_publicas );

$chamadas_publicas_array = array();

while( $chamadas_publicas_montado = $chamadas_publicas_tabela->fetch_assoc() ){
	
	$chamadas_publicas_array[] = $chamadas_publicas_montado;
	
}

//dd( $chamadas_publicas_array );

$sql_chamadas_publicas_total = "SELECT * FROM chamadas_publicas WHERE ativo = 1";

$chamadas_publicas_tabela_total = $conn->query( $sql_chamadas_publicas_total );

$chamadas_publicas_array_total = array();

while( $chamadas_publicas_montado_total = $chamadas_publicas_tabela_total->fetch_assoc() ){
	
	$chamadas_publicas_array_total[] = $chamadas_publicas_montado_total;
	
}

//dd( $chamadas_publicas_array_total );

?>