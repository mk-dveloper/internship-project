-- ============================================================
-- Library Book Management System - Module 1: Database Setup
-- ============================================================

CREATE DATABASE IF NOT EXISTS `internship_project`;
USE `internship_project`;

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `id`         INT AUTO_INCREMENT PRIMARY KEY,
  `title`      VARCHAR(100) NOT NULL,
  `author`     VARCHAR(100) NOT NULL,
  `price`      DECIMAL(10,2) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
