<?php

include 'function.php';

$user_connected = check_if_user_conneted();

if($user_connected){
    header("location: dashboard.php");
}

?>



<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="public/img/logo.png" type="image/x-icon">

        <title>Inscription | Gestion de traitement des patients</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    
        <!-- Favicons -->
        <link href="public/img/logo.png" rel="icon">
    
        <!-- Font Awesome -->
        <link rel="stylesheet" href="public/plugins/fontawesome/css/all.min.css">
        
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="public/plugins/bootstrap/css/bootstrap.min.css">
        
        <!-- Theme style -->
        <link rel="stylesheet" href="public/css/adminlte.min.css">
        
        <!-- lien fichier css -->
        <link rel="stylesheet" href="public/css/style.css">

        <!-- lien bootstrap -->
        <link rel="stylesheet" href="public/plugins/bootstrap/css/bootstrap.css">
        
    </head>

    <body>

        <div class="container bg-transparent">

            <div class="card card-outline card-primary bg-transparent col-10 m-auto">

                <div class="col-md-6 w-50 m-auto"> 

                        <a href="inscription.php" class="d-flex justify-content-center">
                            <img class="w-25 img-fluid rounded-circle" src="public/img/logo.png" alt="Logo du centre de santé">
                        </a>         

                </div>

                <?php

                $erreurs = array();

                $donnees = array();

                $message = array();

                if (isset($_GET["erreurs"]) && !empty($_GET["erreurs"])) {
                    $erreurs = json_decode($_GET["erreurs"], true);
                }

                if (isset($_GET["donnees"]) && !empty($_GET["donnees"])) {
                    $donnees = json_decode($_GET["donnees"], true);
                }

                if (isset($_GET["message"]) && !empty($_GET["message"])) {
                    $message = json_decode($_GET["message"], true);
                }

                ?>


                <div class="card-body">


                <?php

                    if(isset($message["statut"]) && 0 == $message["statut"]){

                        ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $message["message"]; ?>
                            </div>
                        <?php

                    }else if(isset($message["statut"]) && 1 == $message["statut"]){

                        ?>
                            <div class="alert alert-success" role="alert">
                                <?= $message["message"]; ?>
                            </div>
                        <?php
                        
                    }

                ?>

                    <h2 class="text-center titre_authentification">S' ENREGISTRER</h2>

                    <form action="inscription-traitement.php" method="post" novalidate class="bord-formulaire mt-3 border border-3">

                        <div class="row">

                            <div class="col-sm-6">

                                <!-- Le champs nom -->
                                <div class="col-sm-12 mb-2">

                                    <label for="inscription-nom">

                                        Nom:

                                        <span class="text-danger">*</span>

                                    </label>

                                    <div class="input-group">

                                        <input type="text" name="nom" id="inscription-nom" class="form-control"
                                            placeholder="Veuillez entrer votre nom"
                                            value="<?= (isset($donnees["nom"]) AND !empty($donnees["nom"])) ? $donnees["nom"] : ""; ?>"
                                            required>

                                        <div class="input-group-append">

                                            <div class="input-group-text">

                                                <span class="fas fa-user"></span>

                                            </div>

                                        </div>

                                    </div>

                                    <span class="text-danger">

                                        <?php

                                        if (isset($erreurs["nom"]) AND !empty($erreurs["nom"])) {
                                            echo $erreurs["nom"];
                                        }

                                        ?>

                                    </span>

                                </div>

                                <!-- Le champs prenom -->
                                <div class="col-sm-12 mb-2">

                                    <label for="inscription-prenom">

                                        Prénoms:

                                        <span class="text-danger">*</span>

                                    </label>

                                    <div class="input-group">

                                        <input type="text" name="prenom" id="inscription-prenom" class="form-control"
                                            placeholder="Veuillez entrer votre prénom"
                                            value="<?= (isset($donnees["prenom"]) AND !empty($donnees["nom"])) ? $donnees["prenom"] : ""; ?>"
                                            required>

                                        <div class="input-group-append">

                                            <div class="input-group-text">

                                                <span class="fas fa-user"></span>

                                            </div>

                                        </div>

                                    </div>

                                    <span class="text-danger">

                                        <?php

                                        if (isset($erreurs["prenom"]) AND !empty($erreurs["prenom"])) {
                                            echo $erreurs["prenom"];
                                        }

                                        ?>

                                    </span>

                                </div>

                                <!-- Le champs sexe -->
                                <div class="col-sm-12 mb-2">

                                    <label for="inscription-sexe">

                                        Sexe:

                                        <span class="text-danger">*</span>

                                    </label>

                                    <div class="form-group input-group clearfix">

                                        <select name="sexe" required="required" title ="Selectionner votre sexe" class="form-control" placeholder="Selectionner votre sexe">

                                            <option   value="">Selectionner sexe</option>
                                            <option value="M">Masculin</option>
                                            <option value="F">Féminin</option>
                                        </select>

                                        <div class="input-group-append">

                                            <div class="input-group-text">

                                                <span class="fas fa-venus-mars"></span>

                                            </div>

                                        </div>

                                    </div>

                                    <span class="text-danger">

                                        <?php

                                        if (isset($erreurs["sexe"]) AND !empty($erreurs["sexe"])) {
                                            echo $erreurs["sexe"];
                                        }

                                        ?>

                                    </span>

                                </div>

                                <!-- Le champs date de naissance -->
                                <div class="col-sm-12 mb-2">

                                    <label for="inscription-date-naissance">

                                        Date de naissance:

                                        <span class="text-danger">*</span>

                                    </label>

                                    <div class="input-group mb-2">

                                        <input type="date" name="date-naissance" id="inscription-date-naissance" class="form-control"
                                            placeholder="Veuillez entrer votre date de naissance"
                                            value="<?= (isset($donnees["date-naissance"]) AND !empty($donnees["date-naissance"])) ? $donnees["date-naissance"] : ""; ?>"
                                            required>

                                        <div class="input-group-append">

                                            <div class="input-group-text">

                                                <span class="fas fa-baby"></span>

                                            </div>

                                        </div>

                                    </div>

                                    <span class="text-danger">

                                        <?php


                                        if (isset($erreurs["date-naissance"]) AND !empty($erreurs["date-naissance"])) {
                                            echo $erreurs["date-naissance"];
                                        }

                                        ?>

                                    </span>

                                </div>

                            </div>    

                            <div class="col-sm-6">
                            
                                <!-- Le champs email -->
                                <div class="col-sm-12 mb-2">

                                    <label for="inscription-email">

                                        Email:

                                        <span class="text-danger">*</span>

                                    </label>

                                    <div class="input-group mb-3">

                                        <input type="email" name="email" id="inscription-email" class="form-control"
                                            placeholder="Veuillez entrer votre adresse email"
                                            value="<?= (isset($donnees["email"]) AND !empty($donnees["email"])) ? $donnees["email"] : ""; ?>"
                                            required>

                                        <div class="input-group-append">

                                            <div class="input-group-text">

                                                <span class="fas fa-envelope"></span>

                                            </div>

                                        </div>

                                    </div>

                                    <span class="text-danger">

                                        <?php

                                        if (isset($erreurs["email"]) AND !empty($erreurs["email"])) {
                                            echo $erreurs["email"];
                                        }

                                        ?>

                                    </span>

                                </div>

                                <!-- Le champs nom d'utilisateur -->
                                <div class="col-sm-12 mb-2">

                                    <label for="inscription-nom-utilisateur">

                                        Nom d'utilisateur:

                                        <span class="text-danger">*</span>

                                    </label>

                                    <div class="input-group mb-2">

                                        <input type="text" name="nom-utilisateur" id="inscription-nom-utilisateur" class="form-control"
                                            placeholder="Veuillez entrer votre nom d'utilisateur"
                                            value="<?= (isset($donnees["nom-utilisateur"]) AND !empty($donnees["nom-utilisateur"])) ? $donnees["nom-utilisateur"] : ""; ?>"
                                            required>

                                        <div class="input-group-append">

                                            <div class="input-group-text">

                                                <span class="fas fa-user"></span>

                                            </div>

                                        </div>

                                    </div>

                                    <span class="text-danger">

                                        <?php

                                        if (isset($erreurs["nom-utilisateur"]) AND !empty($erreurs["nom-utilisateur"])) {
                                            echo $erreurs["nom-utilisateur"];
                                        }

                                        ?>

                                    </span>

                                </div>

                                <!-- Le champs mot de passe -->
                                <div class="col-sm-12 mb-2">

                                    <label for="inscription-mot-passe">

                                        Mot de passe:

                                        <span class="text-danger">*</span>

                                    </label>

                                    <div class="input-group mb-2">

                                        <input type="password" name="mot-passe" id="inscription-mot-passe" class="form-control"
                                            placeholder="Veuillez entrer votre mot de passe"
                                            value="<?= (isset($donnees["mot-passe"]) AND !empty($donnees["mot-passe"])) ? $donnees["mot-passe"] : ""; ?>"
                                            required>

                                        <div class="input-group-append">

                                            <div class="input-group-text">

                                                <span class="fas fa-lock"></span>

                                            </div>

                                        </div>

                                    </div>

                                    <span class="text-danger">

                                        <?php

                                        if (isset($erreurs["mot-passe"]) AND !empty($erreurs["mot-passe"])) {
                                            echo $erreurs["mot-passe"];
                                        }

                                        ?>

                                    </span>

                                </div>

                                <!-- Le champs retaper mot de passe -->
                                <div class="col-sm-12 mb-2">

                                    <label for="inscription-retaper-mot-passe">

                                        Retaper mot de passe:

                                        <span class="text-danger">*</span>

                                    </label>

                                    <div class="input-group mb-2">

                                        <input type="password" name="retaper-mot-passe" id="inscription-retaper-mot-passe"
                                            class="form-control" placeholder="Veuillez retaper votre mot de passe"
                                            value="<?= (isset($donnees["retaper-mot-passe"]) AND !empty($donnees["retaper-mot-passe"])) ? $donnees["retaper-mot-passe"] : ""; ?>"
                                            required>

                                        <div class="input-group-append">

                                            <div class="input-group-text">

                                                <span class="fas fa-lock"></span>

                                            </div>

                                        </div>

                                    </div>

                                    <span class="text-danger">

                                        <?php

                                        if (isset($erreurs["retaper-mot-passe"]) AND !empty($erreurs["retaper-mot-passe"])) {
                                            echo $erreurs["retaper-mot-passe"];
                                        }

                                        ?>

                                    </span>

                                </div>

                            </div>

                        </div>

                        <div class="row m-2">

                            <div class="col-6">
    
                                <a href="connexion.php" class="text-center mt-3 text-primary">J'ai deja un compte</a>

                            </div>

                            <!-- /.col -->
                            <div class="col-6">

                                <button type="submit" class="btn btn-primary btn-block">Inscription</button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>
        </div>

        <!-- footer-->

        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto" style="font-size: small; color: rgba(0, 0, 0, 0.932);">
                    <span>Copyright &copy; 2022 Medical Team, tous droits réservés.</span>
                </div>
            </div>
        </footer>     

        <!-- jQuery -->
        <script src="public/plugins/jquery/jquery.min.js"></script>

        <!-- Bootstrap 4 -->
        <script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- AdminLTE App -->
        <script src="public/js/adminlte.min.js"></script>

    </body>
</html>
