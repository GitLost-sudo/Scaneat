<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanner</title>
    <link rel="stylesheet" href="../public/styles/common.css">
    <link rel="stylesheet" href="../public/styles/scanner.css">
    <script src="https://unpkg.com/@ericblade/quagga2/dist/quagga.min.js"></script>
</head>
<body>
    <?php
    require_once __DIR__.'/../views/header_org.php';
    ?>
    <main>
        <h1>Scanner le code barre</h1>
        <section>
            <div id="scanner-container" style="width:100%; max-width:400px; margin:auto;"></div>
            <div id="scanner-laser"></div>
            <p id="resultat-scan" style="text-align:center;"></p>
            <div id="produit-info" style="text-align: center; margin-top: 20px;"></div>
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
    <h2 id="nom-produit"><?= $product['name'] ?? '' ?></h2>
    <input type="hidden" name="nom" id="nom" value="<?= $product['name'] ?? '' ?>">

    <div>
    <label for="categorie"><span>Catégorie :</span></label>
    <?php foreach ($categories as $category): ?>
    <select name="categorie" id="categorie">
        
    <option value="">Sélectionner une catégorie</option>
        <option value="<?= htmlspecialchars($category['id']) ?>">
            <?= htmlspecialchars($category['name']) ?>
        </option>
    <?php endforeach; ?>
</select>
    <p><small>Catégorie détectée : <span id="cat-suggestion">Aucune</span></small></p>
</div>

    <p><span>Calories /100g :</span> <span id="calories"><?= $product['calories'] ?? '' ?></span></p>
    <input type="hidden" name="calories" id="calories-input" value="<?= $product['calories'] ?? '' ?>">

    <div>
        <label for="quantite"><span>Quantité :</span></label>
        <select name="quantite" id="quantite">
            <option value="">Sélectionner une quantité</option>
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor; ?>
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
    <script>
document.addEventListener('DOMContentLoaded', () => {
    Quagga.init({
        inputStream: {
            name: "Live",
            type: "LiveStream",
            target: document.querySelector('#scanner-container'),
            constraints: {
                facingMode: "environment"
            }
        },
        decoder: {
            readers: ["ean_reader", "upc_reader"]
        },
        locate: true
    }, function (err) {
        if (err) {
            console.error("Erreur Quagga : ", err);
            return;
        }
        Quagga.start();
    });

    let scanned = false;

    Quagga.onDetected((data) => {
        if (scanned) return;
        scanned = true;

        const code = data.codeResult.code;
        document.getElementById("resultat-scan").textContent = "Code détecté : " + code;

        fetch(`https://world.openfoodfacts.org/api/v0/product/${code}.json`)
            .then(response => response.json())
            .then(data => {
    if (data.status === 1) {
        const product = data.product;

        // === NOM ===
        const nom = product.product_name || "Nom inconnu";
        document.getElementById("nom-produit").textContent = nom;
        document.getElementById("nom").value = nom;

        // === CALORIES ===
        const calories = product.nutriments["energy-kcal_100g"] || "";
        document.getElementById("calories").textContent = calories;
        document.getElementById("calories-input").value = calories;

        // === CATÉGORIES ===
        const catText = product.categories || "Aucune";
        const categoriesArray = catText.split(", ").filter(cat => cat.trim() !== "");

        document.getElementById("cat-suggestion").textContent = categoriesArray[0] || "Aucune";

        const select = document.getElementById("categorie");
        select.innerHTML = '<option value="">Sélectionner une catégorie</option>';

        categoriesArray.forEach(cat => {
            const option = document.createElement("option");
            option.value = cat;
            option.textContent = cat;
            select.appendChild(option);
        });

        // Facultatif : pré-sélectionner la première
        if (categoriesArray.length > 0) {
            select.value = categoriesArray[0];
        }

        Quagga.stop();
    } else {
        document.getElementById("produit-info").innerHTML = `
            <p style="color:red;">Produit non trouvé.</p>
        `;
        Quagga.stop();
    }
})


    const nom = product.product_name || "Nom inconnu";
    const calories = product.nutriments["energy-kcal_100g"] || "";

    document.getElementById("nom-produit").textContent = nom;
    document.getElementById("nom").value = nom;

    document.getElementById("calories").textContent = calories;
    document.getElementById("calories-input").value = calories;

    // Si tu veux pré-sélectionner une catégorie (si tu arrives à deviner à partir de `product.categories`)
    // tu peux le faire ici avec un `document.getElementById("categorie").value = "id_catégorie"`

                } else {
                    document.getElementById("produit-info").innerHTML = `
                        <p style="color:red;">Produit non trouvé.</p>
                    `;
                }

                Quagga.stop();
            })
            .catch(err => {
                console.error("Erreur lors de la récupération du produit :", err);
                document.getElementById("produit-info").innerHTML = `
                    <p style="color:red;">Erreur lors de la récupération des données.</p>
                `;
                Quagga.stop();
            });
    });
});
</script>
</body>
</html>