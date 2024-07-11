<?php
require('assets/pdflib/fpdf182/fpdf.php');

//Get nFacture
$nFacture = $_GET['id'];
class PDF extends FPDF {
    function Header() {
        $largeurTableau = $this->GetPageWidth() * 0.9;
        $i = getInterventionById($_GET['id']);

        //Logo
        $this->Image('assets/img/logo_1.jpeg',10,8,10); $this->Ln(15);
        //Police Arial gras 12
        $this->SetFont('Arial', 'B', 12);
        //Nom Entreprise
        $this->CellUTF8($largeurTableau / 2, 5, 'B\'Tech Group SAS', 0, 0, 'L');
        //Facture
        $this->CellUTF8($largeurTableau / 2, 5, 'INTERVENTION', 0, 1, 'R');
        
        $this->SetFont('Arial', '', 8);
        // Infos Entreprise
        $this->CellUTF8($largeurTableau / 2, 5, 'Sise à la ZONE 1, Secteur 28', 0, 0, 'L');
        // Infos Facture
        $this->CellUTF8($largeurTableau / 2, 5, '', 0, 1, 'R');
        // Infos Entreprise
        $this->CellUTF8($largeurTableau / 2, 5, 'Tél : (+226) 06 36 76 82', 0, 0, 'L');
        // Infos Facture
        $this->CellUTF8($largeurTableau / 2, 5, 'N° Intervention : 000' . $_GET['id'], 0, 1, 'R');
        // Infos Entreprise
        $this->CellUTF8($largeurTableau / 2, 5, 'Email : btechgroup4@gmail.com', 0, 0, 'L');
        // Infos Facture
        $this->CellUTF8($largeurTableau / 2, 5, 'Date : '. $i['date_intervention'], 0, 1, 'R');
        // Infos Entreprise
        $this->CellUTF8($largeurTableau / 2, 5, 'N°IFU : 00179631E', 0, 0, 'L');
        // Infos Facture
        $this->CellUTF8($largeurTableau / 2, 5, '', 0, 1, 'R');
        $this->Ln(10);
    }
    
    function Footer() {
        $largeurTableau = $this->GetPageWidth() * 0.9;
        //Positionnement à 5,5 cm du bas
        $this->SetY(-70);
        //
        $this->SetFont('Arial', 'B', 12);
        $this->CellUTF8($largeurTableau / 2, 5, '', 0, 0, 'L'); // Élément 1 aligné à gauche
        $this->CellUTF8($largeurTableau / 2, 5, 'Le Président', 0, 1, 'R');
        $this->Ln(25); // Saut de ligne
        $this->CellUTF8($largeurTableau / 2, 5, '', 0, 0, 'L'); // Élément 1 aligné à gauche
        $this->CellUTF8($largeurTableau / 2, 5, 'Limapa LOMPO', 0, 1, 'R');
        $this->Ln(15);
        //
        $this->SetFont('Arial', '', 8);
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
$i = getInterventionById($_GET['id']);
$c = getCLientById($i['client_id']);
//
$pdf->SetFont('Arial', 'B', 12);
$pdf->CellUTF8($largeurTableau / 2, 5, '', 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->CellUTF8($largeurTableau / 2, 5, 'Client :', 0, 1, 'R');
//
$pdf->SetFont('Arial', '', 10);
$pdf->CellUTF8($largeurTableau / 2, 5, '', 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->CellUTF8($largeurTableau / 2, 5, 'Entreprise :'.$c['nom'].' '.$c['prenom'], 0, 1, 'R');
//
$pdf->CellUTF8($largeurTableau / 2, 5, '', 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->CellUTF8($largeurTableau / 2, 5, 'Adresse :'.$c['adresse'], 0, 1, 'R');
//
$pdf->CellUTF8($largeurTableau / 2, 5, '', 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->CellUTF8($largeurTableau / 2, 5, 'Téléphone :'.$c['telephone'], 0, 1, 'R');
//
$pdf->CellUTF8($largeurTableau / 2, 5, '', 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->CellUTF8($largeurTableau / 2, 5, 'IFU : '.$c['IFU'], 0, 1, 'R');
//
$pdf->CellUTF8($largeurTableau / 2, 5, '', 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->CellUTF8($largeurTableau / 2, 5, 'RCCM : '.$c['RCCM'], 0, 1, 'R');
//
$pdf->CellUTF8($largeurTableau / 2, 5, '', 0, 0, 'L'); // Élément 1 aligné à gauche
$pdf->CellUTF8($largeurTableau / 2, 5, 'Division Fiscale : '.$c['divisionFiscale'], 0, 1, 'R');

// Titre de la facture
// $pdf->SetFont('Arial', 'B', 10);
// $pdf->CellUTF8(0, 5, 'Objet : '.$i['objet_facture'], 0, 1, 'L');

// Détails de la facture
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 8);
// Définir la couleur de fond grise
$pdf->SetFillColor(200, 200, 200);
//
$pdf->CellUTF8($largeurTableau * 0.5, 8, 'Type Interventions', 1, 0, 'C', true);
$pdf->CellUTF8($largeurTableau * 0.4, 8, 'Description', 1, 0, 'C', true);
$pdf->CellUTF8($largeurTableau * 0.1, 8, 'Cout', 1, 0, 'C', true);

// Définir la couleur de fond grise
$pdf->SetFillColor(220, 220, 220);
// Liste Element
$pdf->CellUTF8($largeurTableau * 0.5, 8, $i['type_intervention'], 0, 1, '', true);
$pdf->CellUTF8($largeurTableau * 0.4, 8, $i['description_intervention'], 0, 0, 'C', true);
$pdf->CellUTF8($largeurTableau * 0.1, 8, $i['cout_intervention'], 0, 0, 'C', true);

// Définir la couleur de fond grise
$pdf->SetFillColor(240, 240, 240);
// Total
$pdf->CellUTF8($largeurTableau * 0.9, 8, 'Total H.TVA : ', 0, 0, 'R');
$pdf->CellUTF8($largeurTableau * 0.1, 8, (''.$i['cout_intervention']), 0, 1, 'C', true);
// TVA
$pdf->CellUTF8($largeurTableau * 0.9, 8, 'TVA 18% : ', 0, 0, 'R');
$pdf->CellUTF8($largeurTableau * 0.1, 8, ('0'), 0, 1, 'C', true);
// Total Net à Payer
$pdf->CellUTF8($largeurTableau * 0.9, 8, 'Total Net à Payer : ', 0, 0, 'R');
$pdf->CellUTF8($largeurTableau * 0.1, 8, (''.$i['cout_intervention']), 0, 1, 'C', true);

//
$pdf->Ln(5); // Saut de ligne

//
$pdf->SetFont('Arial', 'I', 8);
$pdf->CellUTF8(0, 5, 'Arreter à la somme de '.numberToWords(intval($i['cout_intervention'])).' francs cfa ('.intval($i['cout_intervention']).')', 0, 1, 'L');

// Générer le nom du fichier avec la date et l'heure actuelles
$nomFichier = 'Print Intervention' . $_GET['id'] . '.pdf';

$pdf->Output($nomFichier, 'I');
?>