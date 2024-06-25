<?php
session_start();
include_once('model.php');

$_SESSION["UserID"] = 1;

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
} else {
    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        switch ($page) {
            case 'dashboard':
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

            default:
                include_once('app/404.php');
                break;
        }
    }
}
?>