<?php

$donnees = array();

$erreurs = array();

$message = array();

$message_success = "";

if (isset($_POST["datrdv"]) && !empty($_POST["datrdv"])) {
    $donnees["datrdv"] = $_POST["datrdv"];
} else {
    $erreurs["datrdv"] = "Le champs date du rendez-vous est requis. Veuillez le renseigner.";
}


if (empty($erreurs)) {

    $check_if_rdv_exist = check_if_rdv_exist($donnees["datrdv"]);

    if (!$check_if_rdv_exist) {

        $ajout_rdv = ajout_rdv($donnees["datrdv"]);

        if ($ajout_rdv) {

            $message["statut"] = 1;
            $message["message"] = "Rendez-vous ajouté avec succès.";

        } else {

            $message["statut"] = 0;
            $message["message"] = "Oups! Une erreur s'est produite lors de l'enregistrement du rendez-vous. Veuillez réesayer.";

        }

    } else {

        $message["statut"] = 0;
        $message["message"] = "Oups! Cette plage horaire est déjà prise dans votre agenda. Veuillez décaler le rendez-vous.";

    }

}

include("ajout-rdv.php");
