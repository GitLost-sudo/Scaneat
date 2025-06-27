<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan'Eat Accueil</title>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="..\public\styles\accueil.css">
    <link rel="stylesheet" href="../public/styles/common.css">
</head>
<body>
<?php include '../views/header_org.php'; ?>
<main>
<div class ="T1">
<h1>Bonjour, <span> <?php echo $username ?></span>!</h1>
</div>
 <?php 
// tableau des icones celon la catégorie des produits
$icones = [
    'fruit' => '../public/icons/fruits_icone.png',
    'légume' => '../public/icons/legumes_icone.png',
    'viande' => '../public/icons/viandes_icone.png',
    'produit laitier' => '../public/icons/produits_laitiers_icone.png',
    'boisson' => '../public/icons/boisson_icone.png',
    'autre' => '../public/icons/autre_icone.png'
];
?>

<!-- test fin -->
<div class="notifications-container">
<!-- Affichage des alertes de péremption -->
    <?php foreach($alertes as $alerte): ?>
    <?php  
        $categorie = $alerte['categorie'];
        $icone = $icones[$categorie] ?? $icones['autres']; 
    ?>
        <div class="notification">
           
                <img src="<?=$icone?>" alt="<?= $categorie?>"> 
             <p>   <?=($alerte['nom'])?> expire le: <?= ($alerte['date_peremption']) ?> </p>
                <img src="../public/icons/urgent_icone.png" alt="urgent!">
           
        </div>
    <?php endforeach; ?>
</div>
<h2>Recomandations de recettes</h2>
<div class="recette_container">
    <?php
    foreach ($recettes as $recette) {
        ?>
        <div class="recette">
            <a href="../controllers/details_recette_controller.php?id=<?= $recette['idMeal'] ?>">
                <img class="image_recette" src="<?= $recette['strMealThumb'] ?>" alt="image de la recette">
            </a>
            <?php
            if (is_favori($compte_id, $recette['idMeal'])) {
                ?>
                <a href="../controllers/retirer_favoris_controller.php?id=<?= $recette['idMeal'] ?>">
                    <img class="star_icon" src="../public/icons/star_full.png" alt="icon deja favori">
                </a>
                <?php
            } else {
                ?>
                <a href="../controllers/ajouter_favoris_controller.php?id=<?= $recette['idMeal'] ?>">
                    <img class="star_icon" src="../public/icons/star_empty.png" alt="icon pas encore favori">
                </a>
                <?php
            }
            ?>
            <a href="../controllers/details_recette_controller.php?id=<?= $recette['idMeal'] ?>">
                <h3><?= $recette['strMeal'] ?></h3>
            </a>
        </div>
        <?php
    }
    ?>
</div>
<script src="../notification/app.js"></script>
</main>
    <?php include '../views/nav_bar.php'; ?>
    
</body>
</html>