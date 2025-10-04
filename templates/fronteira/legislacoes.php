<?php
// Configurações
$csvFile = 'legislacao.csv';
$categoriasCsvFile = 'categoriaLegislacao.csv';

// Carregar categorias do arquivo CSV
$categorias = array();
if (file_exists($categoriasCsvFile)) {
    $handleCategorias = fopen($categoriasCsvFile, 'r');
    if ($handleCategorias !== FALSE) {
        // Pular o cabeçalho
        fgetcsv($handleCategorias);
        
        // Ler cada linha do CSV de categorias
        while (($categoriaData = fgetcsv($handleCategorias)) !== FALSE) {
            $id = $categoriaData[0];
            $nome = $categoriaData[1];
            $categorias[$id] = $nome;
        }
        fclose($handleCategorias);
    }
} else {
    die("Arquivo de categorias não encontrado: $categoriasCsvFile<br/>");
}

// Verificar se o arquivo CSV principal existe
if (!file_exists($csvFile)) {
    die("Arquivo CSV não encontrado: $csvFile<br/>");
}

// Abrir o arquivo CSV principal
$handle = fopen($csvFile, 'r');
if ($handle === FALSE) {
    die("Erro ao abrir o arquivo CSV<br/>");
}

// Pular o cabeçalho
fgetcsv($handle);

// Processar cada linha do CSV
while (($data = fgetcsv($handle)) !== FALSE) {
    // Extrair dados do CSV - o ID está na posição 0
    $id = $data[0];
    $idCategoria = $data[1];
    $numero = $data[3];
    $ano = $data[4];
    $link = $data[5];
    $sumula = $data[6];
    $nomeArquivo = $data[7];
    $created_at = $data[8];
    $updated_at = $data[9];
    $nome = $data[10];
    
    // Converter data para formato MySQL
    $data_mysql = !empty($created_at) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $created_at))) : NULL;
    
    // Obter nome da categoria
    $categoria_nome = isset($categorias[$idCategoria]) ? $categorias[$idCategoria] : 'Não Encontrado';
    
    // Preparar valores para SQL
    $id_sql = !empty($id) ? "'" . addslashes($id) . "'" : 'NULL';
    $created_at_sql = !empty($created_at) ? "'" . date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $created_at))) . "'" : 'NULL';
    $updated_at_sql = !empty($updated_at) ? "'" . date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $updated_at))) . "'" : 'NULL';
    $nome_sql = !empty($nome) ? "'" . addslashes($nome) . "'" : 'NULL';
    $data_sql = $data_mysql ? "'$data_mysql'" : 'NULL';
    $texto_sql = !empty($sumula) ? "'" . addslashes($sumula) . "'" : 'NULL';
    $categoria_sql = "'" . addslashes($categoria_nome) . "'";
    $numero_sql = !empty($numero) ? "'" . addslashes("$numero/$ano") . "'" : 'NULL';
    $arquivo_sql = !empty($nomeArquivo) ? "'" . addslashes($nomeArquivo) . "'" : 'NULL';
    
    // Gerar comando INSERT individual completo com ID
    echo "INSERT INTO legislacoes (id, created_at, updated_at, nome, data, texto, categoria, numero, arquivo) VALUES ($id_sql, $created_at_sql, $updated_at_sql, $nome_sql, $data_sql, $texto_sql, $categoria_sql, $numero_sql, $arquivo_sql);<br/><br/>";
}

fclose($handle);
?>