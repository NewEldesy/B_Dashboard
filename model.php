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

//Ajout un chauffeurs
function addChauffeur($data) {
    $database = dbConnect();
    $stmt = $database->prepare("INSERT INTO Chauffeurs SET Nom=:Nom, Prenom=:Prenom");
    $stmt->bindParam(":Nom", $data['Nom']);
    $stmt->bindParam(":Prenom", $data['Prenom']);
    $stmt->execute();
}	

//Ajout une panne
function addPanne($data) {
    $database = dbConnect();
    $stmt = $database->prepare("INSERT INTO Pannes SET TaxiID=:TaxiID, DatePanne=:DatePanne, Description=:Description");
    $stmt->bindParam(":TaxiID", $data['TaxiID']);
    $stmt->bindParam(":DatePanne", $data['DatePanne']);
    $stmt->bindParam(":Description", $data['Description']);
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

//Ajout une attribution
function addAttribution($data) {
    $database = dbConnect();
    $stmt = $database->prepare("INSERT INTO AttributionTaxiChauffeur SET TaxiID=:TaxiID, ChauffeurID=:ChauffeurID, DateDebut=:DateDebut, DateFin=:DateFin");
    $stmt->bindParam(":TaxiID", $data['TaxiID']);
    $stmt->bindParam(":ChauffeurID", $data['ChauffeurID']);
    $stmt->bindParam(":DateDebut", $data['DateDebut']);
    $stmt->bindParam(":DateFin", $data['DateFin']);
    $stmt->execute();
}

//Suppression un taxi
function removeUser($id) {
    $database = dbConnect();
    $query = "DELETE FROM User WHERE UserID=" . $id;
    $stmt = $database->prepare($query);
    $stmt->execute();
}

//Suppression un taxi
function removeTaxi($id) {
    $database = dbConnect();
    $query = "DELETE FROM Taxis WHERE TaxiID=" . $id;
    $stmt = $database->prepare($query);
    $stmt->execute();
}

//Suppression un chauffeur
function removeChauffeur($id) {
    $database = dbConnect();
    $query = "DELETE FROM Chauffeurs WHERE ChauffeurID=" . $id;
    $stmt = $database->prepare($query);
    $stmt->execute();
}

//Suppression une panne
function removePanne($id) {
    $database = dbConnect();
    $query = "DELETE FROM Pannes WHERE PanneID=" . $id;
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

//Suppression une attribution
function removeAttribution($id) {
    $database = dbConnect();
    $query = "DELETE FROM 	AttributionTaxiChauffeur WHERE AttributionID=" . $id;
    $stmt = $database->prepare($query);
    $stmt->execute();
}

//Update Taxi
function updateUser($data) {
    $database = dbConnect();
    $stmt = $database->prepare("UPDATE User SET Nom=:Nom, Prenom=:Prenom, Email=:Email, Password=:Password WHERE UserID=:UserID");
    $mdp = md5($data['Email']);
    $stmt->bindParam(":Nom", $data['Nom']);
    $stmt->bindParam(":Prenom", $data['Prenom']);
    $stmt->bindParam(":Email", $data['Email']);
    $stmt->bindParam(":Password", $mdp);
    $stmt->bindParam(":UserID", $data['UserID']);
    $stmt->execute();
}

//Update Taxi
function updateTaxi($data) {
    $database = dbConnect();
    $stmt = $database->prepare("UPDATE Taxis SET Marque=:Marque, NumeroPlaque=:NumeroPlaque, DateMiseEnCirculation=:DateMiseEnCirculation WHERE TaxiID=:TaxiID");
    $stmt->bindParam(":Marque", $data['Marque']);
    $stmt->bindParam(":NumeroPlaque", $data['NumeroPlaque']);
    $stmt->bindParam(":DateMiseEnCirculation", $data['DateMiseEnCirculation']);
    $stmt->bindParam(":TaxiID", $data['TaxiID']);
    $stmt->execute();
}

//Update Chauffeur
function updateChauffeur($data) {
    $database = dbConnect();
    $stmt = $database->prepare("UPDATE Chauffeurs SET Nom=:Nom, Prenom=:Prenom WHERE ChauffeurID=:ChauffeurID");
    $stmt->bindParam(":Nom", $data['Nom']);
    $stmt->bindParam(":Prenom", $data['Prenom']);
    $stmt->bindParam(":ChauffeurID", $data['ChauffeurID']);
    $stmt->execute();
}

//Update Versement
function updateVersement($data) {
    $database = dbConnect();
    $stmt = $database->prepare("UPDATE Versements SET ChauffeurID=:ChauffeurID, Montant=:Montant, DateVersement=:DateVersement,  TaxiID=:TaxiID WHERE VersementID=:VersementID");
    $stmt->bindParam(":ChauffeurID", $data['ChauffeurID']);
    $stmt->bindParam(":Montant", $data['Montant']);
    $stmt->bindParam(":DateVersement", $data['DateVersement']);
    $stmt->bindParam(":TaxiID", $data['TaxiID']);
    $stmt->bindParam(":VersementID", $data['VersementID']);
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