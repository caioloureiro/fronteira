<div class="conteudo pasta-carrossel">

	<div class="titulo">Pasta carrossel</div>
	
	<div class="linha linha-auto">
		<div class="comentario">Basta clicar na imagem e ela abrirá em uma nova guia. Copie seu endereço para vincular.</div>
	</div>
	
	<div class="linha-acao">
		
		<form action="modulos/pasta-carrossel/controller/enviar-arquivo.php" method="POST" enctype="multipart/form-data">

			<label class="btn arquivo_escolhido" for="arquivo" title="Clique aqui para selecionar o arquivo desejado.">Escolher imagem do computador</label>

			<input type="file" name="enviarArquivoItem[]" id="arquivo" />

			<button type="submit" class="enviar-arquivo-submit" title="Clique aqui para ENVIAR.">Enviar imagem</button>
			
		</form>
		
	</div>
	
	<div class="escolher-imagem-cards-campo">
		<input type="text" class="escolher-imagem-cards-input" placeholder="Filtrar..."/>
	</div>

	<div class="escolher-imagem-cards-box-pastas">
	
		<?php
			
			$directory = $raiz_site .'carrossel/';
			$arquivo = scandir( $directory );
			$filecount = 0;
			$files = glob( $directory . "*" );
			if( $files ){ $filecount = count( $files ) + 1; }
			
			$pexcluir_arquivo_da_pasta = '../../../';
			
			//dd( $files );
			
			foreach( $files as $arquivo ){
				
				$nome_arquivo_array = explode( '/', trim( strip_tags( $arquivo ) ) );
				$nome_arquivo = $nome_arquivo_array[ count( $nome_arquivo_array ) - 1 ];
			
				echo'
				<div class="escolher-imagem-cards-card-pastas">
					<a target="_blank" href="'. $arquivo .'">
						<div
							class="escolher-imagem-cards-imagem"
							style="background-image:url( '. $arquivo .' )"
						></div>
						<div 
							class="escolher-imagem-cards-titulo" 
							title="'. $arquivo .'"
						><span>'. $nome_arquivo .'</span></div>
					</a>
					<div class="escolher-imagem-cards-excluir" title="Excluir arquivo do servidor."><a href="modulos/pasta-carrossel/view/excluir-arquivo.php?nome='. $pexcluir_arquivo_da_pasta . $arquivo .'"></a></div>
				</div>
				';
				
			}
			
		?>
	
	</div>

</div>

<script>

/*Start - Filtro REATIVO*/
let itens = document.querySelector('.escolher-imagem-cards-box-pastas');
let itens_busca = document.querySelector('.escolher-imagem-cards-input');

if( itens ){
	
	itens_busca.addEventListener('keyup', function() {

		let itens_busca = document.querySelector('.escolher-imagem-cards-input').value.toUpperCase();
		let itens = document.querySelector('.escolher-imagem-cards-box-pastas');
		
		let card = itens.querySelectorAll('.escolher-imagem-cards-card-pastas');
		
		for( let i = 0; i < card.length; i++ ){

			let a = card[i].querySelector('.escolher-imagem-cards-titulo');
			
			if( a.innerHTML.toUpperCase().indexOf( itens_busca ) > -1 ){
				
				card[i].style.display = '';
				
			}else{
				
				card[i].style.display = 'none';
				
			}
			
		}

	});
	
}
/*End - Filtro REATIVO*/

</script>