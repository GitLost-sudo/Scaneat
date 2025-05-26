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
                    document.getElementById("produit-info").innerHTML = `
                        <h2>${product.product_name || "Nom inconnu"}</h2>
                        <p><strong>Marque :</strong> ${product.brands || "Inconnue"}</p>
                        <p><strong>Catégorie :</strong> ${product.categories || "Non précisée"}</p>
                        <p><strong>Calories /100g :</strong> ${product.nutriments["energy-kcal_100g"] || "N/A"}</p>
                        ${product.image_url ? `<img src="${product.image_url}" alt="Image du produit" style="max-width: 150px;">` : ""}
                    `;
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