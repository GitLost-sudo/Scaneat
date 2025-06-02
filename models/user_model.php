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
/*
function loginUser($email, $password) {
    global $db;

    // On autorise la connexion avec l'email OU le nom d'utilisateur
    $sql = "SELECT * FROM compte WHERE email = :email";
    $query = $db->prepare($sql);
    $query->execute([
        ':email' => $email
    ]);
    $user = $query->fetch();

    if ($user && password_verify($password, $user['password'])) {
        return "Connexion réussie";
    } else {
        return "Identifiants incorrects";
    }
}
*/