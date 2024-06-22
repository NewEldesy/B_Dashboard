<?php
// Connection a la base de données
function dbConnect() {
    try {
        $database = new PDO('mysql:host=mysql-btechgroup.alwaysdata.net;dbname=btechgroup_dashboard;charset=utf8', '364785', 'w!Z7ntgLcLYE9NU');
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //return $database;
    } catch (PDOException $e) {
        // Gérer l'erreur de connexion, consigner ou afficher un message d'erreur
        exit("Erreur de connexion à la base de données : " . $e->getMessage());
    }

    return $database;
}

//Connexion User
function tryLogin($data) {
    $database = dbConnect();
    $query = "SELECT * FROM User WHERE Email = :email";
    $stmt = $database->prepare($query);
    $stmt->bindParam(':email', $data['Email']);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($user) && password_verify($data['Password'], $user['Password'])) {
        return $user;
    } else {
        return null;
    }
}

//Compter le nombre de taxi enregistrer
function CompteTaxis() {
    $database = dbConnect();
    $stmt = $database->query("SELECT COUNT(*) FROM Taxis");
    $stmt->execute();
    $stmt->bindColumn(1, $compte);
    $stmt->fetch(PDO::FETCH_ASSOC);

    return $compte;
}

//Compter le nombre de chauffeur enregistrer
function CompteChauffeurs() {
    $database = dbConnect();
    $stmt = $database->query("SELECT COUNT(*) FROM Chauffeurs");
    $stmt->execute();
    $stmt->bindColumn(1, $compte);
    $stmt->fetch(PDO::FETCH_ASSOC);

    return $compte;
}

//Compter le nombre de Panne enregistrer
function ComptePannes() {
    $database = dbConnect();
    $stmt = $database->query("SELECT COUNT(*) FROM Pannes");
    $stmt->execute();
    $stmt->bindColumn(1, $compte);
    $stmt->fetch(PDO::FETCH_ASSOC);

    return $compte;
}

//Compter le nombre de Versement enregistrer
function CompteVersements() {
    $database = dbConnect();
    $stmt = $database->query("SELECT COUNT(*) FROM 	Versements");
    $stmt->execute();
    $stmt->bindColumn(1, $compte);
    $stmt->fetch(PDO::FETCH_ASSOC);

    return $compte;
}

