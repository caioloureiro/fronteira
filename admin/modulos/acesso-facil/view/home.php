<!-- Start - admin/modulos/acesso-facil/wiew/home.php !-->
<?php 
require $raiz_site .'model/acesso_facil_base.php'; 
require $raiz_site .'model/acesso_facil.php'; 
?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo acesso-facil">
	
	<div class="titulo">Acesso Fácil</div>
	
	<div class="linha-acao">
	
		<a href="modulos/acesso-facil/view/criar"><button class="autores-novo-btn">Criar Acesso Fácil</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_acesso-facil">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>link</th>
					<th>Pai</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					usort($acesso_facil_array, function( $a, $b ){//Função responsável por ordenar

						$al = mb_strtolower($a['nome']);
						$bl = mb_strtolower($b['nome']);
						
						if ($al == $bl){
							return 0;
						}
						
						return ($bl < $al) ? +1 : -1;
						
					});
					
					foreach( $acesso_facil_array as $item ){
						
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
							
							<td>'. $item['nome'] .'</td>
							<td><a href="'. $link .'" target="_blank">'. $item['link'] .'</a></td>
							<td>
								';
								
								foreach( $acesso_facil_base_array as $acesso_base ){
									
									if( $acesso_base['id'] == $item['pai'] ){
										
										echo $acesso_base['nome'];
										
									}
									
								}
								
								echo'
							</td>
							<td>
							
								<a href="modulos/acesso-facil/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/acesso-facil/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_acesso-facil_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_acesso-facil');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true, 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_acesso-facil_paginacao"
	});
	
</script>
<!-- End - admin/modulos/acesso-facil/wiew/home.php !-->