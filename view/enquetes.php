<!-- Start - view/enquetes.php !-->
<?php

require 'model/enquete.php';

$enquete_array = array_reverse( $enquete_array );

$counterHTML =  'Nenhum item encontrado.';
$counter_diarios = 0;

foreach( $enquete_array as $count_item ){ $counter_diarios++; }

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
		require 'css/enquetes.css'; 
		require 'css/tabela.css'; 
	?>
</style>

<section class="enquetes">
	
	<div class="box">
		
		<div class="enquetes-counter"><?php echo $counterHTML ?></div>
		
		<table class="tabela_enquete">
		
			<thead>
				
				<tr>
				
					<th style="width:40vw">Nome</th>
					<th style="width:10vw">Início</th>
					<th style="width:10vw">Encerramento</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $enquete_array as $item ){
						
						echo'
						<tr>
							<td>
								<a 
									href="enquete&id='. $item['id'] .'" 
									title="acessar"
								>
									'. $item['nome'] .'
								</a>
							</td>
							<td>'. data_tempo( $item['inicio'] ) .'</td>
							<td>'. data_tempo( $item['final'] ) .'</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_enquete_paginacao" class="pagination"></div>
		
	</div>
	
</section>

<script>

	let tabela_datatable = document.querySelector('.tabela_enquete');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_enquete_paginacao"
	});
	
</script>
<!-- End - view/enquetes.php !-->