<!-- Start - admin/modulos/acesso_rapido/wiew/home.php !-->
<?php require $raiz_site .'model/acesso_rapido.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo acesso_rapido">
	
	<div class="titulo">Acesso Rápido</div>
	
	<div class="linha-acao">
	
		<a href="modulos/acesso_rapido/view/novo-01"><button class="autores-novo-btn">Criar acesso rápido</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_acesso_rapido">
		
			<thead>
				
				<tr>
					
					<th style="width:5vw">Ícone</th>
					<th>Título</th>
					<th>Link</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					usort($acesso_rapido_array, function( $a, $b ){//Função responsável por ordenar

						$al = mb_strtolower($a['titulo']);
						$bl = mb_strtolower($b['titulo']);
						
						if ($al == $bl){
							return 0;
						}
						
						return ($bl < $al) ? +1 : -1;
						
					});
					
					foreach( $acesso_rapido_array as $item ){
						
						$url_check = explode( '/', $item['link'] );

						if(
							$url_check[0] == 'http:' ||
							$url_check[0] == 'https:'
						){

							$link = $item['link'];
							
						}else{

							$link = '../'. $item['link'];
							
						}
						
						echo'
						<tr>
							
							<td><div class="escolher-imagem-thumb-tabela" style="background-image:url( '. $raiz_site .'acesso-rapido/'. $item['icone'] .'"></div></td>
							<td>'. $item['titulo'] .'</td>
							<td><a href="'. $link .'" target="_blank">'. $item['link'] .'</a></td>
							<td>
							
								<a href="modulos/acesso_rapido/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/acesso_rapido/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_acesso_rapido_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_acesso_rapido');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [false, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [false, true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_acesso_rapido_paginacao"
	});
	
</script>
<!-- End - admin/modulos/acesso_rapido/wiew/home.php !-->