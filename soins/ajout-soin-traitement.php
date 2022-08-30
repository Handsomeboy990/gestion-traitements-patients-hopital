<?php

$donnees = array();

$erreurs = array();

$message = array();

$message_success = "";

if (isset($_POST["libsoin"]) && !empty($_POST["libsoin"])) {
    $donnees["libsoin"] = $_POST["libsoin"];
} else {
    $erreurs["libsoin"] = "Le champs nom du soin est requis. Veuillez le renseigner.";
};

if (isset($_POST["coutsoin"]) && !empty($_POST["coutsoin"])) {
    $donnees["coutsoin"] = $_POST["coutsoin"];
} else {
    $erreurs["coutsoin"] = "Le champs coût du soin est requis. Veuillez le renseigner.";
}


if (empty($erreurs)) {

    $check_if_soin_exist = check_if_soin_exist($donnees["libsoin"], $donnees["coutsoin"]);

    if (!$check_if_soin_exist) {

        $ajout_soin = ajout_soin($donnees["libsoin"], $donnees["coutsoin"]);

        if ($ajout_soin) {

            $message["statut"] = 1;
            $message["message"] = "Soin ajouté avec succès.";

        } else {

            $message["statut"] = 0;
            $message["message"] = "Oups! Une erreur s'est produite lors de l'ajout du soin. Veuillez réesayer.";

        }

    } else {

        $message["statut"] = 0;
        $message["message"] = "Oups! Ce soin existe déjà dans la base de données. Veuillez consulter la liste complète des soins.";

    }

}

include("ajout-soin.php");
