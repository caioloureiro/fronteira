<!-- Start - admin/modulos/audiencias_publicas/wiew/home.php !-->
<?php require $raiz_site .'model/audiencias_publicas.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo audiencias_publicas">
	
	<div class="titulo">Audiências Públicas</div>
	
	<div class="linha-acao">
	
		<a href="modulos/audiencias_publicas/view/criar"><button class="autores-novo-btn">Criar audiência</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_audiencias_publicas">
		
			<thead>
				
				<tr>
				
					<th>Título</th>
					<th>Data</th>
					<th>Local</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					$audiencias_publicas_array = array_reverse( $audiencias_publicas_array );
					
					foreach( $audiencias_publicas_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['titulo'] .'</td>
							<td>'. data_tempo( $item['data_audiencia'] ) .'</td>
							<td>'. $item['local'] .'</td>
							<td>
							
								<a href="modulos/audiencias_publicas/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/audiencias_publicas/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_audiencias_publicas_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_audiencias_publicas');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_audiencias_publicas_paginacao"
	});
	
</script>
<!-- End - admin/modulos/audiencias_publicas/wiew/home.php !-->