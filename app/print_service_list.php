<?php
require('assets/pdflib/fpdf182/fpdf.php');

class PDF extends FPDF {
    function Header() {
        $largeurTableau = $this->GetPageWidth() * 0.9;

        //Logo
        $this->Image('assets/img/logo_1.jpeg',10,8,10); $this->Ln(15);
        //Police Arial gras 12
        $this->SetFont('Arial', 'B', 12);
        //Nom Entreprise
        $this->CellUTF8($largeurTableau / 2, 5, 'B\'Tech Group SAS', 0, 0, 'L');
        //Facture
        $this->CellUTF8($largeurTableau / 2, 5, '', 0, 1, 'R');
        
        $this->SetFont('Arial', '', 8);
        // Infos Entreprise
        $this->CellUTF8($largeurTableau / 2, 5, 'Sise à la ZONE 1, Secteur 28', 0, 0, 'L');
        // Infos Facture
        $this->CellUTF8($largeurTableau / 2, 5, '', 0, 1, 'R');
        // Infos Entreprise
        $this->CellUTF8($largeurTableau / 2, 5, 'Tél : (+226) 06 36 76 82', 0, 0, 'L');
        // Infos Facture
        $this->CellUTF8($largeurTableau / 2, 5, '', 0, 1, 'R');
        // Infos Entreprise
        $this->CellUTF8($largeurTableau / 2, 5, 'Email : btechgroup4@gmail.com', 0, 0, 'L');
        // Infos Facture
        $this->CellUTF8($largeurTableau / 2, 5, '', 0, 1, 'R');
        // Infos Entreprise
        $this->CellUTF8($largeurTableau / 2, 5, 'N°IFU : 00179631E', 0, 0, 'L');
        // Infos Facture
        $this->CellUTF8($largeurTableau / 2, 5, '', 0, 1, 'R');
        $this->Ln(10);

        $this->SetFont('Arial', 'B', 20);
        $this->CellUTF8($largeurTableau / 1, 5, 'Liste des services', 0, 0, 'C');
        $this->Ln(10);
    }
    
    function Footer() {
        $this->SetY(-8); //Positionnement à 1,2 cm du bas
        $this->SetFont('Arial', '', 8);
        $this->CellUTF8(0, 6, 'Page ' . $this->PageNo() . '', 0, 0, 'C'); // Page number
    }

    function CellUTF8($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='') {
        $txt = iconv('UTF-8', 'windows-1252', $txt);
        $this->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
    }

    function MCellUTF8($w, $h=0, $txt='', $border=0, $align='', $fill=false) {
        $txt = iconv('UTF-8', 'windows-1252', $txt);
        $this->MultiCell($w, $h, $txt, $border, $align, $fill);
    }
    function GetMultiCellHeight($w, $h, $txt, $border=0, $align='L', $fill=false) {
        // Sauvegarder la position courante
        $currentX = $this->GetX();
        $currentY = $this->GetY();
        
        // Simuler l'écriture pour obtenir la hauteur
        $this->SetXY(-5000, -5000); // Se positionner hors de la page
        $this->MultiCell($w, $h, $txt, $border, $align, $fill);
        
        // Calculer la nouvelle hauteur
        $newY = $this->GetY();
        $cellHeight = $newY - (-5000);
        
        // Revenir à la position originale
        $this->SetXY($currentX, $currentY);
        
        return $cellHeight;
    }
}

//Instanciation de la classe dérivée
$pdf=new PDF('P', 'mm', 'A4');
$pdf->AddPage();

$largeurTableau = $pdf->GetPageWidth() * 0.9;

$pdf->SetFont('Arial', '', 8);
$pdf->SetFillColor(200, 200, 200); // Définir la couleur de fond grise
// En tete Tableau
$pdf->CellUTF8($largeurTableau * 0.1, 8, '#', 1, 0, 'L', true);
$pdf->CellUTF8($largeurTableau * 0.9, 8, 'Libellés Services', 1, 1, 'L', true);

$pdf->SetFillColor(255, 255, 255); // Définir la couleur de fond grise
// Liste des Services
$i = 1;
$services = getServices();
// foreach ($services as $service) {
//     $pdf->CellUTF8($largeurTableau * 0.1, 8, $i++, 1, 0, 'L', true);
//     $pdf->CellUTF8($largeurTableau * 0.9, 8, $service['libelle_services'], 1, 1, 'L', true);
//     // $pdf->MultiCell(10, 10, 'Formations techniques en Windows server, Administrateur réseau, Concepteur mécanique, Maintenance informatique, en Robotique et en Bureau', 1, 'L', true);

// }
foreach ($services as $service) {
    $textHeight = $pdf->GetMultiCellHeight($largeurTableau * 0.9, 8, $service['libelle_services'], 1, 'L', true);
    // Ligne numéro de service
    $pdf->CellUTF8($largeurTableau * 0.1, 8, $i++, 1, 0, 'L', true);
    // Texte du service avec retour à la ligne automatique
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MCellUTF8($largeurTableau * 0.9, 8, $service['libelle_services'], 1, 'L', true);
    $pdf->SetXY($x + $largeurTableau * 0.9, $y); // repositionnement
    $pdf->Ln();
}

// $pdf->Cell($largeurTableau * 0.1, 8, 1, 1, 0, 'L', true);
// $pdf->MultiCell($largeurTableau * 0.9, 8, 'Formations techniques en Windows server, Administrateur réseau, Concepteur mécanique, Maintenance informatique, en Robotique et en Bureau', 1, 'L', true);

// Générer le nom du fichier avec la date et l'heure actuelles
$date = getCurrentDateTimeString();
$nomFichier = 'Liste Services_'. $date .'_.pdf';

$pdf->Output($nomFichier, 'I');
?>