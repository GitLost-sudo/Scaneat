<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
    <link rel="stylesheet" href="../public/styles/common.css">
    <link rel="stylesheet" href="../public/styles/mon_profil.css">
</head>

<body>
    <?php
    require_once __DIR__ . '/header_org.php';
   
    ?>
    <main>
        <h1>Profil</h1>
        <form id="password_reinitialisation" action="" method="post">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly>

            <label for="actual_password">Mot de passe actuel :</label>
            <input type="password" id="actual_password" name="actual_password" required>

            <label for="new_password">Nouveau mot de passe :</label>
            <input type="password" id="new_password" name="new_password" required>

            <input type="submit" value="Changer de mot de passe">
        </form>
        <div class="recette_container">
            <h2>Mes recettes favorites</h2>
            <?php
            // foreach ($recettes as $recette) {
            ?>
            <div class="recette">
                <a href="#"><img class="image_recette" src="../public/img/<?= $recette['image'] ?>"
                        alt="image de la recette"></a>
                <a href="#"><img class="star_icon" src="../public/icons/star_full.png" alt="icon deja favori"></a>
                <h3>Nom de la recette<!--<?= $recette['name'] ?>--></h3>
            </div>
            <?php
            // }
            ?>
        </div>
    </main>
    <?php
    require_once __DIR__ . '/../views/nav_bar.php';
    ?>
</body>

</html>