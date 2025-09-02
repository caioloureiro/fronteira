<!-- Start - admin/modulos/categorias/wiew/home.php !-->
<?php require $raiz_site .'model/categorias.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo categorias">
	
	<div class="titulo">Categorias</div>
	
	<div class="linha-acao">
	
		<a href="modulos/categorias/view/criar"><button class="autores-novo-btn">Criar categoria</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_categorias">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $categorias_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>
							
								<a href="modulos/categorias/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/categorias/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_categorias_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_categorias');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_categorias_paginacao"
	});
	
</script>
<!-- End - admin/modulos/categorias/wiew/home.php !-->