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
			
			if( isset( $_GET['id'] ) ){ $chamamento_id = $_GET['id']; }
			
			$downloads_array_total = array_reverse( $downloads_array_total );
			
			foreach( $downloads_array_total as $file ){

				echo'
				<div
					onClick="
						incluirArquivo( `'.$file['arquivo'].'`, `'. $chamamento_id .'` );
						sair_item_arquivos();
					"
					class="
						linha 
						escolher-arquivo-cards-card
					"
				>

					<div 
						class="
							col100
							escolher-arquivo-cards-titulo
						"
					><span>'. $file['id'] .': '. $file['arquivo'] .'</span></div>
					
				</div>
				';
				
			}
			
		?>
		
	</div>

</div>

<script>
function incluirArquivo( arquivo, chamamento_id ){

	//console.log( 'arquivo', arquivo ); 
	
	var formData_incluirArquivo = new FormData();
	formData_incluirArquivo.append( 'arquivo', arquivo );
	formData_incluirArquivo.append( 'chamamento_id', chamamento_id );
	
	//console.log( 'formData_incluirArquivo', formData_incluirArquivo ); 
	
	var xhr_incluirArquivo = new XMLHttpRequest();
	xhr_incluirArquivo.open( 'POST', '../controller/incluirArquivo.php', true );
	
	xhr_incluirArquivo.onload = function () {
		
		if ( xhr_incluirArquivo.status === 200 ) {

			//alert( xhr_incluirArquivo.responseText );
			alert( 'Arquivo incluido com sucesso.' );
			window.location.reload();
			
		}
		
	};
	
	xhr_incluirArquivo.send( formData_incluirArquivo );
	
	
	let exibir_incluirArquivo = document.querySelector('.exibir');
	//console.log( 'exibir_incluirArquivo', exibir_incluirArquivo );
	
	let exibir_incluirArquivo_count = document.querySelectorAll('.exibir .tagBtn').length;
	//console.log( 'exibir_incluirArquivo_count', exibir_incluirArquivo_count );
	
	let exibir_incluirArquivo_id = exibir_incluirArquivo_count + 1;
	//console.log( 'exibir_incluirArquivo_id', exibir_incluirArquivo_id );
	
	let pasta = "<?php echo $pasta ?>";
	//console.log( 'pasta', pasta );
	
	let html_incluirArquivo = ''+
	'<div class="tagBtn tagBtn_'+ exibir_incluirArquivo_id +'">'+
		'<div class="tagBtn-nome">'+ arquivo +'</div>'+
		'<div '+
			'class="tagBtn-excluir"'+
			'onclick="excluirArquivo( `tagBtn_'+ exibir_incluirArquivo_id +'`, `'+ arquivo +'` )"'+
		'><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 492 492"><path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872 c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872 c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052 L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116 c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952 c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116 c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/></svg></div>'+
	'</div>'+
	'';
	
	exibir_incluirArquivo.innerHTML += html_incluirArquivo;
	
};

/*Start - Filtro REATIVO*/
let itens = document.querySelector('.escolher-imagem-cards-box');
let itens_busca = document.querySelector('.escolher-imagem-cards-input');

if( itens ){
	
	itens_busca.addEventListener('keyup', function() {

		let itens_busca = document.querySelector('.escolher-imagem-cards-input').value.toUpperCase();
		let itens = document.querySelector('.escolher-imagem-cards-box');
		
		let card = itens.querySelectorAll('.escolher-arquivo-cards-card');
		
		for( let i = 0; i < card.length; i++ ){

			let a = card[i].querySelector('.escolher-arquivo-cards-titulo');
			
			if( a.innerHTML.toUpperCase().indexOf( itens_busca ) > -1 ){
				
				card[i].style.display = '';
				
			}else{
				
				card[i].style.display = 'none';
				
			}
			
		}

	});
	
}
/*End - Filtro REATIVO*/

function sair_item_arquivos(){
	
	document.querySelector('.item-arquivos').classList.remove("on");
	
}
</script>