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

// Função para gerar número de protocolo para ouvidoria anônima
function gerarProtocoloOuvidoriaAnonima($id) {
    $numero = str_pad($id, 6, '0', STR_PAD_LEFT);
    return "OUV_ANONIMO_" . date('Y') . "_" . $numero;
}

// Função para upload de arquivos
function uploadArquivo($arquivo) {
    if (!isset($arquivo) || $arquivo['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    
    $extensoesPermitidas = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'];
    $tamanhoMaximo = 5 * 1024 * 1024; // 5MB
    
    $nomeOriginal = $arquivo['name'];
    $tamanho = $arquivo['size'];
    $tipoArquivo = $arquivo['type'];
    $nomeTemporario = $arquivo['tmp_name'];
    
    // Verificar extensão
    $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));
    if (!in_array($extensao, $extensoesPermitidas)) {
        throw new Exception("Extensão de arquivo não permitida. Use: " . implode(', ', $extensoesPermitidas));
    }
    
    // Verificar tamanho
    if ($tamanho > $tamanhoMaximo) {
        throw new Exception("Arquivo muito grande. Tamanho máximo: 5MB");
    }
    
    // Gerar nome único para o arquivo
    $nomeUnico = date('Y-m-d_H-i-s') . '_anonimo_' . uniqid() . '.' . $extensao;
    
    // Pasta de destino
    $pastaDestino = '../formularios_arquivos/';
    
    // Criar pasta se não existir
    if (!is_dir($pastaDestino)) {
        mkdir($pastaDestino, 0755, true);
    }
    
    $caminhoCompleto = $pastaDestino . $nomeUnico;
    
    // Fazer upload
    if (move_uploaded_file($nomeTemporario, $caminhoCompleto)) {
        return 'formularios_arquivos/' . $nomeUnico;
    } else {
        throw new Exception("Erro ao fazer upload do arquivo");
    }
}

