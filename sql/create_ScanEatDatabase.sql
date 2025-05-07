CREATE DATABASE ScanEat DEFAULT CHARACTER SET = 'utf8mb4';
USE ScanEat;

CREATE TABLE `compte`(
    `compte_id` INT PRIMARY KEY,
    `username` VARCHAR(255) UNIQUE NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL
);

SELECT * FROM compte;