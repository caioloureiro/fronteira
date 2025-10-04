<!-- Start - admin/modulos/perguntas_frequentes/wiew/home.php !-->
<?php 
require $raiz_site .'model/perguntas_frequentes.php'; 

$perguntas_frequentes_array = array_reverse( $perguntas_frequentes_array );
?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo perguntas_frequentes">
	
	<div class="titulo">Perguntas Frequentes</div>
	
	<div class="linha-acao">
	
		<a href="modulos/perguntas_frequentes/view/criar"><button class="autores-novo-btn">Criar pergunta</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_perguntas_frequentes">
		
			<thead>
				
				<tr>
				
					<th>Pergunta</th>
					<th>Categoria</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $perguntas_frequentes_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['pergunta'] .'</td>
							<td>'. $item['categoria'] .'</td>
							<td>
							
								<a href="modulos/perguntas_frequentes/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/perguntas_frequentes/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_perguntas_frequentes_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_perguntas_frequentes');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_perguntas_frequentes_paginacao"
	});
	
</script>
<!-- End - admin/modulos/perguntas_frequentes/wiew/home.php !-->