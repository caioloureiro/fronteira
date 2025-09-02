<!-- Start - view/seo.php !-->
<?php 

$pasta_img = 'noticias-img/';

if( 
	!isset( $_GET['pagina'] )
	|| $_GET['pagina'] != 'noticia' 
){
	
	echo'<title>'. $head_title .'</title>';
	require "view/head.php";
	
}

if( 
	isset( $_GET['pagina'] )
	&& $_GET['pagina'] == 'noticia' 
){
	
	require 'model/noticias.php';
	
	$noticia_id = '';
	$noticia_titulo = '';
	$noticia_subtitulo = '';
	$noticia_data_publicacao = '';
	$noticia_data_atualizacao = '';
	$noticia_imagem = '';
	$noticia_utilidade_publica = '';
	$noticia_categorias = '';
	$noticia_texto = '';

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
			
		}

	}
	
	echo'
	<title>'. $noticia_titulo .'</title>
	
	<!-- Codificação de caracteres da página !-->
	<meta charset="UTF-8" />

	<!-- SEO Geral !-->
	<meta name="description" content="'.  $noticia_subtitulo .'">
	<link rel="canonical" href="'.  $head_link .'">
	<meta name="author" content="'.  $head_autor .'">
	<meta name="robots" content="index, follow">
	<meta name="copyright" content="'.  $head_link .'"/>
	<!-- <meta name="keywords" content="pacidade, chaves, SEO"> O Google não usa mais = SPAM !-->

	<!-- Schema.org !-->
	<meta itemprop="name" content="'.  $noticia_titulo .'">
	<meta itemprop="description" content="'.  $noticia_subtitulo .'">
	<meta itemprop="image" content="'. $head_link .'/'. $pasta_img . $noticia_imagem .'">

	<!-- Open Graph Facebook !-->
	<meta property="og:title" content="'.  $noticia_titulo .'">
	<meta property="og:description" content="'.  $noticia_subtitulo .'">
	<meta property="og:url" content="'.  $head_link .'">
	<meta property="og:site_name" content="'.  $head_nome .'">
	<meta property="og:type" content="website">
	<meta property="og:image" content="'.  $head_link .'/'. $pasta_img . $noticia_imagem .'">
	<meta property="og:image:type" content="image/jpeg">
	<meta property="og:image:width" content="800">
	<meta property="og:image:height" content="600">
	<meta property="og:locale" content="pt_BR">

	<!-- Twitter !-->
	<meta name="twitter:title" content="'.  $noticia_titulo .'">
	<meta name="twitter:description" content="'.  $noticia_subtitulo .'">
	<meta name="twitter:url" content="'.  $head_link .'">
	<meta name="twitter:card" content="summary">
	<meta name="twitter:image" content="'.  $head_link .'/'. $pasta_img . $noticia_imagem .'">
	<meta name="twitter:creator" content="@autor">
	<!-- <meta name="twitter:site" content="@empresa"> Caso possua página da empresa dentro do Twitter !-->

	<!-- Geral !-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Language" content="pt-br">
	<meta http-equiv="cache-control" content="no-cache" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="rating" content="general"/>
	<meta name="GOOGLEBOT" content="index, follow"/>
	<link rel="icon" type="image/png" href="'.  $head_favicon .'"/>
	';
	
	require "view/google-fonts.php"; 
	require "view/google-icons.php"; 
	
}

/*
$sql_acessos_log = "INSERT INTO acessos_log (
	horario, 
	ip, 
	url, 
	metodo, 
	navegador 
) VALUES (".
	"'". date( 'Y-m-d H:i:s' ) ."', ".
	"'". $_SERVER['REMOTE_ADDR'] ."', ".
	"'". $_SERVER['REQUEST_URI'] ."', ".
	"'". $_SERVER['REQUEST_METHOD'] ."', ".
	"'". $_SERVER['HTTP_USER_AGENT'] ."' ".
");";

//dd( $sql_acessos_log );

if ( $conn->multi_query( $sql_acessos_log ) === TRUE ) {
	
	echo'<script> console.log("Acesso à prefeitura ok."); </script>';
	
} else {

	echo'<script> console.log("ERRO em acesso à prefeitura. Erro: ' . $conn->error .'"); </script>';
	
}
*/

?>
<!-- End - view/seo.php !-->