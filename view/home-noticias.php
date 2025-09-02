<!-- Start - view/home-noticias.php !-->
<?php 
require 'model/noticias.php'; 

$count_noticias = 0;
$count_destaques = 0;

foreach( $noticias_array as $notCount ){
	
	if( $notCount['destaque'] == 1 ){
		
		$count_destaques++;
		
	}
	
}

$hoje = date( 'Y-m-d H:i:s' );

echo'<script> console.log("$count_destaques: '. $count_destaques .'"); </script>';

?>

<style>
	<?php 
		require 'css/home-noticias.css'; 
		require 'css/home-titulo.css'; 
	?>
</style>

<section class="home-noticias">
	
	<div class="box">
		
		<a href="news">
			<div class="home-titulo-campo">
				<div class="home-titulo-icone"><span class="material-symbols-outlined">newspaper</span></div>
				<div class="home-titulo">Notícias</div>
				<?php require 'view/btnVerMais.php'; ?>
			</div>
		</a>
		
		<div class="home-noticias-campo">
			
			<?php
			
				foreach( $periodo_eleitoral_array as $periodo ){
					
					if( $periodo['ativado'] == 0 ){
						
						//SE EXISTIREM 4 DESTAQUES
						if( $count_destaques == 4 ){
							
							foreach( $noticias_array as $noticia ){
								
								if( 
									$noticia['destaque'] == 1
									&& $noticia['destaque_ordem'] == 1
									&& $noticia['publicado'] == 1
									&& $hoje >= $noticia['data_publicacao']
								){
									
									$categorias_destaque01_array = explode( ';', trim( strip_tags( $noticia['categorias'] ) ) );
									
									echo'
									<div 
										class="home-noticias-destaque" 
										style="background-image:url( &apos;noticias-img/'. $noticia['imagem'] .'&apos; )"
									>
										<a href="noticia&id='. $noticia['id'] .'&titulo='. renomear( $noticia['titulo'] ) .'">
											<div class="home-noticias-destaque-lente">
												<div class="home-noticias-destaque-lente-campo">
													<div class="home-noticias-destaque-linha">
														<div class="home-noticias-destaque-data">'. data_tempo( $noticia['data_publicacao'] ) .'</div>
														<div class="home-noticias-destaque-categoria">'. $categorias_destaque01_array[0] .'</div>
													</div>
													<div class="home-noticias-destaque-titulo">'. $noticia['titulo'] .'</div>
												</div>
											</div>
										</a>
									</div>
									';
									
								}
								
							}
							
							echo'<div class="home-noticias-esq">';
							
								usort($noticias_array, function( $a, $b ){//Função responsável por ordenar

									$al = mb_strtolower($a['destaque_ordem']);
									$bl = mb_strtolower($b['destaque_ordem']);
									
									if ($al == $bl){
										return 0;
									}
									
									return ($bl < $al) ? +1 : -1;
									
								});
								
								foreach( $noticias_array as $noticia ){

									if( 
										$noticia['destaque'] == 1
										&& $noticia['destaque_ordem'] == 2
										&& $noticia['publicado'] == 1
										&& $hoje >= $noticia['data_publicacao']
									){
										
										$categorias_destaque02_array = explode( ';', trim( strip_tags( $noticia['categorias'] ) ) );
										
										echo'
										<div class="home-noticias-item ordem_'. $noticia['destaque_ordem'] .'">
											<a href="noticia&id='. $noticia['id'] .'&titulo='. renomear( $noticia['titulo'] ) .'">
												<div class="home-noticias-item-img" style="background-image:url( &apos;noticias-img/'. $noticia['imagem'] .'&apos; )"></div>
												<div class="home-noticias-item-campo">
													<div class="home-noticias-item-linha">
														<div class="home-noticias-item-data">'. data_tempo( $noticia['data_publicacao'] ) .'</div>
														<div class="home-noticias-item-categoria">'. $categorias_destaque02_array[0] .'</div>
													</div>
													<div class="home-noticias-item-titulo"><span>'. $noticia['titulo'] .'</span></div>
												</div>
											</a>
										</div>
										';
										
										$count_noticias++;
										
									}
									
									if( 
										$noticia['destaque'] == 1
										&& $noticia['destaque_ordem'] == 3
										&& $noticia['publicado'] == 1
										&& $hoje >= $noticia['data_publicacao']
									){
										
										$categorias_destaque03_array = explode( ';', trim( strip_tags( $noticia['categorias'] ) ) );
									
										echo'
										<div class="home-noticias-item ordem_'. $noticia['destaque_ordem'] .'">
											<a href="noticia&id='. $noticia['id'] .'&titulo='. renomear( $noticia['titulo'] ) .'">
												<div class="home-noticias-item-img" style="background-image:url( &apos;noticias-img/'. $noticia['imagem'] .'&apos; )"></div>
												<div class="home-noticias-item-campo">
													<div class="home-noticias-item-linha">
														<div class="home-noticias-item-data">'. data_tempo( $noticia['data_publicacao'] ) .'</div>
														<div class="home-noticias-item-categoria">'. $categorias_destaque03_array[0] .'</div>
													</div>
													<div class="home-noticias-item-titulo"><span>'. $noticia['titulo'] .'</span></div>
												</div>
											</a>
										</div>
										';
										
										$count_noticias++;
										
									}
									
									if( 
										$noticia['destaque'] == 1
										&& $noticia['destaque_ordem'] == 4
										&& $noticia['publicado'] == 1
										&& $hoje >= $noticia['data_publicacao']
									){
										
										$categorias_destaque04_array = explode( ';', trim( strip_tags( $noticia['categorias'] ) ) );
									
										echo'
										<div class="home-noticias-item ordem_'. $noticia['destaque_ordem'] .'">
											<a href="noticia&id='. $noticia['id'] .'&titulo='. renomear( $noticia['titulo'] ) .'">
												<div class="home-noticias-item-img" style="background-image:url( &apos;noticias-img/'. $noticia['imagem'] .'&apos; )"></div>
												<div class="home-noticias-item-campo">
													<div class="home-noticias-item-linha">
														<div class="home-noticias-item-data">'. data_tempo( $noticia['data_publicacao'] ) .'</div>
														<div class="home-noticias-item-categoria">'. $categorias_destaque04_array[0] .'</div>
													</div>
													<div class="home-noticias-item-titulo"><span>'. $noticia['titulo'] .'</span></div>
												</div>
											</a>
										</div>
										';
										
										$count_noticias++;
										
									}
									
								}
								
							echo'</div>';
							
						}
						
						//SE A QUANTIDADE DE DESTAQUES FOR MENOR QUE 4
						if( $count_destaques < 4 ){
							
							$noticias_array = array_reverse( $noticias_array );
							
							//dd( $noticias_array );
							
							$noticias_final = array();
							$noticia_final_i = 0;
							
							foreach( $noticias_array as $noticia ){
								
								if( 
									$hoje >= $noticia['data_publicacao'] 
									&& $noticia_final_i < 4
								){
									
									$noticia_final_i++;
	
									if( $periodo_eleitoral == 1 ){
										
										if( $noticia['utilidade_publica'] == 1 ){
											
											$noticias_final[] = $noticia;
											
										}
										
									}
									
									if( $periodo_eleitoral == 0 ){
										
										$noticias_final[] = $noticia;
										
									}
									
								}
								
							}
							
							//dd( $noticias_final );
							
							if( $count_destaques == 0 ){
								
								$count_noticias++;
								
								$categorias_destaque01_array = explode( ';', trim( strip_tags( $noticias_final[0]['categorias'] ) ) );
								$categorias_destaque02_array = explode( ';', trim( strip_tags( $noticias_final[1]['categorias'] ) ) );
								$categorias_destaque03_array = explode( ';', trim( strip_tags( $noticias_final[2]['categorias'] ) ) );
								$categorias_destaque04_array = explode( ';', trim( strip_tags( $noticias_final[3]['categorias'] ) ) );
								
								$noticia01_id = $noticias_final[0]['id'];
								$noticia02_id = $noticias_final[1]['id'];
								$noticia03_id = $noticias_final[2]['id'];
								$noticia04_id = $noticias_final[3]['id'];
								
								$noticia01_imagem = $noticias_final[0]['imagem'];
								$noticia02_imagem = $noticias_final[1]['imagem'];
								$noticia03_imagem = $noticias_final[2]['imagem'];
								$noticia04_imagem = $noticias_final[3]['imagem'];
								
								$noticia01_titulo = $noticias_final[0]['titulo'];
								$noticia02_titulo = $noticias_final[1]['titulo'];
								$noticia03_titulo = $noticias_final[2]['titulo'];
								$noticia04_titulo = $noticias_final[3]['titulo'];
								
								$noticia01_data_publicacao = $noticias_final[0]['data_publicacao'];
								$noticia02_data_publicacao = $noticias_final[1]['data_publicacao'];
								$noticia03_data_publicacao = $noticias_final[2]['data_publicacao'];
								$noticia04_data_publicacao = $noticias_final[3]['data_publicacao'];
								
								echo'
								<div 
									class="home-noticias-destaque" 
									style="background-image:url( &apos;noticias-img/'. $noticia01_imagem .'&apos; )"
								>
									<a href="noticia&id='. $noticia01_id .'&titulo='. renomear( $noticia01_titulo ) .'">
										<div class="home-noticias-destaque-lente">
											<div class="home-noticias-destaque-lente-campo">
												<div class="home-noticias-destaque-linha">
													<div class="home-noticias-destaque-data">'. data_tempo( $noticia01_data_publicacao ) .'</div>
													<div class="home-noticias-destaque-categoria">'. $categorias_destaque01_array[0] .'</div>
												</div>
												<div class="home-noticias-destaque-titulo">'. $noticia01_titulo .'</div>
											</div>
										</div>
									</a>
								</div>
								';
								
								echo'<div class="home-noticias-esq">';
								
									echo'
									<div class="home-noticias-item">
										<a href="noticia&id='. $noticia02_id .'&titulo='. renomear( $noticia02_titulo ) .'">
											<div class="home-noticias-item-img" style="background-image:url( &apos;noticias-img/'. $noticia02_imagem .'&apos; )"></div>
											<div class="home-noticias-item-campo">
												<div class="home-noticias-item-linha">
													<div class="home-noticias-item-data">'. data_tempo( $noticia02_data_publicacao ) .'</div>
													<div class="home-noticias-item-categoria">'. $categorias_destaque02_array[0] .'</div>
												</div>
												<div class="home-noticias-item-titulo"><span>'. $noticia02_titulo .'</span></div>
											</div>
										</a>
									</div>
									';
									
									echo'
									<div class="home-noticias-item">
										<a href="noticia&id='. $noticia03_id .'&titulo='. renomear( $noticia03_titulo ) .'">
											<div class="home-noticias-item-img" style="background-image:url( &apos;noticias-img/'. $noticia03_imagem .'&apos; )"></div>
											<div class="home-noticias-item-campo">
												<div class="home-noticias-item-linha">
													<div class="home-noticias-item-data">'. data_tempo( $noticia03_data_publicacao ) .'</div>
													<div class="home-noticias-item-categoria">'. $categorias_destaque03_array[0] .'</div>
												</div>
												<div class="home-noticias-item-titulo"><span>'. $noticia03_titulo .'</span></div>
											</div>
										</a>
									</div>
									';
									
									echo'
									<div class="home-noticias-item">
										<a href="noticia&id='. $noticia04_id .'&titulo='. renomear( $noticia04_titulo ) .'">
											<div class="home-noticias-item-img" style="background-image:url( &apos;noticias-img/'. $noticia04_imagem .'&apos; )"></div>
											<div class="home-noticias-item-campo">
												<div class="home-noticias-item-linha">
													<div class="home-noticias-item-data">'. data_tempo( $noticia04_data_publicacao ) .'</div>
													<div class="home-noticias-item-categoria">'. $categorias_destaque04_array[0] .'</div>
												</div>
												<div class="home-noticias-item-titulo"><span>'. $noticia04_titulo .'</span></div>
											</div>
										</a>
									</div>
									';
									
								echo'</div>';
								
							}
							
							if( $count_destaques == 1 ){
								
								$count_noticias++;
								
								foreach( $noticias_array as $noticia ){
									
									if( 
										$noticia['destaque'] == 1
										&& $noticia['destaque_ordem'] == 1
										&& $noticia['publicado'] == 1
									){
										
										$categorias_destaque01_array = explode( ';', trim( strip_tags( $noticia['categorias'] ) ) );
										
										echo'
										<div 
											class="home-noticias-destaque" 
											style="background-image:url( &apos;noticias-img/'. $noticia['imagem'] .'&apos; )"
										>
											<a href="noticia&id='. $noticia['id'] .'&titulo='. renomear( $noticia['titulo'] ) .'">
												<div class="home-noticias-destaque-lente">
													<div class="home-noticias-destaque-lente-campo">
														<div class="home-noticias-destaque-linha">
															<div class="home-noticias-destaque-data">'. data_tempo( $noticia['data_publicacao'] ) .'</div>
															<div class="home-noticias-destaque-categoria">'. $categorias_destaque01_array[0] .'</div>
														</div>
														<div class="home-noticias-destaque-titulo">'. $noticia['titulo'] .'</div>
													</div>
												</div>
											</a>
										</div>
										';
										
									}
									
								}
								
								echo'<div class="home-noticias-esq">';
								
									$noticias_array = array_reverse( $noticias_array );
								
									//dd( $noticias_array );
									
									$i = 0;
									
									foreach( $noticias_array as $noticia ){
										
										if( 
											$noticia['destaque'] == 0 
											&& $hoje >= $noticia['data_publicacao']
										){
											
											if( $i < 3 ){
												
												$categorias_destaque01_array = explode( ';', trim( strip_tags( $noticia['categorias'] ) ) );
												
												echo'
												<div class="home-noticias-item">
													<a href="noticia&id='. $noticia['id'] .'&titulo='. renomear( $noticia['titulo'] ) .'">
														<div class="home-noticias-item-img" style="background-image:url( &apos;noticias-img/'. $noticia['imagem'] .'&apos; )"></div>
														<div class="home-noticias-item-campo">
															<div class="home-noticias-item-linha">
																<div class="home-noticias-item-data">'. data_tempo( $noticia['data_publicacao'] ) .'</div>
																<div class="home-noticias-item-categoria">'. $categorias_destaque01_array[0] .'</div>
															</div>
															<div class="home-noticias-item-titulo"><span>'. $noticia['titulo'] .'</span></div>
														</div>
													</a>
												</div>
												';
												
												$i++;
												
											}
											
										}
										
									}
									
								echo'</div>';
								
							}
							
							if( $count_destaques == 2 ){
								
								foreach( $noticias_array as $noticia ){
									
									if( 
										$noticia['destaque'] == 1
										&& $noticia['destaque_ordem'] == 1
										&& $noticia['publicado'] == 1
									){
										
										$categorias_destaque01_array = explode( ';', trim( strip_tags( $noticia['categorias'] ) ) );
										
										echo'
										<div 
											class="home-noticias-destaque" 
											style="background-image:url( &apos;noticias-img/'. $noticia['imagem'] .'&apos; )"
										>
											<a href="noticia&id='. $noticia['id'] .'&titulo='. renomear( $noticia['titulo'] ) .'">
												<div class="home-noticias-destaque-lente">
													<div class="home-noticias-destaque-lente-campo">
														<div class="home-noticias-destaque-linha">
															<div class="home-noticias-destaque-data">'. data_tempo( $noticia['data_publicacao'] ) .'</div>
															<div class="home-noticias-destaque-categoria">'. $categorias_destaque01_array[0] .'</div>
														</div>
														<div class="home-noticias-destaque-titulo">'. $noticia['titulo'] .'</div>
													</div>
												</div>
											</a>
										</div>
										';
										
										$count_noticias++;
										
									}
									
								}
								
								echo'<div class="home-noticias-esq">';
									
									foreach( $noticias_array as $noticia ){

										if( 
											$noticia['destaque'] == 1
											&& $noticia['destaque_ordem'] == 2
											&& $noticia['publicado'] == 1
										){
											
											$categorias_destaque02_array = explode( ';', trim( strip_tags( $noticia['categorias'] ) ) );
											
											echo'
											<div class="home-noticias-item ordem_'. $noticia['destaque_ordem'] .'">
												<a href="noticia&id='. $noticia['id'] .'&titulo='. renomear( $noticia['titulo'] ) .'">
													<div class="home-noticias-item-img" style="background-image:url( &apos;noticias-img/'. $noticia['imagem'] .'&apos; )"></div>
													<div class="home-noticias-item-campo">
														<div class="home-noticias-item-linha">
															<div class="home-noticias-item-data">'. data_tempo( $noticia['data_publicacao'] ) .'</div>
															<div class="home-noticias-item-categoria">'. $categorias_destaque02_array[0] .'</div>
														</div>
														<div class="home-noticias-item-titulo"><span>'. $noticia['titulo'] .'</span></div>
													</div>
												</a>
											</div>
											';
											
											$count_noticias++;
											
										}
										
									}
									
									$noticias_array = array_reverse( $noticias_array );
								
									//dd( $noticias_array );
									
									$i = 0;
									
									foreach( $noticias_array as $noticia ){
										
										if( 
											$noticia['destaque'] == 0 
											&& $hoje >= $noticia['data_publicacao']
										){
											
											if( $i < 2 ){
												
												$categorias_destaque01_array = explode( ';', trim( strip_tags( $noticia['categorias'] ) ) );
												
												echo'
												<div class="home-noticias-item">
													<a href="noticia&id='. $noticia['id'] .'&titulo='. renomear( $noticia['titulo'] ) .'">
														<div class="home-noticias-item-img" style="background-image:url( &apos;noticias-img/'. $noticia['imagem'] .'&apos; )"></div>
														<div class="home-noticias-item-campo">
															<div class="home-noticias-item-linha">
																<div class="home-noticias-item-data">'. data_tempo( $noticia['data_publicacao'] ) .'</div>
																<div class="home-noticias-item-categoria">'. $categorias_destaque01_array[0] .'</div>
															</div>
															<div class="home-noticias-item-titulo"><span>'. $noticia['titulo'] .'</span></div>
														</div>
													</a>
												</div>
												';
												
												$i++;
												
											}
											
										}
										
									}
									
								echo'</div>';
								
							}
							
							if( $count_destaques == 3 ){
								
								foreach( $noticias_array as $noticia ){
									
									if( 
										$noticia['destaque'] == 1
										&& $noticia['destaque_ordem'] == 1
										&& $noticia['publicado'] == 1
									){
										
										$categorias_destaque01_array = explode( ';', trim( strip_tags( $noticia['categorias'] ) ) );
										
										echo'
										<div 
											class="home-noticias-destaque" 
											style="background-image:url( &apos;noticias-img/'. $noticia['imagem'] .'&apos; )"
										>
											<a href="noticia&id='. $noticia['id'] .'&titulo='. renomear( $noticia['titulo'] ) .'">
												<div class="home-noticias-destaque-lente">
													<div class="home-noticias-destaque-lente-campo">
														<div class="home-noticias-destaque-linha">
															<div class="home-noticias-destaque-data">'. data_tempo( $noticia['data_publicacao'] ) .'</div>
															<div class="home-noticias-destaque-categoria">'. $categorias_destaque01_array[0] .'</div>
														</div>
														<div class="home-noticias-destaque-titulo">'. $noticia['titulo'] .'</div>
													</div>
												</div>
											</a>
										</div>
										';
										
										$count_noticias++;
										
									}
									
								}
								
								echo'<div class="home-noticias-esq">';
									
									foreach( $noticias_array as $noticia ){

										if( 
											$noticia['destaque'] == 1
											&& $noticia['destaque_ordem'] == 2
											&& $noticia['publicado'] == 1
										){
											
											$categorias_destaque02_array = explode( ';', trim( strip_tags( $noticia['categorias'] ) ) );
											
											echo'
											<div class="home-noticias-item ordem_'. $noticia['destaque_ordem'] .'">
												<a href="noticia&id='. $noticia['id'] .'&titulo='. renomear( $noticia['titulo'] ) .'">
													<div class="home-noticias-item-img" style="background-image:url( &apos;noticias-img/'. $noticia['imagem'] .'&apos; )"></div>
													<div class="home-noticias-item-campo">
														<div class="home-noticias-item-linha">
															<div class="home-noticias-item-data">'. data_tempo( $noticia['data_publicacao'] ) .'</div>
															<div class="home-noticias-item-categoria">'. $categorias_destaque02_array[0] .'</div>
														</div>
														<div class="home-noticias-item-titulo"><span>'. $noticia['titulo'] .'</span></div>
													</div>
												</a>
											</div>
											';
											
											$count_noticias++;
											
										}
										
										if( 
											$noticia['destaque'] == 1
											&& $noticia['destaque_ordem'] == 3
											&& $noticia['publicado'] == 1
										){
											
											$categorias_destaque03_array = explode( ';', trim( strip_tags( $noticia['categorias'] ) ) );
										
											echo'
											<div class="home-noticias-item ordem_'. $noticia['destaque_ordem'] .'">
												<a href="noticia&id='. $noticia['id'] .'&titulo='. renomear( $noticia['titulo'] ) .'">
													<div class="home-noticias-item-img" style="background-image:url( &apos;noticias-img/'. $noticia['imagem'] .'&apos; )"></div>
													<div class="home-noticias-item-campo">
														<div class="home-noticias-item-linha">
															<div class="home-noticias-item-data">'. data_tempo( $noticia['data_publicacao'] ) .'</div>
															<div class="home-noticias-item-categoria">'. $categorias_destaque03_array[0] .'</div>
														</div>
														<div class="home-noticias-item-titulo"><span>'. $noticia['titulo'] .'</span></div>
													</div>
												</a>
											</div>
											';
											
											$count_noticias++;
											
										}
										
									}
									
									$noticias_array = array_reverse( $noticias_array );
								
									//dd( $noticias_array );
									
									$i = 0;
									
									foreach( $noticias_array as $noticia ){
										
										if( 
											$noticia['destaque'] == 0 
											&& $hoje >= $noticia['data_publicacao']
										){
											
											if( $i < 1 ){
												
												$categorias_destaque01_array = explode( ';', trim( strip_tags( $noticia['categorias'] ) ) );
												
												echo'
												<div class="home-noticias-item">
													<a href="noticia&id='. $noticia['id'] .'&titulo='. renomear( $noticia['titulo'] ) .'">
														<div class="home-noticias-item-img" style="background-image:url( &apos;noticias-img/'. $noticia['imagem'] .'&apos; )"></div>
														<div class="home-noticias-item-campo">
															<div class="home-noticias-item-linha">
																<div class="home-noticias-item-data">'. data_tempo( $noticia['data_publicacao'] ) .'</div>
																<div class="home-noticias-item-categoria">'. $categorias_destaque01_array[0] .'</div>
															</div>
															<div class="home-noticias-item-titulo"><span>'. $noticia['titulo'] .'</span></div>
														</div>
													</a>
												</div>
												';
												
												$i++;
												
											}
											
										}
										
									}
									
								echo'</div>';
								
							}
							
						}
						
					}
					if( $periodo['ativado'] == 1 ){
						
						foreach( $noticias_array as $noticia ){
							
							if( 
								$noticia['destaque'] == 1
								&& $noticia['destaque_ordem'] == 1
								&& $noticia['utilidade_publica'] == 1
								&& $noticia['publicado'] == 1
							){
								
								$categorias_destaque01_array = explode( ';', trim( strip_tags( $noticia['categorias'] ) ) );
								
								echo'
								<div 
									class="home-noticias-destaque destaque_'. $noticia['destaque_ordem'] .'" 
									style="background-image:url( &apos;noticias-img/'. $noticia['imagem'] .'&apos; )"
								>
									<a href="noticia&id='. $noticia['id'] .'&titulo='. renomear( $noticia['titulo'] ) .'">
										<div class="home-noticias-destaque-lente">
											<div class="home-noticias-destaque-lente-campo">
												<div class="home-noticias-destaque-linha">
													<div class="home-noticias-destaque-data">'. data_tempo( $noticia['data_publicacao'] ) .'</div>
													<div class="home-noticias-destaque-categoria">'. $categorias_destaque01_array[0] .'</div>
												</div>
												<div class="home-noticias-destaque-titulo">'. $noticia['titulo'] .'</div>
											</div>
										</div>
									</a>
								</div>
								';
								
								$count_noticias++;
								
							}
							
						}
						
						echo'<div class="home-noticias-esq">';
							
							foreach( $noticias_array as $noticia ){

								if( 
									$noticia['destaque'] == 1
									&& $noticia['destaque_ordem'] == 2
									&& $noticia['utilidade_publica'] == 1
									&& $noticia['publicado'] == 1
								){
									
									$categorias_destaque02_array = explode( ';', trim( strip_tags( $noticia['categorias'] ) ) );
									
									echo'
									<div class="home-noticias-item destaque_'. $noticia['destaque_ordem'] .'">
										<a href="noticia&id='. $noticia['id'] .'&titulo='. renomear( $noticia['titulo'] ) .'">
											<div class="home-noticias-item-img" style="background-image:url( &apos;noticias-img/'. $noticia['imagem'] .'&apos; )"></div>
											<div class="home-noticias-item-campo">
												<div class="home-noticias-item-linha">
													<div class="home-noticias-item-data">'. data_tempo( $noticia['data_publicacao'] ) .'</div>
													<div class="home-noticias-item-categoria">'. $categorias_destaque02_array[0] .'</div>
												</div>
												<div class="home-noticias-item-titulo"><span>'. $noticia['titulo'] .'</span></div>
											</div>
										</a>
									</div>
									';
									
									$count_noticias++;
									
								}
								
								if( 
									$noticia['destaque'] == 1
									&& $noticia['destaque_ordem'] == 3
									&& $noticia['utilidade_publica'] == 1
									&& $noticia['publicado'] == 1
								){
									
									$categorias_destaque03_array = explode( ';', trim( strip_tags( $noticia['categorias'] ) ) );
								
									echo'
									<div class="home-noticias-item destaque_'. $noticia['destaque_ordem'] .'">
										<a href="noticia&id='. $noticia['id'] .'&titulo='. renomear( $noticia['titulo'] ) .'">
											<div class="home-noticias-item-img" style="background-image:url( &apos;noticias-img/'. $noticia['imagem'] .'&apos; )"></div>
											<div class="home-noticias-item-campo">
												<div class="home-noticias-item-linha">
													<div class="home-noticias-item-data">'. data_tempo( $noticia['data_publicacao'] ) .'</div>
													<div class="home-noticias-item-categoria">'. $categorias_destaque03_array[0] .'</div>
												</div>
												<div class="home-noticias-item-titulo"><span>'. $noticia['titulo'] .'</span></div>
											</div>
										</a>
									</div>
									';
									
									$count_noticias++;
									
								}
								
								if( 
									$noticia['destaque'] == 1
									&& $noticia['destaque_ordem'] == 4
									&& $noticia['utilidade_publica'] == 1
									&& $noticia['publicado'] == 1
								){
									
									$categorias_destaque04_array = explode( ';', trim( strip_tags( $noticia['categorias'] ) ) );
								
									echo'
									<div class="home-noticias-item destaque_'. $noticia['destaque_ordem'] .'">
										<a href="noticia&id='. $noticia['id'] .'&titulo='. renomear( $noticia['titulo'] ) .'">
											<div class="home-noticias-item-img" style="background-image:url( &apos;noticias-img/'. $noticia['imagem'] .'&apos; )"></div>
											<div class="home-noticias-item-campo">
												<div class="home-noticias-item-linha">
													<div class="home-noticias-item-data">'. data_tempo( $noticia['data_publicacao'] ) .'</div>
													<div class="home-noticias-item-categoria">'. $categorias_destaque04_array[0] .'</div>
												</div>
												<div class="home-noticias-item-titulo"><span>'. $noticia['titulo'] .'</span></div>
											</div>
										</a>
									</div>
									';
									
									$count_noticias++;
									
								}
								
							}
							
						echo'</div>';
						
					}
					
				}
				
				if( $count_noticias == 0 ){
					
					echo'Nenhuma notícia em destaque no momento.';
					
				}
				
			?>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/home-noticias.php !-->