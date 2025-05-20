<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan'Eat</title>
    <link rel="stylesheet" href="../public/styles/common.css">
    <link rel="stylesheet" href="../public/styles/frigo.css">
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">
</head>
<body>
<?php if (isset($success)): ?>
    <div style="background-color: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 15px;">
        <?= htmlspecialchars($success) ?>
    </div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; border-radius: 5px; margin-bottom: 15px;">
        ⚠️ <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>
<?php require_once __DIR__.'/../views/header_org.php'; ?>

<div id="addProductModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Ajouter un produit</h2>
    <form action="../controllers/ajouter_produit_controller.php" method="POST" enctype="multipart/form-data">
        <label for="nom"><span>Nom du produit :</span></label>
        <input type="text" name="nom" required><br>

        <label for="categorie">Catégorie :</label>
        <select name="categorie" id="categorie" required>
          <option value="">--Choisissez une catégorie--</option>
          <option value="légume">Légume</option>
          <option value="fruit">Fruit</option>
          <option value="viande">Viande</option>
          <option value="produit_laitiers">Produit laitier</option>
          <option value="boissons">Boisson</option>
          <option value="autre">Autre</option>
        </select><br>

        <label for="quantite">Quantité :</label>
        <input type="number" name="quantite" required><br>

        <label for="date_peremption">Date de péremption :</label>
        <input type="date" name="date_peremption" required><br>
        <p id="date-error" style="color: yellow; font-weight: bold;"></p>

        <input type="submit" value="Ajouter" style="background-color: #498A0C">
    </form>
  </div>
</div>

<?php 
// tableau des icônes selon la catégorie
$icones = [
    'fruit' => '../public/icons/fruits_icone.png',
    'légume' => '../public/icons/legumes_icone.png',
    'viande' => '../public/icons/viandes_icone.png',
    'produit_laitiers' => '../public/icons/produits_laitiers_icone.png',
    'boissons' => '../public/icons/boisson_icone.png',
    'autre' => '../public/icons/autre_icone.png'
];
?>

<main>
    <h1>Mon Frigo</h1>

    <div class="container">
        <?php foreach ($produits as $produit): ?>
            <div class="item">
                <a href="#"><img class="item_img" src="../public/img/<?= $produit['image'] ?>" alt="image du produit"></a>

                <a href="../controllers/supprimer_produit_controller.php?produit_id=<?= $produit['produit_id'] ?>">
                    <img class="icon_remove" src="../public/icons/remove.png" alt="icone de suppression">
                </a>

                <?php if (!empty($produit['categorie']) && isset($icones[$produit['categorie']])): ?>
                    <img class="icon_categorie" src="<?= $icones[$produit['categorie']] ?>" alt="catégorie">
                <?php endif; ?>

                <p class="item_name">Nom du produit : <?= htmlspecialchars($produit['nom']) ?></p>
                <p class="item_date">Date d'expiration : <?= htmlspecialchars($produit['date_peremption']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="#" class="add_product" id="openModalBtn">Ajouter un<br>produit</a>
</main>

<?php require_once __DIR__.'/../views/nav_bar.php'; ?>

<script>
document.getElementById("openModalBtn").addEventListener("click", function(event) {
  event.preventDefault();
  document.getElementById("addProductModal").style.display = "block";
});

document.querySelector(".close").addEventListener("click", function() {
  document.getElementById("addProductModal").style.display = "none";
});

window.addEventListener("click", function(event) {
  const modal = document.getElementById("addProductModal");
  if (event.target == modal) {
    modal.style.display = "none";
  }
});

const dateInput = document.querySelector('input[name="date_peremption"]');
const errorMsg = document.getElementById('date-error');
const form = document.querySelector('form');

function isDateValid() {
    const selectedDate = new Date(dateInput.value);
    const today = new Date();
    selectedDate.setHours(0, 0, 0, 0);
    today.setHours(0, 0, 0, 0);
    return selectedDate >= today;
}

dateInput.addEventListener('input', () => {
    if (!isDateValid()) {
        errorMsg.textContent = "⚠️ Ce produit est déjà périmé !";
    } else {
        errorMsg.textContent = "";
    }
});

form.addEventListener('submit', function(e) {
    if (!isDateValid()) {
        e.preventDefault();
        errorMsg.textContent = "⛔ Veuillez choisir une date de péremption valide (aujourd'hui ou plus tard).";
    }
});
</script>
</body>
</html>