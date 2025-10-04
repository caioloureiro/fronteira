<!-- Start - admin/modulos/legislacoes_categorias/wiew/home.php !-->
<?php 
require $raiz_site .'model/legislacoes_categorias.php'; 
$legislacoes_categorias_array = array_reverse( $legislacoes_categorias_array );
?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo legislacoes_categorias">
	
	<div class="titulo">Legislações Categorias</div>
	
	<div class="linha-acao">
	
		<a href="modulos/legislacoes_categorias/view/criar"><button class="autores-novo-btn">Criar categoria</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_legislacoes_categorias">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $legislacoes_categorias_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>
							
								<a href="modulos/legislacoes_categorias/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/legislacoes_categorias/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_legislacoes_categorias_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_legislacoes_categorias');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_legislacoes_categorias_paginacao"
	});
	
</script>
<!-- End - admin/modulos/legislacoes_categorias/wiew/home.php !-->