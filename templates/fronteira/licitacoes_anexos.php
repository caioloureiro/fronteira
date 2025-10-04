<?php
// Configurações
$csv_file = 'arquivoLicitacao.csv';
$output_file = 'inserts_licitacoes_anexos.sql';

// Abrir arquivo CSV
if (($handle = fopen($csv_file, 'r')) !== FALSE) {
    // Pular o cabeçalho
    fgetcsv($handle, 1000, ",");
    
    // Abrir arquivo de saída para escrever os INSERTs
    $output = fopen($output_file, 'w');
    
    // Escrever cabeçalho do arquivo SQL
    fwrite($output, "-- INSERTS gerados automaticamente a partir do CSV\n");
    fwrite($output, "-- Data: " . date('Y-m-d H:i:s') . "\n\n");
    
    $insert_count = 0;
    
    echo "-- INSERTS gerados automaticamente a partir do CSV<br/>";
    echo "-- Data: " . date('Y-m-d H:i:s') . "<br/><br/>";
    
    // Ler cada linha do CSV
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // Mapear as colunas do CSV para a tabela
        // CSV: id, idLicitacao, nome, nomeArquivo, dataPublicacao, created_at, updated_at, descricao, ordem, idCategoriaArquivoLicitacao, numeroDownload, remoto
        // Tabela: id, ativo, created_at, updated_at, nome, arquivo, licitacao
        
        // Preparar os valores para o INSERT
        $nome = $data[2]; // nome
        $arquivo = $data[3]; // nomeArquivo
        $licitacao = $data[1]; // idLicitacao
        $created_at = $data[5]; // created_at
        $updated_at = $data[6]; // updated_at
        
        // Escapar aspas e caracteres especiais
        $nome = str_replace("'", "\\'", $nome);
        $arquivo = str_replace("'", "\\'", $arquivo);
        
        // Gerar comando INSERT
        $sql = "INSERT INTO licitacoes_anexos (nome, arquivo, licitacao, created_at, updated_at) VALUES ('$nome', '$arquivo', $licitacao, '$created_at', '$updated_at');";
        
        // Escrever no arquivo de saída (com \n)
        fwrite($output, $sql . "\n");
        $insert_count++;
        
        // Mostrar na tela (com <br/>)
        echo $sql . "<br/>";
    }
    
    // Fechar arquivos
    fclose($handle);
    fclose($output);
    
    echo "<br/>-- Processamento concluído!<br/>";
    echo "-- Total de INSERTs gerados: $insert_count<br/>";
    echo "-- Arquivo salvo em: $output_file<br/>";
    
} else {
    echo "Erro: Não foi possível abrir o arquivo CSV '$csv_file'<br/>";
}
?>