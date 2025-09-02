<!-- Start - admin/modulos/prefeitos/wiew/home.php !-->
<?php require $raiz_site .'model/prefeitos.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo prefeitos">
	
	<div class="titulo">Galeria de Prefeitos</div>
	
	<div class="linha-acao">
	
		<a href="modulos/prefeitos/view/novo-01"><button class="autores-novo-btn">Criar mandato</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_prefeitos">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Mandato</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					usort( $prefeitos_array, function( $a, $b ){//Função responsável por ordenar

						$al = mb_strtolower($a['data_ini']);
						$bl = mb_strtolower($b['data_ini']);
						
						if ($al == $bl){
							return 0;
						}
						
						return ($bl > $al) ? +1 : -1;
						
					} );

					//dd( $prefeitos_array );
					
					foreach( $prefeitos_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'].'</td>
							<td>'. data( $item['data_ini'] ) .' até '. data( $item['data_fim'] ).'</td>
							<td>
							
								<a href="modulos/prefeitos/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/prefeitos/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_prefeitos_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_prefeitos');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_prefeitos_paginacao"
	});
	
</script>
<!-- End - admin/modulos/prefeitos/wiew/home.php !-->