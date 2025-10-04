<!-- Start - view/acesso-protocolo-home.php !-->
<?php

require 'model/esic.php';

function data_tempo02($data) {
	if (empty($data)) return '';
	
	$data_obj = DateTime::createFromFormat('Y-m-d H:i:s.u', $data);
	if (!$data_obj) {
		$data_obj = DateTime::createFromFormat('Y-m-d H:i:s', $data);
	}
	
	if ($data_obj) {
		return $data_obj->format('d/m/Y \à\s H:i');
	}
	
	return $data;
}

$encontrado = 0;
$html = '<p>Não existe procotolo compatível com esta solicitação.</p>';

//dd( $_POST );

foreach( $esic_array as $esic ){

	if(
		$_POST['protocolo'] == $esic['codigo']
		&& $_POST['email'] == $esic['email']
	){
		
		$html = '
			<div class="col40">
			
				<div class="formularios-titulo"><strong>Número</strong> do Protocolo</div>
				<div class="formularios-linha">Sua chave de acesso a este protocolo:</div>
				
				<h3>'. $esic['codigo'] .'</h3>
				
				<div class="formularios-separador"></div>
				
				<div class="formularios-titulo"><strong>Solicitante</strong> do Protocolo</div>
				
				<h3>'. $esic['nome'] .'</h3>
				<div class="formularios-linha">'. $esic['email'] .'</div>
				
			</div>
			<div class="col60">
			
				<div class="formularios-titulo"><strong>Histórico</strong> das mensagens</div>
				
				<div class="formularios-linha"><strong>Tipo da solicitação: </strong>'. $esic['tipo'] .'</div>
				
				<div class="formularios-separador"></div>
		';
		
		// Loop através de todas as mensagens do mesmo protocolo/email
		$primeira_iteracao = true;
		foreach( $esic_array as $historico ){
			if( $historico['codigo'] == $esic['codigo'] && $historico['email'] == $esic['email'] ){
				
				if(!$primeira_iteracao) {
					$html .= '
					<div class="formularios-separador"></div>
					<div class="formularios-separador"></div>
					';
				}
				
				$html .= '
				<div class="formularios-linha"><strong>Mensagem enviada em '. data_tempo02( $historico['data'] ) .': </strong></div>
				<h3>'. $historico['mensagem'] .'</h3>
				
				<div class="formularios-separador"></div>
				
				<div class="formularios-linha"><strong>Resposta da prefeitura: </strong></div>
				'. $historico['resposta'] .'
				';
				
				$primeira_iteracao = false;
			}
		}
		
		$html .= '
				<div class="formularios-separador"></div>
				
				<form method="POST">
					<div class="formularios-linha">Digite aqui sua interação: </div>
					<div class="formularios-linha">
						<span>
							<textarea 
								name="interacao"
								required
							></textarea>
						</span>
					</div>
					
					<div class="formularios-linha">
						<button class="contato-form-button" type="submit">Enviar</button>
					</div>
				</form>
			</div>
		';
		
		break; // Sai do loop após encontrar o protocolo
		
	}

}

?>

<style>
	<?php 
		require 'css/formularios.css'; 
		require 'css/acesso-protocolo-home.css'; 
	?>
</style>

<section class="acesso-protocolo-home">
	
	<div class="box">
		
		<?php 
			echo $pagina['texto'];
			echo $html;
		?>
		
	</div>
	
</section>
<!-- End - view/acesso-protocolo-home.php !-->