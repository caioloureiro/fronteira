<!-- Start - admin/modulos/concursos/wiew/home.php !-->
<?php 
require $raiz_site .'model/concursos.php'; 
$concursos_array = array_reverse( $concursos_array );
?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo concursos">
	
	<div class="titulo">Concurso</div>
	
	<div class="linha-acao">
	
		<a href="modulos/concursos/view/criar"><button class="autores-novo-btn">Criar concurso</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_concursos">
		
			<thead>
				
				<tr>
				
					<th>Categoria</th>
					<th>Nome</th>
					<th>Situação</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $concursos_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['categoria'] .'</td>
							<td>'. $item['nome'] .'</td>
							<td>'. $item['situacao'] .'</td>
							<td>
							
								<a href="modulos/concursos/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/concursos/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_concursos_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_concursos');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: ['select', true, 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_concursos_paginacao"
	});
	
</script>
<!-- End - admin/modulos/concursos/wiew/home.php !-->