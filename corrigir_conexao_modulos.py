#!/usr/bin/env python3
"""
Script para corrigir automaticamente o fechamento prematuro
da conexão mysqli em arquivos controller.
"""

import os
import re
from pathlib import Path

def corrigir_arquivo(caminho_arquivo):
    """Corrige o arquivo movendo $conn->close() para depois de </html>."""
    try:
        with open(caminho_arquivo, 'r', encoding='utf-8', errors='ignore') as f:
            conteudo = f.read()
        
        linhas = conteudo.split('\n')
        
        # Encontrar linha com $conn->close() não comentado
        linha_close_idx = -1
        for i, linha in enumerate(linhas):
            if '$conn->close()' in linha and not linha.strip().startswith('//'):
                linha_close_idx = i
                break
        
        if linha_close_idx == -1:
            return False, "Não encontrou $conn->close() ativo"
        
        # Encontrar linha com </html>
        linha_html_idx = -1
        for i, linha in enumerate(linhas):
            if '</html>' in linha:
                linha_html_idx = i
                break
        
        if linha_html_idx == -1:
            return False, "Não encontrou </html>"
        
        # Verificar se close está antes de html
        if linha_close_idx >= linha_html_idx:
            return False, "Close já está depois de </html>"
        
        # Obter indentação da linha original
        linha_original = linhas[linha_close_idx]
        indentacao = len(linha_original) - len(linha_original.lstrip())
        
        # Comentar a linha do close original
        comentario = ' ' * indentacao + '// NÃO fechar a conexão aqui porque css-modulo.php precisa dela para carregar admin_user.php'
        linhas[linha_close_idx] = comentario + '\n' + ' ' * indentacao + '// ' + linha_original.strip()
        
        # Adicionar fechamento depois de </html>
        bloco_fechamento = [
            '<?php',
            'if (isset($conn)) {',
            '    $conn->close();',
            '}',
            '?>'
        ]
        
        # Inserir após </html>
        linhas.insert(linha_html_idx + 1, '\n'.join(bloco_fechamento))
        
        # Salvar arquivo
        novo_conteudo = '\n'.join(linhas)
        with open(caminho_arquivo, 'w', encoding='utf-8', newline='\n') as f:
            f.write(novo_conteudo)
        
        return True, f"Corrigido: linha {linha_close_idx + 1} → depois de {linha_html_idx + 1}"
        
    except Exception as e:
        return False, f"Erro: {str(e)}"

def main():
    """Função principal."""
    # Ler lista de arquivos
    lista_arquivo = Path(r'd:\Sites\fronteira\arquivos_corrigir_conexao.txt')
    
    if not lista_arquivo.exists():
        print("Arquivo arquivos_corrigir_conexao.txt não encontrado!")
        return
    
    with open(lista_arquivo, 'r', encoding='utf-8') as f:
        arquivos = [linha.strip() for linha in f if linha.strip()]
    
    print(f"Total de arquivos para corrigir: {len(arquivos)}\n")
    
    corrigidos = []
    erros = []
    
    for i, caminho in enumerate(arquivos, 1):
        caminho_path = Path(caminho)
        
        if not caminho_path.exists():
            erros.append((caminho, "Arquivo não existe"))
            continue
        
        sucesso, mensagem = corrigir_arquivo(caminho_path)
        
        if sucesso:
            corrigidos.append((caminho, mensagem))
            print(f"[{i}/{len(arquivos)}] ✓ {caminho_path.name}")
        else:
            erros.append((caminho, mensagem))
            print(f"[{i}/{len(arquivos)}] ✗ {caminho_path.name} - {mensagem}")
    
    # Resumo
    print(f"\n{'='*80}")
    print(f"RESUMO DA CORREÇÃO")
    print('='*80)
    print(f"Arquivos corrigidos com sucesso: {len(corrigidos)}")
    print(f"Arquivos com erro: {len(erros)}")
    
    if erros:
        print(f"\n{'='*80}")
        print(f"ERROS ENCONTRADOS")
        print('='*80)
        for arquivo, erro in erros:
            print(f"\n{arquivo}")
            print(f"  Erro: {erro}")
    
    print(f"\nCorreção concluída!")

if __name__ == '__main__':
    main()
