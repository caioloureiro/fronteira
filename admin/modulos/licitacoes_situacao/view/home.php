<!-- Start - admin/modulos/licitacoes_situacao/wiew/home.php !-->
<?php 
require $raiz_site .'model/licitacoes_situacao.php'; 
$licitacoes_situacao_array = array_reverse( $licitacoes_situacao_array );
?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo licitacoes_situacao">
	
	<div class="titulo">Licitações Situação</div>
	
	<div class="linha-acao">
	
		<a href="modulos/licitacoes_situacao/view/criar"><button class="autores-novo-btn">Criar situação</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_licitacoes_situacao">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $licitacoes_situacao_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>
							
								<a href="modulos/licitacoes_situacao/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/licitacoes_situacao/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_licitacoes_situacao_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_licitacoes_situacao');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_licitacoes_situacao_paginacao"
	});
	
</script>
<!-- End - admin/modulos/licitacoes_situacao/wiew/home.php !-->