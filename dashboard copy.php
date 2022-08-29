<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        
        <div class="w-50">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-fw fa-hospital-alt"></i>
                <span>Bienvenu sur MT-ProMédical</span>
            </h1>
            <p class="paragraphe-titre">votre logiciel d'assistance pour la gestion des patients</p>
        </div>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="w-50 d-flex justify-content-end">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="fas fa-fw fa-hospital-alt"></i><a href="?requette=dashboard">Accueil</a></li>
            </ol>
        </nav>
    </div>

    <div class="row">

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-3 fs-3 carte">Agenda</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <a href="?requette=liste-rdv" class="btn btn-primary">Aller
                        <span><i class="fas fa-fw fa-arrow-circle-right"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-3 fs-4 carte">Patients</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hospital-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <a href="?requette=patient-dashboard" class="btn btn-danger">Aller
                        <span><i class="fas fa-fw fa-arrow-circle-right"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-3 fs-4 carte">Ouvrir dossier</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder-open fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <a href="?requette=liste-patient" class="btn btn-success">Aller
                        <span><i class="fas fa-fw fa-arrow-circle-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>