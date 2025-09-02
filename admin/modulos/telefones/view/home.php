<!-- Start - admin/modulos/telefones/wiew/home.php !-->
<?php require $raiz_site .'model/telefones.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo telefones">
	
	<div class="titulo">Telefones</div>
	
	<div class="linha-acao">
	
		<a href="modulos/telefones/view/novo-01"><button class="autores-novo-btn">Criar telefone</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_telefones">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $telefones_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>
							
								<a href="modulos/telefones/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/telefones/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_telefones_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_telefones');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_telefones_paginacao"
	});
	
</script>
<!-- End - admin/modulos/telefones/wiew/home.php !-->