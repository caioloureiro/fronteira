<!-- Start - admin/modulos/conselhos_municipais/wiew/home.php !-->
<?php require $raiz_site .'model/conselhos_municipais.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo conselhos_municipais">
	
	<div class="titulo">Conselhos Municipais</div>
	
	<div class="linha-acao">
	
		<a href="modulos/conselhos_municipais/view/criar"><button class="autores-novo-btn">Criar conselho</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_conselhos_municipais">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $conselhos_municipais_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>
							
								<a href="modulos/conselhos_municipais/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/conselhos_municipais/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_conselhos_municipais_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_conselhos_municipais');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_conselhos_municipais_paginacao"
	});
	
</script>
<!-- End - admin/modulos/conselhos_municipais/wiew/home.php !-->