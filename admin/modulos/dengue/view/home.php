<!-- Start - admin/modulos/dengue/wiew/home.php !-->
<?php require $raiz_site .'model/dengue.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo dengue">
	
	<div class="titulo">Dengue</div>
	
	<div class="linha-acao">
	
		<a href="modulos/dengue/view/criar"><button class="autores-novo-btn">Criar atualização</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_dengue">
		
			<thead>
				
				<tr>
				
					<th>Data</th>
					<th>Confirmados</th>
					<th>Autoctones</th>
					<th>Importados</th>
					<th>Descartados</th>
					<th>Aguardando</th>
					<th>Notificações</th>
					<th>Norte</th>
					<th>Sul</th>
					<th>Central</th>
					<th>Leste</th>
					<th>Oeste</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					$dengue_array = array_reverse( $dengue_array );
					
					foreach( $dengue_array as $item ){

						$confirmados = '-';
						$casos_autoctones = '-';
						$casos_importados = '-';
						$descartados = '-';
						$aguardando = '-';
						$notificacoes = '-';
						$casos_regiao_norte = '-';
						$casos_regiao_sul = '-';
						$casos_regiao_central = '-';
						$casos_regiao_leste = '-';
						$casos_regiao_oeste = '-';

						if( $item['confirmados'] != 0 ){ $confirmados = $item['confirmados']; }
						if( $item['casos_autoctones'] != 0 ){ $casos_autoctones = $item['casos_autoctones']; }
						if( $item['casos_importados'] != 0 ){ $casos_importados = $item['casos_importados']; }
						if( $item['descartados'] != 0 ){ $descartados = $item['descartados']; }
						if( $item['aguardando'] != 0 ){ $aguardando = $item['aguardando']; }
						if( $item['notificacoes'] != 0 ){ $notificacoes = $item['notificacoes']; }
						if( $item['casos_regiao_norte'] != 0 ){ $casos_regiao_norte = $item['casos_regiao_norte']; }
						if( $item['casos_regiao_sul'] != 0 ){ $casos_regiao_sul = $item['casos_regiao_sul']; }
						if( $item['casos_regiao_central'] != 0 ){ $casos_regiao_central = $item['casos_regiao_central']; }
						if( $item['casos_regiao_leste'] != 0 ){ $casos_regiao_leste = $item['casos_regiao_leste']; }
						if( $item['casos_regiao_oeste'] != 0 ){ $casos_regiao_oeste = $item['casos_regiao_oeste']; }
					
						echo'
						<tr>
							
							<td>'. data_tempo( $item['data'] ) .'</td>
							<td>'. $confirmados .'</td>
							<td>'. $casos_autoctones .'</td>
							<td>'. $casos_importados .'</td>
							<td>'. $descartados .'</td>
							<td>'. $aguardando .'</td>
							<td>'. $notificacoes .'</td>
							<td>'. $casos_regiao_norte .'</td>
							<td>'. $casos_regiao_sul .'</td>
							<td>'. $casos_regiao_central .'</td>
							<td>'. $casos_regiao_leste .'</td>
							<td>'. $casos_regiao_oeste .'</td>
							<td>
							
								<a href="modulos/dengue/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/dengue/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_dengue_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_dengue');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_dengue_paginacao"
	});
	
</script>
<!-- End - admin/modulos/dengue/wiew/home.php !-->