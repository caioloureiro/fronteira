<!-- Start - view/home-videos.php !-->
<?php 

require 'model/videos.php';

$youtube_home_video_destaque_categorias = '';

foreach( $videos_array as $video ){

	if( 
		$video['destaque'] == 1
		&& $video['ordem'] == 1
		&& $video['rascunho'] == 0
	){
		
		$youtube_home_video_destaque = $video['codigo']; 
		$youtube_home_video_destaque_nome = $video['nome']; 
		$youtube_home_video_destaque_data = $video['data']; 
		$youtube_home_video_destaque_cat = $video['categorias']; 
		
		$cat_array = explode( ';', trim( strip_tags( $youtube_home_video_destaque_cat ) ) );
		
		foreach( $cat_array as $cat ){

			$youtube_home_video_destaque_categorias .= $cat .' | ';
			
		}
		
	}
	
	if( 
		$video['destaque'] == 1
		&& $video['ordem'] == 2
		&& $video['rascunho'] == 0
	){
		
		$youtube_home_video_01 = $video['codigo'];
		
	}
	if( 
		$video['destaque'] == 1
		&& $video['ordem'] == 3
		&& $video['rascunho'] == 0
	){
		
		$youtube_home_video_02 = $video['codigo'];
		
	}
	if( 
		$video['destaque'] == 1
		&& $video['ordem'] == 4
		&& $video['rascunho'] == 0
	){
		
		$youtube_home_video_03 = $video['codigo'];
		
	}

}

?>

<style><?php require 'css/home-videos.css'; ?></style>

<section class="home-videos">
	
	<div class="box">
		
		<div class="home-titulo-campo">
			<div class="home-titulo-icone"><span class="material-symbols-outlined">movie_info</span></div>
			<div class="home-titulo">Galeria de Vídeos</div>
			<a href="galeria-de-videos"><?php require 'view/btnVerMais.php'; ?></a>
		</div>
		
		<div class="home-videos-campo">
			
			<div class="home-videos-video">
			
				<iframe 
					src="https://www.youtube.com/embed/<?php echo $youtube_home_video_destaque ?>" 
					frameborder="0" 
					allow="
						accelerometer; 
						autoplay; 
						clipboard-write; 
						encrypted-media; 
						gyroscope; 
						picture-in-picture
					" 
					allowfullscreen
				></iframe>
				
			</div>
			
			<div class="home-videos-col">
				
				<div class="home-videos-data"><?php echo data( $youtube_home_video_destaque_data ) ?></div>
				<div class="home-videos-titulo"><span><?php echo $youtube_home_video_destaque_nome ?></span></div>
				<div class="home-videos-descricao"><?php echo $youtube_home_video_destaque_categorias ?></div>
				<div class="home-videos-assista">Assista também</div>
				<div class="home-videos-proximos">
					<div class="home-videos-thumb" style="background-image:url( https://img.youtube.com/vi/<?php echo $youtube_home_video_01 ?>/hqdefault.jpg )">
						<a href="https://www.youtube.com/watch?v=<?php echo $youtube_home_video_01 ?>" target="_blank">
							<span class="material-symbols-outlined">play_circle</span>
						</a>
					</div>
					<div class="home-videos-thumb" style="background-image:url( https://img.youtube.com/vi/<?php echo $youtube_home_video_02 ?>/hqdefault.jpg )">
						<a href="https://www.youtube.com/watch?v=<?php echo $youtube_home_video_01 ?>" target="_blank">
							<span class="material-symbols-outlined">play_circle</span>
						</a>
					</div>
					<div class="home-videos-thumb" style="background-image:url( https://img.youtube.com/vi/<?php echo $youtube_home_video_03 ?>/hqdefault.jpg )">
						<a href="https://www.youtube.com/watch?v=<?php echo $youtube_home_video_01 ?>" target="_blank">
							<span class="material-symbols-outlined">play_circle</span>
						</a>
					</div>
				</div>
				
			</div>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/home-videos.php !-->