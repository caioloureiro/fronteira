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
require $raiz_site .'model/carrossel.php';

?>

<!DOCTYPE HTML>

<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Painel de Controle</title>
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />

		<link rel="stylesheet" href="https://digitalmd.com.br/editor-de-texto/assets/estilo.css"/>
		<link rel="stylesheet" href="<?php echo $raiz_admin ?>css/tail.select-dark.css"/>
		<link rel="stylesheet" href="<?php echo $raiz_admin ?>css/dinamico.css"/>
		<link rel="stylesheet" href="<?php echo $raiz_admin ?>css/estilo.css"/>
		<link rel="stylesheet" href="<?php echo $raiz_admin ?>css/smartphone.css"/>
		
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tail.select@0.5.15/js/tail.select-full.js"></script>
		
	</head>
	<body>
	
		<?php
		
			require $raiz_admin .'view/escurecer.php';
			require $raiz_admin .'view/loading.php';
			
		?>
		
		<style>
			<?php 
				require $raiz_admin .'routes/css-modulo.php';
				require $raiz_admin .'css/drag-and-drop.css'; 
			?>
		</style>
		
		<div class="lightbox exemplo-nova on">
			
			<div class="lightbox-titulo">

				Ordenar Carrossel Desktop
				<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );" ></div>
				
			</div>

			<div class="linha-auto">
			
				<?php
					
					usort($carrossel_array, function($a, $b){//Função responsável por ordenar

						$al = mb_strtolower($a['ordem']);
						$bl = mb_strtolower($b['ordem']);
						
						if ($al == $bl){
							return 0;
						}
						
						return ($bl < $al) ? +1 : -1;
						
					});

					//dd( $carrossel_array );
					
					$i = 1;
					
					foreach( $carrossel_array as $item ){
						
						if( $item['mobile'] == 0 ){
							
							echo'
							<div class="drag_drop_item item_'. $i .'" draggable="true">
								<div class="drag_drop_thumb_txt">
									<div 
										class="drag_drop_thumb_img"
										style="background-image:url( '. $raiz_site .'carrossel/'. $item['imagem'] .' )"
									></div>
								</div>
								<div class="drag_drop_item_txt">'.$item['ordem'].'</div>
								<input 
									type="hidden" 
									name="item_id_'.$i.'" 
									value="'.$item['id'].'" 
									class="drag_drop_input"
								/>
							</div>
							';
							
							$i++;
							
						}
						
					}
					
				?>
				
			</div>
			
			<div class="separador"></div>
			
			<div class="linha">Arraste para cá:</div>
			
			<div class="linha-auto">
				
				<?php
					
					$j = 0;
				
					foreach( $carrossel_array as $item ){
						
						if( $item['mobile'] == 0 ){
						
							$j++;
							
							echo'<div class="drag_drop_alvo alvo_'. $j .'">'. $j .'</div>';
							
						}
						
					}
					
				?>
			
			</div>
			
			<div class="linha">
				
				<?php
					
					$i = 0;
				
					foreach( $carrossel_array as $item ){
						
						if( $item['mobile'] == 0 ){
						
							$i++;
							
							echo'
							<input 
								type="hidden" 
								name="item_nova_ordem_'.$i.'" 
								value="0" 
								class="drag_drop_input drag_drop_input_'.$i.'"
							/>
							';
							
						}
						
					}
					
				?>
				
			</div>
			
			<div class="linha">
				<div class="col05">
					<div class="btn" onclick="gravar()">Gravar</div>
				</div>
				<div class="col05">
					<div class="btn" onclick="voltar()">Cancelar</div>
				</div>
				<div class="col15">
					<div class="btn" onclick="reset()">Reiniciar Processo</div>
				</div>
			</div>
			
			<div class="separador"></div>
			
		</div>
		
		<script>
			
			function voltar(){
				
				window.history.back();
				
			}
			
			function reset(){
				
				location.reload();
				
			}
			
			function gravar(){
				
				console.log( 'gravar()' );
				
				var formData = new FormData();
				
				<?php
					
					$i = 0;
				
					foreach( $carrossel_array as $item ){
						
						if( $item['mobile'] == 0 ){
						
							$i++;
							
							echo'
							formData.append( "item_nova_ordem_'.$i.'", document.querySelector(`[name="item_nova_ordem_'.$i.'"]`).value );
							';
							
						}
						
					}
					
				?>

				var xhr = new XMLHttpRequest();
				xhr.open( 'POST', '../controller/ordenar-desktop.php', true );

				xhr.onreadystatechange = function(){
					
					if( 
						xhr.status === 200 
						&& xhr.readyState == 4
					){
						
						alert( xhr.responseText );
						window.location.href = '<?= $raiz_admin ?>matriz?pagina=carrossel';
						
					}
					
				};

				xhr.send( formData );
				
			}
			
			/*Start - TIPO DE TELA*/
			let largura_browser = window.innerWidth;
			let tipo_tela = 'desktop';

			//console.log( largura_browser );

			if( largura_browser < 1024 ){ tipo_tela = 'mobile' }else{ tipo_tela = 'desktop' }

			//console.log( tipo_tela );
			/*End - TIPO DE TELA*/
			
			/*Start - DESKTOP*/
			const dragItems = document.querySelectorAll('.drag_drop_item');
			const dropBoxes = document.querySelectorAll('.drag_drop_alvo');
			var valor;

			if( tipo_tela == 'desktop' ){
				
				dragItems.forEach( item => {
				
					item.addEventListener( "dragstart", dragInicio );
					
				} );

				dropBoxes.forEach( box => {
					
					box.addEventListener( "dragover", dragOver );
					box.addEventListener( "drop", dropEvent );
					box.addEventListener( "dragleave", dragLeave );
					
				} );
				
			}

			function dragInicio( e ){ //PEGA OS DADOS
				
				if( tipo_tela == 'desktop' ){
					
					//console.log( this.children[2].value ); //ENVIA
					e.dataTransfer.setData( 'id', this.children[2].value );
					e.dataTransfer.setData( 'text/plain', e.target.innerText );
					e.dataTransfer.setData( 'html', e.target.innerHTML );
					e.dataTransfer.setData( 'backgroundImage', this.children[0].children[0].style.backgroundImage );
					setTimeout( () => { this.className = 'off'; }, 0 );
					
				}
				
			}

			function dragOver( e ){
				
				if( tipo_tela == 'desktop' ){
					
					e.preventDefault();
					
					//console.log( 'Entrou na box' );
					this.classList.add("enter");
					
				}
				
			}

			function dragLeave( e ){
				
				if( tipo_tela == 'desktop' ){
					
					e.preventDefault();
					
					//console.log( 'Saiu da box' );
					this.classList.remove("enter");
					
				}
				
				
			}

			function dropEvent( e ){ //SOLTA OS DADOS
				
				if( tipo_tela == 'desktop' ){
					
					e.preventDefault();
					
					//console.log( 'Soltou o botão' );
					
					const el = document.createElement( 'div' );
					el.className = 'drag_drop_item_in';
					this.appendChild( el );
					
					//console.log( e.dataTransfer.getData( 'backgroundImage' ) ); //RECEBE
					
					const thumb_txt = document.createElement( 'div' );
					thumb_txt.className = 'drag_drop_thumb_txt';
					el.appendChild( thumb_txt );
					
					const thumb_img = document.createElement('div');
					thumb_img.className = 'drag_drop_thumb_img';
					thumb_img.style.backgroundImage = e.dataTransfer.getData('backgroundImage');
					thumb_txt.appendChild(thumb_img);
					
					const el_txt = document.createElement( 'div' );
					el_txt.className = 'drag_drop_item_txt';
					el_txt.innerText = e.dataTransfer.getData( 'text' );
					el.appendChild( el_txt );
					
					this.classList.remove("enter");
					
					let box_class = this.className;
					//console.log( box_class );
					
					let box_class_array = box_class.split(' ');
					//console.log( box_class_array[1] );
					
					let box_class_number = box_class.split('_');
					//console.log( box_class_number[box_class_number.length - 1] );
					
					let input_alvo = document.querySelector('.drag_drop_input_'+ box_class_number[box_class_number.length - 1] );
					//console.log( input_alvo );
					
					valor = e.dataTransfer.getData( 'text' );
					//console.log( valor );
					
					//input_alvo.value = valor;
					input_alvo.value = e.dataTransfer.getData( 'id' );
					
				}
				
			}
			/*End - DESKTOP*/
			
		</script>
		
	</body>
</html>