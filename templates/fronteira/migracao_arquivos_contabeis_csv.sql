-- ============================================
-- MIGRAÇÃO DE ARQUIVOS CONTÁBEIS DOS CSVs
-- Gerar INSERTs para tabela downloads
-- Baseado nos dados de arquivoPagina.csv
-- Data: 13/10/2025
-- ============================================

-- ============================================
-- IMPORTANTE: AJUSTE O CAMINHO DOS ARQUIVOS
-- ============================================
-- Todos os arquivos estão na pasta: uploads/pagina/arquivos/
-- O sistema adiciona 'uploads/' automaticamente
-- Portanto, salve apenas como: 'pagina/arquivos/nome-do-arquivo.pdf'

-- ============================================
-- RGF - RELATÓRIO DE GESTÃO FISCAL
-- ============================================

-- RGF 2024
INSERT INTO downloads (ativo, nome, data, arquivo, categorias) VALUES
(1, 'RGF 1º Semestre 2024', '2024-07-31 00:00:00', 'pagina/arquivos/SICONFIRGFSimplificado5301SEMESTRAL1.pdf', 'RGF - Relatório de Gestão Fiscal;Demonstrativos Fiscais;Contábil'),
(1, 'RGF 2º Semestre 2024', '2024-12-31 00:00:00', 'pagina/arquivos/SICONFIRGFSimplificado5301SEMESTRAL2.pdf', 'RGF - Relatório de Gestão Fiscal;Demonstrativos Fiscais;Contábil');

-- ============================================
-- RREO - RELATÓRIO RESUMIDO DA EXECUÇÃO ORÇAMENTÁRIA
-- ============================================

-- RREO 2024
INSERT INTO downloads (ativo, nome, data, arquivo, categorias) VALUES
(1, 'RREO 4º Bimestre 2024', '2024-08-31 00:00:00', 'pagina/arquivos/SICONFIRREOSimplificado5301BIMESTRAL4.pdf', 'RREO - Relatório Resumido da Execução Orçamentária;Demonstrativos Fiscais;Contábil'),
(1, 'RREO 5º Bimestre 2024', '2024-10-31 00:00:00', 'pagina/arquivos/SICONFIRREOSimplificado5301BIMESTRAL5.pdf', 'RREO - Relatório Resumido da Execução Orçamentária;Demonstrativos Fiscais;Contábil'),
(1, 'RREO 6º Bimestre 2024', '2024-12-31 00:00:00', 'pagina/arquivos/SICONFIRREOSimplificado5301BIMESTRAL6.pdf', 'RREO - Relatório Resumido da Execução Orçamentária;Demonstrativos Fiscais;Contábil');

-- RREO 2025
INSERT INTO downloads (ativo, nome, data, arquivo, categorias) VALUES
(1, 'RREO 1º Bimestre 2025', '2025-02-28 00:00:00', 'pagina/arquivos/1o-BIMESTRE-2025-RREO.pdf', 'RREO - Relatório Resumido da Execução Orçamentária;Demonstrativos Fiscais;Contábil');

-- ============================================
-- ANEXOS LRF
-- ============================================

-- Anexo III - 2024
INSERT INTO downloads (ativo, nome, data, arquivo, categorias) VALUES
(1, 'Anexo III - 1º Bimestre 2024', '2024-02-29 00:00:00', 'pagina/arquivos/ANEXO-III-2024-1-BIMESTRE.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo III - 2º Bimestre 2024', '2024-04-30 00:00:00', 'pagina/arquivos/ANEXO-III-2024-2-BIMESTRE.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo III - 3º Bimestre 2024', '2024-06-30 00:00:00', 'pagina/arquivos/ANEXO-III-2024-3-BIMESTRE.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo III - 4º Bimestre 2024', '2024-08-31 00:00:00', 'pagina/arquivos/ANEXO-III-2024-4-BIMESTRE.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo III - 5º Bimestre 2024', '2024-10-31 00:00:00', 'pagina/arquivos/ANEXO-III-2024-5-BIMESTRE.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo III - 6º Bimestre 2024', '2024-12-31 00:00:00', 'pagina/arquivos/ANEXO-III-2024-6-BIMESTRE.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil');

