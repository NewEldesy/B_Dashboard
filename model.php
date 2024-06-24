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

// Connexion utilisateur
function tryLogin($data) {
    $database = dbConnect();
    $stmt = $database->prepare("SELECT * FROM User WHERE Email = :email");
    $stmt->bindParam(':email', $data['Email']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return !empty($user) && password_verify($data['Password'], $user['Password']) ? $user : null;
}

// Fonction générique pour compter les enregistrements
function getCount($table) {
    $database = dbConnect();
    $stmt = $database->query("SELECT COUNT(*) AS count FROM {$table}");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
}

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

//récuppére un utilisateur par son id
function getUserById($id) {
    $database = dbConnect();
    $statement = $database->prepare("SELECT * FROM User WHERE userID = :id");
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

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
function getInterventionById($id) { return getById('Interventions', 'id', $id); }

//Get Prestation by Id
function getPrestationById($id) { return getById('prestations', 'id', $id); }

//Get Service by Id
function getIServiceById($id) { return getById('services', 'service_id', $id); }

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
    addRecord('User', $data);
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
function removeInterventions($id) { deleteRecord('interventions', 'id', $id); }

//Delete Services
function removeServices($id) { deleteRecord('services', 'service_id', $id); }

//Delete Prestations
function removePrestations($id) { deleteRecord('prestations', 'id', $id); }

//Delete User
function removeUser($id) {
    deleteRecord('User', 'UserID', $id);
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
function updateService($data) { updateRecord('services', $data, 'service_id', $data['id']); }

//Update Prestations
function updatePrestation($data) { updateRecord('prestations', $data, 'id', $data['id']); }

//Update Users
function updateUser($data) { updateRecord('users', $data, 'id', $data['id']); }