CREATE TABLE IF NOT EXISTS `licitacoes_anexos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ativo` int NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `nome` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_520_ci DEFAULT NULL,
  `arquivo` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_520_ci,
  `licitacao` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6502 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_520_ci;