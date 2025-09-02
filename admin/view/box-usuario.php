<div class="box-usuario">
	
	<div class="box-usuario-avatar" style="background-image:url( usuarios/<?php echo $usuario_foto ?> )"></div>
	<div class="box-usuario-titulo"><?php echo $usuario_nome ?></div>
	<div class="box-usuario-linha"><?php echo $usuario_email ?></div>
	<div class="separador"></div>
	<div class="box-usuario-linha">Funcao: <?php echo $usuario_funcao ?></div>
	<div class="box-usuario-linha">Permissão: <?php echo $usuario_tipo ?></div>
	<div class="box-usuario-linha"><a href="modulos/admin_user/view/alterar-perfil?id=<?php echo $usuario_id; ?>">Alterar Perfil</a></div>
	<a href="controller/logout"><div class="box-usuario-sair">Sair</div></a>

</div>

<script>
document.addEventListener('mousedown', ( event ) => { //CONTROLA O EVENTO DO CLICK DO MOUSE

    if ( document.querySelector('.box-usuario').contains( event.target ) ) { //VERIFICA SE O CLICK (EVENTO) FOI NA DIV LISTADA

        document.querySelector('.box-usuario').classList.add("on");
		
    } else {

        document.querySelector('.box-usuario').classList.remove("on");
		
    }

});
</script>