// Verificar se é uma requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    try {
        // Processar upload de arquivo se existir
        $anexo = null;
        if (isset($_FILES['anexo']) && $_FILES['anexo']['error'] !== UPLOAD_ERR_NO_FILE) {
            $anexo = uploadArquivo($_FILES['anexo']);
        }
        
        // Capturar e sanitizar os dados do formulário
        $tipo = isset($_POST['tipo']) ? addslashes($_POST['tipo']) : '';
        $orgao = isset($_POST['orgao']) ? addslashes($_POST['orgao']) : '';
        $titulo = isset($_POST['titulo']) ? addslashes($_POST['titulo']) : '';
        $origem = isset($_POST['origem']) ? addslashes($_POST['origem']) : 'Site da Prefeitura';
        $mensagem = isset($_POST['mensagem']) ? processMessage($_POST['mensagem']) : '';
        
        // Local da ocorrência
        $local_endereco = isset($_POST['local_endereco']) ? addslashes($_POST['local_endereco']) : '';
        $local_numero = isset($_POST['local_numero']) ? addslashes($_POST['local_numero']) : '';
        $local_bairro = isset($_POST['local_bairro']) ? addslashes($_POST['local_bairro']) : '';
        $local_complemento = isset($_POST['local_complemento']) ? addslashes($_POST['local_complemento']) : '';
        $local_referencia = isset($_POST['local_referencia']) ? addslashes($_POST['local_referencia']) : '';
        
        // Montar informações do local da ocorrência (se preenchido)
        $local_ocorrencia = '';
        if (!empty($local_endereco)) {
            $local_ocorrencia = 'Local da Ocorrência: ' . $local_endereco;
            if (!empty($local_numero)) {
                $local_ocorrencia .= ', ' . $local_numero;
            }
            if (!empty($local_complemento)) {
                $local_ocorrencia .= ', ' . $local_complemento;
            }
            if (!empty($local_bairro)) {
                $local_ocorrencia .= ', ' . $local_bairro;
            }
            if (!empty($local_referencia)) {
                $local_ocorrencia .= ' - Ref: ' . $local_referencia;
            }
        }
        
        // Montar mensagem completa com todas as informações
        $mensagem_completa = "OUVIDORIA MUNICIPAL - " . strtoupper($tipo) . " [ANÔNIMO]\n\n";
        $mensagem_completa .= "Órgão/Secretaria: " . $orgao . "\n";
        $mensagem_completa .= "Forma de Resposta: Protocolo (Denúncia Anônima)\n";
        $mensagem_completa .= "Origem: " . $origem . "\n";
        $mensagem_completa .= "Sigilo: Sim\n";
        $mensagem_completa .= "Anonimato: Sim\n\n";
        $mensagem_completa .= "DESCRIÇÃO:\n" . $mensagem . "\n\n";
        
        if (!empty($local_ocorrencia)) {
            $mensagem_completa .= $local_ocorrencia . "\n\n";
        }
        
        // Dados ANÔNIMOS para compatibilidade com tabela esic
        $codigo = ''; // Será preenchido após inserção
        $nome = 'DENÚNCIA ANÔNIMA';
        $cpf = '000.000.000-00';
        $email = 'anonimo@ouvidoria.local';
        $telefone = null;
        $telefone2 = null;
        $endereco_completo = 'Não informado (Anônimo)';
        $cidade = 'Não informado';
        $estado = 'MG';
        $cep = '00000-000';
        $status = 'Aguardando Resposta';
        $identificacao = $tipo . ' - Ouvidoria Anônima';
        $data_msg = date('Y-m-d H:i:s');
        $resposta = '<p>Aguardando resposta da prefeitura. Acompanhe pelo número do protocolo.</p>';

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
            '$endereco_completo', 
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
            '$mensagem_completa', 
            '$resposta', 
            $anexo_sql
        )";

        // Executar a query
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            $last_id = mysqli_insert_id($conn);
            $protocolo = gerarProtocoloOuvidoriaAnonima($last_id);
            
            // Atualizar o registro com o protocolo gerado
            $sql_update = "UPDATE `esic` SET `codigo` = '$protocolo' WHERE `id` = $last_id";
            mysqli_query($conn, $sql_update);
            
            // Mensagens para redirecionamento
            $titulo_redirect = "Denúncia Anônima registrada com sucesso!";
            $mensagem_redirect = "Sua denúncia anônima foi registrada. GUARDE ESTE PROTOCOLO: " . $protocolo . 
                                ". Use este número para acompanhar a resposta através do sistema de consulta de protocolo. Seus dados pessoais foram mantidos em sigilo.";
            
            // Redirecionar para recados_raw com método GET incluindo btn_link=ouvidoria
            header('Location: ../recados_raw&btn_link=ouvidoria&titulo=' . urlencode($titulo_redirect) . '&mensagem=' . urlencode($mensagem_redirect) . '&id=' . $last_id . '&protocolo=' . urlencode($protocolo) . '&status=success');
            exit;
            
        } else {
            throw new Exception("Erro ao salvar no banco de dados: " . mysqli_error($conn));
        }
        
    } catch (Exception $e) {
        // Em caso de erro
        $titulo_redirect = "Erro ao registrar denúncia!";
        $mensagem_redirect = "Ocorreu um erro: " . $e->getMessage() . ". Tente novamente.";
        
        header('Location: ../recados_raw&btn_link=ouvidoria&titulo=' . urlencode($titulo_redirect) . '&mensagem=' . urlencode($mensagem_redirect) . '&status=error');
        exit;
    }
    
} else {
    // Se não for POST, redirecionar para o formulário
    $titulo_redirect = "Método não permitido";
    $mensagem_redirect = "Esta página só aceita requisições POST.";
    header('Location: ../recados_raw&btn_link=ouvidoria&titulo=' . urlencode($titulo_redirect) . '&mensagem=' . urlencode($mensagem_redirect) . '&status=error');
    exit;
}

mysqli_close($conn);
?>
