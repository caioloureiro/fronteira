<!-- Start - admin/modulos/popup_paginas/wiew/home.php !-->
<?php 
require $raiz_site .'model/popup_paginas.php';

function getItem( $id, $alvo, $raiz_site, $conn ){
	
	if( $alvo == 'pagina' ){
		
		require $raiz_site .'model/paginas.php';
		
		foreach( $paginas as $item ){
			
			if( $item['id'] == $id ){
				
				return '<a href="'. $raiz_site . $item['pagina'] .'" target="_blank">'. $item['titulo'] .'</a>';
				
			}
			
		}
		
	}
	
	if( $alvo == 'pagina_fixa' ){
		
		require $raiz_site .'model/paginas_fixas.php';
		
		foreach( $paginas_fixas as $item ){
			
			if( $item['id'] == $id ){
				
				return '<a href="'. $raiz_site . $item['pagina'] .'" target="_blank">'. $item['titulo'] .'</a>';
				
			}
			
		}
		
	}
	
	if( $alvo == 'noticia' ){
		
		require $raiz_site .'model/noticias.php';
		
		foreach( $noticias_array as $item ){
			
			if( $item['id'] == $id ){
				
				return '<a href="'. $raiz_site . 'noticia&id='. $item['id'] .'" target="_blank">'. $item['titulo'] .'</a>';
				
			}
			
		}
		
	}
	
	if( $alvo == 'secretaria' ){
		
		require $raiz_site .'model/secretarias.php';
		
		foreach( $secretarias_array as $item ){
			
			if( $item['id'] == $id ){
				
				return '<a href="'. $raiz_site . 'secretarias&secretaria='. $item['pagina'] .'" target="_blank">'. $item['titulo'] .'</a>';
				
			}
			
		}
		
	}
	
}

?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo popup_paginas">
	
	<div class="titulo">Popup nas Páginas</div>
	
	<div class="linha-acao">
	
		<a href="modulos/popup_paginas/view/criar"><button class="autores-novo-btn">Criar Popup</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_popup_paginas">
		
			<thead>
				
				<tr>
				
					<th>Página</th>
					<th>Tipo</th>
					<th>Ativado</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $popup_paginas_array as $item ){
						
						echo'
						<tr>
							
							<td>'. getItem( $item['alvo_id'], $item['alvo'], $raiz_site, $conn ) .'</td>
							<td>'. $item['alvo'] .'</td>
							<td>
							'; 
							
								if( $item['ativado'] == 1 ){ 
									echo '
									<a href="modulos/popup_paginas/controller/ativar?id='. $item['id'] .'&btn_status=1">
										<div class="destaque-btn destaque-btn-on">
											<span>Sim</span>
										</div>
									</a>
									';
								}
								else{ 
									echo'
									<a href="modulos/popup_paginas/controller/ativar?id='. $item['id'] .'&btn_status=0">
										<div class="destaque-btn">
											<span>Não</span>
										</div>
									</a>
									'; 
								} 
								
							echo'
							</td>
							<td>
							
								<a href="modulos/popup_paginas/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/popup_paginas/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_popup_paginas_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_popup_paginas');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, 'select', 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_popup_paginas_paginacao"
	});
	
</script>
<!-- End - admin/modulos/popup_paginas/wiew/home.php !-->