-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.5.8-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para saimob
DROP DATABASE IF EXISTS `saimob`;
CREATE DATABASE IF NOT EXISTS `saimob` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `saimob`;

-- Copiando estrutura para tabela saimob.contracts
DROP TABLE IF EXISTS `contracts`;
CREATE TABLE IF NOT EXISTS `contracts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `property` int(10) unsigned NOT NULL,
  `owner` int(10) unsigned NOT NULL,
  `customer` int(10) unsigned NOT NULL,
  `rent_price` decimal(10,2) NOT NULL,
  `adm_fee` decimal(10,2) NOT NULL,
  `tribute` decimal(10,2) NOT NULL,
  `condominium` decimal(10,2) DEFAULT NULL,
  `start_at` date NOT NULL,
  `end_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contracts_property_foreign` (`property`),
  KEY `contracts_owner_foreign` (`owner`),
  KEY `contracts_customer_foreign` (`customer`),
  CONSTRAINT `contracts_customer_foreign` FOREIGN KEY (`customer`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `contracts_owner_foreign` FOREIGN KEY (`owner`) REFERENCES `owners` (`id`) ON DELETE CASCADE,
  CONSTRAINT `contracts_property_foreign` FOREIGN KEY (`property`) REFERENCES `properties` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela saimob.contracts: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `contracts` DISABLE KEYS */;
REPLACE INTO `contracts` (`id`, `property`, `owner`, `customer`, `rent_price`, `adm_fee`, `tribute`, `condominium`, `start_at`, `end_at`, `created_at`, `updated_at`, `status`) VALUES
	(1, 1, 1, 1, 1200.00, 120.00, 45.00, 250.00, '2020-12-08', '2021-12-08', '2020-12-08 18:46:46', '2020-12-08 23:22:29', 'active'),
	(2, 2, 4, 2, 1800.00, 180.00, 54.00, 450.00, '2020-06-01', '2021-06-01', '2020-12-08 19:34:50', '2020-12-08 19:34:50', 'pending'),
	(3, 3, 7, 3, 2500.00, 250.00, 80.00, NULL, '2021-01-01', '2022-01-01', '2020-12-08 23:25:09', '2020-12-08 23:25:09', 'pending');
/*!40000 ALTER TABLE `contracts` ENABLE KEYS */;

-- Copiando estrutura para tabela saimob.customers
DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`),
  UNIQUE KEY `customers_telephone_unique` (`telephone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela saimob.customers: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
REPLACE INTO `customers` (`id`, `name`, `email`, `telephone`, `created_at`, `updated_at`) VALUES
	(1, 'Sidney Andrade', 'sidney@sidneyandrade.com.br', '47991158947', '2020-12-07 22:37:44', '2020-12-07 22:37:44'),
	(2, 'Pedro Paulo', 'pedro@pedro.com.br', '47954578785', '2020-12-08 19:31:20', '2020-12-08 19:31:20'),
	(3, 'Marcelo Oliveira', 'marcelo@marcelo.com.br', '47985548784', '2020-12-08 23:17:59', '2020-12-08 23:17:59');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

-- Copiando estrutura para tabela saimob.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela saimob.migrations: ~14 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2020_12_05_143107_create_customers_table', 1),
	(4, '2020_12_05_200556_create_owners_table', 1),
	(5, '2020_12_05_211058_create_properties_table', 1),
	(6, '2020_12_06_113310_create_contracts_table', 1),
	(7, '2020_12_06_182728_create_monthly_payments_table', 1),
	(8, '2020_12_06_182950_create_transfers_table', 1),
	(9, '2020_12_07_154614_alter_properties_table_add_status', 1),
	(10, '2020_12_07_154743_alter_contracts_table_add_status', 1),
	(11, '2020_12_07_221102_alter_users_table_add_control_login', 1),
	(12, '2020_12_07_221252_alter_users_table_document_cover', 1),
	(13, '2020_12_08_070948_create_transfers_table', 2),
	(14, '2020_12_08_153040_create_rents_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Copiando estrutura para tabela saimob.owners
DROP TABLE IF EXISTS `owners`;
CREATE TABLE IF NOT EXISTS `owners` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_transfer` tinyint(3) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `owners_email_unique` (`email`),
  UNIQUE KEY `owners_telephone_unique` (`telephone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela saimob.owners: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `owners` DISABLE KEYS */;
REPLACE INTO `owners` (`id`, `name`, `email`, `telephone`, `day_transfer`, `created_at`, `updated_at`) VALUES
	(1, 'Maria dos Santos', 'maria@maria.com.br', '4754548585', 10, '2020-12-07 23:10:30', '2020-12-07 23:10:30'),
	(4, 'Antonio Carlos', 'carlos@carlos.com.br', '47988955457', 15, '2020-12-08 19:31:48', '2020-12-08 19:31:48'),
	(7, 'Sidney Andrade', 'sidney@sidney.com.br', '47989457878', 15, '2020-12-08 23:18:43', '2020-12-08 23:18:43');
/*!40000 ALTER TABLE `owners` ENABLE KEYS */;

-- Copiando estrutura para tabela saimob.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela saimob.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Copiando estrutura para tabela saimob.properties
DROP TABLE IF EXISTS `properties`;
CREATE TABLE IF NOT EXISTS `properties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `zipcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `neighborhood` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `properties_owner_foreign` (`owner`),
  CONSTRAINT `properties_owner_foreign` FOREIGN KEY (`owner`) REFERENCES `owners` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela saimob.properties: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `properties` DISABLE KEYS */;
REPLACE INTO `properties` (`id`, `owner`, `created_at`, `updated_at`, `zipcode`, `street`, `number`, `complement`, `neighborhood`, `state`, `city`, `status`) VALUES
	(1, 1, '2020-12-07 23:13:33', '2020-12-08 23:22:29', '89218075', 'Rua Almirante Jaceguay', '880', 'Apto 706 bl 03', 'Santo Antônio', 'SC', 'Joinville', 0),
	(2, 4, '2020-12-08 19:34:13', '2020-12-08 19:34:13', '89218000', 'Rua Presidente Prudente de Moraes', '613', 'Ap 802 bloco 2', 'Santo Antônio', 'SC', 'Joinville', 1),
	(3, 7, '2020-12-08 23:19:47', '2020-12-08 23:19:47', '89220000', 'Rua Inambu', '123', 'casa', 'Costa e Silva', 'SC', 'Joinville', 1);
/*!40000 ALTER TABLE `properties` ENABLE KEYS */;

-- Copiando estrutura para tabela saimob.rents
DROP TABLE IF EXISTS `rents`;
CREATE TABLE IF NOT EXISTS `rents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enrollment` int(10) unsigned NOT NULL,
  `contract` int(10) unsigned NOT NULL,
  `customer` int(10) unsigned NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `due_at` date NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rents_customer_foreign` (`customer`),
  CONSTRAINT `rents_customer_foreign` FOREIGN KEY (`customer`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela saimob.rents: ~36 rows (aproximadamente)
/*!40000 ALTER TABLE `rents` DISABLE KEYS */;
REPLACE INTO `rents` (`id`, `enrollment`, `contract`, `customer`, `value`, `due_at`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, 1146.17, '2021-01-01', 'paid', '2020-12-08 18:46:46', '2020-12-09 09:28:34'),
	(2, 2, 1, 1, 1495.00, '2021-02-01', 'paid', '2020-12-08 18:46:46', '2020-12-09 09:28:36'),
	(3, 3, 1, 1, 1495.00, '2021-03-01', 'unpaid', '2020-12-08 18:46:46', '2020-12-08 22:50:59'),
	(4, 4, 1, 1, 1495.00, '2021-04-01', 'unpaid', '2020-12-08 18:46:46', '2020-12-08 22:51:02'),
	(5, 5, 1, 1, 1495.00, '2021-05-01', 'unpaid', '2020-12-08 18:46:46', '2020-12-08 18:46:46'),
	(6, 6, 1, 1, 1495.00, '2021-06-01', 'unpaid', '2020-12-08 18:46:46', '2020-12-08 18:46:46'),
	(7, 7, 1, 1, 1495.00, '2021-07-01', 'unpaid', '2020-12-08 18:46:46', '2020-12-08 18:46:46'),
	(8, 8, 1, 1, 1495.00, '2021-08-01', 'unpaid', '2020-12-08 18:46:46', '2020-12-08 18:46:46'),
	(9, 9, 1, 1, 1495.00, '2021-09-01', 'unpaid', '2020-12-08 18:46:46', '2020-12-08 18:46:46'),
	(10, 10, 1, 1, 1495.00, '2021-10-01', 'unpaid', '2020-12-08 18:46:46', '2020-12-08 18:46:46'),
	(11, 11, 1, 1, 1495.00, '2021-11-01', 'unpaid', '2020-12-08 18:46:46', '2020-12-08 18:46:46'),
	(12, 12, 1, 1, 1495.00, '2021-12-01', 'unpaid', '2020-12-08 18:46:46', '2020-12-08 18:46:46'),
	(13, 1, 2, 2, 2304.00, '2020-07-01', 'paid', '2020-12-08 19:34:50', '2020-12-08 23:16:11'),
	(14, 2, 2, 2, 2304.00, '2020-08-01', 'paid', '2020-12-08 19:34:50', '2020-12-08 23:16:17'),
	(15, 3, 2, 2, 2304.00, '2020-09-01', 'paid', '2020-12-08 19:34:51', '2020-12-08 23:16:19'),
	(16, 4, 2, 2, 2304.00, '2020-10-01', 'paid', '2020-12-08 19:34:51', '2020-12-08 23:16:22'),
	(17, 5, 2, 2, 2304.00, '2020-11-01', 'paid', '2020-12-08 19:34:51', '2020-12-08 23:16:24'),
	(18, 6, 2, 2, 2304.00, '2020-12-01', 'paid', '2020-12-08 19:34:51', '2020-12-08 23:17:06'),
	(19, 7, 2, 2, 2304.00, '2021-01-01', 'unpaid', '2020-12-08 19:34:51', '2020-12-08 19:34:51'),
	(20, 8, 2, 2, 2304.00, '2021-02-01', 'unpaid', '2020-12-08 19:34:51', '2020-12-08 19:34:51'),
	(21, 9, 2, 2, 2304.00, '2021-03-01', 'unpaid', '2020-12-08 19:34:51', '2020-12-08 19:34:51'),
	(22, 10, 2, 2, 2304.00, '2021-04-01', 'unpaid', '2020-12-08 19:34:51', '2020-12-08 19:34:51'),
	(23, 11, 2, 2, 2304.00, '2021-05-01', 'unpaid', '2020-12-08 19:34:51', '2020-12-08 19:34:51'),
	(24, 12, 2, 2, 2304.00, '2021-06-01', 'unpaid', '2020-12-08 19:34:51', '2020-12-08 19:34:51'),
	(25, 1, 3, 3, 2580.00, '2021-02-01', 'unpaid', '2020-12-08 23:25:09', '2020-12-09 09:22:27'),
	(26, 2, 3, 3, 2580.00, '2021-03-01', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(27, 3, 3, 3, 2580.00, '2021-04-01', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(28, 4, 3, 3, 2580.00, '2021-05-01', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(29, 5, 3, 3, 2580.00, '2021-06-01', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(30, 6, 3, 3, 2580.00, '2021-07-01', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(31, 7, 3, 3, 2580.00, '2021-08-01', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(32, 8, 3, 3, 2580.00, '2021-09-01', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(33, 9, 3, 3, 2580.00, '2021-10-01', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(34, 10, 3, 3, 2580.00, '2021-11-01', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(35, 11, 3, 3, 2580.00, '2021-12-01', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(36, 12, 3, 3, 2580.00, '2022-01-01', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09');
/*!40000 ALTER TABLE `rents` ENABLE KEYS */;

-- Copiando estrutura para tabela saimob.transfers
DROP TABLE IF EXISTS `transfers`;
CREATE TABLE IF NOT EXISTS `transfers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enrollment` int(10) unsigned NOT NULL,
  `contract` int(10) unsigned NOT NULL,
  `owner` int(10) unsigned NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `due_at` date NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transfers_contract_foreign` (`contract`),
  KEY `transfers_owner_foreign` (`owner`),
  CONSTRAINT `transfers_contract_foreign` FOREIGN KEY (`contract`) REFERENCES `contracts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transfers_owner_foreign` FOREIGN KEY (`owner`) REFERENCES `owners` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela saimob.transfers: ~36 rows (aproximadamente)
/*!40000 ALTER TABLE `transfers` DISABLE KEYS */;
REPLACE INTO `transfers` (`id`, `enrollment`, `contract`, `owner`, `value`, `due_at`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, 750.00, '2021-01-10', 'paid', '2020-12-08 18:46:46', '2020-12-08 22:10:40'),
	(2, 2, 1, 1, 1125.00, '2021-02-10', 'paid', '2020-12-08 18:46:46', '2020-12-08 21:44:50'),
	(3, 3, 1, 1, 1125.00, '2021-03-10', 'unpaid', '2020-12-08 18:46:46', '2020-12-08 23:17:24'),
	(4, 4, 1, 1, 1125.00, '2021-04-10', 'unpaid', '2020-12-08 18:46:46', '2020-12-08 23:17:21'),
	(5, 5, 1, 1, 1125.00, '2021-05-10', 'unpaid', '2020-12-08 18:46:46', '2020-12-08 23:17:18'),
	(6, 6, 1, 1, 1125.00, '2021-06-10', 'unpaid', '2020-12-08 18:46:46', '2020-12-08 18:46:46'),
	(7, 7, 1, 1, 1125.00, '2021-07-10', 'unpaid', '2020-12-08 18:46:46', '2020-12-08 23:17:17'),
	(8, 8, 1, 1, 1125.00, '2021-08-10', 'unpaid', '2020-12-08 18:46:46', '2020-12-08 18:46:46'),
	(9, 9, 1, 1, 1125.00, '2021-09-10', 'unpaid', '2020-12-08 18:46:46', '2020-12-08 18:46:46'),
	(10, 10, 1, 1, 1125.00, '2021-10-10', 'paid', '2020-12-08 18:46:46', '2020-12-08 18:46:46'),
	(11, 11, 1, 1, 1125.00, '2021-11-10', 'unpaid', '2020-12-08 18:46:46', '2020-12-08 18:46:46'),
	(12, 12, 1, 1, 1125.00, '2021-12-10', 'unpaid', '2020-12-08 18:46:46', '2020-12-08 18:46:46'),
	(13, 1, 2, 4, 837.00, '2020-07-15', 'paid', '2020-12-08 19:34:51', '2020-12-08 21:44:48'),
	(14, 2, 2, 4, 1674.00, '2020-08-15', 'paid', '2020-12-08 19:34:51', '2020-12-08 21:34:19'),
	(15, 3, 2, 4, 1674.00, '2020-09-15', 'unpaid', '2020-12-08 19:34:51', '2020-12-08 23:17:23'),
	(16, 4, 2, 4, 1674.00, '2020-10-15', 'unpaid', '2020-12-08 19:34:51', '2020-12-08 23:17:20'),
	(17, 5, 2, 4, 1674.00, '2020-11-15', 'unpaid', '2020-12-08 19:34:51', '2020-12-08 19:34:51'),
	(18, 6, 2, 4, 1674.00, '2020-12-15', 'unpaid', '2020-12-08 19:34:51', '2020-12-08 19:34:51'),
	(19, 7, 2, 4, 1674.00, '2021-01-15', 'unpaid', '2020-12-08 19:34:51', '2020-12-08 19:34:51'),
	(20, 8, 2, 4, 1674.00, '2021-02-15', 'unpaid', '2020-12-08 19:34:51', '2020-12-08 19:34:51'),
	(21, 9, 2, 4, 1674.00, '2021-03-15', 'unpaid', '2020-12-08 19:34:51', '2020-12-08 19:34:51'),
	(22, 10, 2, 4, 1674.00, '2021-04-15', 'unpaid', '2020-12-08 19:34:51', '2020-12-08 19:34:51'),
	(23, 11, 2, 4, 1674.00, '2021-05-15', 'unpaid', '2020-12-08 19:34:51', '2020-12-08 19:34:51'),
	(24, 12, 2, 4, 1674.00, '2021-06-15', 'unpaid', '2020-12-08 19:34:51', '2020-12-08 19:34:51'),
	(25, 1, 3, 7, 1165.00, '2021-02-15', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(26, 2, 3, 7, 2330.00, '2021-03-15', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(27, 3, 3, 7, 2330.00, '2021-04-15', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(28, 4, 3, 7, 2330.00, '2021-05-15', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(29, 5, 3, 7, 2330.00, '2021-06-15', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(30, 6, 3, 7, 2330.00, '2021-07-15', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(31, 7, 3, 7, 2330.00, '2021-08-15', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(32, 8, 3, 7, 2330.00, '2021-09-15', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(33, 9, 3, 7, 2330.00, '2021-10-15', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(34, 10, 3, 7, 2330.00, '2021-11-15', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(35, 11, 3, 7, 2330.00, '2021-12-15', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09'),
	(36, 12, 3, 7, 2330.00, '2022-01-15', 'unpaid', '2020-12-08 23:25:09', '2020-12-08 23:25:09');
/*!40000 ALTER TABLE `transfers` ENABLE KEYS */;

-- Copiando estrutura para tabela saimob.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `last_login_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_document_unique` (`document`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela saimob.users: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `last_login_at`, `last_login_ip`, `document`, `cover`) VALUES
	(1, 'Administrador', 'admin@admin.com.br', '2020-12-07 22:21:18', '$2y$10$11kRdm.duyijH0gmBpa0luPLJiKlyBnqeHq3L9JHGelSyly1GMQ02', 'TvDov6mwG2m3zX9vzbNXy3hLEqTwG57nRVBJppAbdm1OnDsFFG3rzbipJn0u', NULL, '2020-12-09 08:20:13', '2020-12-09 08:20:13', '::1', '99999999999', 'user/iuRa4cX78vP3aiDJO8dmYO09clFEWWPJ5Mg2KySo.jpg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
