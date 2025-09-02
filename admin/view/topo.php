<!--Start - view/topo.php !-->
<header class="topo">

	<div class="topo-btn-menu" title="Menu."><?php require $raiz_admin .'img/menu-02.svg'; ?></div>
	
	<div class="topo-usr-campo">
		<div class="topo-usr-dados">
			<div class="topo-usr-nome"><?php echo $usuario_nome ?></div>
			<div class="topo-usr-tipo"><?php echo $usuario_tipo ?></div>
		</div>
		<div class="topo-usr" style="background-image:url( usuarios/<?php echo $usuario_foto ?> )">
			<div class="topo-usr-bolinha"></div>
		</div>
	</div>
	
	<?php
		if( $usuario_tipo == 'master' ){
			
			echo'
			<a href="modulos/settings/view/editar?id=1"><div class="topo-btn" title="Configurações.">'; require $raiz_admin .'img/gear.svg'; echo'</div></a>
			<a href="../" target="_blank"><div class="topo-btn" title="Ir para o site.">'; require $raiz_admin .'img/site.svg'; echo'</div></a>
			<a href="matriz?pagina=tutoriais"><div class="topo-btn topo-tutoriais" title="Tutoriais.">'; require $raiz_admin .'img/ajuda.svg'; echo'</div></a>
			';
			
		}
		
	?>
	
	<a href="matriz"><div class="topo-logo" style="background-image:url( <?php echo $raiz_site . $logo ?> );" ></div></a>

</header>
<!--End - view/topo.php !-->