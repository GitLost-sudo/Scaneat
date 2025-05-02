<?php

require_once __DIR__."/db_connect.php";

//Create
function createUser($username, $email, $password) 
{
    global $db;
    $sql = "INSERT INTO `compte`
            (username, email, password) VALUES 
            (:username, :email, :password);";

    $query = $db->prepare($sql);
    $query->execute(array(
        ":username" => $username,
        ":email" => $email,
        ":password" => password_hash($password, PASSWORD_BCRYPT)
    ));
    return "Inscription réussie !";
}
