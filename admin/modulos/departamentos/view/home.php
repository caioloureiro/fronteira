<!-- Start - admin/modulos/departamentos/wiew/home.php !-->
<?php require $raiz_site .'model/departamentos.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo departamentos">
	
	<div class="titulo">Departamentos</div>
	
	<div class="linha-acao">
	
		<a href="modulos/departamentos/view/criar"><button class="autores-novo-btn">Criar departamento</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_departamentos">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>E-mail</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $departamentos_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>'. $item['email'] .'</td>
							<td>
							
								<a href="modulos/departamentos/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/departamentos/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_departamentos_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_departamentos');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_departamentos_paginacao"
	});
	
</script>
<!-- End - admin/modulos/departamentos/wiew/home.php !-->