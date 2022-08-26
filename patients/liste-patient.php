<?php
$liste_patient = get_liste_patient();
?>




<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        
        <div style="width: 20%;">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-fw fa-user-hospital"></i>
                <span>Patients</span>  
            </h1>
        </div>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="w-50 d-flex justify-content-end">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="fas fa-fw fa-hospital-alt"></i><a href="?requette=dashboard">Accueil</a></li>
            <li class="breadcrumb-item"><i class="fas fa-fw fa-hospital-user"></i><a href="?requette=patient-dashboard">Patients</a></li>
            <li class="breadcrumb-item"><i class="fas fa-fw fa-user-check"></i><a href="?requette=liste-patient">Liste des patients</a></li>
            </ol>
        </nav>
    </div>

    <div class="container mt-5">

        <div class="row">

            <div class="col-md-6">
                <h1>Liste des patients</h1>
            </div>

            <div class="col-md-6 text-end">
                <a href="?requette=inscription-patient" class="btn btn-success">Ajouter un patient</a>
            </div>

        </div>

            <hr>                        
                <div>

                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

                        <div class="row">

                            <div class="col-sm-12 col-md-6">

                                <div id="dataTable_length" class="dataTables_length">

                                    <label style="width: 100%;display: flex;align-content: space-between;">
                                        <span style="width: 10%;" class="d-flex justify-content-start m-lg-1 m-sm-1">Afficher</span>
                                        <select class="custom-select custom-select-sm form-control form-control-sm " name="dataTable_length" aria-controls="dataTable" style="width: 15%;">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                        <span style="width: 20%;" class="d-flex justify-content-start m-lg-1 m-sm-1">éléments</span>
                                    </label>

                                </div>

                            </div>

                            <div class="col-sm-12 col-md-6">

                            <div class="card-tools d-flex justify-content-end">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Recherche">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                        </div>

                            </div>

                        </div>



                        <div class="row mt-5">
                
                            <div class="col-sm-12">   
                                


                            <?php if (isset($liste_patient) && !empty($liste_patient)) {

                                ?>

                                <table class="table table-hover table-success table-striped  border-primary  dataTable" role="grid" aria-describedby="dataTable_info" style="width: 100%;" width="100%" cellspacing="0">
                                <thead>
                                <tr role="row">
                                    <th scope="col" class="col-2 text-center">N°dossier</th>
                                    <th scope="col" class="col-2 text-center">Prénoms</th>
                                    <th scope="col" class="col-2 text-center">Nom</th>
                                    <th scope="col" class="col-2 text-center">Sexe</th>
                                    <th scope="col" class="col-2 text-center">Allergies</th>
                                    <th scope="col" class="col-2 text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                foreach ($liste_patient as $patient) {
                                    ?>
                                    <tr class="odd">
                                        <td  scope="row"  class="text-center"><?= $patient["numdossier"]; ?></td>
                                        <td class="text-center sorting_1"><?= $patient["prenompatient"]; ?></td>
                                        <td class="text-center sorting_1"><?= $patient["nompatient"]; ?></td>
                                        <td class="text-center sorting_1"><?= $patient["sexepatient"]; ?></td>
                                        <td class="text-center sorting_1"><?= $patient["allergie"]; ?></td> 
                                        <td class="text-center">
                                            <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#rdvpatient-<?= $patient["numdossier"]; ?>"><i class="fas fa-fw fa-calendar-alt"></i></a>
                                            <a href="?requette=dossierpatient&numdossier=<?= $patient["numdossier"]; ?>" class="btn btn-success mb-3"><i class="fas fa-fw fa-eye"></i></a>
                                            <a href="?requette=modifierpatient&numdossier=<?= $patient["numdossier"]; ?>" class="btn btn-warning mb-3"><i class="fas fa-fw fa-edit"></i></a> 
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="rdvpatient-<?= $patient["numdossier"]; ?>"
                                         style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Ajouter RDV <?= $patient["nompatient"]; ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Confirmer RDV <?= $patient["nompatient"]; ?> ?</p>
                                                </div>
                                                <div class="modal-footer ">

                                                    <a href="?requette=supprimer-patient&num-patient=<?= $patient["numdossier"]; ?>"
                                                       class="btn btn-danger">Oui</a>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Annuler
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <?php
                                }

                                ?>

                                </tbody>
                            </table>

                            <?php
                            } else {

                                echo "Aucun patient n'a été trouvé.";

                            }
                            ?>

                            </div>     
                
                        </div>


                    <div class="card-body table-responsive p-0">

                        

                    </div>



                        <div class="row">

                            <div class="col-sm-12 col-md-5">

                                <div id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Affichage de l'élément 1 à 6 sur 6 éléments</div>

                            </div>

                            <div class="col-sm-12 col-md-7">

                                <div id="dataTable_paginate" class="dataTables_paginate paging_simple_numbers d-flex justify-content-end">

                                    <ul class="pagination">

                                        <li id="dataTable_previous" class="paginate_button page-item previous disabled">

                                            <a class="page-link" href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0"> Précedent</a>

                                        </li>

                                        <li class="paginate_button page-item active">
                                        
                                            <a class="page-link" href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0">1</a>

                                        </li>

                                        <li id="dataTable_next" class="paginate_button page-item next disabled">

                                            <a class="page-link" href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0">Suivant</a>

                                        </li>

                                    </ul>

                                </div>

                            </div>

                        </div>
                    </div>    
                </div>        
            
            </div>
    
    
        </div>          
    </div>    
        
                    </div>