<!-- Start - admin/modulos/paginas_fixas/wiew/home.php !-->
<?php require $raiz_site .'model/paginas_fixas.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo paginas_fixas">
	
	<div class="titulo">Páginas Fixas</div>
	
	<div class="linha-auto">
		<div class="comentario">Páginas Fixas são páginas especiais criadas pelo desenvolvedor. Para modificar, entre em contato com a Gmaes.</div>
	</div>
	
	<div class="linha-acao">
	
		<a href="modulos/paginas_fixas/view/criar"><button class="autores-novo-btn">Criar Página Fixa</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_paginas_fixas">
		
			<thead>
				
				<tr>
				
					<th>Página</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					usort($paginas_fixas, function( $a, $b ){//Função responsável por ordenar

						$al = mb_strtolower($a['titulo']);
						$bl = mb_strtolower($b['titulo']);
						
						if ($al == $bl){
							return 0;
						}
						
						return ($bl < $al) ? +1 : -1;
						
					});
					
					foreach( $paginas_fixas as $item ){
						
						echo'
						<tr>
							
							<td><a href="'. $raiz_site . $item['pagina'] .'" target="_blank">'. $item['titulo'] .'</a></td>
							<td>
							
								<a href="modulos/paginas_fixas/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/paginas_fixas/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_paginas_fixas_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_paginas_fixas');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_paginas_fixas_paginacao"
	});
	
</script>
<!-- End - admin/modulos/paginas_fixas/wiew/home.php !-->