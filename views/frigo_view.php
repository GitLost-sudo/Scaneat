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
    <div class="succes">
        <?= htmlspecialchars($success) ?>
    </div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div class="error">
         <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>
<?php require_once __DIR__.'/../views/header_org.php'; ?>



<!-- Modal ajout produit -->
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

        <label for="date_peremption">Date de péremption : </label>
        <input type="date" name="date_peremption" required><br>
        <p id="date-error" style="color: yellow; font-weight: bold;"></p>

        <input type="submit" value="Ajouter" style="background-color: #498A0C">
    </form>
  </div>
</div>

<!-- Modal modif produit -->
<div id="modifProductModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Modifier un produit</h2>
    <form id="modifForm" action="../controllers/modifier_produit_controller.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="frigo_id" id="modif_frigo_id">

        <label for="quantite">Quantité :</label>
        <input type="number" name="quantite" id="modif_quantite" required><br>

        <label for="date_peremption">Date de péremption : </label>
        <input type="date" name="date_peremption" id="modif_date" required><br>

        <input type="submit" value="Modifier" style="background-color: #498A0C">
    </form>
  </div>
</div>
<?php 
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
    <h1>🧊Mon Frigo🧊</h1>

    <?php if (!isset($produits) || empty($produits)): ?>
        <p style="color: orange;text-align :center;font-size: 2em;">Aucun produit à afficher.</p>
    <?php else: ?>
        <div class="container">
            <?php foreach ($produits as $produit): ?>
                <div class="item">
                    <?php if (!empty($produit['categorie'])): ?>
                        <img class="item_img" src="<?= $icones[$produit['categorie']] ?>" alt="catégorie">
                    <?php else: ?>
                        <img class="item_img" src="../public/icons/autre_icone.png" alt="produit">
                    <?php endif; ?>

                    <a href="../controllers/supprimer_produit_controller.php?id=<?= $produit['frigo_id'] ?>" 
   class="remove_product"
   onclick="return confirm('Êtes-vous sûr ?')">
   <img class="icon_remove" src="../public/icons/remove.png" alt="icone de suppression">
</a>
<a href="../controllers/modifier_produit_controller.php?id=<?= $produit['frigo_id'] ?>" 
   class="modify_product"
   onclick="return confirm('Êtes-vous sûr ?')">
   <img class="icon_modify" src="../public/icons/modifier.png" alt="icone de modification">
</a>
                        <div class="text">
                    <p class="item_name"><?= htmlspecialchars($produit['nom']) ?></p>
                    <p class="item_quantity">Quantité : <?= htmlspecialchars($produit['quantite']) ?></p>
                    <p class="item_date"><?= htmlspecialchars($produit['date_peremption']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <a href="#" class="add_product" id="openModalBtn">Ajouter un<br>produit</a>
</main>

<?php require_once __DIR__.'/../views/nav_bar.php'; ?>

<script>
// Ajout produit
document.getElementById("openModalBtn").addEventListener("click", function(event) {
    event.preventDefault();
    document.getElementById("addProductModal").style.display = "block";
});
document.querySelector("#addProductModal .close").addEventListener("click", function() {
    document.getElementById("addProductModal").style.display = "none";
});
window.addEventListener("click", function(event) {
    const modal = document.getElementById("addProductModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
});

// Validation date ajout produit
const dateInput = document.querySelector('#addProductModal input[name="date_peremption"]');
const errorMsg = document.getElementById('date-error');
const form = document.querySelector('#addProductModal form');

function isDateValid() {
    const selectedDate = new Date(dateInput.value);
    const today = new Date();
    selectedDate.setHours(0, 0, 0, 0);
    today.setHours(0, 0, 0, 0);
    return selectedDate >= today;
}

dateInput.addEventListener('input', () => {
    errorMsg.textContent = isDateValid() ? "" : "Ce produit est déjà périmé !";
});

form.addEventListener('submit', function(e) {
    if (!isDateValid()) {
        e.preventDefault();
        errorMsg.textContent = "⛔ Veuillez choisir une date de péremption valide (aujourd'hui ou plus tard).";
    }
});

// 🔧 Modification produit
document.querySelectorAll(".modify_product").forEach(btn => {
    btn.addEventListener("click", function(e) {
        e.preventDefault();

        const item = this.closest(".item");
        const id = this.getAttribute("href").split("id=")[1];
        const quantite = item.querySelector(".item_quantity").textContent.replace("Quantité : ", "").trim();
        const date = item.querySelector(".item_date").textContent.trim();

        document.getElementById("modif_frigo_id").value = id;
        document.getElementById("modif_quantite").value = quantite;
        document.getElementById("modif_date").value = date;

        document.getElementById("modifProductModal").style.display = "block";
    });
});

document.querySelector("#modifProductModal .close").addEventListener("click", function() {
    document.getElementById("modifProductModal").style.display = "none";
});
window.addEventListener("click", function(event) {
    const modal = document.getElementById("modifProductModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
});
</script>
</body>
</html>