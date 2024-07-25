<?php
    if(!isset($_GET['action'])){
        $clients = getClients();
        include_once('app/add-client.php');
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
                addClient($_POST);
                header('location:index.php?page=client');
                break;
            case 'update':
                if(isset($_POST) && !empty($_POST) && isset($_GET['id'])){
                    updateClient($_POST);
                    header('location:index.php?page=client');
                }
                elseif(isset($_GET['id'])) {
                    $result = getClientById($_GET['id']);
                    include_once("app/update-client.php");
                }
                break;
            case 'delete':
                if(!isset($_GET['id'])){
                    header('location:index.php?page=client');
                }
                else{
                    removeClient($_GET['id']);
                    header('location:index.php?page=client');
                }
                break;
            case 'print':
                include_once('app/print_client_list.php');
                break;                        
        }
    }
?>