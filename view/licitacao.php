<!-- Start - view/licitacao.php !-->
<?php

require 'model/licitacoes.php';
require 'model/licitacoes_anexos.php';
require 'model/licitacoes_vencedores.php';

$licitacao_existe = 0;
$licitacao_id = '';
$licitacao_nome = '';
$licitacao_objeto = '';
$licitacao_texto = '';
$licitacao_publicacao = '';
$licitacao_abertura = '';
$licitacao_numero = '';
$licitacao_situacao = '';
$licitacao_mensagem = '';
$licitacao_categoria = '';
$licitacao_arquivo = '';

foreach( $licitacoes_array as $item ){
	
	if( $item['id'] == $_GET['id'] ){
		
		$licitacao_existe = 1;
		$licitacao_id = $item['id'];
		$licitacao_nome = $item['nome'];
		$licitacao_objeto = $item['objeto'];
		$licitacao_texto = $item['texto'];
		$licitacao_publicacao = data_tempo( $item['publicacao'] );
		$licitacao_abertura = data_tempo( $item['abertura'] );
		$licitacao_numero = $item['numero'];
		$licitacao_situacao = $item['situacao'];
		$licitacao_mensagem = $item['mensagem'];
		$licitacao_categoria = $item['categoria'];
		$licitacao_arquivo = $item['edital'];
		// Adiciona uploads/ se não existir no início
		if (!empty($licitacao_arquivo) && strpos($licitacao_arquivo, 'uploads/') !== 0) {
		    $licitacao_arquivo = 'uploads/' . $licitacao_arquivo;
		}
		
	}

}

?>

<style><?php require 'css/licitacao.css'; ?></style>

