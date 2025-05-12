<?php

require_once __DIR__."/../env.php";

$db = new PDO("mysql:host=localhost;dbname=openfooddata", $db_user, $db_password);