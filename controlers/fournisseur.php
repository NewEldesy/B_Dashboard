<?php
    if(!isset($_GET['action'])){
        $fournisseurs = getFournisseurs();
        include_once('app/add-fournisseur.php');
    }
    else{
        $action = $_GET['action']; validationAction($action);

        switch ($action) {
            case 'add':
            case 'update':
            case 'delete':
                checkUserSessionAndAction();
                break;
        }
        
        switch($action) {
            case 'add':
                addFournisseur($_POST);
                header('location:index.php?page=fournisseur');
                break;
            case 'update':
                if(isset($_POST) && !empty($_POST) && isset($_GET['id'])){
                    updateFournisseur($_POST);
                    header('location:index.php?page=fournisseur');
                }
                elseif(isset($_GET['id'])) {
                    $result = getFournisseurById($_GET['id']);
                    include_once("app/update-fournisseur.php");
                }
                break;
            case 'delete':
                if(!isset($_GET['id'])){
                    header('location:index.php?page=fournisseur');
                }
                else{
                    removeFournisseur($_GET['id']);
                    header('location:index.php?page=fournisseur');
                }
                break;
            case 'print':
                include_once('app/print_fournisseur_list.php');
                break;                        
        }
    }
?>
