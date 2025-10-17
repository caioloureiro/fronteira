<?php
require 'd:/Sites/fronteira/model/conexao-off.php';

echo "=== ESTRUTURA DA TABELA PAGINAS ===\n\n";
$result = $conn->query('DESCRIBE paginas');
while($row = $result->fetch_assoc()) {
    echo $row['Field'] . ' (' . $row['Type'] . ")\n";
}

$conn->close();
?>
