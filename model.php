<?php
function dbConnect() { // Connexion à la base de données
    try {
        $database = new PDO('mysql:host=localhost;dbname=btechgroup_dashboard;charset=utf8', 'root', '');
        // $database = new PDO('mysql:host=mysql-btechgroup.alwaysdata.net;dbname=btechgroup_dashboard;charset=utf8', '364785', 'w!Z7ntgLcLYE9NU');
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $database;
    } catch (PDOException $e) {
        handleDatabaseError($e->getMessage());
    }
}

function handleDatabaseError($errorMessage) { // Gestion des erreurs de base de données
    exit("Erreur de base de données : " . $errorMessage);
}

function validationAction($action) { // Validation et filtrage sécurisé de l'action
    if (!in_array($action, ['add', 'update', 'delete', 'print'])) { redirectToDashboard(); }
}

function getCurrentDateTimeString() { return date('ymdHi'); /* Fonctions pour obtenir la date actuelle en différents formats & Format pour une chaîne numérique de date et heure*/ }

function frenchDate() {
    $date = new DateTime(); // Objet DateTime pour la date actuelle
    $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
    return $formatter->format($date); // Format complet en français
}

function generateStatusLabel($statut) { // Génération d'étiquettes de statut en fonction du statut donné
    switch ($statut) {
        case "non payé":
            return '<span class="badge bg-warning text-black fw-bold">Non Payé</span>';
        case "payé":
            return '<span class="badge bg-success text-black fw-bold">Payé</span>';
        default:
            return '';
    }
}

function redirectToDashboard() { // Redirection vers le tableau de bord
    header('location: index.php?page=dashboard'); exit; }

function doesIdExist($table, $id) { // Ajoutez cette fonction pour vérifier si un ID existe dans une table
    $database = dbConnect();
    try {
        $stmt = $database->prepare("SELECT COUNT(*) FROM $table WHERE id = :id");
        $stmt->execute([':id' => $id]); return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        handleDatabaseError($e->getMessage()); return false;
    }
}

function tryLogin($data) { // Connexion utilisateur
    $database = dbConnect();
    $stmt = $database->prepare("SELECT * FROM users WHERE Email = :email");
    $stmt->bindParam(':email', $data['Email']); $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($data['Password'], $user['Password'])) { return $user; }
    else { return null; }
}

function updateProfil($data) { // Mis à jour profil utilisateur utilisateur
    $database = dbConnect();
    $stmt = $database->prepare("SELECT * FROM users WHERE Email = :email");
    $stmt->bindParam(':email', $data['Email']); $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($data['Password'], $user['Password'])) {
        //pass1
        if($data['pass1']==$data['pass2']){
            $data['Pass'] = password_hash($data['pass1'], PASSWORD_DEFAULT);
            $update = $database->prepare("UPDATE users SET Password=:password, Nom=:nom, Email=:email, Prenom=:prenom WHERE id=:id");
            $update->bindParam(':password', $data['Pass']); $update->bindParam(':id', $data['id']);
            $update->bindParam(':nom', $data['Nom']); $update->bindParam(':prenom', $data['Prenom']);
            $update->bindParam(':email', $data['Email']);
            $update->execute();
            return $user;
        }
    }
    else { return null; }
}

function handleLogin() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['Email']) && !empty($_POST['Password'])) {
        try { $user = tryLogin($_POST);
            if (!empty($user)) {
                $sessionDuration = 4 * 60 * 60; // Définir la durée de la session à 4 heures (en secondes)
                $sessionExpiration = time() + $sessionDuration; // Définir le délai d'expiration de la session

                $_SESSION["id"] = $user['id']; $_SESSION["Email"] = $user['Email'];
                $_SESSION["Nom"] = $user['Nom']; $_SESSION["Prenom"] = $user['Prenom'];
                $_SESSION["type_user"] = $user['type_user'];
                
                $_SESSION["expire"] = $sessionExpiration; // Définir l'heure d'expiration de la session
                redirectToDashboard();
            } else { echo 'Identifiants invalides.'; include_once('app/signin.php'); }
        } catch (PDOException $e) { handleDatabaseError($e->getMessage()); }
    } else { include_once('app/signin.php'); }
}

