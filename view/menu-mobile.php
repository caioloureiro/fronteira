<!-- Start - view/menu-mobile.php !-->
<div class="menu-mobile">

	<div class="menu-mobile-hamburger">
		<div class="menu-mobile-hamburger-01"></div>
		<div class="menu-mobile-hamburger-02"></div>
		<div class="menu-mobile-hamburger-03"></div>
	</div>
	<div class="menu-mobile-esquerda">

		<a href="./"><div class="menu-mobile-logo"></div></a>
		
	</div>

</div>

<div class="menu-mobile-links">

	<div class="menu-mobile-links-box">
	
		
		<?php
			foreach( $menu_array as $menu ){
				
				if( 
					$menu['nivel'] == 0 
					&& $menu['submenu'] == 1 
				){
					
					echo'
					<details class="menu-mobile-links-pai"><summary>'. $menu['nome'] .'</summary>
						';
						
						foreach( $menu_array as $submenu ){
							
							if( 
								$submenu['nivel'] == 1 
								&& $submenu['submenu'] == 1 
								&& $submenu['pai'] == $menu['id'] 
							){
								echo'
								<details class="menu-mobile-links-pai"><summary>'. $submenu['nome'] .'</summary>
									';
									
									foreach( $menu_array as $nivel01 ){
										
										if( 
											$nivel01['nivel'] == 2 
											&& $nivel01['submenu'] == 0 
											&& $nivel01['pai'] == $submenu['id'] 
										){
											
											echo'
											<a href="'. $nivel01['link'] .'">
												<div class="menu-mobile-links-btn">'. $nivel01['nome'] .'</div>
											</a>
											';
											
										}
										
									}
									
									echo'
								</details>
								';
								
							}
							
							if( 
								$submenu['nivel'] == 1 
								&& $submenu['submenu'] == 0 
								&& $submenu['pai'] == $menu['id'] 
							){
								
								echo'
								<a href="'. $submenu['link'] .'">
									<div class="menu-mobile-links-btn">'. $submenu['nome'] .'</div>
								</a>';
								
							}
							
						}
						
						echo'
					</details>
					';
					
				}
				
				if( 
					$menu['nivel'] == 0 
					&& $menu['submenu'] == 0 
				){
					
					echo'<a href="'. $menu['link'] .'"><div class="menu-mobile-links-btn">'. $menu['nome'] .'</div></a>';
					
				}
				
			}
			
		?>
		
		
	</div>

</div>

<script>
/*Start - MENU MOBILE*/
let menu_mobile_hamburger = document.querySelector('.menu-mobile-hamburger');
let menu_mobile_hamburger_01 = document.querySelector('.menu-mobile-hamburger-01');
let menu_mobile_hamburger_02 = document.querySelector('.menu-mobile-hamburger-02');
let menu_mobile_hamburger_03 = document.querySelector('.menu-mobile-hamburger-03');
let menu_mobile_links = document.querySelector('.menu-mobile-links');

menu_mobile_hamburger.addEventListener('click', function() {

	menu_mobile_hamburger_01.classList.toggle('menu-mobile-hamburger-01-on');
	menu_mobile_hamburger_02.classList.toggle('menu-mobile-hamburger-02-on');
	menu_mobile_hamburger_03.classList.toggle('menu-mobile-hamburger-03-on');
	menu_mobile_links.classList.toggle('menu-mobile-links-on');
	
});
/*End - MENU MOBILE*/
</script>
<!-- End - view/menu-mobile.php !-->