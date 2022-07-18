<section class="content-header">
    <div class='container-fluid'>

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            
            <div class="w-50">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Ajout d'un nouveau patient</span>
                </h1>
            </div>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="w-50 d-flex justify-content-end">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fas fa-fw fa-hospital-alt"></i><a href="?requette=dashboard">Accueil</a></li>
                <li class="breadcrumb-item"><i class="fas fa-fw fa-hospital-user"></i><a href="?requette=patient-dashboard">Patients</a></li>
                <li class="breadcrumb-item"><i class="fas fa-fw fa-user-plus"></i><a href="?requette=inscription-patient">Ajouter un patient</a></li>
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
                    <div class="alert alert-danger" role="alert">
                        <?= $message["message"]; ?>
                    </div>
                    <?php

                } else if (isset($message["statut"]) && 1 == $message["statut"]) {

                    ?>
                    <div class="alert alert-success" role="alert">
                        <?= $message["message"]; ?>
                    </div>
                    <?php

                }

                ?>

                <form action="?requette=inscription-patient-traitement" method="POST">

                    <div class="row">

                        <div class="col-sm-6">

                            <div class="col-sm-12 mb-3">
                                <h2 class="d-flex justify-content-center mb-5">Informations Générales du Patient</h2>
                            </div>
                            <div class="form-label col-sm-12 mb-3">
                                <label for="nom_patient" class="col-form-label">Nom<span class="text-danger">*</span></label>
                                <input type="text" required= "required" class="form-control" name="nom_patient" id="nom_patient" placeholder="Veuillez entrer le nom du patient" value="<?= (isset($donnees["nom_patient"]) && !empty($donnees["nom_patient"])) ? $donnees["nom_patient"] : ""; ?>">
                            
                            
                                <span class="text-danger">

                                    <?php
                                    if (isset($erreurs["nom_patient"]) && !empty($erreurs["nom_patient"])) {
                                        echo $erreurs["nom_patient"];
                                    }

                                    ?>

                                </span>
                            
                            </div>


                            <div class="form-label col-sm-12 mb-3">
                                <label for="prenom_patient" class="col-form-label">Prénom(s)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="prenom_patient" id="prenom_patient" required= "required" placeholder="Veuillez entrer le prénom du patient" value="<?= (isset($donnees["prenom_patient"]) && !empty($donnees["prenom_patient"])) ? $donnees["prenom_patient"] : ""; ?>">
                            
                            
                                <span class="text-danger">

                                    <?php
                                    if (isset($erreurs["prenom_patient"]) && !empty($erreurs["prenom_patient"])) {
                                        echo $erreurs["prenom_patient"];
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

                                    <select name="sexe_patient" required="required" title ="Selectionner le sexe du patient" class="form-control" placeholder="Selectionner le sexe du patient">

                                        <option   value="">Selectionner sexe</option>
                                        <option value="M">Masculin</option>
                                        <option value="F">Féminin</option>
                                    </select>

                                </div>


                                <span class="text-danger">

                                    <?php

                                    if (isset($erreurs["sexe_patient"]) AND !empty($erreurs["sexe_patient"])) {
                                        echo $erreurs["sexe_patient"];
                                    }

                                    ?>

                                </span>

                            </div>

                            <!-- Le champs date de naissance -->
                            <div class="col-sm-12 mb-3">

                                <label for="inscription-date_naissance_patient">

                                    Date de naissance:

                                    <span class="text-danger">*</span>

                                </label>

                                <div class="input-group mb-3">

                                    <input type="date" name="date_naissance_patient" required id="inscription-date_naissance_patient" class="form-control"
                                        placeholder="Entrer la date de naissance"
                                        value="<?= (isset($donnees["date_naissance_patient"]) AND !empty($donnees["date_naissance_patient"])) ? $donnees["date_naissance_patient"] : ""; ?>"
                                        required>

                                </div>

                                <span class="text-danger">

                                    <?php


                                    if (isset($erreurs["date_naissance_patient"]) AND !empty($erreurs["date_naissance_patient"])) {
                                        echo $erreurs["date_naissance_patient"];
                                    }

                                    ?>

                                </span>

                            </div>

                            <div class="col-sm-12 mb-3 label-form">
                                <b for="inscription-tel">Téléphone</b>
                                <input type="text" class='form-control' pattern="\d{9,9}"  maxlength="9" name="tel" value="<?= (isset($donnees["tel"]) AND !empty($donnees["tel"])) ? $donnees["tel"] : ""; ?>" >

                            </div>

                            <div class="form-label col-sm-12 mb-3">
                                <label for="inscription-age">Age<span class="text-danger"></span></label>
                                <input type="number" class='form-control'  id="number"  type="number" min="0" max="120" value="<?= (isset($donnees["age"]) AND !empty($donnees["age"])) ? $donnees["age"] : ""; ?>">


                            </div>

                            <div class="form-label col-sm-12 mb-3">    
                                <b class="label-inscription">Adresse:</b>
                                <textarea class='form-control' value="<?= (isset($donnees["adresse"]) AND !empty($donnees["adresse"])) ? $donnees["adresse"] : ""; ?>"></textarea>
                            </div>

                        </div>
                        <div class="col-sm-6">

                            <div class="col-sm-12 mb-3">
                                <h2 class="d-flex justify-content-center">Historique Médical du Patient</h2><br>
                            </div>

                            <div class="form-label col-sm-12 mb-3">
                                <label for="allergie" class="col-form-label">Allergie(s)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="allergie" id="allergie" required= "required"  value="<?= (isset($donnees["allergie"]) && !empty($donnees["allergie"])) ? $donnees["allergie"] : ""; ?>">
                            
                            
                                <span class="text-danger">

                                    <?php
                                    if (isset($erreurs["allergie"]) && !empty($erreurs["allergie"])) {
                                        echo $erreurs["allergie"];
                                    }

                                    ?>

                                </span>
                            
                            </div>



                            
                            <div class='col-sm-12 mb-3'>

                                <b>Antécédents médicaux:<span class="text-danger">*</span></b><br>
    
                                <select name="antecedent" required="required" title ="Antécédents Médicaux" class="form-control" placeholder="Antécédents Médicaux du patient">
                                    <option value="">Sélectionnez les antécédents médicaux du patient</option>
                                    <option  value="Anémie" >Anémie
                                    <br></option>
                                    <option value="Asthme" >Asthme
                                    <br></option>
                                    <option value="Arthrose" >Arthrose
                                    <br></option>
                                    <option value="Cancer" >Cancer
                                    <br></option>
                                    <option value="Goutte" >Goutte
                                    <br></option>
                                    <option value="Diabète" >Diabete
                                    <br></option>
                                    <option value="Troubles émotionnelles" >Troubles émotionnelles
                                    <br></option>
                                    <option  value="Epilepsie" >Epilepsie
                                    <br>
                                    <option value="Calculs biliaires" >Calculs biliaires</option><br>
                                    <option value="Antécédent cardiaque" >Antécédent cardiaque
                                    <br></option><br>
                            
                                </select>
                                </textarea><br><br>
                            
                                <span class="text-danger">

                                    <?php


                                    if (isset($erreurs["antecedent"]) AND !empty($erreurs["antecedent"])) {
                                        echo $erreurs["antecedent"];
                                    }

                                    ?>

                                </span>
                            
                            
                            </div>

                            <div class='col-sm-12 mb-3'>

                                <b>Liste des médicaments en cours de traitement</b><br>
                                <textarea rows="5" cols="50" class='form-control' value="<?= (isset($donnees["liste_med"]) AND !empty($donnees["liste_med"])) ? $donnees["liste_med"] : ""; ?>">
                                </textarea><br><br>

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