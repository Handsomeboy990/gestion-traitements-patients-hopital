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

                                <div id="dataTable_filter" class="dataTables_filter">

                                    <label style="width: 100%; display: flex;align-content: space-between; justify-content: end;">
                                        <span style="width: 20%;">Rechercher:</span>
                                        <input class="form-control form-control-sm w-50" type="search" placeholder="Nom patient" aria-controls="dataTable">
                                    </label>

                                </div>

                            </div>

                        </div>



                        <div class="row mt-5">
                
                            <div class="col-sm-12">   
                                
                                <table class="table table-hover table-success table-striped  border-primary  dataTable" role="grid" aria-describedby="dataTable_info" style="width: 100%;" width="100%" cellspacing="0">
                                    <thead>
                                        <tr role="row">
                                            <th scope="col" class="col-2 text-center">N°dossier</th>
                                            <th scope="col" class="col-2 text-center">Nom</th>
                                            <th scope="col" class="col-2 text-center">Prénom</th>
                                            <th scope="col" class="col-2 text-center">Age</th>
                                            <th scope="col" class="col-2 text-center">Sexe</th>
                                            <th scope="col" class="col-2 text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd">
                                            <th scope="row"  class="text-center">143/22</th>
                                            <td class="text-center sorting_1">Eskutt</td>
                                            <td class="text-center sorting_1">Larry</td>
                                            <td class="text-center sorting_1">44</td>
                                            <td class="text-center sorting_1">M</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#mt-rdv-patient"><i class="fas fa-fw fa-calendar-alt"></i></a>
                                                <a href="dossier.html" class="btn btn-success mb-3"><i class="fas fa-fw fa-eye"></i></a>
                                                <a href="dossier.html" class="btn btn-primary mb-3"><i class="fas fa-fw fa-edit"></i></a>                                                                
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <th scope="row"  class="text-center">144/22</th>
                                            <td class="text-center sorting_1">Mike</td>
                                            <td class="text-center sorting_1">Mikey</td>
                                            <td class="text-center sorting_1">92</td>
                                            <td class="text-center sorting_1">M</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#mt-rdv-patient"><i class="fas fa-fw fa-calendar-alt"></i></a>
                                                <a href="dossier.html" class="btn btn-success mb-3"><i class="fas fa-fw fa-eye"></i></a>
                                                <a href="dossier.html" class="btn btn-primary mb-3"><i class="fas fa-fw fa-edit"></i></a>                                                                
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <th scope="row"  class="text-center">145/22</th>
                                            <td class="text-center sorting_1">Djangoni</td>
                                            <td class="text-center sorting_1">Madélai</td>
                                            <td class="text-center sorting_1">2</td>
                                            <td class="text-center sorting_1">F</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#mt-rdv-patient"><i class="fas fa-fw fa-calendar-alt"></i></a>
                                                <a href="dossier.html" class="btn btn-success mb-3"><i class="fas fa-fw fa-eye"></i></a>
                                                <a href="dossier.html" class="btn btn-primary mb-3"><i class="fas fa-fw fa-edit"></i></a>                                                                
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <th scope="row"  class="text-center">146/22</th>
                                            <td class="text-center sorting_1">Jolie</td>
                                            <td class="text-center sorting_1">Joliette</td>
                                            <td class="text-center sorting_1">38</td>
                                            <td class="text-center sorting_1">F</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#mt-rdv-patient"><i class="fas fa-fw fa-calendar-alt"></i></a>
                                                <a href="dossier.html" class="btn btn-success mb-3"><i class="fas fa-fw fa-eye"></i></a>
                                                <a href="dossier.html" class="btn btn-primary mb-3"><i class="fas fa-fw fa-edit"></i></a>                                                                
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <th scope="row"  class="text-center">147/22</th>
                                            <td class="text-center sorting_1">Magengo</td>
                                            <td class="text-center sorting_1">Guttembert</td>
                                            <td class="text-center sorting_1">11</td>
                                            <td class="text-center sorting_1">M</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#mt-rdv-patient"><i class="fas fa-fw fa-calendar-alt"></i></a>
                                                <a href="dossier.html" class="btn btn-success mb-3"><i class="fas fa-fw fa-eye"></i></a>
                                                <a href="dossier.html" class="btn btn-primary mb-3"><i class="fas fa-fw fa-edit"></i></a>                                                                
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <th scope="row"  class="text-center">148/22</th>
                                            <td class="text-center sorting_1">Boy</td>
                                            <td class="text-center sorting_1">Handsome</td>
                                            <td class="text-center sorting_1">24</td>
                                            <td class="text-center sorting_1">M</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#mt-rdv-patient"><i class="fas fa-fw fa-calendar-alt"></i></a>
                                                <a href="dossier.html" class="btn btn-success mb-3"><i class="fas fa-fw fa-eye"></i></a>
                                                <a href="dossier.html" class="btn btn-primary mb-3"><i class="fas fa-fw fa-edit"></i></a>                                                                
                                            </td>
                                        </tr>                                                                                                                                        
                                    </tbody>
                                </table>

                            </div>     
                
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