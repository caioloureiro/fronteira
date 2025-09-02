<!-- Start - admin/modulos/organograma/wiew/home.php !-->
<?php require $raiz_site .'model/organograma.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo organograma">
	
	<div class="titulo">Organograma</div>
	
	<div class="linha-acao">
	
		<a href="modulos/organograma/view/criar"><button class="autores-novo-btn">Criar organograma</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_organograma">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Pai</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $organograma_array as $item ){
						
						$pai = '-';
						
						foreach( $organograma_array as $reitem ){
							
							if( $reitem['id'] == $item['pai'] ){
								
								$pai = $reitem['nome'];
								
							}
							
						}
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>'. $pai .'</td>
							<td>
							
								<a href="modulos/organograma/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/organograma/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_organograma_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_organograma');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_organograma_paginacao"
	});
	
</script>
<!-- End - admin/modulos/organograma/wiew/home.php !-->