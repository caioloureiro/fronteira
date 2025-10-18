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

// Verificar se os dados foram enviados
if(!isset($_POST['arquivo_servidor']) || !isset($_POST['licitacao_id'])) {
	retornarResposta(false, 'Dados incompletos.');
}

$arquivo_servidor = $_POST['arquivo_servidor'];
$licitacao_id = $_POST['licitacao_id'];

// Verificar se o arquivo existe no servidor
$caminho_arquivo = $raiz_site . 'uploads/' . $arquivo_servidor;
if(!file_exists($caminho_arquivo)) {
	retornarResposta(false, 'Arquivo não encontrado no servidor.');
}

// Verificar se o arquivo já está sendo usado como edital desta licitação
$sql_check_edital = "SELECT edital FROM licitacoes WHERE id = " . intval($licitacao_id);
$result_edital = $conn->query($sql_check_edital);
if($result_edital && $result_edital->num_rows > 0) {
	$row_edital = $result_edital->fetch_assoc();
	
	// Normalizar caminhos para comparação - remover 'uploads/' se existir
	$edital_atual = str_replace('uploads/', '', $row_edital['edital']);
	$arquivo_comparar = str_replace('uploads/', '', $arquivo_servidor);
	
	if($edital_atual === $arquivo_comparar && !empty($edital_atual)) {
		retornarResposta(false, 'ERRO: Este arquivo já está sendo usado como EDITAL da licitação. O edital não pode ser anexo.');
	}
}

// Verificar se o arquivo já existe como anexo desta licitação
$sql_check_anexo = "SELECT id FROM licitacoes_anexos WHERE licitacao = " . intval($licitacao_id) . " AND arquivo = '" . addslashes($arquivo_servidor) . "' AND ativo = 1";
$result_anexo = $conn->query($sql_check_anexo);
if($result_anexo && $result_anexo->num_rows > 0) {
	retornarResposta(false, 'Este arquivo já foi adicionado como anexo desta licitação.');
}

// Obter informações do arquivo
$extensao = strtolower(pathinfo($arquivo_servidor, PATHINFO_EXTENSION));
$tamanho = filesize($caminho_arquivo);
$nome_original = pathinfo($arquivo_servidor, PATHINFO_BASENAME);

// Preparar dados para inserção no banco
$hoje = date( 'Y-m-d H:i:s' );

$sql = "INSERT INTO licitacoes_anexos (
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
	'". addslashes($nome_original) ."', 
	'". addslashes($arquivo_servidor) ."',
	". intval($licitacao_id) ."
);";

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Anexou arquivo do servidor para licitação: ".$arquivo_servidor."','". date( 'Y-m-d H:i:s' ) ."');";

if($conn->multi_query( $sql )) {
	// Buscar o ID do anexo inserido
	$anexo_id = $conn->insert_id;
	
	// Preparar dados do anexo para retorno
	$anexo_dados = [
		'id' => $anexo_id,
		'nome_original' => $nome_original,
		'nome_arquivo' => $arquivo_servidor,
		'extensao' => $extensao,
		'tamanho' => $tamanho,
		'url' => $raiz_site . 'uploads/' . $arquivo_servidor,
		'data_formatada' => date('d/m/Y H:i')
	];
	
	retornarResposta(true, 'Arquivo anexado com sucesso', $anexo_dados);
} else {
	retornarResposta(false, 'Erro ao salvar anexo no banco de dados.');
}

$conn->close();
?>