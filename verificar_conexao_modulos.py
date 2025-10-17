#!/usr/bin/env python3
"""
Script para verificar arquivos controller que usam css-modulo.php
e fecham a conexão mysqli antes do fim do arquivo HTML.
"""

import os
import re
from pathlib import Path

def verificar_arquivo(caminho_arquivo):
    """Verifica se o arquivo tem o problema de conexão fechada prematuramente."""
    try:
        with open(caminho_arquivo, 'r', encoding='utf-8', errors='ignore') as f:
            conteudo = f.read()
        
        # Verificar se usa css-modulo.php
        if 'css-modulo.php' not in conteudo:
            return None
        
        # Verificar se tem $conn->close() não comentado antes de </html>
        linhas = conteudo.split('\n')
        
        tem_close_antes_html = False
        linha_close = -1
        linha_html = -1
        
        for i, linha in enumerate(linhas, 1):
            # Procurar $conn->close() não comentado
            if '$conn->close()' in linha and not linha.strip().startswith('//'):
                linha_close = i
            
            # Procurar </html>
            if '</html>' in linha:
                linha_html = i
                break
        
        # Se encontrou close antes de </html>, tem problema
        if linha_close > 0 and linha_html > 0 and linha_close < linha_html:
            tem_close_antes_html = True
        elif linha_close > 0 and linha_html == -1:
            # Tem close mas não tem </html> - pode ser problema também
            tem_close_antes_html = True
        
        if tem_close_antes_html:
            return {
                'arquivo': caminho_arquivo,
                'linha_close': linha_close,
                'linha_html': linha_html if linha_html > 0 else 'NÃO ENCONTRADO'
            }
        
        return None
        
    except Exception as e:
        print(f"Erro ao processar {caminho_arquivo}: {e}")
        return None

def main():
    """Função principal."""
    base_dir = Path(r'd:\Sites\fronteira\admin\modulos')
    
    arquivos_com_problema = []
    
    # Percorrer todos os arquivos controller/*.php
    for controller_file in base_dir.glob('**/controller/*.php'):
        resultado = verificar_arquivo(controller_file)
        if resultado:
            arquivos_com_problema.append(resultado)
    
    # Ordenar por caminho
    arquivos_com_problema.sort(key=lambda x: x['arquivo'])
    
    # Exibir resultados
    print(f"Total de arquivos com problema: {len(arquivos_com_problema)}\n")
    
    # Agrupar por módulo
    modulos = {}
    for item in arquivos_com_problema:
        # Extrair nome do módulo
        parts = Path(item['arquivo']).parts
        idx = parts.index('modulos')
        modulo = parts[idx + 1]
        
        if modulo not in modulos:
            modulos[modulo] = []
        modulos[modulo].append(item)
    
    # Exibir por módulo
    for modulo, arquivos in sorted(modulos.items()):
        print(f"\n{'='*80}")
        print(f"MÓDULO: {modulo}")
        print(f"Arquivos com problema: {len(arquivos)}")
        print('='*80)
        
        for item in arquivos:
            arquivo_rel = os.path.relpath(item['arquivo'], base_dir)
            print(f"\n  {arquivo_rel}")
            print(f"    $conn->close() na linha: {item['linha_close']}")
            print(f"    </html> na linha: {item['linha_html']}")
    
    # Resumo final
    print(f"\n\n{'='*80}")
    print(f"RESUMO")
    print('='*80)
    print(f"Total de módulos afetados: {len(modulos)}")
    print(f"Total de arquivos que precisam correção: {len(arquivos_com_problema)}")
    
    # Salvar lista de arquivos
    with open(r'd:\Sites\fronteira\arquivos_corrigir_conexao.txt', 'w', encoding='utf-8') as f:
        for item in arquivos_com_problema:
            f.write(f"{item['arquivo']}\n")
    
    print(f"\nLista de arquivos salvos em: arquivos_corrigir_conexao.txt")

if __name__ == '__main__':
    main()
