<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan'Eat</title>
    <link rel="stylesheet" href="../public/styles/frigo.css">
</head>
<body>
    <header>
        <a href="../controllers/mon_profil_controller.php"><img class="header_icon" src="../public/icons/profil.png" alt="Mon Profil"></a>
        <img id="header_ecriture" src="../public/img/ecriture.png" alt="Scan'Eat">
        <a href="../controllers/accueil_controller.php"><img class="header_icon" src="../public/icons/home.png" alt="Accueil"></a>
    </header>
    <main>
        <h1>Mon Frigo</h1>
        <div class="container">
            <?php
            /*foreach ($produits as $produits) {}*/
            ?>
            <div class="item">
                <a href="../controllers/#"><img  class="item_img" src="../public/img/<?= $produit['image'] ?>" alt="image du produit"></a>
                <a href="../controllers/#"><img class="icon_remove" src="../public/icons/remove.png" alt="icone de suppression"></a>
                <p class="item_name">Nom du produit<!--<?= $produit['name'] ?>--></p>
                <p class="item_date">Date d'expiration<!--<?= $produit['date']?>--></p>
            </div>
            <?php
            /*}*/
            ?>            
        </div>
        <a href="../controllers/#" class="add_product">Ajouter un<br>produit</a>
    </main>
    <nav>
        <a href="../controllers/scanner_controller.php"><img class="nav_icon" src="../public/icons/barcode.png" alt="Scanner des produits"></a>
        <a href="../controllers/recettes_controller.php"><img class="nav_icon" src="../public/icons/recette.png" alt="Mes Recettes"></a>
        <a href="../controllers/frigo_controller.php"><img class="nav_icon" src="../public/icons/frigo.png" alt="Mon Frigo"></a>
    </nav>
</body>
</html>