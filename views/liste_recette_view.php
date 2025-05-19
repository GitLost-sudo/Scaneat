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
        <?= $vegetarien ? '<h3>Recettes végétariennes</h3>' : '' ?>
        <?= $vegan ? '<h3>Recettes véganes</h3>' : '' ?>
        <?= $sans_gluten ? '<h3>Recettes sans gluten</h3>' : '' ?>
        <?= $sans_lactose ? '<h3>Recettes sans lactose</h3>' : '' ?>
        <?= $halal ? '<h3>Recettes halal</h3>' : '' ?>
        <div class="recette_container">
            <?php
            foreach ($recettes as $recette) {
                ?>
                <div class="recette">
                    <a href="#"><img class="image_recette" src="<?= $recette['strMealThumb'] ?>" alt="image de la recette"></a>
                    <?php
                    /*if ($recette['is_favorite']) {
                        ?>
                        <a href="#"><img class="star_icon" src="../public/icons/star_full.png" alt="icon deja favori"></a>
                        <?php
                    } else {*/
                        ?>
                        <a href="#"><img class="star_icon" src="../public/icons/star_empty.png" alt="icon pas encore favori"></a>
                        <?php
                    //}
                    ?>
                    <h3><?= $recette['strMeal'] ?></h3>
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