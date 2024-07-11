<?php
// Fonction pour gérer la connexion
function handleLogin() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['Email']) && !empty($_POST['Password'])) {
        try { $user = tryLogin($_POST);
            if (!empty($user)) {
                $sessionDuration = 4 * 60 * 60; // Définir la durée de la session à 4 heures (en secondes)
                $sessionExpiration = time() + $sessionDuration; // Définir le délai d'expiration de la session

                $_SESSION["id"] = $user['id']; $_SESSION["Email"] = $user['Email'];
                $_SESSION["Nom"] = $user['Nom']; $_SESSION["Prenom"] = $user['Prenom'];
                $_SESSION["type_user"] = $user['type_user'];
                
                $_SESSION["expire"] = $sessionExpiration; // Définir l'heure d'expiration de la session
                redirectToDashboard();
            } else { echo 'Identifiants invalides.'; include_once('app/signin.php'); }
        } catch (PDOException $e) { handleDatabaseError($e->getMessage()); }
    } else { include_once('app/signin.php'); }
}

function handleLogout() { // Fonction pour gérer la déconnexion
    session_destroy(); header('location: index.php');
    exit;
}

function handleEntity($entity) { // Fonction pour gérer les pages de type entité (client, intervention, prestation, service)
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        validationAction($action);

        switch ($action) {
            case 'add':
            case 'update':
            case 'delete':
                checkUserSessionAndAction();
                break;
        }

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

            case 'print':
                handlePrint($entity);
                break;

            default:
                include_once('app/404.php');
                break;
        }
    } else {
        handleDefault($entity);
    }
}

function handleAdd($entity) { // Fonction pour gérer l'ajout d'une entité
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

            case 'facture':
                addFacture($_POST);
                header('location:index.php?page=facture');
                exit;

            default:
                include_once('app/404.php');
                exit;
        }
    } else {
        $entities = getEntities($entity);
        include_once("app/add-$entity.php");
    }
}

function handleUpdate($entity) { // Fonction pour gérer la mise à jour d'une entité
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

            case 'facture':
                updateFacture($_POST);
                header('location:index.php?page=facture');
                exit;

            default:
                include_once('app/404.php');
                exit;
        }
    } else {
        if (isset($_GET['id'])) {
            $result = getEntityById($entity, $_GET['id']);
            include_once("app/update-$entity.php");
        } else {
            echo "Identifiant manquant.";
            exit;
        }
    }
}

function handleDelete($entity) { // Fonction pour gérer la suppression d'une entité
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

            case 'facture':
                removeFacture($_GET['id']);
                header('location:index.php?page=facture');
                exit;

            default:
                include_once('app/404.php'); exit;
        }
    } else {
        header('location:index.php?page=dashboard'); exit;
    }
}

function handlePrint($entity) {
    if (isset($_GET['id'])) {
        switch ($entity) {
            case 'facture':
                include_once('app/facture_pro.php');

            case 'intervention':
                include_once('app/print_intervention.php');

            case 'prestation':
                include_once('app/print_prestation.php');
        }
    } else {
        header('location:index.php?page=dashboard');
        exit;
    }
}

function handleDefault($entity) { // Fonction pour gérer l'affichage par défaut (liste ou ajout)
    $entities = getEntities($entity);
    include_once("app/add-$entity.php");
}

function handleDashboard() { // Fonction pour gérer l'affichage du tableau de bord
    $client = getNbClient();
    $intervention = getNbIntervention();
    $prestation = getNbPrestation();
    $service = getNbService();
    $coutPrestation = totalCoutP();
    $coutIntervention = totalCoutI();
    $formationDispo = countUpcomingFormations();
    $participant = getNbParticipant();
    $coutFormation = totalCoutFormation();
    $nbFacture = countInvoices();
    $nbfPaye = countPaidInvoices();
    $nbfnPaye = countUnpaidInvoices();
    $totalFPaye = TotalPaidInvoices();
    $totalFNpaye = TotalUnPaidInvoices();
    include_once('app/dashboard.php');
    exit;
}

function getEntities($entity) { // Fonction générique pour récupérer les entités en fonction du type
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

        case 'facture':
            return getFacture();
            break;

        default:
            return [];
            break;
    }
}

function getEntityById($entity, $id) { // Fonction pour récupérer une entité par son ID
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

        case 'facture':
            return getFactureById($id);
            break;

        default:
            return null;
            break;
    }
}