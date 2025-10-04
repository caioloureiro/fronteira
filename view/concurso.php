<!-- Start - view/concurso.php !-->
<?php

require 'model/concursos.php';
require 'model/concursos_anexos.php';

$concurso_existe = 0;
$concurso_id = '';
$concurso_nome = '';
$concurso_inicio = '';
$concurso_fim = '';
$concurso_nomer = '';
$concurso_numero = '';
$concurso_situacao = '';
$concurso_mensagem = '';
$concurso_categoria = '';
$concurso_edital = '';
$concurso_resumo = '';
$concurso_texto = '';

foreach( $concursos_array as $item ){
	
	if( $item['id'] == $_GET['id'] ){
		
		$concurso_existe = 1;
		$concurso_id = $item['id'];
		$concurso_nome = $item['nome'];
		if( $item['inicio'] != '' ){ $concurso_inicio = data_tempo( $item['inicio'] ); }
		if( $item['fim'] != '' ){ $concurso_fim = data_tempo( $item['fim'] ); }
		$concurso_numero = $item['numero'];
		$concurso_situacao = $item['situacao'];
		$concurso_mensagem = $item['mensagem'];
		$concurso_categoria = $item['categoria'];
		$concurso_edital = $item['edital'];
		$concurso_resumo = $item['resumo'];
		$concurso_texto = $item['texto'];
		
	}

}

?>

<style><?php require 'css/concurso.css'; ?></style>

<section class="concurso">
	
	<div class="box">
		
		<a href="concursos"><div class="voltar">voltar</div></a>
		
		<div class="concurso-campo" id="ler_texto">

			<?php
				
				echo'
				<div class="concurso-linha">
					<div class="col15 concurso-realce">Concurso:</div>
					<div class="col35">'. $concurso_nome .'</div>
				</div>
				
				<div class="concurso-linha">
					<div class="col15 concurso-realce">Data Publicação:</div>
					<div class="col35">'. $concurso_inicio .'</div>
				</div>
				';
				
				if( $concurso_fim != '' ){
					
					echo'
					<div class="concurso-linha">
						<div class="col15 concurso-realce">Encerramento em:</div>
						<div class="col35">'. $concurso_fim .'</div>
					</div>
					';
					
				}
				
				if( $concurso_situacao != '' ){
					
					echo'
					<div class="concurso-linha">
						<div class="col15 concurso-realce">Situação:</div>
						<div class="col85">'. $concurso_situacao .'</div>
					</div>
					';
					
				}
				
				if( $concurso_numero != '' ){
					
					echo'
					<div class="concurso-linha">
						<div class="col15 concurso-realce">Número:</div>
						<div class="col85">'. $concurso_numero .'</div>
					</div>
					';
					
				}
				
				if( $concurso_categoria != '' ){
					
					echo'
					<div class="concurso-linha">
						<div class="col15 concurso-realce">Categoria:</div>
						<div class="col85">'. $concurso_categoria .'</div>
					</div>
					';
					
				}
				
				if( $concurso_mensagem != '' ){
					
					echo'
					<div class="separador"></div>
					
					<div class="concurso-linha">
						<div class="col100 concurso-realce">Mensagem:</div>
					</div>

					<div class="concurso-descricao col100">'. $concurso_mensagem .'</div>
					';
					
				}
				
				if( $concurso_resumo != '' ){
					
					echo'
					<div class="separador"></div>
					
					<div class="concurso-linha">
						<div class="col100 concurso-realce">Resumo:</div>
					</div>

					<div class="concurso-descricao col100">'. $concurso_resumo .'</div>
					';
					
				}
				
				if( $concurso_texto != '' ){
					
					echo'
					<div class="separador"></div>
					
					<div class="concurso-linha">
						<div class="col100 concurso-realce">Descrição:</div>
					</div>

					<div class="concurso-descricao col100">'. $concurso_texto .'</div>
					';
					
				}
				
				echo'<div class="separador"></div>';
				
				if( $concurso_edital != '' ){
					
					$concurso_edital_arquivo = '';
					
					$concurso_edital_array = explode( '/', trim( strip_tags( $concurso_edital ) ) );
					
					$concurso_edital_arquivo = $concurso_edital_array[ count($concurso_edital_array) -1 ];
					
					echo '
					<div 
						class="concurso-download-item" 
						title="Edital"
					>
						<a 
							href="'. $concurso_edital .'" 
							target="_blank"
						>
							<div class="concurso-download-icone" alt="icone pdf download de arquivos">'; require 'img/pdf.svg'; echo'</div>
							<div class="concurso-download-nome">'. $concurso_edital_arquivo .'</div>
							<div class="concurso-download-btn">Download</div>
						</a>
					</div>
					';
					
				}
				
				$nome_arquivo = '';
				
				if( $concurso_existe == 1 ){
				
					foreach( $concursos_anexos_array as $anexo ){
						
						if( $anexo['concurso'] == $_GET['id'] ){
							
							$nome_arquivo = '-';
							
							if( $anexo['nome'] == '' ){ $nome_arquivo = $anexo['arquivo']; }
							else{ $nome_arquivo = htmlspecialchars( $anexo['nome'] ); }
							
							echo '
							<div 
								class="concurso-download-item" 
								title="Proposta de convocatória"
							>
								<a 
									href="uploads/'. $anexo['arquivo'] .'" 
									target="_blank"
								>
									<div class="concurso-download-icone" alt="icone pdf download de arquivos">'; require 'img/pdf.svg'; echo'</div>
									<div class="concurso-download-nome">'. $nome_arquivo .'</div>
									<div class="concurso-download-btn">Download</div>
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
<!-- End - view/concurso.php !-->