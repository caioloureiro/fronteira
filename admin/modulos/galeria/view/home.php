<!-- Start - admin/modulos/galeria/wiew/home.php !-->
<?php require $raiz_site .'model/galeria.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo galeria">
	
	<div class="titulo">Galerias</div>
	
	<div class="linha-acao">
	
		<a href="modulos/galeria/view/criar"><button class="autores-novo-btn">Criar galeria</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_galeria">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th>Destaque</th>
					<th>Categorias</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					$galeria_array = array_reverse( $galeria_array );
					
					foreach( $galeria_array as $item ){
						
						if( $item['destaque'] == 1 ){
							
							echo'
							<tr>
								
								<td>'. $item['nome'] .'</td>
								<td>
									<form method="GET" action="modulos/galeria/controller/destaque" class="btn_switch_form_13">
										<input type="hidden" name="id" value="'. $item['id'] .'">
										<input type="hidden" name="btn_status" value="'.$item['destaque'].'">
										'; 
										
										if( $item['destaque'] == 0 ){ echo'<button class="destaque-btn">Não</button>'; } 
										if( $item['destaque'] == 1 ){ echo'<button class="destaque-btn destaque-btn-on">Destaque</button>'; } 
										
										echo'
									</form>
								</td>
								<td>'. $item['categorias'] .'</td>
								<td>
								
									<a href="modulos/galeria/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
									<a href="modulos/galeria/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
									
								</td>
								
							</tr>
							';
							
						}
						
					}
					
					foreach( $galeria_array as $item ){
						
						if( $item['destaque'] == 0 ){
							
							echo'
							<tr>
								
								<td>'. $item['nome'] .'</td>
								<td>
									<form method="GET" action="modulos/galeria/controller/destaque" class="btn_switch_form_13">
										<input type="hidden" name="id" value="'. $item['id'] .'">
										<input type="hidden" name="btn_status" value="'.$item['destaque'].'">
										'; 
										
										if( $item['destaque'] == 0 ){ echo'<button class="destaque-btn">Não</button>'; } 
										if( $item['destaque'] == 1 ){ echo'<button class="destaque-btn destaque-btn-on">Destaque</button>'; } 
										
										echo'
									</form>
								</td>
								<td>'. $item['categorias'] .'</td>
								<td>
								
									<a href="modulos/galeria/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
									<a href="modulos/galeria/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
									
								</td>
								
							</tr>
							';
							
						}
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_galeria_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_galeria');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true, 'select', true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_galeria_paginacao"
	});
	
</script>
<!-- End - admin/modulos/galeria/wiew/home.php !-->