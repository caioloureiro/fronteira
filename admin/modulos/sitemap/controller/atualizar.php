<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

$raiz_site = '../../../../';
$raiz_admin = '../../../';

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}
require $raiz_site .'controller/funcoes.php';
require $raiz_site .'model/paginas.php';
require $raiz_site .'model/paginas_fixas.php';
require $raiz_site .'model/noticias.php';

// Debug: verificar se os dados estão sendo carregados
/*
echo "Páginas: " . (isset($paginas) ? count($paginas) : '0') . "<br>";
echo "Páginas Fixas: " . (isset($paginas_fixas) ? count($paginas_fixas) : '0') . "<br>";
echo "Notícias: " . (isset($noticias_array) ? count($noticias_array) : '0') . "<br>";
die();
*/

$site = 'https://www.fronteira.mg.gov.br/';

$ano = date('Y');
$mes = date('m');
$dia = date('d');
$hora = date('H');
$min = date('i');
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
	
	// Verificar se os arrays existem antes de iterar
	if(isset($paginas) && is_array($paginas)) {
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
	}
	
	if(isset($paginas_fixas) && is_array($paginas_fixas)) {
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
	}
	
	if(isset($noticias_array) && is_array($noticias_array)) {
		foreach( $noticias_array as $not ){
			
			$letra = htmlspecialchars( '&', ENT_XML1, 'UTF-8' );
			// Criar slug amigável para URL
			$titulo_slug = mb_strtolower($not['titulo']);
			$titulo_slug = preg_replace('/[^a-z0-9\s-]/', '', $titulo_slug);
			$titulo_slug = preg_replace('/[\s-]+/', '-', $titulo_slug);
			$titulo_slug = trim($titulo_slug, '-');
			
			$link = $site .'noticia'. $letra .'id='. $not['id'] . $letra .'titulo='. $titulo_slug;
			
			$xml .= '
			<url>
				<loc>'. $link .'</loc>
				<lastmod>'. $data .'</lastmod>
				<changefreq>weekly</changefreq>
				<priority>0.9</priority>
			</url>
			';
			
		}
	}
	
	$xml .= '
</urlset>
';

//echo $xml; die();

$arquivo = $raiz_site .'sitemap.xml';

// Verificar se o diretório é gravável
if(!is_writable(dirname($arquivo))) {
	echo'<script>alert("Erro: Diretório do sitemap não tem permissão de escrita."); window.history.back();</script>';
	exit;
}

$fp = fopen( $arquivo, "w+" );

if(!$fp) {
	echo'<script>alert("Erro: Não foi possível abrir o arquivo sitemap.xml para escrita."); window.history.back();</script>';
	exit;
}

$resultado = fwrite( $fp, $xml );
fclose( $fp );

if($resultado === false) {
	echo'<script>alert("Erro: Não foi possível escrever no arquivo sitemap.xml."); window.history.back();</script>';
	exit;
}

// Log da ação
$sql_log = "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Atualizou o sitemap.xml','". date( 'Y-m-d H:i:s' ) ."')";
$conn->query($sql_log);

$conn->close();

// Sucesso
echo'<script>alert("Sitemap.xml atualizado com sucesso!"); window.location.href = "'.$raiz_admin.'matriz?pagina=sitemap";</script>';

?>