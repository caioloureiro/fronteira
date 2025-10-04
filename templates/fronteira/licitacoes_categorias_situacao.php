<?php
// Arrays para armazenar os mapeamentos
$categorias = array();
$situacoes = array();

// Ler arquivo de categorias
if (file_exists('modalidade.csv')) {
    $arquivo = fopen('modalidade.csv', 'r');
    if ($arquivo) {
        $cabecalho = fgetcsv($arquivo, 1000, ",");
        $indices = array_flip($cabecalho);
        
        while (($linha = fgetcsv($arquivo, 1000, ",")) !== FALSE) {
            $id = $linha[$indices['id']];
            $nome = mb_strtoupper($linha[$indices['nome']]);
            $categorias[$id] = $nome;
        }
        fclose($arquivo);
    }
}

// Ler arquivo de situações
if (file_exists('statusLicitacao.csv')) {
    $arquivo = fopen('statusLicitacao.csv', 'r');
    if ($arquivo) {
        $cabecalho = fgetcsv($arquivo, 1000, ",");
        $indices = array_flip($cabecalho);
        
        while (($linha = fgetcsv($arquivo, 1000, ",")) !== FALSE) {
            $id = $linha[$indices['id']];
            $nome = $linha[$indices['nome']]; // Não converte situação para maiúsculas
            $situacoes[$id] = $nome;
        }
        fclose($arquivo);
    }
}

// Ler arquivo de licitações para gerar os UPDATEs
if (file_exists('licitacao.csv')) {
    $arquivo = fopen('licitacao.csv', 'r');
    if ($arquivo) {
        $cabecalho = fgetcsv($arquivo, 1000, ",");
        $indices = array_flip($cabecalho);
        
        echo "-- Atualizando categorias e situações das licitações<br/><br/>";
        
        while (($linha = fgetcsv($arquivo, 1000, ",")) !== FALSE) {
            $id = $linha[$indices['id']];
            $id_categoria = $linha[$indices['idModalidade']];
            $id_situacao = $linha[$indices['idStatusLicitacao']];
            
            if (!empty($id_categoria) && isset($categorias[$id_categoria])) {
                $nome_categoria = str_replace(array("'", "\n"), array("''", "<br/>"), mb_strtoupper($categorias[$id_categoria]));
                echo "UPDATE licitacoes SET categoria = '$nome_categoria' WHERE id = $id;<br/>";
            }
            
            if (!empty($id_situacao) && isset($situacoes[$id_situacao])) {
                $nome_situacao = str_replace(array("'", "\n"), array("''", "<br/>"), $situacoes[$id_situacao]);
                echo "UPDATE licitacoes SET situacao = '$nome_situacao' WHERE id = $id;<br/>";
            }
        }
        fclose($arquivo);
    }
}

echo "<br/>-- Atualização concluída!<br/>";