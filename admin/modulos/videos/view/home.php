<!-- Start - admin/modulos/videos/wiew/home.php !-->
<?php 

require $raiz_site .'model/videos.php';

$videos_array = array_reverse( $videos_array ); 

?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo videos">
	
	<div class="titulo">Vídeos</div>
	
	<div class="linha-acao">
	
		<a href="modulos/videos/view/criar"><button class="autores-novo-btn">Criar vídeo</button></a>
		
		<a href="modulos/videos/view/ordenar"><button class="noticia-nova-btn">Ordenar Destaques</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_videos">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Categorias</th>
					<th>Destaque</th>
					<th>Ordem</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					usort($videos_array, function( $a, $b ){//Função responsável por ordenar

						$al = mb_strtolower($a['ordem']);
						$bl = mb_strtolower($b['ordem']);
						
						if ($al == $bl){
							return 0;
						}
						
						return ($bl < $al) ? +1 : -1;
						
					});
					
					foreach( $videos_array as $item ){
						
						if( $item['destaque'] == 1 ){
							
							echo'
							<tr>
								
								<td>
									<a 
										href="https://www.youtube.com/watch?v='. $item['codigo'] .'" 
										target="_blank"
									>'. $item['nome'] .' '; if( $item['rascunho'] == 1 ){ echo '<span class="fonte-vermelha">- RASCUNHO</span>'; }else{ echo ''; } echo'</a>
								</td>
								<td>'. $item['categorias'] .'</td>
								<td>
									<form method="GET" action="modulos/videos/controller/destaque" class="btn_switch_form_13">
										<input type="hidden" name="id" value="'. $item['id'] .'">
										<input type="hidden" name="btn_status" value="'.$item['destaque'].'">
										'; 
										
										if( $item['destaque'] == 0 ){ echo'<button class="destaque-btn">Não</button>'; } 
										if( $item['destaque'] == 1 ){ echo'<button class="destaque-btn destaque-btn-on">Destaque</button>'; } 
										
										echo'
									</form>
								</td>
								<td>'. $item['ordem'] .'</td>
								<td>
								
									<a href="modulos/videos/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
									<a href="modulos/videos/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
									
								</td>
								
							</tr>
							';
							
						}
						
					}
					
					foreach( $videos_array as $item ){
						
						if( $item['destaque'] == 0 ){
							
							echo'
							<tr>
								
								<td>
									<a 
										href="https://www.youtube.com/watch?v='. $item['codigo'] .'" 
										target="_blank"
									>'. $item['nome'] .' '; if( $item['rascunho'] == 1 ){ echo '<span class="fonte-vermelha">- RASCUNHO</span>'; }else{ echo ''; } echo'</a>
								</td>
								<td>'. $item['categorias'] .'</td>
								<td>
									<form method="GET" action="modulos/videos/controller/destaque" class="btn_switch_form_13">
										<input type="hidden" name="id" value="'. $item['id'] .'">
										<input type="hidden" name="btn_status" value="'.$item['destaque'].'">
										'; 
										
										if( $item['destaque'] == 0 ){ echo'<button class="destaque-btn">Não</button>'; } 
										if( $item['destaque'] == 1 ){ echo'<button class="destaque-btn destaque-btn-on">Destaque</button>'; } 
										
										echo'
									</form>
								</td>
								<td>-</td>
								<td>
								
									<a href="modulos/videos/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
									<a href="modulos/videos/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
									
								</td>
								
							</tr>
							';
							
						}
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_videos_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_videos');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true, 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_videos_paginacao"
	});
	
</script>
<!-- End - admin/modulos/videos/wiew/home.php !-->