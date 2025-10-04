<!-- Start - admin/modulos/convenios_anexos/wiew/home.php !-->
<?php 

require $raiz_site .'model/convenios.php'; 
require $raiz_site .'model/convenios_anexos.php'; 

?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo convenios_anexos">
	
	<div class="titulo">Convênios Anexos</div>
	
	<div class="linha-acao">
	
		<a href="modulos/convenios_anexos/view/criar"><button class="autores-novo-btn">Criar anexo</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_convenios_anexos">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Arquivo</th>
					<th>Convênio número</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $convenios_anexos_array as $item ){
						
						$convenio = '';
						$convenio_id = 0;
						
						foreach( $convenios_array as $con ){
							
							if( $item['convenio'] == $con['id'] ){
								
								$convenio = $con['numero'];
								$convenio_id = $con['id'];
								
							}
							
						}
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td><a href="'. $raiz_site . $item['arquivo'] .'" target="_blank">'. $item['arquivo'] .'</a></td>
							<td><a href="'. $raiz_site .'convenio&id='. $convenio_id .'" target="_blank">'. $convenio .'</a></td>
							<td>
							
								<a href="modulos/convenios_anexos/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/convenios_anexos/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_convenios_anexos_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_convenios_anexos');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true, 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_convenios_anexos_paginacao"
	});
	
</script>
<!-- End - admin/modulos/convenios_anexos/wiew/home.php !-->