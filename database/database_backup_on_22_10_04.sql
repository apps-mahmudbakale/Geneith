

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `station_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_station_id_foreign` (`station_id`),
  CONSTRAINT `users_station_id_foreign` FOREIGN KEY (`station_id`) REFERENCES `stations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buying_price` int NOT NULL,
  `selling_price` int NOT NULL,
  `qty` int NOT NULL,
  `expiry_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_store_id_foreign` (`store_id`),
  CONSTRAINT `products_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `stores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO users (`id`, `station_id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES 
('1','1','Admin','admin@admin.com','08147384426','','$2y$10$5FTqtQAJBOi3CAcciUM.o.6RP2FQWHn6UqEDzO3OdRCK6RP02b7k.','','2022-10-04 00:08:15','2022-10-04 00:28:37');

INSERT INTO users (`id`, `station_id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES 
('2','1','Mahmud Bakale','bakale.mahmud@cynox.com','08065480409','','$2y$10$l/zrmCrpzt3p9Bb1aMcu6.szUNFuKEEpKRcJBmiGurZD5Sz2nYCIu','','2022-10-04 01:51:44','2022-10-04 01:51:44');

INSERT INTO products (`id`, `store_id`, `name`, `buying_price`, `selling_price`, `qty`, `expiry_date`, `created_at`, `updated_at`) VALUES 
('197','1','Amoxicilline/Clavulanic acid 1.2 mg(NOSCLAV)','841','1346','300','2022-10-04','2022-10-04 01:24:13','2022-10-04 01:34:54');

INSERT INTO products (`id`, `store_id`, `name`, `buying_price`, `selling_price`, `qty`, `expiry_date`, `created_at`, `updated_at`) VALUES 
('198','1','Artesunate 60mg  (Rekmal)(LEVER)','406','649','600','2022-10-05','2022-10-04 01:24:13','2022-10-04 01:34:54');

INSERT INTO products (`id`, `store_id`, `name`, `buying_price`, `selling_price`, `qty`, `expiry_date`, `created_at`, `updated_at`) VALUES 
('199','1','Artesunate 120mg (Rekmal)(LEVER)','765','1223','580','2022-10-06','2022-10-04 01:24:13','2022-10-04 01:34:54');

INSERT INTO products (`id`, `store_id`, `name`, `buying_price`, `selling_price`, `qty`, `expiry_date`, `created_at`, `updated_at`) VALUES 
('200','1','Ceftriaxone(Hoftrex) 1g(SYCEPH 1G)','440','704','300','2022-10-07','2022-10-04 01:24:13','2022-10-04 01:34:54');

INSERT INTO products (`id`, `store_id`, `name`, `buying_price`, `selling_price`, `qty`, `expiry_date`, `created_at`, `updated_at`) VALUES 
('201','1','Ceftriaxone+Sulbactam 1.5g(SYCEPH SB)','770','1232','360','2022-10-08','2022-10-04 01:24:13','2022-10-04 01:34:54');

INSERT INTO products (`id`, `store_id`, `name`, `buying_price`, `selling_price`, `qty`, `expiry_date`, `created_at`, `updated_at`) VALUES 
('202','1','Artemeter 80mg(ARTHEC INJ)','330','528','1200','2022-10-09','2022-10-04 01:24:13','2022-10-04 01:34:54');

INSERT INTO products (`id`, `store_id`, `name`, `buying_price`, `selling_price`, `qty`, `expiry_date`, `created_at`, `updated_at`) VALUES 
('203','1','Pentazocine 30mg(GLAWIN)','1430','2288','600','2022-10-10','2022-10-04 01:24:13','2022-10-04 01:34:54');

INSERT INTO products (`id`, `store_id`, `name`, `buying_price`, `selling_price`, `qty`, `expiry_date`, `created_at`, `updated_at`) VALUES 
('204','1','Metro iv','231','370','300','2022-10-11','2022-10-04 01:24:13','2022-10-04 01:34:54');

INSERT INTO products (`id`, `store_id`, `name`, `buying_price`, `selling_price`, `qty`, `expiry_date`, `created_at`, `updated_at`) VALUES 
('205','1','Cipro iv','220','352','280','2022-10-12','2022-10-04 01:24:13','2022-10-04 01:34:54');

INSERT INTO products (`id`, `store_id`, `name`, `buying_price`, `selling_price`, `qty`, `expiry_date`, `created_at`, `updated_at`) VALUES 
('206','1',' Ciprofloxacin(GECIP)','462','739','570','2022-10-13','2022-10-04 01:24:13','2022-10-04 01:34:54');

INSERT INTO products (`id`, `store_id`, `name`, `buying_price`, `selling_price`, `qty`, `expiry_date`, `created_at`, `updated_at`) VALUES 
('207','1','Arthemeter /lumefantrine (20mg/120mg)COATAL BY 24','422','675','1800','2022-10-14','2022-10-04 01:24:13','2022-10-04 01:34:54');

INSERT INTO products (`id`, `store_id`, `name`, `buying_price`, `selling_price`, `qty`, `expiry_date`, `created_at`, `updated_at`) VALUES 
('208','1',' Amoxicillin +Clavulanic acid 228.5mg(NOSCLAV 228.5)','935','1496','180','2022-10-15','2022-10-04 01:24:13','2022-10-04 01:34:54');

INSERT INTO products (`id`, `store_id`, `name`, `buying_price`, `selling_price`, `qty`, `expiry_date`, `created_at`, `updated_at`) VALUES 
('209','1',' Azithromycin(AZILIDE SUSPENSION)','715','1144','300','2022-10-16','2022-10-04 01:24:13','2022-10-04 01:34:54');

INSERT INTO products (`id`, `store_id`, `name`, `buying_price`, `selling_price`, `qty`, `expiry_date`, `created_at`, `updated_at`) VALUES 
('210','1',' Cefuroxime 125mg(PULMOCEF SUSPENSION)','1650','2640','180','2022-10-17','2022-10-04 01:24:13','2022-10-04 01:34:54');

INSERT INTO products (`id`, `store_id`, `name`, `buying_price`, `selling_price`, `qty`, `expiry_date`, `created_at`, `updated_at`) VALUES 
('211','1',' Multivitamin (MYMIN SYRUP)','935','1496','75','2022-10-18','2022-10-04 01:24:13','2022-10-04 01:34:54');

INSERT INTO products (`id`, `store_id`, `name`, `buying_price`, `selling_price`, `qty`, `expiry_date`, `created_at`, `updated_at`) VALUES 
('212','1',' Amoxicillin(NOXIL)','1892','3027','300','2022-10-19','2022-10-04 01:24:13','2022-10-04 01:34:54');

INSERT INTO products (`id`, `store_id`, `name`, `buying_price`, `selling_price`, `qty`, `expiry_date`, `created_at`, `updated_at`) VALUES 
('213','1',' Ampiclox (GENICLOX)','2002','3203','300','2022-10-20','2022-10-04 01:24:13','2022-10-04 01:34:54');

INSERT INTO products (`id`, `store_id`, `name`, `buying_price`, `selling_price`, `qty`, `expiry_date`, `created_at`, `updated_at`) VALUES 
('214','1',' Water for injection','297','475','360','2022-10-21','2022-10-04 01:24:13','2022-10-04 01:34:54');

INSERT INTO stores (`id`, `name`, `location`, `created_at`, `updated_at`) VALUES 
('1','Store A','Uduth','2022-10-04 00:30:12','2022-10-04 00:30:12');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('1','2014_10_12_000000_create_users_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('2','2014_10_12_100000_create_password_resets_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('3','2019_08_19_000000_create_failed_jobs_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('4','2019_12_14_000001_create_personal_access_tokens_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('5','2022_09_24_162127_create_settings_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('6','2022_09_24_162236_create_permission_tables','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('7','2022_09_24_194353_create_store_settings','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('8','2022_09_24_224037_create_stations_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('9','2022_09_24_224140_update_users_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('10','2022_09_25_012625_create_stores_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('11','2022_09_25_012639_create_products_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('12','2022_09_25_192402_create_requests_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('13','2022_09_26_075457_create_station_products','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('14','2022_09_26_185954_update_requests_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('15','2022_09_27_201951_update_station_products_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('16','2022_09_27_203028_create_sales_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('17','2022_09_28_011907_sales_order','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('18','2022_09_28_065213_update_sales_order_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('19','2022_09_28_204648_create_invoices_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('20','2022_09_30_074057_update_sales_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('21','2022_10_01_223835_create_audits_table','1');
