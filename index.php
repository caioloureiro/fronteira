<!DOCTYPE html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">

	<head>
	
		<?php
			require "routes/main.php";
			require "routes/model.php";
			require "view/seo.php" 
		?>
		
	</head>

	<body>
		
		<?php require "view/google-analytics.php" ?>
		
		<style><?php require 'routes/css.php'; ?></style>
		
		<?php require "view/scripts-top.php" ?>

		<main class="container" itemscope>
			
			<?php
				
				if( !isset( $_GET['pagina'] ) ){
					
					//echo'<script> alert("home"); </script>';
					require 'routes/home.php';
					
				}else{
					
					$pagina_existe = 'nao';
					
					/* Start - PAGINAS FIXAS*/
					foreach( $paginas_fixas as $pagina ){

						if( $_GET['pagina'] == $pagina['nome'] ){
							
							//echo'<script> alert("'. $pagina['nome'] .'"); </script>';
							require 'routes/'. $pagina['nome'] .'.php';
							$pagina_existe = 'sim';
							
						}
						
					}
					/*End - PAGINAS FIXAS*/
					
					/* Start - PAGINAS DINÂMICAS - DENTRO DO BANCO OU ARRAY */
					foreach( $paginas as $pagina ){
						
						//echo'<script> alert("'.$_GET['pagina'].'"); </script>';
						
						if( $_GET['pagina'] == $pagina['pagina'] ){
							
							//echo'<script> alert("'. $pagina['titulo'] .'"); </script>';
							$titulo_da_pagina = $pagina['titulo'];
							require 'routes/conteudo.php';
							$pagina_existe = 'sim';
							
						}
						
					}
					/* End - PAGINAS DINÂMICAS - DENTRO DO BANCO OU ARRAY */
					
					if( $pagina_existe == 'nao' ){ 
						
						//echo'<script> alert("'. $_GET['pagina'] .'"); </script>';
						require 'routes/404.php'; 
						
					} //PÁGINA NÃO EXISTE
					
				}
				
			?>
			
		</main>
		
		<?php 
			require "view/scripts-bottom.php";
			require "view/vlibras.php";
			require "view/popup-lgpd.php";
			require "view/popup_paginas.php";
		?>
		
		<style><?php require 'css/modo_escuro.css'; ?></style>
		
	</body>

</html>