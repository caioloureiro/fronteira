<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

if( $_SERVER['HTTP_HOST'] == 'localhost' ){
    require '../model/conexao-off.php';
}else{
    require '../model/conexao-on.php';
}
require 'funcoes.php';
require '../model/esic.php';

// Função para escapar valores de forma segura
function escapeValue($value) {
    if ($value === null || $value === '') {
        return 'NULL';
    }
    return "'" . addslashes($value) . "'";
}

// Função para processar mensagens com htmlspecialchars()
function processMessage($message) {
    if ($message === null || $message === '') {
        return '';
    }
    return htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
}

// Função para gerar número de protocolo
function gerarProtocolo($id) {
    $numero = str_pad($id, 6, '0', STR_PAD_LEFT);
    return "protocolo_esic_" . $numero;
}

// Verificar se é uma requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Capturar e sanitizar os dados do formulário
    $orgao = isset($_POST['orgao']) ? addslashes($_POST['orgao']) : '';
    $titulo = isset($_POST['titulo']) ? addslashes($_POST['titulo']) : '';
    $codigo = isset($_POST['codigo']) ? addslashes($_POST['codigo']) : '';
    $nome = isset($_POST['nome']) ? addslashes($_POST['nome']) : '';
    $endereco = isset($_POST['endereco']) ? addslashes($_POST['endereco']) : '';
    $cidade = isset($_POST['cidade']) ? addslashes($_POST['cidade']) : '';
    $estado = isset($_POST['estado']) ? addslashes($_POST['estado']) : '';
    $email = isset($_POST['email']) ? addslashes($_POST['email']) : '';
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
    $telefone2 = isset($_POST['telefone2']) ? $_POST['telefone2'] : null;
    $cpf = isset($_POST['cpf']) ? addslashes($_POST['cpf']) : '';
    $cep = isset($_POST['cep']) ? addslashes($_POST['cep']) : '';
    $tipo = isset($_POST['tipo']) ? addslashes($_POST['tipo']) : '';
    $status = isset($_POST['status']) ? addslashes($_POST['status']) : 'Protocolo Registrado';
    $identificacao = isset($_POST['identificacao']) ? addslashes($_POST['identificacao']) : '';
    $data_msg = isset($_POST['data']) ? addslashes($_POST['data']) : date('Y-m-d H:i:s');
    $mensagem = isset($_POST['mensagem']) ? processMessage($_POST['mensagem']) : '';
    $resposta = isset($_POST['resposta']) ? addslashes($_POST['resposta']) : '<p>Aguardando resposta da prefeitura.</p>';
    $anexo = isset($_POST['anexo']) ? $_POST['anexo'] : null;

    // Preparar os valores para o SQL
    $telefone_sql = escapeValue($telefone);
    $telefone2_sql = escapeValue($telefone2);
    $anexo_sql = escapeValue($anexo);

    // Montar a query SQL
    $sql = "INSERT INTO `esic` (
        `ativo`, 
        `created_at`, 
        `updated_at`, 
        `orgao`, 
        `titulo`, 
        `codigo`, 
        `nome`, 
        `endereco`, 
        `cidade`, 
        `estado`, 
        `email`, 
        `telefone`, 
        `telefone2`, 
        `cpf`, 
        `cep`, 
        `tipo`, 
        `status`, 
        `identificacao`, 
        `data`, 
        `mensagem`, 
        `resposta`, 
        `anexo`
    ) VALUES (
        1, 
        NOW(), 
        NOW(), 
        '$orgao', 
        '$titulo', 
        '$codigo', 
        '$nome', 
        '$endereco', 
        '$cidade', 
        '$estado', 
        '$email', 
        $telefone_sql, 
        $telefone2_sql, 
        '$cpf', 
        '$cep', 
        '$tipo', 
        '$status', 
        '$identificacao', 
        '$data_msg', 
        '$mensagem', 
        '$resposta', 
        $anexo_sql
    )";

    // Executar a query
    try {
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            $last_id = mysqli_insert_id($conn);
            $protocolo = gerarProtocolo($last_id);
            
            // Mensagens fixas para redirecionamento
            $titulo_redirect = "Solicitação ESIC registrada com sucesso!";
            $mensagem_redirect = "Guarde esta chave e email para acompanhar a prospecção com a prefeitura. Protocolo " . $protocolo;
            
            // Atualizar o registro com o protocolo gerado (opcional)
            $sql_update = "UPDATE `esic` SET `codigo` = '$protocolo' WHERE `id` = $last_id";
            mysqli_query($conn, $sql_update);
            
            // Redirecionar para recados_raw com método GET incluindo btn_link=esic
            header('Location: ../recados_raw&btn_link=esic&titulo=' . urlencode($titulo_redirect) . '&mensagem=' . urlencode($mensagem_redirect) . '&id=' . $last_id . '&protocolo=' . urlencode($protocolo) . '&status=success');
            exit();
            
        } else {
            // Em caso de erro, redirecionar com mensagem de erro
            $titulo_redirect = "Erro no registro ESIC";
            $mensagem_redirect = "Ocorreu um erro ao registrar sua solicitação. Tente novamente.";
            header('Location: ../recados_raw&btn_link=esic&titulo=' . urlencode($titulo_redirect) . '&mensagem=' . urlencode($mensagem_redirect) . '&status=error');
            exit();
        }
    } catch (Exception $e) {
        // Em caso de exceção, redirecionar com mensagem de erro
        $titulo_redirect = "Erro no sistema ESIC";
        $mensagem_redirect = "Erro: " . $e->getMessage();
        header('Location: ../recados_raw&btn_link=esic&titulo=' . urlencode($titulo_redirect) . '&mensagem=' . urlencode($mensagem_redirect) . '&status=error');
        exit();
    }

} else {
    // Se não for POST, redirecionar para recados_raw
    $titulo_redirect = "Método não permitido";
    $mensagem_redirect = "Esta página só aceita requisições POST.";
    header('Location: ../recados_raw&btn_link=esic&titulo=' . urlencode($titulo_redirect) . '&mensagem=' . urlencode($mensagem_redirect) . '&status=error');
    exit();
}

// Fechar conexão se existir
if (isset($conn)) {
    mysqli_close($conn);
}
?>