<!-- Start - admin/modulos/modulos_admin/wiew/home.php !-->
<?php 
require $raiz_site .'model/modulos_admin.php'; 
require $raiz_site .'model/menu_admin.php'; 
?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo modulos_admin">
	
	<div class="titulo">Módulos</div>
	
	<div class="linha-auto">
		<div class="comentario">Módulos do CMS criados pelo desenvolvedor. Para modificar, entre em contato com a Gmaes.</div>
	</div>
	
	<div class="linha-acao">
	
		<a href="modulos/modulos_admin/view/criar"><button class="autores-novo-btn">Criar módulo</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_modulos_admin">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<!-- <th style="width:10vw">Ação</th> !-->
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					usort($menu_admin_array, function( $a, $b ){//Função responsável por ordenar

						$al = mb_strtolower($a['nome']);
						$bl = mb_strtolower($b['nome']);
						
						if ($al == $bl){
							return 0;
						}
						
						return ($bl < $al) ? +1 : -1;
						
					});
					
					foreach( $menu_admin_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<!-- 
							<td>
							
								<a href="modulos/modulos_admin/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/modulos_admin/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							!-->
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_modulos_admin_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_modulos_admin');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_modulos_admin_paginacao"
	});
	
</script>
<!-- End - admin/modulos/modulos_admin/wiew/home.php !-->