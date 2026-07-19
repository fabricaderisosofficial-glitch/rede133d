-- RedeM Healthcare Platform Database
-- phpMyAdmin SQL Dump
-- version 5.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database: `redem_db`

-- ========================================
-- USERS TABLE
-- ========================================
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `username` varchar(50) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `user_type` ENUM('patient', 'doctor', 'clinic', 'pharmacy', 'lab') NOT NULL,
  `profile_img` varchar(255),
  `bio` varchar(500),
  `phone` varchar(20),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================
-- DOCTORS TABLE
-- ========================================
CREATE TABLE IF NOT EXISTS `doctors` (
  `doctor_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `specialty` varchar(100) NOT NULL,
  `crm` varchar(20) UNIQUE NOT NULL,
  `bio` TEXT,
  `location` varchar(255),
  `latitude` DECIMAL(10, 8),
  `longitude` DECIMAL(11, 8),
  `whatsapp` varchar(20),
  `instagram` varchar(100),
  `website` varchar(255),
  `subscription_plan` ENUM('bronze', 'silver', 'gold', 'free') DEFAULT 'free',
  `rating` DECIMAL(2, 1) DEFAULT 0,
  `total_reviews` int(11) DEFAULT 0,
  `consultations_completed` int(11) DEFAULT 0,
  PRIMARY KEY (`doctor_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================
-- CLINICS TABLE
-- ========================================
CREATE TABLE IF NOT EXISTS `clinics` (
  `clinic_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `clinic_name` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `latitude` DECIMAL(10, 8),
  `longitude` DECIMAL(11, 8),
  `phone` varchar(20),
  `email` varchar(100),
  `specialties` TEXT,
  `team_size` int(11),
  `rating` DECIMAL(2, 1) DEFAULT 0,
  `subscription_plan` ENUM('bronze', 'silver', 'gold') DEFAULT 'bronze',
  PRIMARY KEY (`clinic_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================
-- PHARMACIES TABLE
-- ========================================
CREATE TABLE IF NOT EXISTS `pharmacies` (
  `pharmacy_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pharmacy_name` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `latitude` DECIMAL(10, 8),
  `longitude` DECIMAL(11, 8),
  `phone` varchar(20),
  `email` varchar(100),
  `rating` DECIMAL(2, 1) DEFAULT 0,
  PRIMARY KEY (`pharmacy_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================
-- LABORATORIES TABLE
-- ========================================
CREATE TABLE IF NOT EXISTS `laboratories` (
  `lab_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lab_name` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `latitude` DECIMAL(10, 8),
  `longitude` DECIMAL(11, 8),
  `phone` varchar(20),
  `email` varchar(100),
  `conveniados` TEXT,
  `rating` DECIMAL(2, 1) DEFAULT 0,
  PRIMARY KEY (`lab_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================
-- MEDICINES TABLE
-- ========================================
CREATE TABLE IF NOT EXISTS `medicines` (
  `medicine_id` int(11) NOT NULL AUTO_INCREMENT,
  `pharmacy_id` int(11) NOT NULL,
  `medicine_name` varchar(100) NOT NULL,
  `price` DECIMAL(10, 2),
  `generic_name` varchar(100),
  `manufacturer` varchar(100),
  `stock_quantity` int(11),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`medicine_id`),
  FOREIGN KEY (`pharmacy_id`) REFERENCES `pharmacies`(`pharmacy_id`) ON DELETE CASCADE,
  KEY `medicine_name` (`medicine_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================
-- APPOINTMENTS TABLE
-- ========================================
CREATE TABLE IF NOT EXISTS `appointments` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_date` DATETIME NOT NULL,
  `status` ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
  `notes` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`appointment_id`),
  FOREIGN KEY (`doctor_id`) REFERENCES `doctors`(`doctor_id`) ON DELETE CASCADE,
  FOREIGN KEY (`patient_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================
-- REVIEWS TABLE
-- ========================================
CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11),
  `clinic_id` int(11),
  `pharmacy_id` int(11),
  `lab_id` int(11),
  `patient_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `comment` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`review_id`),
  FOREIGN KEY (`patient_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================
-- FAVORITES TABLE
-- ========================================
CREATE TABLE IF NOT EXISTS `favorites` (
  `favorite_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11),
  `clinic_id` int(11),
  `pharmacy_id` int(11),
  `type` ENUM('doctor', 'clinic', 'pharmacy', 'lab') NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`favorite_id`),
  FOREIGN KEY (`patient_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================
-- ARTICLES TABLE
-- ========================================
CREATE TABLE IF NOT EXISTS `articles` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11),
  `title` varchar(255) NOT NULL,
  `content` LONGTEXT NOT NULL,
  `category` varchar(100),
  `tags` varchar(255),
  `views` int(11) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`article_id`),
  FOREIGN KEY (`doctor_id`) REFERENCES `doctors`(`doctor_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================
-- KEYWORDS TABLE (For intelligent search)
-- ========================================
CREATE TABLE IF NOT EXISTS `keywords` (
  `keyword_id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(100) NOT NULL UNIQUE,
  `category` varchar(100) NOT NULL,
  `specialist_type` varchar(50),
  PRIMARY KEY (`keyword_id`),
  UNIQUE KEY `keyword` (`keyword`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================
-- INSERT SAMPLE KEYWORDS
-- ========================================
INSERT INTO `keywords` (`keyword`, `category`, `specialist_type`) VALUES
('Dor nas costas', 'Orthopedic', 'Ortopedista'),
('Dor no peito', 'Cardiology', 'Cardiologista'),
('Dor de cabeça', 'Neurology', 'Neurologista'),
('Febre', 'General', 'Clínico Geral'),
('Dor de dente', 'Dentistry', 'Dentista'),
('Problemas de visão', 'Ophthalmology', 'Oftalmologista'),
('Stress', 'Psychology', 'Psicólogo'),
('Peso', 'Nutrition', 'Nutricionista'),
('Fisioterapia', 'Physical Therapy', 'Fisioterapeuta'),
('Hemograma', 'Exams', 'Laboratório'),
('Tomografia', 'Exams', 'Clínica de Imagem'),
('Raio X', 'Exams', 'Clínica de Imagem'),
('Ultrassom', 'Exams', 'Clínica de Imagem');

-- ========================================
-- INDEXES
-- ========================================
ALTER TABLE `users` ADD INDEX `user_type` (`user_type`);
ALTER TABLE `doctors` ADD INDEX `specialty` (`specialty`);
ALTER TABLE `doctors` ADD INDEX `crm` (`crm`);
ALTER TABLE `medicines` ADD INDEX `pharmacy_id` (`pharmacy_id`);
ALTER TABLE `appointments` ADD INDEX `doctor_id` (`doctor_id`);
ALTER TABLE `appointments` ADD INDEX `patient_id` (`patient_id`);
ALTER TABLE `appointments` ADD INDEX `appointment_date` (`appointment_date`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;