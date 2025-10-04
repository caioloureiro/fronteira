<!-- Start - admin/modulos/esic/wiew/home.php !-->
<?php 
require $raiz_site .'model/esic.php'; 
$esic_array = array_reverse( $esic_array );
?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo esic">
	
	<div class="titulo">eSIC</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_esic">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Protocolo</th>
					<th>Status</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $esic_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>'. $item['codigo'] .'</td>
							<td>'. $item['status'] .'</td>
							<td>
							
								<a href="modulos/esic/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/esic/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_esic_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_esic');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true, 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_esic_paginacao"
	});
	
</script>
<!-- End - admin/modulos/esic/wiew/home.php !-->