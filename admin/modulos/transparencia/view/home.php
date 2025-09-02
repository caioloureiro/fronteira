<!-- Start - admin/modulos/transparencia/wiew/home.php !-->
<?php 
require $raiz_site .'model/transparencia.php'; 
require $raiz_site .'model/transparencia_grupos.php'; 
?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo transparencia">
	
	<div class="titulo">Transparência</div>
	
	<div class="linha-acao">
	
		<a href="modulos/transparencia/view/criar"><button class="autores-novo-btn">Criar transparência</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_transparencia">
		
			<thead>
				
				<tr>
				
					<th>Titulo</th>
					<th>Grupo</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					$grupo_nome = '';
					
					foreach( $transparencia_array as $item ){
						
						foreach( $transparencia_grupos_array as $grupo ){
							
							if( $grupo['id'] == $item['grupo_id'] ){
								
								$grupo_nome = $grupo['nome'];
								
							}
							
						}
						
						echo'
						<tr>
							
							<td>'. $item['titulo'] .'</td>
							<td>'. $grupo_nome .'</td>
							<td>
							
								<a href="modulos/transparencia/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/transparencia/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_transparencia_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_transparencia');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_transparencia_paginacao"
	});
	
</script>
<!-- End - admin/modulos/transparencia/wiew/home.php !-->