<?php
// Definir o charset para UTF-8
header('Content-Type: application/json; charset=utf-8');

// Configurações
$csv_file = 'arquivoLicitacao.csv';
$licitacoes_anexos = array();

// Abrir arquivo CSV
if (($handle = fopen($csv_file, 'r')) !== FALSE) {
    // Ler o cabeçalho
    $cabecalho = fgetcsv($handle);
    
    // Ler cada linha do CSV
    while (($data = fgetcsv($handle)) !== FALSE) {
        // Criar um array associativo combinando o cabeçalho com os dados
        $linha = array_combine($cabecalho, $data);
        
        // Formatar as datas se necessário
        if (!empty($linha['dataPublicacao'])) {
            $data = str_replace('/', '-', $linha['dataPublicacao']);
            $linha['dataPublicacao'] = date('Y-m-d', strtotime($data));
        }
        if (!empty($linha['created_at'])) {
            $linha['created_at'] = date('Y-m-d H:i:s', strtotime($linha['created_at']));
        }
        if (!empty($linha['updated_at'])) {
            $linha['updated_at'] = date('Y-m-d H:i:s', strtotime($linha['updated_at']));
        }
        
        // Converter números para o tipo apropriado
        $linha['id'] = (int)$linha['id'];
        $linha['idLicitacao'] = (int)$linha['idLicitacao'];
        $linha['ordem'] = (int)$linha['ordem'];
        $linha['idCategoriaArquivoLicitacao'] = !empty($linha['idCategoriaArquivoLicitacao']) ? (int)$linha['idCategoriaArquivoLicitacao'] : null;
        $linha['numeroDownload'] = (int)$linha['numeroDownload'];
        $linha['remoto'] = (int)$linha['remoto'];
        
        $licitacoes_anexos[] = $linha;
    }
    
    // Fechar arquivo
    fclose($handle);
    
    // Retornar JSON formatado
    echo json_encode($licitacoes_anexos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    
} else {
    // Retornar erro em formato JSON
    $erro = array(
        'erro' => true,
        'mensagem' => "Não foi possível abrir o arquivo CSV '$csv_file'",
        'data' => date('Y-m-d H:i:s')
    );
    echo json_encode($erro, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
?>