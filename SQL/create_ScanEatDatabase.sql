-- Active: 1742551789183@@127.0.0.1@3306@scaneat
CREATE DATABASE IF NOT EXISTS ScanEat DEFAULT CHARACTER SET = 'utf8mb4';
USE ScanEat;

CREATE TABLE IF NOT EXISTS `compte`(
    `compte_id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) UNIQUE NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL
);



CREATE TABLE `frigo` (
 `frigo_id`INT AUTO_INCREMENT PRIMARY KEY,
 `produit_nom`VARCHAR(255),
 `catégorie`VARCHAR(255),
 `quantite`INT,
 `date_peremption`DATE,
 FOREIGN KEY (`compte_id`) REFERENCES `compte`(`compte_id`)
 
);
