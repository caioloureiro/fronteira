<!-- Start - admin/modulos/whitelist/wiew/home.php !-->
<?php require $raiz_site .'model/whitelist.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo whitelist">
	
	<div class="titulo">Whitelist</div>
	
	<div class="linha-acao">
	
		<a href="modulos/whitelist/view/criar"><button class="autores-novo-btn">Criar</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_whitelist">
		
			<thead>
				
				<tr>
				
					<th>IP</th>
					<th>Nome</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $whitelist_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['ip'] .'</td>
							<td>'. $item['nome'] .'</td>
							<td>
							
								<a href="modulos/whitelist/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/whitelist/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_whitelist_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_whitelist');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_whitelist_paginacao"
	});
	
</script>
<!-- End - admin/modulos/whitelist/wiew/home.php !-->