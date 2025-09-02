/*Start - VISUALIZAR SENHA*/
let login_ver = document.querySelector('.login-ver');

if( document.querySelector('.login-ver') ){

	login_ver.addEventListener('click', function() {
		
		let input_alvo = document.getElementById('senha');
		let input_tipo = input_alvo.type;
		
		if( input_tipo == "password" ){

			document.getElementById('senha').type = "text";
			
		}
		
		if( input_tipo == "text" ){

			document.getElementById('senha').type = "password";
			
		}
		
	});

}
/*End - VISUALIZAR SENHA*/

/*Start - Box Usuário*/
let topo_usr = document.querySelector('.topo-usr');
let box_usuario = document.querySelector('.box-usuario');

if( document.querySelector('.box-usuario') ){

	topo_usr.addEventListener('click', function() {
		
		box_usuario.classList.toggle('on');
		
	});

}
/*End - Box Usuário*/

/*Start - Tabelas*/
let tabela_uma_coluna = document.querySelector('.tabela-uma-coluna');
let tabela_duas_colunas = document.querySelector('.tabela-duas-colunas');
let tabela_tres_colunas = document.querySelector('.tabela-tres-colunas');
let tabela_quatro_colunas = document.querySelector('.tabela-quatro-colunas');
let tabela_cinco_colunas = document.querySelector('.tabela-cinco-colunas');
let tabela_seis_colunas = document.querySelector('.tabela-seis-colunas');

let tabela_uma_coluna_imagens = document.querySelector('.tabela-uma-coluna-imagens');
let tabela_duas_colunas_noticias = document.querySelector('.tabela-duas-colunas-noticias');
let tabela_uma_coluna_img_noticias = document.querySelector('.tabela-uma-coluna-img-noticias');

let tabela_uma_coluna_legislacoes = document.querySelector('.tabela-uma-coluna-legislacoes');

if( tabela_uma_coluna ){
	
	var datatable = new DataTable( tabela_uma_coluna, {
		sort: [true],
		filters: [true],
		filterText: 'Buscar... ',
		pagingDivSelector: "#paginacao",
		pageSize: 100
	});

}
if( tabela_duas_colunas ){
	
	var datatable = new DataTable( tabela_duas_colunas, {
		sort: [true, true],
		filters: [true, true],
		filterText: 'Buscar... ',
		pagingDivSelector: "#paginacao"
	});

}
if( tabela_tres_colunas ){
	
	var datatable = new DataTable( tabela_tres_colunas, {
		sort: [true, true, true],
		filters: [true, true, true],
		filterText: 'Buscar... ',
		pagingDivSelector: "#paginacao"
	});

}
if( tabela_quatro_colunas ){
	
	var datatable = new DataTable( tabela_quatro_colunas, {
		sort: [true, true, true, true],
		filters: [true, true, true, true],
		filterText: 'Buscar... ',
		pagingDivSelector: "#paginacao"
	});

}
if( tabela_cinco_colunas ){
	
	var datatable = new DataTable( tabela_cinco_colunas, {
		sort: [true, true, true, true, true],
		filters: [true, true, true, true, true],
		filterText: 'Buscar... ',
		pagingDivSelector: "#paginacao"
	});

}
if( tabela_seis_colunas ){
	
	var datatable = new DataTable( tabela_seis_colunas, {
		sort: [true, true, true, true, true, true],
		filters: [true, true, true, true, true, true],
		filterText: 'Buscar... ',
		pagingDivSelector: "#paginacao"
	});

}

if( tabela_uma_coluna_imagens ){
	
	var datatable = new DataTable( tabela_uma_coluna_imagens, {
		sort: [true],
		filters: [true],
		filterText: 'Buscar... ',
		pagingDivSelector: "#paginacao_imagens",
		pageSize: 100
	});

}
if( tabela_duas_colunas_noticias ){
	
	var datatable = new DataTable( tabela_duas_colunas_noticias, {
		sort: [true, true],
		filters: [true, true],
		filterText: 'Buscar... ',
		pagingDivSelector: "#paginacao_noticias"
	});

}
if( tabela_uma_coluna_img_noticias ){
	
	var datatable = new DataTable( tabela_uma_coluna_img_noticias, {
		sort: [true],
		filters: [true],
		filterText: 'Buscar... ',
		pagingDivSelector: "#paginacao_img_noticias"
	});

}

