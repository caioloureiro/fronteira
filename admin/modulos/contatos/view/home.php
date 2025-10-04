<!-- Start - admin/modulos/contatos/wiew/home.php !-->
<?php require $raiz_site .'model/contatos.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo contatos">
	
	<div class="titulo">Contato</div>
	
	<div class="linha-acao">
	
		<a href="modulos/contatos/view/criar"><button class="autores-novo-btn">Criar contato</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_contatos">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>E-mail</th>
					<th>Telefone</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $contatos_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>'. $item['email'] .'</td>
							<td>'. $item['telefone'] .'</td>
							<td>
							
								<a href="modulos/contatos/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/contatos/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_contatos_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_contatos');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_contatos_paginacao"
	});
	
</script>
<!-- End - admin/modulos/contatos/wiew/home.php !-->