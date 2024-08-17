<?php
// Connexion à la base de données (SQLite ou MySQL)
// $pdo = new PDO('sqlite:BDD/caisse.db'); // SQLite
$pdo = new PDO('mysql:host=localhost;dbname=btechgroup_dashboard', 'root', ''); // MySQL

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $query = $pdo->prepare("SELECT nom, prenom, telephone FROM clients WHERE nom LIKE ? OR prenom LIKE ?");
    $query->execute(["%$search%", "%$search%"]);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    
    if($results){
        foreach($results as $result){
            // echo '<p>' - ' . $result['telephone'] . '</p>';
            echo '<a href="">' . $result['nom'] . ' ' . $result['prenom'] . '</a><br>';
        }
    } else {
        echo '<p>Aucun résultat trouvé</p>';
    }
}
?>