if( tabela_uma_coluna_legislacoes ){
	
	var datatable = new DataTable( tabela_uma_coluna_legislacoes, {
		sort: [true],
		filters: [true],
		filterText: 'Buscar... ',
		pagingDivSelector: "#paginacao_legislacoes",
		pageSize: 100
	});

}

let tabela_uma_coluna_uploads = document.querySelector('.tabela-uma-coluna-uploads');

if( tabela_uma_coluna_uploads ){
	
	var datatable = new DataTable( tabela_uma_coluna_uploads, {
		sort: [true],
		filters: [true],
		filterText: 'Buscar... ',
		pagingDivSelector: "#paginacao_uploads",
		pageSize: 100
	});

}

let tabela_uma_coluna_licitacoes = document.querySelector('.tabela-uma-coluna-licitacoes');

if( tabela_uma_coluna_licitacoes ){
	
	var datatable = new DataTable( tabela_uma_coluna_licitacoes, {
		sort: [true],
		filters: [true],
		filterText: 'Buscar... ',
		pagingDivSelector: "#paginacao_licitacoes",
		pageSize: 100
	});

}
/*End - Tabelas*/

/*Start - Lightbox*/

if( document.querySelector('.escurecer') ){
	
	document.querySelector('.escurecer').addEventListener('click', function() {

		sair();
		
	});

}

if( document.querySelector('.lightbox-fechar') ){

	document.querySelector('.lightbox-fechar').addEventListener('click', function() {

		sair();
		
	});
	
}

if( document.querySelector('.usuario-criar-btn') ){
	
	document.querySelector('.usuario-criar-btn').addEventListener('click', function() {
		
		document.querySelector('.escurecer').classList.add('on');
		document.querySelector('.usuario-criar-btn').classList.add('on');
		
	});

}

if( document.querySelector('.escolher-imagem-btn') ){
	
	document.querySelector('.escolher-imagem-btn').addEventListener('click', function() {
		
		document.querySelector('.escurecer').classList.add('on');
		document.querySelector('.noticia-imagens').classList.add('on');
		
	});

}

if( document.querySelector('.escolher-imagem-adm-btn') ){
	
	document.querySelector('.escolher-imagem-adm-btn').addEventListener('click', function() {
		
		document.querySelector('.escurecer').classList.add('on');
		administracao_imagens.classList.add('on');
		
	});

}

if( document.querySelector('.topo-tutoriais') ){
	
	document.querySelector('.topo-tutoriais').addEventListener('click', function() {
		
		document.querySelector('.escurecer').classList.add('on');
		document.querySelector('.tutoriais-lista').classList.add('on');
		
	});

}
/*End - Lightbox*/

/*Start - TECLADO*/
document.onkeydown = function(evt){
	
	evt = evt || window.event;
	
	var isEscape = false;
	var isEnter = false;
	
	if ("key" in evt){

		isA = (evt.key == "a");
		isB = (evt.key == "b");
		isC = (evt.key == "c");
		isD = (evt.key == "d");
		isE = (evt.key == "e");
		isF = (evt.key == "f");
		isG = (evt.key == "g");
		isH = (evt.key == "h");
		isI = (evt.key == "i");
		isJ = (evt.key == "j");
		isK = (evt.key == "k");
		isL = (evt.key == "l");
		isM = (evt.key == "m");
		isN = (evt.key == "n");
		isO = (evt.key == "o");
		isP = (evt.key == "p");
		isQ = (evt.key == "q");
		isR = (evt.key == "r");
		isS = (evt.key == "s");
		isT = (evt.key == "t");
		isU = (evt.key == "u");
		isV = (evt.key == "v");
		isW = (evt.key == "w");
		isX = (evt.key == "x");
		isY = (evt.key == "y");
		isZ = (evt.key == "z");
		
		isEscape = (evt.key == "Escape" || evt.key == "Esc");
		isEnter = (evt.key == "Enter" || evt.key == "Return");

	}

	if (isEscape) {/*SEMPRE QUE SE PRESSIONAR ESC FAÇA O QUE ESTA ABAIXO*/

		//alert('ESC');
		sair();
		
	}

	if (isEnter) {/*SEMPRE QUE SE PRESSIONAR ESC FAÇA O QUE ESTA ABAIXO*/

		//alert('ENTER');
		
	}

	if ( isA ) {}
	if ( isB ) {}
	if ( isC ) {}
	if ( isD ) {}
	if ( isE ) {}
	if ( isF ) {}
	if ( isG ) {}
	if ( isH ) {}
	if ( isI ) {}
	if ( isJ ) {}
	if ( isK ) {}
	if ( isL ) {}
	if ( isM ) {}
	if ( isN ) {}
	if ( isO ) {}
	if ( isP ) {}
	if ( isQ ) {}
	if ( isR ) {}
	if ( isS ) {}
	if ( isT ) {}
	if ( isU ) {}
	if ( isV ) {}
	if ( isW ) {}
	if ( isX ) {}
	if ( isY ) {}
	if ( isZ ) {}

};
/*End - TECLADO*/

