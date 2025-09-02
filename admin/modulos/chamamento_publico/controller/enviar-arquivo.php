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
//echo'<pre>'; var_dump( $_FILES ); echo'</pre>'; exit;

//$arquivo_subir_array = $_FILES['arquivo_subir'];

reset( $_FILES ); 
$arquivo_subir_array = current( $_FILES );

//echo $arquivo_subir_array['name']; exit;

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
	"vnd.openxmlformats-officedocument.spreadsheetml.sheet",
	"xlsx",
	"xls",
	"pdf",
	"zip",
	"rar",
	"doc",
	"docx",
	"xls",
	"xlsx",
	"bmp",
	"jpg",
	"jpeg",
	"png",
	"webp",
	"afiv",
);

$arquivo_aceito = 0;

$tamanho_em_mb = 200;

$tamanho_maximo = 1024 * ( $tamanho_em_mb * 1000 ); //TAMANHO MÁXIMO

$pasta = $raiz_site .'arquivos/';

$contagem = 0;

require $raiz_site .'controller/replace.php'; //ARQUIVO REPLACE.PHP COM ARRAY DE ITENS PARA SUBSTITUIR

//echo $arquivo_subir_array['name']; exit;

//$tipo_de_arquivo = explode( '/', trim( strip_tags( $arquivo_subir_array['type'] ) ) );
$tipo_de_arquivo_array = explode( '.', trim( strip_tags( $arquivo_subir_array['name'] ) ) );
$tipo_de_arquivo = $tipo_de_arquivo_array[ count( $tipo_de_arquivo_array ) -1 ];

//echo $tipo_de_arquivo; exit;

foreach( $formatos_validos as $allow ){
	
	if( $tipo_de_arquivo == $allow ){ 
		
		$arquivo_aceito = 1;
		
	}
	
}

//echo $arquivo_aceito; exit;

if( $arquivo_aceito == 0 ){

	echo'O tipo de arquivo '. $tipo_de_arquivo .' não é aceito.';
	exit;

}

if( $arquivo_subir_array['error'] == 4 ) {
	
	echo'O arquivo possui erro: '. $arquivo_subir_array['error'] .'';
	exit;
	
}

if( $arquivo_subir_array['error'] == 0 ){ //SEM ERROS
	
	//dd( $arquivo_subir_array['size'] .' > '. $tamanho_maximo );
	
	if( $arquivo_subir_array['size'] > $tamanho_maximo ) {

		echo'O arquivo é muito grande. Deve ser menor que '. $tamanho_em_mb .'MB.';
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
	
	//dd( $pasta.$nome_final );
	/*End - RENOMEAR ARQUIVO POR SEGURANÇA*/

	if( move_uploaded_file( $arquivo_subir_array["tmp_name"], $pasta.$nome_final ) ){ //SOBE O ARQUIVO

		$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https://" : "http://"; 
		$baseurl = $protocol . $_SERVER["HTTP_HOST"] . rtrim(dirname($_SERVER['REQUEST_URI']), "/") . "/"; 
		
		//echo json_encode( array( 'location' => $baseurl . $pasta . $nome_final ) );
		echo'Arquivo enviado com sucesso: '. $nome_final .'.';
		
	}
	else{
		
		echo'Falha no upload do arquivo.';
		exit;
		
	}

}
/*End - SUBIR ARQUIVO*/

$hoje = date( 'Y-m-d H:i:s' );

//echo current( $_POST );
$chamamento_publico_id = current( $_POST );

$sql .= "".
"INSERT INTO downloads (".
	"nome, ".
	"link, ".
	"data, ".
	"tipo, ".
	"categorias, ".
	"arquivo ".
") VALUES ( ".
	"'". $name ."', ".
	"'#', ".
	"'". $hoje ."', ".
	"'". $tipo_de_arquivo ."', ".
	"'Chamamento Público', ".
	"'". $nome_final ."' ".
"); ".

"INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ( ".
	"'". $_COOKIE['botucatu_ADMIN_SESSION_usuario'] ."',".
	"'Subiu o arquivo ( chamamento_publico ): ".$pasta.$nome_final."',".
	"'". date( 'Y-m-d H:i:s' ) ."'".
"); ".
"";

$conn->multi_query( $sql );
$conn->close();

?>