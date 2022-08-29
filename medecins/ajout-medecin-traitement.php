<?php

$donnees = array();

$erreurs = array();

$message = array();

$message_success = "";

if (isset($_POST["nom-medecin"]) && !empty($_POST["nom-medecin"])) {
    $donnees["nom-medecin"] = $_POST["nom-medecin"];
} else {
    $erreurs["nom-medecin"] = "Le champs nom du médecin est requis. Veuillez le renseigné.";
};

if (isset($_POST["specialite"]) AND !empty($_POST["specialite"])) {
    $donnees["specialite"] = $_POST["specialite"];
} else {
    $erreurs["specialite"] = "Ce champs est requis. Veuillez le renseigner.";
};

if (empty($erreurs)) {

    $check_if_medecin_exist = check_if_medecin_exist($donnees["nom-medecin"], $donnees["specialite"]);

    if (!$check_if_medecin_exist) {

        $ajout_medecin = ajout_medecin($donnees["nom-medecin"], $donnees["specialite"]);

        if ($ajout_medecin) {

            $message["statut"] = 1;
            $message["message"] = "Médecin ajouté avec succès.";

        } else {

            $message["statut"] = 0;
            $message["message"] = "Oups! Une erreur s'est produite lors de l'ajout du médecin. Veuillez réesayer.";

        }

    } else {

        $message["statut"] = 0;
        $message["message"] = "Oups! Ce médecin existe déjà dans la base de données. Veuillez consulter la liste complète des médecins.";

    }

}

include("medecins/ajout-medecin.php");
