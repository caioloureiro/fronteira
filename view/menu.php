<!-- Start - view/menu.php !-->
<?php

require 'model/menu.php';
require 'model/menu_servicos.php';

usort($menu_array, function( $a, $b ){//Função responsável por ordenar

	$al = mb_strtolower($a['ordem']);
	$bl = mb_strtolower($b['ordem']);
	
	if ($al == $bl){
		return 0;
	}
	
	return ($bl > $al) ? +1 : -1;
	
});

?>

<style><?php require 'css/menu.css'; ?></style>

<div class="menu">

	<div class="menu-btns-campo">
		
		<div class="menu-sub-campo hamburger">
			<div class="menu-btn menu_btn_1">
				<span class="menu-btn-nome material-symbols-outlined menu_item_principal">menu</span>
				<span class="menu-btn-base"></span>
			</div>
		</div>
		
		<?php

			foreach( $menu_array as $menu ){
				
				if( 
					$menu['nivel'] == 0 
					&& $menu['id'] > 1 
				){
				
					echo'
					<div class="menu-sub-campo">
					
						<div class="menu-btn menu_btn_'. $menu['id'] .'">
							<a href="'. $menu['link'] .'" target="'. $menu['target'] .'">
								<span class="menu-btn-nome menu_item_'. $menu['id'] .'">'. $menu['nome'] .' </span>
								<span class="menu-btn-base"></span>
							</a>
						</div>
						';
						
						if( $menu['submenu'] == 1 ){
							
							usort($menu_array, function( $a, $b ){//Função responsável por ordenar

								$al = mb_strtolower($a['nome']);
								$bl = mb_strtolower($b['nome']);
								
								if ($al == $bl){
									return 0;
								}
								
								return ($bl < $al) ? +1 : -1;
								
							});
						
							echo'
							<div class="submenu submenu_'. $menu['id'] .'">
								<div class="submenu-box">
									';
									
									foreach( $menu_array as $submenu ){
						
										if( 
											$submenu['pai'] == $menu['id'] 
											&& $submenu['nivel'] == 1
										){
											
											echo'
											<div class="submenu-btn">
												<a href="'. $submenu['link'] .'" target="'. $submenu['target'] .'">
													<span>'. $submenu['nome'] .'</span>
												</a>
											</div>
											';
											
										}
										
									}
									
									echo'
								</div>
							</div>
							
							<script>
					
								if( document.querySelector(".submenu_'. $menu['id'] .'") ){
									
									let menu_item_'. $menu['id'] .' = document.querySelector(".menu_item_'. $menu['id'] .'");
									let submenu_'. $menu['id'] .' = document.querySelector(".submenu_'. $menu['id'] .'");
									let menu_item_'. $menu['id'] .'_pai = menu_item_'. $menu['id'] .'.parentElement;
									let menu_btn_'. $menu['id'] .' = document.querySelector(".menu_btn_'. $menu['id'] .'");
									
									menu_item_'. $menu['id'] .'.addEventListener("mouseover", function() {
										menu_item_'. $menu['id'] .'.classList.add("on");
										submenu_'. $menu['id'] .'.classList.add("on");
										menu_item_'. $menu['id'] .'_pai.classList.add("on");
										menu_btn_'. $menu['id'] .'.classList.add("on");
									});
									
									menu_item_'. $menu['id'] .'.addEventListener("mouseleave", function() {
										menu_item_'. $menu['id'] .'.classList.remove("on");
										submenu_'. $menu['id'] .'.classList.remove("on");
										menu_item_'. $menu['id'] .'_pai.classList.remove("on");
										menu_btn_'. $menu['id'] .'.classList.remove("on");
									});
									
									submenu_'. $menu['id'] .'.addEventListener("mouseover", function() {
										menu_item_'. $menu['id'] .'.classList.add("on");
										submenu_'. $menu['id'] .'.classList.add("on");
										menu_item_'. $menu['id'] .'_pai.classList.add("on");
										menu_btn_'. $menu['id'] .'.classList.add("on");
									});
									
									submenu_'. $menu['id'] .'.addEventListener("mouseleave", function() {
										menu_item_'. $menu['id'] .'.classList.remove("on");
										submenu_'. $menu['id'] .'.classList.remove("on");
										menu_item_'. $menu['id'] .'_pai.classList.remove("on");
										menu_btn_'. $menu['id'] .'.classList.remove("on");
									});
									
								}
								
							</script>
							';
							
						}
						
						echo'
					</div>
					';
					
				}
				
			}
			
		?>
		
	</div>
	
