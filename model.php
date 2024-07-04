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
    return date('YmHi'); // Format pour une chaîne numérique de date et heure
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

function getFactureById($id) { return getById('Facture', 'nFacture', $id); }

// Fonctions pour ajouter des enregistrements à différentes tables
function addClient($data) { addRecord('clients', $data); }

function addIntervention($data) { addRecord('interventions', $data); }

function addService($data) { addRecord('services', $data); }

function addPrestations($data) { addRecord('prestations', $data); }

function addUser($data) { $data['Password'] = password_hash($data['Password'], PASSWORD_DEFAULT);
    addRecord('users', $data); }

function addFormation($data) { addRecord('Formations', $data); }

function addParticipant($data) { addRecord('FormationParticipantsDetails', $data); }

function addFacture($data) {
    $database = dbConnect();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($data['submit'])) {
        // Récupérer les données de la facture depuis le formulaire
        $nom_entreprise = $data['nom_entreprise']; $IFU = $data['IFU'];
        $RCCM = $data['RCCM']; $divisionFiscale = $data['divisionFiscale'];
        $client_adresse = $data['client_adresse']; $client_telephone = $data['client_téléphone'];
        $objet_facture = $data['objet_facture'];
    
        // Récupérer les éléments de la facture depuis le champ caché JSON
        $elements = json_decode($data['elements'], true);
    
        // N Facture
        $nFacture = getCurrentDateTimeString();
    
        // Calculer le total de la facture
        $total_facture = 0;
        foreach ($elements as $element) { $total_facture += $element['total']; }
    
        // Définir la TVA (dans votre cas, c'est 0)
        $tva = 0;
    
        // Date d'émission de la facture (actuelle)
        $date_facture = date('Y-m-d');

        // Début de la transaction
        $database->beginTransaction();

        // Requête pour insérer les données dans la table `facture`
        $queryFacture = "INSERT INTO `Facture` (`nFacture`, `date_facture`, `nom_entreprise`, `IFU`, `RCCM`, `divisionFiscale`, 
            `client_adresse`, `client_telephone`, `objet_facture`, `total_facture`, `tva` ) VALUES (:nFacture, :date_facture, :nom_entreprise,
            :IFU, :RCCM, :divisionFiscale, :client_adresse, :client_telephone, :objet_facture, :total_facture, :tva)";

        $stmtFacture = $database->prepare($queryFacture);
        $stmtFacture->bindParam(':nFacture', $nFacture); $stmtFacture->bindParam(':date_facture', $date_facture);
        $stmtFacture->bindParam(':nom_entreprise', $nom_entreprise); $stmtFacture->bindParam(':IFU', $IFU);
        $stmtFacture->bindParam(':RCCM', $RCCM); $stmtFacture->bindParam(':divisionFiscale', $divisionFiscale);
        $stmtFacture->bindParam(':client_adresse', $client_adresse); $stmtFacture->bindParam(':client_telephone', $client_telephone);
        $stmtFacture->bindParam(':objet_facture', $objet_facture); $stmtFacture->bindParam(':total_facture', $total_facture);
        $stmtFacture->bindParam(':tva', $tva);
        $stmtFacture->execute();

        // Récupérer l'ID de la dernière facture insérée
        $lastInsertId = $nFacture;

        // Requête pour insérer les éléments de la facture dans la table `element_facture`
        $queryElementFacture = "INSERT INTO `ElementFacture` (`nFacture`, `description`, `quantite`, `prix_unitaire`, `total`)
            VALUES (:nFacture, :description, :quantite, :prix_unitaire, :total)";

        $stmtElementFacture = $database->prepare($queryElementFacture);

        // Boucle pour insérer chaque élément de la facture
        foreach ($elements as $element) {
            $stmtElementFacture->bindParam(':nFacture', $lastInsertId);
            $stmtElementFacture->bindParam(':description', $element['description']); $stmtElementFacture->bindParam(':quantite', $element['quantite']);
            $stmtElementFacture->bindParam(':prix_unitaire', $element['prix_unitaire']); $stmtElementFacture->bindParam(':total', $element['total']);
            $stmtElementFacture->execute();
        }
        // Valider la transaction
        $database->commit();
    }
}

// Fonctions pour supprimer des enregistrements de différentes tables
function removeClient($id) { deleteRecord('clients', 'client_id', $id); }

function removeIntervention($id) { deleteRecord('interventions', 'id', $id); }

function removeService($id) { deleteRecord('services', 'service_id', $id); }

function removePrestations($id) { deleteRecord('prestations', 'id', $id); }

function removeUser($id) { deleteRecord('users', 'id', $id); }

function removeFormation($id) { deleteRecord('Formations', 'id', $id); }

function removeParticipant($id) { deleteRecord('FormationParticipantsDetails', 'id', $id); }

function removeFacture($id) {
    $database = dbConnect();
    
    // Début de la transaction
    $database->beginTransaction();

    // Supprimer les éléments de la facture dans la table `elementFacture`
    $queryDeleteElements = "DELETE FROM `ElementFacture` WHERE `nFacture` = :nFacture";
    $stmtDeleteElements = $database->prepare($queryDeleteElements);
    $stmtDeleteElements->bindParam(':nFacture', $id);
    $stmtDeleteElements->execute();

    // Supprimer la facture dans la table `Facture`
    $queryDeleteFacture = "DELETE FROM `Facture` WHERE `nFacture` = :nFacture";
    $stmtDeleteFacture = $database->prepare($queryDeleteFacture);
    $stmtDeleteFacture->bindParam(':nFacture', $id);
    $stmtDeleteFacture->execute();

    // Valider la transaction
    $database->commit();
}

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

function getFacture() { return getAll('Facture'); }

function getFactureElementByF($id) { 
    $database = dbConnect();
    $stmt = $database->prepare("SELECT * FROM `ElementFacture` WHERE nFacture = :nFacture");
    $stmt->bindParam(':nFacture', $id, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

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

function numberToWords($number) {
    $hyphen      = '-';
    $conjunction = ' ';
    $separator   = ' ';
    $negative    = 'moins ';
    $decimal     = ' point ';
    $dictionary  = [
        0                   => 'zéro',
        1                   => 'un',
        2                   => 'deux',
        3                   => 'trois',
        4                   => 'quatre',
        5                   => 'cinq',
        6                   => 'six',
        7                   => 'sept',
        8                   => 'huit',
        9                   => 'neuf',
        10                  => 'dix',
        11                  => 'onze',
        12                  => 'douze',
        13                  => 'treize',
        14                  => 'quatorze',
        15                  => 'quinze',
        16                  => 'seize',
        17                  => 'dix-sept',
        18                  => 'dix-huit',
        19                  => 'dix-neuf',
        20                  => 'vingt',
        30                  => 'trente',
        40                  => 'quarante',
        50                  => 'cinquante',
        60                  => 'soixante',
        70                  => 'soixante-dix',
        80                  => 'quatre-vingt',
        90                  => 'quatre-vingt-dix',
        100                 => 'cent',
        1000                => 'mille',
        1000000             => 'million',
        1000000000          => 'milliard'
    ];
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'numberToWords only accepts numbers between ' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . numberToWords(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[(int) $hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . numberToWords($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = numberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= numberToWords($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = [];
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}