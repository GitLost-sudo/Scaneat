CREATE DATABASE ScanEat DEFAULT CHARACTER SET = 'utf8mb4';
USE ScanEat;
CREATE TABLE `compte`(
    `compte_id` INT PRIMARY KEY,
    `username` VARCHAR(255) UNIQUE NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL
);

CREATE TABLE `frigo` (
 `frigo_id`INT PRIMARY KEY,
 `compte_id`INT,
 `produit_id`INT,
 `catégorie`VARCHAR(255),
 `quantite`INT,
 `date_peremption`DATE,
 FOREIGN KEY (`compte_id`) REFERENCES `compte`(`compte_id`),

)