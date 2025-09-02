<!-- Start - view/galerias-item.php !-->
<?php 
require 'model/galeria.php'; 
require 'model/galeria_imagens.php'; 

$count_galeria = 0;

$pasta = 'galeria/';
?>

<style><?php require 'css/galerias-item.css'; ?></style>

<section class="galerias-item">
	
	<div class="lightbox"></div>
	
	<div class="box">
		
		<a href="galerias"><div class="voltar">voltar</div></a>
		
		<div class="separador"></div>
		
		<div class="galerias-campo" id="ler_texto">
			
			<?php
				
				foreach( $galeria_array as $gal ){
					
					if( $gal['id'] == $_GET['id'] ){
						
						echo $gal['texto'];
						
					}
					
				}
				
			?>
			
		</div>
		
		<div class="galerias-item-counter"></div>
	
		<div class="galerias-item-campo">
			
			<?php
				
				foreach( $galeria_imagens_array as $index => $img ){
					
					if( $img['galeria_id'] == $_GET['id'] ){
						
						$imgAnterior = 0;
						$imgAtual = $img['id'];
						$imgProxima = 0;
						$imgPrimeira = 0;
						$imgUltima = 0;
						
						if( $count_galeria == 0 ){ 
							$imgPrimeira = $img['id']; 
							// Para a primeira imagem, não há imagem anterior
							$imgAnterior = 0;
						} else {
							// Para imagens subsequentes, pega a imagem anterior
							$imgAnterior = $galeria_imagens_array[$index - 1]['id'];
						}
						
						// Verifica se existe próxima imagem
						if( isset( $galeria_imagens_array[$index + 1] ) && 
							$galeria_imagens_array[$index + 1]['galeria_id'] == $_GET['id'] ){ 
							$imgProxima = $galeria_imagens_array[$index + 1]['id']; 
						}
						
						// Atualiza a última imagem
						$imgUltima = $img['id'];
						
						echo '
						<div 
							class="galerias-item-thumb"
							style="background-image:url( '. $pasta . $img['imagem'] .' )"
							onclick="
								lightbox( 
									`'. $pasta . $img['imagem'] .'`, 
									`imagem`,
									``,
									``,
									'. $imgAnterior .',
									'. $imgAtual .', 
									'. $imgProxima .', 
									'. $imgPrimeira .', 
									'. $imgUltima .'
								)
							"
						></div>
						';
						
						$count_galeria++;
						
					}
					
				}
				
			?>
			
		</div>
		
	</div>
	
</section>

<script>

let counter = <?php echo $count_galeria ?>;

if( counter == 0 ){
	
	document.querySelector('.galerias-item-counter').innerHTML = 'Nenhuma imagem encontrada.';
	
}

if( counter == 1 ){
	
	document.querySelector('.galerias-item-counter').innerHTML = '1 imagem encontrada.';
	
}

if( counter > 1 ){
	
	document.querySelector('.galerias-item-counter').innerHTML = counter +' imagens encontradas.';
	
}

<!-- Start - LIGHTBOX !-->
function lightbox( 
	conteudo, 
	tipo,
	titulo,
	footer,
	id_img_anterior,
	id_img_atual,
	id_img_proxima,
	id_img_primeira, 
	id_img_ultima
){
	
	let lightbox = document.querySelector('.lightbox');
	lightbox.classList.add("on");
	
	lightbox.innerHTML = '';
	
	if( tipo == 'imagem' ){
		
		lightbox.innerHTML = ''+
		'<div '+
			'class="lightbox-escurecer" '+
			'onclick="fecharLightbox()"'+
		'>'+
			'<div class="lightbox-fechar"><svg 	xmlns="http://www.w3.org/2000/svg"	viewBox="0 0 492 492"><path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872	c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872	c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052	L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116	c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952	c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116	c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/></svg></div>'+
		'</div>'+
		'<div class="lightbox-campo transparente">'+
			'<div class="lightbox-btn-esq" onclick="anteriorImg('+ id_img_anterior +', '+ id_img_primeira +', '+ id_img_ultima +' )"><span class="material-symbols-outlined">chevron_left</span></div>'+
			'<div class="lightbox-imagem">'+
				'<a href="'+ conteudo +'" target="_blank">'+
					'<img src="'+ conteudo +'" />'+
				'</a>'+
			'</div>'+
			'<div class="lightbox-btn-dir" onclick="proximaImg('+ id_img_proxima +', '+ id_img_primeira +', '+ id_img_ultima +' )"><span class="material-symbols-outlined">chevron_right</span></div>'+
		'</div>'+
		'';
		
	}
	
	if( tipo == 'texto' ){
		
		let montarLightbox = '';
		
		montarLightbox += ''+
		'<div '+
			'class="lightbox-escurecer" '+
			'onclick="fecharLightbox()"'+
		'>'+
			'<div class="lightbox-fechar"><svg 	xmlns="http://www.w3.org/2000/svg"	viewBox="0 0 492 492"><path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872	c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872	c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052	L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116	c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952	c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116	c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/></svg></div>'+
		'</div>'+
		'<div class="lightbox-campo">'+
			'';
		
			if( titulo != '' ){ montarLightbox += '<div class="lightbox-titulo">'+ titulo +'</div>'; }
			if( conteudo != '' ){ montarLightbox += '<div class="lightbox-conteudo">'+ conteudo +'</div>'; }
			if( footer != '' ){ montarLightbox += '<div class="lightbox-footer">'+ footer +'</div>'; }
			
			montarLightbox += ''+
		'</div>'+
		'';
		
		lightbox.innerHTML = montarLightbox;
		
	}
	
}

function fecharLightbox(){

	document.querySelector('.lightbox').innerHTML = '';
	document.querySelector('.lightbox').classList.remove("on");
	
}
<!-- End - LIGHTBOX !-->

<!-- Start - NAVEGAR ENTRE AS IMAGENS !-->
function anteriorImg( id, primeira, ultima ){
	
	//console.log( 'anteriorImg' ); 
	//console.log( 'id', id ); 
	
	document.querySelector('.lightbox-campo').innerHTML = '';

	var formData = new FormData();
	formData.append( 'id', id );
	formData.append( 'primeira', primeira );
	formData.append( 'ultima', ultima );

	var xhr = new XMLHttpRequest();
	xhr.open( 'POST', 'controller/galeriaBuscarID.php', true );

	xhr.onreadystatechange = function(){
		
		if( 
			xhr.status === 200 
			&& xhr.readyState == 4
		){
			
			console.log( 'anteriorImg() xhr.responseText', xhr.responseText );
			
			document.querySelector('.lightbox-campo').innerHTML = xhr.responseText;
			
		}
		
	};

	xhr.send( formData );
	
}

function proximaImg( id, primeira, ultima ){
	
	//console.log( 'proximaImg' ); 
	//console.log( 'id', id ); 
	
	document.querySelector('.lightbox-campo').innerHTML = '';

	var formData = new FormData();
	formData.append( 'id', id );
	formData.append( 'primeira', primeira );
	formData.append( 'ultima', ultima );

	var xhr = new XMLHttpRequest();
	xhr.open( 'POST', 'controller/galeriaBuscarID.php', true );

	xhr.onreadystatechange = function(){
		
		if( 
			xhr.status === 200 
			&& xhr.readyState == 4
		){
			
			console.log( 'proximaImg() xhr.responseText', xhr.responseText );
			
			document.querySelector('.lightbox-campo').innerHTML = xhr.responseText;
			
		}
		
	};

	xhr.send( formData );

}
<!-- End - NAVEGAR ENTRE AS IMAGENS !-->

</script>
<!-- End - view/galerias-item.php !-->