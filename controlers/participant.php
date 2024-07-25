<?php
    if(!isset($_GET['action'])){
        $participants = getParticipant();
        include_once('app/add-participant.php');
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
                addParticipant($_POST);
                header('location:index.php?page=participant');
                break;
            case 'update':
                if(isset($_POST) && !empty($_POST) && isset($_GET['id'])){
                    updateParticipant($_POST);
                    header('location:index.php?page=participant');
                }
                elseif(isset($_GET['id'])) {
                    $result = getParticipantById($_GET['id']);
                    include_once("app/update-participant.php");
                }
                break;
            case 'delete':
                if(!isset($_GET['id'])){
                    header('location:index.php?page=participant');
                }
                else{
                    removeParticipant($_GET['id']);
                    header('location:index.php?page=participant');
                }
                break;
            case 'print':
                include_once('app/print_participant_list.php');
                break;                        
        }
    }
?>