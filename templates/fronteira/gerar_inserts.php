<?php
// Configurar charset
header('Content-Type: text/html; charset=utf-8');

echo "<pre>";
echo "-- Geração de INSERTs MySQL\n";
echo "-- Data: " . date('Y-m-d H:i:s') . "\n\n";

// Array para armazenar os IDs das licitações para manter referência
$licitacoes_ids = array();

// 1. Primeiro processamos o arquivo de licitações
echo "-- Processando licitações...\n";
if (($handle = fopen('licitacao.csv', 'r')) !== FALSE) {
    // Ler cabeçalho
    $cabecalho = fgetcsv($handle);
    
    while (($data = fgetcsv($handle)) !== FALSE) {
        $linha = array_combine($cabecalho, $data);
        
        // Tratar campos nulos e escapar strings
        $id = $linha['id'];
        $idEntidadeLicitacao = $linha['idEntidadeLicitacao'] ?: 'NULL';
        $idModalidade = $linha['idModalidade'] ?: 'NULL';
        $idStatusLicitacao = $linha['idStatusLicitacao'] ?: 'NULL';
        $numero = !empty($linha['numero']) ? "'" . addslashes($linha['numero']) . "'" : 'NULL';
        $ano = !empty($linha['ano']) ? "'" . addslashes($linha['ano']) . "'" : 'NULL';
        $dataAbertura = !empty($linha['dataAbertura']) ? "'" . date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $linha['dataAbertura']))) . "'" : 'NULL';
        $dataPublicacao = !empty($linha['dataPublicacao']) ? "'" . date('Y-m-d', strtotime(str_replace('/', '-', $linha['dataPublicacao']))) . "'" : 'NULL';
        $objeto = !empty($linha['objeto']) ? "'" . addslashes($linha['objeto']) . "'" : 'NULL';
        $referencia = !empty($linha['referencia']) ? "'" . addslashes($linha['referencia']) . "'" : 'NULL';
        $link = !empty($linha['link']) ? "'" . addslashes($linha['link']) . "'" : 'NULL';
        $numeroProcesso = !empty($linha['numeroProcesso']) ? "'" . addslashes($linha['numeroProcesso']) . "'" : 'NULL';
        $created_at = !empty($linha['created_at']) ? "'" . date('Y-m-d H:i:s', strtotime($linha['created_at'])) . "'" : 'NULL';
        $updated_at = !empty($linha['updated_at']) ? "'" . date('Y-m-d H:i:s', strtotime($linha['updated_at'])) . "'" : 'NULL';
        $valorEstimado = !empty($linha['valorEstimado']) ? "'" . addslashes($linha['valorEstimado']) . "'" : 'NULL';
        
        // Armazenar ID original para referência
        $licitacoes_ids[] = $id;
        
        // Gerar INSERT
        echo "INSERT INTO licitacoes (id, id_entidade_licitacao, id_modalidade, id_status_licitacao, numero, ano, data_abertura, data_publicacao, objeto, referencia, link, numero_processo, created_at, updated_at, valor_estimado) VALUES ";
        echo "($id, $idEntidadeLicitacao, $idModalidade, $idStatusLicitacao, $numero, $ano, $dataAbertura, $dataPublicacao, $objeto, $referencia, $link, $numeroProcesso, $created_at, $updated_at, $valorEstimado);\n";
    }
    fclose($handle);
}

echo "\n-- Processando anexos das licitações...\n";
if (($handle = fopen('arquivoLicitacao.csv', 'r')) !== FALSE) {
    // Ler cabeçalho
    $cabecalho = fgetcsv($handle);
    
    while (($data = fgetcsv($handle)) !== FALSE) {
        $linha = array_combine($cabecalho, $data);
        
        // Só inserir anexos de licitações que existem
        if (in_array($linha['idLicitacao'], $licitacoes_ids)) {
            // Tratar campos nulos e escapar strings
            $nome = !empty($linha['nome']) ? "'" . addslashes($linha['nome']) . "'" : 'NULL';
            $arquivo = !empty($linha['nomeArquivo']) ? "'" . addslashes($linha['nomeArquivo']) . "'" : 'NULL';
            $licitacao_id = $linha['idLicitacao'];
            $created_at = !empty($linha['created_at']) ? "'" . date('Y-m-d H:i:s', strtotime($linha['created_at'])) . "'" : 'NULL';
            $updated_at = !empty($linha['updated_at']) ? "'" . date('Y-m-d H:i:s', strtotime($linha['updated_at'])) . "'" : 'NULL';
            
            // Gerar INSERT
            echo "INSERT INTO licitacoes_anexos (nome, arquivo, licitacao, created_at, updated_at) VALUES ";
            echo "($nome, $arquivo, $licitacao_id, $created_at, $updated_at);\n";
        }
    }
    fclose($handle);
}

echo "\n-- Geração de INSERTs concluída!\n";
echo "</pre>";
?>