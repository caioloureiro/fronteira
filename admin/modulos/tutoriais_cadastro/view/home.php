<!-- Start - admin/modulos/tutoriais_cadastro/wiew/home.php !-->
<?php require $raiz_site .'model/tutoriais.php'; ?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo tutoriais_cadastro">
	
	<div class="titulo">Cadastro de Vídeos de Tutorial</div>
	
	<div class="linha-acao">
	
		<a href="modulos/tutoriais_cadastro/view/criar"><button class="autores-novo-btn">Criar tutorial</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_tutoriais_cadastro">
		
			<thead>
				
				<tr>
				
					<th>Nome</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					foreach( $tutoriais_array as $item ){
						
						echo'
						<tr>
							
							<td>'. $item['nome'] .'</td>
							<td>
							
								<a href="modulos/tutoriais_cadastro/view/editar?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
								<a href="modulos/tutoriais_cadastro/view/excluir?id='. $item['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_tutoriais_cadastro_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_tutoriais_cadastro');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_tutoriais_cadastro_paginacao"
	});
	
</script>
<!-- End - admin/modulos/tutoriais_cadastro/wiew/home.php !-->