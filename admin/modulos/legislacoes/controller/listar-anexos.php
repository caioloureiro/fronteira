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

// Verificar se foi enviado o ID da legislação
if (!isset($_GET['legislacao']) || empty($_GET['legislacao'])) {
    echo '<div class="mensagem-vazia">Nenhuma legislação especificada</div>';
    exit;
}

$legislacao = intval($_GET['legislacao']);

try {
    // Buscar anexos da legislação específica
    $sql = "SELECT * FROM legislacoes_anexos WHERE legislacao = ? AND ativo = 1 ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $legislacao);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows === 0) {
        echo '<div class="mensagem-vazia">Nenhum anexo encontrado</div>';
    } else {
        while ($anexo = $resultado->fetch_assoc()) {
            $nome_arquivo = htmlspecialchars($anexo['nome']);
            $caminho_arquivo = htmlspecialchars($anexo['arquivo']);
            $id_anexo = $anexo['id'];
            
            // Se o nome estiver vazio, extrair do arquivo removendo timestamp
            if(empty($nome_arquivo)) {
                // Remover timestamp (YYYY-MM-DD-HH-MM-SS-) do início do nome do arquivo
                $nome_limpo = preg_replace('/^\d{4}-\d{2}-\d{2}-\d{2}-\d{2}-\d{2}-/', '', $caminho_arquivo);
                $nome_arquivo = $nome_limpo;
            }
            
            echo '
            <div class="thumb-anexo" data-anexo-id="' . $id_anexo . '">
                <div 
                    class="thumb-anexo-excluir"
                    title="Excluir anexo"
                >❌</div>
                <div class="thumb-anexo-icon"></div>
                <div class="thumb-anexo-nome" title="' . $nome_arquivo . '">' . $nome_arquivo . '</div>
            </div>
            ';
        }
    }
    
} catch (Exception $e) {
    echo '<div class="mensagem-erro">Erro ao carregar anexos: ' . htmlspecialchars($e->getMessage()) . '</div>';
}

?>