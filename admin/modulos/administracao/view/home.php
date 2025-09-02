<!-- Start - admin/modulos/administracao/wiew/home.php !-->
<?php require $raiz_site .'model/administracao.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo administracao">
	
	<div class="titulo">Administração</div>
	
	<div class="linha-acao">
	
		<a href="modulos/administracao/view/novo-01"><button class="autores-novo-btn">Criar Página de Administrador</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_administracao">
		
			<thead>
				
				<tr>
				
					<th>Titulo</th>
					<th>Representante</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $administracao_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['titulo'].'</td>
							<td>'. $item['secretario'].'</td>
							<td>
							
								<a href="modulos/administracao/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/administracao/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_administracao_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_administracao');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_administracao_paginacao"
	});
	
</script>
<!-- End - admin/modulos/administracao/wiew/home.php !-->