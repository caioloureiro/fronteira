<!-- Start - admin/modulos/exemplos/wiew/home.php !-->
<?php require $raiz_site .'model/exemplos.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo exemplos">
	
	<div class="titulo">Exemplo</div>
	
	<div class="linha-acao">
	
		<a href="modulos/exemplos/view/criar"><button class="autores-novo-btn">Criar exemplo</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_exemplos">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $exemplos_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>
							
								<a href="modulos/exemplos/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/exemplos/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_exemplos_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_exemplos');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_exemplos_paginacao"
	});
	
</script>
<!-- End - admin/modulos/exemplos/wiew/home.php !-->