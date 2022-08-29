<?php

$donnees = array();

$erreurs = array();

$message = array();


$message_success = "";

if (isset($_POST["nom_patient"]) && !empty($_POST["nom_patient"])) {
    $donnees["nom_patient"] = $_POST["nom_patient"];
} else {
    $erreurs["nom_patient"] = "Ce champs est requis. Veuillez le renseigner.";
}

if (isset($_POST["prenom_patient"]) && !empty($_POST["prenom_patient"])) {
    $donnees["prenom_patient"] = $_POST["prenom_patient"];
} else {
    $erreurs["prenom_patient"] = "Ce champs est requis. Veuillez le renseigner.";
}



if (isset($_POST["sexe_patient"]) AND !empty($_POST["sexe_patient"])) {
    $donnees["sexe_patient"] = $_POST["sexe_patient"];
} else {
    $erreurs["sexe_patient"] = "Ce champs est requis. Veuillez le renseigner.";
};

if (isset($_POST["date_naissance_patient"]) AND !empty($_POST["date_naissance_patient"]) AND $_POST["date_naissance_patient"] <= date("Y-m-d")) {
    $donnees["date_naissance_patient"] = $_POST["date_naissance_patient"];


        //calcule de l'age du patient
        $age= date_diff(date_create($_POST["date_naissance_patient"]),date_create(date("Y-m-d")))->format('%y') ;

        $donnees["age"] = $age;

    
} else {
   
    if (isset($_POST["date_naissance_patient"]) AND !empty($_POST["date_naissance_patient"]) AND $_POST["date_naissance_patient"] > date("Y-m-d")) {
        $erreurs["date_naissance_patient"] = "Veuillez renseigner une date de naissance valide.";
    } else{
        $erreurs["date_naissance_patient"] = "Ce champs est requis. Veuillez le renseigner.";
    }
};


if (isset($_POST["allergie"]) AND !empty($_POST["allergie"])) {
    $donnees["allergie"] = $_POST["allergie"];
} else {
    $erreurs["allergie"] = "Ce champs est requis. Veuillez le renseigner.";
};




if (empty($erreurs)) {

    $check_if_patient_exist = check_if_patient_exist($donnees["nom_patient"], $donnees["prenom_patient"]);

    if (!$check_if_patient_exist) {

        $inscription_patient = inscription_patient($donnees["nom_patient"], $donnees["prenom_patient"], $donnees["sexe_patient"], $donnees["date_naissance_patient"], $donnees["allergie"],$donnees["age"]);

        if ($inscription_patient=true) {

            $message["statut"] = 1;
            $message["message"] = "Patient ajouté avec succès.";

        } else {

            $message["statut"] = 0;
            $message["message"] = "Désolé! Une erreur s'est produite lors de l'inscription du patient. Veuillez réesayer. Si le problème persiste, veuillez nous contacter.";

        }

    }else{

        $message["statut"] = 0;
        $message["message"] = "Ce patient existe déjà dans la base de données. Veuillez consulter la liste des patients.";

    }

}





/*
if(empty($erreurs)){
    $db = connect_db();

    // Ecriture de la requête
    $requette = 'INSERT INTO patient (nompatient, prenompatient, sexepatient, date_naissance_patient, allergie)  VALUES (:nompatient, :prenompatient, :sexepatient, :date_naissance_patient, :allergie)';

    // Préparation
    $inserer_patient = $db->prepare($requette);

    // Exécution ! La recette est maintenant en base de données
    $resultat = $inserer_patient->execute([
        'nompatient' => $donnees["nom_patient"],
        'prenompatient' => $donnees["prenom_patient"],
        'sexepatient' => $donnees["sexe_patient"],
        'date_naissance_patient' => $donnees["date_naissance_patient"],
        'allergie' => $donnees["allergie"]
    ]) ;


    if($resultat=true){
        $message["statut"] = 1;
        $message_success = "Patient ajouté avec succès.";
    }else{

        $message["statut"] = 0;
        $message_success = "Oups! Une erreur s'est produite lors de l'ajout du patient. Veuillez réesayer";
    }
}
*/

include("patients/inscription-patient.php");
