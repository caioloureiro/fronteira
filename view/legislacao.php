<!-- Start - view/legislacao.php !-->
<?php

require 'model/legislacoes.php';
require 'model/legislacoes_anexos.php';

$legislacao_existe = 0;
$legislacao_id = '';
$legislacao_nome = '';
$legislacao_data = '';
$legislacao_texto = '';
$legislacao_categoria = '';
$legislacao_numero = '';
$legislacao_arquivo = '';

foreach( $legislacoes_array as $item ){
	
	if( $item['id'] == $_GET['id'] ){
		
		$legislacao_existe = 1;
		$legislacao_id = $item['id'];
		$legislacao_nome = $item['nome'];
		$legislacao_data = data_tempo( $item['data'] );
		$legislacao_texto = $item['texto'];
		$legislacao_categoria = $item['categoria'];
		$legislacao_numero = $item['numero'];
		$legislacao_arquivo = $item['arquivo'];
		
	}

}

?>

<style><?php require 'css/legislacao.css'; ?></style>

<section class="legislacao">
	
	<div class="box">
		
		<a href="legislacoes"><div class="voltar">voltar</div></a>
		
		<div class="legislacao-campo" id="ler_texto">

			<?php
				
				echo'
				<div class="legislacao-linha">
					<div class="col15 legislacao-realce">Nome:</div>
					<div class="col35">'. $legislacao_nome .'</div>
				</div>
				
				<div class="legislacao-linha">
					<div class="col15 legislacao-realce">Data:</div>
					<div class="col35">'. $legislacao_data .'</div>
				</div>
				';
				
				if( $legislacao_numero != '' ){
					
					echo'
					<div class="legislacao-linha">
						<div class="col15 legislacao-realce">Número:</div>
						<div class="col85">'. $legislacao_numero .'</div>
					</div>
					';
					
				}
				
				if( $legislacao_categoria != '' ){
					
					echo'
					<div class="legislacao-linha">
						<div class="col15 legislacao-realce">Categoria:</div>
						<div class="col85">'. $legislacao_categoria .'</div>
					</div>
					';
					
				}
				
				if( $legislacao_texto != '' ){
					
					echo'
					<div class="separador"></div>
					
					<div class="legislacao-linha">
						<div class="col100 legislacao-realce">Descrição:</div>
					</div>

					<div class="legislacao-descricao col100">'. $legislacao_texto .'</div>
					';
					
				}
				
				echo'<div class="separador"></div>';
				
				if( $legislacao_arquivo != '' ){
					
					$legislacao_arquivo_set = '';
					
					$legislacao_arquivo_array = explode( '/', trim( strip_tags( $legislacao_arquivo ) ) );
					
					$legislacao_arquivo_set = $legislacao_arquivo_array[ count($legislacao_arquivo_array) -1 ];
					
					echo '
					<div 
						class="legislacao-download-item" 
						title="Edital"
					>
						<a 
							href="'. $legislacao_arquivo .'" 
							target="_blank"
						>
							<div class="legislacao-download-icone" alt="icone pdf download de arquivos">'; require 'img/pdf.svg'; echo'</div>
							<div class="legislacao-download-nome">'. $legislacao_arquivo_set .'</div>
							<div class="legislacao-download-btn">Download</div>
						</a>
					</div>
					';
					
				}
				
				$nome_arquivo = '';
				
				if( $legislacao_existe == 1 ){
				
					foreach( $legislacoes_anexos_array as $anexo ){
						
						if( $anexo['legislacao'] == $_GET['id'] ){
							
							$nome_arquivo = '-';
							
							if( $anexo['nome'] == '' ){ $nome_arquivo = $anexo['arquivo']; }
							else{ $nome_arquivo = htmlspecialchars( $anexo['nome'] ); }
							
							echo '
							<div 
								class="legislacao-download-item" 
								title="Proposta de convocatória"
							>
								<a 
									href="uploads/'. $anexo['arquivo'] .'" 
									target="_blank"
								>
									<div class="legislacao-download-icone" alt="icone pdf download de arquivos">'; require 'img/pdf.svg'; echo'</div>
									<div class="legislacao-download-nome">'. $nome_arquivo .'</div>
									<div class="legislacao-download-btn">Download</div>
								</a>
							</div>
							';
							
						}
						
					}
					
				}
				
			?>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/legislacao.php !-->