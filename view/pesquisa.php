<!-- Start - view/pesquisa.php -->
<link 
	rel="stylesheet" 
	href="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/css/datatable.css" 
	integrity="sha512-zHpjdnFxcMInClTw4ZqdX6NNLuPU+iJMZEQsyIjXuQX8TZXzRhZIlUi0tQTGQxt/UGruFgs0qTBshuGN0ts/vQ==" 
	crossorigin="anonymous" 
/>
<script 
	src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" 
	integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" 
	crossorigin="anonymous"
></script>

<?php 

require 'model/noticias.php'; 
require 'model/periodo_eleitoral.php'; 
require 'model/paginas.php'; 
require 'model/paginas_fixas.php';
require 'model/secretarias.php';
require 'model/downloads.php';

$periodo_eleitoral = 0; 

foreach ($periodo_eleitoral_array as $per) {
	if ($per['ativado'] == 1) {
		$periodo_eleitoral = 1;
	}
}

$count_noticias = 0;
$count_paginas = 0;
$count_secretarias = 0;
$count_downloads = 0;

// Quebrar o valor de $_POST['busca'] em um array de termos
$termos_busca = explode(' ', mb_strtolower($_POST['busca']));

?>

<style>
<?php require 'css/pesquisa.css'; ?>
.vazado{
color:var(--preto_lente03);
}
</style>

<section class="pesquisa">
	
	<div class="box">
		
		<div class="pesquisa-tabela-janela">
			<table class="tabela_noticias">
				<thead>
					<tr>
						<th>Notícias</th>
					</tr>
				</thead>
				<tbody>
					<?php
						usort($noticias_array, function($a, $b) {
							$al = mb_strtolower($a['titulo']);
							$bl = mb_strtolower($b['titulo']);
							return $al <=> $bl;
						});

						foreach ($noticias_array as $not) {
							$titulo_lower = mb_strtolower($not['titulo']);
							$encontrado = false;

							// Verificar se algum termo está no título
							foreach ($termos_busca as $termo) {
								if (str_contains($titulo_lower, $termo)) {
									$encontrado = true;
									break;
								}
							}

							// Exibir notícia se encontrada
							if ($encontrado && ($periodo_eleitoral == 0 || ($periodo_eleitoral == 1 && $not['utilidade_publica'] == 1))) {
								echo '
								<tr>
									<td><a href="noticia&id=' . $not['id'] . '">' . $not['titulo'] . '</a></td>
								</tr>
								';
								$count_noticias++;
							}
						}

						// Exibir mensagem se nenhuma notícia for encontrada
						if ($count_noticias == 0) {
							echo '
							<tr>
								<td class="vazado">Nenhuma notícia encontrada.</td>
							</tr>
							';
						}
					?>
				</tbody>
			</table>
			<div id="tabela_noticias_paginacao" class="pagination"></div>
		</div>
		
		<div class="pesquisa-tabela-janela">
			<table class="tabela_paginas">
				<thead>
					<tr>
						<th>Páginas</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$paginas_todas = array_merge($paginas_fixas, $paginas);
						
						usort($paginas_todas, function($a, $b) {
							$al = mb_strtolower($a['titulo']);
							$bl = mb_strtolower($b['titulo']);
							return $al <=> $bl;
						});

						foreach ($paginas_todas as $pag) {
							$titulo_lower = mb_strtolower($pag['titulo']);
							$encontrado = false;

							foreach ($termos_busca as $termo) {
								if (str_contains($titulo_lower, $termo)) {
									$encontrado = true;
									break;
								}
							}

							if ($encontrado) {
								$pagina_link = isset($pag['pagina']) && !empty($pag['pagina']) ? $pag['pagina'] : '#';
								echo '
								<tr>
									<td><a href="' . $pagina_link . '">' . htmlspecialchars($pag['titulo']) . '</a></td>
								</tr>
								';
								$count_paginas++;
							}
						}

						if ($count_paginas == 0) {
							echo '
							<tr>
								<td class="vazado">Nenhuma página encontrada.</td>
							</tr>
							';
						}
					?>
				</tbody>
			</table>
			<div id="tabela_paginas_paginacao" class="pagination"></div>
		</div>
		
		<div class="pesquisa-tabela-janela">
			<table class="tabela_secretarias">
				<thead>
					<tr>
						<th>Secretarias</th>
					</tr>
				</thead>
				<tbody>
					<?php
						usort($secretarias_array, function($a, $b) {
							$al = mb_strtolower($a['titulo']);
							$bl = mb_strtolower($b['titulo']);
							return $al <=> $bl;
						});

						foreach ($secretarias_array as $sec) {
							$titulo_lower = mb_strtolower($sec['titulo']);
							$encontrado = false;

							foreach ($termos_busca as $termo) {
								if (str_contains($titulo_lower, $termo)) {
									$encontrado = true;
									break;
								}
							}

							if ($encontrado) {
								$pagina_link = isset($sec['pagina']) && !empty($sec['pagina']) ? $sec['pagina'] : '#';
								echo '
								<tr>
									<td><a href="secretarias&secretaria=' . $pagina_link . '">' . htmlspecialchars($sec['titulo']) . '</a></td>
								</tr>
								';
								$count_secretarias++;
							}
						}

						if ($count_secretarias == 0) {
							echo '
							<tr>
								<td class="vazado">Nenhuma secretaria encontrada.</td>
							</tr>
							';
						}
					?>
				</tbody>
			</table>
			<div id="tabela_secretarias_paginacao" class="pagination"></div>
		</div>
		
		<div class="pesquisa-tabela-janela">
			<table class="tabela_downloads">
				<thead>
					<tr>
						<th>Arquivos</th>
					</tr>
				</thead>
				<tbody>
					<?php
						usort($downloads_array, function($a, $b) {
							$al = mb_strtolower($a['nome']);
							$bl = mb_strtolower($b['nome']);
							return $al <=> $bl;
						});

						foreach ($downloads_array as $download) {
							$titulo_lower = mb_strtolower($download['nome']);
							$encontrado = false;

							foreach ($termos_busca as $termo) {
								if (str_contains($titulo_lower, $termo)) {
									$encontrado = true;
									break;
								}
							}

							if ($encontrado) {
								$pagina_link = isset($download['pagina']) && !empty($download['pagina']) ? $download['pagina'] : '#';
								echo '
								<tr>
									<td><a href="secretarias&secretaria=' . $pagina_link . '">' . htmlspecialchars($download['nome']) . '</a></td>
								</tr>
								';
								$count_downloads++;
							}
						}

						if ($count_downloads == 0) {
							echo '
							<tr>
								<td class="vazado">Nenhum arquivo encontrado.</td>
							</tr>
							';
						}
					?>
				</tbody>
			</table>
			<div id="tabela_downloads_paginacao" class="pagination"></div>
		</div>
		
	</div>
	
</section>

<script>
	// Configurações de DataTable para tabelas
	let tabelas = document.querySelectorAll('table');
	tabelas.forEach((tabela) => {
		new DataTable(tabela, {
			pageSize: 20,
			sort: [true],
			filters: [true],
			filterText: 'Buscar... ',
			pagingDivSelector: `#${tabela.classList[0]}_paginacao`
		});
	});
</script>
<!-- End - view/pesquisa.php -->
