<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la recette</title>
    <link rel="stylesheet" href="../public/styles/common.css">
    <link rel="stylesheet" href="../public/styles/details_recette.css">
</head>
<body>
    <?php
    require_once __DIR__.'/../views/header_org.php';
    ?>
    <main>
        <form class="recette_details" action="../controllers/realisation_recette_controller.php" method="post">
            <div class="recette_header">
                <a href="../controllers/liste_recette_controller.php">
                    <img class="fleche_retour" src="../public/icons/fleche_retour.png" alt="flèche de retour">
                </a>
                <h1><?= $recette['strMeal'] ?></h1>
                <?php
                //if ($recette['isfavorite']) {
                    ?>
                    <a href="../controllers/ajouter_favoris_controller.php?id=<?= $recette['idMeal'] ?>">
                        <img class="favori" src="../public/icons/star_empty.png" alt="Ajouter aux favoris">
                    </a>
                    <?php
                /*} else {
                    ?>
                    <a href="../controllers/retirer_favoris_controller.php?id=<?= $recette['idMeal'] ?>">
                        <img class="favori" src="../public/icons/star_full.png" alt="Retirer des favoris">
                    </a>
                    <?php
                }*/
                ?>
            </div>
            <img src="<?= $recette['strMealThumb'] ?>" alt="image de la recette" class="recette_image">
            <div class="ingredients">
                <h2>Ingrédients</h2>
                <ul>
                    <?php
                    for ($i = 1; $i <= 20; $i++) {
                        $ingredient = isset($recette["strIngredient$i"]) ? trim($recette["strIngredient$i"]) : '';
                        $measure = isset($recette["strMeasure$i"]) ? trim($recette["strMeasure$i"]) : '';
                        if (!empty($ingredient)) {
                            ?>
                            <li><?= $measure ?> <?= $ingredient ?></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="instructions">
                <h2>Instructions</h2>
                <p><?= $recette['strInstructions'] ?></p>
            </div>
            <select name="proportion" id="proportion">
                    <option value="">Choisir le nombre de personnes</option>
                    <option value="1">1 personne</option>
                    <option value="2">2 personnes</option>
                    <option value="3">3 personnes</option>
                    <option value="4">4 personnes</option>
                    <option value="5">5 personnes</option>
                </select>
            <input type="hidden" name="id" value="<?= $recette['idMeal'] ?>">
            <input type="submit" value="J'ai terminé la recette">
        </form>
    </main>
    <?php
    require_once __DIR__.'/../views/nav_bar.php';
    ?>
</body>
</html>