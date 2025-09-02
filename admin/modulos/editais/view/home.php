<!-- Start - admin/modulos/editais/wiew/home.php !-->
<?php 

require $raiz_site .'model/editais.php'; 
require $raiz_site .'model/modalidade_licitacoes.php'; 
require $raiz_site .'model/chamamento_publico.php'; 
require $raiz_site .'model/downloads.php'; 

?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo editais">
	
	<div class="titulo">Editais</div>
	
	<div class="linha-acao">
	
		<a href="modulos/editais/view/criar"><button class="autores-novo-btn">Criar edital</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_editais">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Destaque</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					$editais_array = array_reverse( $editais_array );
					
					foreach( $editais_array as $item ){
						
						if( $item['destaque'] == 1 ){
							
							echo'
							<tr>
								
								<td>'. $item['nome'] .'</td>
								<td>
									<form method="GET" action="modulos/editais/controller/destaque" class="btn_switch_form_13">
										<input type="hidden" name="id" value="'. $item['id'] .'">
										<input type="hidden" name="btn_status" value="'.$item['destaque'].'">
										'; 
										
										if( $item['destaque'] == 0 ){ echo'<button class="destaque-btn">Não</button>'; } 
										if( $item['destaque'] == 1 ){ echo'<button class="destaque-btn destaque-btn-on">Destaque</button>'; } 
										
										echo'
									</form>
								</td>
								<td>
								
									<a href="modulos/editais/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
									<a href="modulos/editais/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
									
								</td>
								
							</tr>
							';
							
						}
						
					}
					
					foreach( $editais_array as $item ){
						
						if( $item['destaque'] == 0 ){
							
							echo'
							<tr>
								
								<td>'. $item['nome'] .'</td>
								<td>
									<form method="GET" action="modulos/editais/controller/destaque" class="btn_switch_form_13">
										<input type="hidden" name="id" value="'. $item['id'] .'">
										<input type="hidden" name="btn_status" value="'.$item['destaque'].'">
										'; 
										
										if( $item['destaque'] == 0 ){ echo'<button class="destaque-btn">Não</button>'; } 
										if( $item['destaque'] == 1 ){ echo'<button class="destaque-btn destaque-btn-on">Destaque</button>'; } 
										
										echo'
									</form>
								</td>
								<td>
								
									<a href="modulos/editais/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
									<a href="modulos/editais/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
									
								</td>
								
							</tr>
							';
							
						}
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_editais_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_editais');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, 'select'], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_editais_paginacao"
	});
	
</script>
<!-- End - admin/modulos/editais/wiew/home.php !-->