<?php

$sql_tutoriais = "SELECT * FROM tutoriais WHERE ativo = 1";

$tutoriais_tabela = $conn->query( $sql_tutoriais );

$tutoriais_array = array();

while( $tutoriais_montado = $tutoriais_tabela->fetch_assoc() ){
	
	$tutoriais_array[] = $tutoriais_montado;
	
}

usort($tutoriais_array, function( $a, $b ){//Função responsável por ordenar

	$al = mb_strtolower($a['nome']);
	$bl = mb_strtolower($b['nome']);
	
	if ($al == $bl){
		return 0;
	}
	
	return ($bl < $al) ? +1 : -1;
	
});

//dd( $tutoriais_array );

?>