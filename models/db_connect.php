<?php

require_once __DIR__."/../env.php";
$db_user='root';
$db_password='';
$db = new PDO("mysql:host=localhost;dbname=ScanEat", $db_user, $db_password);
