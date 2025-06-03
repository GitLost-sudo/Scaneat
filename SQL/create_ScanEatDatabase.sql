DROP DATABASE IF EXISTS ScanEat;
CREATE DATABASE ScanEat DEFAULT CHARACTER SET = 'utf8mb4';
USE ScanEat;

CREATE TABLE `compte`(
    `compte_id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) UNIQUE NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL
);

CREATE TABLE le_produit (
    produit_id INT AUTO_INCREMENT PRIMARY KEY,
    code_barre VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    categorie INT NOT NULL
);

CREATE TABLE frigo (
    frigo_id INT AUTO_INCREMENT PRIMARY KEY,
    produit_id INT NOT NULL,
    date_de_peremption DATE NOT NULL,
    quantite INT NOT NULL,
    categorie INT NOT NULL,
    FOREIGN KEY (produit_id) REFERENCES le_produit(produit_id)
);

CREATE TABLE frigo_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    compte_id INT NOT NULL,
    frigo_id INT NOT NULL,
    FOREIGN KEY (compte_id) REFERENCES user(compte_id),
    FOREIGN KEY (frigo_id) REFERENCES frigo(frigo_id)
);


