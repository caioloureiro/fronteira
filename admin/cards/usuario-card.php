<!-- Start - cards/usuario-card.php !-->
<style>
	<?php 
		require 'css/usuario-card.css'; 
		require 'css/switch-btn.css'; 
	?>
</style>

<section class="usuario-card" title="usuario-card">

	<div class="usuario-card-topo"></div>
	<div class="usuario-card-foto" style="background-image:url( usuarios/<?php echo $usuario_foto ?> );" ></div>
	<div class="usuario-card-campo">
		<div class="usuario-card-nome"><?php echo $usuario_nome ?></div>
		<div class="usuario-card-txt"><?php echo $usuario_funcao ?></div>
		<div class="usuario-card-txt">Permissão: <?php echo $usuario_tipo ?></div>
		<div class="usuario-card-txt">
			<div class="usuario-card-txt-in">
				<div class="usuario-card-txt-left">Modo escuro: </div>
				<a 
					href="modulos/admin_user/controller/tema.php?tema=<?php echo $usuario_tema ?>&user_id=<?php echo $usuario_id ?>"
				>
					<div class="switch-btn-<?php echo $usuario_tema ?>"><span></span></div>
				</a>
			</div>
		</div>
		<div class="usuario-card-btn"><a href="modulos/admin_user/view/alterar-perfil?id=<?php echo $usuario_id; ?>">Alterar Perfil</a></div>
	</div>

</section>
<!-- End - cards/usuario-card.php !-->