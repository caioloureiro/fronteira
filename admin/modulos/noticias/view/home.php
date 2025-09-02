<!-- Start - admin/modulos/noticias/wiew/home.php !-->
<?php 

require '../model/noticias.php'; 

$alertaDestaqueZerado = 0;

foreach( $noticias_array as $notAlert ){
	
	if( 
		$notAlert['destaque'] == 1 
		&& $notAlert['destaque_ordem'] == 0 
	){
		
		$alertaDestaqueZerado = 1;
		
	}
	
}

//echo'<script> console.log("$alertaDestaqueZerado: '. $alertaDestaqueZerado .'"); </script>';

$hoje = date( 'Y-m-d H:i:s' );

?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo noticias">
	
	<div class="titulo">Notícias</div>
	
	<div class="linha-acao">
	
		<a href="modulos/noticias/view/novo-01"><button class="autores-novo-btn">Criar noticia</button></a>
		
		<a href="modulos/noticias/view/ordenar"><button class="noticia-nova-btn">Ordenar Destaques</button></a>
		
	</div>
	
	<?php
		
		if( $alertaDestaqueZerado == 1 ){
			
			echo'
			<div class="separador"></div>
			
			<div class="comentario">Os destaques precisam ser ordenados.</div>
			';
			
		}
		
	?>

	<table class="tabela_noticias">
	
		<thead>
			
			<tr>
			
				<th>Titulo</th>
				<th style="width:10vw">Destaque</th>
				<th style="width:10vw">Categorias</th>
				<th style="width:10vw">Ordem</th>
				<th style="width:10vw">Ação</th>
				
			</tr>
			
		</thead>
		
		<tbody>
		
			<?php
				
				usort( $noticias_array, function( $a, $b ){//Função responsável por ordenar

					$al = mb_strtolower($a['destaque_ordem']);
					$bl = mb_strtolower($b['destaque_ordem']);
					
					if ($al == $bl){
						return 0;
					}
					
					return ($bl < $al) ? +1 : -1;
					
				} );

				//dd( $noticias_array );
				
				foreach( $noticias_array as $item ){
					
					if( $item['destaque'] == 1 ){
					
						echo'
						<tr>
							
							<td>
								'. $item['titulo'].' '; 
								if( $item['publicado'] == 0 ){ echo '<span class="fonte-vermelha">- RASCUNHO</span>'; } 
								if( $hoje < $item['data_publicacao'] ){ echo '<span class="fonte-vermelha">- NOTÍCIA PROGRAMADA PARA '. data_tempo( $item['data_publicacao'] ) .'</span>'; }
								echo'
							</td>
							<td>
								<form method="GET" action="modulos/noticias/controller/destaque">
									<input type="hidden" name="id" value="'. $item['id'] .'">
									<input type="hidden" name="btn_status" value="'.$item['destaque'].'">
									<button 
										class="destaque-btn '; if( $item['destaque'] == 1 ){ echo'destaque-btn-on'; } echo'"
									>'; if( $item['destaque'] == 1 ){ echo'Sim'; }else{ echo'Não'; } echo'</button>
								</form>
							</td>
							<td><a href="matriz?pagina=noticias_categorias">'.$item['categorias'].'</a></td>
							<td>'.$item['destaque_ordem'].'</td>
							<td>
							
								<a href="modulos/noticias/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/noticias/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
					
					}
					
				}
				
				usort( $noticias_array, function( $a, $b ){//Função responsável por ordenar

					$al = mb_strtolower($a['id']);
					$bl = mb_strtolower($b['id']);
					
					if ($al == $bl){
						return 0;
					}
					
					return ($bl > $al) ? +1 : -1;
					
				} );

				//dd( $noticias_array );
				
				foreach( $noticias_array as $item ){
					
					if( $item['destaque'] == 0 ){
					
						echo'
						<tr>
							
							<td>
								'. $item['titulo'].' '; 
								if( $item['publicado'] == 0 ){ echo '<span class="fonte-vermelha">- RASCUNHO</span>'; }
								if( $hoje < $item['data_publicacao'] ){ echo '<span class="fonte-vermelha">- NOTÍCIA PROGRAMADA PARA '. data_tempo( $item['data_publicacao'] ) .'</span>'; }
								echo'
							</td>
							<td>
								<form method="GET" action="modulos/noticias/controller/destaque">
									<input type="hidden" name="id" value="'. $item['id'] .'">
									<input type="hidden" name="btn_status" value="'.$item['destaque'].'">
									<button 
										class="destaque-btn '; if( $item['destaque'] == 1 ){ echo'destaque-btn-on'; } echo'"
									>'; if( $item['destaque'] == 1 ){ echo'Sim'; }else{ echo'Não'; } echo'</button>
								</form>
							</td>
							<td><a href="matriz?pagina=noticias_categorias">'.$item['categorias'].'</a></td>
							<td>-</td>
							<td>
							
								<a href="modulos/noticias/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/noticias/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
					
					}
					
				}
			
			?>
			
		</tbody>
	
	</table>
	
	<div id="tabela_noticias_paginacao" class="pagination"></div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_noticias');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, 'select', true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_noticias_paginacao"
	});
	
</script>
<!-- End - admin/modulos/noticias/wiew/home.php !-->