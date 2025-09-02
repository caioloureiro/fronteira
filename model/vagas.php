<?php
$sql_vagas = "SELECT * FROM vagas WHERE ativo = 1";

$vagas_tabela = $conn->query( $sql_vagas );

$vagas_array = array();

while( $vagas_montado = $vagas_tabela->fetch_assoc() ){
	
	$vagas_array[] = $vagas_montado;
	
}

//dd( $vagas_array );
?>