function checkSessionExpiration() {
    if (isset($_SESSION["expire"])) {
        if (time() > $_SESSION["expire"]) { // La session a expiré
            session_unset(); session_destroy(); header("Location: index.php"); exit();
        }
    }
}

function totalCouts($table, $column) { // Fonctions pour le calcul des coûts totaux
    $database = dbConnect();
    $stmt = $database->query("SELECT (SELECT SUM($column) FROM $table) AS total_cout");
    $stmt->execute();
    if($stmt->fetch(PDO::FETCH_ASSOC)['total_cout'] == null){ return 0; }
    else{ return $stmt->fetch(PDO::FETCH_ASSOC)['total_cout']; }
}

function totalCoutP() { return totalCouts('prestations', 'cout_prestation'); }

function totalCoutI() {  return totalCouts('interventions', 'cout_intervention'); }

function totalCoutFormation() {
    $database = dbConnect();
    $stmt = $database->prepare("SELECT SUM(fp.montant_paye) as total_paye FROM FormationParticipantsDetails fp JOIN Formations f ON fp.formation_id = f.id");
    $stmt->execute(); $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalPaye = $result['total_paye']; return $totalPaye === null ? 0 : $totalPaye;
}

function TotalPaidInvoices() {
    $database = dbConnect();    
    $stmt = $database->prepare("SELECT SUM(total_facture) as total FROM Facture WHERE statut = 'payé' ");
    $stmt->execute(); return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

function TotalUnPaidInvoices() {
    $database = dbConnect();   
    $stmt = $database->prepare("SELECT SUM(total_facture) as total FROM Facture WHERE statut = 'non payé' ");
    $stmt->execute(); return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

function getCount($table) { // Fonction générique pour compter les enregistrements
    $database = dbConnect();
    $stmt = $database->query("SELECT COUNT(*) AS count FROM {$table}");
    $stmt->execute(); return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
}

function getAll($table) { // Fonctions pour obtenir tous les enregistrements d'une table spécifique
    $database = dbConnect();
    $stmt = $database->query("SELECT * FROM {$table}");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); return $result;
}

function getById($table, $idColumn, $id) { // Fonctions pour obtenir un enregistrement par ID à partir d'une table spécifique
    $database = dbConnect();
    $stmt = $database->prepare("SELECT * FROM {$table} WHERE {$idColumn} = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute(); return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addRecord($table, $data) { // Fonctions pour ajouter un nouvel enregistrement à une table spécifique
    $database = dbConnect();
    $columns = implode(", ", array_keys($data));
    $values = ":" . implode(", :", array_keys($data));
    $stmt = $database->prepare("INSERT INTO {$table} ({$columns}) VALUES ({$values})");
    foreach ($data as $key => $value) { $stmt->bindValue(":{$key}", $value); }
    $stmt->execute();
}

function deleteRecord($table, $idColumn, $id) { // Fonctions pour supprimer un enregistrement d'une table spécifique
    $database = dbConnect();
    $stmt = $database->prepare("DELETE FROM {$table} WHERE {$idColumn} = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); $stmt->execute();
}

function updateRecord($table, $data, $idColumn, $id) { // Fonctions pour mettre à jour un enregistrement dans une table spécifique
    $database = dbConnect();
    $setClause = implode(", ", array_map(fn($key) => "{$key} = :{$key}", array_keys($data)));
    $stmt = $database->prepare("UPDATE {$table} SET {$setClause} WHERE {$idColumn} = :id");
    foreach ($data as $key => $value) { $stmt->bindValue(":{$key}", $value); }
    $stmt->bindValue(":id", $id, PDO::PARAM_INT); $stmt->execute();
}

// D'autres fonctions spécifiques pour obtenir des enregistrements par ID pour différentes tables
function getCLientById($id) { return getById('clients', 'id', $id); }

function getContactById($id) { return getById('contacts', 'id', $id); }

function getFournisseurById($id) { return getById('fournisseurs', 'id', $id); }

function getInterventionById($id) { return getById('interventions', 'id', $id); }

function getPrestationById($id) { return getById('prestations', 'id', $id); }

function getServiceById($id) { return getById('services', 'id', $id); }

function getUserById($id) { return getById('users', 'id', $id); }

function getFormationById($id) { return getById('Formations', 'id', $id);  }

function getParticipantById($id) { return getById('FormationParticipantsDetails', 'id', $id); }

function getFactureById($id) { return getById('Facture', 'nFacture', $id); }

// Fonctions pour ajouter des enregistrements à différentes tables
function addClient($data) { addRecord('clients', $data); }

function addContact($data) { addRecord('contacts', $data); }

function addFournisseur($data) { addRecord('fournisseurs', $data); }

function addIntervention($data) { addRecord('interventions', $data); }

function addService($data) { addRecord('services', $data); }

function addPrestation($data) { addRecord('prestations', $data); }

function addUser($data) { $data['Password'] = password_hash($data['Password'], PASSWORD_DEFAULT);
    addRecord('users', $data); }

function addFormation($data) { addRecord('Formations', $data); }

function addParticipant($data) { addRecord('FormationParticipantsDetails', $data); }

function addLog($userId, $action) {
    $database = dbConnect(); $stmt = $database->prepare("INSERT INTO log(user_id, action) VALUES(:user_id, :action) ");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT); $stmt->bindParam(':action', $action, PDO::PARAM_STR);
    $stmt->execute();
}

function addFacture($data) {
    $database = dbConnect();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($data['submit'])) {
        // Récupérer les données de la facture depuis le formulaire
        $nom_entreprise = $data['nom_entreprise']; $IFU = $data['IFU']; $RCCM = $data['RCCM']; $divisionFiscale = $data['divisionFiscale'];
        $client_adresse = $data['client_adresse']; $client_telephone = $data['client_téléphone']; $objet_facture = $data['objet_facture'];
    
        $elements = json_decode($data['elements'], true); // Récupérer les éléments de la facture depuis le champ caché JSON
    
        // N Facture
        $nFacture = getCurrentDateTimeString();
    
        $total_facture = 0; foreach ($elements as $element) { $total_facture += $element['total']; } // Calculer le total de la facture
    
        $tva = 0; // Définir la TVA (dans votre cas, c'est 0)
        
        $date_facture = date('Y-m-d');
        
        $database->beginTransaction(); // Début de la transaction

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
        $stmtFacture->bindParam(':tva', $tva); $stmtFacture->execute();

        // Requête pour insérer les éléments de la facture dans la table `element_facture`
        $queryElementFacture = "INSERT INTO `ElementFacture` (`nFacture`, `description`, `quantite`, `prix_unitaire`, `total`)
            VALUES (:nFacture, :description, :quantite, :prix_unitaire, :total)";

        $stmtElementFacture = $database->prepare($queryElementFacture);

        // Boucle pour insérer chaque élément de la facture
        foreach ($elements as $element) {
            $stmtElementFacture->bindParam(':nFacture', $nFacture);
            $stmtElementFacture->bindParam(':description', $element['description']); $stmtElementFacture->bindParam(':quantite', $element['quantite']);
            $stmtElementFacture->bindParam(':prix_unitaire', $element['prix_unitaire']); $stmtElementFacture->bindParam(':total', $element['total']);
            $stmtElementFacture->execute();
        }
        $database->commit(); // Valider la transaction
    }
}

// Fonctions pour supprimer des enregistrements de différentes tables
function removeClient($id) { deleteRecord('clients', 'id', $id); }

function removeContact($id) { deleteRecord('contacts', 'id', $id); }

function removeFournisseur($id) { deleteRecord('fournisseurs', 'id', $id); }

function removeIntervention($id) { deleteRecord('interventions', 'id', $id); }

function removeService($id) { deleteRecord('services', 'id', $id); }

function removePrestation($id) { deleteRecord('prestations', 'id', $id); }

function removeUser($id) { deleteRecord('users', 'id', $id); }

function removeFormation($id) { deleteRecord('Formations', 'id', $id); }

function removeParticipant($id) { deleteRecord('FormationParticipantsDetails', 'id', $id); }

function removeFacture($id) {
    $database = dbConnect();
    $database->beginTransaction(); // Début de la transaction

    $queryDeleteElements = "DELETE FROM `ElementFacture` WHERE `nFacture` = :nFacture"; // Supprimer les éléments de la facture dans la table `elementFacture`
    $stmtDeleteElements = $database->prepare($queryDeleteElements);
    $stmtDeleteElements->bindParam(':nFacture', $id);
    $stmtDeleteElements->execute();

    $queryDeleteFacture = "DELETE FROM `Facture` WHERE `nFacture` = :nFacture"; // Supprimer la facture dans la table `Facture`
    $stmtDeleteFacture = $database->prepare($queryDeleteFacture);
    $stmtDeleteFacture->bindParam(':nFacture', $id);
    $stmtDeleteFacture->execute();
    
    $database->commit(); // Valider la transaction
}

// Fonctions pour mettre à jour des enregistrements dans différentes tables

function updateClient($data) {updateRecord('clients', $data, 'id', $data['id']); }

function updateContact($data) {updateRecord('contacts', $data, 'id', $data['id']); }

function updateFournisseur($data) {updateRecord('fournisseurs', $data, 'id', $data['id']); }

function updateIntervention($data) {updateRecord('interventions', $data, 'id', $data['id']); }

function updateService($data) {updateRecord('services', $data, 'id', $data['id']); }

function updatePrestation($data) {updateRecord('prestations', $data, 'id', $data['id']); }

function updateUser($data) {
    $data['Password'] = password_hash($data['Password'], PASSWORD_DEFAULT);
    updateRecord('users', $data, 'id', $data['id']);
}

function updateFormation($data) {updateRecord('Formations', $data, 'id', $data['id']); }

function updateParticipant($data) {updateRecord('FormationParticipantsDetails', $data, 'id', $data['id']); }

function updateFacture($data) {
    $database = dbConnect();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($data['submit'])) {
        // Récupérer les données de la facture depuis le formulaire
        $nFacture = $data['nFacture']; $nom_entreprise = $data['nom_entreprise'];
        $IFU = $data['IFU']; $RCCM = $data['RCCM']; $divisionFiscale = $data['divisionFiscale'];
        $client_adresse = $data['client_adresse']; $client_telephone = $data['client_telephone']; $objet_facture = $data['objet_facture'];
    
        $elements = json_decode($data['elements'], true); // Récupérer les éléments de la facture depuis le champ caché JSON
    
        $total_facture = 0; // Calculer le total de la facture
        foreach ($elements as $element) { $total_facture += $element['total']; }
        
        $tva = 0;
        $date_facture = date('Y-m-d');
        
        $database->beginTransaction(); // Début de la transaction

        // Requête pour mettre à jour les données dans la table `Facture`
        $queryFacture = "UPDATE `Facture` SET  `date_facture` = :date_facture, `nom_entreprise` = :nom_entreprise,
            `IFU` = :IFU, `RCCM` = :RCCM, `divisionFiscale` = :divisionFiscale, `client_adresse` = :client_adresse,
            `client_telephone` = :client_telephone, `objet_facture` = :objet_facture, `total_facture` = :total_facture,
            `tva` = :tva WHERE `nFacture` = :nFacture";

        $stmtFacture = $database->prepare($queryFacture);
        $stmtFacture->bindParam(':nFacture', $nFacture); $stmtFacture->bindParam(':date_facture', $date_facture);
        $stmtFacture->bindParam(':nom_entreprise', $nom_entreprise); $stmtFacture->bindParam(':IFU', $IFU); $stmtFacture->bindParam(':RCCM', $RCCM);
        $stmtFacture->bindParam(':divisionFiscale', $divisionFiscale); $stmtFacture->bindParam(':client_adresse', $client_adresse);
        $stmtFacture->bindParam(':client_telephone', $client_telephone); $stmtFacture->bindParam(':objet_facture', $objet_facture);
        $stmtFacture->bindParam(':total_facture', $total_facture); $stmtFacture->bindParam(':tva', $tva);
        $stmtFacture->execute();

        // Supprimer les éléments existants de la facture dans la table `ElementFacture`
        $queryDeleteElements = "DELETE FROM `ElementFacture` WHERE `nFacture` = :nFacture";
        $stmtDeleteElements = $database->prepare($queryDeleteElements);
        $stmtDeleteElements->bindParam(':nFacture', $nFacture); $stmtDeleteElements->execute();

        // Requête pour insérer les nouveaux éléments de la facture dans la table `ElementFacture`
        $queryElementFacture = "INSERT INTO `ElementFacture` (`nFacture`, `description`, `quantite`, `prix_unitaire`, `total`)
            VALUES (:nFacture, :description, :quantite, :prix_unitaire, :total)";

        $stmtElementFacture = $database->prepare($queryElementFacture);

        // Boucle pour insérer chaque élément de la facture
        foreach ($elements as $element) {
            $stmtElementFacture->bindParam(':nFacture', $nFacture);
            $stmtElementFacture->bindParam(':description', $element['description']); $stmtElementFacture->bindParam(':quantite', $element['quantite']);
            $stmtElementFacture->bindParam(':prix_unitaire', $element['prix_unitaire']); $stmtElementFacture->bindParam(':total', $element['total']);
            $stmtElementFacture->execute();
        }
        $database->commit();
    }
}

