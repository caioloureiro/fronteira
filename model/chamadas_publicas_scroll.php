<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require 'conexao-off.php';

}else{
	
	require 'conexao-on.php';
	
}

require '../controller/funcoes.php';

//echo $_POST['pagina_counter']; exit;

$itens_por_vez = 5;

$pagina_atual = $_POST['pagina_counter'];
$final = $itens_por_vez * $pagina_atual;

$ini = $final - $itens_por_vez;

//echo 'de '. $ini .' até '. $final .' '; exit;

$sql_chamadas_publicas_scroll = "SELECT * FROM chamadas_publicas ORDER BY id DESC LIMIT ". $itens_por_vez ." OFFSET ". $ini;

//echo $sql_chamadas_publicas_scroll; exit;

$chamadas_publicas_scroll_tabela = $conn->query( $sql_chamadas_publicas_scroll );

$chamadas_publicas_scroll_array = array();

while( $chamadas_publicas_scroll_montado = $chamadas_publicas_scroll_tabela->fetch_assoc() ){
	
	$chamadas_publicas_scroll_array[] = $chamadas_publicas_scroll_montado;
	
}

$html = '';

foreach( $chamadas_publicas_scroll_array as $item ){
	
	$data = date( 'd/m/Y', strtotime( $item['data'] ) );
	
	$categorias = explode( ';', trim( strip_tags( $item['categorias'] ) ) );

	$html .= '
	<div class="chamadas-publicas-item">
	
		<a 
			href="arquivos/'. $item['arquivo'] .'" 
			target="_blank"
		>
		
			<div class="col20">
				<div class="chamadas-publicas-thumb-campo">
					<div class="chamadas-publicas-thumb">
						<span class="material-symbols-outlined">picture_as_pdf</span>
					</div>
				</div>
			</div>
			<div class="col80">
			
				<div class="chamadas-publicas-linha">
				
					<div class="chamadas-publicas-titulo"><span>'. $item['titulo'] .'</span></div>
					
					<div class="chamadas-publicas-btn">
						<div class="chamadas-publicas-btn-icone">
							<span class="material-symbols-outlined">download</span>
						</div>
						<div class="chamadas-publicas-btn-nome">Acessar</div>
					</div>
					
				</div>
				
				<div class="chamadas-publicas-linha dados">
				
					<div class="chamadas-publicas-dado">
						<div class="chamadas-publicas-dado-icone">
							<span class="material-symbols-outlined">calendar_month</span>
						</div>
						<div class="chamadas-publicas-dado-item"><strong>Postagem:</strong> '. $data .'</div>
					</div>
					
					<div class="chamadas-publicas-dado">
					
						<div class="chamadas-publicas-dado-icone">
							<span class="material-symbols-outlined">tag</span>
						</div>
						
						<div class="chamadas-publicas-dado-item chamadas_publicas_categorias">
						
							<span>
							
								<div class="chamadas-publicas-txt"><strong>Categorias:</strong></div>
								
								';

									foreach( $categorias as $categoria ){

										$html .= '<div class="chamadas-publicas-tag">'. $categoria .'</div>';
										
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