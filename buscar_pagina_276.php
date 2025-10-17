<?php
require 'd:/Sites/fronteira/model/conexao-off.php';

echo "=== BUSCA DE ANEXOS - idPagina 276 ===\n\n";

echo "PÁGINA ANTIGA (CSV):\n";
echo "ID: 276\n";
echo "Nome: CMDI - CONSELHO MUNICIPAL DE DIREITOS DO IDOSO\n\n";

echo "ANEXOS NO CSV:\n";
echo "1. ID 528 - CONVITE-REUNIAO-02-DE-MAIO.pdf (ordem 2)\n";
echo "2. ID 529 - EDITAL-No-001-2024.pdf (ordem 1)\n\n";

echo "BUSCA NO BANCO DE DADOS NOVO:\n";
$result = $conn->query("SELECT id, pagina FROM paginas WHERE LOWER(pagina) LIKE '%cmdi%' OR LOWER(pagina) LIKE '%conselho%idoso%'");

if ($result->num_rows > 0) {
    echo "Páginas encontradas:\n";
    while($row = $result->fetch_assoc()) {
        echo "  ID " . $row['id'] . " - " . $row['pagina'] . "\n";
    }
} else {
    echo "❌ PÁGINA NÃO ENCONTRADA no banco de dados novo\n";
    echo "Esta página precisa ser criada antes de importar os anexos.\n";
}

echo "\n";
$conn->close();
?>
