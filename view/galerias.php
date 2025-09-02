<!-- Start - view/galerias.php !-->
<?php 
require 'model/galeria.php'; 
require 'model/galeria_imagens.php'; 

$count_galeria = 0;
$counterHTML =  'Nenhuma galeria encontrada.';

if( count( $galeria_array ) == 1 ){ $counterHTML =  '1 galeria encontrada.'; }
if( count( $galeria_array ) > 1 ){ $counterHTML =  count( $galeria_array ) .' galerias encontradas.'; }

$galerias_final = array();

foreach( $galeria_array as $galeria ){

	$galerias_final[] = $galeria;

}

$galerias_final = array_reverse( $galerias_final );

//dd($galerias_final);
?>

<style><?php require 'css/galerias.css'; ?></style>

<section class="galerias">
	
	<div class="box">
		
		<div 
			class="galerias-filtro"
			title="Essa busca é reativa, basta apenas digitar para achar o resultado."
		>
			
			<div class="galerias-filtro-titulo">BUSCA DETALHADA</div>
			
			<div class="galerias-filtro-campo">
				
				<div class="galerias-filtro-col01">
					
					<div class="galerias-filtro-label">Nome</div>
					<div class="galerias-filtro-input"><input type="text" class="input_titulo" /></div>
					
				</div>
				
				<div class="galerias-filtro-col01">
					
					<div class="galerias-filtro-label">Categoria</div>
					<div class="galerias-filtro-input"><input type="text" class="input_categoria" /></div>
					
				</div>
				
			</div>
			
		</div>
		
		<div class="galerias-counter"><?php echo $counterHTML ?></div>
	
		<div class="galerias-campo" id="paginate"></div>
		
		<div class="galerias-paginacao">
			<div class="galerias-paginacao-campo">
			
				<div class="galerias-paginacao-btn first"><span class="material-symbols-outlined">first_page</span></div>
				<div class="galerias-paginacao-btn prev"><span class="material-symbols-outlined">chevron_left</span></div>
				
				<div class="numbers"></div>
				
				<div class="galerias-paginacao-btn next"><span class="material-symbols-outlined">chevron_right</span></div>
				<div class="galerias-paginacao-btn last"><span class="material-symbols-outlined">last_page</span></div>
				
			</div>
		</div>
		
	</div>
	
</section>

<script>
let galerias_counter = document.querySelector('.galerias-counter');

/*Start - Filtro REATIVO*/
let itens = document.querySelector('.galerias-campo');
let input_titulo = document.querySelector('.input_titulo');
let input_categoria = document.querySelector('.input_categoria');
let busca_counter = 0;

if( itens ){
	
	input_titulo.addEventListener('keyup', function() {

		let input_titulo = document.querySelector('.input_titulo').value.toUpperCase();
		//console.log( 'input_titulo', input_titulo ); 
		let itens = document.querySelector('.galerias-campo');
		
		galerias_counter.innerHTML = '';
		busca_counter = 0;
		
		let card = itens.querySelectorAll('.galerias-item');
		
		for( let i = 0; i < card.length; i++ ){

			let a = card[i].querySelector('.galerias-titulo');
			
			if( a.innerHTML.toUpperCase().indexOf( input_titulo ) > -1 ){
				
				card[i].style.display = '';
				busca_counter++;
				
			}else{
				
				card[i].style.display = 'none';
				
			}
			
		}
		
		galerias_counter.innerHTML = busca_counter +' galeria(s) encontrada(s).';
		
	});
	
	input_categoria.addEventListener('keyup', function() {

		let input_categoria = document.querySelector('.input_categoria').value.toUpperCase();
		//console.log( 'input_categoria', input_categoria ); 
		let itens = document.querySelector('.galerias-campo');
		
		galerias_counter.innerHTML = '';
		busca_counter = 0;
		
		let card = itens.querySelectorAll('.galerias-item');
		
		for( let i = 0; i < card.length; i++ ){

			let a = card[i].querySelector('.galerias_categorias');
			
			if( a.innerHTML.toUpperCase().indexOf( input_categoria ) > -1 ){
				
				card[i].style.display = '';
				busca_counter++;
				
			}else{
				
				card[i].style.display = 'none';
				
			}
			
		}
		
		galerias_counter.innerHTML = busca_counter +' galeria(s) encontrada(s).';
		
	});
	
}
/*End - Filtro REATIVO*/

/*Start - PAGINAÇÃO*/
//https://www.youtube.com/watch?v=6-VDE3H9-WU

var itens_por_pagina = 15;
var total_de_itens = <?php echo $count_galeria ?>;

//AQUI VEM UM ARRAY DE NOTICIAS DO PHP
var data = <?php echo json_encode( $galerias_final ); ?>;
//console.log( 'data', data );

var galeria_imagens = <?php echo json_encode( $galeria_imagens_array ); ?>;
//console.log( 'galeria_imagens', galeria_imagens );

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
		
		let capa = '';
		let foundCapa = false;
		
		// Primeiro tenta encontrar uma imagem com destaque = 1
		for( var j in galeria_imagens ) {
			
			if( 
				galeria_imagens[j].galeria_id == item.id 
				&& galeria_imagens[j].destaque == "1"
			){
				
				capa = galeria_imagens[j].imagem;
				foundCapa = true;
				//console.log( 'capa destaque', capa );
				break;
				
			}
			
		}
		
		// Se não encontrou imagem com destaque, pega a primeira imagem da galeria
		if( !foundCapa ){
			
			for( var j in galeria_imagens ) {
				
				if( galeria_imagens[j].galeria_id == item.id ){
					
					capa = galeria_imagens[j].imagem;
					//console.log( 'capa primeira', capa );
					break;
					
				}
				
			}
			
		}
		
		const galerias_item = document.createElement('div');
		galerias_item.classList.add('galerias-item');
		
		// Só define backgroundImage se tiver uma capa
		if( capa !== '' ){
			galerias_item.style.backgroundImage = 'url( galeria/'+ capa +' )';
		}
		
		var categorias = '';
		
		if( item.categorias ){ 
		
			categorias = item.categorias.replaceAll(';', ' '); 
			
		}
		
		galerias_item.innerHTML = ''+
			'<a href="galerias-item&id='+ item.id +'" target="_self">'+
				'<div class="galerias-lente"></div>'+
				'<div class="galerias-foto" ' + (capa !== '' ? 'style="background-image:url( galeria/'+ capa +' )"' : '') + '></div>'+
				'<div class="galerias-base">'+
					'<div class="galerias-data galerias_categorias">'+ categorias +'</div>'+
					'<div class="galerias-titulo"><span>'+ item.nome +'</span></div>'+
				'</div>'+
			'</a>'+
		'';
		
		html.get('#paginate').appendChild( galerias_item );
		
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
	
	element: html.get('.galerias-paginacao .numbers'),
	create( number ){
		
		const button = document.createElement('div');
		button.classList.add('galerias-paginacao-btn');
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
<!-- End - view/galerias.php !-->