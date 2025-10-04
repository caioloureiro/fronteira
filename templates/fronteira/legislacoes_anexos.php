<?php
// Configurações
$csv_file = 'arquivoLegislacao.csv';

// Verifica se o arquivo existe
if (!file_exists($csv_file)) {
    echo "Erro: Arquivo CSV não encontrado!<br/>";
    exit;
}

// Abre o arquivo CSV
$handle = fopen($csv_file, 'r');
if ($handle === false) {
    echo "Erro: Não foi possível abrir o arquivo CSV!<br/>";
    exit;
}

// Lê o cabeçalho
$headers = fgetcsv($handle);
if ($headers === false) {
    echo "Erro: Não foi possível ler o cabeçalho do CSV!<br/>";
    fclose($handle);
    exit;
}

// Processa cada linha do CSV
echo "-- INSERTs gerados para a tabela legislacoes_anexos:<br/><br/>";
$count = 0;

while (($row = fgetcsv($handle)) !== false) {
    $count++;
    
    // Mapeia as colunas do CSV para os campos do SQL
    $data = array_combine($headers, $row);
    
    // Prepara os valores para o INSERT
    $nome = addslashes($data['nome']);
    $nomeArquivo = addslashes($data['nomeArquivo']);
    $created_at = !empty($data['created_at']) ? "'" . addslashes($data['created_at']) . "'" : 'NULL';
    $updated_at = !empty($data['updated_at']) ? "'" . addslashes($data['updated_at']) . "'" : 'NULL';
    $legislacao = !empty($data['idLegislacao']) ? addslashes($data['idLegislacao']) : '0';
    
    // Monta o comando INSERT
    $sql = "INSERT INTO legislacoes_anexos (nome, arquivo, created_at, updated_at, legislacao) VALUES ('$nome', '$nomeArquivo', $created_at, $updated_at, $legislacao);";
    
    echo $sql . "<br/><br/>";
}

fclose($handle);

echo "-- Total de registros processados: " . $count . "<br/>";
?>