<?php
    if(!isset($_GET['action'])){
        $services = getServices();
        include_once('app/add-service.php');
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
                addService($_POST);
                addLog($_SESSION["id"], "create");
                header('location:index.php?page=service');
                break;
            case 'update':
                if(isset($_POST) && !empty($_POST) && isset($_GET['id'])){
                    updateService($_POST);
                    addLog($_SESSION["id"], "update");
                    header('location:index.php?page=service');
                }
                elseif(isset($_GET['id'])) {
                    $result = getServiceById($_GET['id']);
                    include_once("app/update-service.php");
                }
                break;
            case 'delete':
                if(!isset($_GET['id'])){
                    header('location:index.php?page=service');
                }
                else{
                    removeService($_GET['id']);
                    addLog($_SESSION["id"], "delete");
                    header('location:index.php?page=service');
                }
                break;
            case 'print':
                include_once('app/print_service_list.php');
                break;                        
        }
    }
?>