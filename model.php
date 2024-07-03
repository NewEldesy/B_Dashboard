<?php
// Connexion à la base de données
function dbConnect() {
    try {
        $database = new PDO('mysql:host=mysql-btechgroup.alwaysdata.net;dbname=btechgroup_dashboard;charset=utf8', '364785', 'w!Z7ntgLcLYE9NU');
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $database;
    } catch (PDOException $e) {
        handleDatabaseError($e->getMessage());
    }
}

// Gestion des erreurs de base de données
function handleDatabaseError($errorMessage) {
    exit("Erreur de base de données : " . $errorMessage);
}

// Validation et filtrage sécurisé de l'action
function validationAction($action) {
    if (!in_array($action, ['add', 'update', 'delete', 'print'])) {
        header('location:index.php?page=dashord');
        exit;
    }
}

// Fonctions pour obtenir la date actuelle en différents formats
function getCurrentDateTimeString() {
    return date('YmdHis'); // Format pour une chaîne numérique de date et heure
}

function frenchDate() {
    $date = new DateTime(); // Objet DateTime pour la date actuelle
    $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
    return $formatter->format($date); // Format complet en français
}

// Vérification d'accès basée sur le niveau d'utilisateur
function checkAccess($requiredLevel) {
    if (!isset($_SESSION['UserLevel']) || $_SESSION['UserLevel'] > $requiredLevel) {
        $currentPage = isset($_GET['page']) ? $_GET['page'] : '';
        $viewPage = 'index.php?page=' . $currentPage . '&action=view';
        header('Location: ' . $viewPage);
        exit;
    }
}

// Génération d'étiquettes de statut en fonction du statut donné
function generateStatusLabel($statut) {
    $labels = ["Réservé" => '<span class="badge bg-danger text-black fw-bold">Réservé</span>',
        "En attente" => '<span class="badge bg-warning text-black fw-bold">En attente</span>',
        "Payé" => '<span class="badge bg-success text-black fw-bold">Payé</span>'];
    if (array_key_exists($statut, $labels)) {
        return $labels[$statut];
    } else {
        return ''; // Retourne une chaîne vide si le statut n'est pas trouvé
    }
}

// Redirection vers le tableau de bord
function redirectToDashboard() {
    header('location: index.php?page=dashboard');
    exit;
}

