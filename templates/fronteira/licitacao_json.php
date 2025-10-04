<?php
header('Content-Type: application/json');
header('Content-Disposition: attachment; filename="licitacoes.json"');

$csv = array_map('str_getcsv', file('licitacao.csv'));
$header = array_shift($csv);

$json = array();
foreach ($csv as $row) {
    $item = array();
    foreach ($header as $i => $key) {
        $item[$key] = $row[$i];
    }
    $json[] = $item;
}

echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>