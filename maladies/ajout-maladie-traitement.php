<?php

$donnees = array();

$erreurs = array();

$message = array();

$message_success = "";

if (isset($_POST["nommal"]) && !empty($_POST["nommal"])) {
    $donnees["nommal"] = $_POST["nommal"];
} else {
    $erreurs["nommal"] = "Le champs nom de la maladie est requis. Veuillez le renseigner.";
}


if (empty($erreurs)) {

    $check_if_maladie_exist = check_if_maladie_exist($donnees["nommal"]);

    if (!$check_if_maladie_exist) {

        $ajout_maladie = ajout_maladie($donnees["nommal"]);

        if ($ajout_maladie) {

            $message["statut"] = 1;
            $message["message"] = "Maladie ajouté avec succès.";

        } else {

            $message["statut"] = 0;
            $message["message"] = "Oups! Une erreur s'est produite lors de l'ajout de la maladie. Veuillez réesayer.";

        }

    } else {

        $message["statut"] = 0;
        $message["message"] = "Oups! Cette maladie existe déjà dans la base de données. Veuillez consulter la liste complète des maladies.";

    }

}

include("ajout-maladie.php");