// Fonctions pour lire des enregistrements dans différentes tables

function getClients() { return getAll('clients'); }

function getContacts()  { return getAll('contacts'); }

function getInterventions() { return getAll('interventions'); }

function getPrestations() { return getAll('prestations'); }

function getServices() { return getAll('services'); }

function getUsers() { return getAll('users'); }

function getFormation() { return getAll('Formations'); }

function getParticipant() {
    $database = dbConnect();
    $stmt = $database->query("SELECT * FROM formationparticipantsdetails  WHERE formation_id >= 1 ORDER BY formation_id ASC, participant_nom ASC, participant_prenom ASC");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); return $result;
}

function getFacture() { return getAll('Facture'); }

function getFournisseurs() { return getAll('fournisseurs'); }

function getFactureElementByF($id) { 
    $database = dbConnect();
    $stmt = $database->prepare("SELECT * FROM `ElementFacture` WHERE nFacture = :nFacture");
    $stmt->bindParam(':nFacture', $id, PDO::PARAM_STR); $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); return $result;
}

function CoutInterventionByType($type) { //Fonction qui calcul le couts total par type
    $database = dbConnect();
    $stmt = $database->query("SELECT SUM(cout_intervention) AS total_cout_by_type FROM interventions WHERE type_intervention = $type");
    $stmt->execute(); return $stmt->fetch(PDO::FETCH_ASSOC)['total_cout_by_type'];
}

