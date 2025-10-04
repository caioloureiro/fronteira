<!-- Start - admin/modulos/contratos/wiew/home.php !-->
<?php 
require $raiz_site .'model/contratos.php'; 
$contratos_array = array_reverse( $contratos_array );
?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo contratos">
	
	<div class="titulo">Contrato</div>
	
	<div class="linha-acao">
	
		<a href="modulos/contratos/view/criar"><button class="autores-novo-btn">Criar contrato</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_contratos">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Contratado</th>
					<th>Data</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $contratos_array as $item ){
						
						echo'
						<tr>
							
							<td><a href="'. $raiz_site .'contrato&id='. $item['id'] .'" target="_blank">'. $item['nome'] .'</a></td>
							<td>'. $item['contratado'] .'</td>
							<td>'. data_tempo( $item['data'] ) .'</td>
							<td>
							
								<a href="modulos/contratos/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/contratos/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_contratos_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_contratos');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_contratos_paginacao"
	});
	
</script>
<!-- End - admin/modulos/contratos/wiew/home.php !-->