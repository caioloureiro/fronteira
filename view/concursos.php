<!-- Start - view/concursos.php !-->
<?php

require 'model/concursos.php';

$concursos_array = array_reverse( $concursos_array );

$counterHTML =  'Nenhum item encontrado.';
$counter_diarios = 0;

foreach( $concursos_array as $count_item ){ $counter_diarios++; }

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
		require 'css/concursos.css'; 
		require 'css/tabela.css'; 
	?>
</style>

<section class="concursos">
	
	<div class="box">
		
		<div class="concursos-counter"><?php echo $counterHTML ?></div>
		
		<table class="tabela_concursos">
		
			<thead>
				
				<tr>
				
					<th style="width:40vw">Tipo</th>
					<th style="width:40vw">Nome</th>
					<th style="width:10vw">Início</th>
					<th style="width:10vw">Situação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $concursos_array as $item ){
						
						echo'
						<tr>
							<td><a 
									href="concurso&id='. $item['id'] .'" 
									title="acessar"
								>
									'. $item['categoria'] .'
								</a></td>
							<td>
								<a 
									href="concurso&id='. $item['id'] .'" 
									title="acessar"
								>
									'. $item['nome'] .'
								</a>
							</td>
							<td>'. data_tempo( $item['inicio'] ) .'</td>
							<td>'. $item['situacao'] .'</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_concursos_paginacao" class="pagination"></div>
		
	</div>
	
</section>

<script>

	let tabela_datatable = document.querySelector('.tabela_concursos');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: ['select', true, true, 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_concursos_paginacao"
	});
	
</script>
<!-- End - view/concursos.php !-->