<!-- Start - view/chamamento-publico.php !-->
<?php

require 'model/chamamento_publico.php';

$chamamento_publico_array = array_reverse( $chamamento_publico_array );

$counterHTML =  'Nenhum item encontrado.';
$counter_diarios = 0;

foreach( $chamamento_publico_array as $count_item ){ $counter_diarios++; }

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
		require 'css/chamamento-publico.css'; 
		require 'css/tabela.css'; 
	?>
</style>

<section class="chamamento-publico">
	
	<div class="box">
		
		<div class="chamamento-publico-counter"><?php echo $counterHTML ?></div>
		
		<table class="tabela_chamamento_publico">
		
			<thead>
				
				<tr>
				
					<th style="width:40vw">Nome</th>
					<th style="width:10vw">Postagem</th>
					<th style="width:10vw">Situação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $chamamento_publico_array as $item ){
						
						echo'
						<tr>
							<td>
								<a 
									href="chamamento-publico-item&id='. $item['id'] .'" 
									title="acessar"
								>
									'. $item['titulo'] .'
								</a>
							</td>
							<td>'. data_tempo( $item['data'] ) .'</td>
							<td>'. $item['situacao'] .'</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_chamamento_publico_paginacao" class="pagination"></div>
		
	</div>
	
</section>

<script>

	let tabela_datatable = document.querySelector('.tabela_chamamento_publico');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true, 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_chamamento_publico_paginacao"
	});
	
</script>
<!-- End - view/chamamento-publico.php !-->