<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');
require '../../../controller/funcoes.php';

//dd( $_GET );

$get_array = explode( '/', trim( strip_tags( $_GET['arquivo'] ) ) );
//dd( $get_array );

$raiz = '../../../../';
$pasta = $get_array[1];
$arquivo = $get_array[2];
//dd( $arquivo );

$zip = new ZipArchive();

$local = $raiz . $pasta .'/';

$arquivo_array = explode( '.', trim( strip_tags( $arquivo ) ) );
//dd( $arquivo_array );

$nome_do_zip = $arquivo_array[0] .'.zip';
//dd( $nome_do_zip );

$caminho_arquivo_zip = 'arquivos_zip/'. $nome_do_zip;

if( $zip->open( $caminho_arquivo_zip, \ZipArchive::CREATE ) ){
	
	$zip->addFile( $local . $arquivo, $arquivo );
	
	$zip->close();
	
}

if( file_exists( $caminho_arquivo_zip ) ){
	
	header( "Content-Type: application/zip" );
	header( "Content-Disposition: attachment;filename=". $nome_do_zip );
	readfile( $caminho_arquivo_zip );
	
	unlink( $caminho_arquivo_zip );
	
}

echo'<script>window.location.href = "../../../matriz?pagina=backup_db";</script>';

?>