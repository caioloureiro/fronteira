<!-- Start - admin/modulos/artigos/wiew/home.php !-->
<?php require '../model/artigos.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo artigos">
	
	<div class="titulo">Artigos</div>
	
	<div class="linha-acao">
	
		<a href="modulos/artigos/view/novo-01"><button class="autores-novo-btn">Criar artigo</button></a>
		
		<a href="modulos/artigos/view/ordenar"><button class="noticia-nova-btn">Ordenar Destaques</button></a>
		
	</div>

	<table class="tabela_artigos">
	
		<thead>
			
			<tr>
			
				<th>Titulo</th>
				<th style="width:10vw">Destaque</th>
				<th></th>
				<th style="width:10vw">Ação</th>
				
			</tr>
			
		</thead>
		
		<tbody>
		
			<?php
				
				usort( $artigos_array, function( $a, $b ){//Função responsável por ordenar

					$al = mb_strtolower($a['destaque_ordem']);
					$bl = mb_strtolower($b['destaque_ordem']);
					
					if ($al == $bl){
						return 0;
					}
					
					return ($bl < $al) ? +1 : -1;
					
				} );

				//dd( $artigos_array );
				
				foreach( $artigos_array as $item ){
					
					if( $item['destaque'] == 1 ){
					
						echo'
						<tr>
							
							<td>'. $item['titulo'].' '; if( $item['publicado'] == 0 ){ echo '<span class="fonte-vermelha">- RASCUNHO</span>'; }else{ echo ''; } echo'</td>
							<td>
								<form method="GET" action="modulos/artigos/controller/destaque">
									<input type="hidden" name="id" value="'. $item['id'] .'">
									<input type="hidden" name="btn_status" value="'.$item['destaque'].'">
									<button class="destaque-btn '; if( $item['destaque'] == 1 ){ echo'destaque-btn-on'; } echo'">Destaque</button>
								</form>
							</td>
							<td>'.$item['destaque_ordem'].'</td>
							<td>
							
								<a href="modulos/artigos/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/artigos/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
					
					}
					
				}
				
				usort( $artigos_array, function( $a, $b ){//Função responsável por ordenar

					$al = mb_strtolower($a['titulo']);
					$bl = mb_strtolower($b['titulo']);
					
					if ($al == $bl){
						return 0;
					}
					
					return ($bl < $al) ? +1 : -1;
					
				} );

				//dd( $artigos_array );
				
				foreach( $artigos_array as $item ){
					
					if( $item['destaque'] == 0 ){
					
						echo'
						<tr>
							
							<td>'. $item['titulo'].' '; if( $item['publicado'] == 0 ){ echo '<span class="fonte-vermelha">- RASCUNHO</span>'; }else{ echo ''; } echo'</td>
							<td>
								<form method="GET" action="modulos/artigos/controller/destaque">
									<input type="hidden" name="id" value="'. $item['id'] .'">
									<input type="hidden" name="btn_status" value="'.$item['destaque'].'">
									<button class="destaque-btn '; if( $item['destaque'] == 1 ){ echo'destaque-btn-on'; } echo'">Destaque</button>
								</form>
							</td>
							<td>-</td>
							<td>
							
								<a href="modulos/artigos/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/artigos/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
					
					}
					
				}
			
			?>
			
		</tbody>
	
	</table>
	
	<div id="tabela_artigos_paginacao" class="pagination"></div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_artigos');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_artigos_paginacao"
	});
	
</script>
<!-- End - admin/modulos/artigos/wiew/home.php !-->