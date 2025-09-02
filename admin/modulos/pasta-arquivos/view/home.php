<?php
$directory = '../arquivos/';
$arquivo = scandir( $directory );
$filecount = 0;
$files = glob( $directory . "*" );
if( $files ){ $filecount = count( $files ) + 1; }

//dd( $files );

?>

<div class="conteudo pasta-arquivos">

	<div class="titulo">Pasta arquivos</div>
	
	<div class="linha linha-auto">
		<div class="comentario">Basta clicar no arquivo e ele abrirá em uma nova guia. Copie seu endereço para vincular.</div>
	</div>
	
	<div class="linha"><?php echo $filecount ?> arquivos encontrados</div>
	
	<div class="linha-acao">
		
		<form action="modulos/pasta-arquivos/controller/enviar-arquivo.php" method="POST" enctype="multipart/form-data">

			<label class="btn arquivo_escolhido" for="arquivo" title="Clique aqui para selecionar os arquivos desejados.">Escolher arquivos do computador</label>

			<input type="file" name="enviarArquivoItem[]" id="arquivo" multiple />

			<button type="submit" class="enviar-arquivo-submit" title="Clique aqui para ENVIAR.">Enviar arquivos</button>
			
		</form>
		
	</div>

	<table class="tabela_pasta-arquivos">
	
		<thead>
			
			<tr>
			
				<th style="width:3vw"></th>
				<th>Nome do arquivo</th>
				<th style="width:10vw">Ação</th>
				
			</tr>
			
		</thead>
		
		<tbody>
		
			<?php
				
				foreach( $files as $arquivo ){
					
					if( is_file($directory.$arquivo) ){ //SOMENTE ARQUIVOS
						
						$arquivo_array = explode( '/', trim( strip_tags( $arquivo ) ) );
						$arquivo_nome = $arquivo_array[ count( $arquivo_array ) - 1 ];
						//dd($arquivo_nome);
					
						echo'
						<tr>
							<td>
								<div
									class="escolher-imagem-thumb-tabela"
									style="
										background-image:url( img/documento.svg );
										background-size: auto 80%;
										background-color: rgba(0,0,0,0);
									"
								></div>
							</td>
							<td>
								<span class="item-titulo" title="'. $arquivo .'">
									<a target="_blank" href="'. $arquivo .'">'. $arquivo_nome .'</a>
								</span>
							</td>
							<td>
							
								<a href="modulos/pasta-arquivos/view/excluir-arquivo.php?nome='. $arquivo .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
								
							</td>
							
						</tr>
						';
						
					}
					
				}
				
			?>
			
		</tbody>
	
	</table>
	<div id="paginacao_pasta-arquivos" class="pagination"></div>

</div>

<script>
let tabela_hotel_atalaia_img = document.querySelector('.tabela_pasta-arquivos');
var datatable = new DataTable( tabela_hotel_atalaia_img, {
	sort: [false, true],
	filters: [false, true],
	filterText: 'Buscar... ',
	pagingDivSelector: "#paginacao_pasta-arquivos"
});
</script>