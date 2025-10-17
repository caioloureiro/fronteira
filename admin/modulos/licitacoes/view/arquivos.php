<div class="lightbox item-arquivos" style="z-index:99999">

	<div class="lightbox-titulo">

		Pasta <?php echo $pasta_nome ?>
		<div class="lightbox-fechar" onClick="sair_item_arquivos()" style="background-image:url( ../../../img/fechar.svg );" ></div>
		
	</div>
	
	<div class="escolher-imagem-cards-campo">
		<input type="text" class="escolher-imagem-cards-input" placeholder="Filtrar..."/>
	</div>
	
	<div class="escolher-imagem-cards-box">
	
		<?php
			$img_item = $pasta; // $pasta e $pasta_nome são puxados do novo-02.php
			$arquivo = scandir( $img_item );
			$filecount = 0;
			$files = glob($img_item . "*");
			
			if($files){
				$filecount = count($files) + 1;
			}
			
			for($i = 0;$i <= $filecount;$i++){
				
				if(
					$arquivo[$i] != '.' &&
					$arquivo[$i] != '..'
				){
					echo'
					<div
						onClick="
							let item_arquivos = document.querySelector(`.item-arquivos`);
							item_arquivos.classList.remove(`on`);
							
							if(window.anexoMode) {
								// Modo anexo - adicionar arquivo como anexo
								adicionarArquivoComoAnexo(`'.$arquivo[$i].'`);
								window.anexoMode = false;
							} else {
								// Modo normal - edital
								document.querySelector(`.item-escolher-arquivo-input`).value = `uploads/'.$arquivo[$i].'` ;
								mostrarArquivoSelecionadoServidor(`'.$arquivo[$i].'`);
							}
						"
						class="linha"
					>

						<div class="col100" title="'.$arquivo[$i].'"><span>'.$arquivo[$i].'</span></div>
						
					</div>
					';
				}
				
			}
			
		?>
		
	</div>

</div>

<script>
/*Start - Filtro REATIVO*/
let itens = document.querySelector('.escolher-imagem-cards-box');
let itens_busca = document.querySelector('.escolher-imagem-cards-input');

if( itens ){
	
	itens_busca.addEventListener('keyup', function() {

		let itens_busca = document.querySelector('.escolher-imagem-cards-input').value.toUpperCase();
		let itens = document.querySelector('.escolher-imagem-cards-box');
		
		let linhas = itens.querySelectorAll('.linha');
		
		for( let i = 0; i < linhas.length; i++ ){

			let texto = linhas[i].querySelector('span');
			
			if( texto && texto.innerHTML.toUpperCase().indexOf( itens_busca ) > -1 ){
				
				linhas[i].style.display = '';
				
			}else{
				
				linhas[i].style.display = 'none';
				
			}
			
		}

	});
	
}
/*End - Filtro REATIVO*/

function sair_item_arquivos(){
	
	document.querySelector('.item-arquivos').classList.remove("on");
	
}
</script>