<!-- Start - admin/modulos/licitacoes/wiew/home.php !-->
<?php 
require $raiz_site .'model/licitacoes.php'; 
$licitacoes_array = array_reverse( $licitacoes_array );
?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo licitacoes">
	
	<div class="titulo">Licitações</div>
	
	<div class="linha-acao">
	
		<a href="modulos/licitacoes/view/criar"><button class="autores-novo-btn">Criar licitacao</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_licitacoes">
		
			<thead>
				
				<tr>
				
					<th>Tipo</th>
					<th>Número</th>
					<th>Objeto</th>
					<th>Publicação</th>
					<th>Situação</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $licitacoes_array as $item ){
						
						echo'
						<tr>
							
							<td><a href="../licitacao&id='. $item['id'] .'" target="_blank">'. $item['categoria'] .'</a></td>
							<td><a href="../licitacao&id='. $item['id'] .'" target="_blank">'. $item['numero'] .'</a></td>
							<td><a href="../licitacao&id='. $item['id'] .'" target="_blank">'. $item['objeto'] .'</a></td>
							<td><a href="../licitacao&id='. $item['id'] .'" target="_blank">'. $item['publicacao'] .'</a></td>
							<td><a href="../licitacao&id='. $item['id'] .'" target="_blank">'. $item['situacao'] .'</a></td>
							<td>
							
								<a href="modulos/licitacoes/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/licitacoes/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_licitacoes_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_licitacoes');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: ['select', true, true, true, 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_licitacoes_paginacao"
	});
	
</script>
<!-- End - admin/modulos/licitacoes/wiew/home.php !-->