<?php
    if(!isset($_GET['action'])){
        $formations = getFormation();
        include_once('app/add-formation.php');
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
                addFormation($_POST);
                addLog($_SESSION["id"], "create");
                header('location:index.php?page=formation');
                break;
            case 'update':
                if(isset($_POST) && !empty($_POST) && isset($_GET['id'])){
                    updateFormation($_POST);
                    addLog($_SESSION["id"], "update");
                    header('location:index.php?page=formation');
                }
                elseif(isset($_GET['id'])) {
                    $result = getFormationById($_GET['id']);
                    include_once("app/update-formation.php");
                }
                break;
            case 'delete':
                if(!isset($_GET['id'])){
                    header('location:index.php?page=formation');
                }
                else{
                    removeFormation($_GET['id']);
                    addLog($_SESSION["id"], "delete");
                    header('location:index.php?page=formation');
                }
                break;
            case 'print':
                include_once('app/print_formation_list.php');
                break;                        
        }
    }
?>