// Fonctions pour lire le nombres d'enregistrements dans différentes tables

function getNbClient() { return getCount('clients'); }

function getNbIntervention() { return getCount('interventions'); }

function getNbPrestation() { return getCount('prestations'); }

function getNbService() { return getCount('services'); }

function countInvoices() { return getCount('Facture'); }

function getNbParticipant() {
    $database = dbConnect();
    $stmt = $database->prepare("SELECT COUNT(*) as total FROM FormationParticipantsDetails");
    $stmt->execute(); return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

function countUpcomingFormations() {
    $database = dbConnect();
    $stmt = $database->prepare("SELECT COUNT(*) as total FROM Formations");
    $stmt->execute(); return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

function countPaidInvoices() {
    $database = dbConnect();     
    $stmt = $database->prepare("SELECT COUNT(*) as total_payees FROM Facture WHERE statut = 'payé' ");
    $stmt->execute(); return $stmt->fetch(PDO::FETCH_ASSOC)['total_payees'];
}

function countUnpaidInvoices() {
    $database = dbConnect();
    $stmt = $database->prepare("SELECT COUNT(*) as total_non_payees FROM Facture WHERE statut = 'non payé'");
    $stmt->execute(); return $stmt->fetch(PDO::FETCH_ASSOC)['total_non_payees'];
}

function numberToWords($number) {
    $hyphen      = '-'; $conjunction = ' '; $separator   = ' '; $negative    = 'moins '; $decimal     = ' point ';

    $dictionary  = [ 0 => 'zéro', 1 => 'un', 2 => 'deux', 3 => 'trois', 4 => 'quatre', 5 => 'cinq', 6 => 'six', 7 => 'sept', 8 => 'huit',
        9 => 'neuf', 10 => 'dix', 11 => 'onze', 12 => 'douze', 13 => 'treize', 14 => 'quatorze', 15 => 'quinze', 16 => 'seize', 17 => 'dix-sept',
        18 => 'dix-huit', 19 => 'dix-neuf', 20 => 'vingt', 30 => 'trente', 40 => 'quarante', 50 => 'cinquante', 60 => 'soixante', 70 => 'soixante-dix',
        80 => 'quatre-vingt', 90 => 'quatre-vingt-dix', 100 => 'cent', 1000 => 'mille', 1000000 => 'million', 1000000000 => 'milliard' ];
    
    if (!is_numeric($number)) { return false; }
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        trigger_error(
            'numberToWords only accepts numbers between ' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
        );
        return false;
    }
    if ($number < 0) { return $negative . numberToWords(abs($number)); }
    $string = $fraction = null;
    if (strpos($number, '.') !== false) { list($number, $fraction) = explode('.', $number); }
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10; $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100; $remainder = $number % 100;
            $string = $dictionary[(int) $hundreds] . ' ' . $dictionary[100];
            if ($remainder) { $string .= $conjunction . numberToWords($remainder); }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit); $remainder = $number % $baseUnit;
            $string = numberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator; $string .= numberToWords($remainder);
            }
            break;
    }
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal; $words = [];
        foreach (str_split((string) $fraction) as $number) { $words[] = $dictionary[$number]; }
        $string .= implode(' ', $words);
    }
    return $string;
}

function checkUserSessionAndAction() {
    $action = isset($_GET['action']) ? $_GET['action'] : '';

    if (!isset($_SESSION['type_user'])) { include_once('app/404.php'); exit();} // Vérifier si $_SESSION['type_user'] est défini

    switch ($_SESSION['type_user']) { // Vérifier les conditions basées sur le type d'utilisateur et l'action
        case 1: // Type d'utilisateur 1 : autorisé pour toutes les actions
            return;
            break;
        
        case 2: // Type d'utilisateur 2 : autorisé pour 'add', 'update' seulement
            if (($action == 'update' || $action == 'add')) { return; }
            else { include_once('app/404.php'); exit(); }
            break;
        
        case 3: // Type d'utilisateur 3 : aucune autorisation
            break;
        
        default: // Pour tout autre type d'utilisateur, redirection vers la page 404
            break;
    }
    include_once('app/404.php'); exit();
}