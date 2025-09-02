<div class="lightbox item-imagens" style="z-index:99999">

	<div class="lightbox-titulo">

		Pasta <?php echo $pasta_nome ?>
		<div class="lightbox-fechar" onClick="sair_item_imagens()" style="background-image:url( ../../../img/fechar.svg );" ></div>
		
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
			$noticia_id = 0;
			
			//echo'<pre>'; var_dump( $arquivo ); echo'</pre>';
			
			if( isset( $_GET['id'] ) ){ $noticia_id = $_GET['id']; }
			
			if($files){
				$filecount = count($files) + 1;
			}
			
			for($i = 0;$i <= $filecount;$i++){
				
				if(
					$arquivo[$i] != '.' 
					&& $arquivo[$i] != '..'
					&& $arquivo[$i] != 'index.html'
					&& $arquivo[$i] != '.htaccess'
				){
					echo'
					<div
						onClick="
							incluirImagem( `'.$arquivo[$i].'`, valor );
							document.querySelector(`.item-imagens`).classList.remove(`on`);
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

function sair_item_imagens(){
	
	document.querySelector(`.item-imagens`).classList.remove(`on`);

}

function incluirImagem( imagem, noticia_id ){

	//console.log( 'imagem', imagem ); 

	var formData_incluirImagem = new FormData();
	formData_incluirImagem.append( 'imagem', imagem );
	formData_incluirImagem.append( 'noticia_id', noticia_id );
	
	//console.log( 'formData_incluirImagem', formData_incluirImagem ); 
	
	var xhr_incluirImagem = new XMLHttpRequest();
	xhr_incluirImagem.open( 'POST', '../controller/incluirImagem.php', true );
	
	xhr_incluirImagem.onload = function () {
		
		if ( xhr_incluirImagem.status === 200 ) {

			console.log( 'xhr_incluirImagem.responseText', xhr_incluirImagem.responseText );
			
		}
		
	};
	
	xhr_incluirImagem.send( formData_incluirImagem );
	
	let exibir_incluirImagem = document.querySelector('.exibir');
	//console.log( 'exibir_incluirImagem', exibir_incluirImagem );
	
	let exibir_incluirImagem_count = document.querySelectorAll('.exibir .thumb').length;
	//console.log( 'exibir_incluirImagem_count', exibir_incluirImagem_count );
	
	let exibir_incluirImagem_id = exibir_incluirImagem_count + 1;
	//console.log( 'exibir_incluirImagem_id', exibir_incluirImagem_id );
	
	let pasta = "<?php echo $pasta ?>";
	
	let html_incluirImagem = ''+
	'<div class="thumb thumb_'+ exibir_incluirImagem_id +'">'+
		'<div '+
			'class="thumb-excluir"'+
			'onclick="excluirArquivo( `thumb_'+ exibir_incluirImagem_id +'`, `'+ imagem +'` )"'+
		'><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 492 492"><path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872 c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872 c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052 L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116 c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952 c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116 c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/></svg></div>'+
		'<div '+
			'class="thumb-img"'+
			'style="background-image:url( '+ pasta + imagem +' )"'+
		'></div>'+
	'</div>'+
	'';
	
	exibir_incluirImagem.innerHTML += html_incluirImagem;
	
};

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