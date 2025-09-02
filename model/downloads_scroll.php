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

$sql_downloads_scroll = "SELECT * FROM downloads ORDER BY id DESC LIMIT ". $itens_por_vez ." OFFSET ". $ini;

//echo $sql_downloads_scroll; exit;

$downloads_scroll_tabela = $conn->query( $sql_downloads_scroll );

$downloads_scroll_array = array();

while( $downloads_scroll_montado = $downloads_scroll_tabela->fetch_assoc() ){
	
	$downloads_scroll_array[] = $downloads_scroll_montado;
	
}

$html = '';

foreach( $downloads_scroll_array as $item ){
	
	$data = date( 'd/m/Y', strtotime( $item['data'] ) );
	
	$categorias = explode( ';', trim( strip_tags( $item['categorias'] ) ) ); }

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