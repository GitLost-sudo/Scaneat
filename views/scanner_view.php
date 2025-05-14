<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanner</title>
    <link rel="stylesheet" href="../public/styles/common.css">
    <link rel="stylesheet" href="../public/styles/scanner.css">
</head>
<body>
    <?php
    require_once __DIR__.'/../views/header_org.php';
    ?>
    <main>
        <h1>Scanner le code barre</h1>
        <section>
            <!-- Appareil photo -->
        </section>
        <?php
        if (!isset($error)) {
            ?>
            <img class="scan_image" src="../public/img/loupe.png" alt="Image de loupe">
            <?php
        }
        else if ($error == false) {
            ?>
            <form action="../controllers/ajout_produit_frigo_controller.php" method="post">
                <h2><?= $product['name'] ?></h2>
                <div>
                    <label for="categorie"><span>Categorie : </span></label>
                    <select name="categorie" id="categorie">
                        <option value="" >Sélectionner une catégorie</option>
                        <?php
                        foreach ($categories as $category) {
                            ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <p><span>Calories /100g :</span> <?= $product['calories'] ?></p>
                <div>
                    <label for="quantite"><span>Quantité :</span></label>
                    <select name="quantite" id="quantite">
                        <option value="">Selectionner une quantité</option>
                        <?php
                        for ($i = 0; $i < 10; $i++) {
                            ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="date_expiration"><span>Date d'expiration :</span></label>
                    <input type="date" name="date_expiration" id="date_expiration" required>
                </div>
                <input type="submit" value="Ajouter">
            </form>
            <?php
        }
        else if ($error == 'not-found') {
            ?>
            <img class="scan_image" src="../public/img/croix_rouge.png" alt="Image de croix rouge">
            <p>Produit non reconnu</p>
            <p>Veuillez ajouter le produit manuellement dans le frigo</p>
            <?php
        }
        else {
            ?>
            <img class="scan_image" src="../public/img/interrogation.png" alt="Image de point d'interrogation">
            <p>Veuillez recommencer</p>
            <?php
        }
        ?>
    </main>
    <?php
    require_once __DIR__.'/../views/nav_bar.php';
    ?>
</body>
</html>