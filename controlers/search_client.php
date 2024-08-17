<?php
    require_once("model.php");

    if(isset($_POST['query'])){
        $database = dbConnect(); $query = $_POST['query'];
        $stmt = $database->prepare("SELECT id, nom, prenom FROM client WHERE nom LIKE ? OR prenom LIKE ?");
        $stmt->execute(["%$query%", "%$query%"]); $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if($clients){
            foreach($clients as $client){
                echo '<a href="#" class="list-group-item list-group-item-action" onclick="selectClient('.$client['id'].', \''.$client['prenom'].' '.$client['nom'].'\')">'.$client['prenom'].' '.$client['nom'].'</a>';
            }
        } else { echo '<p class="list-group-item">Aucun résultat trouvé</p>'; }
    }
?>