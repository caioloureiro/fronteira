<!-- Start - admin/modulos/chamadas_publicas/wiew/home.php !-->
<?php require $raiz_site .'model/chamadas_publicas.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo chamadas_publicas">
	
	<div class="titulo">Chamadas Públicas</div>
	
	<div class="linha-acao">
	
		<a href="modulos/chamadas_publicas/view/novo-01"><button class="autores-novo-btn">Criar chamada pública</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_chamadas_publicas">
		
			<thead>
				
				<tr>
				
					<th>Título</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					$chamadas_publicas_array_total = array_reverse( $chamadas_publicas_array_total );
					
					foreach( $chamadas_publicas_array_total as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['titulo'] .'</td>
							<td>
							
								<a href="modulos/chamadas_publicas/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/chamadas_publicas/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_chamadas_publicas_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_chamadas_publicas');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_chamadas_publicas_paginacao"
	});
	
</script>
<!-- End - admin/modulos/chamadas_publicas/wiew/home.php !-->