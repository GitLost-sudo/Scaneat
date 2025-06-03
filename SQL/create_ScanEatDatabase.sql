DROP DATABASE IF EXISTS ScanEat;
CREATE DATABASE ScanEat DEFAULT CHARACTER SET = 'utf8mb4';
USE ScanEat;

CREATE TABLE `compte`(
    `compte_id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) UNIQUE NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL
);

CREATE TABLE `frigo` (
 `frigo_id`INT PRIMARY KEY auto_increment,
 `compte_id`INT NOT NULL,
 `nom` VARCHAR(255) NOT NULL,
 `categorie`VARCHAR(255),
 `quantite`INT,
 `date_peremption`DATE,
 FOREIGN KEY (`compte_id`) REFERENCES `compte`(`compte_id`)
);


