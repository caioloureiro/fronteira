<!-- start - view/popup.php !-->
<?php 
require 'model/popup_paginas.php'; 
require 'model/paginas.php'; 

$check_local = '';

if( count($_GET) == 0 ){ $check_local = 'home'; }
if( 
	count($_GET) > 0 
	&& $_GET['pagina'] != 'noticia'
	&& $_GET['pagina'] != 'secretarias'
){ $check_local = 'pagina'; }

if( 
	count($_GET) > 0 
	&& $_GET['pagina'] == 'noticia'
	&& $_GET['pagina'] != 'secretarias'
){ $check_local = 'noticia'; }

if( 
	count($_GET) > 0 
	&& $_GET['pagina'] != 'noticia'
	&& $_GET['pagina'] == 'secretarias'
){ $check_local = 'secretaria'; }

//echo'<script> alert("'. $check_local .'"); </script>';

//dd($_GET);

function montar_html( $id, $alvo, $popup_paginas_array ){
	
	foreach( $popup_paginas_array as $pop ){
		
		if( 
			$pop['alvo'] == $alvo 
			&& $pop['alvo_id'] == $id 
		){
			
			echo'	
			<style>'; require 'css/popup.css'; echo'</style>	
			
			<div class="popup-escurecer '; if( $pop['ativado'] == 1 ){ echo'on'; } echo'">
				<div class="popup-escurecer-fechar">'; require 'img/fechar.svg'; echo'</div>
			</div>

			<div 
				class="
				popup-item '; 
					if( $pop['tipo'] == 'imagem' ){ echo'transparente popup-somenteimagem '; } 
					if( $pop['ativado'] == 1 ){ echo'on'; } 
					echo'
				"
			>'. $pop['conteudo'] .'</div>

			<script>
				let popup_escurecer = document.querySelector(".popup-escurecer");
				let popup_item = document.querySelector(".popup-item");

				popup_escurecer.addEventListener("click", function() {
					popup_escurecer.classList.remove("on");
					popup_item.classList.remove("on");
				});
			</script>
			';
			
		}
		
	}
	
}

if( $check_local == 'pagina' ){
	
	$check_pagina_id = 0;
	
	foreach( $paginas as $pg ){
		
		if( 
			isset($_GET['pagina'])
			&& $_GET['pagina'] == $pg['pagina'] 
		){
			
			$check_pagina_id = $pg['id'];
			
		}
		
	}
	
	//SE ID FOR 0 AINDA É UMA PÁGINA FIXA
	if( $check_pagina_id == 0 ){
		
		//echo'<script> alert("Página Fixa - check_pagina_id: '. $check_pagina_id .'"); </script>';
		
		$check_pf_id = 0;
		
		foreach( $paginas_fixas as $pf ){
		
			if( 
				isset($_GET['pagina'])
				&& $_GET['pagina'] == $pf['pagina'] 
			){
				
				$check_pf_id = $pf['id'];
				
			}
			
		}
		
		montar_html( $check_pf_id, 'pagina_fixa', $popup_paginas_array );
		
	}
	else{
		
		//echo'<script> alert("Página - check_pagina_id: '. $check_pagina_id .'"); </script>';
		
		montar_html( $check_pagina_id, 'pagina', $popup_paginas_array );
		
	}
	
}

if( $check_local == 'noticia' ){
	
	//echo'<script> alert("Notícia"); </script>';
	
	montar_html( $_GET['id'], 'noticia', $popup_paginas_array );
	
}

if( $check_local == 'secretaria' ){
	
	$check_sec_id = 0;
	
	foreach( $secretarias_array as $sec ){
		
		if( 
			isset($_GET['pagina'])
			&& $_GET['secretaria'] == $sec['pagina'] 
		){
			
			$check_sec_id = $sec['id'];
			
		}
		
	}
	
	//echo'<script> alert("Secretaria - check_sec_id: '. $check_sec_id .'"); </script>';
	
	montar_html( $check_sec_id, 'secretaria', $popup_paginas_array );
	
}

?>
<!-- end - view/popup.php !-->