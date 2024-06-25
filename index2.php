<?php
    session_start();
    include_once('model.php');

    if (!isset($_SESSION['UserID'])) {
        //Si $_Post existe et si il n'est pas vide
        if (isset($_POST) && !empty($_POST)) {
            try {
                //Fonction pour essayer de se connecter
                $user = tryLogin($_POST);
                //Si l'utilisateur existe
                if (!empty($user)) {
                    //Initialisation des session
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
            //Redirection
            include_once('app/signin.php');
        }
    } else {
        if (isset($_GET['page'])) {
            //Initialisation variable page
            $page = $_GET['page'];

            switch ($page) {
                case 'dashboard':

                    include_once('app/dashboard.php');
                    break;

                case 'logout':
                    //Destruction session
                    session_destroy();
                    //redirection
                    header('location: index.php');
                    break;

                case 'client':
                    if(isset($_GET['action'])) {
                        //Initialisation variable action
                        $action = $_GET['action'];
                        
                        // Validez et filtrez le paramètre action pour éviter des problèmes de sécurité
                        validationAction($action);
                        
                        if($action == "add"){
                            // Si $_Post existe et si $_Post n'est pas vide
                                if(isset($_POST) && !empty($_POST)) {
                                    //Ajout client
                                    addClient($_POST);
                                    //Redirection
                                    header('location:index.php?page=client');
                                }
                                else {
                                    //Redirection
                                    include_once('app/add-client.php');
                                }
                        }
                        // Gestion de la mise à jour de taxi
                        elseif($action == "update") {
                            // Si id, $_Post existent et si $_Post n'est pas vide
                            if(isset($_POST) && !empty($_POST) && isset($_GET['id'])) {
                                //Update Taxi by
                                updateClient($_POST);
                                //Redirection
                                header('location:index.php?page=client');
                            }
                            else {
                                //Si id existe
                                if(isset($_GET['id'])) {
                                    //Récupération taxi by id
                                    $result = getClientById($_GET['id']);
                                    //Redirection
                                    include('app/update-taxi.php');
                                } else {
                                    // Gérer l'absence de l'identifiant dans la requête
                                    echo "Identifiant manquant.";
                                    exit;
                                }
                            }
                        }
                        // Gestion de la suppression de taxi
                        elseif($action == "delete") {
                            //Si id existe
                            if(isset($_GET['id'])) {
                                //Suppression Taxi par id
                                removeClient($_GET['id']);
                                //Redirection
                                header('location: index.php?page=client');
                                exit;
                            } else {
                                // Gérer l'absence de l'identifiant dans la requête
                                echo "Identifiant manquant.";
                                exit;
                            }
                        }
                    }
                    break;
                    
                case 'client':

                    break;

                case 'client':

                    break;

                case 'client':

                    break;

                    case 'client':

                        break;

                default:
                    //Si la page n'existe pas il affiche 404 error
                    include_once('app/404.php');
                    break;
            }
        }
    }
?>