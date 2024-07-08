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
        $this->CellUTF8($largeurTableau / 2, 5, 'B\'Tech Group SAS', 0, 0, 'L');
        //Facture
        $this->CellUTF8($largeurTableau / 2, 5, 'FACTURE', 0, 1, 'R');
        
        $this->SetFont('Arial', '', 7);
        // Infos Entreprise
        $this->CellUTF8($largeurTableau / 2, 5, 'Sise à la ZONE 1, Secteur 28', 0, 0, 'L');
        // Infos Facture
        $this->CellUTF8($largeurTableau / 2, 5, '', 0, 1, 'R');
        // Infos Entreprise
        $this->CellUTF8($largeurTableau / 2, 5, 'Tél : (+226) 06 36 76 82', 0, 0, 'L');
        // Infos Facture
        $this->CellUTF8($largeurTableau / 2, 5, 'N° Facture : ' . $_GET['id'], 0, 1, 'R');
        // Infos Entreprise
        $this->CellUTF8($largeurTableau / 2, 5, 'Email : btechgroup4@gmail.com', 0, 0, 'L');
        // Infos Facture
        $this->CellUTF8($largeurTableau / 2, 5, 'Date : '. $f['date_facture'], 0, 1, 'R');
        // Infos Entreprise
        $this->CellUTF8($largeurTableau / 2, 5, 'N°IFU : 00179631E', 0, 0, 'L');
        // Infos Facture
        $this->CellUTF8($largeurTableau / 2, 5, '', 0, 1, 'R');
    }
    
    function Footer() {
        $largeurTableau = $this->GetPageWidth() * 0.9;
        //Positionnement à 5,5 cm du bas
        $this->SetY(-50);
        //
        $this->SetFont('Arial', 'B', 10);
        $this->CellUTF8($largeurTableau / 2, 5, '', 0, 0, 'L'); // Élément 1 aligné à gauche
        $this->CellUTF8($largeurTableau / 2, 5, 'Le Président', 0, 1, 'R');
        $this->Ln(15); // Saut de ligne
        $this->CellUTF8($largeurTableau / 2, 5, '', 0, 0, 'L'); // Élément 1 aligné à gauche
        $this->CellUTF8($largeurTableau / 2, 5, 'Limapa LOMPO', 0, 1, 'R');
        $this->Ln(5);
        //
        $this->SetFont('Arial', '', 7);
        $this->CellUTF8(0, 5, 'Katr-Yaar Secteur 28-Section :114-01 BP 136 Ouagadougou 01-Tél : (00226) 06 36 76 82 / 71 63 08 50', 0, 0, 'C');
        $this->Ln(4);
        $this->CellUTF8(0, 5, 'N°IFU 00179631E-R.C.C.M N° BF-OUA-01-2022-B16-5095-Regime Fiscal : Régime Simplifie d\'imposition', 0, 0, 'C');
        $this->Ln(4);
        $this->CellUTF8(0, 5, 'Compte n°: BCB: 0501170024801-30-S.A.S au Capital de 1 000 000 FCFA', 0, 0, 'C');
        $this->Ln(4);
        $this->CellUTF8(0, 5, 'E-mail: btechgroup4@gmail.com Site Web: btechgroupsas.com', 0, 0, 'C');
    }

    function CellUTF8($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='') {
        $txt = iconv('UTF-8', 'windows-1252', $txt);
        $this->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
    }

    function WriteUTF8($h, $txt, $link='') {
        $txt = iconv('UTF-8', 'windows-1252', $txt);
        $this->Write($h, $txt, $link);
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
$pdf->CellUTF8($largeurTableau / 2, 5, '', 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->CellUTF8($largeurTableau / 2, 5, 'Client :', 0, 1, 'R');
//
$pdf->SetFont('Arial', '', 8);
$pdf->CellUTF8($largeurTableau / 2, 5, '', 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->CellUTF8($largeurTableau / 2, 5, 'Entreprise :'.$f['nom_entreprise'], 0, 1, 'R');
//
$pdf->CellUTF8($largeurTableau / 2, 5, '', 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->CellUTF8($largeurTableau / 2, 5, 'Adresse :'.$f['client_adresse'], 0, 1, 'R');
//
$pdf->CellUTF8($largeurTableau / 2, 5, '', 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->CellUTF8($largeurTableau / 2, 5, 'Téléphone :'.$f['client_telephone'], 0, 1, 'R');
//
$pdf->CellUTF8($largeurTableau / 2, 5, '', 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->CellUTF8($largeurTableau / 2, 5, 'IFU : '.$f['IFU'], 0, 1, 'R');
//
$pdf->CellUTF8($largeurTableau / 2, 5, '', 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->CellUTF8($largeurTableau / 2, 5, 'RCCM : '.$f['RCCM'], 0, 1, 'R');
//
$pdf->CellUTF8($largeurTableau / 2, 5, '', 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->CellUTF8($largeurTableau / 2, 5, 'Division Fiscale : '.$f['divisionFiscale'], 0, 1, 'R');

// Titre de la facture
$pdf->SetFont('Arial', 'B', 10);
$pdf->CellUTF8(0, 5, 'Objet : '.$f['objet_facture'], 0, 1, 'L');

// Détails de la facture
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 7);
// Définir la couleur de fond grise
$pdf->SetFillColor(200, 200, 200);
//
$pdf->CellUTF8($largeurTableau * 0.5, 8, 'Description', 1, 0, 'C', true);
$pdf->CellUTF8($largeurTableau * 0.1, 8, 'Quantite', 1, 0, 'C', true);
$pdf->CellUTF8($largeurTableau * 0.2, 8, 'Prix Unitaire', 1, 0, 'C', true);
$pdf->CellUTF8($largeurTableau * 0.2, 8, 'Total', 1, 1, 'C', true);

// Définir la couleur de fond grise
$pdf->SetFillColor(220, 220, 220);
// Liste Element
$elements = getFactureElementByF($_GET['id']);
foreach ($elements as $element) {
    $pdf->CellUTF8($largeurTableau * 0.5, 8, $element['description'], 0, 0, '', true);
    $pdf->CellUTF8($largeurTableau * 0.1, 8, $element['quantite'], 0, 0, 'C', true);
    $pdf->CellUTF8($largeurTableau * 0.2, 8, $element['prix_unitaire'], 0, 0, 'C', true);
    $pdf->CellUTF8($largeurTableau * 0.2, 8, $element['total'], 0, 1, 'C', true);
}

// Définir la couleur de fond grise
$pdf->SetFillColor(240, 240, 240);
// Total
$pdf->CellUTF8($largeurTableau * 0.8, 8, 'Total H.TVA : ', 0, 0, 'R');
$pdf->CellUTF8($largeurTableau * 0.2, 8, (''.$f['total_facture']), 0, 1, 'C', true);
// TVA
$pdf->CellUTF8($largeurTableau * 0.8, 8, 'TVA 18% : ', 0, 0, 'R');
$pdf->CellUTF8($largeurTableau * 0.2, 8, (''.$f['tva']), 0, 1, 'C', true);
// Total Net à Payer
$pdf->CellUTF8($largeurTableau * 0.8, 8, 'Total Net à Payer : ', 0, 0, 'R');
$pdf->CellUTF8($largeurTableau * 0.2, 8, (''.$f['total_facture']), 0, 1, 'C', true);

//
$pdf->Ln(5); // Saut de ligne

//
$pdf->SetFont('Arial', 'I', 7);
$pdf->CellUTF8(0, 5, 'Arreter la présente facture à la somme de '.numberToWords(intval($f['total_facture'])).' francs cfa ('.intval($f['total_facture']).')', 0, 1, 'L');

// Générer le nom du fichier avec la date et l'heure actuelles
$nomFichier = 'Facture Proforma ' . $_GET['id'] . '.pdf';

$pdf->Output($nomFichier, 'I');
?>