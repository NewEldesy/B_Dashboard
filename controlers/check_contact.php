<?php
include_once('../model.php'); // Assurez-vous que le chemin est correct pour inclure model.php

header('Content-Type: application/json');

try {
    if (isset($_GET['telephone'])) {
        $telephone = $_GET['telephone'];

        // Connexion à la base de données
        $database = dbConnect();

        // Préparez et exécutez la requête pour vérifier l'existence du téléphone
        $stmt = $database->prepare('SELECT COUNT(*) FROM contacts WHERE telephone = ?');
        $stmt->execute([$telephone]);
        $count = $stmt->fetchColumn();

        // Préparez la réponse JSON
        $response = ['exists' => $count > 0];
        echo json_encode($response);
    } else {
        echo json_encode(['exists' => false]);
    }
} catch (PDOException $e) {
    // Gérer les erreurs de connexion ou de requête
    echo json_encode(['exists' => false, 'error' => 'Database error']);
    error_log('Database error: ' . $e->getMessage());
}
?>