<!-- Start - admin/modulos/galeria_noticias/wiew/home.php !-->
<?php 

require $raiz_site .'model/galeria_noticias.php'; 
require $raiz_site .'model/noticias.php'; 

?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo galeria_noticias">
	
	<div class="titulo">Galerias de Notícias</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_galeria_noticias">
		
			<thead>
				
				<tr>
				
					<th>Notícia</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					$noticias_array = array_reverse( $noticias_array );
					
					foreach( $noticias_array as $item ){
						
						echo'
						<tr>
							
							<td><span><a href="'. $raiz_site .'noticia&id='. $item['id'] .'" target="_blank">'. $item['titulo'] .'</a></span></td>
							<td>
							
								<a href="modulos/galeria_noticias/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/galeria_noticias/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_galeria_noticias_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_galeria_noticias');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_galeria_noticias_paginacao"
	});
	
</script>
<!-- End - admin/modulos/galeria_noticias/wiew/home.php !-->