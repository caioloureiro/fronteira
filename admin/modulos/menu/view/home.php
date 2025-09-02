<!-- Start - admin/modulos/menu/wiew/home.php !-->
<?php require $raiz_site .'model/menu.php'; ?>

<div class="conteudo">
	
	<div class="titulo">Menu</div>
	
	<div class="linha-acao">
	
		<a href="modulos/menu/view/criar"><button class="autores-novo-btn">Criar menu</button></a>
		<a href="modulos/menu/view/ordenar"><button class="autores-novo-btn">Ordenar menu</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_menu">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Link</th>
					<th>Nível</th>
					<th>Pai</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $menu_array as $item ){
						
						$nivel = '';
						if( $item['nivel'] == 0 ){ $nivel = 'menu'; }
						if( $item['nivel'] == 1 ){ $nivel = 'submenu'; }
						
						$pai = '';
						if( $item['pai'] == 0 ){ $pai = '-'; }
						
						foreach( $menu_array as $getPai ){
							
							if( $item['pai'] == $getPai['id'] ){ $pai = $getPai['nome']; }
							
						}

						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>'. $item['link'] .'</td>
							<td>'. $nivel .'</td>
							<td>'. $pai .'</td>
							<td>
							
								<a href="modulos/menu/view/editar?id='. $item['id'] .'">
									<div class="tabela-btn tabela-btn-editar" title="Editar"></div>
								</a>
								<a href="modulos/menu/view/excluir?id='. $item['id'] .'">
									<div class="tabela-btn tabela-btn-excluir" title="Excluir"></div>
								</a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_menu_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_menu');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true, 'select', 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_menu_paginacao"
	});
	
</script>
<!-- End - admin/modulos/menu/wiew/home.php !-->