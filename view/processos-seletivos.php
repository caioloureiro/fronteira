<!-- Start - view/processos-seletivos.php !-->
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

<style><?php require 'css/processos-seletivos.css'; ?></style>

<section class="processos-seletivos">
	
	<div class="box">
		
		<?= $pagina['texto'] ?>
		
		<div 
			class="processos-seletivos-filtro"
			title="Essa busca é reativa, basta apenas digitar para achar o resultado."
		>
			
			<div class="processos-seletivos-filtro-titulo">BUSCA DETALHADA</div>
			
			<div class="processos-seletivos-filtro-campo">
				
				<div class="processos-seletivos-filtro-col01">
					
					<div class="processos-seletivos-filtro-label">Titulo</div>
					<div class="processos-seletivos-filtro-input">
						<input type="text" class="input_titulo" />
					</div>
					
				</div>
				
				<div class="processos-seletivos-filtro-col01">
					
					<div class="processos-seletivos-filtro-label">Categorias</div>
					<div class="processos-seletivos-filtro-input">
						<input type="text" class="input_categorias" />
					</div>
					
				</div>
				
			</div>
			
		</div>
		
		<div class="processos-seletivos-counter"><?php echo $counterHTML ?></div>
	
		<div class="processos-seletivos-campo div_chamadas_publicas_scroll">
		
			<?php
				
				foreach( $chamadas_publicas_array as $item ){
					
					$data = date( 'd/m/Y', strtotime( $item['data'] ) );
					
					$categorias = explode( ';', trim( strip_tags( $item['categorias'] ) ) );

					echo '
					<div class="processos-seletivos-item">
					
						<a 
							href="arquivos/'. $item['arquivo'] .'" 
							target="_blank"
						>
						
							<div class="col20">
								<div class="processos-seletivos-thumb-campo">
									<div class="processos-seletivos-thumb">
										<span class="material-symbols-outlined">picture_as_pdf</span>
									</div>
								</div>
							</div>
							<div class="col80">
							
								<div class="processos-seletivos-linha">
								
									<div class="processos-seletivos-titulo"><span>'. $item['titulo'] .'</span></div>
									
									<div class="processos-seletivos-btn">
										<div class="processos-seletivos-btn-icone">
											<span class="material-symbols-outlined">download</span>
										</div>
										<div class="processos-seletivos-btn-nome">Acessar</div>
									</div>
									
								</div>
								
								<div class="processos-seletivos-linha dados">
									<div class="processos-seletivos-dado">
										<div class="processos-seletivos-dado-icone">
											<span class="material-symbols-outlined">calendar_month</span>
										</div>
										<div class="processos-seletivos-dado-item"><strong>Postagem:</strong> '. $data .'</div>
									</div>
									<div class="processos-seletivos-dado">
										<div class="processos-seletivos-dado-icone">
											<span class="material-symbols-outlined">tag</span>
										</div>
										<div 
											class="
												processos-seletivos-dado-item 
												chamadas_publicas_categorias
											"
										>
											<div class="processos-seletivos-txt"><strong>Categorias:</strong> </div>
											';
											
												foreach( $categorias as $categoria ){

													echo '<div class="processos-seletivos-tag">'. $categoria .'</div>';
													
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
let itens = document.querySelector('.processos-seletivos-campo');

if( itens ){
	
	input_titulo.addEventListener('keyup', function() {
		
		let input_titulo = document.querySelector('.input_titulo').value.toUpperCase();
		let itens = document.querySelector('.processos-seletivos-campo');
		
		let card = itens.querySelectorAll('.processos-seletivos-item');
		
		for( let i = 0; i < card.length; i++ ){

			let a = card[i].querySelector('.processos-seletivos-titulo');
			
			if( a.innerHTML.toUpperCase().indexOf( input_titulo ) > -1 ){
				
				card[i].style.display = '';
				
			}else{
				
				card[i].style.display = 'none';
				
			}
			
		}

	});
	
	input_categorias.addEventListener('keyup', function() {
		
		let input_categorias = document.querySelector('.input_categorias').value.toUpperCase();
		let itens = document.querySelector('.processos-seletivos-campo');
		
		let card = itens.querySelectorAll('.processos-seletivos-item');
		
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
<!-- End - view/processos-seletivos.php !-->