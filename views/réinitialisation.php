<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau mot de passe</title>
    <link href="../style.css" rel="stylesheet" />
</head>

<body>
    <div class="page-container">
        <header>
            <div class="logo">
                <img src="../img/ecriture.png">
            </div>
            <div class="home-icon">
                <a href="../controllers/authentification_controller.php">
                    <img src="../img/home.png">
                </a>
            </div>
        </header>
        <form action="" method="POST">


            <div class="champ"> Nouveau Mot de Passe : <br>
                <input type="text" name="password">
            </div>
            <div class="champ"> Confirmation Mot de Passe: <br>
                <input type="password" name="confirmation">
            </div>

            <input type="submit" value="Changer" name="valider" class="ButtonCreation">
            <?php if (!empty($message)): ?>
                <div
                    style="text-align: center; color: <?= $type_message === 'success' ? 'green' : 'red' ?>; margin-top: 15px;">
                    <?= $message ?>
                </div>
            <?php endif; ?>


        </form>
        <footer>
            <img src="../img/carotte2.png">
            <img src="../img/fromage2.png">
            <img src="../img/pomme2.png">
        </footer>
    </div>
</body>

</html>