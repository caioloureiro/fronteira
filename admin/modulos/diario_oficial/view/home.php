<!-- Start - admin/modulos/diario_oficial/wiew/home.php !-->
<?php 
require $raiz_site .'model/diario_oficial.php'; 
$diario_oficial_array = array_reverse( $diario_oficial_array );
?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo diario_oficial">
	
	<div class="titulo">Diário Oficial</div>
	
	<div class="linha-acao">
	
		<a href="modulos/diario_oficial/view/criar"><button class="autores-novo-btn">Criar diário</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_diario_oficial">
		
			<thead>
				
				<tr>
				
					<th>Título</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $diario_oficial_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['titulo'] .'</td>
							<td>
							
								<a href="modulos/diario_oficial/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/diario_oficial/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_diario_oficial_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_diario_oficial');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_diario_oficial_paginacao"
	});
	
</script>
<!-- End - admin/modulos/diario_oficial/wiew/home.php !-->