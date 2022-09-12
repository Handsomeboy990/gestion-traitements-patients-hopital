<section class="content-header">
    <div class='container-fluid'>

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            
            <div class="w-50">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Ajout d'un nouveau rendez-vous</span>
                </h1>
                
            </div>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="w-50 d-flex justify-content-end">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fas fa-fw fa-hospital-alt"></i><a href="?requette=dashboard">Accueil</a></li>
                <li class="breadcrumb-item"><i class="fas fa-fw fa-tablets"></i><a href="?requette=liste-rdv">Rendez-vous</a></li>
                <li class="breadcrumb-item"><i class="fas fa-fw fa-pills"></i><a href="?requette=ajout-rdv">Ajouter un rendez-vous</a></li>
                </ol>
            </nav>
        </div>

    </div>
</section>


<section class="content">

    <div class="container-fluid">


        <div class="col-md-11 d-flex justify-content-end text-end mb-5">
            <a href="?requette=liste-rdv" class="btn btn-success">Consulter la liste des rendez-vous</a>
        </div>
        
        <div class="card card-outline card-primary bg-transparent col-lg-8 m-auto">

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

                <form class="form-horizontal" action="?requette=ajout-rdv-traitement" method="POST">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="datrdv" class="col-sm-4 col-form-label">Date du rendez-vous: </label>
                            <div class="col-sm-8">
                                <input type="datetime-local" class="form-control" name="datrdv" id="datrdv"
                                    placeholder="Veuillez entrer la date du rendez-vous"
                                    value="<?= (isset($donnees["datrdv"]) && !empty($donnees["datrdv"])) ? $donnees["datrdv"] : ""; ?>"
                                >


                                <span class="text-danger">

                                    <?php
                                    if (isset($erreurs["datrdv"]) && !empty($erreurs["datrdv"])) {
                                        echo $erreurs["datrdv"];
                                    }

                                    ?>

                                </span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="datrdv" class="col-sm-4 col-form-label">Description du rendez-vous </label>
                            <div class="col-sm-8">
                                <select name="sexe_patient" required="required" title ="Selectionner le sexe du patient" class="form-control" placeholder="Selectionner le sexe du patient">

                                    <option value="">Consultation</option>
                                    <option value="M">Examen</option>
                                    <option value="F">Contrôle</option>
                                    <option value="F">Chirurgie</option>
                                    <option value="F">Autre</option>
                                </select>


                                <span class="text-danger">

                                    <?php
                                    if (isset($erreurs["datrdv"]) && !empty($erreurs["datrdv"])) {
                                        echo $erreurs["datrdv"];
                                    }

                                    ?>

                                </span>
                            </div>
                        </div>
                        
                    </div>

                    <div class="card-footer">
                        <button type="reset" class="btn btn-danger">Annuler</button>
                        <button type="submit" class="btn btn-primary  float-right">Enregistrer un rendez-vous</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</section>