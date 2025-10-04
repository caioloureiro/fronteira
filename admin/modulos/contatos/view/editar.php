<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

$raiz_site = '../../../../';
$raiz_admin = '../../../';

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}

require $raiz_site .'controller/funcoes.php';
require $raiz_site .'model/contatos.php';

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Editar contato</title>
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
		
		<?php 
			
			$editor_de_texto_valor = '';
			
			foreach( $contatos_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
				
					echo'
					<div class="lightbox contato-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar contato: '. $item['nome'] .'
								<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( '. $raiz_admin .'img/fechar.svg );"></div>
								
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Nome: </span>
								</div>
								<div class="col90">
									<input 
										name="nome" 
										required 
										value="'. $item['nome'] .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Órgão: </span>
								</div>
								<div class="col90">
									<input 
										name="orgao" 
										value="'. ($item['orgao'] ?? '') .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Endereço: </span>
								</div>
								<div class="col90">
									<input 
										name="endereco" 
										value="'. ($item['endereco'] ?? '') .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Cidade: </span>
								</div>
								<div class="col90">
									<input 
										name="cidade" 
										value="'. ($item['cidade'] ?? '') .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Estado: </span>
								</div>
								<div class="col90">
									<input 
										name="estado" 
										value="'. ($item['estado'] ?? '') .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Email: </span>
								</div>
								<div class="col90">
									<input 
										name="email" 
										type="email"
										value="'. ($item['email'] ?? '') .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Telefone: </span>
								</div>
								<div class="col90">
									<input 
										name="telefone" 
										value="'. ($item['telefone'] ?? '') .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>CPF: </span>
								</div>
								<div class="col90">
									<input 
										name="cpf" 
										value="'. ($item['cpf'] ?? '') .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Bairro: </span>
								</div>
								<div class="col90">
									<input 
										name="bairro" 
										value="'. ($item['bairro'] ?? '') .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>CEP: </span>
								</div>
								<div class="col90">
									<input 
										name="cep" 
										value="'. ($item['cep'] ?? '') .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Tipo: </span>
								</div>
								<div class="col90">
									<input 
										name="tipo" 
										value="'. ($item['tipo'] ?? '') .'" 
									/>
								</div>
							</div>
							
							<div class="linha linha-auto">
								<div class="col10">
									<span>Mensagem: </span>
								</div>
								<div class="col90">
									<textarea 
										name="mensagem" 
										rows="4"
									>'. ($item['mensagem'] ?? '') .'</textarea>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Data: </span>
								</div>
								<div class="col90">
									<input 
										name="data" 
										type="datetime-local"
										value="'. (isset($item['data']) ? date('Y-m-d\TH:i', strtotime($item['data'])) : '') .'" 
									/>
								</div>
							</div>
							
							<div class="separador"></div>
							
							<div class="linha-acao"> 
								<button type="submit">Gravar</button> 
								<div class="btn" onclick="voltar()">Cancelar</div>
							</div>
							
							<div class="separador"></div>
							
						</form>

					</div>
					';
					
				}
				
			}
			
		?>
		
		<script>
		
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=contatos';
				
			}
			
		</script>
		
	</body>
	
</html>