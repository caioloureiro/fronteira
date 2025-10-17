<?php
require 'd:/Sites/fronteira/model/conexao-off.php';

echo "=== VERIFICAÇÃO DE PÁGINAS DUPLICADAS ===\n\n";

// Buscar páginas duplicadas
$sql = "SELECT pagina, titulo, COUNT(*) as total 
        FROM paginas 
        GROUP BY pagina, titulo 
        HAVING COUNT(*) > 1 
        ORDER BY total DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "⚠️  PÁGINAS DUPLICADAS ENCONTRADAS:\n\n";
    
    while($row = $result->fetch_assoc()) {
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "Página: " . $row['pagina'] . "\n";
        echo "Título: " . $row['titulo'] . "\n";
        echo "Duplicatas: " . $row['total'] . " registros\n\n";
        
        // Buscar detalhes de cada duplicata
        $sql_detalhes = "SELECT id, pagina, titulo, 
                         DATE_FORMAT(created_at, '%d/%m/%Y %H:%i:%s') as criado
                         FROM paginas 
                         WHERE pagina = '" . $conn->real_escape_string($row['pagina']) . "' 
                         AND titulo = '" . $conn->real_escape_string($row['titulo']) . "'
                         ORDER BY id";
        
        $result_detalhes = $conn->query($sql_detalhes);
        
        while($detalhe = $result_detalhes->fetch_assoc()) {
            echo "  → ID " . $detalhe['id'] . " - Criado em: " . $detalhe['criado'] . "\n";
        }
        
        echo "\n";
    }
    
    echo "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "ATENÇÃO: Execute o script limpar_duplicatas_paginas.php para remover.\n";
    
} else {
    echo "✅ Nenhuma duplicata encontrada!\n";
}

$conn->close();
?>
