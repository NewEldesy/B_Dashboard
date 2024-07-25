<?php
    if(!isset($_GET['action'])){
        $interventions = getInterventions();
        include_once('app/add-intervention.php');
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
                addIntervention($_POST);
                header('location:index.php?page=intervention');
                break;
            case 'update':
                if(isset($_POST) && !empty($_POST) && isset($_GET['id'])){
                    updateIntervention($_POST);
                    header('location:index.php?page=intervention');
                }
                elseif(isset($_GET['id'])) {
                    $result = getInterventionById($_GET['id']);
                    include_once("app/update-intervention.php");
                }
                break;
            case 'delete':
                if(!isset($_GET['id'])){
                    header('location:index.php?page=intervention');
                }
                else{
                    removeIntervention($_GET['id']);
                    header('location:index.php?page=intervention');
                }
                break;
            case 'print':
                include_once('app/print_intervention.php');
                break;                        
        }
    }
?>