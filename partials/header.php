<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Dashboard - B'Tech Group SAS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="assets/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"  rel="stylesheet"> -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="assets/lib/bootstrap-icons.css">

    <!-- Libraries Stylesheet -->
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/dataTables/css/dataTables.dataTables.css">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.php?page=dashboard" class="navbar-brand mx-4 mb-3">
                    <img src="assets/img/logo_1.jpeg" width="30" height="40" alt="">
                    <h6 class="text-primary">B'Tech Group Sas</h6>
                </a>
                <div class="navbar-nav w-100">
                    <a href="index.php?page=dashboard" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="index.php?page=client" class="nav-item nav-link"><i class="fa fa-users me-2"></i>Client</a>
                    <a href="index.php?page=intervention" class="nav-item nav-link"><i class="fa fa-tag me-2"></i>Intervention</a>
                    <a href="index.php?page=prestation" class="nav-item nav-link"><i class="fa fa-copy me-2"></i>Prestation</a>
                    <a href="index.php?page=service" class="nav-item nav-link"><i class="fa fa-list me-2"></i>Service</a>
                    <hr>
                        <a href="index.php?page=fournisseur" class="nav-item nav-link"><i class="fa fa-dolly me-2"></i>Fournisseur</a>
                        <a href="index.php?page=contact" class="nav-item nav-link"><i class="fa fa-address-book me-2"></i>Contact</a>
                    <hr>
                    <a href="index.php?page=formation" class="nav-item nav-link"><i class="fa fa-chalkboard me-2"></i>Formation</a>
                    <a href="index.php?page=participant" class="nav-item nav-link"><i class="fa fa-user-graduate me-2"></i>Participant</a>
                    <?=($_SESSION['type_user']>=2) ? '<hr>' : '';?>
                    <a href="index.php?page=facture" class="nav-item nav-link" <?=($_SESSION['type_user']==1||$_SESSION['type_user']==2) ? '' : 'style="display:none;"';?>><i class="fa fa-receipt me-2"></i>Facture Pro.</a>
                    <?=($_SESSION['type_user']==1) ? '<hr>' : '';?>
                    <a href="index.php?page=user" class="nav-item nav-link" <?=($_SESSION['type_user']==1) ? '' : 'style="display:none;"';?>><i class="fa fa-user me-2"></i>Utilisateurs</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="d-none d-lg-inline-flex"><?= $_SESSION["Nom"] . " " . $_SESSION["Prenom"];?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="index.php?page=profil" class="dropdown-item">Profil</a>
                            <a href="index.php?page=logout" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->