<?php
    session_start(); 
    ob_start();
    include_once('model.php');
    
    if (!isset($_SESSION['id']) || !isset($_SESSION['type_user'])) {handleLogin();}
    else { 
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
    
            switch ($page) {
                case 'client':
                    include_once('controlers/client.php');
                    break;
    
                case 'dashboard':
                    include_once('controlers/dashboard.php');
                    break;
    
                case 'facture':
                    include_once('controlers/facture.php');
                    break;
    
                case 'formation':
                    include_once('controlers/formation.php');
                    break;
    
                case 'intervention':
                    include_once('controlers/intervention.php');
                    break;
    
                case 'logout':
                    include_once('controlers/logout.php');
                    break;

                case 'participant':
                    include_once('controlers/participant.php');
                    break;

                case 'prestation':
                    include_once('controlers/prestation.php');
                    break;

                case 'profil':
                    include_once('controlers/profil.php');
                    break;

                case 'service':
                    include_once('controlers/service.php');
                    break;

                case 'fournisseur':
                    include_once('controlers/fournisseur.php');
                    break;

                case 'contact':
                    include_once('controlers/contact.php');
                    break;

                case 'user':
                    if($_SESSION['type_user'] != 1) {header('Location: index.php?page=404'); exit();}
                    include_once('controlers/user.php');
                    break;
    
                default:
                    include_once('app/404.php');
                    break;
            }
        }
    }
    ob_end_flush();
?>