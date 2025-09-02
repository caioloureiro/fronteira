<!-- Start - view/editais.php !-->
<?php

require 'model/editais.php';
require 'model/modalidade_licitacoes.php';
require 'model/downloads.php';
require 'model/chamamento_publico.php';

$editais_array = array_reverse( $editais_array );

$counterHTML =  'Nenhum item encontrado.';
$counter_diarios = 0;

foreach( $editais_array as $count_item ){ $counter_diarios++; }

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
		require 'css/editais.css'; 
		require 'css/tabela.css';
	?>
</style>

<section class="editais">
	
	<div class="box">
		
		<div class="editais-counter"><?php echo $counterHTML ?></div>
		
		<table class="tabela_editais">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Modalidade</th>
					<th>Item</th>
					<th>Arquivo</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					$pasta = 'arquivos/';
					
					foreach( $editais_array as $item ){
						
						$modalidade = '';
						$modalidade_item = '-';
						$arquivo = '';
						
						foreach( $modalidade_licitacoes_array as $mod ){
							
							if( $mod['id'] == $item['modalidade_id'] ){
								
								$modalidade = $mod['nome'];
								
							}
							
						}
						
						if( $item['modalidade_item_id'] != '' ){
							
							$modalidade_item = '<a href="chamamento-publico-item&id='. $item['modalidade_item_id'] .'">Acessar</a>';
							
						}
						
						foreach( $downloads_array as $down ){
							
							if( 
								$item['modalidade_arquivo_id'] != ''
								&& $down['id'] == $item['modalidade_arquivo_id'] 
							){
								
								$arquivo = '<a href="'. $pasta . $down['arquivo'] .'" target="_blank" download="'. $down['arquivo'] .'">Download</a>';
								
							}
							
						}
						
						echo'
						<tr>
							<td>'. $item['nome'] .'</td>
							<td>'. $modalidade .'</td>
							<td>'. $modalidade_item .'</td>
							<td>'. $arquivo .'</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_editais_paginacao" class="pagination"></div>
		
	</div>
	
</section>

<script>

	let tabela_datatable = document.querySelector('.tabela_editais');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, 'select', 'select', 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_editais_paginacao"
	});
	
</script>
<!-- End - view/editais.php !-->