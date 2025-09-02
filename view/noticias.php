<!-- Start - view/noticias.php !-->
<?php 
require 'model/noticias_categorias.php'; 
require 'model/noticias.php'; 

$counter_noticias = 0;

$counterHTML =  'Nenhuma notícia encontrada.';

$periodo_eleitoral = 0;

$hoje = date( 'Y-m-d H:i:s' );

foreach( $periodo_eleitoral_array as $periodo ){
	
	if( $periodo['ativado'] == 1 ){ $periodo_eleitoral = 1; }
	
}

foreach( $noticias_array as $count_not ){

	if( 
		$count_not['publicado'] == 1 
		&& $hoje >= $count_not['data_publicacao']
	){
		
		if( $periodo_eleitoral == 0 ){ $counter_noticias++; }
		if( $periodo_eleitoral == 1 ){ 
			
			if( $count_not['utilidade_publica'] == 1 ){ $counter_noticias++; } 
			
		}
		
	}

}

if( $counter_noticias == 1 ){ $counterHTML =  '1 notícia encontrada.'; }
if( $counter_noticias > 1 ){ $counterHTML =  $counter_noticias .' notícias encontradas.'; }

$noticias_final = array();

foreach( $noticias_array as $noticia ){
	
	if( $hoje >= $noticia['data_publicacao'] ){
		
		if( $periodo_eleitoral == 1 ){
			
			if( $noticia['utilidade_publica'] == 1 ){
				
				$noticias_final[] = $noticia;
				
			}
			
		}
		
		if( $periodo_eleitoral == 0 ){
			
			$noticias_final[] = $noticia;
			
		}
		
	}

}

$noticias_final = array_reverse( $noticias_final );

//dd($noticias_final);

usort($noticias_final, function( $a, $b ){//Função responsável por ordenar

	$al = mb_strtolower($a['data_publicacao']);
	$bl = mb_strtolower($b['data_publicacao']);
	
	if ($al == $bl){
		return 0;
	}
	
	return ($bl > $al) ? +1 : -1;
	
});

?>

<style><?php require 'css/noticias.css'; ?></style>

<section class="noticias">
	
	<div class="box">
		
		<div 
			class="noticias-filtro"
			title="Essa busca é reativa, basta apenas digitar para achar o resultado."
		>
			
			<div class="noticias-filtro-titulo">BUSCA DETALHADA</div>
			
			<div class="noticias-filtro-campo">
				
				<div class="noticias-filtro-col01">
					
					<div class="noticias-filtro-label">Titulo</div>
					<div class="noticias-filtro-input"><input type="text" class="input_titulo" /></div>
					
				</div>
				
				<div class="noticias-filtro-col02">
					
					<div class="noticias-filtro-label">Categoria</div>
					<div class="noticias-filtro-input">
						
						<select class="select_item">
							<option value="">TODAS</option>
							
							<?php
							
								usort($noticias_categorias_array, function( $a, $b ){//Função responsável por ordenar

									$al = mb_strtolower($a['nome']);
									$bl = mb_strtolower($b['nome']);
									
									if ($al == $bl){
										return 0;
									}
									
									return ($bl < $al) ? +1 : -1;
									
								});
								
								foreach( $noticias_categorias_array as $cat ){

									echo '<option>'. $cat['nome'] .'</option>';
									
								}
								
							?>
							
						</select>
						
					</div>
					
				</div>
				
				<div class="noticias-filtro-col03">
					
					<div class="noticias-filtro-label">Data</div>
					<div class="noticias-filtro-input"><input type="text" class="input_data" /></div>
					
				</div>
				
			</div>
			
		</div>
		
		<div class="noticias-counter"><?php echo $counterHTML ?></div>
	
		<div class="noticias-campo" id="paginate"></div>
		
		<div class="noticias-paginacao">
			<div class="noticias-paginacao-campo">
			
				<div class="noticias-paginacao-btn first"><span class="material-symbols-outlined">first_page</span></div>
				<div class="noticias-paginacao-btn prev"><span class="material-symbols-outlined">chevron_left</span></div>
				
				<div class="numbers"></div>
				
				<div class="noticias-paginacao-btn next"><span class="material-symbols-outlined">chevron_right</span></div>
				<div class="noticias-paginacao-btn last"><span class="material-symbols-outlined">last_page</span></div>
				
			</div>
		</div>
		
	</div>
	
