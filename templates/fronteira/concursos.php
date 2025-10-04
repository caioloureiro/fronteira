<?php
// Ler o arquivo categoriaConcurso.csv para mapear os IDs com os nomes
$categorias = [];
if (($handle = fopen('fronteira/categoriaConcurso.csv', 'r')) !== FALSE) {
    // Pular o cabeçalho
    fgetcsv($handle, 1000, ",");
    
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $id = $data[0];
        $nome = $data[1];
        $categorias[$id] = $nome;
    }
    fclose($handle);
}

// Ler o arquivo concursos.csv
if (($handle = fopen('fronteira/concurso.csv', 'r')) !== FALSE) {
    // Pular o cabeçalho
    fgetcsv($handle, 1000, ",");
    
    echo "INSERT INTO concursos (created_at, updated_at, nome, resumo, texto, inicio, fim, numero, situacao, mensagem, categoria, edital) VALUES<br/><br/>";
    
    $first = true;
    
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if (!$first) {
            echo ",<br/><br/>";
        }
        
        $id = $data[0];
        $encerrado = $data[1];
        $dataInicio = DateTime::createFromFormat('d/m/Y', $data[2])->format('Y-m-d H:i:s');
        $dataFim = DateTime::createFromFormat('d/m/Y', $data[3])->format('Y-m-d H:i:s');
        $objeto = $data[4];
        $numeroProcesso = $data[5];
        $numero = $data[6];
        $ano = $data[7];
        $link = $data[8];
        $created_at = DateTime::createFromFormat('d/m/Y H:i:s', $data[9])->format('Y-m-d H:i:s');
        $updated_at = DateTime::createFromFormat('d/m/Y H:i:s', $data[10])->format('Y-m-d H:i:s');
        $titulo = $data[11];
        $idCategoria = $data[12];
        
        // Determinar situação baseado no campo "encerrado"
        $situacao = ($encerrado == '1') ? 'Encerrado' : 'Em andamento';
        
        // Buscar nome da categoria
        $categoria = isset($categorias[$idCategoria]) ? $categorias[$idCategoria] : 'Outros';
        
        // Criar nome do concurso
        $nomeConcurso = !empty($titulo) ? $titulo : $categoria . ' ' . $numero . '/' . $ano;
        
        // Escapar aspas para SQL
        $objeto = str_replace("'", "\\'", $objeto);
        $nomeConcurso = str_replace("'", "\\'", $nomeConcurso);
        
        echo "('$created_at', '$updated_at', '$nomeConcurso', NULL, '$objeto', '$dataInicio', '$dataFim', '$numero', '$situacao', NULL, '$categoria', '$link')";
        
        $first = false;
    }
    
    echo ";<br/><br/>";
    fclose($handle);
} else {
    echo "Erro ao abrir o arquivo CSV";
}
?>