<!-- Start - admin/modulos/concursos_anexos/wiew/home.php !-->
<?php 

require $raiz_site .'model/concursos.php'; 
require $raiz_site .'model/concursos_anexos.php'; 

?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo concursos_anexos">
	
	<div class="titulo">Concursos Anexos</div>
	
	<div class="linha-acao">
	
		<a href="modulos/concursos_anexos/view/criar"><button class="autores-novo-btn">Criar anexo</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_concursos_anexos">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Arquivo</th>
					<th>Concurso número</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $concursos_anexos_array as $item ){
						
						$concurso = '';
						$concurso_id = 0;
						
						foreach( $concursos_array as $con ){
							
							if( $item['concurso'] == $con['id'] ){
								
								$concurso = $con['numero'];
								$concurso_id = $con['id'];
								
							}
							
						}
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td><a href="'. $raiz_site . $item['arquivo'] .'" target="_blank">'. $item['arquivo'] .'</a></td>
							<td><a href="'. $raiz_site .'concurso&id='. $concurso_id .'" target="_blank">'. $concurso .'</a></td>
							<td>
							
								<a href="modulos/concursos_anexos/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/concursos_anexos/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_concursos_anexos_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_concursos_anexos');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true, 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_concursos_anexos_paginacao"
	});
	
</script>
<!-- End - admin/modulos/concursos_anexos/wiew/home.php !-->