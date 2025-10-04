<!-- Start - admin/modulos/links_uteis/wiew/home.php !-->
<?php require $raiz_site .'model/links_uteis.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo links_uteis">
	
	<div class="titulo">Links Úteis</div>
	
	<div class="linha-acao">
	
		<a href="modulos/links_uteis/view/criar"><button class="autores-novo-btn">Criar link</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_links_uteis">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $links_uteis_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>
							
								<a href="modulos/links_uteis/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/links_uteis/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_links_uteis_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_links_uteis');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_links_uteis_paginacao"
	});
	
</script>
<!-- End - admin/modulos/links_uteis/wiew/home.php !-->