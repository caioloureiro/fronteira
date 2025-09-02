<!-- Start - admin/modulos/formularios_respostas/wiew/home.php !-->
<?php 
require $raiz_site .'model/formularios_respostas.php'; 
require $raiz_site .'model/formularios.php'; 
?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo formularios_respostas">
	
	<div class="titulo">Formulários Respostas</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_formularios_respostas">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $formularios_array as $item ){
						
						echo'
						<tr>
							
							<td>
								<a href="'. $raiz_admin .'modulos/formularios_respostas/view/visualizar?formulario_id='. $item['id'] .'">
									'. $item['nome'] .' '; require $raiz_admin .'img/external-link-alt.svg'; echo'
								</a>
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_formularios_respostas_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_formularios_respostas');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_formularios_respostas_paginacao"
	});
	
</script>
<!-- End - admin/modulos/formularios_respostas/wiew/home.php !-->