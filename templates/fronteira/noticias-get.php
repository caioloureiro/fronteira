<?php
// Configurações
$csvFile = 'fronteira/noticia.csv';

// Função para converter data do formato brasileiro para MySQL
function convertDateToMySQL($dateString) {
    if (empty($dateString)) {
        return date('Y-m-d H:i:s');
    }
    
    // Converte formato "d/m/Y H:i:s" para "Y-m-d H:i:s"
    $dateTime = DateTime::createFromFormat('d/m/Y H:i:s', $dateString);
    if ($dateTime) {
        return $dateTime->format('Y-m-d H:i:s');
    }
    
    // Tenta outros formatos se necessário
    $dateTime = DateTime::createFromFormat('d/m/Y', $dateString);
    if ($dateTime) {
        return $dateTime->format('Y-m-d 00:00:00');
    }
    
    return date('Y-m-d H:i:s');
}

// Função para escapar strings para SQL (mais robusta)
function escapeSQL($value) {
    if (is_null($value)) return '';
    
    // Remove caracteres problemáticos para SQL
    $value = str_replace("'", "''", $value);
    $value = str_replace("\\", "\\\\", $value);
    $value = str_replace("\0", "", $value);
    $value = str_replace("\n", "\\n", $value);
    $value = str_replace("\r", "\\r", $value);
    
    return $value;
}

// Verifica se o arquivo existe
if (!file_exists($csvFile)) {
    die("Erro: Arquivo '$csvFile' não encontrado.");
}

// Abre o arquivo CSV
if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    // Lê o cabeçalho
    $headers = fgetcsv($handle, 0, ',');
    
    $sqlStatements = [];
    
    // Processa cada linha do CSV
    while (($row = fgetcsv($handle, 0, ',')) !== FALSE) {
        if (count($row) !== count($headers)) {
            continue; // Pula linhas inválidas
        }
        
        $data = array_combine($headers, $row);
		$descricao = str_replace( "'", "&apos;", $data['texto'] );
        
        // Prepara os valores para inserção
        $ativo = 1; // Sempre ativo
        $titulo = escapeSQL($data['titulo'] ?? '');
        $subtitulo = escapeSQL($data['gravata'] ?? '');
        $data_publicacao = convertDateToMySQL($data['dataPublicacao'] ?? '');
        $data_atualizacao = convertDateToMySQL($data['updated_at'] ?? '');
        $imagem = escapeSQL($data['nomeImg'] ?? '');
        $destaque = $data['destaque'] ?? 0;
        $destaque_ordem = $data['ordem'] ?? 9999;
        $utilidade_publica = 0; // Valor padrão
        $categorias = ''; // Campo vazio pois não temos mapeamento direto
        $texto = escapeSQL(htmlspecialchars($descricao ?? '', ENT_QUOTES, 'UTF-8'));
        $publicado = 1; // Considera todas como publicadas
        $legenda = escapeSQL($data['legenda'] ?? '');
        
        // Constrói o comando SQL
        $sql = "INSERT INTO `noticias` (`ativo`, `titulo`, `subtitulo`, `data_publicacao`, `data_atualizacao`, `imagem`, `destaque`, `destaque_ordem`, `utilidade_publica`, `categorias`, `texto`, `publicado`, `legenda`) VALUES (";
        $sql .= "$ativo, ";
        $sql .= "'$titulo', ";
        $sql .= "'$subtitulo', ";
        $sql .= "'$data_publicacao', ";
        $sql .= "'$data_atualizacao', ";
        $sql .= "'$imagem', ";
        $sql .= "$destaque, ";
        $sql .= "$destaque_ordem, ";
        $sql .= "$utilidade_publica, ";
        $sql .= "'$categorias', ";
        $sql .= "'$texto', ";
        $sql .= "$publicado, ";
        $sql .= "'$legenda'";
        $sql .= ");";
        
        $sqlStatements[] = $sql;
    }
    
    // Fecha o arquivo
    fclose($handle);
    
    // Exibe todos os comandos SQL na tela
    foreach ($sqlStatements as $sql) {
        echo $sql . "<br/><br/>";
    }
    
} else {
    echo "Erro ao abrir o arquivo CSV: $csvFile\n";
}
?>