//récuppérer les utilisateurs enregistrer
function getUser() {
    $database = dbConnect();
    $statement = $database->query("SELECT * FROM User");
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

//récuppére un utilisateur par son id
function getUserById($id) {
    $database = dbConnect();
    $statement = $database->prepare("SELECT * FROM User WHERE userID = :id");
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

//récuppérer les taxis enregistrer
function getTaxi() {
    $database = dbConnect();
    $statement = $database->query("SELECT * FROM Taxis");
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

//récuppére un taxi par son id
function getTaxiById($id) {
    $database = dbConnect();
    $statement = $database->prepare("SELECT * FROM Taxis WHERE TaxiID = :id");
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

//récuppérer les versements enregistrer
function getVersement() {
    $database = dbConnect();
    $statement = $database->query("SELECT * FROM Versements");
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

//récuppére un versement par son id
function getVersementById($id) {
    $database = dbConnect();
    $statement = $database->prepare("SELECT * FROM Versements WHERE VersementID = :id");
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

//Récuppérer les 10 dernières versement
function getLastVersements() {
    $database = dbConnect();
    $statement = $database->query("SELECT * FROM Versements ORDER BY VersementID DESC LIMIT 10");
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

//récuppérer les pannes enregistrer
function getPanne() {
    $database = dbConnect();
    $statement = $database->query("SELECT * FROM Pannes");
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

//récuppére une panne par son id
function getPanneById($id) {
    $database = dbConnect();
    $statement = $database->prepare("SELECT * FROM Pannes WHERE PanneID = :id");
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

//Récuppérer les 10 dernières pannes
function getLastPannes() {
    $database = dbConnect();
    $statement = $database->query("SELECT * FROM Pannes ORDER BY PanneID DESC LIMIT 10");
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

//récuppérer les chauffeurs enregistrer
function getChauffeur() {
    $database = dbConnect();
    $statement = $database->query("SELECT * FROM Chauffeurs");
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

//récuppére un chauffeur par son id
function getChauffeurById($id) {
    $database = dbConnect();
    $statement = $database->prepare("SELECT * FROM Chauffeurs WHERE ChauffeurID = :id");
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

//récuppérer les attributions de taxis aux chauffeurs enregistrer
function getAttribution() {
    $database = dbConnect();
    $statement = $database->query("SELECT * FROM AttributionTaxiChauffeur");
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

//récuppére une attribution par son id
function getAttributionById($id) {
    $database = dbConnect();
    $statement = $database->prepare("SELECT * FROM AttributionTaxiChauffeur WHERE AttributionID = :id");
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

//Add Client
function addClient($data) {
    $database = dbConnect();
    $stmt = $database->prepare("INSERT INTO clients (nom, prenom, adresse, ville, telephone) VALUES (:Nom, :Prenom, :Adresse, :Ville, :Telephone)");
    $stmt->bindParam(":Nom", $data['client_name']);
    $stmt->bindParam(":Prenom", $data['client_pname']);
    $stmt->bindParam(":Adresse", $data['client_addresse']);
    $stmt->bindParam(":Ville", $data['client_ville']);
    $stmt->bindParam(":Telephone", $data['client_tel']);
    $stmt->execute();
}

//Add Interventions
function addIntervention($data) {
    $database = dbConnect();
    $stmt = $database->prepare("INSERT INTO interventions SET client_id=:client_id, description_intervention=:description_i, type_intervention=:type_i");
    $stmt->bindParam(":client_id", $data['intv_client']);
    $stmt->bindParam(":description_i", $data['intv_description']);
    $stmt->bindParam(":type_i", $data['intv_type']);
    $stmt->execute();
}

//Add Services
function addService($data) {
    $database = dbConnect();
    $stmt = $database->prepare("INSERT INTO services SET libelle_services=:libelle_services");
    $stmt->bindParam(":libelle_services", $data['serv_title']);
    $stmt->execute();
}	

//Add Prestations		
function addPrestations($data) {
    $database = dbConnect();
    $stmt = $database->prepare("INSERT INTO prestations SET client_id=:client_id, type_prestation=:type_p, description_prestation=:description_p, 
    date_debut_prestation=:date_start, date_fin_prestation=:date_end, statut_prestation=:statut");
    $stmt->bindParam(":client_id", $data['prest_client']);
    $stmt->bindParam(":type_p", $data['intv_type']);
    $stmt->bindParam(":description_p", $data['prest_desc']);
    $stmt->bindParam(":date_start", $data['date_start']);
    $stmt->bindParam(":date_end", $data['date_end']);
    $stmt->bindParam(":statut", $data['prest_statut']);
    $stmt->execute();
}

//Ajout un versement
function addVersement($data) {
    $database = dbConnect();
    $stmt = $database->prepare("INSERT INTO Versements SET ChauffeurID=:ChauffeurID, Montant=:Montant, DateVersement=:DateVersement, TaxiID=:TaxiID");
    $stmt->bindParam(":ChauffeurID", $data['ChauffeurID']);
    $stmt->bindParam(":Montant", $data['Montant']);
    $stmt->bindParam(":DateVersement", $data['DateVersement']);
    $stmt->bindParam(":TaxiID", $data['TaxiID']);
    $stmt->execute();
}

//Delete Client
function removeClient($id) {
    $database = dbConnect();
    $query = "DELETE FROM clients WHERE client_id=" . $id;
    $stmt = $database->prepare($query);
    $stmt->execute();
}

//Delete Interventions
function removeInterventions($id) {
    $database = dbConnect();
    $query = "DELETE FROM interventions WHERE id=" . $id;
    $stmt = $database->prepare($query);
    $stmt->execute();
}

//Delete Services
function removeServices($id) {
    $database = dbConnect();
    $query = "DELETE FROM services WHERE id=" . $id;
    $stmt = $database->prepare($query);
    $stmt->execute();
}

//Delete Prestations
function removePrestations($id) {
    $database = dbConnect();
    $query = "DELETE FROM prestations WHERE id=" . $id;
    $stmt = $database->prepare($query);
    $stmt->execute();
}

//Suppression un versement
function removeVersement($id) {
    $database = dbConnect();
    $query = "DELETE FROM Versements WHERE VersementID=" . $id;
    $stmt = $database->prepare($query);
    $stmt->execute();
}

//Update Client
function updateUser($data) {
    $database = dbConnect();
    $stmt = $database->prepare("UPDATE clients SET Nom=:Nom, Prenom=:Prenom, Adresse=:Adresse, Ville=:Ville Telephone=:Telephone WHERE client_id=:ID");
    $stmt->bindParam(":Nom", $data['client_name']);
    $stmt->bindParam(":Prenom", $data['client_pname']);
    $stmt->bindParam(":Adresse", $data['client_addresse']);
    $stmt->bindParam(":Ville", $data['client_ville']);
    $stmt->bindParam(":Telephone", $data['client_tel']);
    $stmt->bindParam(":ID", $data['client_id']);
    $stmt->execute();
}

//Update Interventions
function updateTaxi($data) {
    $database = dbConnect();
    $stmt = $database->prepare("UPDATE interventions SET client_id=:client_id, type_intervention=:type_i, description_intervention=:type_i WHERE TaxiID=:ID");
    $stmt->bindParam(":client_id", $data['intv_client']);
    $stmt->bindParam(":description_i", $data['intv_description']);
    $stmt->bindParam(":type_i", $data['intv_type']);
    $stmt->bindParam(":ID", $data['TaxiID']);
    $stmt->execute();
}

//Update Services
function updateChauffeur($data) {
    $database = dbConnect();
    $stmt = $database->prepare("UPDATE services SET libelle_services=:libelle_s WHERE id=:ID");
    $stmt->bindParam(":libelle_s", $data['serv_title']);
    $stmt->bindParam(":ID", $data['serv_id']);
    $stmt->execute();
}

//Update Prestations
function updatePrestation($data) {
    $database = dbConnect();
    $stmt = $database->prepare("UPDATE prestations SET client_id=:client_id, type_prestation=:type_p, description_prestation=:description_p,  date_debut_prestation=:date_start, 
    date_fin_prestation=:date_end, statut_prestation=:statut WHERE id=:ID");
    $stmt->bindParam(":client_id", $data['prest_client']);
    $stmt->bindParam(":type_p", $data['prest_type']);
    $stmt->bindParam(":description_p", $data['prest_desc']);
    $stmt->bindParam(":date_start", $data['date_start']);
    $stmt->bindParam(":date_end", $data['date_end']);
    $stmt->bindParam(":statut", $data['prest_statut']);
    $stmt->bindParam(":ID", $data['prest_id']);
    $stmt->execute();
}

//Update Panne
function updatePanne($data) {
    $database = dbConnect();
    $stmt = $database->prepare("UPDATE Pannes SET TaxiID=:TaxiID, DatePanne=:DatePanne, Description=:Description WHERE PanneID=:PanneID");
    $stmt->bindParam(":TaxiID", $data['TaxiID']);
    $stmt->bindParam(":DatePanne", $data['DatePanne']);
    $stmt->bindParam(":Description", $data['Description']);
    $stmt->bindParam(":PanneID", $data['PanneID']);
    $stmt->execute();
}

//Update Attribution
function updateAttribution($data) {
    $database = dbConnect();
    $stmt = $database->prepare("UPDATE AttributionTaxiChauffeur SET TaxiID=:TaxiID, ChauffeurID=:ChauffeurID, DateDebut=:DateDebut, DateFin=:DateFin WHERE AttributionID=:AttributionID");
    $stmt->bindParam(":TaxiID", $data['TaxiID']);
    $stmt->bindParam(":ChauffeurID", $data['ChauffeurID']);
    $stmt->bindParam(":DateDebut", $data['DateDebut']);
    $stmt->bindParam(":DateFin", $data['DateFin']);
    $stmt->bindParam(":AttributionID", $data['AttributionID']);
    $stmt->execute();
}

// Redirection vers le dashboard
function redirectToDashboard() {
    // Fonction pour rediriger vers le tableau de bord
    header('location: index.php?page=dashboard');
    exit;
}