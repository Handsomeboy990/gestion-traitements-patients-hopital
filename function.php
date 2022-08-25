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
function inscription_patient(string $nom_patient, string $prenom_patient, string $sexepatient, string $date_naissance_patient, string $allergie): bool  
{

    $inscription_patient = false;

    if((isset($nom_patient) && !empty($nom_patient)) AND (isset($prenom_patient) && !empty($prenom_patient)) AND (isset($sexepatient) && !empty($sexepatient)) AND (isset($date_naissance_patient) && !empty($date_naissance_patient)) AND (isset($allergie) && !empty($allergie)) ){

        $db = connect_db();

        // Ecriture de la requête
        $requette = 'INSERT INTO patient (nompatient, prenompatient, sexepatient, date_naissance_patient, allergie) VALUES (:nompatient, :prenompatient, :sexepatient, :date_naissance_patient, :allergie);';

        // Préparation
        $inserer_patient = $db->prepare($requette);

        // Exécution ! La recette est maintenant en base de données
        $resultat = $inserer_patient->execute([
            'nompatient' => $nom_patient,
            'prenompatient' => $prenom_patient,
            'sexepatient' => $sexepatient,
            'date_naissance_patient' => $date_naissance_patient,
            'allergie' => $allergie

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