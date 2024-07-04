<?php
include_once('model.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    // Récupérer les données de la facture depuis le formulaire
    $nom_entreprise = $_POST['nom_entreprise'];
    $IFU = $_POST['IFU'];
    $RCCM = $_POST['RCCM'];
    $divisionFiscale = $_POST['divisionFiscale'];
    $client_adresse = $_POST['client_adresse'];
    $client_telephone = $_POST['client_téléphone'];
    $objet_facture = $_POST['objet_facture'];

    // Récupérer les éléments de la facture depuis le champ caché JSON
    $elements = json_decode($_POST['elements'], true);

    // N Facture
    $nFacture = getCurrentDateTimeString();

    // Calculer le total de la facture
    $total_facture = 0;
    foreach ($elements as $element) {
        $total_facture += $element['total'];
    }

    // Définir la TVA (dans votre cas, c'est 0)
    $tva = 0;

    // Date d'émission de la facture (actuelle)
    $date_facture = date('Y-m-d');

    try {
        // Connexion à la base de données
        $database = dbConnect();

        // Début de la transaction
        $database->beginTransaction();

        // Requête pour insérer les données dans la table `facture`
        $queryFacture = "INSERT INTO `Facture` (
            `nFacture`, `date_facture`, `nom_entreprise`, `IFU`, `RCCM`, `divisionFiscale`, 
            `client_adresse`, `client_telephone`, `objet_facture`, `total_facture`, `tva`
        ) VALUES (
            :nFacture, :date_facture, :nom_entreprise, :IFU, :RCCM, :divisionFiscale, 
            :client_adresse, :client_telephone, :objet_facture, :total_facture, :tva
        )";

        $stmtFacture = $database->prepare($queryFacture);
        $stmtFacture->bindParam(':nFacture', $nFacture);
        $stmtFacture->bindParam(':date_facture', $date_facture);
        $stmtFacture->bindParam(':nom_entreprise', $nom_entreprise);
        $stmtFacture->bindParam(':IFU', $IFU);
        $stmtFacture->bindParam(':RCCM', $RCCM);
        $stmtFacture->bindParam(':divisionFiscale', $divisionFiscale);
        $stmtFacture->bindParam(':client_adresse', $client_adresse);
        $stmtFacture->bindParam(':client_telephone', $client_telephone);
        $stmtFacture->bindParam(':objet_facture', $objet_facture);
        $stmtFacture->bindParam(':total_facture', $total_facture);
        $stmtFacture->bindParam(':tva', $tva);
        $stmtFacture->execute();

        // Récupérer l'ID de la dernière facture insérée
        $lastInsertId = $nFacture;

        // Requête pour insérer les éléments de la facture dans la table `element_facture`
        $queryElementFacture = "INSERT INTO `ElementFacture` (
            `nFacture`, `description`, `quantite`, `prix_unitaire`, `total`
        ) VALUES (
            :nFacture, :description, :quantite, :prix_unitaire, :total
        )";

        $stmtElementFacture = $database->prepare($queryElementFacture);

        // Boucle pour insérer chaque élément de la facture
        foreach ($elements as $element) {
            $stmtElementFacture->bindParam(':nFacture', $lastInsertId);
            $stmtElementFacture->bindParam(':description', $element['description']);
            $stmtElementFacture->bindParam(':quantite', $element['quantite']);
            $stmtElementFacture->bindParam(':prix_unitaire', $element['prix_unitaire']);
            $stmtElementFacture->bindParam(':total', $element['total']);
            $stmtElementFacture->execute();
        }

        // Valider la transaction
        $database->commit();

        // Redirection après l'enregistrement réussi
        $message = 'Facture enregistrée avec succès.';
        header("Location: index.php?page=facture");
        exit();

    } catch (PDOException $ex) {
        // En cas d'erreur, annuler la transaction et afficher l'erreur
        if (isset($database)) {
            $database->rollback();
        }
        echo "Erreur : " . $ex->getMessage();
        exit();
    }
}
?>