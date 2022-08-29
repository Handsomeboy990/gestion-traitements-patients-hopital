<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//Load Composer's autoloader
require 'vendor/autoload.php';


/**
 * Cette fonction permet de se connecter a une base de donnée.
 * Elle retourne l'instance / objet de la base de donnée, si la connexion a la base de donnée est succès.
 * 
 * @return object $db L'instance / objet de la base de donnée.
 */
function connect_db(){

    $db = null;

    try
    {
        $db = new PDO('mysql:host=localhost;dbname=gestion-patient;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
            die("Oups! Une erreur s'est produite lors de la connexion a la base de donnée.");
    }

    return $db;

}


/**
 * Cette fonction permet de verifier si un utilisateur dans la base de donnée ne possède pas cette adresse mail.
 * @param string $email L'email a vérifié.
 * 
 * @return bool $check
 */
function check_email_exist_in_db(string $email){

    $check = false;

    $db = connect_db();

    $requette = "SELECT count(*) as nbr_utilisateur FROM utilisateur WHERE email = :email";

    $verifier_email = $db->prepare($requette);

    $resultat = $verifier_email->execute([
        'email' => $email,
    ]);

    if($resultat ){

        $nbr_utilisateur = $verifier_email->fetch(PDO::FETCH_ASSOC)["nbr_utilisateur"];

        $check = ($nbr_utilisateur > 0) ? true : false;

    }

    return $check;

}


/**
 * Cette fonction permet de verifier si un utilisateur dans la base de donnée ne possède pas ce nom d'utilisateur.
 * @param string $nom_utilisateur Le nom d'utilisateur a vérifié.
 * 
 * @return bool $check
 */
function check_user_name_exist_in_db(string $nom_utilisateur){

    $check = false;

    $db = connect_db();

    $requette = "SELECT count(*) as nbr_utilisateur FROM utilisateur WHERE nom_utilisateur = :nom_utilisateur";

    $verifier_nom_utilisateur = $db->prepare($requette);

    $resultat = $verifier_nom_utilisateur->execute([
        'nom_utilisateur' => $nom_utilisateur,
    ]);

    if($resultat ){

        $nbr_utilisateur = $verifier_nom_utilisateur->fetch(PDO::FETCH_ASSOC)["nbr_utilisateur"];

        $check = ($nbr_utilisateur > 0) ? true : false;
        
    }

    return $check;

}

/**
 * Cette fonction permet de verifier si un utilisateur (email + mot de passe) existe dans la base de donnée.
 * Si oui elle retourne un tableau contenant les informations de l'utilisateur.
 * Sinon elle retourne un tableau vide.
 * 
 * @param string $email L'email.
 * @param string $password Le mot de passe.
 * 
 * @return array $user Les informations de l'utilisateur.
 */
function check_if_user_exist(string $email_user_name, string $password){

    $user = [];

    $db = connect_db();

    $requette = "SELECT * FROM utilisateur WHERE (email = :email or nom_utilisateur = :nom_utilisateur ) and mot_de_passe = :mot_de_passe";

    $verifier_nom_utilisateur = $db->prepare($requette);

    $resultat = $verifier_nom_utilisateur->execute([
        'email' => $email_user_name,
        'nom_utilisateur' => $email_user_name,
        'mot_de_passe' => sha1($password),
    ]);

    if($resultat ){

        $utilisateur = $verifier_nom_utilisateur->fetch(PDO::FETCH_ASSOC);

        $user = (isset($utilisateur) && !empty($utilisateur) && is_array($utilisateur)) ? $utilisateur : [];
        
    }

    return $user;

}

function check_if_user_conneted(){

    $check = false;


    if(isset($_COOKIE["info_utilisateur"]) && !empty($_COOKIE["info_utilisateur"])){
        
        //$user_info = json_decode($_COOKIE["user_info"], true);

        $check = true;

    }

    return $check;

}


function send_mail($email, $message){
    try {

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";

        $mail->SMTPDebug  = 1;  
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "chasakry@gmail.com";
        $mail->Password   = "Mike#password@22";

        $mail->IsHTML(true);
        $mail->AddAddress("lauretchacha@gmail.com", "lauretchacha@gmail.com");
        $mail->SetFrom("lauretchacha@gmail.com", "lauretchacha@gmail.com");
        // $mail->AddReplyTo("reply-to-email@domain", "reply-to-name");
        // $mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");
        $mail->Subject = "Test is Test Email sent via Gmail SMTP Server using PHP Mailer";
        $content = "<b>This is a Test Email sent via Gmail SMTP Server using PHP mailer class.</b>";

        $mail->MsgHTML($content); 
        if(!$mail->Send()) {
            echo "Error while sending Email.";
        var_dump($mail);
        } else {
            echo "Email sent successfully";
        }

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}



function router()
{

    if (isset($_GET["requette"]) && !empty($_GET["requette"])) {

        switch ($_GET["requette"]) {

            case "liste-patient":
                include "patients/liste-patient.php";
                break;

                case "inscription-patient":
                    include "patients/inscription-patient.php";
                    break;

                case "inscription-patient-traitement":
                    include "patients/inscription-patient-traitement.php";
                    break;
    
                case "patient-dashboard":
                    include "patients/patient-dashboard.php";
                    break;
            
                case "dossier-patient":
                    include "patients/dossier-patient.php";
                    break;


            case "liste-medecin":
                include "medecins/liste-medecin.php";
                break;

                case "ajout-medecin":
                    include "medecins/ajout-medecin.php";
                    break;

                case "ajout-medecin-traitement":
                    include "medecins/ajout-medecin-traitement.php";
                    break;
    
                case "medecin-dashboard":
                    include "medecins/medecin-dashboard.php";
                    break;
            
                case "dossier-medecin":
                    include "medecins/dossier-medecin.php";
                    break;
                    
               
            case "liste-maladie":
                include "maladies/liste-maladie.php";
                break;

                case "ajout-maladie":
                    include "maladies/ajout-maladie.php";
                    break;

                case "ajout-maladie-traitement":
                    include "maladies/ajout-maladie-traitement.php";
                    break;
    
                case "maladie-dashboard":
                    include "maladies/maladie-dashboard.php";
                    break;
            
                case "dossier-maladie":
                    include "maladies/dossier-maladie.php";
                    break;
               
            case "liste-consultation":
                include "consultations/liste-consultation.php";
                break;

            default:
                include "default-dashboard.php";
                break;
        }

    } else {

        include "patients/liste-patient.php.php";

    }
}


/**
 * Cett fonction permet d'ajouter un patient a la base de données.
 * 
 * @param string $nom_patient Le nom du patient.
 * 
 * @return bool $inscription_patient Le resultat de l'ajout du patient.
 */
function inscription_patient(string $nom_patient, string $prenom_patient, string $sexepatient, string $date_naissance_patient, string $allergie, int $age): bool  
{

    $inscription_patient = false;

    if((isset($nom_patient) && !empty($nom_patient)) AND (isset($prenom_patient) && !empty($prenom_patient)) AND (isset($sexepatient) && !empty($sexepatient)) AND (isset($date_naissance_patient) && !empty($date_naissance_patient)) AND (isset($allergie) && !empty($allergie)) AND (isset($age) && !empty($age)) ){

        $db = connect_db();

        // Ecriture de la requête
        $requette = 'INSERT INTO patient (nompatient, prenompatient, sexepatient, date_naissance_patient, allergie, age) VALUES (:nompatient, :prenompatient, :sexepatient, :date_naissance_patient, :allergie, :age);';

        // Préparation
        $inserer_patient = $db->prepare($requette);

        // Exécution ! La recette est maintenant en base de données
        $resultat = $inserer_patient->execute([
            'nompatient' => $nom_patient,
            'prenompatient' => $prenom_patient,
            'sexepatient' => $sexepatient,
            'date_naissance_patient' => $date_naissance_patient,
            'allergie' => $allergie,
            'age' => $age

        ]);


        if ($resultat) {
            $inscription_patient = true;
        }

    }

    return $inscription_patient;

}




/**
 * Cette fonction permet de verifier si un utilisateur (email + mot de passe) existe dans la base de donnée.
 * Si oui elle retourne un tableau contenant les informations de l'utilisateur.
 * Sinon elle retourne un tableau vide.
 * 
 * @param string $nom_patient Le nom.
 * @param string $prenom_patient Le prenom.
 * 
 * @return array $check_if_patient_exist Les informations de l'utilisateur.
 */
function check_if_patient_exist(string $nom_patient, string $prenom_patient){

    $check_if_patient_exist = [];

    $db = connect_db();

    $requette = "SELECT * FROM patient WHERE nompatient = :nompatient and prenompatient = :prenompatient";

    $verifier_nompatient = $db->prepare($requette);

    $resultat = $verifier_nompatient->execute([
        'nompatient' => $nom_patient,
        'prenompatient' => $prenom_patient,
    ]);

    if($resultat ){

        $patient = $verifier_nompatient->fetch(PDO::FETCH_ASSOC);

        $check_if_patient_exist = (isset($patient) && !empty($patient) && is_array($patient)) ? $patient : [];
        
    }

    return $check_if_patient_exist;

}


/**
 * Cette fonction permet de récupérer la liste des patients de la base de donnée.
 *
 * @return array $liste_patient La liste des patients.
 */
function get_liste_patient(): array
{

    $liste_patient = array();

    $db = connect_db();

    // Ecriture de la requête
    $requette = 'SELECT * FROM patient';

    // Préparation
    $verifier_liste_patient = $db->prepare($requette);

    // Exécution ! La recette est maintenant en base de données
    $resultat = $verifier_liste_patient->execute();

    if ($resultat) {

        $liste_patient = $verifier_liste_patient->fetchAll(PDO::FETCH_ASSOC);

    }


    return $liste_patient;

}





/**
 * Cett fonction permet  d'ajouter un médecin a la base de données.
 *
 * @param string $nom_medecin Le nom du medecin.
 *
 * @return bool $ajout_medecin Le resultat de l'ajout de médecin.
 */
function ajout_medecin(string $nom_medecin, string $specialite): bool
{

    $ajout_medecin = false;

    if (isset($nom_medecin) && !empty($nom_medecin) AND isset($specialite) && !empty($specialite)) {

        $db = connect_db();

        // Ecriture de la requête
        $requette = 'INSERT INTO medecin (nommedecin, specialite) VALUES (:nommedecin, :specialite);';

        // Préparation
        $inserer_medecin = $db->prepare($requette);

        // Exécution ! La recette est maintenant en base de données
        $resultat = $inserer_medecin->execute([
            'nommedecin' => $nom_medecin,
            'specialite' => $specialite
        ]);


        if ($resultat) {
            $ajout_medecin = true;
        }

    }

    return $ajout_medecin;

}

function check_if_medecin_exist(string $nom_medecin): bool
{

    $check_if_medecin_exist = false;

    if (isset($nom_medecin) && !empty($nom_medecin)) {

        $db = connect_db();

        // Ecriture de la requête
        $requette = 'SELECT count(*) as nbr_medecin FROM medecin WHERE nommedecin = :nommedecin;';

        // Préparation
        $verifier_medecin = $db->prepare($requette);

        // Exécution ! La recette est maintenant en base de données
        $resultat = $verifier_medecin->execute([
            'nommedecin' => $nom_medecin
        ]);

        if ($resultat) {

            $check_if_medecin_exist = ($verifier_medecin->fetch(PDO::FETCH_ASSOC)["nbr_medecin"] > 0) ? true : false;

        }

    }

    return $check_if_medecin_exist;

}





/**
 * Cette fonction permet de récupérer la liste des médecins de la base de donnée.
 *
 * @return array $liste_medecins La liste des médecins.
 */
function get_liste_medecins(): array
{

    $liste_medecins = array();

    $db = connect_db();

    // Ecriture de la requête
    $requette = 'SELECT * FROM medecin';

    // Préparation
    $verifier_liste_medecins = $db->prepare($requette);

    // Exécution ! La recette est maintenant en base de données
    $resultat = $verifier_liste_medecins->execute();

    if ($resultat) {

        $liste_medecins = $verifier_liste_medecins->fetchAll(PDO::FETCH_ASSOC);

    }


    return $liste_medecins;

}

/**
 * Cette fonction permet de récupérer un médecin via son numéro d'immatriculation.
 *
 * @param int $matmed L'immatriculation du médecin.
 *
 * @return array $medecin Le médecin.
 */
function get_medecin_by_matmed(int $matmed): array
{

    $medecin = array();

    $db = connect_db();

    // Ecriture de la requête
    $requette = 'SELECT * FROM medecin WHERE matmed = :matmed ';

    // Préparation
    $verifier_medecin = $db->prepare($requette);

    // Exécution ! La recette est maintenant en base de données
    $resultat = $verifier_medecin->execute([
        "matmed" => $matmed
    ]);

    if ($resultat) {

        $medecin = $verifier_medecin->fetchAll(PDO::FETCH_ASSOC);

    }

    return $medecin;

}







/**
 * Cett fonction permet  d'ajouter une maladie à la base de données.
 *
 * @param string $nommal Le nom du medecin.
 *
 * @return bool $ajout_maladie Le resultat de l'ajout de la maladie.
 */
function ajout_maladie(string $nommal): bool
{

    $ajout_maladie = false;

    if (isset($nommal) && !empty($nommal)) {

        $db = connect_db();

        // Ecriture de la requête
        $requette = 'INSERT INTO maladie (nommal) VALUES (:nommal);';

        // Préparation
        $inserer_maladie = $db->prepare($requette);

        // Exécution ! La recette est maintenant en base de données
        $resultat = $inserer_maladie->execute([
            'nommal' => $nommal
        ]);


        if ($resultat) {
            $ajout_maladie = true;
        }

    }

    return $ajout_maladie;

}

function check_if_maladie_exist(string $nommal): bool
{

    $check_if_maladie_exist = false;

    if (isset($nommal) && !empty($nommal)) {

        $db = connect_db();

        // Ecriture de la requête
        $requette = 'SELECT count(*) as nbr_maladie FROM maladie WHERE nommal = :nommal;';

        // Préparation
        $verifier_maladie = $db->prepare($requette);

        // Exécution ! La recette est maintenant en base de données
        $resultat = $verifier_maladie->execute([
            'nommal' => $nommal
        ]);

        if ($resultat) {

            $check_if_maladie_exist = ($verifier_maladie->fetch(PDO::FETCH_ASSOC)["nbr_maladie"] > 0) ? true : false;

        }

    }

    return $check_if_maladie_exist;

}





/**
 * Cette fonction permet de récupérer la liste des maladies de la base de donnée.
 *
 * @return array $liste_medecins La liste des maladies.
 */
function get_liste_maladies(): array
{

    $liste_maladies = array();

    $db = connect_db();

    // Ecriture de la requête
    $requette = 'SELECT * FROM maladie';

    // Préparation
    $verifier_liste_maladies = $db->prepare($requette);

    // Exécution ! La recette est maintenant en base de données
    $resultat = $verifier_liste_maladies->execute();

    if ($resultat) {

        $liste_maladies = $verifier_liste_maladies->fetchAll(PDO::FETCH_ASSOC);

    }


    return $liste_maladies;

}

/**
 * Cette fonction permet de récupérer une maladie via son numéro d'identification.
 *
 * @param int $nummal L'immatriculation du médecin.
 *
 * @return array $maladie Le médecin.
 */
function get_maladie_by_nummal(int $nummal): array
{

    $maladie = array();

    $db = connect_db();

    // Ecriture de la requête
    $requette = 'SELECT * FROM maladie WHERE nummmal = :nummal ';

    // Préparation
    $verifier_maladie = $db->prepare($requette);

    // Exécution ! La recette est maintenant en base de données
    $resultat = $verifier_maladie->execute([
        "nummal" => $nummal
    ]);

    if ($resultat) {

        $maladie = $verifier_maladie->fetchAll(PDO::FETCH_ASSOC);

    }

    return $maladie;

}