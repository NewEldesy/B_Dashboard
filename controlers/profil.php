<?php
    if(isset($_POST) && !empty($_POST)){
        $_POST['id'] = $_SESSION["id"];
        $profil = updateProfil($_POST);
        if(!empty($profil)){
            $_SESSION["id"] = $profil['id']; $_SESSION["Email"] = $profil['Email'];
            $_SESSION["Nom"] = $profil['Nom']; $_SESSION["Prenom"] = $profil['Prenom'];
            $_SESSION["type_user"] = $profil['type_user'];

            header('location:index.php?page=profil');
        }
        else { header('location:index.php?page=profil'); }
    }
    else{
        $result = getUserById($_SESSION['id']);
        include_once("app/profil.php");
    }
?>