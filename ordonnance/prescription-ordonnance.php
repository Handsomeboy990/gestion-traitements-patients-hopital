


<section class="content-header">
    <div class='container-fluid'>

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            
            <div class="w-50">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Prescription d'une nouvelle ordonnance</span>
                </h1>
            </div>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="w-50 d-flex justify-content-end">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fas fa-fw fa-hospital-alt"></i><a href="?requette=dashboard">Accueil</a></li>
                <li class="breadcrumb-item"><i class="fas fa-fw fa-hospital-user"></i><a href="?requette=patient-dashboard">Ordonnances</a></li>
                <li class="breadcrumb-item"><i class="fas fa-fw fa-user-plus"></i><a href="?requette=inscription-patient">Prescrire une ordonnace</a></li>
                </ol>
            </nav>
        </div>

    </div>
</section>


<section class="content">

    <div class="container-fluid">

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

                <form action="?requette=inscription-patient-traitement" method="POST">

                    <div class="row">

                        <div class="col-sm-12">

                            <!-- Le champs date de prescription -->
                            <div class="col-sm-12 mb-3">

                                <label for="date_prescription">

                                    Date de prescrition:

                                    <span class="text-danger">*</span>

                                </label>

                                <div class="input-group mb-3">

                                    <input type="date" name="date_prescription" required id="date_prescription" class="form-control"
                                        placeholder="Entrer la date de prescription"
                                        value="<?= (isset($donnees["date_prescription"]) AND !empty($donnees["date_prescription"])) ? $donnees["date_prescription"] : ""; ?>"
                                        required>

                                    
                                    <div class="input-group-append">

                                        <div class="input-group-text">

                                            <span class="fas fa-calendar"></span>

                                        </div>

                                    </div>
                               
                               
                                </div>

                                <span class="text-danger">

                                    <?php


                                    if (isset($erreurs["date_prescription"]) AND !empty($erreurs["date_prescription"])) {
                                        echo $erreurs["date_prescription"];
                                    }

                                    ?>

                                </span>

                            </div>
                                        
                            <div class="form-label col-sm-12 mb-3">
                                <label for="matmed" class="col-form-label">Nom<span class="text-danger">*</span></label>
                                
                                <div class="input-group">
    
                                    <input type="text" required= "required" class="form-control" name="matmed" id="matmed" placeholder="Veuillez entrer votre matricule" value="<?= (isset($donnees["matmed"]) && !empty($donnees["matmed"])) ? $donnees["matmed"] : ""; ?>">
        
        
                                    <div class="input-group-append">

                                        <div class="input-group-text">

                                            <span class="fas fa-user"></span>

                                        </div>

                                    </div>
                                </div>
                            
                            
                                <span class="text-danger">

                                    <?php
                                    if (isset($erreurs["matmed"]) && !empty($erreurs["matmed"])) {
                                        echo $erreurs["matmed"];
                                    }

                                    ?>

                                </span>
                            
                            </div>


                            <div class="form-label col-sm-12 mb-3">
                                <label for="numtrait" class="col-form-label">Prénom(s)<span class="text-danger">*</span></label>
                               
                                <div class="input-group">
                                
                                    <input type="text" class="form-control" name="numtrait" id="numtrait" required= "required" placeholder="Veuillez entrer le numéro du traitement" value="<?= (isset($donnees["numtrait"]) && !empty($donnees["numtrait"])) ? $donnees["numtrait"] : ""; ?>">
                            
                                    <div class="input-group-append">

                                        <div class="input-group-text">

                                            <span class="fas fa-user"></span>

                                        </div>

                                    </div>

                                </div>
                                <span class="text-danger">

                                    <?php
                                    if (isset($erreurs["numtrait"]) && !empty($erreurs["numtrait"])) {
                                        echo $erreurs["numtrait"];
                                    }

                                    ?>

                                </span>
                            
                            </div>
                            
                            <!-- <div class="form-label">
                                <label id="name-label" class="label-inscription">Prénom</Name></label>
                                <input type="text"  id="name" placeholder ="Prénom du patient" required>
                            </div> -->

                            <!-- <div class="form-label">
                                <label for="sexe_patient" class="col-sm-2 col-form-label">Sexe</label>
                                <input type="radio" name="sexe_patient" value="M" >Masculin   
                                
                                <input type="radio" name="sexe_patient" value="F" style="margin-left: 10px;">Féminin
                            </div> -->

                            <!-- Le champs sexe -->
                            <div class="col-sm-12 mb-3">

                                <label for="inscription-sexe_patient">

                                    Sexe:

                                    <span class="text-danger">*</span>

                                </label>

                                <div class="form-group clearfix">


                                    <div class="input-group">
                                        <select name="sexe_patient" required="required" title ="Selectionner le sexe du patient" class="form-control" placeholder="Selectionner le sexe du patient">

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
                                </div>


                                <span class="text-danger">

                                    <?php

                                    if (isset($erreurs["sexe_patient"]) AND !empty($erreurs["sexe_patient"])) {
                                        echo $erreurs["sexe_patient"];
                                    }

                                    ?>

                                </span>

                            </div>

                            <div class="form-label col-sm-12 mb-3">
                                <label for="allergie" class="col-form-label">Allergie(s)<span class="text-danger">*</span></label>
                                
                                <div class="input-group">
                                    
                                <?php if ((isset($liste_medicaments) && !empty($liste_medicaments))) {

                                    ?>
                                    <select name="allergie" id="allergie"  class="form-control" required="required" title ="Selectionner l'(es) allergie(s) du patient" placeholder="Selectionner l'(es) allergie(s) du patient">

                                        <option   value="Néant">Aucun</option>
                                        <?php

                                        foreach ($liste_medicaments as $medicament) {
                                        ?>

                                        <option value="<?= (isset($donnees["nommed"]) && !empty($donnees["nommed"])) ? $donnees["nommed"] : ""; ?><?= $medicament["nommed"]; ?>"> <?= (isset($donnees["nommed"]) && !empty($donnees["nommed"])) ? $donnees["nommed"] : ""; ?><?= $medicament["nommed"]; ?> </option>
                                    
                                        <?php
                                        }

                                        ?>

                                <?php                    
                                }
                                ?> 

                                    <input style="display:none ;">                                
                                    <div class="input-group-append">

                                        <div class="input-group-text">

                                            <span class='bx bxs-injection'></span>

                                        </div>

                                    </div>

                  </div>
                                <span class="text-danger">

                                    <?php
                                    if (isset($erreurs["allergie"]) && !empty($erreurs["allergie"])) {
                                        echo $erreurs["allergie"];
                                    }

                                    ?>

                                </span>
                            
                            </div>



                        </div>
                        
                        

                    </div>

                    <div class="row mt-3 card-footer">

                        <div class="col-6">

                            <button type="reset" class="btn btn-danger btn-block">Annuler</button>

                        </div>

                        <div class="col-6">

                            <button type="submit" class="btn btn-success btn-block">Ajouter patient</button>

                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>

</section>