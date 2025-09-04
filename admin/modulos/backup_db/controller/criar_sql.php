<?php
/*
http://localhost/area-de-membros-da-tati/admin/controller/backup-mysql.php
*/

$raiz_admin = '../../../';
$raiz_site = '../../../../';

error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}

require $raiz_site .'controller/funcoes.php';
require $raiz_site .'model/admin_user.php';

//dd( $conn );

//$banco = 'area_de_membros_da_tati'; //ESTÁ VINDO DA MODEL

$hoje = date( 'Y-m-d-H-i-s' );
$pasta = $raiz_site .'backup_do_banco/';
$nome_arquivo = $pasta . $hoje .'-'. $banco .'.sql' ;
$arquivo = fopen( $nome_arquivo, 'a' );

$sql = "";

$sql = "SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
START TRANSACTION;
SET time_zone = '+00:00';

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `". $banco ."`
--

-- --------------------------------------------------------
";

$sql_tabelas = "SHOW TABLES";
$tabelas = $conn->query( $sql_tabelas );
$tabelas_array = array();

while( $tabelas_montado = $tabelas->fetch_assoc() ){
	
	$tabelas_array[] = $tabelas_montado;
	
}

//dd( $tabelas_array );

foreach( $tabelas_array as $tabela ){
	
	$sql_colunas = "SHOW COLUMNS FROM ". $tabela[ 'Tables_in_'. $banco ];
	$colunas = $conn->query( $sql_colunas );
	$colunas_array = array();
	$coluna_count = 0;

	while( $colunas_montado = $colunas->fetch_assoc() ){
		
		$colunas_array[] = $colunas_montado;
		
	}

	//dd( $colunas_array );

$sql .= "--
-- Estrutura da tabela `". $tabela[ 'Tables_in_'. $banco ] ."`
--

DROP TABLE IF EXISTS `". $tabela[ 'Tables_in_'. $banco ] ."`;

CREATE TABLE IF NOT EXISTS `". $tabela[ 'Tables_in_'. $banco ] ."` (
";

	$chave_primaria = "";

	foreach( $colunas_array as $coluna ){
	
$sql .="	`". $coluna['Field'] ."` ". $coluna['Type'] ." ";  if( $coluna['Null'] == 'NO' ){ $sql .= "NOT NULL "; }else{ $sql .= "NULL "; } $sql .= $coluna['Extra'] .",
";

		if( $coluna['Key'] == 'PRI' ){ $chave_primaria = $coluna['Field']; }
		
	}

$sql .= "	PRIMARY KEY (`". $chave_primaria ."`) ";

$sql_table_data = "SHOW TABLE STATUS WHERE Name = '". $tabela[ 'Tables_in_'. $banco ] ."'";
$table_data = $conn->query( $sql_table_data );
$table_data_array = array();
$table_data_count = 0;

while( $table_data_montado = $table_data->fetch_assoc() ){
	
	$table_data_array[] = $table_data_montado;
	
}

//dd( $table_data_array );

$sql .= "
) ENGINE=". $table_data_array[0]['Engine'] ." AUTO_INCREMENT=". $table_data_array[0]['Auto_increment'] ." DEFAULT CHARSET=utf8mb4 COLLATE=". $table_data_array[0]['Collation'] .";

INSERT INTO `". $tabela[ 'Tables_in_'. $banco ] ."` ( ";

foreach( $colunas_array as $coluna ){
	
	$coluna_count++;
	
	$sql .= $coluna['Field']; if( $coluna_count < count( $colunas_array ) ){ $sql .= ", "; }else{ $sql .= " "; }
	
}

$sql .= " ) VALUES 
";

	$sql_dados = "SELECT * FROM ". $tabela[ 'Tables_in_'. $banco ];
	$dados = $conn->query( $sql_dados );
	$dados_array = array();
	$dados_count = 0;

	while( $dados_montado = $dados->fetch_assoc() ){
		
		$dados_array[] = $dados_montado;
		
	}

	//dd( $dados_array );
	
foreach( $dados_array as $dado ){ //AQUI VAI GERAR SOMENTE AS LINHAS ( ITEM, ITEM, ITEM ),
	
	$dados_count++;
	$dado_count = 0;
	
$sql .= "( "; 

//FOREACH EM COLUNAS PARA POPULAR
//var_dump( $dado );

foreach( $dado as $dado_chave => $dado_valor ){
	
	$dado_count++;
	
	$dado_valor = addslashes( $dado_valor );
	$dado_valor = str_replace( '\n', '\\n', $dado_valor );
	
	if( !empty( $dado_valor ) ){ $sql .= "'". $dado_valor ."'"; }
	else{ $sql .= 'NULL'; }
	
	if( $dado_count < count( $dado ) ){ $sql .= ", "; }
	else{ $sql .= ""; }

}

$sql .= " )"; 

if( $dados_count < count( $dados_array ) ){ 

$sql .= ", 
"; 

}
else{
	
$sql .= "; 

"; 

}
	
}

//AQUI VALORES DA TABELA

}

fwrite( $arquivo, $sql );

echo'
<script> 
	window.location.href = "'. $raiz_admin .'matriz?pagina=backup_db";
</script>
';

?>