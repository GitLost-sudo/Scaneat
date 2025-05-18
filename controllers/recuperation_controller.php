<?php

//models
require_once __DIR__.'/../models/recuperation_model.php';
//mail 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__.'/../PHPMailer-master/PHPMailer-master/src/Exception.php';
require_once __DIR__.'/../PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require_once __DIR__.'/../PHPMailer-master/PHPMailer-master/src/SMTP.php';

$message = "";
$type_message = "";

if (isset($_POST['valider']) && !empty($_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);

    // Vérifie si l'email existe dans la BDD
    $req = $connexion->prepare("SELECT compte_id FROM compte WHERE email = ?");
    $req->execute([$email]);
    $data = $req->fetch();

    if ($data) {
        $id = $data['compte_id'];
        $lien = "http://localhost/scaneat/controllers/réinitialisation_controller.php?id=" . urlencode($id);

        // Construction du message HTML
        $message = "Bonjour,<br>Voici le lien pour réinitialiser votre mot de passe : 
                    <a href='$lien'>Cliquez ici</a>";
        $type_message = "success";

        // Envoi de l'email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'dakouriprince7@gmail.com';
            $mail->Password = 'hsedtufznxsfqzqb'; // mot de passe d'application Gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('dakouriprince7@gmail.com', 'ScanEat');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Recuperation de mot de passe';
            $mail->Body = $message;

            $mail->send();
        } catch (Exception $e) {
            $message = "Erreur lors de l'envoi du mail : " . $mail->ErrorInfo;
            $type_message = "error";
        }
    } else {
        $message = "Aucun compte trouvé avec cet email.";
        $type_message = "error";
    }
} else if (isset($_POST['valider'])) {
    $message = "Veuillez entrer un email.";
    $type_message = "error";
}

// Views 
require_once __DIR__.'/../views/recuperation.php';
