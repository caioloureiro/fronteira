<!-- Start - admin/modulos/menu_servicos/wiew/home.php !-->
<?php require $raiz_site .'model/menu_servicos.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo menu_servicos">
	
	<div class="titulo">Menu Serviços</div>
	
	<div class="linha-acao">
	
		<a href="modulos/menu_servicos/view/criar"><button class="autores-novo-btn">Criar menu de serviço</button></a>
		
		<a href="modulos/menu_servicos/view/ordenar"><button class="autores-novo-btn">Ordenar menu de serviço</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_menu_servicos">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Realce</th>
					<th>Ordem</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $menu_servicos_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>'. $item['realce'] .'</td>
							<td>'. $item['ordem'] .'</td>
							<td>
							
								<a href="modulos/menu_servicos/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/menu_servicos/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_menu_servicos_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_menu_servicos');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_menu_servicos_paginacao"
	});
	
</script>
<!-- End - admin/modulos/menu_servicos/wiew/home.php !-->