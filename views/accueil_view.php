<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan'Eat Acceuil</title>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">

</head>

<link rel="stylesheet" href="..\public\styles\accueil.css">
<body>
<?php include '../views/header_org.php'; ?>
<div class ="T1">
<h1>Bonjour, <span> <?php echo $username ?></span>!</h1>
</div>
 <?php 
// tableau des icones celon la catégorie des produits
$icones = [
    'fruits' => '../public/icons/fruits_icone.png',
    'légumes' => '../public/icons/legumes_icone.png',
    'viandes' => '../public/icons/viandes_icone.png',
    'produits laitiers' => '../public/icons/produits_laitiers_icone.png',
    'boissons' => '../public/icons/boisson_icone.png',
    'autres' => '../public/icons/autre_icone.png'
];
?>
<!-- test-->
<?php
$alertes = [
    [
        'nom' => 'Pomme',
        'catégorie' => 'fruits',
        'date_peremption' => '2025-05-10'
    ],
    [
        'nom' => 'Carotte',
        'catégorie' => 'légumes',
        'date_peremption' => '2025-06-15'
    ],
    [
        'nom' => 'Poulet',
        'catégorie' => 'viandes',
        'date_peremption' => '2025-07-20'
    ],
    [
        'nom' => 'Lait',
        'catégorie' => 'produits laitiers',
        'date_peremption' => '2025-08-25'
    ],
    [
        'nom' => 'Jus d\'orange',
        'catégorie' => 'boissons',
        'date_peremption' => '2025-09-30'
    ],

];
?>
<!-- test fin -->
<div class="notifications-container">
<!-- Affichage des alertes de péremption -->
    <?php foreach($alertes as $alerte): ?>
    <?php  
        $categorie = $alerte['catégorie'];
        $icone = $icones[$categorie] ?? $icones['autres']; 
    ?>
        <div class="notification">
           
                <img src="<?=$icone?>" alt="<?= $categorie?>"> 
             <p>   <?=($alerte['nom'])?> expire le: <?= ($alerte['date_peremption']) ?> </p>
                <img src="../public/icons/urgent_icone.png" alt="urgent!">
           
        </div>
    <?php endforeach; ?>
</div> 
 
    <?php include '../views/nav_bar.php'; ?>
</body>
</html>