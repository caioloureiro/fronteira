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
if(!isset($_POST['nome_arquivo']) || !isset($_POST['pagina'])) {
	retornarResposta(false, 'Dados incompletos.');
}

$nome_arquivo = $_POST['nome_arquivo'];
$pagina = $_POST['pagina'];

// Verificar se o arquivo existe no servidor
$caminho_arquivo = $raiz_site . 'uploads/' . $nome_arquivo;
if(!file_exists($caminho_arquivo)) {
	retornarResposta(false, 'Arquivo não encontrado no servidor.');
}

// Obter informações do arquivo
$extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
$tamanho = filesize($caminho_arquivo);
$nome_original = pathinfo($nome_arquivo, PATHINFO_BASENAME);

// Preparar dados para inserção no banco
$hoje = date( 'Y-m-d H:i:s' );

$sql = "INSERT INTO paginas_anexos (
	ativo,
	created_at,
	updated_at,
	nome, 
	arquivo,
	pagina
) VALUES (
	1,
	'". $hoje ."',
	'". $hoje ."', 
	'". addslashes($nome_original) ."', 
	'". addslashes($nome_arquivo) ."',
	". intval($pagina) ."
);";

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Anexou arquivo do servidor para página: ".$nome_arquivo."','". date( 'Y-m-d H:i:s' ) ."');";

if($conn->multi_query( $sql )) {
	// Buscar o ID do anexo inserido
	$anexo_id = $conn->insert_id;
	
	// Preparar dados do anexo para retorno
	$anexo_dados = [
		'id' => $anexo_id,
		'nome_original' => $nome_original,
		'nome_arquivo' => $nome_arquivo,
		'extensao' => $extensao,
		'tamanho' => $tamanho,
		'url' => $raiz_site . 'uploads/' . $nome_arquivo,
		'data_formatada' => date('d/m/Y H:i')
	];
	
	retornarResposta(true, 'Arquivo anexado com sucesso', $anexo_dados);
} else {
	retornarResposta(false, 'Erro ao salvar anexo no banco de dados.');
}

$conn->close();
?>
