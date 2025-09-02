<!-- Start - admin/modulos/redes_sociais/wiew/home.php !-->
<?php require $raiz_site .'model/redes_sociais.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo redes_sociais">
	
	<div class="titulo">Redes Sociais</div>
	
	<div class="linha-acao">
	
		<a href="modulos/redes_sociais/view/novo-01"><button class="autores-novo-btn">Criar Rede Social</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_redes_sociais">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $redes_sociais_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>
							
								<a href="modulos/redes_sociais/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/redes_sociais/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_redes_sociais_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_redes_sociais');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_redes_sociais_paginacao"
	});
	
</script>
<!-- End - admin/modulos/redes_sociais/wiew/home.php !-->