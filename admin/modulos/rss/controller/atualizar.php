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
<rss version="2.0">
	<channel>
		<title>Notícias de cidade - SP</title>
		<link>'. $site .'</link>
		<description>RSS do portal de cidade - SP</description>
		<docs>'. $site .'</docs>
		';
		
		foreach( $noticias_array as $not ){
			
			$letra = htmlspecialchars( '&', ENT_XML1, 'UTF-8' );
			$link = $site .'noticia'. $letra .'id='. $not['id'] . $letra .'titulo='. renomear( $not['titulo'] );
			
			$xml .= '
			<item>
				<title>'. 
					str_replace( 
						array(
							'  ',
							'<',
							'>',
							'&',
							"'",
							'{',
							'}',
							'*',
						), 
						array( ' ' ), 
						$not['titulo'] 
					) 
				.'</title>
				<link>'. $link .'</link>
				<description>'. 
					str_replace( 
						array(
							'  ',
							'<',
							'>',
							'&',
							"'",
							'{',
							'}',
							'*',
						), 
						array( ' ' ), 
						$not['subtitulo'] 
					) 
				.'</description>
			</item>
			';
			
		}
		
		$xml .='
	</channel>
</rss>
';

//echo $xml; die();

$arquivo = $raiz_site .'rss.xml';

$fp = fopen( $arquivo, "w+" );

fwrite( $fp, $xml );

fclose( $fp );

?>