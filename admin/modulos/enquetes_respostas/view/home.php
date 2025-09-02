<!-- Start - admin/modulos/enquetes_respostas/wiew/home.php !-->
<?php 
require $raiz_site .'model/enquete_respostas.php'; 
require $raiz_site .'model/enquete.php'; 
?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo enquete_respostas">
	
	<div class="titulo">Enquetes Respostas</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_enquete_respostas">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $enquete_array as $item ){
						
						echo'
						<tr>
							
							<td>
								<a href="'. $raiz_admin .'modulos/enquetes_respostas/view/visualizar?enquete_id='. $item['id'] .'">
									'. $item['nome'] .' '; require $raiz_admin .'img/external-link-alt.svg'; echo'
								</a>
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_enquete_respostas_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_enquete_respostas');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_enquete_respostas_paginacao"
	});
	
</script>
<!-- End - admin/modulos/enquetes_respostas/wiew/home.php !-->