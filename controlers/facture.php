<?php
    if(isset($_GET['action'])){
        switch ($_GET['action']) {
            case 'add':
            case 'update':
            case 'delete':
                checkUserSessionAndAction();
                break;
        }

        validationAction($_GET['action']);
        
        switch($_GET['action']) {
            case 'add':
                addFacture($_POST);
                addLog($_SESSION["id"], "create");
                header('location:index.php?page=facture');
                break;
            case 'update':
                if(isset($_POST) && !empty($_POST) && isset($_GET['id'])){
                    updateFacture($_POST);
                    addLog($_SESSION["id"], "update");
                    header('location:index.php?page=facture');
                }
                elseif(isset($_GET['id'])) {
                    $result = getFactureById($_GET['id']);
                    include_once("app/update-facture.php");
                }
                break;
            case 'delete':
                if(!isset($_GET['id'])){
                    header('location:index.php?page=facture');
                }
                else{
                    removeFacture($_GET['id']);
                    addLog($_SESSION["id"], "delete");
                    header('location:index.php?page=facture');
                }
                break;
            case 'print':
                if(!isset($_GET['id'])){
                    include_once('app/print_facture_list.php');
                }
                else{
                    include_once('app/facture_pro.php');
                }
                break;                        
        }
    }else{
        $factures = getFacture();
        include_once('app/add-facture.php');
    }
?>