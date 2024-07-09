<?php
    session_start(); ob_start();
    include_once('model.php');
    include_once('function.php');
    
    
    if (!isset($_SESSION['id']) || !isset($_SESSION['type_user'])) { // Vérification si l'utilisateur est connecté
        // Si non connecté, traiter la connexion
        handleLogin();
    } else { // Si connecté, gérer les différentes pages
        
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
    
            switch ($page) {
                case 'dashboard':
                    handleDashboard();
                    break;
    
                case 'logout':
                    handleLogout();
                    break;
    
                case 'client':
                    handleEntity('client');
                    break;
    
                case 'intervention':
                    handleEntity('intervention');
                    break;
    
                case 'prestation':
                    handleEntity('prestation');
                    break;
    
                case 'service':
                    handleEntity('service');
                    break;

                case 'user':
                    handleEntity('user');
                    break;

                case 'formation':
                    handleEntity('formation');
                    break;

                case 'participant':
                    handleEntity('participant');
                    break;

                case 'facture':
                    handleEntity('facture');
                    break;
    
                default:
                    include_once('app/404.php');
                    break;
            }
        }
    }

    ob_end_flush();
?>