<!-- Start - admin/modulos/formularios/wiew/home.php !-->
<?php require $raiz_site .'model/formularios.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo formularios">
	
	<div class="titulo">Gerador de Formulários</div>
	
	<div class="linha-acao">
	
		<a href="modulos/formularios/view/criar"><button class="autores-novo-btn">Criar formulário</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_formularios">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Página</th>
					<th>Prefixo Protocolo</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $formularios_array as $item ){
						
						$prefixo_protocolo = '-';
						
						if( $item['prefixo_protocolo'] != '' ){ $prefixo_protocolo = $item['prefixo_protocolo']; }
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .' '; if( $item['rascunho'] == 1 ){ echo '<span class="fonte-vermelha">- RASCUNHO</span>'; }else{ echo ''; } echo'</td>
							<td>'. $item['pagina'] .'</td>
							<td>'. $prefixo_protocolo .'</td>
							<td>
							
								<a href="modulos/formularios/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/formularios/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_formularios_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_formularios');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, 'select', true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_formularios_paginacao"
	});
	
</script>
<!-- End - admin/modulos/formularios/wiew/home.php !-->