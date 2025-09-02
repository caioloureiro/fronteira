<!-- Start - admin/modulos/modulos-usr/wiew/home.php !-->
<?php require $raiz_site .'model/admin_user.php'; ?>

<div class="conteudo modulos-usr">
	
	<div class="titulo">Módulos por Usuário</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_modulos-usr">
		
			<thead>
				
				<tr>
				
					<th>Usuário</th>
					<th style="width:5vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $admin_user_array as $usr ){
						
						echo'
						<tr>
							
							<td>'. $usr['nome'].'</td>
							<td>
							
								<a href="modulos/modulos-usr/view/editar?id='. $usr['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
				
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_modulos-usr_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_modulos-usr');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_modulos-usr_paginacao"
	});
	
</script>
<!-- End - admin/modulos/modulos-usr/wiew/home.php !-->