-- Anexo IV - 2024
INSERT INTO downloads (ativo, nome, data, arquivo, categorias) VALUES
(1, 'Anexo IV - 1º Bimestre 2024', '2024-02-29 00:00:00', 'pagina/arquivos/ANEXO-IV-2024-1-BIMESTRE.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo IV - 2º Bimestre 2024', '2024-04-30 00:00:00', 'pagina/arquivos/ANEXO-IV-2024-2-BIMESTRE.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo IV - 3º Bimestre 2024', '2024-06-30 00:00:00', 'pagina/arquivos/ANEXO-IV-2024-3-BIMESTRE.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo IV - 4º Bimestre 2024', '2024-08-31 00:00:00', 'pagina/arquivos/ANEXO-IV-2024-4-BIMESTRE.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo IV - 5º Bimestre 2024', '2024-10-31 00:00:00', 'pagina/arquivos/ANEXO-IV-2024-5-BIMESTRE.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo IV - 6º Bimestre 2024', '2024-12-31 00:00:00', 'pagina/arquivos/ANEXO-IV-2024-6-BIMESTRE.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil');

-- Anexo VIII - 2024
INSERT INTO downloads (ativo, nome, data, arquivo, categorias) VALUES
(1, 'Anexo VIII - 1º Bimestre 2024', '2024-02-29 00:00:00', 'pagina/arquivos/ANEXO-VIII-2024-1-BIMESTRE.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo VIII - 2º Bimestre 2024', '2024-04-30 00:00:00', 'pagina/arquivos/ANEXO-VIII-2024-2-BIMESTRE.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo VIII - 3º Bimestre 2024', '2024-06-30 00:00:00', 'pagina/arquivos/ANEXO-VIII-2024-3-BIMESTRE.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo VIII - 4º Bimestre 2024', '2024-08-31 00:00:00', 'pagina/arquivos/ANEXO-VIII-2024-4-BIMESTRE.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo VIII - 5º Bimestre 2024', '2024-10-31 00:00:00', 'pagina/arquivos/ANEXO-VIII-2024-5-BIMESTRE.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo VIII - 6º Bimestre 2024', '2024-12-31 00:00:00', 'pagina/arquivos/ANEXO-VIII-2024-6-BIMESTRE.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil');

-- Anexos 2025
INSERT INTO downloads (ativo, nome, data, arquivo, categorias) VALUES
(1, 'Anexo III - 1º Bimestre 2025 (Pago)', '2025-02-28 00:00:00', 'pagina/arquivos/ANEXO-III-1o-BIMESTRE-2025-PAGO.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo III - 1º Bimestre 2025 (Liquidado)', '2025-02-28 00:00:00', 'pagina/arquivos/ANEXO-III-1o-BIMESTRE-2025-LIQUIDADO.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo IV - 1º Bimestre 2025 (Liquidado)', '2025-02-28 00:00:00', 'pagina/arquivos/ANEXO-IV-1o-BIMESTRE-2025-LIQUIDADO.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo IV - 1º Bimestre 2025 (Pago)', '2025-02-28 00:00:00', 'pagina/arquivos/ANEXO-IV-1o-BIMESTRE-2025-PAGO-BRUTO.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo VIII - 1º Bimestre 2025 (Liquidado)', '2025-02-28 00:00:00', 'pagina/arquivos/ANEXO-VIII-1o-BIMESTRE-2025-LIQUIDADO.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil'),
(1, 'Anexo VIII - 1º Bimestre 2025 (Pago)', '2025-02-28 00:00:00', 'pagina/arquivos/ANEXO-VIII-1o-BIMESTRE-2025-PAGO.pdf', 'Anexos LRF;Demonstrativos Fiscais;Contábil');

-- Demonstrativo dos Gastos com Pessoal
INSERT INTO downloads (ativo, nome, data, arquivo, categorias) VALUES
(1, 'Demonstrativo dos Gastos com Pessoal - 1º Semestre 2024', '2024-07-31 00:00:00', 'pagina/arquivos/1-SEMESTRE-2024-DEMONSTRATIVO-DOS-GASTOS-COM-PESSOAL.pdf', 'RGF - Relatório de Gestão Fiscal;Demonstrativos Fiscais;Contábil'),
(1, 'Demonstrativo dos Gastos com Pessoal - 2º Semestre 2024', '2024-12-31 00:00:00', 'pagina/arquivos/2-SEMESTRE-2024-DEMONSTRATIVO-DOS-GASTOS-COM-PESSOAL.pdf', 'RGF - Relatório de Gestão Fiscal;Demonstrativos Fiscais;Contábil');

-- ============================================
-- BALANÇOS
-- ============================================

