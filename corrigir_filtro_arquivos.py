#!/usr/bin/env python3
"""
Script para corrigir o filtro input em todos os arquivos.php
"""

import os
import re
from pathlib import Path

def corrigir_filtro(arquivo):
    """Corrige o código do filtro reativo."""
    try:
        with open(arquivo, 'r', encoding='utf-8', errors='ignore') as f:
            conteudo = f.read()
        
        # Verificar se tem o problema
        if '.escolher-imagem-cards-card' not in conteudo:
            return False, "Já está correto ou estrutura diferente"
        
        # Substituir o código problemático
        codigo_antigo = r"let card = itens\.querySelectorAll\('\.escolher-imagem-cards-card'\);\s+for\( let i = 0; i < card\.length; i\+ \){\s+let a = card\[i\]\.querySelector\('\.escolher-imagem-cards-titulo'\);\s+if\( a\.innerHTML\.toUpperCase\(\)\.indexOf\( itens_busca \) > -1 \){\s+card\[i\]\.style\.display = '';\s+}else{\s+card\[i\]\.style\.display = 'none';\s+}"
        
        codigo_novo = """let linhas = itens.querySelectorAll('.linha');
			
			for( let i = 0; i < linhas.length; i++ ){

				let texto = linhas[i].querySelector('span');
				
				if( texto && texto.innerHTML.toUpperCase().indexOf( itens_busca ) > -1 ){
					
					linhas[i].style.display = '';
					
				}else{
					
					linhas[i].style.display = 'none';
					
				}
				
			}"""
        
        # Tentar substituição mais simples
        if "let card = itens.querySelectorAll('.escolher-imagem-cards-card');" in conteudo:
            conteudo = conteudo.replace(
                "let card = itens.querySelectorAll('.escolher-imagem-cards-card');",
                "let linhas = itens.querySelectorAll('.linha');"
            )
            conteudo = conteudo.replace(
                "for( let i = 0; i < card.length; i++ ){",
                "for( let i = 0; i < linhas.length; i++ ){"
            )
            conteudo = conteudo.replace(
                "let a = card[i].querySelector('.escolher-imagem-cards-titulo');",
                "let texto = linhas[i].querySelector('span');"
            )
            conteudo = conteudo.replace(
                "if( a.innerHTML.toUpperCase().indexOf( itens_busca ) > -1 ){",
                "if( texto && texto.innerHTML.toUpperCase().indexOf( itens_busca ) > -1 ){"
            )
            conteudo = conteudo.replace(
                "card[i].style.display = '';",
                "linhas[i].style.display = '';"
            )
            conteudo = conteudo.replace(
                "card[i].style.display = 'none';",
                "linhas[i].style.display = 'none';"
            )
            
            # Salvar
            with open(arquivo, 'w', encoding='utf-8', newline='\n') as f:
                f.write(conteudo)
            
            return True, "✓ Filtro corrigido"
        
        return False, "Padrão não encontrado para substituição"
        
    except Exception as e:
        return False, f"Erro: {str(e)}"

def main():
    base_dir = Path(r'd:\Sites\fronteira\admin\modulos')
    
    # Buscar todos os arquivos.php
    arquivos = list(base_dir.glob('*/view/arquivos.php'))
    
    print(f"Encontrados {len(arquivos)} arquivos arquivos.php\n")
    
    sucesso_count = 0
    ja_ok_count = 0
    erro_count = 0
    
    for arquivo in sorted(arquivos):
        modulo = arquivo.parts[-3]
        
        sucesso, msg = corrigir_filtro(arquivo)
        
        if sucesso:
            print(f"✓ {modulo:35s} - {msg}")
            sucesso_count += 1
        elif 'Já está correto' in msg:
            print(f"○ {modulo:35s} - {msg}")
            ja_ok_count += 1
        else:
            print(f"✗ {modulo:35s} - {msg}")
            erro_count += 1
    
    print(f"\n{'='*70}")
    print(f"RESUMO:")
    print(f"  ✓ Corrigidos: {sucesso_count}")
    print(f"  ○ Já estavam corretos: {ja_ok_count}")
    print(f"  ✗ Não processados: {erro_count}")
    print(f"  Total: {len(arquivos)}")
    print(f"{'='*70}")

if __name__ == '__main__':
    main()
