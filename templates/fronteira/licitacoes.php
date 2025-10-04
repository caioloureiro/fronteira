<?php
header('Content-Type: text/plain; charset=utf-8');

// Função para formatar datas
function formatarData($data) {
    if (empty($data)) return 'NULL';
    
    $date = DateTime::createFromFormat('j/n/Y H:i:s', $data);
    if ($date === false) {
        $date = DateTime::createFromFormat('j/n/Y', $data);
    }
    if ($date === false) {
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $data);
    }
    if ($date === false) {
        $date = DateTime::createFromFormat('Y-m-d', $data);
    }
    
    return $date ? "'" . $date->format('Y-m-d H:i:s') . "'" : 'NULL';
}

// Função para escapar strings para SQL
function escaparString($str) {
    if (empty($str)) return 'NULL';
    if (is_numeric($str)) return $str;
    return "'" . str_replace("'", "''", trim($str)) . "'";
}

// Arrays para armazenar dados
$licitacoes_ids = array();

// Ler o arquivo de licitações
if (!file_exists('licitacao.csv')) {
    die('Arquivo licitacao.csv não encontrado');
}

$arquivo = fopen('licitacao.csv', 'r');
if (!$arquivo) {
    die('Erro ao abrir arquivo licitacao.csv');
}

// Pular o cabeçalho e pegar índices das colunas
$cabecalho = fgetcsv($arquivo, 1000, ",");
$indices = array_flip($cabecalho);

echo "-- Inserindo licitações\n";
echo "INSERT INTO licitacoes (id, categoria, situacao, numero, ano_contrato, abertura, ";
echo "publicacao, objeto, mensagem, edital, created_at, updated_at, valor_estimado, ";
echo "prazo_vigencia, numero_contrato, ativo) VALUES\n";

$first = true;

while (($linha = fgetcsv($arquivo, 1000, ",")) !== FALSE) {
    if (!$first) {
        echo ",\n";
    }
    
    $id = $linha[$indices['id']];
    $licitacoes_ids[] = $id;

    // Prepara os valores mapeados
    $categoria = isset($indices['idModalidade']) ? $linha[$indices['idModalidade']] : 'NULL';
    $situacao = isset($indices['idStatusLicitacao']) ? $linha[$indices['idStatusLicitacao']] : 'NULL';
    $numero = isset($indices['numero']) ? "'" . str_replace("'", "''", $linha[$indices['numero']]) . "'" : 'NULL';
    $ano_contrato = isset($indices['anoContrato']) ? "'" . str_replace("'", "''", $linha[$indices['anoContrato']]) . "'" : 'NULL';
    $abertura = isset($indices['dataAbertura']) ? formatarData($linha[$indices['dataAbertura']]) : 'NULL';
    $publicacao = isset($indices['dataPublicacao']) ? formatarData($linha[$indices['dataPublicacao']]) : 'NULL';
    $objeto = isset($indices['objeto']) ? "'" . str_replace("'", "''", $linha[$indices['objeto']]) . "'" : 'NULL';
    $mensagem = isset($indices['referencia']) ? "'" . str_replace("'", "''", $linha[$indices['referencia']]) . "'" : 'NULL';
    $edital = isset($indices['nomeArquivo']) ? "'" . str_replace("'", "''", $linha[$indices['nomeArquivo']]) . "'" : 'NULL';
    $created_at = isset($indices['created_at']) ? formatarData($linha[$indices['created_at']]) : 'NOW()';
    $updated_at = isset($indices['updated_at']) ? formatarData($linha[$indices['updated_at']]) : 'NOW()';
    $valor_estimado = isset($indices['valorEstimado']) ? "'" . str_replace("'", "''", $linha[$indices['valorEstimado']]) . "'" : 'NULL';
    $prazo_vigencia = isset($indices['prazoVigencia']) ? "'" . str_replace("'", "''", $linha[$indices['prazoVigencia']]) . "'" : 'NULL';
    $numero_contrato = isset($indices['numeroContrato']) ? "'" . str_replace("'", "''", $linha[$indices['numeroContrato']]) . "'" : 'NULL';

    echo "($id, $categoria, $situacao, $numero, $ano_contrato, $abertura, ";
    echo "$publicacao, $objeto, $mensagem, $edital, $created_at, $updated_at, ";
    echo "$valor_estimado, $prazo_vigencia, $numero_contrato, 1)";
    
    $first = false;
}
echo ";\n\n";
fclose($arquivo);

// Ler o arquivo de anexos
if (!file_exists('arquivoLicitacao.csv')) {
    die('Arquivo arquivoLicitacao.csv não encontrado');
}

$arquivo = fopen('arquivoLicitacao.csv', 'r');
if (!$arquivo) {
    die('Erro ao abrir arquivo arquivoLicitacao.csv');
}

// Pular o cabeçalho
$cabecalho = fgetcsv($arquivo, 1000, ",");
$indices = array_flip($cabecalho);

echo "-- Inserindo anexos das licitações\n";
echo "INSERT INTO licitacoes_anexos (nome, arquivo, licitacao, created_at, updated_at, ativo) VALUES\n";

$first = true;
$tem_anexos = false;

while (($linha = fgetcsv($arquivo, 1000, ",")) !== FALSE) {
    $idLicitacao = $linha[$indices['idLicitacao']];
    
    // Verifica se a licitação existe
    if (empty($idLicitacao) || !in_array($idLicitacao, $licitacoes_ids)) {
        continue;
    }
    
    if (!$first) {
        echo ",\n";
    }
    
    $nome = isset($linha[$indices['nome']]) ? "'" . str_replace("'", "''", $linha[$indices['nome']]) . "'" : 'NULL';
    $arquivo_nome = isset($linha[$indices['nomeArquivo']]) ? "'" . str_replace("'", "''", $linha[$indices['nomeArquivo']]) . "'" : 'NULL';
    $created_at = isset($linha[$indices['created_at']]) ? formatarData($linha[$indices['created_at']]) : 'NOW()';
    $updated_at = isset($linha[$indices['updated_at']]) ? formatarData($linha[$indices['updated_at']]) : 'NOW()';

    echo "($nome, $arquivo_nome, $idLicitacao, $created_at, $updated_at, 1)";
    
    $first = false;
    $tem_anexos = true;
}

if ($tem_anexos) {
    echo ";\n\n";
}
fclose($arquivo);

echo "-- Importação concluída!\n";
