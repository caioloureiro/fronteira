<?php

//echo'galeriaBuscarID';

//echo $_POST['id'];
//echo $_POST['primeira'];
//echo $_POST['ultima'];

$raiz_site = '../';

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}

require $raiz_site .'model/galeria.php'; 
require $raiz_site .'model/galeria_imagens.php'; 

$count_galeria = 0;

$pasta = 'galeria/';

$html = '';

foreach( $galeria_imagens_array as $index => $img ){
	
	if( $img['id'] == $_POST['id'] ){
		
		$imgAnterior = 0;
		$imgAtual = $img['id'];
		$imgProxima = 0;
		
		$imgAnterior = $galeria_imagens_array[$index - 1]['id'];
		$imgProxima = $galeria_imagens_array[$index + 1]['id'];
		
		$html .= '<div class="lightbox-btn-esq" onclick="anteriorImg('. $imgAnterior .', '. $_POST['primeira'] .', '. $_POST['ultima'] .')"><span class="material-symbols-outlined">chevron_left</span></div>';
		
		$html .= '
		<div class="lightbox-imagem">
			<a href="'. $pasta . $img['imagem'] .'" target="_blank">
				<img src="'. $pasta . $img['imagem'] .'" />
			</a>
		</div>
		';
		
		$html .= '<div class="lightbox-btn-dir" onclick="proximaImg('. $imgProxima .', '. $_POST['primeira'] .', '. $_POST['ultima'] .')"><span class="material-symbols-outlined">chevron_right</span></div>';
		
		$count_galeria++;
		
	}
	
}

echo $html;

?>
