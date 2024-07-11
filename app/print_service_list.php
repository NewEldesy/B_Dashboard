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
        //Positionnement à 1,2 cm du bas
        $this->SetY(-8);
        //
        $this->SetFont('Arial', '', 8);
        // Page number
        $this->CellUTF8(0, 6, 'Page ' . $this->PageNo() . '', 0, 0, 'C');
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

$pdf->SetFont('Arial', '', 8);
// Définir la couleur de fond grise
$pdf->SetFillColor(200, 200, 200);
// En tete Tableau
$pdf->CellUTF8($largeurTableau * 0.2, 8, '#', 1, 0, 'C', true);
$pdf->CellUTF8($largeurTableau * 0.8, 8, 'Libellés Services', 1, 1, 'C', true);

// Définir la couleur de fond grise
$pdf->SetFillColor(255, 255, 255);
// Liste des Services
$i = 1;
$services = getServices();
foreach ($services as $service) {
    $pdf->CellUTF8($largeurTableau * 0.2, 8, $i++, 1, 0, 'C', true);
    $pdf->CellUTF8($largeurTableau * 0.8, 8, $service['libelle_services'], 1, 1, 'C', true);
}

// Générer le nom du fichier avec la date et l'heure actuelles
$date = getCurrentDateTimeString();
$nomFichier = 'Liste Services_'. $date .'_.pdf';

$pdf->Output($nomFichier, 'I');
?>