</section>

<script>

let noticias_counter = document.querySelector('.noticias-counter');

/*Start - Filtro REATIVO*/
let itens = document.querySelector('.noticias-campo');
let input_titulo = document.querySelector('.input_titulo');
let select_item = document.querySelector('.select_item');
let input_data = document.querySelector('.input_data');
let input_local = document.querySelector('.input_local');
let busca_counter = 0;

if( itens ){
	
	input_titulo.addEventListener('keyup', function() {

		let input_titulo = document.querySelector('.input_titulo').value.toUpperCase();
		console.log( 'input_titulo', input_titulo ); 
		let itens = document.querySelector('.noticias-campo');
		
		noticias_counter.innerHTML = '';
		busca_counter = 0;
		
		let card = itens.querySelectorAll('.noticias-item');
		
		for( let i = 0; i < card.length; i++ ){

			let a = card[i].querySelector('.noticias-item-titulo');
			
			if( a.innerHTML.toUpperCase().indexOf( input_titulo ) > -1 ){
				
				card[i].style.display = '';
				busca_counter++;
				
			}else{
				
				card[i].style.display = 'none';
				
			}
			
		}
		
		noticias_counter.innerHTML = busca_counter +' notícia(s) encontrada(s).';
		
	});
	
	select_item.addEventListener('change', function() {

		let select_item = document.querySelector('.select_item').value.toUpperCase();
		console.log( 'select_item', select_item ); 
		let select_itens = document.querySelector('.noticias-campo');
		
		noticias_counter.innerHTML = '';
		busca_counter = 0;
		
		let select_card = select_itens.querySelectorAll('.noticias-item');
		
		for( let select_card_i = 0; select_card_i < select_card.length; select_card_i++ ){

			let select_item_a = select_card[select_card_i].querySelector('.noticias-item-categoria');
			
			if( select_item_a.innerHTML.toUpperCase().indexOf( select_item ) > -1 ){
				
				select_card[select_card_i].style.display = '';
				busca_counter++;
				
			}else{
				
				select_card[select_card_i].style.display = 'none';
				
			}
			
		}
		
		noticias_counter.innerHTML = busca_counter +' notícia(s) encontrada(s).';
		
	});
	
	input_data.addEventListener('keyup', function() {

		let input_data = document.querySelector('.input_data').value;
		console.log( 'input_data', input_data ); 
		let input_data_itens = document.querySelector('.noticias-campo');
		
		noticias_counter.innerHTML = '';
		busca_counter = 0;
		
		let input_data_itens_card = input_data_itens.querySelectorAll('.noticias-item');
		
		for( let input_data_card_i = 0; input_data_card_i < input_data_itens_card.length; input_data_card_i++ ){

			let input_data_item_a = input_data_itens_card[input_data_card_i].querySelector('.noticias-item-data');
			
			if( input_data_item_a.innerHTML.indexOf( input_data ) > -1 ){
				
				input_data_itens_card[input_data_card_i].style.display = '';
				busca_counter++;
				
			}else{
				
				input_data_itens_card[input_data_card_i].style.display = 'none';
				
			}
			
		}
		
		noticias_counter.innerHTML = busca_counter +' notícia(s) encontrada(s).';
		
	});
	
}
/*End - Filtro REATIVO*/

/*Start - PAGINAÇÃO*/
//https://www.youtube.com/watch?v=6-VDE3H9-WU

var itens_por_pagina = 50;
var total_de_itens = <?php echo $counter_noticias ?>;

//AQUI VEM UM ARRAY DE NOTICIAS DO PHP
var data = <?php echo json_encode( $noticias_final ); ?>;
//console.log( 'data', data );

const html = {
	get( element ){
		return document.querySelector( element );
	}
}

const state = { 
	page: 1,
	perPage: itens_por_pagina,
	totalPage: Math.ceil( data.length / itens_por_pagina ),
	maxVisibleButtons: 5,
}

