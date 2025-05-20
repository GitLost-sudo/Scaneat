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
    require_once __DIR__.'/../views/header_org.php';
    ?>
    <main>
        <button class="filtres_button">Filtres</button>
        <section class="section_filtres displaynone">
            <h2>Filtres</h2>
            <form action="../controllers/apply_filters_controller.php" method="post">
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
        }
        else {
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
                    /*if ($recette['is_favorite']) {
                        ?>
                        <a href="../controllers/retirer_favoris_controller.php?id=<?= $recette['idMeal'] ?>"><img class="star_icon" src="../public/icons/star_full.png" alt="icon deja favori"></a>
                        <?php
                    } else {*/
                        ?>
                        <a href="../controllers/ajouter_favoris_controller.php?id=<?= $recette['idMeal'] ?>"><img class="star_icon" src="../public/icons/star_empty.png" alt="icon pas encore favori"></a>
                        <?php
                    //}
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
    <?php
    require_once __DIR__.'/../views/nav_bar.php';
    ?>
    <script>
        // Quand on clique sur le bouton avec la classe "filtres_button", on affecte la classe "displaysection" à la place de "displaynone"
        const buttonFiltres = document.querySelector('.filtres_button');
        const sectionFiltres = document.querySelector('.section_filtres');
        buttonFiltres.addEventListener('click', () => {
            if (sectionFiltres.classList.contains('displaynone')) {
                sectionFiltres.classList.remove('displaynone');
                sectionFiltres.classList.add('displaysection');
            } else {
                sectionFiltres.classList.remove('displaysection');
                sectionFiltres.classList.add('displaynone');
            }
        });
    </script>
</body>
</html>