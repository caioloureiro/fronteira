<!-- Start - admin/modulos/menu_interno/wiew/home.php !-->
<?php require $raiz_site .'model/menu_interno.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo menu_interno">
	
	<div class="titulo">Menu Interno</div>
	
	<div class="linha-acao">
	
		<a href="modulos/menu_interno/view/criar"><button class="autores-novo-btn">Criar menu interno</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_menu_interno">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Página Alvo</th>
					<th>Subpágina Alvo (Secretarias)</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $menu_interno_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>'. $item['pagina_alvo'] .'</td>
							<td>'. $item['subpagina_alvo'] .'</td>
							<td>
							
								<a href="modulos/menu_interno/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/menu_interno/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_menu_interno_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_menu_interno');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, 'select', 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_menu_interno_paginacao"
	});
	
</script>
<!-- End - admin/modulos/menu_interno/wiew/home.php !-->