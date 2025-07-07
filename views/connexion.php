<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Connexion</title>
  <link rel="stylesheet" href="../style.css" />
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

    <div class="titreInscription">CONNEXION</div>

    <form action="../controllers/connexion_controller.php" method="POST">
      <div class="champ">Email :<br>
        <input type="text" name="email" placeholder="Email" required>
      </div>
      <div class="champ">Mot de passe :<br>
        <input type="password" name="password" placeholder="Password" required>
      </div>
      <div class="oublie">
        <a href="../controllers/recuperation_controller.php">Mot de passe oublié ?</a>
      </div>
      <input type="submit" value="Se connecter" name="valider" class="ButtonCreation" />
      
      <?php if (!empty($message)): ?>
        <div class="message <?= $type_message === 'success' ? 'success' : 'error' ?>">
          <?= $message ?>
        </div>
      <?php endif; ?>
    </form>

 
  </div>
</body>
</html>
