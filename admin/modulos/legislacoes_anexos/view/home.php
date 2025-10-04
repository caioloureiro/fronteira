<!-- Start - admin/modulos/legislacoes_anexos/wiew/home.php !-->
<?php 

require $raiz_site .'model/legislacoes.php'; 
require $raiz_site .'model/legislacoes_anexos.php'; 
$legislacoes_anexos_array = array_reverse( $legislacoes_anexos_array );

?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo legislacoes_anexos">
	
	<div class="titulo">Legislações Anexos</div>
	
	<div class="linha-acao">
	
		<a href="modulos/legislacoes_anexos/view/criar"><button class="autores-novo-btn">Criar anexo</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_legislacoes_anexos">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Arquivo</th>
					<th>Legislação</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $legislacoes_anexos_array as $item ){
						
						$legislacao = '';
						$legislacao_id = 0;
						
						foreach( $legislacoes_array as $con ){
							
							if( $item['legislacao'] == $con['id'] ){
								
								$legislacao = $con['texto'];
								$legislacao_id = $con['id'];
								
							}
							
						}
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td><a href="'. $raiz_site . $item['arquivo'] .'" target="_blank">'. $item['arquivo'] .'</a></td>
							<td><a href="'. $raiz_site .'legislacao&id='. $legislacao_id .'" target="_blank">'. $legislacao .'</a></td>
							<td>
							
								<a href="modulos/legislacoes_anexos/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/legislacoes_anexos/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_legislacoes_anexos_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_legislacoes_anexos');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_legislacoes_anexos_paginacao"
	});
	
</script>
<!-- End - admin/modulos/legislacoes_anexos/wiew/home.php !-->