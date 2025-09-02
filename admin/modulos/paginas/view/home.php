<!-- Start - admin/modulos/paginas/wiew/home.php !-->
<?php require $raiz_site .'model/paginas.php'; ?>

<div class="conteudo paginas">
	
	<div class="titulo">Páginas</div>
	
	<div class="linha-auto">
		<div class="comentario"><?php echo count( $paginas ) ?> páginas encontradas.</div>
	</div>
	
	<div class="linha-acao">
		<a href="modulos/paginas/view/novo-02"><button class="autores-novo-btn">Criar página</button></a>
	</div>

	<table class="tabela_paginas">
	
		<thead>
			
			<tr>
			
				<th>Titulo</th>
				<th>Página</th>
				<th style="width:10vw">Ação</th>
				
			</tr>
			
		</thead>
		
		<tbody>
		
			<?php
				
				usort( $paginas, function( $a, $b ){//Função responsável por ordenar

					$al = mb_strtolower($a['titulo']);
					$bl = mb_strtolower($b['titulo']);
					
					if ($al == $bl){
						return 0;
					}
					
					return ($bl < $al) ? +1 : -1;
					
				} );

				//dd( $paginas );
				
				foreach( $paginas as $pag ){
					
					echo'
					<tr>
						
						<td>'. $pag['titulo'].'</td>
						<td><a href="'. $raiz_site.$pag['pagina'].'" target="_blank">'. $pag['pagina'].'</a></td>
						<td>
						
							<a href="modulos/paginas/view/editar?id='. $pag['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
							<a href="modulos/paginas/view/excluir?id='. $pag['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
							
						</td>
						
					</tr>
					';
					
				}
			
			?>
			
		</tbody>
	
	</table>
	
	<div id="tabela_paginas_paginacao" class="pagination"></div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_paginas');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_paginas_paginacao"
	});
	
</script>
<!-- End - admin/modulos/paginas/wiew/home.php !-->