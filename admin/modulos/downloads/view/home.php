<!-- Start - admin/modulos/downloads/wiew/home.php !-->
<?php require $raiz_site .'model/downloads.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo downloads">
	
	<div class="titulo">Download</div>
	
	<div class="linha-acao">
	
		<a href="modulos/downloads/view/novo-01"><button class="autores-novo-btn">Criar item</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_downloads">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Arquivo</th>
					<th>Data</th>
					<th>Categorias</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					$downloads_array = array_reverse( $downloads_array );
					
					foreach( $downloads_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td><a href="'. $raiz_site .'arquivos/'. $item['arquivo'] .'" target="_blank">'. $item['arquivo'] .'</a></td>
							<td>'. $item['data'] .'</td>
							<td>'. $item['categorias'] .'</td>
							<td>
							
								<a href="modulos/downloads/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/downloads/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_downloads_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_downloads');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true, true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_downloads_paginacao"
	});
	
</script>
<!-- End - admin/modulos/downloads/wiew/home.php !-->