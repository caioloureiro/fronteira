<!-- Start - admin/modulos/banner/wiew/home.php !-->
<?php require $raiz_site .'model/banner.php'; ?>

<style>
	<?php require 'css/destaque-btn.css'; ?>
	.escolher-imagem-thumb-tabela{
		background-size:cover;
	}
</style>

<div class="conteudo banner">
	
	<div class="titulo">banner</div>

	<div class="comentario">Tamanho recomendado de imagem: 1160x275px.</div>
	
	<div class="linha-acao">
	
		<a href="modulos/banner/view/novo-01">
			<button class="autores-novo-btn">Criar item</button>
		</a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_banner">
		
			<thead>
				
				<tr>
				
					<th style="width:5vw">Thumb</th>
					<th>Imagem</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $banner_array as $item ){
						
						echo'
						<tr>
							<td><div class="escolher-imagem-thumb-tabela" style="background-image:url( '. $raiz_site .'banners/'. $item['imagem'] .'"></div></td>
							<td>'. $item['imagem'] .'</td>
							<td>
							
								<a href="modulos/banner/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/banner/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_banner_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_banner');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [false, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [false, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_banner_paginacao"
	});
	
</script>
<!-- End - admin/modulos/banner/wiew/home.php !-->