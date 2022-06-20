<?php

include 'function.php';

$donnees = array();

$erreurs = array();

$message = array();

if (isset($_POST["email-nom-utilisateur"]) && !empty($_POST["email-nom-utilisateur"])) {
    $donnees["email-nom-utilisateur"] = $_POST["email-nom-utilisateur"];
} else {
    $erreurs["email-nom-utilisateur"] = "Veuillez saisir votre nom d'utilisateur ou email";
}

if (isset($_POST["mot-passe"]) && !empty($_POST["mot-passe"])) {
    $donnees["mot-passe"] = $_POST["mot-passe"];
} else {
    $erreurs["mot-passe"] = "Le champs mot de passe est requis. Veuillez le renseigner.";
}

if (empty($erreurs)) {

        $user = check_if_user_exist($donnees["email-nom-utilisateur"], $donnees["mot-passe"]);

        if(isset($user) && !empty($user) && is_array($user)){

            if(0 == $user["est_actif"]){

                $message_success["statut"] = 0;
                $message_success["message"] = "Oups! Votre compte n'est pas actif pour le moment. Veuillez nous-contacter.";

            }else{

                setcookie("info_utilisateur", json_encode($user));

                $message_success["statut"] = 1;
                $message_success["message"] = "Connexion éffectuée avec succès.";

            }

        }else{

            $message_success["statut"] = 0;
            $message_success["message"] = "Oups! Email / mot de passe incorrect. Veuillez réessayer.";

        }

}


header("location: connexion.php?erreurs=" . json_encode($erreurs) . "&donnees=" . json_encode($donnees) . "&message=" . json_encode($message_success));