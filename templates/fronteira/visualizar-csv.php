<?php
if(!isset($_GET['file']) || empty($_GET['file'])) {
    header('Location: index-relatorios.php');
    exit;
}

$file = $_GET['file'];
$filePath = __DIR__ . '/' . basename($file);

if(!file_exists($filePath) || !is_file($filePath)) {
    die('Arquivo não encontrado.');
}

$fileName = basename($file, '.csv');
$fileSize = filesize($filePath);
$fileSizeKB = round($fileSize / 1024, 2);

// Ler CSV
$data = [];
$headers = [];
if(($handle = fopen($filePath, 'r')) !== false) {
    // Ler cabeçalhos
    if(($row = fgetcsv($handle, 10000, ',')) !== false) {
        $headers = $row;
    }
    
    // Ler dados
    while(($row = fgetcsv($handle, 10000, ',')) !== false) {
        $data[] = $row;
    }
    fclose($handle);
}

$totalRecords = count($data);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $fileName; ?> - Relatórios CSV</title>
    <link rel="stylesheet" href="estilo-relatorios.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- DataTables CSS e JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/css/datatable.css" integrity="sha512-6Y02rZmZ2c6wj+/XK7SPRqPOsE9VoXKtgqU6PSTW/QvnGIpPqWxDEhvGPXGGrLXbM6sQqCmnW6mGHiJBhwBwSA==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="header-content">
                <a href="index-relatorios.php" class="back-button">← Voltar</a>
                <h1>📄 <?php echo $fileName; ?></h1>
            </div>
        </header>

        <div class="toolbar">
            <div class="toolbar-left">
                <div class="info-badge">
                    📊 <strong><?php echo number_format($totalRecords, 0, ',', '.'); ?></strong> registros
                </div>
                <div class="info-badge">
                    💾 <strong><?php echo $fileSizeKB; ?> KB</strong>
                </div>
                <div class="info-badge">
                    📋 <strong><?php echo count($headers); ?></strong> colunas
                </div>
            </div>
            <div class="toolbar-right">
                <button onclick="exportToCSV()" class="btn-export">📥 Exportar Filtrado</button>
                <button onclick="toggleFullscreen()" class="btn-fullscreen">⛶ Tela Cheia</button>
            </div>
        </div>

        <!-- Paginação do DataTables será inserida aqui -->
        <div id="datatable_paginacao" class="datatable-pagination"></div>

        <div class="table-container" id="tableContainer">
            <table class="data-table tabela-csv" id="dataTable">
                <thead>
                    <tr>
                        <?php foreach($headers as $index => $header): ?>
                            <th><?php echo htmlspecialchars($header); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $row): ?>
                        <tr>
                            <?php foreach($row as $cell): ?>
                                <td title="<?php echo htmlspecialchars($cell); ?>">
                                    <?php 
                                    $cell = htmlspecialchars($cell);
                                    // Truncar células muito longas para melhor performance
                                    if(strlen($cell) > 150) {
                                        echo '<span class="truncated">' . substr($cell, 0, 150) . '...</span>';
                                    } else {
                                        echo $cell;
                                    }
                                    ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Inicializar DataTables
        const tabela_csv = document.querySelector('.tabela-csv');
        
        // Definir quantas colunas tem
        const numColunas = <?php echo count($headers); ?>;
        const sortConfig = Array(numColunas).fill(true); // Todas colunas ordenáveis
        const filterConfig = Array(numColunas).fill(true); // Todas colunas filtráveis
        
        const datatable = new DataTable(tabela_csv, {
            pageSize: 50, // Itens por página
            sort: sortConfig,
            filters: filterConfig,
            filterText: '🔍 Buscar... ',
            pagingDivSelector: "#datatable_paginacao"
        });
        
        // Tela cheia
        function toggleFullscreen() {
            const container = document.getElementById('tableContainer');
            if(!document.fullscreenElement) {
                container.requestFullscreen();
            } else {
                document.exitFullscreen();
            }
        }

        // Exportar CSV (apenas linhas visíveis após filtro)
        function exportToCSV() {
            const table = document.getElementById('dataTable');
            const visibleRows = Array.from(table.querySelectorAll('tbody tr')).filter(row => 
                row.style.display !== 'none'
            );
            const headers = Array.from(table.querySelectorAll('thead th')).map(th => 
                th.textContent.trim()
            );
            
            let csv = headers.join(',') + '\n';
            
            visibleRows.forEach(row => {
                const cells = Array.from(row.cells).map(cell => {
                    let text = cell.textContent.trim();
                    // Escapar vírgulas e aspas
                    if(text.includes(',') || text.includes('"') || text.includes('\n')) {
                        text = '"' + text.replace(/"/g, '""') + '"';
                    }
                    return text;
                });
                csv += cells.join(',') + '\n';
            });
            
            const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = '<?php echo $fileName; ?>_filtrado_' + new Date().toISOString().slice(0,10) + '.csv';
            link.click();
        }
    </script>
</body>
</html>
