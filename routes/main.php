<?php
	
	error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
	date_default_timezone_set('America/Sao_Paulo');
	
	require "model/conexao.php";
	require "controller/info.php";
	require "controller/funcoes.php";
	require "controller/components.php";

?>