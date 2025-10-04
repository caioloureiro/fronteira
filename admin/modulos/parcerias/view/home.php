<!-- Start - admin/modulos/parcerias/wiew/home.php !-->
<?php 
require $raiz_site .'model/parcerias.php'; 
$parcerias_array = array_reverse( $parcerias_array );
?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo parcerias">
	
	<div class="titulo">Parcerias</div>
	
	<div class="linha-acao">
	
		<a href="modulos/parcerias/view/criar"><button class="autores-novo-btn">Criar parceria</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_parcerias">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Número</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $parcerias_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>'. $item['numero'] .'</td>
							<td>
							
								<a href="modulos/parcerias/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/parcerias/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_parcerias_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_parcerias');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_parcerias_paginacao"
	});
	
</script>
<!-- End - admin/modulos/parcerias/wiew/home.php !-->