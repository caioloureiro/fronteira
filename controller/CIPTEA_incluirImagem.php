<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

$raiz_site = '../';
$raiz_admin = '../admin';

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}

require $raiz_site .'controller/funcoes.php';
	
/*Start - SUBIR ARQUIVO*/
//echo print_r( $_FILES );

reset( $_FILES ); 
$arquivo_subir_array = current( $_FILES );
//echo print_r( $arquivo_subir_array );

$sql = '';

$phpFileUploadErrors = array(
	0 => 'Não há erro, arquivo enviado com sucesso',
	1 => 'O arquivo enviado excede a diretiva upload_max_filesize no php.ini',
	2 => 'O arquivo enviado excede a diretiva MAX_FILE_SIZE especificada no formulário HTML',
	3 => 'O arquivo enviado foi carregado apenas parcialmente',
	4 => 'Nenhum arquivo foi carregado',
	6 => 'Faltando uma pasta temporária',
	7 => 'Falha ao gravar arquivo no disco.',
	8 => 'Uma extensão PHP interrompeu o upload do arquivo.',
);

$formatos_validos = array(
	"bmp",
	"gif",
	"jpeg",
	"jpg",
	"png",
	"webp",

	"rar",
	"zip",

	"pdf",
	
	"BMP",
	"GIF",
	"JPEG",
	"JPG",
	"PNG",
	"WEBP",

	"RAR",
	"ZIP",

	"PDF",
);

$arquivo_aceito = 0;

$tamanho = 2; //MB

$tamanho_maximo = 1024 * ( $tamanho * 1000 ); // 2Mb

$pasta = $raiz_site .'formularios_arquivos/';

$contagem = 0;

require $raiz_site .'controller/replace.php'; //ARQUIVO REPLACE.PHP COM ARRAY DE ITENS PARA SUBSTITUIR

//echo $arquivo_subir_array['name'];

$tipo_de_arquivo_array = explode( '.', trim( strip_tags( $arquivo_subir_array['name'] ) ) );
//echo print_r( $tipo_de_arquivo_array );

$tipo_de_arquivo = $tipo_de_arquivo_array[ count( $tipo_de_arquivo_array ) - 1 ];

//echo $tipo_de_arquivo;

foreach( $formatos_validos as $allow ){
	
	if( $tipo_de_arquivo == $allow ){ 
		
		$arquivo_aceito = 1;
		
	}
	
}

//echo $arquivo_aceito;

if( $arquivo_aceito == 0 ){

	echo 'O tipo de arquivo: '. $tipo_de_arquivo .' não é aceito.';
	exit;

}

//echo $arquivo_subir_array['error'];

if( $arquivo_subir_array['error'] == 4 ) {
	
	echo'O arquivo possui erro: '. $arquivo_subir_array['error'];
	exit; 
	
}

if( $arquivo_subir_array['error'] == 0 ){ //SEM ERROS
	
	//echo $arquivo_subir_array['size'] .' > '. $tamanho_maximo;
	
	if( $arquivo_subir_array['size'] > $tamanho_maximo ) {

		echo'O arquivo é muito grande. Deve ser menor que '. $tamanho .'MB.; </script>';
		exit;
		
	}
	
	/*Start - RENOMEAR ARQUIVO POR SEGURANÇA*/
	$name = $arquivo_subir_array['name'];
	
	$name = mb_strtolower( $name );
	
	$explodir_nome = explode( ' ', $name );
	
	$last_nome_numero = count( $explodir_nome ) - 1;
	
	$explodir_extensao = explode( '.', $explodir_nome[ $last_nome_numero ] );
	
	$extensao_arquivo_recebido = $explodir_extensao[1];
	
	$nome_final = '';
	
	$nome_final = date('Y-m-d-H-i') .'-';
	
	for( $i = 0; $i < count( $explodir_nome ) - 1; $i++){
		
		if(
			$explodir_nome[$i] != '-' &&
			$explodir_nome[$i] != ''
		){ $nome_final .= $explodir_nome[$i] .'-';}
		
	}
	
	$nome_final .= $explodir_extensao[0];
	$nome_final .= '.'. $explodir_extensao[1];
	
	$nome_final = str_replace( array_keys( $replace ), $replace, $nome_final );
	
	//echo $pasta.$nome_final;
	/*End - RENOMEAR ARQUIVO POR SEGURANÇA*/
	
	if( move_uploaded_file( $arquivo_subir_array["tmp_name"], $pasta.$nome_final ) ){ //SOBE O ARQUIVO
		
		echo 'Arquivo: '. $nome_final .' incluido no formulário.';
		
	}
	else{
		
		echo'Falha no upload do arquivo: '. $arquivo_subir_array['name'];
		exit;
		
	}
	
}

?>