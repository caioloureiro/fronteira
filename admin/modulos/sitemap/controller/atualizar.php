<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

$raiz_site = '../../../../';
$raiz_admin = '../../../../';

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}
require $raiz_site .'controller/funcoes.php';
require $raiz_site .'model/paginas.php';
require $raiz_site .'model/paginas_fixas.php';
require $raiz_site .'model/noticias.php';

$site = 'https://www.cidade.sp.gov.br/';

$ano = date('Y');
$mes = date('m');
$dia = date('d');
$hora = date('H');
$min = date('m');
$sec = date('s');

$data = $ano .'-'. $mes .'-'. $dia .'T'. $hora .':'. $min .':'. $sec .'+00:00';

header( 'Content-type: application/xml; charset="UTF-8"', true );

$xml = '
<urlset
	xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="
		http://www.sitemaps.org/schemas/sitemap/0.9
		http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
	"
>
	
	<url>
		<loc>'. $site .'</loc>
		<lastmod>'. $data .'</lastmod>
		<changefreq>weekly</changefreq>
		<priority>1.00</priority>
	</url>
	';
	
	foreach( $paginas as $pag ){

		$xml .= '
		<url>
			<loc>'. $site . $pag['pagina'] .'</loc>
			<lastmod>'. $data .'</lastmod>
			<changefreq>weekly</changefreq>
			<priority>0.9</priority>
		</url>
		';
		
	}
	
	foreach( $paginas_fixas as $pagFix ){

		$xml .= '
		<url>
			<loc>'. $site . $pagFix['pagina'] .'</loc>
			<lastmod>'. $data .'</lastmod>
			<changefreq>weekly</changefreq>
			<priority>0.9</priority>
		</url>
		';
		
	}
	
	foreach( $noticias_array as $not ){
		
		$letra = htmlspecialchars( '&', ENT_XML1, 'UTF-8' );
		$link = $site .'noticia'. $letra .'id='. $not['id'] . $letra .'titulo='. renomear( $not['titulo'] );
		
		$xml .= '
		<url>
			<loc>'. $link .'</loc>
			<lastmod>'. $data .'</lastmod>
			<changefreq>weekly</changefreq>
			<priority>0.9</priority>
		</url>
		';
		
	}
	
	$xml .= '
</urlset>
';

//echo $xml; die();

$arquivo = $raiz_site .'sitemap.xml';

$fp = fopen( $arquivo, "w+" );

fwrite( $fp, $xml );

fclose( $fp );

?>