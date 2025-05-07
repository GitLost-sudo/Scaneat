<?php

try {
    header('Location: /scaneat/controllers/inscription_controller.php');
} catch (\Throwable $th) {
    throw $th;
}