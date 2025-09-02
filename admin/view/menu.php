<!-- Start - view/menu.php !-->
<nav class="menu">
	
	<div class="menu-titulo">
		<div class="menu-logo" style="background-image:url(../<?php echo $head_favicon ?>)"></div>
		<?php echo $head_nome ?>
		<div class="menu-voltar"><?php require $raiz_admin .'img/arrow-left.svg'; ?></div>
	</div>
	
	<div class="menu-filtro-campo">
		<input 
			type="text" 
			class="menu-filtro"
			placeholder="Pesquisar módulo..."
		/>
		<div class="menu-filtro-reset"><?php require 'img/fechar.svg'; ?></div>
	</div>
	
	<div class="menu-campo">
	
		<a href="matriz">
			<div class="menu-btn <?php if( !isset( $_GET['pagina'] ) ){ echo'menu-btn-on'; } ?>">
				<div class="menu-icone"><?php require $raiz_admin .'img/home.svg'; ?></div>
				<span class="menu-btn-nome">Home</span>
			</div>
		</a>

		<?php
			
			usort($menu_admin_categorias_array, function( $a, $b ){//Função responsável por ordenar

				$al = mb_strtolower($a['ordem']);
				$bl = mb_strtolower($b['ordem']);
				
				if ($al == $bl){
					return 0;
				}
				
				return ($bl < $al) ? +1 : -1;
				
			});
			
			/*Start - USUÁRIO MASTER*/
			foreach( $menu_admin_categorias_array as $menu_cat ){
				
				/*Start - FAVORITOS*/
				if( 
					$usuario_tipo == 'master' && 
					$menu_cat['id'] == 1
				){
			
					echo'<div class="menu-btn"><span class="menu-btn-nome">'. $menu_cat['nome'] .'</span></div>';
				
					foreach( $menu_admin_sinc_array as $menu_sinc ){
						
						if( 
							$menu_sinc['categoria_id'] == $menu_cat['id'] &&
							$menu_sinc['usuario_id'] == $usuario_id
						){
						
							foreach( $menu_admin_array as $menu ){
								
								if( $menu_sinc['menu_admin_id'] == $menu['id'] ){
									
									echo'
									<div class="menu-btn '; if( isset( $_GET['pagina'] ) && $_GET['pagina'] == $menu['pagina'] ){ echo'menu-btn-on'; } echo'">
										
										<div class="menu-btn-in">
											<a href="matriz?pagina='. $menu['pagina'] .'">
												<div class="menu-icone">'; require $raiz_admin .'img/'. $menu['imagem']; echo'</div>
												<span class="menu-btn-nome">'. $menu['nome'] .'</span>
											</a>
										</div>
										
										<div class="menu-pin"><a href="modulos/menu_admin/controller/favoritar.php?menu_id='. $menu['id'] .'&esta_favoritado=sim&menu_sinc_id='. $menu_sinc['id'] .'">'; require $raiz_admin .'img/pin.svg'; echo'</a></div>
										
									</div>
									';
									
								}
							
							}
						
						}
					
					}
				
				}
				/*End - FAVORITOS*/
				
				/*Start - NORMAIS*/
				if( 
					$usuario_tipo == 'master' && 
					$menu_cat['id'] != 1
				){
			
					echo'<div class="menu-btn"><span class="menu-btn-nome">'. $menu_cat['nome'] .'</span></div>';
					
					$menu_admin_sinc_completo = [];
				
					foreach( $menu_admin_sinc_array as $menu_sinc ){
						
						if( 
							$menu_sinc['categoria_id'] == $menu_cat['id'] &&
							$menu_sinc['usuario_id'] == $usuario_id
						){
							
							//echo $menu_sinc['menu_admin_id'] .'<br/>';
							
							foreach( $menu_admin_array as $menu ){
								
								if( $menu_sinc['menu_admin_id'] == $menu['id'] ){
									
									//VOU CRIAR UM ARRAY AQUI E DEPOIS VOU DAR UM FOREACH NELE
									$menu_admin_sinc_completo[] = [
										'id' => $menu['id'],
										'nome' => $menu['nome'],
										'pagina' => $menu['pagina'],
										'imagem' => $menu['imagem']
									];
									
								}
							
							}
						
						}
					
					}
					
					usort($menu_admin_sinc_completo, function($a, $b) {
						return strcasecmp($a['nome'], $b['nome']);
					});
					
					foreach( $menu_admin_sinc_completo as $menu_admin_sinc_completo_item ) {
						
						//echo $menu_admin_sinc_completo_item['nome'] .'<br/>';
						echo'
						<div class="menu-btn '; if( isset( $_GET['pagina'] ) && $_GET['pagina'] == $menu_admin_sinc_completo_item['pagina'] ){ echo'menu-btn-on'; } echo'">
							
							<div class="menu-btn-in">
								<a href="matriz?pagina='. $menu_admin_sinc_completo_item['pagina'] .'">
									<div class="menu-icone">'; require $raiz_admin .'img/'. $menu_admin_sinc_completo_item['imagem']; echo'</div>
									<span class="menu-btn-nome">'. $menu_admin_sinc_completo_item['nome'] .'</span>
								</a>
							</div>
							
							<div class="menu-pin"><a href="modulos/menu_admin/controller/favoritar.php?menu_id='. $menu_admin_sinc_completo_item['id'] .'&esta_favoritado=nao">'; require $raiz_admin .'img/pin-vazado.svg'; echo'</a></div>
							
						</div>
						';
						
					}
				
				}
				/*End - NORMAIS*/
			
			}
			/*End - USUÁRIO MASTER*/
			
			/*Start - USUÁRIO NORMAL*/
			foreach( $menu_admin_categorias_array as $menu_cat ){
				
				/*Start - FAVORITOS*/
				if( 
					$usuario_tipo == 'normal' && 
					$menu_cat['id'] == 1
				){
			
					echo'<div class="menu-btn"><span class="menu-btn-nome">'. $menu_cat['nome'] .'</span></div>';
				
					foreach( $menu_admin_sinc_array as $menu_sinc ){
						
						if( 
							$menu_sinc['categoria_id'] == $menu_cat['id'] &&
							$menu_sinc['usuario_id'] == $usuario_id
						){
						
							foreach( $menu_admin_array as $menu ){
								
								if( $menu_sinc['menu_admin_id'] == $menu['id'] ){
									
									echo'
									<div class="menu-btn '; if( isset( $_GET['pagina'] ) && $_GET['pagina'] == $menu['pagina'] ){ echo'menu-btn-on'; } echo'">
										
										<div class="menu-btn-in">
											<a href="matriz?pagina='. $menu['pagina'] .'">
												<div class="menu-icone">'; require 'img/'. $menu['imagem']; echo'</div>
												<span class="menu-btn-nome">'. $menu['nome'] .'</span>
											</a>
										</div>
										
										<div class="menu-pin"><a href="modulos/menu_admin/controller/favoritar.php?menu_id='. $menu['id'] .'&esta_favoritado=sim&menu_sinc_id='. $menu_sinc['id'] .'">'; require $raiz_admin .'img/pin.svg'; echo'</a></div>
										
									</div>
									';
									
								}
							
							}
						
						}
					
					}
				
				}
				/*End - FAVORITOS*/
				
				/*Start - NORMAIS*/
				if( 
					$usuario_tipo == 'normal' &&
					$menu_cat['id'] != 1  &&
					$menu_cat['id'] != 2
				){
			
					echo'<div class="menu-btn"><span class="menu-btn-nome">'. $menu_cat['nome'] .'</span></div>';
				
					$menu_admin_sinc_completo = [];
				
					foreach( $menu_admin_sinc_array as $menu_sinc ){
						
						if( 
							$menu_sinc['categoria_id'] == $menu_cat['id'] &&
							$menu_sinc['usuario_id'] == $usuario_id
						){
							
							//echo $menu_sinc['menu_admin_id'] .'<br/>';
							
							foreach( $menu_admin_array as $menu ){
								
								if( $menu_sinc['menu_admin_id'] == $menu['id'] ){
									
									//VOU CRIAR UM ARRAY AQUI E DEPOIS VOU DAR UM FOREACH NELE
									$menu_admin_sinc_completo[] = [
										'id' => $menu['id'],
										'nome' => $menu['nome'],
										'pagina' => $menu['pagina'],
										'imagem' => $menu['imagem']
									];
									
								}
							
							}
						
						}
					
					}
					
					usort($menu_admin_sinc_completo, function($a, $b) {
						return strcasecmp($a['nome'], $b['nome']);
					});
					
					foreach( $menu_admin_sinc_completo as $menu_admin_sinc_completo_item ) {
						
						//echo $menu_admin_sinc_completo_item['nome'] .'<br/>';
						echo'
						<div class="menu-btn '; if( isset( $_GET['pagina'] ) && $_GET['pagina'] == $menu_admin_sinc_completo_item['pagina'] ){ echo'menu-btn-on'; } echo'">
							
							<div class="menu-btn-in">
								<a href="matriz?pagina='. $menu_admin_sinc_completo_item['pagina'] .'">
									<div class="menu-icone">'; require $raiz_admin .'img/'. $menu_admin_sinc_completo_item['imagem']; echo'</div>
									<span class="menu-btn-nome">'. $menu_admin_sinc_completo_item['nome'] .'</span>
								</a>
							</div>
							
							<div class="menu-pin"><a href="modulos/menu_admin/controller/favoritar.php?menu_id='. $menu_admin_sinc_completo_item['id'] .'&esta_favoritado=nao">'; require $raiz_admin .'img/pin-vazado.svg'; echo'</a></div>
							
						</div>
						';
						
					}
				
				}
				/*End - NORMAIS*/
			
			}
			/*End - USUÁRIO NORMAL*/
			
		?>
		
	</div>
	
