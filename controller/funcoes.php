<?php

function dd( $variavel ){

	$resultado_dd = gettype( $variavel );
	
	echo 'O resultado é um: '. $resultado_dd;
	
	if( $resultado_dd == 'object' ){
	
		echo'<pre>';
		
		var_dump( $variavel );

		echo'</pre>';

		die();
		
	}else{
		
		echo'<pre>';
		
		print_r( $variavel );
		
		echo'</pre>';
		
		die();
		
	}
	
}

function mostrar_array( $variavel ){

	$resultado_dd = gettype( $variavel );
	
	echo '<p>O resultado é um: '. $resultado_dd .'</p>';
	
	if( $resultado_dd == 'object' ){
	
		echo'<p><pre>';
		
		var_dump( $variavel );

		echo'</pre></p>';
		
	}else{
		
		echo'<p><pre>';
		
		print_r( $variavel );
		
		echo'</pre></p>';
		
	}
	
}

function console( $variavel ){

	$resultado_dd = gettype( $variavel );
	
	echo'<script> console.log( "'. $variavel .'" ); </script>';
	
}

function data( $data_recebida ){
	
	$data_pronta = DateTime::createFromFormat( 'Y-m-d', $data_recebida )->format('d/m/Y');
	
	return $data_pronta;
	
}

function data_tempo( $data_recebida ){
	
	$data_pronta = DateTime::createFromFormat( 'Y-m-d H:i:s', $data_recebida )->format('d/m/Y H:i:s');
	
	return $data_pronta;
	
}

function data_tempo_invertida( $data_recebida ){
	
	$data_pronta = DateTime::createFromFormat( 'd/m/Y H:i:s', $data_recebida )->format('Y-m-d H:i:s');
	
	return $data_pronta;
	
}

function data_invertida( $data_recebida ){
	
	$data_pronta = DateTime::createFromFormat('d/m/Y', $data_recebida)->format('Y-m-d');
	
	return $data_pronta;
	
}

function moeda( $valor_recebido ){
	
	$moeda_pronta = number_format( $valor_recebido,2,",","." );
	
	return $moeda_pronta;
	
}

function moeda_invertida( $valor_recebido ){
	
	$moeda_pronta = number_format( $valor_recebido,2,".","," );
	
	return $moeda_pronta;
	
}

function mascara( $mask, $str ){

    $str = str_replace(" ","",$str);

	for($i=0;$i<strlen($str);$i++){
		
		$mask[strpos($mask,"#")] = $str[$i];
		
	}

    return $mask;

}

function cnpj( $cnpj_recebido ){
	
	$cnpj_molde = '##.###.###/####-##';
	
	return mascara( $cnpj_molde, $cnpj_recebido );
	
}

function mes_ano( $data_recebida ){
	
	if( strlen( $data_recebida ) > 7 ){
		
		$mes_ano = date( 'm/Y', strtotime( $data_recebida ) );
		
	}else{
		
		$mes_ano = $data_recebida;
		
	}
	
	return $mes_ano;
	
}

function mes_abrev( $valor_recebido ){
	
	$mes_numero = date( 'm', strtotime( $valor_recebido ) );
	
	switch( $mes_numero ){
		case '01': $mes = 'jan'; break;
		case '02': $mes = 'fev'; break;
		case '03': $mes = 'mar'; break;
		case '04': $mes = 'abr'; break;
		case '05': $mes = 'mai'; break;
		case '06': $mes = 'jun'; break;
		case '07': $mes = 'jul'; break;
		case '08': $mes = 'ago'; break;
		case '09': $mes = 'set'; break;
		case '10': $mes = 'out'; break;
		case '11': $mes = 'nov'; break;
		case '12': $mes = 'dez'; break;
	}
	
	return $mes;
	
}

function renomear( $texto_recebido ){
	
	require 'replace.php';
	
	$texto_recebido = mb_strtolower( $texto_recebido );
	
	$explodir_nome = explode( ' ', $texto_recebido );
	
	$nome_final = '';
	
	for( $i = 0; $i < count( $explodir_nome ) - 1; $i++){
		
		if(
			$explodir_nome[$i] != '-' &&
			$explodir_nome[$i] != ''
		){ $nome_final .= $explodir_nome[$i] .'-';}
		
	}
	
	$nome_final .= $explodir_nome[count( $explodir_nome ) - 1];
	
	$nome_final = str_replace( array_keys( $replace ), $replace, $nome_final );
	
	return $nome_final;
	
}

function array_to_sql( $tabela ){
	
	$sql = '';
	
	require '../model/'. $tabela .'.php';
	
	$string = $tabela .'_array';
	
	return $sql;
	
}

?>