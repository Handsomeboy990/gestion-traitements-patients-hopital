<?php
$liste_patient = get_liste_patient();
?>


<section class="content-header">
    <div class='container-fluid'>

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            
            <div class="w-50">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Ajout d'un nouveau traitement</span>
                </h1>
                
            </div>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="w-50 d-flex justify-content-end">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fas fa-fw fa-hospital-alt"></i><a href="?requette=dashboard">Accueil</a></li>
                <li class="breadcrumb-item"><i class="fas fa-fw fa-tablets"></i><a href="?requette=liste-traitement">Traitements</a></li>
                <li class="breadcrumb-item"><i class="fas fa-fw fa-pills"></i><a href="?requette=ajout-traitement">Ajouter un traitement</a></li>
                </ol>
            </nav>
        </div>

    </div>
</section>


<section class="content">

    <div class="container-fluid">


        <div class="col-md-11 d-flex justify-content-end text-end">
            <a href="?requette=liste-traitement" class="btn btn-success">Consulter la liste des traitements</a>
        </div>
        
        <div class="card card-outline card-primary bg-transparent mt-5">

            <div class="card-body">

                <?php

                if (isset($message["statut"]) && 0 == $message["statut"]) {

                    ?>
                    <div class="alert alert-warning" role="alert">
                        <?= $message["message"]; ?>
                    </div>
                    <?php

                } else if (isset($message["statut"]) && 1 == $message["statut"]) {

                    ?>
                    <div class="alert alert-success" role="alert">
                        <?= $message["message"];?>
                    </div>
                    <?php

                }

                ?>

                <form class="form-horizontal" action="?requette=ajout-traitement-traitement" method="POST">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nomtrait" class="col-sm-2 col-form-label">Nom du traitement: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nomtrait" id="nomtrait"
                                    placeholder="Veuillez entrer le nom du traitement"
                                    value="<?= (isset($donnees["nomtrait"]) && !empty($donnees["nomtrait"])) ? $donnees["nomtrait"] : ""; ?>"
                                >


                                <span class="text-danger">

                                    <?php
                                    if (isset($erreurs["nomtrait"]) && !empty($erreurs["nomtrait"])) {
                                        echo $erreurs["nomtrait"];
                                    }

                                    ?>

                                </span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="nompatient" class="col-sm-2 col-form-label">Nom du patient: </label>

                            <div class="col-sm-10">
                                <?php if ((isset($liste_patients) && !empty($liste_patients))) {

                                    ?>
                                    <select name="nompatient" id="nompatient"  class="form-control" required="required" title ="Selectionner le nom du patient" placeholder="Selectionner le nom du patient">

                                        <option   value="Néant">Aucun</option>
                                        <?php

                                        foreach ($liste_patients as $patient) {
                                        ?>

                                        <option value="<?= (isset($donnees["nompatient"]) && !empty($donnees["nompatient"])) ? $donnees["nompatient"] : ""; ?><?= $patient["nompatient"]; ?>"> <?= (isset($donnees["nompatient"]) && !empty($donnees["nompatient"])) ? $donnees["nompatient"] : ""; ?><?= $patient["nompatient"]; ?> </option>
                                    
                                        <?php
                                        }

                                        ?>

                                <?php                    
                                }
                                ?> 


                                <span class="text-danger">

                                    <?php
                                    if (isset($erreurs["nompatient"]) && !empty($erreurs["nompatient"])) {
                                        echo $erreurs["nompatient"];
                                    }

                                    ?>

                                </span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="prenom_patient" class="col-sm-2 col-form-label">Prénom(s) du patient: </label>
                            <div class="col-sm-10">
                                <?php if ((isset($liste_patients) && !empty($liste_patients))) {

                                    ?>
                                    
                                    <?php

                                        foreach ($liste_patients as $patient) {
                                    ?>
                                        <input type="text" class="form-control" name="prenom_patient" id="prenom_patient" required= "required" placeholder="Veuillez entrer le prénom du patient" value="<?= (isset($donnees["prenom_patient"]) && !empty($donnees["prenom_patient"])) ? $donnees["prenom_patient"] : ""; ?>">

    
                                    <?php
                                    }

                                    ?>

                                        <option value="<?= (isset($donnees["prenom_patient"]) && !empty($donnees["prenom_patient"])) ? $donnees["prenom_patient"] : ""; ?><?= $patient["prenom_patient"]; ?>"> <?= (isset($donnees["prenom_patient"]) && !empty($donnees["prenom_patient"])) ? $donnees["prenom_patient"] : ""; ?><?= $patient["prenom_patient"]; ?> </option>
                                    


                                <?php                    
                                }
                                ?> 



                            
                                <span class="text-danger">

                                    <?php
                                    if (isset($erreurs["prenom_patient"]) && !empty($erreurs["prenom_patient"])) {
                                        echo $erreurs["prenom_patient"];
                                    }

                                    ?>

                                </span>
                            </div>
                        </div>
                        
                    </div>

                    <div class="card-footer">
                        <button type="reset" class="btn btn-danger">Annuler</button>
                        <button type="submit" class="btn btn-primary  float-right">Enregistrer un traitement</button>
                    </div>

                </form>
        
            </div>
        </div>
    </div>

</section>