<section class="licitacao">
	
	<div class="box">
		
		<a href="licitacoes"><div class="voltar">voltar</div></a>
		
		<div class="licitacao-campo" id="ler_texto">

			<?php
				
				echo'
				<div class="licitacao-linha">
					<div class="col15 licitacao-realce">Nome:</div>
					<div class="col35">'. $licitacao_nome .'</div>
				</div>
				
				<div class="licitacao-linha">
					<div class="col15 licitacao-realce">Publicação:</div>
					<div class="col35">'. $licitacao_publicacao .'</div>
					<div class="col15 licitacao-realce">Abertura:</div>
					<div class="col35">'. $licitacao_abertura .'</div>
				</div>
				';
				
				if( $licitacao_situacao != '' ){
					
					echo'
					<div class="licitacao-linha">
						<div class="col15 licitacao-realce">Situação:</div>
						<div class="col85">'. $licitacao_situacao .'</div>
					</div>
					';
					
				}
				
				if( $licitacao_numero != '' ){
					
					echo'
					<div class="licitacao-linha">
						<div class="col15 licitacao-realce">Número:</div>
						<div class="col85">'. $licitacao_numero .'</div>
					</div>
					';
					
				}
				
				if( $licitacao_categoria != '' ){
					
					echo'
					<div class="licitacao-linha">
						<div class="col15 licitacao-realce">Categoria:</div>
						<div class="col85">'. $licitacao_categoria .'</div>
					</div>
					';
					
				}
				
				foreach( $licitacoes_vencedores_array as $vencedor ){
					
					if( $vencedor['licitacao'] == $_GET['id'] ){
						
						echo'
						<div class="licitacao-linha">
							<div class="col15 licitacao-realce">Vencedor:</div>
							<div class="col85">'. $vencedor['nome'] .'</div>
						</div>
						<div class="licitacao-linha">
							<div class="col15 licitacao-realce">Documento:</div>
							<div class="col85">'. $vencedor['documento'] .'</div>
						</div>
						<div class="licitacao-linha">
							<div class="col15 licitacao-realce">Itens:</div>
							<div class="col85">'. $vencedor['item'] .'</div>
						</div>
						<div class="licitacao-linha">
							<div class="col15 licitacao-realce">Valor:</div>
							<div class="col85">R$ '. $vencedor['valor'] .'</div>
						</div>
						';
						
					}
					
				}
				
				if( $licitacao_mensagem != '' ){
					
					echo'					
					<div class="licitacao-linha">
						<div class="col100 licitacao-realce">Mensagem:</div>
					</div>

					<div class="licitacao-descricao col100">'. $licitacao_mensagem .'</div>
					';
					
				}
				
				if( $licitacao_objeto != '' ){
					
					echo'					
					<div class="licitacao-linha">
						<div class="col100 licitacao-realce">Objeto:</div>
					</div>

					<div class="licitacao-descricao col100">'. $licitacao_objeto .'</div>
					';
					
				}
				
				if( $licitacao_texto != '' ){
					
					echo'
					<div class="separador"></div>
					
					<div class="licitacao-linha">
						<div class="col100 licitacao-realce">Descrição:</div>
					</div>

					<div class="licitacao-descricao col100">'. $licitacao_texto .'</div>
					';
					
				}
				
				echo'<div class="separador"></div>';
				
				// CORREÇÃO: Mostrar "Edital indisponível" quando estiver vazio
				if( !empty($licitacao_arquivo) ){
					
					$licitacao_arquivo_set = '';
					
					$licitacao_arquivo_array = explode( '/', trim( strip_tags( $licitacao_arquivo ) ) );
					
					$licitacao_arquivo_set = $licitacao_arquivo_array[ count($licitacao_arquivo_array) -1 ];
					
					echo '
					<div 
						class="licitacao-download-item" 
						title="Edital"
					>
						<a 
							href="'. $licitacao_arquivo .'" 
							target="_blank"
						>
							<div class="licitacao-download-icone" alt="icone pdf download de arquivos">'; require 'img/pdf.svg'; echo'</div>
							<div class="licitacao-download-nome">'. $licitacao_arquivo_set .'</div>
							<div class="licitacao-download-btn">Download</div>
						</a>
					</div>
					';
					
				} else {
					
					echo '
					<div 
						class="licitacao-download-item licitacao-indisponivel" 
						title="Edital indisponível"
					>
						<div class="licitacao-download-icone" alt="icone pdf indisponível">'; require 'img/pdf.svg'; echo'</div>
						<div class="licitacao-download-nome">Edital indisponível</div>
						<div class="licitacao-download-btn indisponivel">Indisponível</div>
					</div>
					';
					
				}
				
				$nome_arquivo = '';
				
				if( $licitacao_existe == 1 ){
				
					foreach( $licitacoes_anexos_array as $anexo ){
						
						if( $anexo['licitacao'] == $_GET['id'] ){
							
							$nome_arquivo = '-';
							
							if( $anexo['nome'] == '' ){ 
								$nome_arquivo = $anexo['arquivo']; 
							} else { 
								$nome_arquivo = $anexo['nome']; 
							}
							
							// CORREÇÃO: Aplicar a mesma lógica do arquivo principal aos anexos
							$arquivo_path = $anexo['arquivo'];
							if (!empty($arquivo_path) && strpos($arquivo_path, 'uploads/') !== 0) {
							    $arquivo_path = 'uploads/' . $arquivo_path;
							}
							
							// Verificar se o arquivo do anexo existe
							if( !empty($arquivo_path) ) {
								echo '
								<div 
									class="licitacao-download-item" 
									title="Proposta de convocatória"
								>
									<a 
										href="'. $arquivo_path .'" 
										target="_blank"
									>
										<div class="licitacao-download-icone" alt="icone pdf download de arquivos">'; require 'img/pdf.svg'; echo'</div>
										<div class="licitacao-download-nome">'. htmlspecialchars($nome_arquivo) .'</div>
										<div class="licitacao-download-btn">Download</div>
									</a>
								</div>
								';
							} else {
								echo '
								<div 
									class="licitacao-download-item licitacao-indisponivel" 
									title="Anexo indisponível"
								>
									<div class="licitacao-download-icone" alt="icone pdf indisponível">'; require 'img/pdf.svg'; echo'</div>
									<div class="licitacao-download-nome">'. htmlspecialchars($nome_arquivo) .' (Indisponível)</div>
									<div class="licitacao-download-btn indisponivel">Indisponível</div>
								</div>
								';
							}
							
						}
						
					}
					
				}
				
			?>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/licitacao.php !-->