<!-- Start - admin/modulos/chamamento_publico/wiew/home.php !-->
<?php require $raiz_site .'model/chamamento_publico.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo chamamento_publico">
	
	<div class="titulo">Chamamento Público</div>
	
	<div class="linha-acao">
	
		<a href="modulos/chamamento_publico/view/novo-01"><button class="autores-novo-btn">Criar chamamento público</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_chamamento_publico">
		
			<thead>
				
				<tr>
				
					<th>Título</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					$chamamento_publico_array = array_reverse( $chamamento_publico_array );
					
					foreach( $chamamento_publico_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['titulo'] .'</td>
							<td>
							
								<a href="modulos/chamamento_publico/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/chamamento_publico/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_chamamento_publico_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_chamamento_publico');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_chamamento_publico_paginacao"
	});
	
</script>
<!-- End - admin/modulos/chamamento_publico/wiew/home.php !-->