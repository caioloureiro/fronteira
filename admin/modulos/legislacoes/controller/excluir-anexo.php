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
function retornarResposta($sucesso, $mensagem) {
	header('Content-Type: application/json');
	echo json_encode([
		'sucesso' => $sucesso,
		'mensagem' => $mensagem
	]);
	exit;
}

/*Start - EXCLUIR ANEXO*/
$anexo_id = isset($_POST['anexo_id']) ? intval($_POST['anexo_id']) : 0;
$pasta = $raiz_site .'uploads/';

if( $anexo_id <= 0 ){
	retornarResposta(false, 'ID do anexo não fornecido.');
}

// Buscar informações do anexo
$sql_buscar = "SELECT * FROM legislacoes_anexos WHERE id = $anexo_id";
$result = $conn->query($sql_buscar);

if( !$result || $result->num_rows == 0 ){
	retornarResposta(false, 'Anexo não encontrado.');
}

$anexo = $result->fetch_assoc();

// Desativar no banco de dados (UPDATE ativo = 0) - NÃO remover arquivo físico
$hoje = date('Y-m-d H:i:s');
$sql_desativar = "UPDATE legislacoes_anexos SET ativo = 0, updated_at = '$hoje' WHERE id = $anexo_id";

if( $conn->query($sql_desativar) ){
	
	// Log da ação
	$sql_log = "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Desativou anexo de legislação: ".$anexo['arquivo']."','". date( 'Y-m-d H:i:s' ) ."')";
	$conn->query($sql_log);
	
	retornarResposta(true, 'Anexo excluído com sucesso.');
	
} else {
	retornarResposta(false, 'Erro ao excluir anexo do banco de dados.');
}

$conn->close();
?>