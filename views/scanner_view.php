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
            <p id="resultat-scan" style="text-align:center;"></p>
            <div id="produit-info" style="text-align: center; margin-top: 20px;"></div>
        </section>
        <?php
        if (!isset($error)) { // undefined
            ?>
            <img class="scan_image" src="../public/img/loupe.png" alt="Image de loupe">
            <?php
        }
        else if ($error == false) { // false
            ?>
            <form class="form_ajout" action="../controllers/ajouter_produit_controller.php" method="post">
    <h2 id="nom-produit"><?= $product['name'] ?? 'Nom du produit' ?></h2>

    <!-- Champs cachés pour envoi -->
    <input type="hidden" name="nom" id="input-nom">
    <input type="hidden" name="code_barre" id="input-code-barre">
    <input type="hidden" name="calories" id="input-calories">

    <!-- Affichage des calories (visible) -->
    <p><span>Calories /100g : </span><?= $product['calories'] ?? '...' ?></p>

    <div>
        <label for="categorie"><span>Catégorie :</span></label>
        <select name="categorie" id="categorie" required>
          <option value="">--Choisissez une catégorie--</option>
          <option value="légume">Légume</option>
          <option value="fruit">Fruit</option>
          <option value="viande">Viande</option>
          <option value="produit_laitiers">Produit laitier</option>
          <option value="boissons">Boisson</option>
          <option value="autre">Autre</option>
        </select>
    </div>

    <div>
        <label for="quantite"><span>Quantité :</span></label>
        <input type="number" name="quantitee" id="quantitee" min="1" value="1" required>
    </div>

    <div>
        <label for="date_peremption"><span>Date de péremption :</span></label>
        <input type="date" name="date_peremption" required><br>
    </div>

    <input type="submit" value="Ajouter">
</form>

            <?php
        }
        else if ($error == 'not-found') { // not-found
            ?>
            <img class="scan_image" src="../public/img/interrogation.png" alt="Image de point d'interrogation">
            <p>Veuillez recommencer</p>
            <?php
        }
        else { // true
            ?>
            <img class="scan_image" src="../public/img/croix_rouge.png" alt="Image de croix rouge">
            <p>Produit non reconnu</p>
            <p>Veuillez ajouter le produit manuellement dans le frigo</p>
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
    }, err => {
        if (err) {
            console.error("Erreur Quagga :", err);
            return;
        }
        Quagga.start();
    });

    let scanned = false;

    Quagga.onDetected((data) => {
        if (scanned) return;
        scanned = true;

        const code = data.codeResult.code;
        document.getElementById("resultat-scan").textContent = "Code barre du produit : " + code;

        fetch(`https://world.openfoodfacts.org/api/v0/product/${code}.json`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 1) {
                    const product = data.product;
                    const nomProduit = product.product_name || "";
                    const calories = product.nutriments["energy-kcal_100g"] || "";

                    // Affichage visuel
                    document.getElementById("produit-info").innerHTML = `
                        ${product.image_url ? `<img src="${product.image_url}" alt="Image du produit" style="max-width: 150px;">` : ""} 
                    `;//ça va afficher l'image venant de la base de données

                    // Remplissage du formulaire
                    document.getElementById("nom-produit").textContent = nomProduit;
                    document.getElementById("input-nom").value = nomProduit;
                    document.getElementById("input-code-barre").value = code;
                    document.getElementById("input-calories").value = calories;
                    document.getElementById("calories-affichees").textContent = calories;

                } else {
                    document.getElementById("produit-info").innerHTML = `<p style="color:red;">Produit non trouvé.</p>`;
                }

                Quagga.stop();
            })
            .catch(err => {
                console.error("Erreur API :", err);
                document.getElementById("produit-info").innerHTML = `<p style="color:red;">Erreur lors de la récupération des données.</p>`;
                Quagga.stop();
            });
    });
});

</script>
</body>
</html>