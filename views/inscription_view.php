<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <div class="page-container fade-in">
    <header>
      <div class="logo">
        <img src="../img/ecriture.png" alt="Logo">
      </div>
      <div class="home-icon">
        <a href="../controllers/authentification_controller.php">
          <img src="../img/home.png" alt="Accueil">
        </a>
      </div>
    </header>

    <div class="titreInscription">INSCRIPTION</div>

    <?php if (isset($message) && $message !== "") : ?>
      <div class="message <?= ($type_message === 'success') ? 'success' : 'error'; ?>">
        <?= htmlspecialchars($message) ?>
      </div>
    <?php endif; ?>

    <form action="inscription_controller.php" method="POST">
      <div class="champ">Nom :<br>
        <input type="text" name="username" required>
      </div>
      <div class="champ">Email :<br>
        <input type="email" name="email" required>
      </div>
      <div class="champ">Mot de passe :<br>
        <input type="password" name="password" required>
      </div>
      <input type="submit" value="Créer mon compte" class="ButtonCreation" />
    </form>

  </div>
</body>
</html>
