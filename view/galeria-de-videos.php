<!-- Start - view/galeria-de-videos.php !-->
<?php 
require 'model/videos.php';

$count_video = 0;
$counterHTML =  'Nenhum vídeo encontrado.';

if( count( $videos_array ) == 1 ){ $counterHTML =  '1 vídeo encontrado.'; }
if( count( $videos_array ) > 1 ){ $counterHTML =  count( $videos_array ) .' vídeos encontrados.'; }

$videos_array = array_reverse( $videos_array );

?>

<style><?php require 'css/galeria-de-videos.css'; ?></style>

<section class="videos">
	
	<div class="box">
		
		<div class="videos-counter"><?php echo $counterHTML ?></div>
		
		<div class="videos-campo">
			
			<?php
				
				foreach( $videos_array as $video ){
					
					if( 
						$video['destaque'] == 1
						&& $video['ordem'] == 1
						&& $video['rascunho'] == 0
					){

						echo '
						<div 
							class="videos-item"
							style="background-image:url( https://img.youtube.com/vi/'. $video['codigo'] .'/hqdefault.jpg )"
							title="'. $video['nome'] .'"
						>
							<a 
								href="https://www.youtube.com/watch?v='. $video['codigo'] .'"
								target="_blank"
							>
								<span class="material-symbols-outlined">play_circle</span>
							</a>
						</div>
						';
						
					}
					
					if( 
						$video['destaque'] == 1
						&& $video['ordem'] == 2
						&& $video['rascunho'] == 0
					){

						echo '
						<div 
							class="videos-item"
							style="background-image:url( https://img.youtube.com/vi/'. $video['codigo'] .'/hqdefault.jpg )"
							title="'. $video['nome'] .'"
						>
							<a 
								href="https://www.youtube.com/watch?v='. $video['codigo'] .'"
								target="_blank"
							>
								<span class="material-symbols-outlined">play_circle</span>
							</a>
						</div>
						';
						
					}
					
					if( 
						$video['destaque'] == 1
						&& $video['ordem'] == 3
						&& $video['rascunho'] == 0
					){

						echo '
						<div 
							class="videos-item"
							style="background-image:url( https://img.youtube.com/vi/'. $video['codigo'] .'/hqdefault.jpg )"
							title="'. $video['nome'] .'"
						>
							<a 
								href="https://www.youtube.com/watch?v='. $video['codigo'] .'"
								target="_blank"
							>
								<span class="material-symbols-outlined">play_circle</span>
							</a>
						</div>
						';
						
					}
					
					if( 
						$video['destaque'] == 1
						&& $video['ordem'] == 4
						&& $video['rascunho'] == 0
					){

						echo '
						<div 
							class="videos-item"
							style="background-image:url( https://img.youtube.com/vi/'. $video['codigo'] .'/hqdefault.jpg )"
							title="'. $video['nome'] .'"
						>
							<a 
								href="https://www.youtube.com/watch?v='. $video['codigo'] .'"
								target="_blank"
							>
								<span class="material-symbols-outlined">play_circle</span>
							</a>
						</div>
						';
						
					}
					
				}
			
				foreach( $listaVideos_array as $video ){
					
					if( 
						$video['destaque'] == 0 
						&& $video['rascunho'] == 0
					){

						echo '
						<div 
							class="videos-item"
							style="background-image:url( https://img.youtube.com/vi/'. $video['codigo'] .'/hqdefault.jpg )"
							title="'. $video['nome'] .'"
						>
							<a 
								href="https://www.youtube.com/watch?v='. $video['codigo'] .'"
								target="_blank"
							>
								<span class="material-symbols-outlined">play_circle</span>
							</a>
						</div>
						';
						
					}
					
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
let videos_campo = document.querySelector('.videos-campo');

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
		
		pagina_counter++;
		
		var formData = new FormData();
		formData.append( 'pagina_counter', pagina_counter );
		
		var xhr = new XMLHttpRequest();
		xhr.open( 'POST', 'controller/videos_scroll.php', true );
		
		xhr.onreadystatechange = function(){
			
			if( 
				xhr.status === 200 
				&& xhr.readyState == 4
			){
				
				//console.log( xhr.responseText );
				videos_campo.innerHTML += xhr.responseText;
				
			}
			
		};
		
		xhr.send( formData );
		
	}
	
});
/*End - Efeitos de Scroll*/

</script>
<!-- End - view/galeria-de-videos.php !-->