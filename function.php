<?php
// Fonction pour gérer la connexion
function handleLogin() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['Email']) && !empty($_POST['Password'])) {
        try {
            $user = tryLogin($_POST);
            if (!empty($user)) {
                $_SESSION["UserID"] = $user['id'];
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

// Fonction pour gérer la déconnexion
function handleLogout() {
    session_destroy();
    header('location: index.php');
    exit;
}

// Fonction pour gérer les pages de type entité (client, intervention, prestation, service)
function handleEntity($entity) {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        validationAction($action);

        switch ($action) {
            case 'add':
                handleAdd($entity);
                break;

            case 'update':
                handleUpdate($entity);
                break;

            case 'delete':
                handleDelete($entity);
                break;

            default:
                include_once('app/404.php');
                break;
        }
    } else {
        // Affichage par défaut (liste ou ajout)
        handleDefault($entity);
    }
}

// Fonction pour gérer l'ajout d'une entité
function handleAdd($entity) {
    if (isset($_POST) && !empty($_POST)) {
        switch ($entity) {
            case 'client':
                addClient($_POST);
                header('location:index.php?page=client');
                exit;

            case 'intervention':
                addIntervention($_POST);
                header('location:index.php?page=intervention');
                exit;

            case 'prestation':
                addPrestations($_POST);
                header('location:index.php?page=prestation');
                exit;

            case 'service':
                addService($_POST);
                header('location:index.php?page=service');
                exit;

            case 'user':
                addUser($_POST);
                header('location:index.php?page=user');
                exit;

            case 'formation':
                addFormation($_POST);
                header('location:index.php?page=formation');
                exit;

            case 'participant':
                addParticipant($_POST);
                header('location:index.php?page=participant');
                exit;

            case 'inscription':
                addInscription($_POST);
                header('location:index.php?page=inscription');
                exit;

            default:
                include_once('app/404.php');
                exit;
        }
    } else {
        // Affichage du formulaire d'ajout
        $entities = getEntities($entity);
        include_once("app/add-$entity.php");
    }
}

// Fonction pour gérer la mise à jour d'une entité
function handleUpdate($entity) {
    if (isset($_POST) && !empty($_POST) && isset($_GET['id'])) {
        switch ($entity) {
            case 'client':
                updateClient($_POST);
                header('location:index.php?page=client');
                exit;

            case 'intervention':
                updateIntervention($_POST);
                header('location:index.php?page=intervention');
                exit;

            case 'prestation':
                updatePrestation($_POST);
                header('location:index.php?page=prestation');
                exit;

            case 'service':
                updateService($_POST);
                header('location:index.php?page=service');
                exit;

            case 'user':
                updateUser($_POST);
                header('location:index.php?page=user');
                exit;

            case 'formation':
                updateFormation($_POST);
                header('location:index.php?page=formation');
                exit;

            case 'participant':
                updateParticipant($_POST);
                header('location:index.php?page=participant');
                exit;

            case 'inscription':
                updateInscription($_POST);
                header('location:index.php?page=inscription');
                exit;

            default:
                include_once('app/404.php');
                exit;
        }
    } else {
        // Affichage du formulaire de mise à jour
        if (isset($_GET['id'])) {
            $result = getEntityById($entity, $_GET['id']);
            include_once("app/update-$entity.php");
        } else {
            echo "Identifiant manquant.";
            exit;
        }
    }
}

// Fonction pour gérer la suppression d'une entité
function handleDelete($entity) {
    if (isset($_GET['id'])) {
        switch ($entity) {
            case 'client':
                removeClient($_GET['id']);
                header('location:index.php?page=client');
                exit;

            case 'intervention':
                removeIntervention($_GET['id']);
                header('location:index.php?page=intervention');
                exit;

            case 'prestation':
                removePrestations($_GET['id']);
                header('location:index.php?page=prestation');
                exit;

            case 'service':
                removeService($_GET['id']);
                header('location:index.php?page=service');
                exit;

            case 'user':
                removeUser($_GET['id']);
                header('location:index.php?page=user');
                exit;

            case 'formation':
                removeFormation($_GET['id']);
                header('location:index.php?page=formation');
                exit;

            case 'participant':
                removeParticipant($_GET['id']);
                header('location:index.php?page=participant');
                exit;

            case 'inscription':
                removeInscription($_GET['id']);
                header('location:index.php?page=inscription');
                exit;

            default:
                include_once('app/404.php');
                exit;
        }
    } else {
        echo "Identifiant manquant.";
        exit;
    }
}

// Fonction pour gérer l'affichage par défaut (liste ou ajout)
function handleDefault($entity) {
    $entities = getEntities($entity);
    include_once("app/add-$entity.php");
}

// Fonction pour gérer l'affichage du tableau de bord
function handleDashboard() {
    $client = getNbClient();
    $intervention = getNbIntervention();
    $prestation = getNbPrestation();
    $service = getNbService();
    $coutPrestation = totalCoutP();
    $coutIntervention = totalCoutI();
    $enCours = CoutInterventionEnCours();
    $termine = CoutInterventionTermine();
    include_once('app/dashboard.php');
    exit;
}

// Fonction générique pour récupérer les entités en fonction du type
function getEntities($entity) {
    switch ($entity) {
        case 'client':
            return getClients();
            break;

        case 'intervention':
            return getInterventions();
            break;

        case 'prestation':
            return getPrestations();
            break;

        case 'service':
            return getServices();
            break;

        case 'user':
            return getUsers();
            break;

        case 'formation':
            return getFormation();
            break;

        case 'participant':
            return getParticipant();
            break;

        case 'inscription':
            return getInscription();
            break;

        default:
            return [];
            break;
    }
}

// Fonction pour récupérer une entité par son ID
function getEntityById($entity, $id) {
    switch ($entity) {
        case 'client':
            return getClientById($id);
            break;

        case 'intervention':
            return getInterventionById($id);
            break;

        case 'prestation':
            return getPrestationById($id);
            break;

        case 'service':
            return getServiceById($id);
            break;

        case 'user':
            return getUserById($id);
            break;

        case 'formation':
            return getFormationById($id);
            break;

        case 'participant':
            return getParticipantById($id);
            break;

        case 'inscription':
            return getInscriptionById($id);
            break;

        default:
            return null;
            break;
    }
}
?>