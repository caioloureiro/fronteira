<!-- Start - view/lei-paulo-gustavo.php !-->
<?php

require 'model/chamadas_publicas.php';

$chamadas_publicas_array_total = array_reverse( $chamadas_publicas_array_total );

$counterHTML =  'Nenhum item encontrado.';
$counter_diarios = 0;

foreach( $chamadas_publicas_array_total as $count_item ){ $counter_diarios++; }

if( $counter_diarios == 1 ){
	$counterHTML = '1 item encontrado.';
}

if( $counter_diarios > 1 ){
	$counterHTML = $counter_diarios .' itens encontrados.';
}


?>

<style><?php require 'css/lei-paulo-gustavo.css'; ?></style>

<section class="lei-paulo-gustavo">
	
	<div class="box">
		
		<?= $pagina['texto'] ?>
		
		<div 
			class="lei-paulo-gustavo-filtro"
			title="Essa busca é reativa, basta apenas digitar para achar o resultado."
		>
			
			<div class="lei-paulo-gustavo-filtro-titulo">BUSCA DETALHADA</div>
			
			<div class="lei-paulo-gustavo-filtro-campo">
				
				<div class="lei-paulo-gustavo-filtro-col01">
					
					<div class="lei-paulo-gustavo-filtro-label">Titulo</div>
					<div class="lei-paulo-gustavo-filtro-input">
						<input type="text" class="input_titulo" />
					</div>
					
				</div>
				
				<div class="lei-paulo-gustavo-filtro-col01">
					
					<div class="lei-paulo-gustavo-filtro-label">Categorias</div>
					<div class="lei-paulo-gustavo-filtro-input">
						<input type="text" class="input_categorias" />
					</div>
					
				</div>
				
			</div>
			
		</div>
		
		<div class="lei-paulo-gustavo-counter"><?php echo $counterHTML ?></div>
	
		<div class="lei-paulo-gustavo-campo div_chamadas_publicas_scroll">
		
			<?php
				
				foreach( $chamadas_publicas_array as $item ){
					
					$data = date( 'd/m/Y', strtotime( $item['data'] ) );
					
					$categorias = explode( ';', trim( strip_tags( $item['categorias'] ) ) );

					echo '
					<div class="lei-paulo-gustavo-item">
					
						<a 
							href="arquivos/'. $item['arquivo'] .'" 
							target="_blank"
						>
						
							<div class="col20">
								<div class="lei-paulo-gustavo-thumb-campo">
									<div class="lei-paulo-gustavo-thumb">
										<span class="material-symbols-outlined">picture_as_pdf</span>
									</div>
								</div>
							</div>
							<div class="col80">
							
								<div class="lei-paulo-gustavo-linha">
								
									<div class="lei-paulo-gustavo-titulo"><span>'. $item['titulo'] .'</span></div>
									
									<div class="lei-paulo-gustavo-btn">
										<div class="lei-paulo-gustavo-btn-icone">
											<span class="material-symbols-outlined">download</span>
										</div>
										<div class="lei-paulo-gustavo-btn-nome">Acessar</div>
									</div>
									
								</div>
								
								<div class="lei-paulo-gustavo-linha dados">
									<div class="lei-paulo-gustavo-dado">
										<div class="lei-paulo-gustavo-dado-icone">
											<span class="material-symbols-outlined">calendar_month</span>
										</div>
										<div class="lei-paulo-gustavo-dado-item"><strong>Postagem:</strong> '. $data .'</div>
									</div>
									<div class="lei-paulo-gustavo-dado">
										<div class="lei-paulo-gustavo-dado-icone">
											<span class="material-symbols-outlined">tag</span>
										</div>
										<div 
											class="
												lei-paulo-gustavo-dado-item 
												chamadas_publicas_categorias
											"
										>
											<div class="lei-paulo-gustavo-txt"><strong>Categorias:</strong> </div>
											';
											
												foreach( $categorias as $categoria ){

													echo '<div class="lei-paulo-gustavo-tag">'. $categoria .'</div>';
													
												}
												
											echo'
										</div>
									</div>
								</div>
								
							</div>
							
						</a>
						
					</div>
					';
					
				}
				
			?>
			
		</div>
		
	</div>
	
