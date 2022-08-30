<?php

$donnees = array();

$erreurs = array();

$message = array();

$message_success = "";

if (isset($_POST["nommed"]) && !empty($_POST["nommed"])) {
    $donnees["nommed"] = $_POST["nommed"];
} else {
    $erreurs["nommed"] = "Le champs nom du médicament est requis. Veuillez le renseigner.";
}


if (empty($erreurs)) {

    $check_if_medicament_exist = check_if_medicament_exist($donnees["nommed"]);

    if (!$check_if_medicament_exist) {

        $ajout_medicament = ajout_medicament($donnees["nommed"]);

        if ($ajout_medicament) {

            $message["statut"] = 1;
            $message["message"] = "Médicament ajouté avec succès.";

        } else {

            $message["statut"] = 0;
            $message["message"] = "Oups! Une erreur s'est produite lors de l'ajout du médicament. Veuillez réesayer.";

        }

    } else {

        $message["statut"] = 0;
        $message["message"] = "Oups! Ce médicament existe déjà dans la base de données. Veuillez consulter la liste complète des médicaments.";

    }

}

include("ajout-medicament.php");
