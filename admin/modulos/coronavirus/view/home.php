<!-- Start - admin/modulos/coronavirus/wiew/home.php !-->
<?php require $raiz_site .'model/coronavirus.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo coronavirus">
	
	<div class="titulo">Coronavírus</div>
	
	<div class="linha-acao">
	
		<a href="modulos/coronavirus/view/criar"><button class="autores-novo-btn">Criar atualização</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_coronavirus">
		
			<thead>
				
				<tr>
				
					<th>Data</th>
					<th>Confirmados</th>
					<th>Descartados</th>
					<th>Óbitos</th>
					<th>Quarentena</th>
					<th>UTI</th>
					<th>Enfermaria</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					$coronavirus_array = array_reverse( $coronavirus_array );
					
					foreach( $coronavirus_array as $item ){
						
						$confirmados = '-';
						$descartados = '-';
						$obitos = '-';
						$quarentena = '-';
						$uti = '-';
						$enfermaria = '-';
						
						if( $item['confirmados'] != 0 ){ $confirmados = $item['confirmados']; }
						if( $item['descartados'] != 0 ){ $descartados = $item['descartados']; }
						if( $item['obitos'] != 0 ){ $obitos = $item['obitos']; }
						if( $item['quarentena'] != 0 ){ $quarentena = $item['quarentena']; }
						if( $item['uti'] != 0 ){ $uti = $item['uti']; }
						if( $item['enfermaria'] != 0 ){ $enfermaria = $item['enfermaria']; }
						
						echo'
						<tr>
							
							<td>'. data_tempo( $item['data'] ) .'</td>
							<td>'. $confirmados .'</td>
							<td>'. $descartados .'</td>
							<td>'. $obitos .'</td>
							<td>'. $quarentena .'</td>
							<td>'. $uti .'</td>
							<td>'. $enfermaria .'</td>
							<td>
							
								<a href="modulos/coronavirus/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/coronavirus/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_coronavirus_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_coronavirus');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_coronavirus_paginacao"
	});
	
</script>
<!-- End - admin/modulos/coronavirus/wiew/home.php !-->