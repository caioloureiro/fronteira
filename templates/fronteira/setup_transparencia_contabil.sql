-- ============================================
-- SETUP TRANSPARÊNCIA CONTÁBIL
-- Sistema de downloads e categorias para área contábil
-- Data: 13/10/2025
-- ============================================

-- ============================================
-- CATEGORIAS PARA DOWNLOADS CONTÁBEIS
-- ============================================

-- Inserir categorias na tabela categorias
INSERT INTO `categorias` (`ativo`, `nome`) VALUES
(1, 'Contábil'),
(1, 'Instrumentos de Planejamento'),
(1, 'Repasse ao Legislativo'),
(1, 'Balancetes'),
(1, 'Balanços 2025'),
(1, 'Balanços 2024'),
(1, 'Balanços 2023'),
(1, 'Balanços 2022'),
(1, 'Balanços 2021'),
(1, 'Demonstrativos Fiscais'),
(1, 'Prestação de Contas TCEMG'),
(1, 'RREO - Relatório Resumido da Execução Orçamentária'),
(1, 'RGF - Relatório de Gestão Fiscal'),
(1, 'LRF - Lei de Responsabilidade Fiscal'),
(1, 'PPA - Plano Plurianual'),
(1, 'LDO - Lei de Diretrizes Orçamentárias'),
(1, 'LOA - Lei Orçamentária Anual'),
(1, 'Anexos LRF'),
(1, 'Relatórios Bimestrais'),
(1, 'Relatórios Quadrimestrais'),
(1, 'Relatórios Anuais');

-- ============================================
-- EXEMPLOS DE DOWNLOADS (ESTRUTURA)
-- ============================================

-- Exemplo de estrutura para inserir downloads
-- IMPORTANTE: Substituir pelos arquivos reais que serão enviados

-- Exemplo: PPA
INSERT INTO `downloads` (`ativo`, `nome`, `data`, `arquivo`, `categorias`) VALUES
(1, 'PPA 2022-2025', '2022-01-15 00:00:00', 'ppa-2022-2025.pdf', 'PPA - Plano Plurianual;Instrumentos de Planejamento;Contábil');

-- Exemplo: LDO
INSERT INTO `downloads` (`ativo`, `nome`, `data`, `arquivo`, `categorias`) VALUES
(1, 'LDO 2025', '2024-07-15 00:00:00', 'ldo-2025.pdf', 'LDO - Lei de Diretrizes Orçamentárias;Instrumentos de Planejamento;Contábil');

-- Exemplo: LOA
INSERT INTO `downloads` (`ativo`, `nome`, `data`, `arquivo`, `categorias`) VALUES
(1, 'LOA 2025', '2024-12-20 00:00:00', 'loa-2025.pdf', 'LOA - Lei Orçamentária Anual;Instrumentos de Planejamento;Contábil');

-- Exemplo: Balanço
INSERT INTO `downloads` (`ativo`, `nome`, `data`, `arquivo`, `categorias`) VALUES
(1, 'Balanço Anual 2024', '2025-03-31 00:00:00', 'balanco-anual-2024.pdf', 'Balanços 2024;Balanços;Contábil');

-- Exemplo: RREO
INSERT INTO `downloads` (`ativo`, `nome`, `data`, `arquivo`, `categorias`) VALUES
(1, 'RREO 1º Bimestre 2025', '2025-03-01 00:00:00', 'rreo-1-bimestre-2025.pdf', 'RREO - Relatório Resumido da Execução Orçamentária;Demonstrativos Fiscais;Contábil');

-- Exemplo: RGF
INSERT INTO `downloads` (`ativo`, `nome`, `data`, `arquivo`, `categorias`) VALUES
(1, 'RGF 1º Quadrimestre 2025', '2025-05-30 00:00:00', 'rgf-1-quadrimestre-2025.pdf', 'RGF - Relatório de Gestão Fiscal;Demonstrativos Fiscais;Contábil');

