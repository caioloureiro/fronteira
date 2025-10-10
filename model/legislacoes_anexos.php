<?php

$sql_legislacoes_anexos = "SELECT * FROM legislacoes_anexos WHERE ativo = 1";

$legislacoes_anexos_array = array();

if($legislacoes_anexos_tabela = $conn->query( $sql_legislacoes_anexos )) {
	while( $legislacoes_anexos_montado = $legislacoes_anexos_tabela->fetch_assoc() ){
		$legislacoes_anexos_array[] = $legislacoes_anexos_montado;
	}
} else {
	// Se houver erro na query, registrar no log mas não quebrar a página
	error_log("Erro ao buscar legislações anexos: " . $conn->error);
}

//dd( $legislacoes_anexos_array );

?>