</div>

<div class="submenu_horizontal">

	<div class="submenu_horizontal_col_esq">
		
		<div class="submenu_horizontal_h1">
			<div class="submenu_horizontal_h1-icone material-symbols-outlined">menu</div>
			<div class="submenu_horizontal_h1-titulo">Serviços</div>
		</div>
		
		<div class="submenu_horizontal_h2"><span>A Prefeitura</span></div>
		
		<?php
			
			usort($menu_servicos_array, function( $a, $b ){//Função responsável por ordenar

				$al = mb_strtolower($a['ordem']);
				$bl = mb_strtolower($b['ordem']);
				
				if ($al == $bl){
					return 0;
				}
				
				return ($bl < $al) ? +1 : -1;
				
			});
			
			foreach( $menu_servicos_array as $menu_servicos ){

				echo'
				<div class="submenu_horizontal_col_esq-btn '; if( $menu_servicos['realce'] == 1 ){ echo 'realce'; } echo'">
					<a 
						href="'. $menu_servicos['link'] .'" 
						target="'. $menu_servicos['target'] .'"
					>'. $menu_servicos['nome'] .'</a>
				</div>
				';
				
			}
			
		?>
		
	</div>
	
	<div class="submenu_horizontal_col_dir">
	
		<?php
			
			usort($menu_array, function( $a, $b ){//Função responsável por ordenar

				$al = mb_strtolower($a['nome']);
				$bl = mb_strtolower($b['nome']);
				
				if ($al == $bl){
					return 0;
				}
				
				return ($bl < $al) ? +1 : -1;
				
			});
			
			foreach( $menu_array as $submenu ){

				if( 
					$submenu['pai'] == 1 
					&& $submenu['nivel'] == 1
				){
					
					echo'
					<div class="submenu_horizontal-btn">
						<a href="'. $submenu['link'] .'" target="'. $submenu['target'] .'">
							<span>'. $submenu['nome'] .'</span>
						</a>
					</div>
					';
					
				}
				
			}
			
		?>

	</div>
	
</div>

<script>

	if( document.querySelector(".submenu_horizontal") ){
		
		let menu_item_principal = document.querySelector(".menu_item_principal");
		let submenu_horizontal = document.querySelector(".submenu_horizontal");
		let menu_item_principal_pai = menu_item_principal.parentElement;
		let menu_btn_1 = document.querySelector(".menu_btn_1");
		
		menu_item_principal.addEventListener("mouseover", function() {
			menu_item_principal.classList.add("on");
			submenu_horizontal.classList.add("on");
			menu_item_principal_pai.classList.add("on");
			menu_btn_1.classList.add("on");
		});
		
		menu_item_principal.addEventListener("mouseleave", function() {
			menu_item_principal.classList.remove("on");
			submenu_horizontal.classList.remove("on");
			menu_item_principal_pai.classList.remove("on");
			menu_btn_1.classList.remove("on");
		});
		
		submenu_horizontal.addEventListener("mouseover", function() {
			menu_item_principal.classList.add("on");
			submenu_horizontal.classList.add("on");
			menu_item_principal_pai.classList.add("on");
			menu_btn_1.classList.add("on");
		});
		
		submenu_horizontal.addEventListener("mouseleave", function() {
			menu_item_principal.classList.remove("on");
			submenu_horizontal.classList.remove("on");
			menu_item_principal_pai.classList.remove("on");
			menu_btn_1.classList.remove("on");
		});
		
	}
	
</script>
<!-- End - view/menu.php !-->