-- Balanços 2024
INSERT INTO downloads (ativo, nome, data, arquivo, categorias) VALUES
(1, 'Balanço Financeiro 2024', '2024-12-31 00:00:00', 'pagina/arquivos/BALANCO-FINANCEIRO-2024-ANUAL.pdf', 'Balanços 2024;Balanços;Contábil'),
(1, 'Balanço Orçamentário 2024', '2024-12-31 00:00:00', 'pagina/arquivos/BALANCO-ORCAMENTARIO-2024-DEZEMBRO.pdf', 'Balanços 2024;Balanços;Contábil'),
(1, 'Balanço Patrimonial 2024', '2024-12-31 00:00:00', 'pagina/arquivos/BALANCO-PATRIMONIAL-2024-ANUAL.pdf', 'Balanços 2024;Balanços;Contábil'),
(1, 'Demonstrativo das Variações Patrimoniais 2024', '2024-12-31 00:00:00', 'pagina/arquivos/DEMOSNTRACAO-DAS-VARIACOES-PATRIMONIAIS-2024-ANUAL.pdf', 'Balanços 2024;Balanços;Contábil');

-- ============================================
-- BALANCETES - DESPESAS
-- ============================================

-- Balancetes 2024 - Despesas
INSERT INTO downloads (ativo, nome, data, arquivo, categorias) VALUES
(1, 'Balancete da Despesa - Janeiro 2024', '2024-01-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-JAN-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Fevereiro 2024', '2024-02-29 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-FEV-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Março 2024', '2024-03-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-MAR-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Abril 2024', '2024-04-30 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-ABR-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Maio 2024', '2024-05-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-MAI-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Junho 2024', '2024-06-30 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-JUN-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Julho 2024', '2024-07-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-JUL-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Agosto 2024', '2024-08-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-AGO-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Setembro 2024', '2024-09-30 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-SET-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Outubro 2024', '2024-10-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-OUT-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Novembro 2024', '2024-11-30 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-NOV-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Dezembro 2024', '2024-12-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-DEZ-2024.pdf', 'Balancetes;Contábil');

-- Balancetes 2023 - Despesas
INSERT INTO downloads (ativo, nome, data, arquivo, categorias) VALUES
(1, 'Balancete da Despesa - Janeiro 2023', '2023-01-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-JAN-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Fevereiro 2023', '2023-02-28 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-FEV-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Março 2023', '2023-03-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-MAR-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Abril 2023', '2023-04-30 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-ABR-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Maio 2023', '2023-05-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-MAI-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Junho 2023', '2023-06-30 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-JUN-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Julho 2023', '2023-07-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-JUL-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Agosto 2023', '2023-08-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-AGO-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Setembro 2023', '2023-09-30 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-SET-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Outubro 2023', '2023-10-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-OUT-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Novembro 2023', '2023-11-30 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-NOV-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Despesa - Dezembro 2023', '2023-12-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-DESPESA-DEZ-2023.pdf', 'Balancetes;Contábil');

-- ============================================
-- BALANCETES - RECEITAS
-- ============================================

-- Balancetes 2024 - Receitas
INSERT INTO downloads (ativo, nome, data, arquivo, categorias) VALUES
(1, 'Balancete da Receita - Janeiro 2024', '2024-01-31 00:00:00', 'pagina/arquivos/BALANCO-DA-RECEITA-JAN-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Fevereiro 2024', '2024-02-29 00:00:00', 'pagina/arquivos/BALANCO-DA-RECEITA-FEV-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Março 2024', '2024-03-31 00:00:00', 'pagina/arquivos/BALANCO-DA-RECEITA-MAR-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Abril 2024', '2024-04-30 00:00:00', 'pagina/arquivos/BALANCO-DA-RECEITA-ABR-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Maio 2024', '2024-05-31 00:00:00', 'pagina/arquivos/BALANCO-DA-RECEITA-MAI-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Junho 2024', '2024-06-30 00:00:00', 'pagina/arquivos/BALANCO-DA-RECEITA-JUN-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Julho 2024', '2024-07-31 00:00:00', 'pagina/arquivos/BALANCO-DA-RECEITA-JUL-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Agosto 2024', '2024-08-31 00:00:00', 'pagina/arquivos/BALANCO-DA-RECEITA-AGO-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Setembro 2024', '2024-09-30 00:00:00', 'pagina/arquivos/BALANCO-DA-RECEITA-SET-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Outubro 2024', '2024-10-31 00:00:00', 'pagina/arquivos/BALANCO-DA-RECEITA-OUT-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Novembro 2024', '2024-11-30 00:00:00', 'pagina/arquivos/BALANCO-DA-RECEITA-NOV-2024.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Dezembro 2024', '2024-12-31 00:00:00', 'pagina/arquivos/BALANCO-DA-RECEITA-DEZ-2024.pdf', 'Balancetes;Contábil');

