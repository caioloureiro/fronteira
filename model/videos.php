<?php

$sql_videos = "SELECT * FROM videos WHERE ativo = 1";

$videos_tabela = $conn->query( $sql_videos );

$videos_array = array();

while( $videos_montado = $videos_tabela->fetch_assoc() ){
	
	$videos_array[] = $videos_montado;
	
}

//dd( $videos_array );

$sql_listaVideos = "SELECT * FROM videos WHERE ativo = 1 ORDER BY id DESC LIMIT 20";

$listaVideos_tabela = $conn->query( $sql_listaVideos );

$listaVideos_array = array();

while( $listaVideos_montado = $listaVideos_tabela->fetch_assoc() ){
	
	$listaVideos_array[] = $listaVideos_montado;
	
}

//dd( $listaVideos_array );

?>