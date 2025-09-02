<div class="lightbox item-img_redes" style="z-index:99999">

	<div class="lightbox-titulo">

		Pasta item
		<div class="lightbox-fechar" onClick="sair_item_img_redes()" style="background-image:url( ../../../img/fechar.svg );" ></div>
		
	</div>
	
	<div class="escolher-imagem-cards-campo">
		<input type="text" class="escolher-imagem-cards-input img_redes" placeholder="Filtrar..."/>
	</div>
	
	<div class="escolher-imagem-cards-box img_redes">
	
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
							let item_img_redes = document.querySelector(`.item-img_redes`);
							item_img_redes.classList.remove(`on`);
							document.querySelector(`.item-escolher-img_redes-input`).value = `img/'.$arquivo[$i].'` ;
							document.querySelector(`.item-escolher-img_redes-btn`).style.backgroundImage = `url('.$img_item.$arquivo[$i].')` ;
						"
						class="escolher-imagem-cards-card img_redes"
					>
					
						<div
							class="escolher-imagem-cards-imagem img_redes"
							style="background-image:url( '.$img_item.$arquivo[$i].' )"
						></div>
						<div class="escolher-imagem-cards-titulo img_redes" title="'.$arquivo[$i].'"><span>'.$arquivo[$i].'</span></div>
						
					</div>
					';
				}
				
			}
			
		?>
		
	</div>

</div>

<script>

function sair_item_img_redes(){
	
	document.querySelector('.escurecer').classList.remove('on');
	document.querySelector('.item-img_redes').classList.remove('on');
	
}

/*Start - Filtro REATIVO*/
let itens_img_redes = document.querySelector('.escolher-imagem-cards-box.img_redes');
let itens_busca_img_redes = document.querySelector('.escolher-imagem-cards-input.img_redes');

if( itens_img_redes ){
	
	itens_busca_img_redes.addEventListener('keyup', function() {

		let itens_busca_img_redes = document.querySelector('.escolher-imagem-cards-input.img_redes').value.toUpperCase();
		let itens_img_redes = document.querySelector('.escolher-imagem-cards-box.img_redes');
		
		let card_img_redes = itens_img_redes.querySelectorAll('.escolher-imagem-cards-card.img_redes');
		
		for( let i = 0; i < card_img_redes.length; i++ ){

			let a = card_img_redes[i].querySelector('.escolher-imagem-cards-titulo.img_redes');
			
			if( a.innerHTML.toUpperCase().indexOf( itens_busca_img_redes ) > -1 ){
				
				card_img_redes[i].style.display = '';
				
			}else{
				
				card_img_redes[i].style.display = 'none';
				
			}
			
		}

	});
	
}
/*End - Filtro REATIVO*/

</script>