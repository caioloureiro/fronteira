<!-- Start - admin/modulos/convenios/wiew/home.php !-->
<?php 
require $raiz_site .'model/convenios.php'; 
$convenios_array = array_reverse( $convenios_array );
?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo convenios">
	
	<div class="titulo">Convênios</div>
	
	<div class="linha-acao">
	
		<a href="modulos/convenios/view/criar"><button class="autores-novo-btn">Criar convenio</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_convenios">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Número</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $convenios_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>'. $item['numero'] .'</td>
							<td>
							
								<a href="modulos/convenios/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/convenios/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_convenios_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_convenios');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_convenios_paginacao"
	});
	
</script>
<!-- End - admin/modulos/convenios/wiew/home.php !-->