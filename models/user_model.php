<?php

require_once __DIR__."/../models/db_connect.php";
#model lié a la gestion des données des utilisateurs

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
    return true;
}
