<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

$raiz_site = '../../../../';
$raiz_admin = '../../../';

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}

require $raiz_site .'controller/funcoes.php';
	
/*Start - SUBIR ARQUIVO*/
//dd( $_FILES );

//$arquivo_subir_array = $_FILES['arquivo_subir'];

reset( $_FILES ); 
$arquivo_subir_array = current( $_FILES );

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
);

$arquivo_aceito = 0;

$tamanho_maximo = 1024 * 20000; // 20Mb

$pasta = $raiz_site .'galeria/';

$contagem = 0;

require $raiz_site .'controller/replace.php'; //ARQUIVO REPLACE.PHP COM ARRAY DE ITENS PARA SUBSTITUIR

$tipo_de_arquivo = explode( '/', trim( strip_tags( $arquivo_subir_array['type'] ) ) );

//dd( $tipo_de_arquivo );

foreach( $formatos_validos as $allow ){
	
	if( $tipo_de_arquivo[1] == $allow ){ 
		
		$arquivo_aceito = 1;
		
	}
	
}

//dd( $arquivo_aceito );

if( $arquivo_aceito == 0 ){

	header( 'O tipo de arquivo '. $tipo_de_arquivo[1] .' não é aceito.' );
	return; 

}

if( $arquivo_subir_array['error'] == 4 ) {
	
	header( 'O arquivo possui erro: '. $arquivo_subir_array['error'] );
	return; 
	
}

if( $arquivo_subir_array['error'] == 0 ){ //SEM ERROS
	
	//dd( $arquivo_subir_array['size'] .' > '. $tamanho_maximo );
	
	if( $arquivo_subir_array['size'] > $tamanho_maximo ) {

		header( 'O arquivo é muito grande. Deve ser menor que 2MB.' );
		return;
		
	}
	
	/*Start - RENOMEAR ARQUIVO POR SEGURANÇA*/
	$name = $arquivo_subir_array['name'];
	
	$name = mb_strtolower( $name );
	
	$explodir_nome = explode( ' ', $name );
	
	$last_nome_numero = count( $explodir_nome ) - 1;
	
	$explodir_extensao = explode( '.', $explodir_nome[ $last_nome_numero ] );
	
	$extensao_arquivo_recebido = $explodir_extensao[1];
	
	$nome_final = '';
	
	$nome_final = date('Y-m-d-H-i-s') .'-';
	
	for( $i = 0; $i < count( $explodir_nome ) - 1; $i++){
		
		if(
			$explodir_nome[$i] != '-' &&
			$explodir_nome[$i] != ''
		){ $nome_final .= $explodir_nome[$i] .'-';}
		
	}
	
	$nome_final .= $explodir_extensao[0];
	$nome_final .= '.'. $explodir_extensao[1];
	
	$nome_final = str_replace( array_keys( $replace ), $replace, $nome_final );
	
	//dd( $pasta.$nome_final );
	/*End - RENOMEAR ARQUIVO POR SEGURANÇA*/

	if( move_uploaded_file( $arquivo_subir_array["tmp_name"], $pasta.$nome_final ) ){ //SOBE O ARQUIVO

		$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https://" : "http://"; 
		$baseurl = $protocol . $_SERVER["HTTP_HOST"] . rtrim(dirname($_SERVER['REQUEST_URI']), "/") . "/"; 
		
		echo json_encode( array( 'location' => $baseurl . $pasta . $nome_final ) );
		
	}
	else{
		
		header( 'Falha no upload do arquivo.' );
		return;
		
	}

}
/*End - SUBIR ARQUIVO*/

$sql = "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Subiu a imagem tinyMCE no módulo noticias: ".$pasta.$nome_final."','". date( 'Y-m-d H:i:s' ) ."');";
$conn->multi_query( $sql );
$conn->close();

?>