<?php
// Arrays para armazenar os mapeamentos
$anos = array();

// Ler arquivo de licitações
if (file_exists('licitacao.csv')) {
    $arquivo = fopen('licitacao.csv', 'r');
    if ($arquivo) {
        $cabecalho = fgetcsv($arquivo, 1000, ",");
        $indices = array_flip($cabecalho);
        
        echo "-- Atualizando números das licitações com seus respectivos anos<br/><br/>";
        
        while (($linha = fgetcsv($arquivo, 1000, ",")) !== FALSE) {
            $id = $linha[$indices['id']];
            $numero = $linha[$indices['numero']];
            $ano = $linha[$indices['ano']];
            
            // Remove qualquer ano já existente no número
            $numero = preg_replace('/\/\d+$/', '', $numero);
            
            // Usa o ano se existir
            if (!empty($ano)) {
                $novo_numero = str_replace(array("'", "\n"), array("''", "<br/>"), $numero . '/' . $ano);
                echo "-- ID: $id - Usando ano: $ano<br/>";
                echo "UPDATE licitacoes SET numero = '$novo_numero' WHERE id = $id;<br/><br/>";
            } else {
                echo "-- ID: $id - Sem ano definido. Mantendo número original: $numero<br/><br/>";
            }
        }
        fclose($arquivo);
    }
}

echo "<br/>-- Atualização concluída!<br/>";
?>