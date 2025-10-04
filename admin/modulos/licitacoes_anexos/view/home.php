<!-- Start - admin/modulos/licitacoes_anexos/wiew/home.php !-->
<?php 

require $raiz_site .'model/licitacoes.php'; 
require $raiz_site .'model/licitacoes_anexos.php'; 
$licitacoes_anexos_array = array_reverse( $licitacoes_anexos_array );

?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo licitacoes_anexos">
	
	<div class="titulo">Licitações Anexos</div>
	
	<div class="linha-acao">
	
		<a href="modulos/licitacoes_anexos/view/criar"><button class="autores-novo-btn">Criar anexo</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_licitacoes_anexos">
		
			<thead>
				
				<tr>
				
					<th>Licitação</th>
					<th>Arquivo</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $licitacoes_anexos_array as $item ){
						
						$licitacao = '';
						$licitacao_id = 0;
						
						foreach( $licitacoes_array as $lic ){
							
							if( $item['licitacao'] == $lic['id'] ){
								
								$licitacao = $lic['categoria'] .' - '. $lic['numero'];
								$licitacao_id = $lic['id'];
								
							}
							
						}
						
						echo'
						<tr>
							
							<td><a href="'. $raiz_site .'licitacao&id='. $licitacao_id .'" target="_blank">'. $licitacao .'</a></td>
							<td><a href="'. $raiz_site . $item['arquivo'] .'" target="_blank">'. $item['arquivo'] .'</a></td>
							<td>
							
								<a href="modulos/licitacoes_anexos/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/licitacoes_anexos/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_licitacoes_anexos_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_licitacoes_anexos');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_licitacoes_anexos_paginacao"
	});
	
</script>
<!-- End - admin/modulos/licitacoes_anexos/wiew/home.php !-->