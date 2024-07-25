<?php
    if(!isset($_GET['action'])){
        $prestations = getPrestations();
        include_once('app/add-prestation.php');
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
                addPrestation($_POST);
                header('location:index.php?page=prestation');
                break;
            case 'update':
                if(isset($_POST) && !empty($_POST) && isset($_GET['id'])){
                    updatePrestation($_POST);
                    header('location:index.php?page=prestation');
                }
                elseif(isset($_GET['id'])) {
                    $result = getPrestationById($_GET['id']);
                    include_once("app/update-prestation.php");
                }
                break;
            case 'delete':
                if(!isset($_GET['id'])){
                    header('location:index.php?page=prestation');
                }
                else{
                    removePrestation($_GET['id']);
                    header('location:index.php?page=prestation');
                }
                break;
            case 'print':
                if(!isset($_GET['id'])){
                    include_once('');
                }else{
                    include_once('app/print_prestation.php');
                }
                break;                        
        }
    }
?>