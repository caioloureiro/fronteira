<!-- Start - view/mapa.php !-->
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
	require 'model/paginas.php'; 
	require 'model/paginas_fixas.php'; 
?>

<style><?php require 'css/mapa.css'; ?></style>

<section class="mapa">
	
	<div class="box">
	
		<div class="mapa-tabela-janela">
			
			<table class="tabela_mapa">
		
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
							
							echo'
							<tr>
								
								<td><a href="'. $pag['pagina'] .'">'. $pag['titulo'] .'</a></td>
								
							</tr>
							';
							
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
							
							echo'
							<tr>
								
								<td><a href="'. $pag['pagina'] .'">'. $pag['titulo'] .'</a></td>
								
							</tr>
							';
							
						}
						
					?>
					
				</tbody>
				
			</table>
			
			<div id="tabela_mapa_paginacao" class="pagination"></div>
			
		</div>
		
	</div>
	
</section>

<script>

	let tabela_datatable = document.querySelector('.tabela_mapa');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 20, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_mapa_paginacao"
	});
	
	document.querySelector('.sorting').click();
	
</script>
<!-- End - view/mapa.php !-->