<!-- Start - admin/modulos/parcerias_anexos/wiew/home.php !-->
<?php 

require $raiz_site .'model/parcerias.php'; 
require $raiz_site .'model/parcerias_anexos.php'; 

?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo parcerias_anexos">
	
	<div class="titulo">Parcerias Anexos</div>
	
	<div class="linha-acao">
	
		<a href="modulos/parcerias_anexos/view/criar"><button class="autores-novo-btn">Criar anexo</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_parcerias_anexos">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Arquivo</th>
					<th>Parceria número</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $parcerias_anexos_array as $item ){
						
						$parceria = '';
						$parceria_id = 0;
						
						foreach( $parcerias_array as $con ){
							
							if( $item['parceria'] == $con['id'] ){
								
								$parceria = $con['numero'];
								$parceria_id = $con['id'];
								
							}
							
						}
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td><a href="'. $raiz_site . $item['arquivo'] .'" target="_blank">'. $item['arquivo'] .'</a></td>
							<td><a href="'. $raiz_site .'parceria&id='. $parceria_id .'" target="_blank">'. $parceria .'</a></td>
							<td>
							
								<a href="modulos/parcerias_anexos/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/parcerias_anexos/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_parcerias_anexos_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_parcerias_anexos');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_parcerias_anexos_paginacao"
	});
	
</script>
<!-- End - admin/modulos/parcerias_anexos/wiew/home.php !-->