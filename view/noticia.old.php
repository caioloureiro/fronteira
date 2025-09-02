<!-- Start - view/noticia.php !-->
<?php

$noticia_id = '';
$noticia_titulo = '';
$noticia_subtitulo = '';
$noticia_data_publicacao = '';
$noticia_data_atualizacao = '';
$noticia_imagem = '';
$noticia_utilidade_publica = '';
$noticia_categorias = '';
$noticia_texto = '';
$periodo_eleitoral = 0;
$noticia_legenda = '';

foreach( $periodo_eleitoral_array as $per ){
	
	$periodo_eleitoral = $per['ativado'];
	
}

foreach( $noticias_array as $item ){
	
	if( $item['id'] == $_GET['id'] ){
		
		$noticia_id = $item['id'];
		$noticia_titulo = $item['titulo'];
		$noticia_subtitulo = $item['subtitulo'];
		$noticia_data_publicacao = $item['data_publicacao'];
		$noticia_data_atualizacao = $item['data_atualizacao'];
		$noticia_imagem = $item['imagem'];
		$noticia_utilidade_publica = $item['utilidade_publica'];
		$noticia_categorias = $item['categorias'];
		$noticia_texto = $item['texto'];
		$noticia_publicado = $item['publicado'];
		$noticia_legenda = $item['legenda'];
		
	}

}

$noticia_categorias_array = explode( ';', trim( strip_tags( $noticia_categorias ) ) );

$hoje = date( 'Y-m-d H:i:s' );

?>

<style><?php require 'css/noticia.css'; ?></style>

<section class="noticia">
	
	<div class="box">
		
		<?php 
		
			if( $hoje >= $noticia_data_publicacao ){ 
			
				if( $noticia_publicado == 1 ){ 
				
					if( $periodo_eleitoral == 0 ){ 

						echo'
						<div class="noticia-campo" id="ler_texto">
							
							<div class="noticia-linha">
								<div class="col10 noticia-realce">Publicação:</div>
								<div class="col40">'. data_tempo( $noticia_data_publicacao ) .'</div>
								
								';
							
									if( $noticia_data_publicacao != $noticia_data_atualizacao ){
										
										echo'
										<div class="col10 noticia-realce">Atualização:</div>
										<div class="col40">'. data_tempo( $noticia_data_atualizacao ) .'</div>
										';
										
									}
									
								echo'
								
							</div>
							<div class="noticia-linha">
								<div class="col10 noticia-realce">Categorias:</div>
								<div class="col90">
									';
									
									foreach( $noticia_categorias_array as $cat ){

										echo'
										<div class="noticia-categoria">'. $cat .'</div>
										';
										
									}
									
									echo'
								</div>
							</div>
							<div class="noticia-linha">
								<div class="col100">
									
									<a 
										href="noticias-img/'. $noticia_imagem .'" 
										target="_blank"
									>
										<img 
											src="noticias-img/'. $noticia_imagem .'" 
											class="noticia-img" 
										/>
										';
										
										if( $noticia_legenda != '' ){
											
											echo'<div class="noticia-legenda">'. $noticia_legenda .'</div>';
											
										}
										
										echo'
									</a>
									
								</div>
							</div>
						
							';
							
								if( $noticia_subtitulo != '' ){
									
									echo'<div class="noticia-titulo"><span>'. $noticia_subtitulo .'</span></div>';
									
								}
								
							echo'
							
							<div class="noticia-descricao">'. $noticia_texto .'</div>
							
						</div>
						';
						
					}
					
					if( $periodo_eleitoral == 1 ){ 
					
						if( $noticia_utilidade_publica == 1 ){ 

							echo'
							<div class="noticia-campo" id="ler_texto">
								
								<div class="noticia-linha">
									<div class="col10 noticia-realce">Publicação:</div>
									<div class="col40">'. data_tempo( $noticia_data_publicacao ) .'</div>
									
									';
								
										if( $noticia_data_publicacao != $noticia_data_atualizacao ){
											
											echo'
											<div class="col10 noticia-realce">Atualização:</div>
											<div class="col40">'. data_tempo( $noticia_data_atualizacao ) .'</div>
											';
											
										}
										
									echo'
									
								</div>
								<div class="noticia-linha">
									<div class="col10 noticia-realce">Categorias:</div>
									<div class="col90">'. $noticia_categorias .'</div>
								</div>
								<div class="noticia-linha">
									<div class="col100">
										
										<img 
											src="noticias-img/'. $noticia_imagem .'" 
											class="noticia-img" 
										/>
										
									</div>
								</div>
							
								';
								
									if( $noticia_subtitulo != '' ){
										
										echo'<div class="noticia-titulo"><span>'. $noticia_subtitulo .'</span></div>';
										
									}
									
								echo'
								
								<div class="noticia-descricao">'. $noticia_texto .'</div>
								
							</div>
							';
							
						}
						
						if( $noticia_utilidade_publica == 0 ){ 

							echo'
							<div class="noticia-campo" id="ler_texto">
								
								<div class="noticia-linha">
									<div class="col10 noticia-realce">Publicação:</div>
									<div class="col40">06/06/'. date('Y') .'</div>
								</div>
								<div class="noticia-descricao">
		<p>Em cumprimento à legislação eleitoral (Lei 9.504/1997), todas as publicações anteriores do Instagram da Prefeitura serão arquivadas e os comentários desabilitados de <strong>06 de julho a 06 de outubro de '. date('Y') .'.</strong> O Facebook, Youtube e Flickr serão desativados neste período.</p>
		<p>Em nosso site e no Instagram, serão publicadas apenas notícias de utilidade pública.</p>
		<p>Mas fique tranquilo: todos os serviços do nosso portal continuarão funcionando normalmente.</p>
								</div>
								
							</div>
							';
							
						}
						
					}
					
				}
				
			}
			else{
				
				echo'<script>window.location.href = "recados_raw?id=0&titulo=Notícias&mensagem=Notícia não encontrada.";</script>';
				
			}
			
		?>
		
	</div>
	
</section>
<!-- End - view/noticia.php !-->