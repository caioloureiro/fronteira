<!-- Start - admin/modulos/vagas/wiew/home.php !-->
<?php require $raiz_site .'model/vagas.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo vagas">
	
	<div class="titulo">vaga</div>
	
	<div class="linha-acao">
	
		<a href="modulos/vagas/view/criar"><button class="autores-novo-btn">Criar vaga</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_vagas">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Quantidade</th>
					<th>Data</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $vagas_array as $item ){
						
						$data = '-';
						
						if( $item['data'] != '' ){ $data = data_tempo( $item['data'] ); }
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>'. $item['quantidade'] .'</td>
							<td>'. $data .'</td>
							<td>
							
								<a href="modulos/vagas/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/vagas/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_vagas_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_vagas');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, true, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_vagas_paginacao"
	});
	
</script>
<!-- End - admin/modulos/vagas/wiew/home.php !-->