// Ajoutez cette fonction pour vérifier si un ID existe dans une table
function doesIdExist($table, $id) {
    $database = dbConnect();
    try {
        $stmt = $database->prepare("SELECT COUNT(*) FROM $table WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        handleDatabaseError($e->getMessage());
        return false;
    }
}

// Connexion utilisateur
function tryLogin($data) {
    $database = dbConnect();
    $stmt = $database->prepare("SELECT * FROM users WHERE Email = :email");
    $stmt->bindParam(':email', $data['Email']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($data['Password'], $user['Password'])) { return $user; }
    else { return null; }
}

// Fonctions pour le calcul des coûts totaux
function totalCouts($table, $column) {
    $database = dbConnect();
    $stmt = $database->query("SELECT (SELECT SUM($column) FROM $table) AS total_cout");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total_cout'];
}

function totalCoutP() { return totalCouts('prestations', 'cout_prestation'); }

function totalCoutI() {  return totalCouts('interventions', 'cout_intervention'); }

// Fonction générique pour compter les enregistrements
function getCount($table) {
    $database = dbConnect();
    $stmt = $database->query("SELECT COUNT(*) AS count FROM {$table}");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
}

// Fonctions pour obtenir tous les enregistrements d'une table spécifique
function getAll($table) {
    $database = dbConnect();
    $stmt = $database->query("SELECT * FROM {$table}");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// Fonctions pour obtenir un enregistrement par ID à partir d'une table spécifique
function getById($table, $idColumn, $id) {
    $database = dbConnect();
    $stmt = $database->prepare("SELECT * FROM {$table} WHERE {$idColumn} = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fonctions pour ajouter un nouvel enregistrement à une table spécifique
function addRecord($table, $data) {
    $database = dbConnect();
    $columns = implode(", ", array_keys($data));
    $values = ":" . implode(", :", array_keys($data));
    $stmt = $database->prepare("INSERT INTO {$table} ({$columns}) VALUES ({$values})");
    foreach ($data as $key => $value) { $stmt->bindValue(":{$key}", $value); }
    $stmt->execute();
}

// Fonctions pour supprimer un enregistrement d'une table spécifique
function deleteRecord($table, $idColumn, $id) {
    $database = dbConnect();
    $stmt = $database->prepare("DELETE FROM {$table} WHERE {$idColumn} = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

// Fonctions pour mettre à jour un enregistrement dans une table spécifique
function updateRecord($table, $data, $idColumn, $id) {
    $database = dbConnect();
    $setClause = implode(", ", array_map(fn($key) => "{$key} = :{$key}", array_keys($data)));
    $stmt = $database->prepare("UPDATE {$table} SET {$setClause} WHERE {$idColumn} = :id");
    foreach ($data as $key => $value) { $stmt->bindValue(":{$key}", $value); }
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
}

// D'autres fonctions spécifiques pour obtenir des enregistrements par ID pour différentes tables
function getCLientById($id) { return getById('clients', 'client_id', $id); }

function getInterventionById($id) { return getById('interventions', 'id', $id); }

function getPrestationById($id) { return getById('prestations', 'id', $id); }

function getServiceById($id) { return getById('services', 'id', $id); }

function getUserById($id) { return getById('users', 'id', $id); }

function getFormationById($id) { return getById('Formations', 'id', $id);  }

function getParticipantById($id) { return getById('FormationParticipantsDetails', 'id', $id); }

// Fonctions pour ajouter des enregistrements à différentes tables
function addClient($data) { addRecord('clients', $data); }

function addIntervention($data) { addRecord('interventions', $data); }

function addService($data) { addRecord('services', $data); }

function addPrestations($data) { addRecord('prestations', $data); }

function addUser($data) { $data['Password'] = password_hash($data['Password'], PASSWORD_DEFAULT);
    addRecord('users', $data); }

function addFormation($data) { addRecord('Formations', $data); }

function addParticipant($data) { addRecord('FormationParticipantsDetails', $data); }

// Fonctions pour supprimer des enregistrements de différentes tables
function removeClient($id) { deleteRecord('clients', 'client_id', $id); }

function removeIntervention($id) { deleteRecord('interventions', 'id', $id); }

function removeService($id) { deleteRecord('services', 'service_id', $id); }

function removePrestations($id) { deleteRecord('prestations', 'id', $id); }

function removeUser($id) { deleteRecord('users', 'id', $id); }

function removeFormation($id) { deleteRecord('Formations', 'id', $id); }

function removeParticipant($id) { deleteRecord('FormationParticipantsDetails', 'id', $id); }

// Fonctions pour mettre à jour des enregistrements dans différentes tables
function updateClient($data) {updateRecord('clients', $data, 'client_id', $data['client_id']); }

function updateIntervention($data) {updateRecord('interventions', $data, 'id', $data['id']); }

function updateService($data) {updateRecord('services', $data, 'service_id', $data['service_id']); }

function updatePrestation($data) {updateRecord('prestations', $data, 'id', $data['id']); }

function updateUser($data) {updateRecord('users', $data, 'id', $data['id']); }

function updateFormation($data) {updateRecord('Formations', $data, 'id', $data['id']); }

function updateParticipant($data) {updateRecord('FormationParticipantsDetails', $data, 'id', $data['id']); }

// Fonctions pour lire des enregistrements dans différentes tables
function getClients() { return getAll('clients'); }

function getInterventions() { return getAll('interventions'); }

function getPrestations() { return getAll('prestations'); }

function getServices() { return getAll('services'); }

function getUsers() { return getAll('users'); }

function getFormation() { return getAll('Formations'); }

function getParticipant() { return getAll('FormationParticipantsDetails'); }

//Fonction qui calcul le couts total par type
function CoutInterventionByType($type) {
    $database = dbConnect();
    $stmt = $database->query("SELECT SUM(cout_intervention) AS total_cout_by_type FROM interventions WHERE type_intervention = $type");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total_cout_by_type'];
}

// Fonctions pour calculer le couts dans différentes tables
function CoutInterventionEnCours(){ return CoutInterventionByType(2); }

function CoutInterventionTermine(){ return CoutInterventionByType(3); }

// Fonctions pour lire le nombres d'enregistrements dans différentes tables
function getNbClient() { return getCount('clients'); }

function getNbIntervention() { return getCount('interventions'); }

function getNbPrestation() { return getCount('prestations'); }

function getNbService() { return getCount('services'); }