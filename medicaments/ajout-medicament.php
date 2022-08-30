<section class="content-header">
    <div class='container-fluid'>

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            
            <div class="w-50">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Ajout d'un nouveau médicament</span>
                </h1>
                
            </div>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="w-50 d-flex justify-content-end">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fas fa-fw fa-hospital-alt"></i><a href="?requette=dashboard">Accueil</a></li>
                <li class="breadcrumb-item"><i class="fas fa-fw fa-tablets"></i><a href="?requette=liste-medicament">Médicaments</a></li>
                <li class="breadcrumb-item"><i class="fas fa-fw fa-pills"></i><a href="?requette=ajout-medicament">Ajouter un medicament</a></li>
                </ol>
            </nav>
        </div>

    </div>
</section>


<section class="content">

    <div class="container-fluid">


        <div class="col-md-11 d-flex justify-content-end text-end">
            <a href="?requette=liste-medicament" class="btn btn-success">Consulter la liste des medicaments</a>
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

                <form class="form-horizontal" action="?requette=ajout-medicament-traitement" method="POST">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nommed" class="col-sm-2 col-form-label">Nom du médicament: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nommed" id="nommed"
                                    placeholder="Veuillez entrer le nom de la medicament"
                                    value="<?= (isset($donnees["nommed"]) && !empty($donnees["nommed"])) ? $donnees["nommed"] : ""; ?>"
                                >


                                <span class="text-danger">

                                    <?php
                                    if (isset($erreurs["nommed"]) && !empty($erreurs["nommed"])) {
                                        echo $erreurs["nommed"];
                                    }

                                    ?>

                                </span>
                            </div>
                        </div>
                        
                    </div>

                    <div class="card-footer">
                        <button type="reset" class="btn btn-danger">Annuler</button>
                        <button type="submit" class="btn btn-primary  float-right">Enregistrer un médicament</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</section>