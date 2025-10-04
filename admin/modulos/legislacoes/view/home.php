<!-- Start - admin/modulos/legislacoes/wiew/home.php !-->
<?php 
require $raiz_site .'model/legislacoes.php'; 
$legislacoes_array = array_reverse( $legislacoes_array );
?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo legislacoes">
	
	<div class="titulo">Legislações</div>
	
	<div class="linha-acao">
	
		<a href="modulos/legislacoes/view/criar"><button class="autores-novo-btn">Criar legislacao</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_legislacoes">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Categoria</th>
					<th>Objeto</th>
					<th>Publicação</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $legislacoes_array as $item ){
						
						echo'
						<tr>
							
							<td><a href="'. $raiz_site .'legislacao&id='. $item['id'] .'" target="_blank">'. $item['nome'] .'</a></td>
							<td><a href="'. $raiz_site .'legislacao&id='. $item['id'] .'" target="_blank">'. $item['categoria'] .'</a></td>
							<td><a href="'. $raiz_site .'legislacao&id='. $item['id'] .'" target="_blank">'. $item['texto'] .'</a></td>
							<td><a href="'. $raiz_site .'legislacao&id='. $item['id'] .'" target="_blank">'. data_tempo( $item['data'] ) .'</a></td>
							<td>
							
								<a href="modulos/legislacoes/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/legislacoes/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_legislacoes_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_legislacoes');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, 'select', true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_legislacoes_paginacao"
	});
	
</script>
<!-- End - admin/modulos/legislacoes/wiew/home.php !-->