<?php
    if(!isset($_GET['action'])){
        $users = getUsers();
        include_once('app/add-user.php');
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
                addUser($_POST);
                addLog($_SESSION["id"], "create");
                header('location:index.php?page=user');
                break;
            case 'update':
                if(isset($_POST) && !empty($_POST) && isset($_GET['id'])){
                    updateUser($_POST);
                    addLog($_SESSION["id"], "update");
                    header('location:index.php?page=user');
                }
                elseif(isset($_GET['id'])) {
                    $result = getUserById($_GET['id']);
                    include_once("app/update-user.php");
                }
                break;
            case 'delete':
                if(!isset($_GET['id'])){
                    header('location:index.php?page=user');
                }
                else{
                    removeUser($_GET['id']);
                    addLog($_SESSION["id"], "delete");
                    header('location:index.php?page=user');
                }
                break;
            case 'print':
                include_once('app/print_user_list.php');
                break;                    
        }
    }
?>