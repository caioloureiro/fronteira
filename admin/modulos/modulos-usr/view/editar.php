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
require $raiz_site .'model/admin_user.php';
require $raiz_site .'model/modulos_admin.php';
require $raiz_site .'model/menu_admin_sinc.php';

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Painel de Controle</title>
		<link rel="stylesheet" href="https://digitalmd.com.br/editor-de-texto/assets/estilo.css"/>
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
		<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/css/datatable.css" integrity="sha512-zHpjdnFxcMInClTw4ZqdX6NNLuPU+iJMZEQsyIjXuQX8TZXzRhZIlUi0tQTGQxt/UGruFgs0qTBshuGN0ts/vQ==" crossorigin="anonymous" />
	</head>
	<body>
		
		<style>
			<?php 
				require $raiz_admin .'css/switch-btn.css'; 
				require $raiz_admin .'routes/css-modulo.php'; 
			?>
			.linha:nth-child(odd) {
				background-color: var(--preto_lente02);
			}
			.linha:hover {
				background-color: var(--preto_lente03);
			}
			.linha:hover span {
				font-weight:700;
			}
		</style>
		
		<?php 
			
			$modulo_ativo = 'claro';
			
			$menu_admin_sinc_id = 0;
			$menu_admin_id = 0;
			$usuario_id = 0;
			$categoria_id = 0;
			$ativo = 0;
			
			$debugar = 0;
			
			foreach( $admin_user_array as $user ){
				
				if( $user['id'] == $_GET['id'] ){
				
					echo'
					<div class="lightbox exemplo-editar on">

						<div class="lightbox-titulo">

							Editar Módulos para: '. $user['nome'] .'
							<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( '. $raiz_admin .'img/fechar.svg );"></div>
							
						</div>
						
						<div class="linha">
							<div class="col15"><span><strong>Módulo</strong></span></div>
							';
							
							if( $debugar == 1 ){
								
								echo'<div class="col35"><span><strong>Dados</strong></span></div>';
								
							}
							
							echo'
							<div class="col10"><span><strong>Ação</strong></span></div>
						</div>
						
						';
						
						foreach( $modulos_admin_array as $modulo ){
							
							$situacao_modulo = 0;
							
							echo'
							<div class="linha">
								<div class="col15">
									<span>
										'. $modulo['id'] .' - '. $modulo['nome'] .'
									</span>
								</div>
								';
								
								if( $debugar == 1 ){
									
									echo'
									<div class="col35">
										<span>
											';
											
											foreach( $menu_admin_sinc_array_completo as $sinc ){
												
												if( 
													$modulo['id'] == $sinc['menu_admin_id'] 
													&& $sinc['usuario_id'] == $_GET['id']
													&& $sinc['categoria_id'] != 1
												){
													
													if( $sinc['ativo'] == 0 ){ 
														echo $sinc['id'] .': sim, desativado; ';
													}
													if( $sinc['ativo'] == 1 ){ 
														echo $sinc['id'] .': sim, ativado; '; 
													}
													
												}
												
											}
											
											echo'
										</span>
									</div>
									';
									
								}
								
								foreach( $menu_admin_sinc_array_completo as $sinc ){
									
									if( 
										$modulo['id'] == $sinc['menu_admin_id'] 
										&& $sinc['usuario_id'] == $_GET['id']
										&& $sinc['categoria_id'] != 1
									){
										
										$modulo_ativo = 'claro';
										if( $sinc['ativo'] == 1 ){ $modulo_ativo = 'escuro'; }
										$situacao_modulo = 1;
										
										echo '
											<a href="../controller/editar.php?id='. $sinc['id'] .'&usuario_id='. $sinc['usuario_id'] .'&menu_admin_id='. $sinc['menu_admin_id'] .'&categoria_id='. $sinc['categoria_id'] .'&ativo='. $sinc['ativo'] .'">
												<div class="switch-btn-'. $modulo_ativo .'"><span></span></div>
											</a>
										';
										
									}
									
								}
								
								if( $situacao_modulo == 0 ){
									
									echo '
									<div class="col05">
										<a href="../controller/criar.php?usuario_id='. $user['id'] .'&menu_admin_id='. $modulo['id'] .'&categoria_id=4">
											<span>Criar</span>
										</a>
									</div>
									';
									
								}
								
								echo'
								
							</div>
							';
						}
						
						echo'
						
					</div>
					';
					
				}
				
			}
			
		?>
		
		<script src="https://digitalmd.com.br/editor-de-texto/assets/motor.js"></script>
		<script>
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>' +'matriz?pagina=modulos-usr';
				
			}
		</script>
		
	</body>
	
</html>