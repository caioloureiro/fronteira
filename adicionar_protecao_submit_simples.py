#!/usr/bin/env python3
"""
Script SIMPLES para adicionar proteção JavaScript contra submit múltiplo
em TODOS os arquivos novo-02.php encontrados.
"""

import os
import re
from pathlib import Path

def adicionar_protecao_js(arquivo):
    """Adiciona proteção JavaScript no arquivo."""
    try:
        with open(arquivo, 'r', encoding='utf-8', errors='ignore') as f:
            conteudo = f.read()
        
        # Verificar se já tem a proteção
        if 'PROTEÇÃO CONTRA SUBMIT MÚLTIPLO' in conteudo:
            return False, "Já possui proteção"
        
        # Verificar se tem formulário
        if '<form' not in conteudo.lower():
            return False, "Não tem formulário"
        
        # Procurar pelo padrão </script> antes de </body>
        padrao_script_body = r'(</script>)(\s*</body>)'
        
        if not re.search(padrao_script_body, conteudo, re.IGNORECASE):
            return False, "Padrão não encontrado"
        
        # Código de proteção
        protecao = '''
		/*Start - PROTEÇÃO CONTRA SUBMIT MÚLTIPLO*/
		(function() {
			const form = document.querySelector('form');
			const submitButton = document.querySelector('button[type="submit"]');
			
			if (form && submitButton) {
				let formularioEnviado = false;
				
				form.addEventListener('submit', function(e) {
					if (formularioEnviado) {
						e.preventDefault();
						alert('O formulário já está sendo processado. Por favor, aguarde.');
						return false;
					}
					
					formularioEnviado = true;
					submitButton.disabled = true;
					submitButton.textContent = 'Gravando...';
					submitButton.style.opacity = '0.6';
					submitButton.style.cursor = 'not-allowed';
				});
			}
		})();
		/*End - PROTEÇÃO CONTRA SUBMIT MÚLTIPLO*/
		'''
        
        # Inserir antes do </script>
        novo_conteudo = re.sub(
            padrao_script_body,
            protecao + r'\1\2',
            conteudo,
            flags=re.IGNORECASE
        )
        
        # Salvar
        with open(arquivo, 'w', encoding='utf-8', newline='\n') as f:
            f.write(novo_conteudo)
        
        return True, "✓ Proteção adicionada"
        
    except Exception as e:
        return False, f"Erro: {str(e)}"

def main():
    base_dir = Path(r'd:\Sites\fronteira\admin\modulos')
    
    # Buscar TODOS os arquivos novo-02.php
    arquivos = list(base_dir.glob('*/view/novo-02.php'))
    
    print(f"Encontrados {len(arquivos)} arquivos novo-02.php\n")
    
    sucesso_count = 0
    ja_tem_count = 0
    erro_count = 0
    
    for i, arquivo in enumerate(sorted(arquivos), 1):
        modulo = arquivo.parts[-3]
        
        sucesso, msg = adicionar_protecao_js(arquivo)
        
        if sucesso:
            print(f"[{i:2d}/{len(arquivos)}] ✓ {modulo:30s} - {msg}")
            sucesso_count += 1
        elif 'Já possui' in msg:
            print(f"[{i:2d}/{len(arquivos)}] ○ {modulo:30s} - {msg}")
            ja_tem_count += 1
        else:
            print(f"[{i:2d}/{len(arquivos)}] ✗ {modulo:30s} - {msg}")
            erro_count += 1
    
    print(f"\n{'='*70}")
    print(f"RESUMO:")
    print(f"  ✓ Proteção adicionada: {sucesso_count}")
    print(f"  ○ Já possuía proteção: {ja_tem_count}")
    print(f"  ✗ Não processados: {erro_count}")
    print(f"  Total: {len(arquivos)}")
    print(f"{'='*70}")

if __name__ == '__main__':
    main()
