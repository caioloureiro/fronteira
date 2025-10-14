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

// Paginação
$perPage = isset($_GET['per_page']) ? intval($_GET['per_page']) : 50;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$totalPages = ceil($totalRecords / $perPage);
$page = max(1, min($page, $totalPages));
$offset = ($page - 1) * $perPage;
$pagedData = array_slice($data, $offset, $perPage);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $fileName; ?> - Relatórios CSV</title>
    <link rel="stylesheet" href="estilo-relatorios.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
                <select id="perPageSelect" class="select-box" onchange="changePerPage(this.value)">
                    <option value="25" <?php echo $perPage == 25 ? 'selected' : ''; ?>>25 por página</option>
                    <option value="50" <?php echo $perPage == 50 ? 'selected' : ''; ?>>50 por página</option>
                    <option value="100" <?php echo $perPage == 100 ? 'selected' : ''; ?>>100 por página</option>
                    <option value="<?php echo $totalRecords; ?>">Todos (<?php echo $totalRecords; ?>)</option>
                </select>
                <button onclick="exportToCSV()" class="btn-export">📥 Exportar Filtrado</button>
                <button onclick="toggleFullscreen()" class="btn-fullscreen">⛶ Tela Cheia</button>
            </div>
        </div>

        <div class="search-toolbar">
            <input 
                type="text" 
                id="searchTable" 
                placeholder="🔍 Buscar na tabela..." 
                class="search-input"
            >
            <button onclick="clearSearch()" class="btn-clear">✕ Limpar</button>
        </div>

        <div class="table-container" id="tableContainer">
            <table class="data-table" id="dataTable">
                <thead>
                    <tr>
                        <th class="row-number">#</th>
                        <?php foreach($headers as $index => $header): ?>
                            <th onclick="sortTable(<?php echo $index + 1; ?>)" class="sortable">
                                <?php echo htmlspecialchars($header); ?>
                                <span class="sort-icon">⇅</span>
                            </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $rowNum = $offset + 1;
                    foreach($pagedData as $row): 
                    ?>
                        <tr>
                            <td class="row-number"><?php echo $rowNum++; ?></td>
                            <?php foreach($row as $cell): ?>
                                <td title="<?php echo htmlspecialchars($cell); ?>">
                                    <?php 
                                    $cell = htmlspecialchars($cell);
                                    // Truncar células muito longas
                                    if(strlen($cell) > 100) {
                                        echo '<span class="truncated">' . substr($cell, 0, 100) . '...</span>';
                                        echo '<span class="full-text" style="display:none;">' . $cell . '</span>';
                                        echo '<button class="btn-expand" onclick="toggleCell(this)">Ver mais</button>';
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

        <?php if($totalPages > 1): ?>
        <div class="pagination">
            <div class="pagination-info">
                Exibindo <?php echo $offset + 1; ?> a <?php echo min($offset + $perPage, $totalRecords); ?> de <?php echo number_format($totalRecords, 0, ',', '.'); ?>
            </div>
            <div class="pagination-buttons">
                <?php if($page > 1): ?>
                    <a href="?file=<?php echo urlencode($file); ?>&page=1&per_page=<?php echo $perPage; ?>" class="btn-page">⏮ Primeira</a>
                    <a href="?file=<?php echo urlencode($file); ?>&page=<?php echo $page - 1; ?>&per_page=<?php echo $perPage; ?>" class="btn-page">← Anterior</a>
                <?php endif; ?>
                
                <?php
                $start = max(1, $page - 2);
                $end = min($totalPages, $page + 2);
                
                for($i = $start; $i <= $end; $i++):
                    if($i == $page):
                ?>
                    <span class="btn-page active"><?php echo $i; ?></span>
                <?php else: ?>
                    <a href="?file=<?php echo urlencode($file); ?>&page=<?php echo $i; ?>&per_page=<?php echo $perPage; ?>" class="btn-page"><?php echo $i; ?></a>
                <?php 
                    endif;
                endfor; 
                ?>
                
                <?php if($page < $totalPages): ?>
                    <a href="?file=<?php echo urlencode($file); ?>&page=<?php echo $page + 1; ?>&per_page=<?php echo $perPage; ?>" class="btn-page">Próxima →</a>
                    <a href="?file=<?php echo urlencode($file); ?>&page=<?php echo $totalPages; ?>&per_page=<?php echo $perPage; ?>" class="btn-page">Última ⏭</a>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script>
        // Busca em tempo real
        const searchInput = document.getElementById('searchTable');
        const table = document.getElementById('dataTable');
        const rows = table.querySelectorAll('tbody tr');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        function clearSearch() {
            searchInput.value = '';
            rows.forEach(row => row.style.display = '');
        }

        function changePerPage(perPage) {
            const url = new URL(window.location.href);
            url.searchParams.set('per_page', perPage);
            url.searchParams.set('page', 1);
            window.location.href = url.toString();
        }

        function toggleFullscreen() {
            const container = document.getElementById('tableContainer');
            if(!document.fullscreenElement) {
                container.requestFullscreen();
            } else {
                document.exitFullscreen();
            }
        }

        function toggleCell(button) {
            const td = button.parentElement;
            const truncated = td.querySelector('.truncated');
            const fullText = td.querySelector('.full-text');
            
            if(truncated.style.display === 'none') {
                truncated.style.display = '';
                fullText.style.display = 'none';
                button.textContent = 'Ver mais';
            } else {
                truncated.style.display = 'none';
                fullText.style.display = '';
                button.textContent = 'Ver menos';
            }
        }

        function sortTable(columnIndex) {
            const table = document.getElementById('dataTable');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            
            const sortedRows = rows.sort((a, b) => {
                const aText = a.cells[columnIndex].textContent.trim();
                const bText = b.cells[columnIndex].textContent.trim();
                
                // Tentar comparar como números
                const aNum = parseFloat(aText);
                const bNum = parseFloat(bText);
                
                if(!isNaN(aNum) && !isNaN(bNum)) {
                    return aNum - bNum;
                }
                
                // Comparar como texto
                return aText.localeCompare(bText, 'pt-BR');
            });
            
            // Inverter se já está ordenado
            const header = table.querySelectorAll('th')[columnIndex];
            if(header.classList.contains('sorted-asc')) {
                sortedRows.reverse();
                header.classList.remove('sorted-asc');
                header.classList.add('sorted-desc');
            } else {
                // Remover todas as classes de ordenação
                table.querySelectorAll('th').forEach(th => {
                    th.classList.remove('sorted-asc', 'sorted-desc');
                });
                header.classList.add('sorted-asc');
            }
            
            // Reordenar linhas
            sortedRows.forEach(row => tbody.appendChild(row));
        }

        function exportToCSV() {
            const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');
            const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.textContent.trim());
            
            let csv = headers.join(',') + '\n';
            
            visibleRows.forEach(row => {
                const cells = Array.from(row.cells).map(cell => {
                    let text = cell.textContent.trim();
                    // Remover botões "Ver mais"
                    text = text.replace('Ver mais', '').replace('Ver menos', '').trim();
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
            link.download = '<?php echo $fileName; ?>_filtrado.csv';
            link.click();
        }
    </script>
</body>
</html>
