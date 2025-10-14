<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Relatórios CSV - Fronteira MG</title>
    <link rel="stylesheet" href="estilo-relatorios.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="header-content">
                <h1>📊 Sistema de Relatórios CSV</h1>
                <p class="subtitle">Visualização de dados de migração - Fronteira MG</p>
            </div>
        </header>

        <div class="search-box">
            <input 
                type="text" 
                id="searchInput" 
                placeholder="🔍 Buscar arquivo CSV..." 
                class="search-input"
            >
        </div>

        <div class="stats-grid">
            <?php
            $csvFiles = glob('*.csv');
            $totalFiles = count($csvFiles);
            $totalSize = 0;
            
            foreach($csvFiles as $file) {
                $totalSize += filesize($file);
            }
            
            $totalSizeMB = round($totalSize / 1024 / 1024, 2);
            ?>
            <div class="stat-card">
                <div class="stat-icon">📁</div>
                <div class="stat-content">
                    <div class="stat-number"><?php echo $totalFiles; ?></div>
                    <div class="stat-label">Arquivos CSV</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">💾</div>
                <div class="stat-content">
                    <div class="stat-number"><?php echo $totalSizeMB; ?> MB</div>
                    <div class="stat-label">Tamanho Total</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📈</div>
                <div class="stat-content">
                    <div class="stat-number" id="totalRecords">---</div>
                    <div class="stat-label">Registros Totais</div>
                </div>
            </div>
        </div>

        <div class="files-grid" id="filesGrid">
            <?php
            // Organizar arquivos por categoria
            $categories = [
                'Conteúdo' => ['noticia', 'pagina', 'legislacao', 'informativo', 'boletim', 'diarioOficial'],
                'Licitações' => ['licitacao', 'chamamento', 'concurso', 'empresaPenalizada', 'contratoLicitacao', 'entidadeLicitacao'],
                'Categorias' => ['categoria', 'modalidade', 'status'],
                'Mídia' => ['img', 'galeria', 'video', 'banner'],
                'Estrutura' => ['secretaria', 'conselho', 'entidade', 'pessoa', 'gabinete'],
                'Outros' => ['arquivo', 'balanco', 'esporte', 'evento', 'faq', 'fornecedor', 'obra', 'parceiro', 'popup', 'programa', 'recurso', 'servico', 'turismo', 'link', 'bairro']
            ];
            
            $filesByCategory = [];
            
            foreach($csvFiles as $file) {
                $categorized = false;
                foreach($categories as $category => $keywords) {
                    foreach($keywords as $keyword) {
                        if(stripos($file, $keyword) !== false) {
                            $filesByCategory[$category][] = $file;
                            $categorized = true;
                            break 2;
                        }
                    }
                }
                if(!$categorized) {
                    $filesByCategory['Outros'][] = $file;
                }
            }
            
            foreach($filesByCategory as $category => $files) {
                if(empty($files)) continue;
                
                echo '<div class="category-section">';
                echo '<h2 class="category-title">' . $category . '</h2>';
                echo '<div class="category-grid">';
                
                sort($files);
                
                foreach($files as $file) {
                    $fileName = basename($file, '.csv');
                    $fileSize = filesize($file);
                    $fileSizeKB = round($fileSize / 1024, 2);
                    
                    // Contar linhas
                    $lineCount = 0;
                    if(($handle = fopen($file, 'r')) !== false) {
                        while(!feof($handle)) {
                            fgets($handle);
                            $lineCount++;
                        }
                        fclose($handle);
                        $lineCount = max(0, $lineCount - 1); // Remover header
                    }
                    
                    echo '
                    <a href="visualizar-csv.php?file=' . urlencode($file) . '" class="file-card" data-filename="' . strtolower($fileName) . '">
                        <div class="file-icon">📄</div>
                        <div class="file-info">
                            <h3 class="file-name">' . $fileName . '</h3>
                            <div class="file-meta">
                                <span class="meta-item">
                                    <span class="meta-icon">📊</span>
                                    ' . $lineCount . ' registros
                                </span>
                                <span class="meta-item">
                                    <span class="meta-icon">💾</span>
                                    ' . $fileSizeKB . ' KB
                                </span>
                            </div>
                        </div>
                        <div class="file-arrow">→</div>
                    </a>';
                }
                
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script>
        // Busca em tempo real
        const searchInput = document.getElementById('searchInput');
        const fileCards = document.querySelectorAll('.file-card');
        const categorySections = document.querySelectorAll('.category-section');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            categorySections.forEach(section => {
                let hasVisibleCards = false;
                const cards = section.querySelectorAll('.file-card');
                
                cards.forEach(card => {
                    const fileName = card.getAttribute('data-filename');
                    if(fileName.includes(searchTerm)) {
                        card.style.display = '';
                        hasVisibleCards = true;
                    } else {
                        card.style.display = 'none';
                    }
                });
                
                // Esconder categoria se não tiver cards visíveis
                section.style.display = hasVisibleCards ? '' : 'none';
            });
        });
        
        // Calcular total de registros
        let totalRecords = 0;
        document.querySelectorAll('.file-card .meta-item:first-child').forEach(item => {
            const text = item.textContent.trim();
            const number = parseInt(text.match(/\d+/)[0]);
            totalRecords += number;
        });
        document.getElementById('totalRecords').textContent = totalRecords.toLocaleString('pt-BR');
    </script>
</body>
</html>