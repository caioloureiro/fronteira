<!-- Start - admin/modulos/enquetes/wiew/home.php !-->
<?php require $raiz_site .'model/enquete.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo enquetes">
	
	<div class="titulo">Gerador de Enquetes</div>
	
	<div class="linha-acao">
	
		<a href="modulos/enquetes/view/criar"><button class="autores-novo-btn">Criar enquete</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_enquetes">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Início</th>
					<th>Encerramento</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $enquete_array as $item ){
						
						echo'
						<tr>
							
							<td>
								<a href="'. $raiz_site .'enquete&id='. $item['id'] .'" target="_blank">
									'. $item['nome'] .' '; if( $item['rascunho'] == 1 ){ echo '<span class="fonte-vermelha">- RASCUNHO</span>'; }else{ echo ''; } echo'
								</a>
							</td>
							<td>'. data_tempo( $item['inicio'] ) .'</td>
							<td>'. data_tempo( $item['final'] ) .'</td>
							<td>
							
								<a href="modulos/enquetes/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/enquetes/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_enquetes_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_enquetes');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_enquetes_paginacao"
	});
	
</script>
<!-- End - admin/modulos/enquetes/wiew/home.php !-->