</section>

<!--  
<div 
	class="debug"
	style="
		position:fixed;
		top:2vw;
		right:2vw;
		background-color:red;
		color:white;
		z-index:9999;
		width:5vw;
		height:5vw;
	"
>0</div>
!-->

<script>

/*Start - Filtro REATIVO*/
let input_titulo = document.querySelector('.input_titulo');
let input_categorias = document.querySelector('.input_categorias');
let itens = document.querySelector('.lei-paulo-gustavo-campo');

if( itens ){
	
	input_titulo.addEventListener('keyup', function() {
		
		let input_titulo = document.querySelector('.input_titulo').value.toUpperCase();
		let itens = document.querySelector('.lei-paulo-gustavo-campo');
		
		let card = itens.querySelectorAll('.lei-paulo-gustavo-item');
		
		for( let i = 0; i < card.length; i++ ){

			let a = card[i].querySelector('.lei-paulo-gustavo-titulo');
			
			if( a.innerHTML.toUpperCase().indexOf( input_titulo ) > -1 ){
				
				card[i].style.display = '';
				
			}else{
				
				card[i].style.display = 'none';
				
			}
			
		}

	});
	
	input_categorias.addEventListener('keyup', function() {
		
		let input_categorias = document.querySelector('.input_categorias').value.toUpperCase();
		let itens = document.querySelector('.lei-paulo-gustavo-campo');
		
		let card = itens.querySelectorAll('.lei-paulo-gustavo-item');
		
		for( let i = 0; i < card.length; i++ ){

			let a = card[i].querySelector('.chamadas_publicas_categorias');
			
			if( a.innerHTML.toUpperCase().indexOf( input_categorias ) > -1 ){
				
				card[i].style.display = '';
				
			}else{
				
				card[i].style.display = 'none';
				
			}
			
		}

	});
	
}
/*End - Filtro REATIVO*/

let div_chamadas_publicas_scroll = document.querySelector('.div_chamadas_publicas_scroll');

/*Start - Efeitos de Scroll*/
let body = document.body;
let html = document.documentElement;

let document_height = Math.max( 
	body.scrollHeight, 
	body.offsetHeight, 
	html.clientHeight, 
	html.scrollHeight, 
	html.offsetHeight 
);
//console.log( 'document_height', document_height ); 

let window_height = window.innerHeight;
//console.log( 'window_height', window_height ); 

let pagina_counter = 1;

function buscar_resultados( pagina_counter ){
	
	var formData = new FormData();
	formData.append( 'pagina_counter', pagina_counter );
	
	var xhr = new XMLHttpRequest();
	xhr.open( 'POST', 'model/chamadas_publicas_scroll.php', true );
	
	var resultado = '';
	
	//console.log( 'teste pagina_counter: ', pagina_counter );
	
	xhr.onreadystatechange = function(){
		
		if( 
			xhr.status === 200 
			&& xhr.readyState == 4
		){
			
			//console.log( 'teste pagina_counter: ', pagina_counter );
			
			//console.log( xhr.responseText );
			
			div_chamadas_publicas_scroll.innerHTML += xhr.responseText;
			
		}
		
	};
	
	xhr.send( formData );
	
}

window.addEventListener('scroll', function() {
	
	var gatilho = window.scrollY + window_height;

	document_height = Math.max( 
		body.scrollHeight, 
		body.offsetHeight, 
		html.clientHeight, 
		html.scrollHeight, 
		html.offsetHeight 
	);
	//console.log( 'document_height', document_height ); 
	
	//let debug = document.querySelector('.debug');
	//debug.innerHTML = gatilho;

	if( gatilho >= document_height ){
		
		//console.log( 'pagina_counter', pagina_counter ); 
		
		pagina_counter++;
		
		buscar_resultados( pagina_counter );
		
	}
	
});

/*End - Efeitos de Scroll*/

</script>
<!-- End - view/lei-paulo-gustavo.php !-->