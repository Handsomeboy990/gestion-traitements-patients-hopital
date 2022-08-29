<section class="content-header">
    <div class='container-fluid'>

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            
            <div class="w-50">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Ajout d'un nouveau médecin</span>
                </h1>
                
            </div>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="w-50 d-flex justify-content-end">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fas fa-fw fa-hospital-alt"></i><a href="?requette=dashboard">Accueil</a></li>
                <li class="breadcrumb-item"><i class="fas fa-fw fa-hospital-user"></i><a href="?requette=liste-medecin">Médecins</a></li>
                <li class="breadcrumb-item"><i class="fas fa-fw fa-user-plus"></i><a href="?requette=ajout-medecin">Ajouter un médecin</a></li>
                </ol>
            </nav>
        </div>

    </div>
</section>


<section class="content">

    <div class="container-fluid">


        <div class="col-md-11 d-flex justify-content-end text-end">
            <a href="?requette=liste-medecin" class="btn btn-success">Consulter la liste des médecins</a>
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

                <form class="form-horizontal" action="?requette=ajout-medecin-traitement" method="POST">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nom-medecin" class="col-sm-2 col-form-label">Nom du médecin: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nom-medecin" id="nom-medecin"
                                    placeholder="Veuillez entrer le nom du médecin"
                                    value="<?= (isset($donnees["nom-medecin"]) && !empty($donnees["nom-medecin"])) ? $donnees["nom-medecin"] : ""; ?>"
                                >


                                <span class="text-danger">

                                    <?php
                                    if (isset($erreurs["nom-medecin"]) && !empty($erreurs["nom-medecin"])) {
                                        echo $erreurs["nom-medecin"];
                                    }

                                    ?>

                                </span>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                        
                            <label for="specialite" class="col-sm-2 col-form-label">

                                Spécialité:

                            </label>

                            <div class="col-sm-10">
                                <select name="specialite" required="required" title ="Selectionner la spécialité du médecin" class="form-control" placeholder="Selectionner la spécialité du médecin">

                                    <option   value="Généraliste">Tout</option>
                                    <option value="BIOLOGISTE-LABORATOIRE">BIOLOGISTE-LABORATOIRE</option>
                                    <option value="DENTISTE-CHIR DENT + ORTHODONTIE">DENTISTE-CHIR DENT + ORTHODONTIE</option>
                                    <option value="DENTISTE - CHIRURGIE DENTAIRE">DENTISTE - CHIRURGIE DENTAIRE</option>
                                    <option value="DENTISTE - ORTHODONTIE">DENTISTE - ORTHODONTIE</option>
                                    <option value="INFIRMIER(E)">INFIRMIER(E)</option>
                                    <option value="KINESITHERAPEUTE - MASSEUR-KINE-DIPL-ETAT">KINESITHERAPEUTE - MASSEUR-KINE-DIPL-ETAT</option>
                                    <option value="ANATOMIE-CYTOLOGIE-PATHOLOGIE">ANATOMIE-CYTOLOGIE-PATHOLOGIE</option>
                                    <option value="ANESTHESIE-REANIMATION">ANESTHESIE-REANIMATION</option>
                                    <option value="ANGIOLOGIE">ANGIOLOGIE</option>
                                    <option value="CARDIOLOGIE">CARDIOLOGIE</option>
                                    <option value="CHIRURGIE GENERALE">CHIRURGIE GENERALE</option>
                                    <option value="CHIRURGIE ORTHOPEDIQUE">CHIRURGIE ORTHOPEDIQUE</option>
                                    <option value="CHIRURGIE VISCERALE">CHIRURGIE VISCERALE</option>
                                    <option value="CHIRURGIE PLASTIQUE">CHIRURGIE PLASTIQUE</option>
                                    <option value="DERMATOLOGIE">DERMATOLOGIE</option>
                                    <option value="ENDOCRINOLOGIE">ENDOCRINOLOGIE</option>
                                    <option value="GASTRO-ENTEROLOGIE">GASTRO-ENTEROLOGIE</option>
                                    <option value="GYNECOLOGIE MEDICALE">GYNECOLOGIE MEDICALE</option>
                                    <option value="GYNECOLOGIE - OBSTETRIQUE">GYNECOLOGIE - OBSTETRIQUE</option>
                                    <option value="GENERALISTE">GENERALISTE</option>
                                    <option value="INTERNE">INTERNE</option>
                                    <option value="NEPHROLOGIE">NEPHROLOGIE</option>
                                    <option value="NEUROLOGIE">NEUROLOGIE</option>
                                    <option value="O.R.L.">O.R.L.</option>
                                    <option value="ONCOLOGIE">ONCOLOGIE</option>
                                    <option value="OPHTALMOLOGIE">OPHTALMOLOGIE</option>
                                    <option value="PEDIATRIE">PEDIATRIE</option>
                                    <option value="PNEUMOLOGIE">PNEUMOLOGIE</option>
                                    <option value="PSYCHIATRIE">PSYCHIATRIE</option>
                                    <option value="RADIOLOGIE">RADIOLOGIE</option>
                                    <option value="REEDUC / READAPT / FONCT">REEDUC / READAPT / FONCT</option>
                                    <option value="RHUMATOLOGIE">RHUMATOLOGIE</option>
                                    <option value="STOMATOLOGIE">STOMATOLOGIE</option>
                                    <option value="UROLOGIE">UROLOGIE</option>
                                    <option value="ORTHOPHONISTE">ORTHOPHONISTE</option>
                                    <option value="PODOLOGUE">PODOLOGUE</option>
                                    <option value="PODOLOGUE - PEDICURE">PODOLOGUE - PEDICURE</option>
                                    <option value="PHARMACOLOGIE">PHARMACOLOGIE</option>
                                </select>


                                <span class="text-danger">

                                    <?php

                                    if (isset($erreurs["specialite"]) AND !empty($erreurs["specialite"])) {
                                        echo $erreurs["specialite"];
                                    }

                                    ?>

                                </span>

                            </div>

                        </div>
                        

                        
                    </div>

                    <div class="card-footer">
                        <button type="reset" class="btn btn-danger">Annuler</button>
                        <button type="submit" class="btn btn-primary  float-right">Enregistrer un médecin</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</section>