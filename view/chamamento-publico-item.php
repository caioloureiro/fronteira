<!-- Start - view/chamamento-publico-item.php !-->
<?php

require 'model/chamamento_publico.php';
require 'model/downloads.php';
require 'model/editais.php';

$chamamento_existe = 0;
$chamamento_id = '';
$chamamento_titulo = '';
$chamamento_data = '';
$chamamento_categorias = '';
$chamamento_situacao = '';
$chamamento_modalidade = '';
$chamamento_numero = '';
$chamamento_processo = '';
$chamamento_encerramento = '';
$chamamento_local = '';
$chamamento_descricao = '';

foreach( $chamamento_publico_array as $item ){
	
	if( $item['id'] == $_GET['id'] ){
		
		$chamamento_existe = 1;
		$chamamento_id = $item['id'];
		$chamamento_titulo = $item['titulo'];
		if( $item['data'] != '' ){ $chamamento_data = data_tempo( $item['data'] ); }
		if( $item['categorias'] != '' ){ $chamamento_categorias = $item['categorias']; }
		if( $item['situacao'] != '' ){ $chamamento_situacao = $item['situacao']; }
		if( $item['modalidade'] != '' ){ $chamamento_modalidade = $item['modalidade']; }
		if( $item['numero'] != '' ){ $chamamento_numero = $item['numero']; }
		if( $item['processo'] != '' ){ $chamamento_processo = $item['processo']; }
		if( $item['encerramento'] != '' ){ $chamamento_encerramento = data_tempo( $item['encerramento'] ); }
		if( $item['local'] != '' ){ $chamamento_local = $item['local']; }
		if( $item['descricao'] != '' ){ $chamamento_descricao = $item['descricao']; }
		
	}

}

?>

<style><?php require 'css/chamamento-publico-item.css'; ?></style>

<section class="chamamento-publico-item">
	
	<div class="box">
		
		<a href="chamamento-publico"><div class="voltar">voltar</div></a>
		
		<div class="chamamento-publico-item-campo" id="ler_texto">
		
			<div class="chamamento-publico-item-titulo"><span><?php echo $chamamento_titulo ?></span></div>
			
			<?php
				
				echo'
				<div class="chamamento-publico-item-linha">
					<div class="col15 chamamento-publico-item-realce">Data Publicação:</div>
					<div class="col35">'. $chamamento_data .'</div>
				</div>
				';
				
				if( $chamamento_encerramento != '' ){
					
					echo'
					<div class="chamamento-publico-item-linha">
						<div class="col15 chamamento-publico-item-realce">Encerramento em:</div>
						<div class="col35">'. $chamamento_encerramento .'</div>
					</div>
					';
					
				}
				
				if( $chamamento_situacao != '' ){
					
					echo'
					<div class="chamamento-publico-item-linha">
						<div class="col15 chamamento-publico-item-realce">Situação:</div>
						<div class="col85">'. $chamamento_situacao .'</div>
					</div>
					';
					
				}
				
				if( $chamamento_processo != '' ){
					
					echo'
					<div class="chamamento-publico-item-linha">
						<div class="col15 chamamento-publico-item-realce">Processo:</div>
						<div class="col85">'. $chamamento_processo .'</div>
					</div>
					';
					
				}
				
				if( $chamamento_numero != '' ){
					
					echo'
					<div class="chamamento-publico-item-linha">
						<div class="col15 chamamento-publico-item-realce">Número:</div>
						<div class="col85">'. $chamamento_numero .'</div>
					</div>
					';
					
				}
				
				if( $chamamento_local != '' ){
					
					echo'
					<div class="chamamento-publico-item-linha">
						<div class="col15 chamamento-publico-item-realce">Local:</div>
						<div class="col85">'. $chamamento_local .'</div>
					</div>
					';
					
				}
				
				if( $chamamento_categorias != '' ){
					
					echo'
					<div class="chamamento-publico-item-linha">
						<div class="col15 chamamento-publico-item-realce">Categoria:</div>
						<div class="col85">'. $chamamento_categorias .'</div>
					</div>
					';
					
				}
				
				if( $chamamento_descricao != '' ){
					
					echo'
					<div class="chamamento-publico-item-linha">
						<div class="col100 chamamento-publico-item-realce">Descrição:</div>
					</div>

					<div class="chamamento-publico-item-descricao">'. $chamamento_descricao .'</div>
					';
					
				}
				
				$nome_arquivo = '';
				
				if( $chamamento_existe == 1 ){
				
					foreach( $editais_array as $edital ){
						
						if( $edital['modalidade_item_id'] == $_GET['id'] ){
							
							$nome_arquivo = '';
							
							foreach( $downloads_array_total as $download ){

								if( $download['id'] == $edital['modalidade_arquivo_id'] ){
									
									echo'<script> console.log("$download[arquivo]: '. $download['arquivo'] .'"); </script>'; //die();
									$nome_arquivo = $download['arquivo'];
									
								}
								
							}
							
							echo '
							<div 
								class="chamamento-publico-download-item" 
								title="Proposta de convocatória"
							>
								<a 
									href="arquivos/'. $nome_arquivo .'" 
									target="_blank"
								>
									<div class="chamamento-publico-download-icone" alt="icone pdf download de arquivos">'; require 'img/pdf.svg'; echo'</div>
									<div class="chamamento-publico-download-nome">'. $edital['nome'] .'</div>
									<div class="chamamento-publico-download-btn">Download</div>
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
<!-- End - view/chamamento-publico-item.php !-->