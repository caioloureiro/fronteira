<div class="lightbox item-imagens" style="z-index:99999">

	<div class="lightbox-titulo">

		Pasta <?php echo $pasta_nome ?>
		<div class="lightbox-fechar" onClick="sair_item_imagens()" style="background-image:url( <?php echo $raiz_site ?>img/fechar.svg );" ></div>
		
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
							let item_imagens = document.querySelector(`.item-imagens`);
							item_imagens.classList.remove(`on`);
							document.querySelector(`.item-escolher-imagem-input`).value = `'.$arquivo[$i].'` ;
							document.querySelector(`.item-escolher-imagem-btn`).style.backgroundImage = `url('.$img_item.$arquivo[$i].')` ;
							document.querySelector(`.preview_img`).src = `'.$img_item.$arquivo[$i].'`;
						"
						class="escolher-imagem-cards-card"
					>
					
						<div
							class="escolher-imagem-cards-imagem"
							style="background-image:url( '.$img_item.$arquivo[$i].' )"
						></div>
						<div class="escolher-imagem-cards-titulo" title="'.$arquivo[$i].'"><span>'.$arquivo[$i].'</span></div>
						
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
		
		let card = itens.querySelectorAll('.escolher-imagem-cards-card');
		
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