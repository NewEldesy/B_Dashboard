<?php
require('assets/pdflib/fpdf182/fpdf.php');

//Get nFacture
$nFacture = $_GET['id'];
class PDF extends FPDF {
    function Header() {
        $largeurTableau = $this->GetPageWidth() * 0.9;
        $f = getFactureById($_GET['id']);

        //Logo
        $this->Image('assets/img/logo_1.jpeg',10,8,10); $this->Ln(15);
        //Police Arial gras 12
        $this->SetFont('Arial', 'B', 10);
        //Nom Entreprise
        $this->Cell($largeurTableau / 2, 5, utf8_decode('B\'Tech Group SAS'), 0, 0, 'L');
        //Facture
        $this->Cell($largeurTableau / 2, 5, utf8_decode('FACTURE'), 0, 1, 'R');
        
        $this->SetFont('Arial', '', 7);
        // Infos Entreprise
        $this->Cell($largeurTableau / 2, 5, utf8_decode('Sise à la ZONE 1, Secteur 28'), 0, 0, 'L');
        // Infos Facture
        $this->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 1, 'R');
        // Infos Entreprise
        $this->Cell($largeurTableau / 2, 5, utf8_decode('Tél : (+226) 06 36 76 82'), 0, 0, 'L');
        // Infos Facture
        $this->Cell($largeurTableau / 2, 5, utf8_decode('N° Facture : ' . $_GET['id']), 0, 1, 'R');
        // Infos Entreprise
        $this->Cell($largeurTableau / 2, 5, utf8_decode('Email : btechgroup4@gmail.com'), 0, 0, 'L');
        // Infos Facture
        $this->Cell($largeurTableau / 2, 5, utf8_decode('Date : '. $f['date_facture']), 0, 1, 'R');
        // Infos Entreprise
        $this->Cell($largeurTableau / 2, 5, utf8_decode('N°IFU : 00179631E'), 0, 0, 'L');
        // Infos Facture
        $this->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 1, 'R');
    }
    
    function Footer() {
        $largeurTableau = $this->GetPageWidth() * 0.9;
        //Positionnement à 5,5 cm du bas
        $this->SetY(-50);
        //
        $this->SetFont('Arial', 'B', 10);
        $this->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 0, 'L'); // Élément 1 aligné à gauche
        $this->Cell($largeurTableau / 2, 5, utf8_decode('Le Président'), 0, 1, 'R');
        $this->Ln(15); // Saut de ligne
        $this->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 0, 'L'); // Élément 1 aligné à gauche
        $this->Cell($largeurTableau / 2, 5, utf8_decode('Limapa LOMPO'), 0, 1, 'R');
        $this->Ln(5);
        //
        $this->SetFont('Arial', '', 7);
        $this->Cell(0, 5, utf8_decode('Katr-Yaar Secteur 28-Section :114-01 BP 136 Ouagadougou 01-Tél : (00226) 06 36 76 82 / 71 63 08 50'), 0, 0, 'C');
        $this->Ln(4);
        $this->Cell(0, 5, utf8_decode('N°IFU 00179631E-R.C.C.M N° BF-OUA-01-2022-B16-5095-Regime Fiscal : Régime Simplifie d\'imposition'), 0, 0, 'C');
        $this->Ln(4);
        $this->Cell(0, 5, utf8_decode('Compte n°: BCB: 0501170024801-30-S.A.S au Capital de 1 000 000 FCFA'), 0, 0, 'C');
        $this->Ln(4);
        $this->Cell(0, 5, utf8_decode('E-mail: btechgroup4@gmail.com Site Web: btechgroupsas.com'), 0, 0, 'C');
    }
}

//Instanciation de la classe dérivée
$pdf=new PDF('P', 'mm', 'A4');
$pdf->AddPage();

