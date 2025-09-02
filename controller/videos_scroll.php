<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require '../model/conexao-off.php';

}else{
	
	require '../model/conexao-on.php';
	
}

require 'funcoes.php';

//echo $_POST['pagina_counter'];

$itens_por_vez = 20;

$pagina_atual = $_POST['pagina_counter'];
$final = $itens_por_vez * $pagina_atual;

$ini = $final - $itens_por_vez;

//echo 'de '. $ini .' até '. $final .' '; exit;

$sql_listaVideos = "SELECT * FROM videos ORDER BY id DESC LIMIT ". $itens_por_vez ." OFFSET ". $ini;

//echo $sql_listaVideos; exit;

$listaVideos_tabela = $conn->query( $sql_listaVideos );

$listaVideos_array = array();

while( $listaVideos_montado = $listaVideos_tabela->fetch_assoc() ){
	
	$listaVideos_array[] = $listaVideos_montado;
	
}

$html = '';

foreach( $listaVideos_array as $video ){

	$html .= '
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

echo $html;
?>