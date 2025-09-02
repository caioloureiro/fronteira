<!-- Start - admin/modulos/ceg/wiew/home.php !-->
<?php require $raiz_site .'model/ceg.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo ceg">
	
	<div class="titulo">ceg</div>
	
	<div class="linha-acao">
	
		<a href="modulos/ceg/view/criar"><button class="autores-novo-btn">Criar ceg</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_ceg">
		
			<thead>
				
				<tr>
				
					<th>cegNome</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $ceg_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['cegNome'] .'</td>
							<td>
							
								<a href="modulos/ceg/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/ceg/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_ceg_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_ceg');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_ceg_paginacao"
	});
	
</script>
<!-- End - admin/modulos/ceg/wiew/home.php !-->