const controls = {
	
	next(){ 
	
		state.page++;
		
		const lastPage = state.page > state.totalPage;
		
		if( lastPage ){
			
			state.page--;
			
		}
		
	},
	prev(){
		
		state.page--;
		
		if( state.page < 1 ){
			
			state.page++;
			
		}
		
	},
	goTo( page ){
		
		if( page < 1 ){
			
			page = 1;
			
		}
		
		state.page = +page;
		
		if( page > state.totalPage ){
			
			state.page = state.totalPage;
			
		}
		
	},
	createListeners(){
		
		html.get('.first').addEventListener('click', () => {
			controls.goTo( 1 );
			update();
		});
		html.get('.prev').addEventListener('click', () => {
			controls.prev();
			update();
		});
		html.get('.next').addEventListener('click', () => {
			controls.next();
			update();
		});
		html.get('.last').addEventListener('click', () => {
			controls.goTo( state.totalPage );
			update();
		});
		
	},
	
}

const list = {
	
	create( item ){
		
		//RECEBE O ITEM DO JSON NOTICIAS E MONTA
		//console.log( 'item', item );
		
		if( item.publicado == 1 ){
		
			const noticia_categoria = item.categorias.split(';');
			
			const noticia_data_recebida = new Date( item.data_publicacao );
			const noticia_data_recebida_day = noticia_data_recebida.getDate();
			const noticia_data_recebida_month = noticia_data_recebida.getMonth()+1;
			const noticia_data_recebida_year = noticia_data_recebida.getFullYear();
			const noticia_data_set = noticia_data_recebida_day +'/'+ noticia_data_recebida_month +'/'+ noticia_data_recebida_year;
			
			//console.log( 'noticia_data_set', noticia_data_set );
			
			const noticias_item = document.createElement('div');
			noticias_item.classList.add('noticias-item');
			
			noticias_item.innerHTML = ''+
			'<a href="noticia&id='+ item.id +'">'+
			'	<div class="noticias-item-img" style="background-image:url( noticias-img/'+ item.imagem +' )"></div>'+
			'	<div class="noticias-item-campo">'+
			'		<div class="noticias-item-linha">'+
			'			<div class="noticias-item-data">'+ noticia_data_set +'</div>'+
			'			<div class="noticias-item-categoria">'+ noticia_categoria[0] +'</div>'+
			'		</div>'+
			'		<div class="noticias-item-titulo"><span>'+ item.titulo +'</span></div>'+
			'		<div class="noticias-item-subtitulo">'+ item.subtitulo +'</div>'+
			'	</div>'+
			'</a>';
			
			html.get('#paginate').appendChild( noticias_item );
			
		}
		
	},
	update(){
		
		html.get('#paginate').innerHTML = '';
		
		let page = state.page - 1;
		let start = page * state.perPage;
		let end = start + state.perPage;

		const paginatedItems = data.slice( start, end );
		
		//AQUI É O FOREACH NO JSON
		paginatedItems.forEach( list.create )
		
	},
	
}

const buttons = {
	
	element: html.get('.noticias-paginacao .numbers'),
	create( number ){
		
		const button = document.createElement('div');
		button.classList.add('noticias-paginacao-btn');
		button.innerHTML = number;
		
		if( state.page == number ){
			
			button.classList.add('active');
			
		}
		
		button.addEventListener('click', ( event ) => {
			
			const page = event.target.innerText;
			
			controls.goTo( page );
			
			update();
			
		})
		
		buttons.element.appendChild( button );
		
	},
	update(){
		
		buttons.element.innerHTML = '';
		const { maxLeft, maxRight } = buttons.calculateMaxVisible();

		for( let page = maxLeft; page <= maxRight; page++ ){
			
			buttons.create( page )
			
		}
		
	},
	calculateMaxVisible(){
		
		const { maxVisibleButtons } = state;
		let maxLeft = ( state.page - Math.floor( maxVisibleButtons / 2 ) )
		let maxRight = ( state.page + Math.floor( maxVisibleButtons / 2 ) )
		
		if( maxLeft < 1 ){ 
		
			maxLeft = 1; 
			maxRight = maxVisibleButtons; 
			
		}
		
		if( maxRight > state.totalPage ){ 
		
			maxLeft = state.totalPage - ( maxVisibleButtons - 1 ) ; 
			maxRight = state.totalPage; 
			
			if( maxLeft < 1 ){ maxLeft = 1; }
			
		}
		
		return { maxLeft, maxRight }
		
	},
	
}

function update(){
	
	list.update();
	buttons.update();

}

function init(){
	
	update();
	controls.createListeners();
	
}

init();
/*End - PAGINAÇÃO*/

</script>
<!-- End - view/noticias.php !-->