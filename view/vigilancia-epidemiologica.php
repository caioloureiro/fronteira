<!-- Start - view/vigilancia-epidemiologica.php !-->
<link 
	rel="stylesheet" 
	href="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/css/datatable.css" 
	integrity="sha512-zHpjdnFxcMInClTw4ZqdX6NNLuPU+iJMZEQsyIjXuQX8TZXzRhZIlUi0tQTGQxt/UGruFgs0qTBshuGN0ts/vQ==" 
	crossorigin="anonymous" 
/>
<script 
	src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" 
	integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" 
	crossorigin="anonymous"
></script>

<style><?php require 'css/vigilancia-epidemiologica.css'; ?></style>

<section class="vigilancia-epidemiologica">
	
	<div class="box">
	
		<div class="vigilancia-epidemiologica-tabela-janela">
			
			<table class="tabela_vigilancia-epidemiologica">
		
				<thead>
					
					<tr>
					
						<th>Páginas</th>
						
					</tr>
					
				</thead>
				
				<tbody>
				
					<tr><td><a href="coronavirus">COVID-19</a></td></tr>
					<tr><td><a href="dengue">Dengue</a></td></tr>
					<tr><td><a href="vacinometro">Vacinômetro</a></td></tr>
					
				</tbody>
				
			</table>
			
			<div id="tabela_vigilancia-epidemiologica_paginacao" class="pagination"></div>
			
		</div>
		
	</div>
	
</section>

<script>

	let tabela_datatable = document.querySelector('.tabela_vigilancia-epidemiologica');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 20, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_vigilancia-epidemiologica_paginacao"
	});
	
	document.querySelector('.sorting').click(); //DEIXA EM ORDEM ALFABÉTICA
	
</script>
<!-- End - view/vigilancia-epidemiologica.php !-->