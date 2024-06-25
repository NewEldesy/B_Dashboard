<?php
// Connection a la base de données
function dbConnect() {
    try {
        $database = new PDO('mysql:host=mysql-btechgroup.alwaysdata.net;dbname=btechgroup_dashboard;charset=utf8', '364785', 'w!Z7ntgLcLYE9NU');
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $database;
    } catch (PDOException $e) {
        handleDatabaseError($e->getMessage());
    }
}

function checkAccess($requiredLevel) {
    if (!isset($_SESSION['UserLevel']) || $_SESSION['UserLevel'] > $requiredLevel) {
        // Extraire la page actuelle de l'URL
        $currentPage = isset($_GET['page']) ? $_GET['page'] : '';
        // Déterminer la page de vue (view) correspondante
        $viewPage = 'index.php?page=' . $currentPage . '&action=view';
        // Rediriger l'utilisateur vers la page de vue (view) correspondante
        header('Location: ' . $viewPage);
        exit;
    }
}

// Redirection vers le dashboard
function redirectToDashboard() {
    // Fonction pour rediriger vers le tableau de bord
    header('location: index.php?page=dashboard');
    exit;
}

// Gestion des erreurs de base de données
function handleDatabaseError($errorMessage) {
    exit("Erreur de base de données : " . $errorMessage);
}

// Validez et filtrez le paramètre action pour éviter des problèmes de sécurité
function validationAction($action){
    if (!in_array($action, ['add', 'update', 'delete'])) {
        header('location:index.php?page=dashord');
        exit;
    }
}

// Connexion utilisateur
function tryLogin($data) {
    $database = dbConnect();
    $stmt = $database->prepare("SELECT * FROM users WHERE Email = :email");
    $stmt->bindParam(':email', $data['Email']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($data['Password'], $user['Password'])) {
        return $user;
    } else {
        return null;
    }
}

// Fonction générique pour compter les enregistrements
function getCount($table) {
    $database = dbConnect();
    $stmt = $database->query("SELECT COUNT(*) AS count FROM {$table}");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
}

//Get Client
function getNbClient() { return getCount('clients'); }

//Get Intervention
function getNbIntervention() { return getCount('interventions'); }

//Get Prestation
function getNbPrestation() { return getCount('prestations'); }

//Get Service
function getNbService() { return getCount('services'); }

// Fonction générique pour récupérer tous les enregistrements d'une table
function getAll($table) {
    $database = dbConnect();
    $stmt = $database->query("SELECT * FROM {$table}");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

//Get All Clients
function getClients() { return getAll('clients'); }

//Get All Interventions
function getInterventions() { return getAll('interventions'); }

//Get All Prestations
function getPrestations() { return getAll('prestations'); }

//Get All Services
function getServices() { return getAll('services'); }

//Get All Users
function getUsers() { return getAll('users'); }

// Fonction générique pour récupérer un enregistrement par ID
function getById($table, $idColumn, $id) {
    $database = dbConnect();
    $stmt = $database->prepare("SELECT * FROM {$table} WHERE {$idColumn} = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//Get Client by Id
function getCLientById($id) { return getById('clients', 'client_id', $id); }

//Get Intervention by Id
function getInterventionById($id) { return getById('interventions', 'id', $id); }

//Get Prestation by Id
function getPrestationById($id) { return getById('prestations', 'id', $id); }

//Get Service by Id
function getServiceById($id) { return getById('services', 'service_id', $id); }

//Get User by Id
function getUserById($id) { return getById('users', 'id', $id); }

// Fonction générique pour ajouter un enregistrement
function addRecord($table, $data) {
    $database = dbConnect();
    $columns = implode(", ", array_keys($data));
    $values = ":" . implode(", :", array_keys($data));
    $stmt = $database->prepare("INSERT INTO {$table} ({$columns}) VALUES ({$values})");
    foreach ($data as $key => $value) {
        $stmt->bindValue(":{$key}", $value);
    }
    $stmt->execute();
}

//Add Client
function addClient($data) { addRecord('clients', $data); }

//Add Interventions
function addIntervention($data) { addRecord('interventions', $data); }

//Add Services
function addService($data) { addRecord('services', $data); }	

//Add Prestations		
function addPrestations($data) { addRecord('prestations', $data); }

//Add Users
function addUser($data) {
    $data['Password'] = password_hash($data['Password'], PASSWORD_DEFAULT);
    addRecord('users', $data);
}

// Fonction générique pour supprimer un enregistrement
function deleteRecord($table, $idColumn, $id) {
    $database = dbConnect();
    $stmt = $database->prepare("DELETE FROM {$table} WHERE {$idColumn} = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

//Delete Client
function removeClient($id) { deleteRecord('clients', 'client_id', $id); }

//Delete Interventions
function removeIntervention($id) { deleteRecord('interventions', 'id', $id); }

//Delete Services
function removeService($id) { deleteRecord('services', 'service_id', $id); }

//Delete Prestations
function removePrestations($id) { deleteRecord('prestations', 'id', $id); }

//Delete User
function removeUser($id) {
    deleteRecord('users', 'id', $id);
}

// Fonction générique pour mettre à jour un enregistrement
function updateRecord($table, $data, $idColumn, $id) {
    $database = dbConnect();
    $setClause = implode(", ", array_map(fn($key) => "{$key} = :{$key}", array_keys($data)));
    $stmt = $database->prepare("UPDATE {$table} SET {$setClause} WHERE {$idColumn} = :id");
    foreach ($data as $key => $value) {
        $stmt->bindValue(":{$key}", $value);
    }
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
}

//Update Client
function updateClient($data) { updateRecord('clients', $data, 'client_id', $data['client_id']); }

//Update Interventions
function updateIntervention($data) { updateRecord('interventions', $data, 'id', $data['id']); }

//Update Services
function updateService($data) { updateRecord('services', $data, 'service_id', $data['service_id']); }

//Update Prestations
function updatePrestation($data) { updateRecord('prestations', $data, 'id', $data['id']); }

//Update Users
function updateUser($data) { updateRecord('users', $data, 'id', $data['id']); }