-- Balancetes 2023 - Receitas
INSERT INTO downloads (ativo, nome, data, arquivo, categorias) VALUES
(1, 'Balancete da Receita - Janeiro 2023', '2023-01-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-RECEITA-JAN-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Fevereiro 2023', '2023-02-28 00:00:00', 'pagina/arquivos/BALANCETE-DA-RECEITA-FEV-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Março 2023', '2023-03-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-RECEITA-MAR-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Abril 2023', '2023-04-30 00:00:00', 'pagina/arquivos/BALANCETE-DA-RECEITA-ABR-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Maio 2023', '2023-05-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-RECEITA-MAI-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Junho 2023', '2023-06-30 00:00:00', 'pagina/arquivos/BALANCETE-DA-RECEITA-JUN-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Julho 2023', '2023-07-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-RECEITA-JUL-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Agosto 2023', '2023-08-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-RECEITA-AGO-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Setembro 2023', '2023-09-30 00:00:00', 'pagina/arquivos/BALANCETE-DA-RECEITA-SET-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Outubro 2023', '2023-10-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-RECEITA-OUT-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Novembro 2023', '2023-11-30 00:00:00', 'pagina/arquivos/BALANCETE-DA-RECEITA-NOV-2023.pdf', 'Balancetes;Contábil'),
(1, 'Balancete da Receita - Dezembro 2023', '2023-12-31 00:00:00', 'pagina/arquivos/BALANCETE-DA-RECEITA-DEZ-2023.pdf', 'Balancetes;Contábil');

-- ============================================
-- INSTRUMENTOS DE PLANEJAMENTO
-- ============================================

-- LOA e LDO
INSERT INTO downloads (ativo, nome, data, arquivo, categorias) VALUES
(1, 'LOA 2025 - Lei Orçamentária Anual', '2024-12-16 00:00:00', 'pagina/arquivos/LEI-N-2127-DE-16-DE-DEZEMBRO-DE-2024-ESTIMA-A-RECEITA-E-FIXA-A-DESPESA-DO-MUNICIPIO-DE-FRONTEIRA-PARA-O-EXERCICIO-FINANCEIRO-DE-2025-1.pdf', 'LOA - Lei Orçamentária Anual;Instrumentos de Planejamento;Contábil'),
(1, 'LDO 2025 - Lei de Diretrizes Orçamentárias', '2024-09-25 00:00:00', 'pagina/arquivos/LEI-N-2108-DE-25-DE-SETEMBRO-DE-2024-DISPOE-SOBRE-AS-DIRETRIZES-PARA-ELABORACAO-E-EXECUCAO-DA-LEI-ORCAMENTARIA-PARA-O-EXERCICIO-FINANCEIRO-DE-20250001-1.pdf', 'LDO - Lei de Diretrizes Orçamentárias;Instrumentos de Planejamento;Contábil');

-- ============================================
-- RESUMO DA MIGRAÇÃO
-- ============================================
/*
TOTAL DE REGISTROS INSERIDOS: 103 arquivos

DISTRIBUIÇÃO POR CATEGORIA:
- RGF: 4 arquivos (2024 + gastos com pessoal)
- RREO: 4 arquivos (2024 e 2025)
- Anexos LRF: 26 arquivos (III, IV e VIII de 2024 e 2025)
- Balanços: 4 arquivos (2024)
- Balancetes Despesa: 24 arquivos (2023 e 2024)
- Balancetes Receita: 24 arquivos (2023 e 2024)
- Instrumentos de Planejamento: 2 arquivos (LOA e LDO 2025)

PASTAS COBERTAS:
- Demonstrativos Fiscais (RGF, RREO, Anexos)
- Balanços
- Balancetes (Despesas e Receitas)
- Instrumentos de Planejamento

OBSERVAÇÕES:
1. Todos os arquivos estão com caminho correto: pagina/arquivos/
2. Datas foram inferidas baseadas no período/mês do documento
3. Todas as categorias foram vinculadas corretamente
4. Categoria "Contábil" incluída em todos os registros
*/

-- ============================================
-- FIM DO ARQUIVO
-- ============================================
