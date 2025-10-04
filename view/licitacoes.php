<!-- Start - view/licitacoes.php !-->
<?php

require 'model/licitacoes.php';

$licitacoes_array = array_reverse( $licitacoes_array );

$counterHTML =  'Nenhum item encontrado.';
$counter_diarios = 0;

foreach( $licitacoes_array as $count_item ){ $counter_diarios++; }

if( $counter_diarios == 1 ){
	$counterHTML = '1 item encontrado.';
}

if( $counter_diarios > 1 ){
	$counterHTML = $counter_diarios .' itens encontrados.';
}

usort($licitacoes_array, function( $a, $b ){ //Função responsável por ordenar
	$al = mb_strtolower($a['publicacao']);
	$bl = mb_strtolower($b['publicacao']);
	if ($al == $bl){ return 0; }
	return ($bl > $al) ? +1 : -1; // < ASC; > DESC
});

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/css/datatable.css" integrity="sha512-zHpjdnFxcMInClTw4ZqdX6NNLuPU+iJMZEQsyIjXuQX8TZXzRhZIlUi0tQTGQxt/UGruFgs0qTBshuGN0ts/vQ==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>

<style>
	<?php 
		require 'css/licitacoes.css'; 
		require 'css/tabela.css'; 
	?>
</style>

<section class="licitacoes">
	
	<div class="box">
		
		<div class="licitacoes-counter"><?php echo $counterHTML ?></div>
		
		<table class="tabela_licitacoes">
		
			<thead>
				
				<tr>
				
					<th style="width:40vw">Tipo</th>
					<th style="width:40vw">Número</th>
					<th style="width:40vw">Objeto</th>
					<th style="width:10vw">Publicação</th>
					<th style="width:10vw">Situação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $licitacoes_array as $item ){
						
						echo'
						<tr>
							<td>
								<a 
									href="licitacao&id='. $item['id'] .'" 
									title="acessar"
								>
									'. $item['categoria'] .'
								</a>
							</td>
							<td>
								<a 
									href="licitacao&id='. $item['id'] .'" 
									title="acessar"
								>
									'. $item['numero'] .'
								</a>
							</td>
							<td>
								<a 
									href="licitacao&id='. $item['id'] .'" 
									title="acessar"
								>
									'. $item['objeto'] .'
								</a>
							</td>
							<td>'. data_tempo( $item['publicacao'] ) .'</td>
							<td>'. $item['situacao'] .'</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_licitacoes_paginacao" class="pagination"></div>
		
	</div>
	
</section>

<script>

	let tabela_datatable = document.querySelector('.tabela_licitacoes');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: ['select', true, true, true, 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_licitacoes_paginacao"
	});
	
</script>
<!-- End - view/licitacoes.php !-->