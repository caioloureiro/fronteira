<!-- Start - admin/modulos/backup_db/wiew/home.php !-->
<div class="conteudo backup_db">
	
	<div class="titulo">Backup do Banco de Dados</div>
	
	<div class="linha linha-auto">
		<div class="comentario">
			<?php

				//echo 'Meu IP: '. file_get_contents("http://ipecho.net/plain");
				echo 'Meu IP: '. $_SERVER['REMOTE_ADDR'];
				
			?>
		</div>
	</div>
	
	<div class="linha-acao">
	
		<a href="modulos/backup_db/controller/criar_sql.php"><button>Criar SQL de backup</button></a>
		
	</div>
	
	<div class="conteudo-tabela-janela">

		<table class="tabela_backup_db">
		
			<thead>
				
				<tr>
				
					<th>Arquivo SQL</th>
					<th style="width:10vw">Ação</th>
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<?php
					
					$directory = '../backup_do_banco/';
					$arquivo = scandir( $directory );
					$filecount = 0;
					$files = glob( $directory . "*" );
					if( $files ){ $filecount = count( $files ) + 1; }
					
					$files = array_reverse( $files );
					
					//dd( $files );
					
					foreach( $files as $arquivo ){
						
						$nome_arquivo_array = explode( '/', trim( strip_tags( $arquivo ) ) );
						$nome_arquivo = $nome_arquivo_array[ count( $nome_arquivo_array ) - 1 ];
						
						echo'
						<tr>
							
							<td>'. $nome_arquivo .'</td>
							<td>
							
								<a target="_blank" href="modulos/backup_db/controller/zipar?arquivo='. $arquivo .'">Download</a>
								
							</td>
							
						</tr>
						';
						
					}
					
				?>
				
			</tbody>
		
		</table>
		
		<div id="tabela_backup_db_paginacao" class="pagination"></div>
		
	</div>
	
</div>

<script>

	let tabela_datatable = document.querySelector('.tabela_backup_db');
	
	var datatable = new DataTable( tabela_datatable, {
		pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
		sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
		filters: [true], /* QUANTAS COLUNAS? FILTROS */
		filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
		pagingDivSelector: "#tabela_backup_db_paginacao"
	});
	
</script>
<!-- End - admin/modulos/backup_db/wiew/home.php !-->