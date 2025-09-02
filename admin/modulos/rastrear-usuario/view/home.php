<div class="conteudo admin_user">
	
	<div class="titulo">Rastrear Usuário</div>
	
	<div class="conteudo-tabela-janela">

		<table class="rastrear_tabela">
		
			<thead>
				
				<tr>
				
					<th>Usuário</th>
					<th>Descrição</th>
					<th>horário</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					$rastrear_usuario_array = array_reverse( $rastrear_usuario_array );
					
					foreach( $rastrear_usuario_array as $usuario ){
						
						echo'
						<tr>
							
							<td>'.$usuario['usuario'].'</td>
							<td>'.$usuario['descricao'].'</td>
							<td>'. data_tempo( $usuario['horario'] ) .'</td>
							
						</tr>
						';
						
					}
				
				?>
				
			</tbody>
		
		</table>
		<div id="paginacao" class="rastrear_tabela"></div>
		
	</div>
	
</div>

<script>

let tabela_datatable = document.querySelector('.rastrear_tabela');
var datatable = new DataTable( tabela_datatable, {
	pageSize: 50, /* QUANTOS ITENS POR PÁGINA */
	sort: [true, true, true], /* QUANTAS COLUNAS? ORDENAÇÃO */
	filters: [true, true, true], /* QUANTAS COLUNAS? FILTROS */
	filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
	pagingDivSelector: "#paginacao"
});

</script>