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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="public/img/logo.png" type="image/x-icon">


    <!-- lien bootstrap -->
    <link rel="stylesheet" href="public/plugins/bootstrap/css/bootstrap.css">

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

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <title> Connexion | Gestion de traitement des patients</title>
</head>

<body>

    <div class="container bg-transparent">

        <div class="card card-outline card-primary bg-transparent">
            
            <div class="col-md-6" style="width: 50%;margin: auto;">

                <div class="card-header text-center">

                    <a href="connexion.php">

                        <img class="w-25 img-fluid rounded-circle" src="public/img/logo.png" alt="Logo du centre de santé">

                    </a>

                </div>

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


            <div class="card-body">

                <h2 class="text-center mt-4 mb-3 titre_authentification">SE CONNECTER</h2>
                
                <form action="connexion-traitement.php" method="post"  class="bord-formulaire mt-3 border border-3" novalidate>


                    <!-- Champs email/username -->
                    <div class="col-sm-12 mb-3">
                        
                        <label for="inscription-email">

                            Email ou nom d'utilisateur:

                            <span class="text-danger">*</span>

                        </label>


                            <!-- <input type="text" name="email-nom-utilisateur" id="inscription-email" class="form-control rounded-pill"
                                   placeholder="Veuillez entrer votre address email ou votre nom d'utilisateur"
                                   value="<?= (isset($donnees["email-nom-utilisateur"]) && !empty($donnees["email-nom-utilisateur"])) ? $donnees["email-nom-utilisateur"] : ""; ?>"
                                   required> -->


                        <div class="input-group mb-3">

                            <input type="text" name="email-nom-utilisateur" id="inscription-email" class="form-control"
                                   placeholder="Veuillez entrer votre address email ou votre nom d'utilisateur"
                                   value="<?= (isset($donnees["email-nom-utilisateur"]) && !empty($donnees["email-nom-utilisateur"])) ? $donnees["email-nom-utilisateur"] : ""; ?>"
                                   required>

                            <div class="input-group-append">

                                <div class="input-group-text">

                                    <span class="fas fa-envelope"></span>

                                </div>

                            </div>

                        </div>

                        <span class="text-danger">

                            <?php

                            if (isset($erreurs["email-nom-utilisateur"]) && !empty($erreurs["email-nom-utilisateur"])) {
                                echo $erreurs["email-nom-utilisateur"];
                            }

                            ?>

                        </span>
                        
                    </div>



                    <!-- Champs mot de passe -->
                    <div class="mt-2 mb-4">

                        <label for="inscription-mot-passe">

                            Mot de passe:

                            <span class="text-danger">*</span>

                        </label>

<!--                         <input type="password" name="mot-passe" id="inscription-mot-passe" class="form-control rounded-pill"
                                   placeholder="Veuillez entrer votre mot de passe"
                                   value="<?= (isset($donnees["mot-passe"]) && !empty($donnees["mot-passe"])) ? $donnees["mot-passe"] : ""; ?>"
                                   required> -->

                        <div class="input-group mb-3">

                            <input type="password" name="mot-passe" id="inscription-mot-passe" class="form-control"
                                   placeholder="Veuillez entrer votre mot de passe"
                                   value="<?= (isset($donnees["mot-passe"]) && !empty($donnees["mot-passe"])) ? $donnees["mot-passe"] : ""; ?>"
                                   required>

                            <div class="input-group-append">

                                <div class="input-group-text">

                                    <span class="fas fa-lock"></span>

                                </div>

                            </div>

                        </div>

                        <span class="text-danger">

                            <?php

                            if (isset($erreurs["mot-passe"]) && !empty($erreurs["mot-passe"])) {
                                echo $erreurs["mot-passe"];
                            }

                            ?>

                        </span>

                    </div>

                    <!-- Champs validation et autres -->

<!--                     <div class="d-grid gap-2 mt-5 mb-3">

                        <button type="submit" class="btn btn-primary rounded-pill">Connexion</button>
                        
                    </div>

                    <div class="d-flex justify-content-center mb-4">

                       
                        <a href="mot_de_passe_oublie.html" class="lien_mdp">Mot de passe oublié?</a>
                    
                    </div> -->

                    <div class="row mt-3">

                        <div class="col-6">
    
                            <a href="inscription.php" class="text-center mt-3 text-primary">Nouveau? Créer un compte.</a>

                        </div>

                        <!-- /.col -->
                        <div class="col-6">

                            <button type="submit" class="btn btn-primary btn-block rounded-pill">Connexion</button>

                        </div>

                    </div>

                    <div class="d-flex justify-content-end mb-4">

                   
                        <a href="#" class="lien_mdp">Mot de passe oublié?</a>
                
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
