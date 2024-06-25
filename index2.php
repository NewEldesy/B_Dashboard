<?php
session_start();
include_once('model.php');

$_SESSION["UserID"] = 1;

// Vérifiez si l'utilisateur est déjà connecté
// if (isset($_SESSION['UserID'])) {
//     header('Location: index.php?page=dashboard');
//     exit;
// }

// Si l'utilisateur n'est pas connecté
if (!isset($_SESSION['UserID'])) {
    if (isset($_POST) && !empty($_POST)) {
        try {
            $user = tryLogin($_POST);
            if (!empty($user)) {
                $_SESSION["UserID"] = $user['UserID'];
                $_SESSION["Email"] = $user['Email'];
                $_SESSION["Nom"] = $user['Nom'];
                $_SESSION["Prenom"] = $user['Prenom'];
                redirectToDashboard();
            } else {
                echo 'Identifiants invalides.';
            }
        } catch (PDOException $e) {
            handleDatabaseError($e->getMessage());
        }
    } else {
        include_once('app/signin.php');
    }
}

// Code pour gérer les pages une fois l'utilisateur connecté
if (isset($_GET['page'])) {
    $page = $_GET['page'];

    switch ($page) {
        case 'dashboard':
            $client = getNbClient();
            $intervention = getNbIntervention();
            $prestation = getNbPrestation();
            $service = getNbService();
            include_once('app/dashboard.php');
            break;

        case 'logout':
            session_destroy();
            header('location: index.php');
            break;

        case 'client':
            if (isset($_GET['action'])) {
                $action = $_GET['action'];
                validationAction($action);

                if ($action == "add") {
                    if (isset($_POST) && !empty($_POST)) {
                        addClient($_POST);
                        header('location:index.php?page=client');
                    } else {
                        $clients = getClients();
                        include_once('app/add-client.php');
                    }
                } elseif ($action == "update") {
                    if (isset($_POST) && !empty($_POST) && isset($_GET['id'])) {
                        updateClient($_POST);
                        header('location:index.php?page=client');
                    } else {
                        if (isset($_GET['id'])) {
                            $result = getClientById($_GET['id']);
                            include('app/update-client.php');
                        } else {
                            echo "Identifiant manquant.";
                            exit;
                        }
                    }
                } elseif ($action == "delete") {
                    if (isset($_GET['id'])) {
                        removeClient($_GET['id']);
                        header('location: index.php?page=client');
                        exit;
                    } else {
                        echo "Identifiant manquant.";
                        exit;
                    }
                }
            } else {
                $clients = getClients();
                include_once('app/add-client.php');
            }
            break;

        case 'intervention':
            if (isset($_GET['action'])) {
                $action = $_GET['action'];
                validationAction($action);

                if ($action == "add") {
                    if (isset($_POST) && !empty($_POST)) {
                        addIntervention($_POST);
                        header('location:index.php?page=intervention');
                    } else {
                        $interventions = getInterventions();
                        include_once('app/add-intervention.php');
                    }
                } elseif ($action == "update") {
                    if (isset($_POST) && !empty($_POST) && isset($_GET['id'])) {
                        updateIntervention($_POST);
                        header('location:index.php?page=intervention');
                    } else {
                        if (isset($_GET['id'])) {
                            $result = getInterventionById($_GET['id']);
                            include('app/update-intervention.php');
                        } else {
                            echo "Identifiant manquant.";
                            exit;
                        }
                    }
                } elseif ($action == "delete") {
                    if (isset($_GET['id'])) {
                        removeIntervention($_GET['id']);
                        header('location: index.php?page=intervention');
                        exit;
                    } else {
                        echo "Identifiant manquant.";
                        exit;
                    }
                }
            } else {
                $interventions = getInterventions();
                include_once('app/add-intervention.php');
            }
            break;

        case 'prestation':
            if (isset($_GET['action'])) {
                $action = $_GET['action'];
                validationAction($action);
    
                if ($action == "add") {
                    if (isset($_POST) && !empty($_POST)) {
                        addPrestations($_POST);
                        header('location:index.php?page=prestation');
                    } else {
                        $prestations = getPrestations();
                        include_once('app/add-prestation.php');
                    }
                } elseif ($action == "update") {
                    if (isset($_POST) && !empty($_POST) && isset($_GET['id'])) {
                        updatePrestation($_POST);
                        header('location:index.php?page=prestation');
                    } else {
                        if (isset($_GET['id'])) {
                            $result = getPrestationById($_GET['id']);
                            include('app/update-prestation.php');
                        } else {
                            echo "Identifiant manquant.";
                            exit;
                        }
                    }
                } elseif ($action == "delete") {
                    if (isset($_GET['id'])) {
                        removePrestations($_GET['id']);
                        header('location: index.php?page=prestation');
                        exit;
                    } else {
                        echo "Identifiant manquant.";
                        exit;
                    }
                }
            } else {
                $prestations = getPrestations();
                include_once('app/add-prestation.php');
            }
            break;

        case 'service':
            if (isset($_GET['action'])) {
                $action = $_GET['action'];
                validationAction($action);
    
                if ($action == "add") {
                    if (isset($_POST) && !empty($_POST)) {
                        addService($_POST);
                        header('location:index.php?page=service');
                    } else {
                        $services = getServices();
                        include_once('app/add-service.php');
                    }
                } elseif ($action == "update") {
                    if (isset($_POST) && !empty($_POST) && isset($_GET['id'])) {
                        updateService($_POST);
                        header('location:index.php?page=service');
                    } else {
                        if (isset($_GET['id'])) {
                            $result = getServiceById($_GET['id']);
                            include('app/update-service.php');
                        } else {
                            echo "Identifiant manquant.";
                            exit;
                        }
                    }
                } elseif ($action == "delete") {
                    if (isset($_GET['id'])) {
                        removeService($_GET['id']);
                        header('location: index.php?page=service');
                        exit;
                    } else {
                        echo "Identifiant manquant.";
                        exit;
                    }
                }
            } else {
                $services = getServices();
                include_once('app/add-service.php');
            }
            break;

        default:
            include_once('app/404.php');
            break;
    }
}
?>