$largeurTableau = $pdf->GetPageWidth() * 0.9;
//
$f = getFactureById($_GET['id']);
//
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->Cell($largeurTableau / 2, 5, utf8_decode('Client :'), 0, 1, 'R');
//
$pdf->SetFont('Arial', '', 8);
$pdf->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->Cell($largeurTableau / 2, 5, utf8_decode('Entreprie :'.$f['nom_entreprise']), 0, 1, 'R');
//
$pdf->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->Cell($largeurTableau / 2, 5, utf8_decode('Adresse :'.$f['client_adresse']), 0, 1, 'R');
//
$pdf->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->Cell($largeurTableau / 2, 5, utf8_decode('Téléphone :'.$f['client_telephone']), 0, 1, 'R');
//
$pdf->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->Cell($largeurTableau / 2, 5, utf8_decode('IFU : '.$f['IFU']), 0, 1, 'R');
//
$pdf->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->Cell($largeurTableau / 2, 5, utf8_decode('RCCM : '.$f['RCCM']), 0, 1, 'R');
//
$pdf->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->Cell($largeurTableau / 2, 5, utf8_decode('Division Fiscale : '.$f['divisionFiscale']), 0, 1, 'R');

// Titre de la facture
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, utf8_decode('Objet : '.$f['objet_facture']), 0, 1, 'L');

// Détails de la facture
$pdf->Ln(5); // Saut de ligne
$pdf->SetFont('Arial', '', 7);
// Définir la couleur de fond grise
$pdf->SetFillColor(200, 200, 200);
//
$pdf->Cell($largeurTableau * 0.5, 8, utf8_decode('Description'), 1, 0, 'C', true);
$pdf->Cell($largeurTableau * 0.1, 8, utf8_decode('Quantite'), 1, 0, 'C', true);
$pdf->Cell($largeurTableau * 0.2, 8, utf8_decode('Prix Unitaire'), 1, 0, 'C', true);
$pdf->Cell($largeurTableau * 0.2, 8, utf8_decode('Total'), 1, 1, 'C', true);

// Définir la couleur de fond grise
$pdf->SetFillColor(220, 220, 220);
// Liste Element
$elements = getFactureElementByF($_GET['id']);
foreach ($elements as $element) {
    $pdf->Cell($largeurTableau * 0.5, 8, utf8_decode($element['description']), 0, 0, '', true);
    $pdf->Cell($largeurTableau * 0.1, 8, $element['quantite'], 0, 0, 'C', true);
    $pdf->Cell($largeurTableau * 0.2, 8, $element['prix_unitaire'], 0, 0, 'C', true);
    $pdf->Cell($largeurTableau * 0.2, 8, $element['total'], 0, 1, 'C', true);
}

// Définir la couleur de fond grise
$pdf->SetFillColor(240, 240, 240);
// Total
$pdf->Cell($largeurTableau * 0.8, 8, utf8_decode('Total H.TVA : '), 0, 0, 'R');
$pdf->Cell($largeurTableau * 0.2, 8, (''.$f['total_facture']), 0, 1, 'C', true);
// TVA
$pdf->Cell($largeurTableau * 0.8, 8, utf8_decode('TVA 18% : '), 0, 0, 'R');
$pdf->Cell($largeurTableau * 0.2, 8, (''.$f['tva']), 0, 1, 'C', true);
// Total Net à Payer
$pdf->Cell($largeurTableau * 0.8, 8, utf8_decode('Total Net à Payer : '), 0, 0, 'R');
$pdf->Cell($largeurTableau * 0.2, 8, (''.$f['total_facture']), 0, 1, 'C', true);

//
$pdf->Ln(5); // Saut de ligne

//
$pdf->SetFont('Arial', 'I', 7);
$pdf->Cell(0, 5, utf8_decode('Arreter la présente facture à la somme de '.numberToWords(intval($f['total_facture'])).' francs cfa ('.intval($f['total_facture']).')'), 0, 1, 'L');

// Générer le nom du fichier avec la date et l'heure actuelles
$nomFichier = 'Facture Proforma' . $_GET['id'] . '.pdf';

$pdf->Output($nomFichier, 'I');
?>