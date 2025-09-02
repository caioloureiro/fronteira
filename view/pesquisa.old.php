<!-- Start - view/pesquisa.php !-->
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

//dd($_POST);

$periodo_eleitoral = 0; 

foreach( $periodo_eleitoral_array as $per ){

 if( $per['ativado'] == 1 ){ $periodo_eleitoral = 1; }

}

$count_noticias = 0;
$count_paginas = 0;
$count_secretarias = 0;

?>

<style><?php require 'css/pesquisa.css'; ?></style>

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
						
						usort($noticias_array, function( $a, $b ){//Função responsável por ordenar

							$al = mb_strtolower($a['titulo']);
							$bl = mb_strtolower($b['titulo']);
							
							if ($al == $bl){
								return 0;
							}
							
							return ($bl < $al) ? +1 : -1;
							
						});
						
						foreach( $noticias_array as $not ){
							
							if( $periodo_eleitoral == 0 ){
								
								if( str_contains( mb_strtolower( $not['titulo'] ), mb_strtolower( $_POST['busca'] ) ) ){
									
									echo'
									<tr>
										
										<td><a href="noticia&id='. $not['id'] .'">'. $not['titulo'] .'</a></td>
										
									</tr>
									';
									
									$count_noticias++;
									
								}
								
							}
							if( $periodo_eleitoral == 1 ){
								
								if( $not['utilidade_publica'] == 1 ){
									
									if( str_contains( mb_strtolower( $not['titulo'] ), mb_strtolower( $_POST['busca'] ) ) ){
										
										echo'
										<tr>
											
											<td><a href="noticia&id='. $not['id'] .'">'. $not['titulo'] .'</a></td>
											
										</tr>
										';
										
										$count_noticias++;
										
									}
									
								}
								
							}
							
						}
						
						if( $count_noticias == 0 ){
							
							echo'
							<tr>
								<td>Nenhuma notícia encontrada.</td>
							</tr>
							';
							
						}
						
					?>
					
				</tbody>
				
			</table>
			
			<div id="tabela_noticias_paginacao" class="pagination"></div>
			
		</div>
		
		<div class="pesquisa-tabela-janela">
			
			<table class="tabela_pesquisa">
		
				<thead>
					
					<tr>
					
						<th>Páginas</th>
						
					</tr>
					
				</thead>
				
				<tbody>
				
					<?php
						
						usort($paginas_fixas, function( $a, $b ){//Função responsável por ordenar

							$al = mb_strtolower($a['titulo']);
							$bl = mb_strtolower($b['titulo']);
							
							if ($al == $bl){
								return 0;
							}
							
							return ($bl < $al) ? +1 : -1;
							
						});
						
						foreach( $paginas_fixas as $pag ){
							
							if( str_contains( mb_strtolower( $pag['titulo'] ), mb_strtolower( $_POST['busca'] ) ) ){
								
								echo'
								<tr>
									
									<td><a href="'. $pag['pagina'] .'">'. $pag['titulo'] .'</a></td>
									
								</tr>
								';
								
								$count_paginas++;
								
							}
							
						}
						
						usort($paginas, function( $a, $b ){//Função responsável por ordenar

							$al = mb_strtolower($a['titulo']);
							$bl = mb_strtolower($b['titulo']);
							
							if ($al == $bl){
								return 0;
							}
							
							return ($bl < $al) ? +1 : -1;
							
						});
						
						foreach( $paginas as $pag ){
							
							if( str_contains( mb_strtolower( $pag['titulo'] ), mb_strtolower( $_POST['busca'] ) ) ){
								
								echo'
								<tr>
									
									<td><a href="'. $pag['pagina'] .'">'. $pag['titulo'] .'</a></td>
									
								</tr>
								';
								
								$count_paginas++;
								
							}
							
						}
						
						if( $count_paginas == 0 ){
							
							echo'
							<tr>
								<td>Nenhuma página encontrada.</td>
							</tr>
							';
							
						}
						
					?>
					
				</tbody>
				
			</table>
			
			<div id="tabela_pesquisa_paginacao" class="pagination"></div>
			
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
						
						usort($secretarias_array, function( $a, $b ){//Função responsável por ordenar

							$al = mb_strtolower($a['titulo']);
							$bl = mb_strtolower($b['titulo']);
							
							if ($al == $bl){
								return 0;
							}
							
							return ($bl < $al) ? +1 : -1;
							
						});
						
						foreach( $secretarias_array as $sec ){
							
							if( str_contains( mb_strtolower( $sec['titulo'] ), mb_strtolower( $_POST['busca'] ) ) ){
								
								echo'
								<tr>
									
									<td><a href="secretarias&secretaria='. $sec['pagina'] .'">'. $sec['titulo'] .'</a></td>
									
								</tr>
								';
								
								$count_secretarias++;
								
							}
							
						}
						
						if( $count_secretarias == 0 ){
							
							echo'
							<tr>
								<td>Nenhuma secretaria encontrada.</td>
							</tr>
							';
							
						}
						
					?>
					
				</tbody>
				
			</table>
			
			<div id="tabela_secretarias_paginacao" class="pagination"></div>
			
		</div>
		
	</div>
	
</section>

<script>
	
	let tabela_datatable = document.querySelector('.tabela_pesquisa');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 20, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_pesquisa_paginacao"
	});
	
	document.querySelector('.tabela_pesquisa .sorting').click();
	
	let tabela_datatable_noticias = document.querySelector('.tabela_noticias');
	
	var datatable = new DataTable( tabela_datatable_noticias, {
		pageSize: 20, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_noticias_paginacao"
	});

	let tabela_datatable_secretarias = document.querySelector('.tabela_secretarias');
	
	var datatable = new DataTable( tabela_datatable_secretarias, {
		pageSize: 20, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_secretarias_paginacao"
	});
	
</script>
<!-- End - view/pesquisa.php !-->