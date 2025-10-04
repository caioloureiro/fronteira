<!-- Start - admin/modulos/licitacoes_vencedores/wiew/home.php !-->
<?php 
require $raiz_site .'model/licitacoes.php'; 
require $raiz_site .'model/licitacoes_vencedores.php'; 
$licitacoes_vencedores_array = array_reverse( $licitacoes_vencedores_array );
?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo licitacoes_vencedores">
	
	<div class="titulo">Licitações Vencedores</div>
	
	<div class="linha-acao">
	
		<a href="modulos/licitacoes_vencedores/view/criar"><button class="autores-novo-btn">Criar vencedor</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_licitacoes_vencedores">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Licitação</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $licitacoes_vencedores_array as $item ){
						
						$licitacao = '';
						
						foreach( $licitacoes_array as $lic ){
							
							if( $item['licitacao'] == $lic['id'] ){
								
								$licitacao = $lic['numero'] .' - '. $lic['nome'];
								
							}
							
						}
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>'. $licitacao .'</td>
							<td>
							
								<a href="modulos/licitacoes_vencedores/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/licitacoes_vencedores/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_licitacoes_vencedores_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_licitacoes_vencedores');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_licitacoes_vencedores_paginacao"
	});
	
</script>
<!-- End - admin/modulos/licitacoes_vencedores/wiew/home.php !-->