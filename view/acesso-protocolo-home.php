<!-- Start - view/acesso-protocolo-home.php !-->
<?php

// Incluir conexão com banco de dados
if( $_SERVER['HTTP_HOST'] == 'localhost' ){
    require 'model/conexao-off.php';
}else{
    require 'model/conexao-on.php';
}

require 'model/esic.php';

// Processar nova interação se formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['interacao']) && !empty($_POST['protocolo']) && !empty($_POST['email'])) {
    
    // Buscar dados do protocolo original
    $protocolo_original = null;
    foreach($esic_array as $item) {
        if($item['codigo'] == $_POST['protocolo'] && $item['email'] == $_POST['email']) {
            $protocolo_original = $item;
            break;
        }
    }
    
    if ($protocolo_original) {
        // Sanitizar a nova mensagem
        $nova_interacao = addslashes($_POST['interacao']);
        
        // Inserir nova interação na tabela esic
        $sql_insert = "INSERT INTO `esic` (
            `ativo`, 
            `created_at`, 
            `updated_at`, 
            `orgao`, 
            `titulo`, 
            `codigo`, 
            `nome`, 
            `endereco`, 
            `cidade`, 
            `estado`, 
            `email`, 
            `telefone`, 
            `telefone2`, 
            `cpf`, 
            `cep`, 
            `tipo`, 
            `status`, 
            `identificacao`, 
            `data`, 
            `mensagem`, 
            `resposta`
        ) VALUES (
            1, 
            NOW(), 
            NOW(), 
            '" . addslashes($protocolo_original['orgao']) . "', 
            '" . addslashes($protocolo_original['titulo']) . "', 
            '" . addslashes($protocolo_original['codigo']) . "', 
            '" . addslashes($protocolo_original['nome']) . "', 
            '" . addslashes($protocolo_original['endereco']) . "', 
            '" . addslashes($protocolo_original['cidade']) . "', 
            '" . addslashes($protocolo_original['estado']) . "', 
            '" . addslashes($protocolo_original['email']) . "', 
            " . (!empty($protocolo_original['telefone']) ? "'" . addslashes($protocolo_original['telefone']) . "'" : 'NULL') . ", 
            " . (!empty($protocolo_original['telefone2']) ? "'" . addslashes($protocolo_original['telefone2']) . "'" : 'NULL') . ", 
            '" . addslashes($protocolo_original['cpf']) . "', 
            '" . addslashes($protocolo_original['cep']) . "', 
            '" . addslashes($protocolo_original['tipo']) . "', 
            'Aguardando Resposta', 
            '" . addslashes($protocolo_original['identificacao']) . "', 
            NOW(), 
            '$nova_interacao', 
            '<p>Aguardando resposta da prefeitura.</p>'
        )";
        
        if (mysqli_query($conn, $sql_insert)) {
            // Recarregar os dados do esic para mostrar a nova interação
            $sql_esic = "SELECT * FROM esic WHERE ativo = 1";
            $esic_tabela = $conn->query($sql_esic);
            $esic_array = array();
            while($esic_montado = $esic_tabela->fetch_assoc()) {
                $esic_array[] = $esic_montado;
            }
            
            // Mostrar mensagem de sucesso
            echo '<div style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 10px; margin: 10px 0; border-radius: 4px;">
                <strong>Interação enviada com sucesso!</strong> Sua mensagem foi registrada e você receberá uma resposta em breve.
            </div>';
        } else {
            echo '<div style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 10px; margin: 10px 0; border-radius: 4px;">
                <strong>Erro:</strong> Não foi possível enviar sua interação. Tente novamente.
            </div>';
        }
    }
}

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
				';
				
				// Exibir anexo se existir
				if (!empty($historico['anexo'])) {
					$anexo_path = $historico['anexo'];
					
					// Verificar se o caminho já tem o prefixo uploads/
					if (strpos($anexo_path, 'uploads/') === false) {
						$anexo_path = 'uploads/' . $anexo_path;
					}
					
					$nome_arquivo = basename($historico['anexo']);
					
					$html .= '
					<div class="formularios-separador"></div>
					<div class="formularios-linha">
						<strong>Arquivo anexado: </strong>
						<a href="' . $anexo_path . '" target="_blank" style="color: #0066cc; text-decoration: underline;">
							' . $nome_arquivo . '
						</a>
					</div>
					';
				}
				
				$html .= '
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
					<input type="hidden" name="protocolo" value="'. $esic['codigo'] .'" />
					<input type="hidden" name="email" value="'. $esic['email'] .'" />
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