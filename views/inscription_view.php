<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'inscription</title>
    <link rel="stylesheet" href="./../public/styles/common.css">
    <link rel="stylesheet" href="./../public/styles/inscription.css">
</head>
<body> 
<?php include('header.php'); ?>
<div class="inscription">
    Inscription
</div>
  <form action="controllers/inscription_controller.php" method="POST" class="form-example">
  <div class="form-example">
      <label for="username">Nom: </label>
      <input type="text" name="username" id="username" required />
    </div>
  <div class="form-example">
      <label for="email">Email: </label>
      <input type="email" name="email" id="email" required />
    </div>
    <div class="form-example">
      <label for="password">Mot de passe: </label>
      <input type="password" name="password" id="password" required />
    </div>
    <div class="form-example">
      <input type="submit" value="Create account" />
    </div>
  </form>
</main>
<nav></nav>
</body>
</html>