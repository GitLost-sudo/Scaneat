<?php

//model
require_once __DIR__."/../models/user_model.php";

$error = null;
if($_SERVER['REQUEST_METHOD']=='POST')
{
    //Guard
    if(
        !isset($_POST['username']) || $_POST['username'] == '' ||
        !isset($_POST['email']) || $_POST['email'] == '' ||
        !isset($_POST['password']) || $_POST['password'] == '')
    {
        throw new Exception("Paramètres invalides");
    }

    $result = createUser($_POST['username'], $_POST['email'], $_POST['password']);
    
    if ($result === true) {
        header('Location: /scaneat/controllers/connexion_controller.php'); #ne pas oublié de mettre la redirection vers la page de connexion
        exit;
    } else {

        $error = $result;
    }
}

require_once __DIR__."/../views/inscription_view.php";