-- Exemplo: Prestação de Contas
INSERT INTO `downloads` (`ativo`, `nome`, `data`, `arquivo`, `categorias`) VALUES
(1, 'Prestação de Contas 2024 - TCEMG', '2025-03-31 00:00:00', 'prestacao-contas-2024-tcemg.pdf', 'Prestação de Contas TCEMG;Demonstrativos Fiscais;Contábil');

-- Exemplo: Balancete
INSERT INTO `downloads` (`ativo`, `nome`, `data`, `arquivo`, `categorias`) VALUES
(1, 'Balancete Janeiro/2025', '2025-02-15 00:00:00', 'balancete-janeiro-2025.pdf', 'Balancetes;Contábil');

-- Exemplo: Repasse ao Legislativo
INSERT INTO `downloads` (`ativo`, `nome`, `data`, `arquivo`, `categorias`) VALUES
(1, 'Repasse ao Legislativo - Janeiro/2025', '2025-01-20 00:00:00', 'repasse-legislativo-janeiro-2025.pdf', 'Repasse ao Legislativo;Contábil');

-- ============================================
-- INSTRUÇÕES DE USO
-- ============================================

/*
COMO USAR ESTE SISTEMA:

1. CATEGORIAS:
   - As categorias já estão criadas e prontas para uso
   - Para adicionar nova categoria: INSERT INTO categorias (ativo, nome) VALUES (1, 'Nome da Categoria');

2. ADICIONAR DOWNLOADS:
   - Use o painel administrativo em: /admin/matriz?pagina=downloads
   - Ou insira diretamente no banco:
   
   INSERT INTO downloads (ativo, nome, data, arquivo, categorias) VALUES
   (1, 'Título do Documento', NOW(), 'nome-do-arquivo.pdf', 'Categoria1;Categoria2');
   
   IMPORTANTE: 
   - As categorias devem ser separadas por ponto-e-vírgula (;)
   - O nome da categoria deve ser EXATAMENTE igual ao cadastrado na tabela categorias
   - O arquivo deve estar na pasta /uploads/

3. VISUALIZAR DOWNLOADS POR CATEGORIA:
   - URL: /downloads?categoria=nome-da-categoria
   - Exemplo: /downloads?categoria=balancos-2025
   - O sistema automaticamente busca na tabela categorias e filtra os downloads

4. ESTRUTURA DE CATEGORIAS (use no campo categorias):
   - Categoria Principal: "Contábil"
   - Sempre inclua a categoria específica + "Contábil"
   - Exemplo: "Balanços 2025;Balanços;Contábil"
   
5. MANUTENÇÃO:
   - Para adicionar novo ano de balanços: Crie nova categoria "Balanços XXXX"
   - Para novos tipos de documentos: Crie nova categoria
   - Sempre mantenha a categoria "Contábil" para filtros gerais

6. EXEMPLOS DE USO:
   - Ver todos documentos contábeis: /downloads?categoria=contabil
   - Ver balanços de 2025: /downloads?categoria=balancos-2025
   - Ver RREO: /downloads?categoria=rreo-relatorio-resumido-da-execucao-orcamentaria
   - Ver RGF: /downloads?categoria=rgf-relatorio-de-gestao-fiscal
*/

-- ============================================
-- QUERIES ÚTEIS PARA MANUTENÇÃO
-- ============================================

-- Ver todas as categorias
-- SELECT * FROM categorias WHERE ativo = 1 ORDER BY nome;

-- Ver todos os downloads de uma categoria
-- SELECT * FROM downloads WHERE categorias LIKE '%Balanços 2025%' AND ativo = 1;

-- Ver downloads sem categoria
-- SELECT * FROM downloads WHERE categorias IS NULL OR categorias = '' AND ativo = 1;

-- Atualizar categoria de um download
-- UPDATE downloads SET categorias = 'Nova Categoria;Contábil' WHERE id = X;

-- Adicionar categoria a um download existente
-- UPDATE downloads SET categorias = CONCAT(categorias, ';Nova Categoria') WHERE id = X;

-- ============================================
-- FIM DO SETUP
-- ============================================
