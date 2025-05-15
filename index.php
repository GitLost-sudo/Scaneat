<?php

try {
    header('Location: /scaneat/views/authentification.php');
} catch (\Throwable $th) {
    throw $th;
}