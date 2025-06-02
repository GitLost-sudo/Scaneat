DROP DATABASE IF EXISTS ScanEat;
CREATE DATABASE IF NOT EXISTS ScanEat DEFAULT CHARACTER SET = 'utf8mb4';
USE ScanEat;

CREATE TABLE IF NOT EXISTS `compte`(
  `compte_id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(255) UNIQUE NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL
);

DROP TABLE IF EXISTS `frigo`;
CREATE TABLE `frigo` (
  `frigo_id`INT AUTO_INCREMENT,
  `compte_id`INT NOT NULL,
  `nom` VARCHAR(255) NOT NULL,
  `categorie`VARCHAR(255),
  `quantite`INT,
  `date_peremption`DATE,
  PRIMARY KEY (`frigo_id`),
  FOREIGN KEY (`compte_id`) REFERENCES `compte`(`compte_id`)
);

CREATE TABLE `favoris` (
  `compte_id` INT NOT NULL,
  `recette_id` INT NOT NULL,
  FOREIGN KEY (`compte_id`) REFERENCES `compte`(`compte_id`)
);