/*Start - Funções*/
function sair(){
	
	loading.classList.remove('loading-on');
	document.querySelector('.escurecer').classList.remove('on');
	document.querySelector('.menu').classList.remove('menu-on');
	box_usuario.classList.remove('on');
	
}
/*End - Funções*/

/*Start - Botões*/
let voltar_btn = document.querySelector('.voltar-btn');
let arquivo = document.querySelector('#arquivo');
let arquivo_valor = document.getElementById('arquivo');

if( document.querySelector('.voltar-btn') ){
	
	voltar_btn.addEventListener('click', function() {
		
		window.history.back();
		
	});

}

if( document.querySelector('#arquivo') ){
	
	arquivo.addEventListener('change', function() {
		
		var filename = arquivo.files[0].name;

		var arquivo_escolhido = document.querySelector('.arquivo_escolhido');

		if( this.files.length > 1 ){

			arquivo_escolhido.innerHTML = this.files.length +' arquivos selecionados.';
			
		}else{

			arquivo_escolhido.innerHTML = filename;
			
		}
		
	});

}
/*End - Botões*/

/*Start - Downloads*/
let viculo_download = document.querySelector('.viculo_download');
let vinculo_id = document.querySelector('.vinculo_id');
let vinculo_tipo = document.querySelector('.vinculo_tipo');

if( document.querySelector('.viculo_download') ){
	
	viculo_download.addEventListener('change', function() {
		
		vinculo_array = viculo_download.value.split('-');
		vinculo_id.value = vinculo_array[0];
		vinculo_tipo.value = vinculo_array[1];
		
	});

}
/*End - Downloads*/

/*Start - Empenhos*/
let select_empenhos = document.querySelector('.select_empenhos');
let numero_despesa = document.querySelector('.numero_despesa');
let descricao_despesa = document.querySelector('.descricao_despesa');

if( document.querySelector('.select_empenhos') ){
	
	select_empenhos.addEventListener('change', function() {
		
		select_empenhos_array = select_empenhos.value.split('-');
		numero_despesa.value = select_empenhos_array[0];
		descricao_despesa.value = select_empenhos_array[1];
		
	});

}
/*End - Empenhos*/

/*Start - Tail Select*/
tail.select(".select_padrao",{
  width: "100%",
  search: false,
});
tail.select(".categoria_download",{
  width: "100%",
  search: false,
});
tail.select(".viculo_download",{
  width: "100%",
  search: true,
});
tail.select(".arquivo_download",{
  width: "100%",
  search: true,
});
tail.select(".select-licitacoes",{
  width: "100%",
  search: true,
});
tail.select(".select-documentos",{
  width: "100%",
  search: true,
});
tail.select(".select_aditivos",{
  width: "100%",
  search: true,
});
tail.select(".select_empenhos",{
  width: "100%",
  search: true,
});
tail.select( ".select_autor",{
width: "100%",
search: true,
} );
tail.select( ".submenu_link_id",{
width: "100%",
search: true,
} );
tail.select( ".submenu_menu_id",{
width: "100%",
search: true,
} );
/*End - Tail Select*/

/*Start - TinyMCE*/
/*
tinymce.init({
	selector: '.noticias-textarea',
	skin: 'oxide-dark',
	content_css: 'dark',
	height:300,
	plugins: "link image code",
	toolbar: 'undo redo | styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code'
});
*/
/*End - TinyMCE*/

/*Start - Loading*/
let loading = document.querySelector('.loading');

document.addEventListener("DOMContentLoaded", function() {
	
	loading.classList.remove('loading-on');
	
});
/*End - Loading*/

/*Start - Flickity*/
let card_noticias = document.querySelector('.card-noticias');

if( card_noticias ){
	
	let card_noticias_flickity = new Flickity( card_noticias, {

		cellAlign: 'left',
		contain: true,
		prevNextButtons: false,
		pageDots: false,
		wrapAround: true,
		autoPlay: 7000
	  
	});
	
	function flickity_prev(){ card_noticias_flickity.previous(); }
	function flickity_next(){ card_noticias_flickity.next(); }

}
/*End - Flickity*/