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

// Função para formatar tamanho
function formatarTamanhoArquivo($bytes) {
	if ($bytes >= 1048576) {
		return number_format($bytes / 1048576, 2) . ' MB';
	} elseif ($bytes >= 1024) {
		return number_format($bytes / 1024, 2) . ' KB';
	} else {
		return $bytes . ' bytes';
	}
}

// Função para retornar resposta JSON
function retornarResposta($sucesso, $mensagem, $dados = null) {
	header('Content-Type: application/json');
	echo json_encode([
		'sucesso' => $sucesso,
		'mensagem' => $mensagem,
		'anexo' => $dados
	]);
	exit;
}

/*Start - SUBIR ANEXO*/
reset( $_FILES ); 
$arquivo_subir_array = current( $_FILES );

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
	"pdf",
	"zip",
	"rar",
	"7z",
	"doc",
	"xls",
	"ppt",
	"docx",
	"xlsx",
	"pptx",
	
	"PDF",
	"ZIP",
	"RAR",
	"7Z",
	"DOC",
	"XLS",
	"PPT",
	"DOCX",
	"XLSX",
	"PPTX",
);

$arquivo_aceito = 0;
$tamanho_maximo = 1024 * 200000; // 200MB
$pasta = $raiz_site .'uploads/';

require $raiz_site .'controller/replace.php'; //ARQUIVO REPLACE.PHP COM ARRAY DE ITENS PARA SUBSTITUIR

$tipo_de_arquivo = explode( '/', trim( strip_tags( $arquivo_subir_array['type'] ) ) );
$extensao_arquivo = strtolower(pathinfo($arquivo_subir_array['name'], PATHINFO_EXTENSION));

// Verificar extensão do arquivo
foreach( $formatos_validos as $allow ){
	if( $extensao_arquivo == $allow ){ 
		$arquivo_aceito = 1;
		break;
	}
}

if( $arquivo_aceito == 0 ){
	retornarResposta(false, 'O tipo de arquivo '. $extensao_arquivo .' não é aceito.');
}

if( $arquivo_subir_array['error'] == 4 ) {
	retornarResposta(false, 'Nenhum arquivo foi enviado.');
}

if( $arquivo_subir_array['error'] != 0 ) {
	retornarResposta(false, $phpFileUploadErrors[$arquivo_subir_array['error']]);
}

if( $arquivo_subir_array['size'] > $tamanho_maximo ) {
	retornarResposta(false, 'O arquivo é muito grande. Deve ser menor que 200MB.');
}

/*Start - RENOMEAR ARQUIVO POR SEGURANÇA*/
$name = $arquivo_subir_array['name'];
$name = mb_strtolower( $name );

$explodir_nome = explode( ' ', $name );
$last_nome_numero = count( $explodir_nome ) - 1;
$explodir_extensao = explode( '.', $explodir_nome[ $last_nome_numero ] );
$extensao_arquivo_recebido = $explodir_extensao[count($explodir_extensao) - 1];

$nome_final = '';
$nome_final = date('Y-m-d-H-i-s') .'-';

for( $i = 0; $i < count( $explodir_nome ) - 1; $i++){
	if(
		$explodir_nome[$i] != '-' &&
		$explodir_nome[$i] != ''
	){ 
		$nome_final .= $explodir_nome[$i] .'-';
	}
}

// Adicionar parte do nome do arquivo sem extensão
if(count($explodir_extensao) > 1) {
	for( $j = 0; $j < count( $explodir_extensao ) - 1; $j++){
		if($j > 0) $nome_final .= '-';
		$nome_final .= $explodir_extensao[$j];
	}
}

$nome_final .= '.'. $extensao_arquivo_recebido;
$nome_final = str_replace( array_keys( $replace ), $replace, $nome_final );
/*End - RENOMEAR ARQUIVO POR SEGURANÇA*/

if( move_uploaded_file( $arquivo_subir_array["tmp_name"], $pasta.$nome_final ) ){ //SOBE O ARQUIVO
	
	$hoje = date( 'Y-m-d H:i:s' );
	$licitacao_id = isset($_POST['licitacao_id']) ? $_POST['licitacao_id'] : 'nova';
	$nome_original = addslashes($arquivo_subir_array['name']);
	
	// Preparar dados do anexo para retorno
	$anexo_dados = [
		'nome_original' => $arquivo_subir_array['name'],
		'nome_arquivo' => $nome_final,
		'extensao' => $extensao_arquivo,
		'tamanho' => $arquivo_subir_array['size'],
		'tamanho_formatado' => formatarTamanhoArquivo($arquivo_subir_array['size']),
		'url' => $raiz_site . 'uploads/' . $nome_final,
		'data_formatada' => date('d/m/Y H:i')
	];
	
	// Se for uma licitação nova, não salvar no banco ainda (será salvo quando criar a licitação)
	if($licitacao_id != 'nova') {
		$sql .= "INSERT INTO licitacoes_anexos (
			ativo,
			created_at,
			updated_at,
			nome, 
			arquivo,
			licitacao
		) VALUES (
			1,
			'". $hoje ."',
			'". $hoje ."', 
			'". $nome_original ."', 
			'". addslashes($nome_final) ."',
			". intval($licitacao_id) ."
		);";

		$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Subiu anexo para licitação: ".$pasta.$nome_final."','". date( 'Y-m-d H:i:s' ) ."');";
		
		if($conn->multi_query( $sql )) {
			// Buscar o ID do anexo inserido
			$anexo_id = $conn->insert_id;
			$anexo_dados['id'] = $anexo_id;
		}
	}
	
	retornarResposta(true, 'Arquivo enviado com sucesso', $anexo_dados);
	
}
else{
	retornarResposta(false, 'Falha no upload do arquivo.');
}

$conn->close();
?>