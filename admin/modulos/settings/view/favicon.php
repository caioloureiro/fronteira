<div class="lightbox item-favicon" style="z-index:99999">

	<div class="lightbox-titulo">

		Pasta item
		<div class="lightbox-fechar" onClick="sair_item_favicon()" style="background-image:url( ../../../img/fechar.svg );" ></div>
		
	</div>
	
	<div class="escolher-imagem-cards-campo">
		<input type="text" class="escolher-imagem-cards-input favicon" placeholder="Filtrar..."/>
	</div>
	
	<div class="escolher-imagem-cards-box favicon">
	
		<?php
			$img_item = $raiz_site .'img/';
			$arquivo = scandir($img_item);
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
							let item_favicon = document.querySelector(`.item-favicon`);
							item_favicon.classList.remove(`on`);
							document.querySelector(`.item-escolher-favicon-input`).value = `img/'.$arquivo[$i].'` ;
							document.querySelector(`.item-escolher-favicon-btn`).style.backgroundImage = `url('.$img_item.$arquivo[$i].')` ;
						"
						class="escolher-imagem-cards-card favicon"
					>
					
						<div
							class="escolher-imagem-cards-imagem favicon"
							style="background-image:url( '.$img_item.$arquivo[$i].' )"
						></div>
						<div class="escolher-imagem-cards-titulo favicon" title="'.$arquivo[$i].'"><span>'.$arquivo[$i].'</span></div>
						
					</div>
					';
				}
				
			}
			
		?>
		
	</div>

</div>

<script>

function sair_item_favicon(){
	
	document.querySelector('.escurecer').classList.remove('on');
	document.querySelector('.item-favicon').classList.remove('on');
	
}

/*Start - Filtro REATIVO*/
let itens_favicon = document.querySelector('.escolher-imagem-cards-box.favicon');
let itens_busca_favicon = document.querySelector('.escolher-imagem-cards-input.favicon');

if( itens_favicon ){
	
	itens_busca_favicon.addEventListener('keyup', function() {

		let itens_busca_favicon = document.querySelector('.escolher-imagem-cards-input.favicon').value.toUpperCase();
		let itens_favicon = document.querySelector('.escolher-imagem-cards-box.favicon');
		
		let card_favicon = itens_favicon.querySelectorAll('.escolher-imagem-cards-card.favicon');
		
		for( let i = 0; i < card_favicon.length; i++ ){

			let a = card_favicon[i].querySelector('.escolher-imagem-cards-titulo.favicon');
			
			if( a.innerHTML.toUpperCase().indexOf( itens_busca_favicon ) > -1 ){
				
				card_favicon[i].style.display = '';
				
			}else{
				
				card_favicon[i].style.display = 'none';
				
			}
			
		}

	});
	
}
/*End - Filtro REATIVO*/

</script>