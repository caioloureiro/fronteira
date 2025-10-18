<!-- Start - view/menu.php !-->
<nav class="menu">
	
	<div class="menu-titulo">
		<div class="menu-logo" style="background-image:url(../<?php echo $head_favicon ?>)"></div>
		<div class="menu-nome"><?php echo $head_nome ?></div>
		<div class="menu-voltar"><?php require $raiz_admin .'img/arrow-left.svg'; ?></div>
	</div>
	
	<div class="menu-filtro-campo">
		<input 
			type="text" 
			class="menu-filtro"
			placeholder="Pesquisar módulo..."
		/>
		<button type="button" class="menu-filtro-reset<?php echo ($cfg['tema'] === ' escuro' ? ' tema-escuro' : ''); ?>" aria-label="Limpar filtro">
			<!-- inline SVG com fill=currentColor para poder mudar com CSS -->
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 492 492" width="18" height="18" aria-hidden="true">
				<path fill="currentColor" d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872 c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872 c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052 L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116 c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952 c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116 c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/>
			</svg>
		</button>
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

	function normalizeString( str ){
		if( !str ) return '';
		try{
			return str.normalize('NFD').replace(/\p{Diacritic}/gu, '').toUpperCase();
		}catch(e){
			return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toUpperCase();
		}
	}

	itens_busca.addEventListener('keyup', function() {

		let query = normalizeString( document.querySelector('.menu-filtro').value );
		let itens = document.querySelector('.menu-campo');
        
		let card = itens.querySelectorAll('.menu-btn');
        
		if( query.length > 0 ){
			menu_filtro_reset.classList.add("on");
		}else{
			menu_filtro_reset.classList.remove("on");
		}

		for( let i = 0; i < card.length; i++ ){

			let a = card[i].querySelector('.menu-btn-nome');
			let text = normalizeString( a ? a.textContent : '' );
            
			if( text.indexOf( query ) > -1 ){
				card[i].style.display = '';
			}else{
				card[i].style.display = 'none';
			}
		}
        
	});

	menu_filtro_reset.addEventListener("click", function() {
		let card = itens.querySelectorAll('.menu-btn');
		for( let i = 0; i < card.length; i++ ){
			card[i].style.display = '';
		}
		itens_busca.value = '';
		menu_filtro_reset.classList.remove("on");
	});

}
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