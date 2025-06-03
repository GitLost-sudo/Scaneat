<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des recettes</title>
    <link rel="stylesheet" href="../public/styles/common.css">
    <link rel="stylesheet" href="../public/styles/liste_recette.css">
</head>

<body>
    <?php
    require_once __DIR__ . '/../views/header_org.php';
    ?>
    <form class="search_bar displaynone" action="../controllers/search_controller.php" method="post">
        <input type="text" name="search" placeholder="Rechercher une recette" required>
        <button type="submit">Rechercher</button>
    </form>
    <main>
        <button class="filtres_button">Filtres</button>
        <section class="section_filtres displaynone">
            <h2>Filtres</h2>
            <form class="filters_form" action="../controllers/apply_filters_controller.php" method="post">
                <input type="hidden" name="email" value="<?php $email_utilisateur_connecté ?>">
                <input type="hidden" name="password" value="<?php $password ?>">
                <div class="checkbox_container">
                    <input type="checkbox" id="vegetarien" name="vegetarien" <?= $vegetarien ? 'checked' : '' ?>>
                    <label for="vegetarien">Végétarien</label>
                </div>
                <div class="checkbox_container">
                    <input type="checkbox" id="vegan" name="vegan" <?= $vegan ? 'checked' : '' ?>>
                    <label for="vegan">Vegan</label>
                </div>
                <div class="checkbox_container">
                    <input type="checkbox" id="sans_gluten" name="sans_gluten" <?= $sans_gluten ? 'checked' : '' ?>>
                    <label for="sans_gluten">Sans gluten</label>
                </div>
                <div class="checkbox_container">
                    <input type="checkbox" id="sans_lactose" name="sans_lactose" <?= $sans_lactose ? 'checked' : '' ?>>
                    <label for="sans_lactose">Sans lactose</label>
                </div>
                <div class="checkbox_container">
                    <input type="checkbox" id="halal" name="halal" <?= $halal ? 'checked' : '' ?>>
                    <label for="halal">Halal</label>
                </div>
                <input type="submit" value="Appliquer les filtres">
            </form>
        </section>
        <?php
        if ($vegetarien || $vegan || $sans_gluten || $sans_lactose || $halal) {
            ?>
            <h3>
                <?= count($recettes) ?> recettes
                <?= $vegetarien ? 'végétariennes' : '' ?>
                <?= $vegan ? 'véganes' : '' ?>
                <?= $sans_gluten ? 'sans gluten' : '' ?>
                <?= $sans_lactose ? 'sans lactose' : '' ?>
                <?= $halal ? 'halal' : '' ?>
                trouvées
            </h3>
            <?php
        } else {
            ?>
            <h3><?= count($recettes) ?> recettes trouvées</h3>
            <?php
        }
        ?>

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
    </main>
    <img class="search_button" src="../public/img/loupe.png" alt="icon de recherche">
    <?php
    require_once __DIR__ . '/../views/nav_bar.php';
    ?>
    <script src="../public/js/script_liste_recette.js"></script>
</body>

</html>