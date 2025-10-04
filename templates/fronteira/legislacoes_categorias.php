<?php
// Configurações
$csv_file = 'fronteira/categoriaLegislacao.csv';

// Verificar se o arquivo existe
if (!file_exists($csv_file)) {
    die("Arquivo CSV não encontrado: $csv_file");
}

// Ler o conteúdo do CSV
$handle = fopen($csv_file, 'r');
if ($handle === false) {
    die("Erro ao abrir o arquivo CSV");
}

// Pular o cabeçalho
fgetcsv($handle);

// Array para armazenar os inserts
$inserts = [];

// Processar cada linha do CSV
while (($data = fgetcsv($handle)) !== false) {
    // Extrair dados da linha
    $id = $data[0];
    $nome = $data[1];
    $created_at = $data[2];
    $updated_at = $data[3];
    
    // Tratar valores NULL
    $nome = $nome !== '' ? "'" . addslashes($nome) . "'" : 'NULL';
    $created_at = $created_at !== '' ? "'" . addslashes($created_at) . "'" : 'NULL';
    $updated_at = $updated_at !== '' ? "'" . addslashes($updated_at) . "'" : 'NULL';
    
    // Gerar comando INSERT
    $sql = "INSERT INTO legislacoes_categorias (nome, created_at, updated_at) VALUES ($nome, $created_at, $updated_at);";
    $inserts[] = $sql;
}

fclose($handle);

// Exibir os comandos SQL na tela
echo "<h3>Comandos SQL para INSERT:</h3>";
foreach ($inserts as $insert) {
    echo $insert . "<br/><br/>";
}

// Contagem
echo "<p>Total de registros: " . count($inserts) . "</p>";
?>