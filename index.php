<?php

try {
    require_once "./controllers/inscription_controller.php"; #mettre la redirection sur la page de choix d'authentification
} catch (\Throwable $th) {
    throw $th;
}