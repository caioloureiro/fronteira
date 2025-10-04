<!-- Start - admin/modulos/concursos_categorias/wiew/home.php !-->
<?php 
require $raiz_site .'model/concursos_categorias.php'; 
$concursos_categorias_array = array_reverse( $concursos_categorias_array );
?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo concursos_categorias">
	
	<div class="titulo">Concursos Categorias</div>
	
	<div class="linha-acao">
	
		<a href="modulos/concursos_categorias/view/criar"><button class="autores-novo-btn">Criar categoria</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_concursos_categorias">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $concursos_categorias_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>
							
								<a href="modulos/concursos_categorias/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/concursos_categorias/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_concursos_categorias_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_concursos_categorias');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_concursos_categorias_paginacao"
	});
	
</script>
<!-- End - admin/modulos/concursos_categorias/wiew/home.php !-->