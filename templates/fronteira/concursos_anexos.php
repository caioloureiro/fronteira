<?php
// Configurações
$csv_file = 'fronteira/arquivoConcurso.csv';

// Verifica se o arquivo existe
if (!file_exists($csv_file)) {
    die("Arquivo CSV não encontrado: $csv_file");
}

// Abre o arquivo CSV
$handle = fopen($csv_file, 'r');
if ($handle === false) {
    die("Erro ao abrir o arquivo CSV");
}

// Lê o cabeçalho
$header = fgetcsv($handle);
if ($header === false) {
    die("Erro ao ler cabeçalho do CSV");
}

// Processa as linhas do CSV
$inserts = [];
$line_number = 0;

while (($row = fgetcsv($handle)) !== false) {
    $line_number++;
    
    // Combina cabeçalho com valores
    $data = array_combine($header, $row);
    
    // Extrai os dados necessários
    $nome = !empty($data['nome']) ? $data['nome'] : 'NULL';
    $arquivo = !empty($data['nomeArquivo']) ? $data['nomeArquivo'] : 'NULL';
    $concurso = !empty($data['idConcurso']) ? $data['idConcurso'] : '0';
    $created_at = !empty($data['created_at']) ? $data['created_at'] : 'NULL';
    $updated_at = !empty($data['updated_at']) ? $data['updated_at'] : 'NULL';
    
    // Formata as datas para o padrão MySQL (se não for NULL)
    if ($created_at !== 'NULL') {
        $created_at = "'" . date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $created_at))) . "'";
    }
    
    if ($updated_at !== 'NULL') {
        $updated_at = "'" . date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $updated_at))) . "'";
    }
    
    // Prepara os valores para o SQL
    $nome = $nome !== 'NULL' ? "'" . addslashes($nome) . "'" : $nome;
    $arquivo = $arquivo !== 'NULL' ? "'" . addslashes($arquivo) . "'" : $arquivo;
    
    // Monta o comando INSERT
    $sql = "INSERT INTO concursos_anexos (nome, arquivo, concurso, created_at, updated_at) VALUES ($nome, $arquivo, $concurso, $created_at, $updated_at);";
    
    $inserts[] = $sql;
}

fclose($handle);

// Exibe os comandos SQL na tela
echo "<h2>-- Comandos SQL para INSERT:</h2>";
echo "<pre>";
foreach ($inserts as $insert) {
    echo htmlspecialchars($insert) . "<br/>";
}
echo "</pre>";

echo "<p>-- Total de registros processados: " . count($inserts) . "</p>";
?>