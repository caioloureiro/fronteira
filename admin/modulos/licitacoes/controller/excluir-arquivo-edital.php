<?php

session_start();

if( !isset( $_SESSION['usuario'] ) ){
	echo 'Acesso negado.';
	exit;
}

$raiz_site = '../../../../';

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}

if( !isset( $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ) ){
	echo 'Acesso negado.';
	exit;
}

if( isset( $_POST['arquivo_nome'] ) && !empty( $_POST['arquivo_nome'] ) ){
	
	$arquivo_nome = $_POST['arquivo_nome'];
	$caminho_arquivo = $raiz_site . 'uploads/' . $arquivo_nome;
	
	// Verificar se arquivo existe
	if( file_exists( $caminho_arquivo ) ){
		
		// Excluir arquivo físico
		if( unlink( $caminho_arquivo ) ){
			
			// Log da ação no padrão do sistema
			$sql_log = "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Excluiu arquivo de edital: ".$arquivo_nome."','". date( 'Y-m-d H:i:s' ) ."')";
			$conn->query($sql_log);
			
			echo 'Arquivo excluído com sucesso.';
			
		} else {
			echo 'Erro ao excluir arquivo.';
		}
		
	} else {
		echo 'Arquivo não encontrado.';
	}
	
} else {
	echo 'Nome do arquivo não fornecido.';
}

?>