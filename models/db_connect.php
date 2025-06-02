<?php

require_once __DIR__."/../models/env.php";

$db = new PDO("mysql:host=localhost;dbname=ScanEat", $db_user, $db_password);
