<?php
require('./assets/pdflib/fpdf182/fpdf.php');

class PDF extends FPDF
{
//En-tête
function Header() {
    $largeurTableau = $this->GetPageWidth() * 0.9;
     
    //Logo
    $this->Image('./dist/img/logo_1.jpeg',10,8,10);
    $this->Ln(20);
    //Police Arial gras 12
    $this->SetFont('Arial', 'B', 12);
    //Nom Entreprise
    $this->Cell($largeurTableau / 2, 5, utf8_decode('B\'Tech Group SAS'), 0, 0, 'L');
    //Facture
    $this->Cell($largeurTableau / 2, 5, utf8_decode('FACTURE'), 0, 1, 'R');
    //
    $this->SetFont('Arial', '', 8);
    //Infos Entreprise
    $this->Cell($largeurTableau / 2, 5, utf8_decode('Sise à la ZONE 1, Secteur 28'), 0, 0, 'L');
    //Infos Facture
    $this->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 1, 'R');
    //
    $this->Cell($largeurTableau / 2, 5, utf8_decode('Tél : (+226) 06 36 76 82'), 0, 0, 'L');
    //
    $this->Cell($largeurTableau / 2, 5, utf8_decode('N° Facture : 00021'), 0, 1, 'R');
    //
    $this->Cell($largeurTableau / 2, 5, utf8_decode('Email : btechgroup4@gmail.com'), 0, 0, 'L');
    //
    $this->Cell($largeurTableau / 2, 5, utf8_decode('Date : 01/07/2024'), 0, 1, 'R');
    //
    $this->Cell($largeurTableau / 2, 5, utf8_decode('N°IFU : 00179631E'), 0, 0, 'L');
    //
    $this->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 1, 'R');
    //Saut de ligne
    $this->Ln(20);
}

//Pied de page
function Footer() {
    //
    $largeurTableau = $this->GetPageWidth() * 0.9;

    //
    $this->SetFont('Arial', 'B', 12);
    $this->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 0, 'L'); // Élément 1 aligné à gauche
    $this->Cell($largeurTableau / 2, 5, utf8_decode('Le Président'), 0, 1, 'R');
    $this->Ln(20); // Saut de ligne
    $this->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 0, 'L'); // Élément 1 aligné à gauche
    $this->Cell($largeurTableau / 2, 5, utf8_decode('Limapa LOMPO'), 0, 1, 'R');
    $this->Ln(10);
    //
    $this->SetFont('Arial', '', 8);
    $this->Cell(0, 5, utf8_decode('Katr-Yaar Secteur 28-Section :114-01 BP 136 Ouagadougou 01-Tél : (00226) 06 36 76 82 / 71 63 08 50'), 0, 0, 'C');
    $this->Ln(5);
    $this->Cell(0, 5, utf8_decode('N°IFU 00179631E-R.C.C.M N° BF-OUA-01-2022-B16-5095-Regime Fiscal : Régime Simplifie d\'imposition'), 0, 0, 'C');
    $this->Ln(5);
    $this->Cell(0, 5, utf8_decode('Compte n°: BCB: 0501170024801-30-S.A.S au Capital de 1 000 000 FCFA'), 0, 0, 'C');
    $this->Ln(5);
    $this->Cell(0, 5, utf8_decode('E-mail: btechgroup4@gmail.com Site Web: btechgroupsas.com'), 0, 0, 'C');
}
}

//Instanciation de la classe dérivée
$pdf=new PDF();
$pdf->AddPage();

