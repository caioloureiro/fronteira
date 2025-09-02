<?php

if(
	isset( $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ) &&
	isset( $_COOKIE['fronteira_ADMIN_SESSION_senha'] )
){

	echo'<script> location.href = "matriz" </script>';

}

?>