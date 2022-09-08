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
    
            case "liste-maladie":
                include "maladies/liste-maladie.php";
                break;

                case "ajout-maladie":
                    include "maladies/ajout-maladie.php";
                    break;

                case "ajout-maladie-traitement":
                    include "maladies/ajout-maladie-traitement.php";
                    break;

            case "liste-medicament":
                include "medicaments/liste-medicament.php";
                break;

                case "ajout-medicament":
                    include "medicaments/ajout-medicament.php";
                    break;

                case "ajout-medicament-traitement":
                    include "medicaments/ajout-medicament-traitement.php";
                    break;

            case "liste-soin":
                include "soins/liste-soin.php";
                break;

                case "ajout-soin":
                    include "soins/ajout-soin.php";
                    break;

                case "ajout-soin-traitement":
                    include "soins/ajout-soin-traitement.php";
                    break;
    
            case "liste-traitement":
                include "traitement/liste-traitement.php";
                break;

                case "ajout-traitement":
                    include "traitement/ajout-traitement.php";
                    break;

                case "ajout-traitement-traitement":
                    include "traitement/ajout-traitement-traitement.php";
                    break;
    
               
            case "liste-ordonnance":
                include "ordonnance/liste-ordonnance.php";
                break;

                case "prescription-ordonnance":
                    include "ordonnance/prescription-ordonnance.php";
                    break;

                case "prescription-ordonnance-traitement":
                    include "ordonnance/prescription-ordonnance-traitement.php";
                    break;

            default:
                include "default-dashboard.php";
                break;
        }

    } else {

        include "patients/liste-patient.php";

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
 * @param string $nommal Le nom de la maladie.
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
 * @return array $liste_maladies La liste des maladies.
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
 * @param int $nummal L'id de la maladie.
 *
 * @return array $maladie La maladie.
 */
function get_maladie_by_nummal(int $nummal): array
{

    $maladie = array();

    $db = connect_db();

    // Ecriture de la requête
    $requette = 'SELECT * FROM maladie WHERE nummal = :nummal ';

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






/**
 * Cett fonction permet  d'ajouter un medicament à la base de données.
 *
 * @param string $nommed Le nom du medicament.
 *
 * @return bool $ajout_medicament Le resultat de l'ajout du medicament.
 */
function ajout_medicament(string $nommed): bool
{

    $ajout_medicament = false;

    if (isset($nommed) && !empty($nommed)) {

        $db = connect_db();

        // Ecriture de la requête
        $requette = 'INSERT INTO medicament (nommed) VALUES (:nommed);';

        // Préparation
        $inserer_medicament = $db->prepare($requette);

        // Exécution ! La recette est maintenant en base de données
        $resultat = $inserer_medicament->execute([
            'nommed' => $nommed
        ]);


        if ($resultat) {
            $ajout_medicament = true;
        }

    }

    return $ajout_medicament;

}

function check_if_medicament_exist(string $nommed): bool
{

    $check_if_medicament_exist = false;

    if (isset($nommed) && !empty($nommed)) {

        $db = connect_db();

        // Ecriture de la requête
        $requette = 'SELECT count(*) as nbr_medicament FROM medicament WHERE nommed = :nommed;';

        // Préparation
        $verifier_medicament = $db->prepare($requette);

        // Exécution ! La recette est maintenant en base de données
        $resultat = $verifier_medicament->execute([
            'nommed' => $nommed
        ]);

        if ($resultat) {

            $check_if_medicament_exist = ($verifier_medicament->fetch(PDO::FETCH_ASSOC)["nbr_medicament"] > 0) ? true : false;

        }

    }

    return $check_if_medicament_exist;

}





/**
 * Cette fonction permet de récupérer la liste des medicaments de la base de donnée.
 *
 * @return array $liste_medicaments La liste des medicaments.
 */
function get_liste_medicaments(): array
{

    $liste_medicaments = array();

    $db = connect_db();

    // Ecriture de la requête
    $requette = 'SELECT * FROM medicament';

    // Préparation
    $verifier_liste_medicaments = $db->prepare($requette);

    // Exécution ! La recette est maintenant en base de données
    $resultat = $verifier_liste_medicaments->execute();

    if ($resultat) {

        $liste_medicaments = $verifier_liste_medicaments->fetchAll(PDO::FETCH_ASSOC);

    }


    return $liste_medicaments;

}

/**
 * Cette fonction permet de récupérer un medicament via son numéro d'identification.
 *
 * @param int $nummed L'id du medicament.
 *
 * @return array $medicament Le medicament.
 */
function get_medicament_by_nummed(int $nummed): array
{

    $medicament = array();

    $db = connect_db();

    // Ecriture de la requête
    $requette = 'SELECT * FROM medicament WHERE nummed = :nummed ';

    // Préparation
    $verifier_medicament = $db->prepare($requette);

    // Exécution ! La recette est maintenant en base de données
    $resultat = $verifier_medicament->execute([
        "nummed" => $nummed
    ]);

    if ($resultat) {

        $medicament = $verifier_medicament->fetchAll(PDO::FETCH_ASSOC);

    }

    return $medicament;

}






/**
 * Cett fonction permet  d'ajouter un soin à la base de données.
 *
 * @param string $libsoin Le nom du soin.
 *
 * @return bool $ajout_soin Le resultat de l'ajout du soin.
 */
function ajout_soin(string $libsoin, int $coutsoin): bool
{

    $ajout_soin = false;

    if (isset($libsoin) && !empty($libsoin) AND isset($coutsoin) && !empty($coutsoin)) {

        $db = connect_db();

        // Ecriture de la requête
        $requette = 'INSERT INTO soin (libsoin, coutsoin) VALUES (:libsoin, :coutsoin);';

        // Préparation
        $inserer_soin = $db->prepare($requette);

        // Exécution ! La recette est maintenant en base de données
        $resultat = $inserer_soin->execute([
            'libsoin' => $libsoin,
            'coutsoin' => $coutsoin
        ]);


        if ($resultat) {
            $ajout_soin = true;
        }

    }

    return $ajout_soin;

}

function check_if_soin_exist(string $libsoin, int $coutsoin): bool
{

    $check_if_soin_exist = false;

    if (isset($libsoin) && !empty($libsoin) AND isset($coutsoin) && !empty($coutsoin)) {

        $db = connect_db();

        // Ecriture de la requête
        $requette = 'SELECT count(*) as nbr_soin FROM soin WHERE libsoin = :libsoin; coutsoin = :coutsoin;';

        // Préparation
        $verifier_soin = $db->prepare($requette);

        // Exécution ! La recette est maintenant en base de données
        $resultat = $verifier_soin->execute([
            'libsoin' => $libsoin,
            'coutsoin' => $coutsoin
        ]);

        if ($resultat) {

            $check_if_soin_exist = ($verifier_soin->fetch(PDO::FETCH_ASSOC)["nbr_soin"] > 0) ? true : false;

        }

    }

    return $check_if_soin_exist;

}





/**
 * Cette fonction permet de récupérer la liste des soins de la base de donnée.
 *
 * @return array $liste_soins La liste des soins.
 */
function get_liste_soins(): array
{

    $liste_soins = array();

    $db = connect_db();

    // Ecriture de la requête
    $requette = 'SELECT * FROM soin';

    // Préparation
    $verifier_liste_soins = $db->prepare($requette);

    // Exécution ! La recette est maintenant en base de données
    $resultat = $verifier_liste_soins->execute();

    if ($resultat) {

        $liste_soins = $verifier_liste_soins->fetchAll(PDO::FETCH_ASSOC);

    }


    return $liste_soins;

}

/**
 * Cette fonction permet de récupérer un soin via son numéro d'identification.
 *
 * @param int $nummed L'id du soin.
 *
 * @return array $soin Le soin.
 */
function get_soin_by_codsoin(int $codsoin): array
{

    $soin = array();

    $db = connect_db();

    // Ecriture de la requête
    $requette = 'SELECT * FROM soin WHERE codsoin = :codsoin ';

    // Préparation
    $verifier_soin = $db->prepare($requette);

    // Exécution ! La recette est maintenant en base de données
    $resultat = $verifier_soin->execute([
        "codsoin" => $codsoin
    ]);

    if ($resultat) {

        $soin = $verifier_soin->fetchAll(PDO::FETCH_ASSOC);

    }

    return $soin;

}

/**
 * Cette fonction permet de récupérer la liste des médicaments prescrits à un patient et leur dose.
 *
 * @param string $nommed Le nom du médicament.
 * @param string $posologie La posologie.
 *
 * @return array $liste_med_posologie La liste.
 */
function get_medicament_by_nommed(string $nommed, string $posologie): array
{

    $liste_med_posologie = array();

    $db = connect_db();

    $requette = 'SELECT nommed, posologie FROM dose D, traitement T, medicament M, ordonnance O WHERE M.nummed = :D.nummed AND D.numord = :O.numord AND T.numdossier = :O.numdossier';


    $verifier_liste_med_posologie = $db->prepare($requette);


    $resultat = $verifier_liste_med_posologie->execute();

    if ($resultat) {

        $liste_med_posologie = $verifier_liste_med_posologie->fetchAll(PDO::FETCH_ASSOC);

    }


    return $liste_med_posologie;


}
