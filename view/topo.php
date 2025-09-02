<!-- Start - view/topo.php !-->
<?php

$topo_txt = '';


$agora = date('D d/m/Y H:i:s');
$dia_semana_eng = date('D');
$dia = date('d');
$mes_numero = date('m');
$ano = date('Y');
$hora = date('H:i');

if( $dia_semana_eng == 'Sun' ){ $dia_semana = 'domingo'; }
if( $dia_semana_eng == 'Mon' ){ $dia_semana = 'segunda-feira'; }
if( $dia_semana_eng == 'Tue' ){ $dia_semana = 'terça-feira'; }
if( $dia_semana_eng == 'Wed' ){ $dia_semana = 'quarta-feira'; }
if( $dia_semana_eng == 'Thu' ){ $dia_semana = 'quinta-feira'; }
if( $dia_semana_eng == 'Fri' ){ $dia_semana = 'sexta-feira'; }
if( $dia_semana_eng == 'Sat' ){ $dia_semana = 'sábado'; }

if( $mes_numero == 1 ){ $mes = 'janeiro'; $mes_abreviado = 'jan'; }
if( $mes_numero == 2 ){ $mes = 'fevereiro'; $mes_abreviado = 'fev'; }
if( $mes_numero == 3 ){ $mes = 'março'; $mes_abreviado = 'mar'; }
if( $mes_numero == 4 ){ $mes = 'abril'; $mes_abreviado = 'abr'; }
if( $mes_numero == 5 ){ $mes = 'maio'; $mes_abreviado = 'mai'; }
if( $mes_numero == 6 ){ $mes = 'junho'; $mes_abreviado = 'jun'; }
if( $mes_numero == 7 ){ $mes = 'julho'; $mes_abreviado = 'jul'; }
if( $mes_numero == 8 ){ $mes = 'agosto'; $mes_abreviado = 'ago'; }
if( $mes_numero == 9 ){ $mes = 'setembro'; $mes_abreviado = 'set'; }
if( $mes_numero == 10 ){ $mes = 'outubro'; $mes_abreviado = 'out'; }
if( $mes_numero == 11 ){ $mes = 'novembro'; $mes_abreviado = 'nov'; }
if( $mes_numero == 12 ){ $mes = 'dezembro'; $mes_abreviado = 'dez'; }

$data = $dia_semana .', '. $dia .' de '. $mes .' de '. $ano;

if(
	isset( $_COOKIE['cidade_SESSION_usuario'] ) &&
	isset( $_COOKIE['cidade_SESSION_senha'] )
){
	require 'model/usuarios.php';
	
	$nome_usr = '';
	
	foreach( $usuarios_array as $usr ){

		if( $usr['email'] == $_COOKIE['cidade_SESSION_usuario'] ){
			
			$nome_usr = $usr['nome'];
			
		}
		
	}
	
	$topo_txt = '<div class="topo-nome"><a href="acesso-restrito-login">Olá '. $nome_usr .'</a></div><div class="topo-sair"><a href="controller/logout"><span class="material-symbols-outlined">logout</span> Sair</a></div>';

}else{
	
	//$topo_txt = '<a href="acesso-restrito-login"><span class="material-symbols-outlined">Lock</span> LOGIN / CADASTRO</a>';
	$topo_txt = '<span class="data">'. $data .' </span><span class="hora">--:--</span>';
	
}

?>

<style><?php require 'css/topo.css'; ?></style>

<div class="topo">
	
	<div class="topo-txt"><?php echo $topo_txt ?></div>
	
</div>

<script>
/*Start - Relógio*/
let hora = document.querySelector('.hora');

function relogio(){

	let data = new Date();
	let hor = data.getHours();
	let min = data.getMinutes();
	let seg = data.getSeconds();

	if( hor < 10 ){ hor = "0"+ hor; }
	if( min < 10 ){ min = "0"+ min; }
	if( seg < 10 ){ seg = "0"+ seg; }

	let horas = hor +":"+ min;

	hora.innerHTML = horas;

}

let timer = setInterval( relogio,1000 );
/*End - Relógio*/
</script>
<!-- End - view/topo.php !-->