<!-- Start - view/legislacoes.php !-->
<?php

require 'model/legislacoes.php';

$legislacoes_array = array_reverse( $legislacoes_array );

$counterHTML =  'Nenhum item encontrado.';
$counter_diarios = 0;

foreach( $legislacoes_array as $count_item ){ $counter_diarios++; }

if( $counter_diarios == 1 ){
	$counterHTML = '1 item encontrado.';
}

if( $counter_diarios > 1 ){
	$counterHTML = $counter_diarios .' itens encontrados.';
}


?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/css/datatable.css" integrity="sha512-zHpjdnFxcMInClTw4ZqdX6NNLuPU+iJMZEQsyIjXuQX8TZXzRhZIlUi0tQTGQxt/UGruFgs0qTBshuGN0ts/vQ==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>

<style>
	<?php 
		require 'css/legislacoes.css'; 
		require 'css/tabela.css'; 
	?>
</style>

<section class="legislacoes">
	
	<div class="box">
		
		<div class="legislacoes-counter"><?php echo $counterHTML ?></div>
		
		<table class="tabela_legislacoes">
		
			<thead>
				
				<tr>
				
					<th style="width:10vw">Categoria</th>
					<th style="width:40vw">Objeto</th>
					<th style="width:10vw">Publicação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $legislacoes_array as $item ){
						
						echo'
						<tr>
							<td>'. $item['categoria'] .'</td>
							<td>
								<a 
									href="legislacao&id='. $item['id'] .'" 
									title="acessar"
								>
									'. $item['texto'] .'
								</a>
							</td>
							<td>'. data_tempo( $item['data'] ) .'</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_legislacoes_paginacao" class="pagination"></div>
		
	</div>
	
</section>

<script>

	let tabela_datatable = document.querySelector('.tabela_legislacoes');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: ['select', true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_legislacoes_paginacao"
	});
	
</script>
<!-- End - view/legislacoes.php !-->