<!-- Start - admin/modulos/cemiterios/wiew/home.php !-->
<?php require $raiz_site .'model/cemiterios.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo cemiterios">
	
	<div class="titulo">Cemitérios</div>
	
	<div class="linha-acao">
	
		<a href="modulos/cemiterios/view/criar"><button class="autores-novo-btn">Criar cemitério</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_cemiterios">
		
			<thead>
				
				<tr>
				
					<th>cemNome</th>
					<th>cemTelefone</th>
					<th>cemEmail</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $cemiterios_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['cemNome'] .'</td>
							<td>'. $item['cemTelefone'] .'</td>
							<td>'. $item['cemEmail'] .'</td>
							<td>
							
								<a href="modulos/cemiterios/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/cemiterios/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_cemiterios_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_cemiterios');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_cemiterios_paginacao"
	});
	
</script>
<!-- End - admin/modulos/cemiterios/wiew/home.php !-->