
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page d'inscription</title>
  <link rel="stylesheet" href="../style.css">
</head>

<body>
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

  <div class="page-container">

    <div class="titreInscription">INSCRIPTION</div>

    <?php if (isset($message) && $message !== "") : ?>
      <div style="color: <?= ($type_message === 'success') ? 'green' : 'red'; ?>; text-align:center; margin-bottom:10px;">
        <?= htmlspecialchars($message) ?>
      </div>
    <?php endif; ?>

    <form action="inscription_controller.php" method="POST">

      <div class="champ"> Nom : <br>
        <input type="text" name="username" id="username">
      </div>
      <div class="champ"> Email : <br>
        <input type="email" name="email" id="email">
      </div>
      <div class="champ"> Mot de passe : <br>
        <input type="password" name="password" id="password">
      </div>
      <input type="submit" value="Create" class="ButtonCreation" />

    </form>

    <footer>
      <img src="../img/carotte2.png">
      <img src="../img/fromage2.png">
      <img src="../img/pomme2.png">
    </footer>
  </div>
</body>
</html>