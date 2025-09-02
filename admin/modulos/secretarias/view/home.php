<!-- Start - admin/modulos/secretarias/wiew/home.php !-->
<?php require $raiz_site .'model/secretarias.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo secretarias">
	
	<div class="titulo">Secretarias</div>
	
	<div class="linha-acao">
	
		<a href="modulos/secretarias/view/novo-01"><button class="autores-novo-btn">Criar Página de Secretaria</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_secretarias">
		
			<thead>
				
				<tr>
				
					<th>Titulo</th>
					<th>Representante</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $secretarias_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['titulo'].'</td>
							<td>'. $item['secretario'].'</td>
							<td>
							
								<a href="modulos/secretarias/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/secretarias/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_secretarias_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_secretarias');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_secretarias_paginacao"
	});
	
</script>
<!-- End - admin/modulos/secretarias/wiew/home.php !-->