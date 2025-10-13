<?php

// Verificar se há filtro de categoria via URL
$filtro_categoria = '';
$categoria_nome = '';

if(isset($_GET['categoria']) && !empty($_GET['categoria'])) {
	$categoria_slug = trim($_GET['categoria']);
	
	// Buscar o ID da categoria pelo nome/slug
	$categoria_slug_limpo = str_replace('-', ' ', $categoria_slug);
	$sql_categoria = "SELECT id, nome FROM categorias WHERE ativo = 1 AND (LOWER(REPLACE(nome, ' ', '-')) = ? OR LOWER(nome) LIKE ?)";
	$stmt_cat = $conn->prepare($sql_categoria);
	$categoria_like = '%' . $categoria_slug_limpo . '%';
	$stmt_cat->bind_param("ss", $categoria_slug, $categoria_like);
	$stmt_cat->execute();
	$result_cat = $stmt_cat->get_result();
	
	if($result_cat->num_rows > 0) {
		$categoria_data = $result_cat->fetch_assoc();
		$categoria_id = $categoria_data['id'];
		$categoria_nome = $categoria_data['nome'];
		
		// Filtrar downloads que contém essa categoria (categorias são separadas por ;)
		$filtro_categoria = " AND (categorias LIKE '%;" . $conn->real_escape_string($categoria_nome) . ";%' 
								  OR categorias LIKE '" . $conn->real_escape_string($categoria_nome) . ";%'
								  OR categorias LIKE '%;" . $conn->real_escape_string($categoria_nome) . "'
								  OR categorias = '" . $conn->real_escape_string($categoria_nome) . "')";
	}
	$stmt_cat->close();
}

$sql_downloads = "SELECT * FROM downloads WHERE ativo = 1" . $filtro_categoria . " ORDER BY id DESC LIMIT 30";

$downloads_tabela = $conn->query( $sql_downloads );

$downloads_array = array();

while( $downloads_montado = $downloads_tabela->fetch_assoc() ){
	
	$downloads_array[] = $downloads_montado;
	
}

//dd( $downloads_array );

$sql_downloads_destaque = "SELECT * FROM (SELECT * FROM downloads WHERE ativo = 1" . $filtro_categoria . " ORDER BY id DESC LIMIT 10) g ORDER BY g.id";

$downloads_destaque_tabela = $conn->query( $sql_downloads_destaque );

$downloads_destaque_array = array();

while( $downloads_destaque_montado = $downloads_destaque_tabela->fetch_assoc() ){
	
	$downloads_destaque_array[] = $downloads_destaque_montado;
	
}

//dd( $downloads_destaque_array );

$sql_downloads_total = "SELECT * FROM downloads WHERE ativo = 1" . $filtro_categoria;

$downloads_tabela_total = $conn->query( $sql_downloads_total );

$downloads_array_total = array();

while( $downloads_montado_total = $downloads_tabela_total->fetch_assoc() ){
	
	$downloads_array_total[] = $downloads_montado_total;
	
}

//dd( $downloads_array_total );

?>