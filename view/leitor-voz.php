<!-- Start - view/leitor-voz.php !-->
<?php /* https://www.youtube.com/watch?v=y__W2hV5Ln8 */ ?>

<style><?php require 'css/leitor-voz.css'; ?></style>

<section class="leitor-voz" title="leitor-voz">
	
	<div class="box">
		
		<div class="leitor-voz-campo">
			<div class="leitor-voz-titulo">Escutar Conteúdo</div>
			<div class="leitor-voz-box">
				
				<div class="leitor-voz-col"><div class="leitor-voz-txt">Voz: </div></div>
				<div class="leitor-voz-col"><select class="leitor-voz-select" id="voiceList"></select></div>
				<div class="leitor-voz-col"><div class="leitor-voz-btn" id="btnSpeak"><span class="material-symbols-outlined">play_arrow</span></div></div>
				<div class="leitor-voz-col"><div class="leitor-voz-btn" id="btnStop"><span class="material-symbols-outlined">stop</span></div></div>
				
			</div>
		</div>
		
	</div>
	
</section>

<script>

	let voiceList = document.querySelector('#voiceList');
	let txtInput = document.querySelector('#ler_texto');
	let btnSpeak = document.querySelector('#btnSpeak');
	let btnStop = document.querySelector('#btnStop');
	
	let synth = window.speechSynthesis;
	let voices = [];
	
	NewVoices();
	
	if( speechSynthesis !== undefined ){
		
		speechSynthesis.onvoiceschanged = NewVoices
		
	}
	
	btnSpeak.addEventListener("click", function() {
		
		//console.log( txtInput.innerText );
		
		var toSpeak = new SpeechSynthesisUtterance( txtInput.innerText );
		var selecteVoiceName = voiceList.selectedOptions[0].getAttribute('data-name');
		
		voices.forEach(( voice ) => {
			
			if( voice.name === selecteVoiceName ){
				
				toSpeak.voice = voice;
				
			}
			
		});
		
		synth.speak( toSpeak );
		
	});
	
	btnStop.addEventListener("click", function() {
		
		synth.cancel();
		
	});
	
	function NewVoices(){
		
		voices = synth.getVoices();
		
		var selectedIndex = voiceList.selectedIndex < 0 ? 0 : voiceList.selectedIndex;
		
		voiceList.innerHTML = '';
		
		voices.forEach(( voice ) => {
			
			var listItem = document.createElement('option');
			listItem.textContent = voice.name;
			listItem.setAttribute('data-lang', voice.lang);
			listItem.setAttribute('data-name', voice.name);
			voiceList.appendChild( listItem );
			
		});
		
		voiceList.selectedIndex = selectedIndex;
		
	}
	
</script>
<!-- End - view/leitor-voz.php !-->