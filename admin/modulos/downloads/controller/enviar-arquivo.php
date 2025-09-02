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

$arquivo_subir_array = $_FILES['arquivo_subir'];

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
	"pdf",
	"png",
	"webp",
	"avif",
	
	"BMP",
	"GIF",
	"JPEG",
	"JPG",
	"PDF",
	"PNG",
	"WEBP",
	"AVIF",
	
	"rar",
	"zip",
	
	"RAR",
	"ZIP",
	
	"doc",
	"docx",
	"xls",
	"xlsx",
	"ppt",
	"pptx",
	"txt",
	
	"DOC",
	"DOCX",
	"XLS",
	"XLSX",
	"PPT",
	"PPTX",
	"TXT",
);

$arquivo_aceito = 0;

$tamanho_em_mb = 200;

$tamanho_maximo = 1024 * ( $tamanho_em_mb * 1000 ); //TAMANHO MÁXIMO

$pasta = $raiz_site .'arquivos/';

$contagem = 0;

require $raiz_admin .'controller/replace.php'; //ARQUIVO REPLACE.PHP COM ARRAY DE ITENS PARA SUBSTITUIR

//$tipo_de_arquivo = explode( '/', trim( strip_tags( $arquivo_subir_array['type'] ) ) );

$tipo_de_arquivo_array = explode( '.', trim( strip_tags( $arquivo_subir_array['name'] ) ) );

//dd( $tipo_de_arquivo_array );

$tipo_de_arquivo = $tipo_de_arquivo_array[ count($tipo_de_arquivo_array) -1];

//dd( $tipo_de_arquivo );

foreach( $formatos_validos as $allow ){
	
	if( $tipo_de_arquivo == $allow ){ 
		
		$arquivo_aceito = 1;
		
	}
	
}

//dd( $arquivo_aceito );

if( $arquivo_aceito == 0 ){

	echo'
	<script> 
		alert("O tipo de arquivo '. $tipo_de_arquivo .' não é aceito.");
		window.history.back(); 
	</script>
	';
	
	exit; 

}

if( $arquivo_subir_array['error'] == 4 ) {
	
	echo'
	<script> 
		alert("O arquivo não subiu.");
		window.history.back(); 
	</script>
	';
	
	exit; 
	
}

if( $arquivo_subir_array['error'] == 0 ){ //SEM ERROS
	
	//dd( $arquivo_subir_array['size'] .' > '. $tamanho_maximo );
	
	if( $arquivo_subir_array['size'] > $tamanho_maximo ) {

		echo'
		<script> 
			alert("O arquivo é muito grande. Deve ser menor que 5MB.");
			window.history.back(); 
		</script>
		';
		
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
	
	//dd( $nome_final );
	/*End - RENOMEAR ARQUIVO POR SEGURANÇA*/

	move_uploaded_file( $arquivo_subir_array["tmp_name"], $pasta.$nome_final ); //SOBE O ARQUIVO

}
/*End - SUBIR ARQUIVO*/

$sql = "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Subiu o arquivo ( exemplo ): ".$pasta.$nome_final."','". date( 'Y-m-d H:i:s' ) ."');";
$conn->multi_query( $sql );
$conn->close();

echo'<script> window.location = "../view/novo-02?arquivo='. $nome_final .'"; </script>';

?>