$largeurTableau = $pdf->GetPageWidth() * 0.9;
//
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->Cell($largeurTableau / 2, 5, utf8_decode('Client :'), 0, 1, 'R');
//
$pdf->SetFont('Arial', '', 8);
$pdf->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->Cell($largeurTableau / 2, 5, utf8_decode('Nom Entreprise'), 0, 1, 'R');
//
$pdf->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->Cell($largeurTableau / 2, 5, utf8_decode('00 BP 000 ougadougou 00'), 0, 1, 'R');
//
$pdf->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->Cell($largeurTableau / 2, 5, utf8_decode('Téléphone : 00000000'), 0, 1, 'R');
//
$pdf->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->Cell($largeurTableau / 2, 5, utf8_decode('IFU : 000000000'), 0, 1, 'R');
//
$pdf->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->Cell($largeurTableau / 2, 5, utf8_decode('RCCM : BFOUA000000000'), 0, 1, 'R');
//
$pdf->Cell($largeurTableau / 2, 5, utf8_decode(''), 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->Cell($largeurTableau / 2, 5, utf8_decode('Division Fiscale : 0000000, 0000'), 0, 1, 'R');
$pdf->Ln(20); // Saut de ligne

// Titre de la facture
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, utf8_decode('Objet : '), 0, 1, 'L');

// Détails de la facture
$pdf->Ln(5); // Saut de ligne
$pdf->SetFont('Arial', '', 8);

// Définir la couleur de fond grise
$pdf->SetFillColor(200, 200, 200);

//
$pdf->Cell($largeurTableau * 0.5, 8, utf8_decode('Description'), 0, 0, 'C', true);
$pdf->Cell($largeurTableau * 0.1, 8, 'Quantite', 0, 0, 'C', true);
$pdf->Cell($largeurTableau * 0.2, 8, 'Prix Unitaire', 0, 0, 'C', true);
$pdf->Cell($largeurTableau * 0.2, 8, 'Total', 0, 1, 'C', true);

// Définir la couleur de fond grise
$pdf->SetFillColor(220, 220, 220);

// Exemple de ligne de produit
$pdf->Cell($largeurTableau * 0.5, 8, utf8_decode('Produit A'), 0, 0, '', true);
$pdf->Cell($largeurTableau * 0.1, 8, '10', 0, 0, 'C', true);
$pdf->Cell($largeurTableau * 0.2, 8, '5000', 0, 0, 'C', true);
$pdf->Cell($largeurTableau * 0.2, 8, '50000', 0, 1, 'C', true);

// Exemple de ligne de produit
$pdf->Cell($largeurTableau * 0.5, 8, utf8_decode('Produit B'), 0, 0, '', true);
$pdf->Cell($largeurTableau * 0.1, 8, '2', 0, 0, 'C', true);
$pdf->Cell($largeurTableau * 0.2, 8, '30000', 0, 0, 'C', true);
$pdf->Cell($largeurTableau * 0.2, 8, '60000', 0, 1, 'C', true);

// Définir la couleur de fond grise
$pdf->SetFillColor(240, 240, 240);

// Total
$pdf->Cell($largeurTableau * 0.8, 8, utf8_decode('Total H.TVA : '), 0, 0, 'R');
$pdf->Cell($largeurTableau * 0.2, 8, '110000', 0, 1, 'C', true);

// Total
$pdf->Cell($largeurTableau * 0.8, 8, utf8_decode('TVA 18% : '), 0, 0, 'R');
$pdf->Cell($largeurTableau * 0.2, 8, '0', 0, 1, 'C', true);

// Total
$pdf->Cell($largeurTableau * 0.8, 8, utf8_decode('Total Net à Payer : '), 0, 0, 'R');
$pdf->Cell($largeurTableau * 0.2, 8, '110000', 0, 1, 'C', true);

//
$pdf->Ln(15); // Saut de ligne

//
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 5, utf8_decode('Arreter la présente facture à a somme de Cent dix mille francs cfa (110 000f cfa)'), 0, 1, 'L');

//
$pdf->Ln(15); // Saut de ligne

// Générer le nom du fichier avec la date et l'heure actuelles
$nomFichier = 'proforma_invoice_' . date('Ymd_Hi') . '.pdf';

$pdf->Output($nomFichier, 'I');
?>