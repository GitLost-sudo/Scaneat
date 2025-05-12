<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    header {
        background-color: #ff914d;
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 10vh;
        margin: -0.46em -0.49em 0 -0.49em;
        border-radius: 0.5em;
        padding: 0 1em;
    }

    .iconemaison img,
    .iconemenu img {
        height: 3.2em;
        width: auto;
    }

    .logo img {
        height: 2.8em;
        width: auto;
    }

    .logo,
    .iconemaison,
    .iconemenu {
        display: flex;
        align-items: center;
    }

    /* Responsive mobile */
    @media (max-width: 600px) {
        .iconemaison img,
        .iconemenu img {
            height: 2.6em;
        }

        .logo img {
            height: 2.3em;
        }
    }
</style>

<header>
    <div class="iconemaison">
        <a href="../views/acceuil_view.php"><img src="../public/icons/accueil.png" alt="Maison"></a>
    </div>
    <div class="logo">
        <img src="../public/img/SCAN'EAT_Ecriture.png" alt="Scan Eat">
    </div>
    <div class="iconemenu">
        <a href="#"><img src="../public/icons/utilisateur.png" alt="Menu"></a>
    </div>
</header>