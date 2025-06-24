<?php

session_start();
require_once __DIR__ . '/../models/db_connect.php';

// PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../PHPMailer-master/PHPMailer-master/src/Exception.php';
require_once __DIR__ . '/../PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer-master/PHPMailer-master/src/SMTP.php';

$message = "";
$type_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['username'])) {
        $email = htmlspecialchars($_POST['email']);
        $password = $_POST['password'];
        $username = htmlspecialchars($_POST['username']);

        // Vérifie si l'email existe déjà
        $req = $db->prepare("SELECT compte_id FROM compte WHERE email = ?");
        $req->execute([$email]);
        if ($req->fetch()) {
            $message = "Cet email est déjà utilisé.";
            $type_message = "error";
        } else {
            // Hash du mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insertion du nouvel utilisateur
            $insert = $db->prepare("INSERT INTO compte (email, password, username) VALUES (?, ?, ?)");
            if ($insert->execute([$email, $hashed_password, $username])) {
                // Envoi du mail de confirmation
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'scaneat.esiea@gmail.com';
                    $mail->Password = 'elpoarutvqhprieb';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;
                    $mail->setFrom('scaneat.esiea@gmail.com', 'ScanEat');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = 'Confirmation d\'inscription';

                    

                    $mail->Body = '
    <div style="font-family: Arial, sans-serif; background: #f9f9f9; padding: 30px; border-radius: 10px; text-align: center;">
   
    <h2 style="color: #27ae60;">
        Bienvenue <span style="color: #e74c3c;">' . htmlspecialchars($username) . '</span> sur 
        <span style="color:#e67e22;">ScanEat</span> !
    </h2>
    <p style="font-size: 18px; color: #333;">
        Votre compte a été <b>créé avec succès</b>.<br>
        Nous sommes ravis de vous compter parmi nous.<br><br>
        <span style="color:#27ae60;">Bon appétit et bonne découverte !</span>
    </p>
    <hr style="margin: 30px 0;">
    <small style="color: #888;">&copy; ' . date('Y') . ' ScanEat</small>
</div>
';

                    $mail->send();
                    $message = "Votre compte a été créé et un mail de confirmation a été envoyé.";
                    $type_message = "success";
                } catch (Exception $e) {
                    $message = "Compte créé, mais le mail de confirmation n'a pas pu être envoyé.";
                    $type_message = "success";
                }
            } else {
                $message = "Erreur lors de la création du compte.";
                $type_message = "error";
            }
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
        $type_message = "error";
    }
}

// view
require_once __DIR__ . '/../views/inscription_view.php';