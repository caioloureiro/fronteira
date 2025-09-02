<!-- Start - admin/modulos/vacinometro/wiew/home.php !-->
<?php require $raiz_site .'model/vacinometro.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo vacinometro">
	
	<div class="titulo">Exemplo</div>
	
	<div class="linha-acao">
	
		<a href="modulos/vacinometro/view/criar"><button class="autores-novo-btn">Criar atualização</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_vacinometro">
		
			<thead>
				
				<tr>
				
					<th>Data</th>
					<th>1ª Dose</th>
					<th>2ª Dose</th>
					<th>3ª Dose</th>
					<th>4ª Dose</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					$vacinometro_array = array_reverse( $vacinometro_array );
					
					foreach( $vacinometro_array as $item ){
						
						echo'
						<tr>
							
							<td>'. data_tempo( $item['data'] ) .'</td>
							<td>'. $item['1_dose'] .'</td>
							<td>'. $item['2_dose'] .'</td>
							<td>'. $item['3_dose'] .'</td>
							<td>'. $item['4_dose'] .'</td>
							<td>
							
								<a href="modulos/vacinometro/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/vacinometro/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_vacinometro_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_vacinometro');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_vacinometro_paginacao"
	});
	
</script>
<!-- End - admin/modulos/vacinometro/wiew/home.php !-->