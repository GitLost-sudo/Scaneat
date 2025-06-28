<?php

try {
    header('Location: /views/authentification.php');
} catch (\Throwable $th) {
    throw $th;
}
