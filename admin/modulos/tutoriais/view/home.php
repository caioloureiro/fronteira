<!-- Start - admin/modulos/tutoriais/wiew/home.php !-->
<?php require $raiz_site .'model/tutoriais.php'; ?>

<div class="conteudo tutoriais">
	
	<div class="titulo">Tutoriais</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_tutoriais">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					
				</tr>
				
			</thead>
			
			<tbody>

				<?php
					
					foreach( $tutoriais_array as $video ){
						
						echo'
						<tr>
							<td>
								<a 
									href="modulos/tutoriais/view/video?nome='. $video['get'] .'"
								>'. $video['nome'] .'</a>
							</td>
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_tutoriais_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_tutoriais');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_tutoriais_paginacao"
	});
	
</script>
<!-- End - admin/modulos/tutoriais/wiew/home.php !-->