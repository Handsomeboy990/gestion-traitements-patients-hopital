<?php

include 'function.php';

$user_connected = check_if_user_conneted();

if (!$user_connected) {
    header("location: connexion.php");
}

?>

<!DOCTYPE html>
<html lang="fr">
	<head>
	    <meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <link rel="shortcut icon" href="public/img/logo.png" type="image/x-icon">
	    <title> Tableau de bord | Gestion de traitement des patients</title>

	    <!-- lien bootstrap -->
	    <link rel="stylesheet" href="public/plugins/bootstrap/css/bootstrap.css">

	    <!-- Favicons -->
	    <link href="public/img/logo.png" rel="icon">
	    
	    <!-- Font Awesome -->
	    <link rel="stylesheet" href="public/plugins/fontawesome/css/all.min.css">
	    
	    <!-- icheck bootstrap -->
	    <link rel="stylesheet" href="public/plugins/bootstrap/css/bootstrap.min.css">
	    
		<!-- lien boxicons -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

	    <!-- Theme style -->
	    <link rel="stylesheet" href="public/css/adminlte.min.css">
	    
	    <!-- lien fichier css -->
	    <link rel="stylesheet" href="public/css/style.css">

	    <!-- Google Font: Source Sans Pro -->
	    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">



	</head>


	<body>

		<div class="wrapper">

			<nav class="main-header navbar navbar-expand">

				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
					</li>
				</ul>

				<ul class="navbar-nav ml-auto">

					<li class="nav-item">
						<div class="navbar-search-block">
							<form class="form-inline">
								<div class="input-group input-group-sm">
									<input class="form-control form-control-navbar" type="search" placeholder="Search"
										aria-label="Search">
									<div class="input-group-append">
										<button class="btn btn-navbar" type="submit">
											<i class="fas fa-search"></i>
										</button>
										<button class="btn btn-navbar" type="button" data-widget="navbar-search">
											<i class="fas fa-times"></i>
										</button>
									</div>
								</div>
							</form>
						</div>
					</li>


					<li class="nav-item">
                		<a class="nav-link" href="deconnexion.php">
							<i class='bx bx-log-out nav_icon'></i>
						</a>
            		</li>

				</ul>
			</nav>


 			<aside class="main-sidebar sidebar-color" id="nav-bar">

				<div class="sidebar-logo">
					<a class="sidebar-brand d-flex align-items-center justify-content-center conteneur-img-dash nav_link" href="?requette=dashboard">
						<div class="sidebar-brand-icon">
							<img class="image-dashboard img-fluid" src="public/img/logo.png" alt="Logo du centre de santé">
						</div>
					</a>
				</div>

				<div class="sidebar">

					<hr class="sidebar-divider">

					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
							data-accordion="false">

							<li class="nav-item">
								<a href="?requette=dashboard" class="nav-link">
									<i class='fas fa-fw fa-hospital-alt nav_icon'></i>
									<p>
										Accueil
									</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="?requette=liste-rdv" class="nav-link">
									<i class='fas fa-fw fa-calendar-alt nav_icon'></i>
									<p>
										Agenda
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="?requette=liste-rdv" class="nav-link">
											<i class='fas fa-fw fa-calendar-check nav_icon'></i>
											<p>Liste des rendez-vous</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="?requette=ajout-rdv" class="nav-link">
											<i class='fas fa-fw fa-calendar-plus nav_icon'></i>
											<p>Ajouter un rendez-vous</p>
										</a>
									</li>
								</ul>
							</li>

							<li class="nav-item">
								<a href="?requette=liste-patient" class="nav-link">
									<i class='fas fa-fw fa-hospital-user nav_icon'></i>
									<p>
										Patients
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="?requette=liste-patient" class="nav-link">
											<i class='fas fa-fw fa-user-check nav_icon'></i>
											<p>Liste des patients</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="?requette=inscription-patient" class="nav-link">
											<i class='fas fa-fw fa-user-plus nav_icon'></i>
											<p>Ajouter un patient</p>
										</a>
									</li>
								</ul>
							</li>

							<li class="nav-item">
								<a href="?requette=consultations" class="nav-link">
									<i class='fas fa-fw fa-book-medical nav_icon'></i>
									<p>
										Consultations
									</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="?requette=statistiques" class="nav-link">
									<i class='fas fa-fw fa-chart-pie nav_icon'></i>
									<p>
										Statistiques
									</p>
								</a>
							</li>
							
						</ul>
					</nav>

				</div>

			</aside> 



			<div class="content-wrapper">

				<?php router(); ?>

			</div>

			<footer class="main-footer">
				<div class="container my-auto">
                    <div class="copyright text-center my-auto" style="font-size: small; color: rgba(0, 0, 0, 0.932);">
                        <span>Copyright &copy; 2022 Medical Team, tous droits réservés.</span>
                    </div>
                </div>
			</footer>

		</div>
	    
	    <!-- partie principale-->





	    <!--Scripts -->
	    <script src="public/js/sidebar.js"></script>
	    
	    <!-- jQuery -->
	    <script src="public/plugins/jquery/jquery.min.js"></script>

	    <!-- Bootstrap 4 -->
	    <script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

	    <!-- AdminLTE App -->
	    <script src="public/js/adminlte.min.js"></script>
	</body>
</html>