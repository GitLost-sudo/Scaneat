<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan'Eat</title>
    <link rel="stylesheet" href="../public/styles/common.css">
    <link rel="stylesheet" href="../public/styles/frigo.css">
</head>
<body>
    <?php
    require_once __DIR__.'/../views/header_org.php';
    ?>
    <main>
        <h1>Mon Frigo</h1>
        <div class="container">
            <?php
            /*foreach ($produits as $produit) {}*/
            ?>
            <div class="item">
                <a href="../controllers/#"><img  class="item_img" src="../public/img/<?= $produit['image'] ?>" alt="image du produit"></a>
                <a href="../controllers/supprimer_produit_controller.php?produit_id=<?= $produit['id'] ?>"><img class="icon_remove" src="../public/icons/remove.png" alt="icone de suppression"></a>
                <p class="item_name">Nom du produit<!--<?= $produit['name'] ?>--></p>
                <p class="item_date">Date d'expiration<!--<?= $produit['date']?>--></p>
            </div>
            <?php
            /*}*/
            ?>            
        </div>
        <a href="../controllers/#" class="add_product">Ajouter un<br>produit</a>
    </main>
    <?php
    require_once __DIR__.'/../views/nav_bar.php';
    ?>
</body>
</html>