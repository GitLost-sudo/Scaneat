CREATE DATABASE openfooddata DEFAULT CHARACTER SET = 'utf8mb4';
USE openfooddata;

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `code_barre` varchar(150) DEFAULT NULL,
  `nom` text DEFAULT NULL,
  `nutriscore` char(2) DEFAULT NULL,
  `image_url` text DEFAULT NULL
) 

