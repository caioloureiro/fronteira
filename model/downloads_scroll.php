<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require 'conexao-off.php';

}else{
	
	require 'conexao-on.php';
	
}

require '../controller/funcoes.php';

//echo $_POST['pagina_counter'];

$itens_por_vez = 30;

$pagina_atual = $_POST['pagina_counter'];
$final = $itens_por_vez * $pagina_atual;

$ini = $final - $itens_por_vez;

//echo 'de '. $ini .' até '. $final .' '; exit;

// Verificar se há filtro de categoria via POST
$filtro_categoria = '';
if(isset($_POST['categoria']) && !empty($_POST['categoria'])) {
	$categoria_slug = trim($_POST['categoria']);
	
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
		$categoria_nome = $categoria_data['nome'];
		
		// Filtrar downloads que contém essa categoria
		$filtro_categoria = " AND (categorias LIKE '%;" . $conn->real_escape_string($categoria_nome) . ";%' 
								  OR categorias LIKE '" . $conn->real_escape_string($categoria_nome) . ";%'
								  OR categorias LIKE '%;" . $conn->real_escape_string($categoria_nome) . "'
								  OR categorias = '" . $conn->real_escape_string($categoria_nome) . "')";
	}
	$stmt_cat->close();
}

$sql_downloads_scroll = "SELECT * FROM downloads WHERE ativo = 1" . $filtro_categoria . " ORDER BY id DESC LIMIT ". $itens_por_vez ." OFFSET ". $ini;

//echo $sql_downloads_scroll; exit;

$downloads_scroll_tabela = $conn->query( $sql_downloads_scroll );

$downloads_scroll_array = array();

while( $downloads_scroll_montado = $downloads_scroll_tabela->fetch_assoc() ){
	
	$downloads_scroll_array[] = $downloads_scroll_montado;
	
}

$html = '';

foreach( $downloads_scroll_array as $item ){
	
	$data = date( 'd/m/Y', strtotime( $item['data'] ) );
	
	// Processar categorias - verificar se são IDs numéricos ou nomes
	$categorias_raw = explode( ';', trim( strip_tags( $item['categorias'] ) ) );
	$categorias = array();
	
	foreach($categorias_raw as $cat) {
		$cat = trim($cat);
		if(!empty($cat)) {
			// Se for número, buscar nome na tabela categorias
			if(is_numeric($cat)) {
				$sql_cat = "SELECT nome FROM categorias WHERE id = " . intval($cat) . " AND ativo = 1";
				$result_cat = $conn->query($sql_cat);
				if($result_cat && $result_cat->num_rows > 0) {
					$cat_data = $result_cat->fetch_assoc();
					$categorias[] = $cat_data['nome'];
				}
			} else {
				// Já é nome, usar direto
				$categorias[] = $cat;
			}
		}
	}

	$html .= '
	<div class="downloads-item">
	
		<a 
			href="arquivos/'. $item['arquivo'] .'" 
			target="_blank"
		>
		
			<div class="col20">
				<div class="downloads-thumb-campo">
					<div class="downloads-thumb">
						<span class="material-symbols-outlined">picture_as_pdf</span>
					</div>
				</div>
			</div>
			<div class="col80">
			
				<div class="downloads-linha">
				
					<div class="downloads-titulo"><span>'. $item['id'] .' - '. $item['nome'] .'</span></div>
					
					<div class="downloads-btn">
						<div class="downloads-btn-icone">
							<span class="material-symbols-outlined">download</span>
						</div>
						<div class="downloads-btn-nome">Acessar</div>
					</div>
					
				</div>
				
				<div class="downloads-linha dados">
					<div class="downloads-dado">
						<div class="downloads-dado-icone">
							<span class="material-symbols-outlined">calendar_month</span>
						</div>
						<div class="downloads-dado-item"><strong>Postagem:</strong> '. $data .'</div>
					</div>
					<div class="downloads-dado">
						<div class="downloads-dado-icone">
							<span class="material-symbols-outlined">tag</span>
						</div>
						
						<div class="downloads-dado-item downloads_categorias">
						
							<span>
							
								<div class="downloads-txt"><strong>Categorias:</strong></div>
								
								';

									foreach( $categorias as $categoria ){
	
										$html .= '<div class="downloads-tag">'. $categoria .'</div>';
										
									}
									
								$html .= '
								
							</span>
							
						</div>
						
					</div>
				</div>
				
			</div>
			
		</a>
		
	</div>
	';

}

//$html .= '<p>CARREGANDO PÁGINA '. ( $_POST['pagina_counter'] +1 ) .'...</p>';

echo $html;

?>