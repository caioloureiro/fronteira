<!-- Start - admin/modulos/carrossel/wiew/home.php !-->
<?php 

require $raiz_site .'model/carrossel.php'; 

usort($carrossel_array, function( $a, $b ){//Função responsável por ordenar

	$al = mb_strtolower($a['ordem']);
	$bl = mb_strtolower($b['ordem']);
	
	if ($al == $bl){
		return 0;
	}
	
	return ($bl < $al) ? +1 : -1;
	
});

?>

<style>
	<?php require 'css/destaque-btn.css'; ?>
	.escolher-imagem-thumb-tabela{
		background-size:cover;
	}
</style>

<div class="conteudo carrossel">
	
	<div class="titulo">Carrossel</div>
	
	<div class="linha-acao">
	
		<div class="col10">
			<a href="modulos/carrossel/view/novo-02">
				<button class="autores-novo-btn">Criar item</button>
			</a>
		</div>
		
		<div class="col15">
			<a href="modulos/carrossel/view/ordenar-desktop">
				<button class="btn">Ordenar Computador</button>
			</a>
		</div>
		
		<div class="col15">
			<a href="modulos/carrossel/view/ordenar-mobile">
				<button class="btn">Ordenar Celular</button>
			</a>
		</div>
		
	</div>
	
	<div class="separador"></div>
	
	<div class="aviso-verde">Computador (desktop) - 1920x480px - Aparece só no computador</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_carrossel">
			<thead>
				<tr>
					<th style="width:5vw">Thumb</th>
					<th>Imagem</th>
					<th>Ordem</th>
					<th style="width:10vw">Ação</th>
				</tr>
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $carrossel_array as $item ){
						
						if( $item['mobile'] == 0 ){
						
							echo'
							<tr>
								<td><div class="escolher-imagem-thumb-tabela" style="background-image:url( '. $raiz_site .'carrossel/'. $item['imagem'] .'"></div></td>
								<td>'. $item['imagem'] .'</td>
								<td>'. $item['ordem'] .'</td>
								<td>
								
									<a href="modulos/carrossel/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
									<a href="modulos/carrossel/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
									
								</td>
								
							</tr>
							';
							
						}
						
					}
					
				?>
				
			</tbody>
		</table>
		<div id="tabela_carrossel_paginacao" class="pagination"></div>
		
	</div>
	
	<div class="separador"></div>
	
	<div class="aviso-verde">Celular (mobile) - 800x480px - Aparece só no celular</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_carrossel_m">
			<thead>
				<tr>
					<th style="width:5vw">Thumb</th>
					<th>Imagem</th>
					<th>Ordem</th>
					<th style="width:10vw">Ação</th>
				</tr>
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $carrossel_array as $item ){
						
						if( $item['mobile'] == 1 ){
						
							echo'
							<tr>
								<td><div class="escolher-imagem-thumb-tabela" style="background-image:url( '. $raiz_site .'carrossel/'. $item['imagem'] .'"></div></td>
								<td>'. $item['imagem'] .'</td>
								<td>'. $item['ordem'] .'</td>
								<td>
								
									<a href="modulos/carrossel/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
									<a href="modulos/carrossel/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
									
								</td>
								
							</tr>
							';
							
						}
						
					}
					
				?>
				
			</tbody>
		</table>
		<div id="tabela_carrossel_m_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_carrossel');
	let tabela_datatable_m = document.querySelector('.tabela_carrossel_m');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [false, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [false, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_carrossel_paginacao"
	});
	
	var datatable_m = new DataTable( tabela_datatable_m, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [false, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [false, true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_carrossel_m_paginacao"
	});
	
</script>
<!-- End - admin/modulos/carrossel/wiew/home.php !-->