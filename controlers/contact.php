<?php
    if(!isset($_GET['action'])){
        $contacts = getContacts();
        include_once('app/add-contact.php');
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
                addContact($_POST);
                header('location:index.php?page=contact');
                break;
            case 'update':
                if(isset($_POST) && !empty($_POST) && isset($_GET['id'])){
                    updateContact($_POST);
                    header('location:index.php?page=contact');
                }
                elseif(isset($_GET['id'])) {
                    $result = getContactById($_GET['id']);
                    include_once("app/update-contact.php");
                }
                break;
            case 'delete':
                if(!isset($_GET['id'])){
                    header('location:index.php?page=contact');
                }
                else{
                    removeContact($_GET['id']);
                    header('location:index.php?page=contact');
                }
                break;
            case 'print':
                include_once('app/print_contact_list.php');
                break;                        
        }
    }
?>
