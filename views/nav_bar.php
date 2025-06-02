<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">
<style>
nav {
    background-color: #ff914d;
    position: sticky;
    bottom: 0;
    left: 0;
    right: 0;
    display: flex;
    justify-content: space-around;
    align-items: center;
    height: 10vh;
    border-radius: 0.5em 0.5em 0 0;
    font-family: 'Archivo Black', sans-serif;
    
    z-index: 1000;
    
}

nav .navbar_scanner,
nav .navbar_frigo,
nav .navbar_recette {
    display: flex;
    flex-direction: column;
    align-items: center;
    color: white;
    text-decoration: none;
}

nav img {
    height: 3em;
    width: auto;
    margin-bottom: 0.3em;
}

nav p {
    margin: 0;
    font-size: 1em;
    color: white;
}

/* Responsive mobile */
@media (max-width: 600px) {
    nav img {
        height: 2.2em;
    }

    nav p {
        font-size: 0.8em;
    }
}
</style>

<nav>
    <div class="navbar_scanner">
        <a href="../controllers/scanner_controller.php"><img src="../public/icons/codebarre_icone.png" alt="scanner"></a>
        <p>Scanner</p>
    </div>
    <div class="navbar_frigo">
        <a href="../controllers/frigo_controller.php"><img src="../public/icons/frigo_icone.png" alt="frigo"></a>
        <p>Frigo</p>
    </div>
    <div class="navbar_recette">
        <a href="../controllers/liste_recette_controller.php"><img src="../public/icons/recettes_icones.png" alt="recettes"></a>
        <p>Recettes</p>
    </div>
</nav>