</nav>

<script>

/*Start - Filtro REATIVO*/
let itens = document.querySelector('.menu-campo');
let itens_busca = document.querySelector('.menu-filtro');
let menu_filtro_reset = document.querySelector('.menu-filtro-reset');

if( itens ){
	
	itens_busca.addEventListener('keyup', function() {

		let itens_busca = document.querySelector('.menu-filtro').value.toUpperCase();
		let itens = document.querySelector('.menu-campo');
		
		let card = itens.querySelectorAll('.menu-btn');
		
		menu_filtro_reset.classList.add("on");
		
		//console.log( 'card', card );
		
		for( let i = 0; i < card.length; i++ ){
			
			//console.log( 'card[i].querySelector(.menu-btn-nome)', card[i].querySelector('.menu-btn-nome') );

			let a = card[i].querySelector('.menu-btn-nome');
			
			if( a.innerHTML.toUpperCase().indexOf( itens_busca ) > -1 ){
				
				card[i].style.display = '';
				
			}else{
				
				card[i].style.display = 'none';
				
			}
			
		}
		
	});
	
}
menu_filtro_reset.addEventListener("click", function() {
	
	let card = itens.querySelectorAll('.menu-btn');
	
	for( let i = 0; i < card.length; i++ ){

		card[i].style.display = '';
		
	}
	
	itens_busca.value = '';
	menu_filtro_reset.classList.remove("on");
	
});
/*End - Filtro REATIVO*/

let topo_btn_menu = document.querySelector('.topo-btn-menu');
let menu = document.querySelector('.menu');
let menu_voltar = document.querySelector('.menu-voltar');

topo_btn_menu.addEventListener("click", function() {
	menu.classList.add("menu-on");
});

menu_voltar.addEventListener("click", function() {
	menu.classList.remove("menu-on");
});

document.addEventListener('mousedown', ( event ) => { //CONTROLA O EVENTO DO CLICK DO MOUSE

    if ( menu.contains( event.target ) ) { //VERIFICA SE O CLICK (EVENTO) FOI NA DIV LISTADA

        menu.classList.add("menu-on");
		
    } else {

        menu.classList.remove("menu-on");
		
    }

});

</script>
<!-- End - view/menu.php !-->