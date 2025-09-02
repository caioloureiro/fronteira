<!-- Start - admin/modulos/acesso_facil_base/wiew/home.php !-->
<?php require $raiz_site .'model/acesso_facil_base.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo acesso_facil_base">
	
	<div class="titulo">Acesso Fácil Base</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_acesso_facil_base">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th style="width:5vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $acesso_facil_base_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>
							
								<a href="modulos/acesso_facil_base/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_acesso_facil_base_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_acesso_facil_base');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_acesso_facil_base_paginacao"
	});
	
</script>
<!-- End - admin/modulos/acesso_facil_base/wiew/home.php !-->