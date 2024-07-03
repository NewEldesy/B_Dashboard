<?php

include("./pdflib/logics-builder-pdf.php");
include './config/connection.php';

$reportTitle = "Proforma Invoice";
$clientId = 123;

// Récupération des informations du client (simulée)
$client = [
    'client_nom' => 'Clients AZERTY',
    'client_prenom' => '',
    'client_telephone' => '75631978',
    'client_adresse' => 'Zone 1'
];

$pdf = new LB_PDF('P', false, $reportTitle);
$pdf->SetMargins(15, 10);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, "Client Information", 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, "Name: " . $client['client_nom'], 0, 1, 'L');
$pdf->Cell(0, 10, "Phone: " . $client['client_telephone'], 0, 1, 'L');
$pdf->Cell(0, 10, "Address: " . $client['client_adresse'], 0, 1, 'L');

$pdf->Ln(10);

$titlesArr = array('S.No', 'Description', 'Quantity', 'Unit Price', 'Total Price');
$pdf->SetWidths(array(15, 80, 25, 35, 35));
$pdf->SetAligns(array('L', 'L', 'R', 'R', 'R'));

$pdf->AddTableHeader($titlesArr);

$i = 1;
$totalAmount = 0;

// Exemple de données de facture (simulée)
$invoiceDetails = [
    [
        'description' => 'Installation Caméra',
        'quantity' => 5,
        'unit_price' => 20000,
        'total_price' => 100000
    ],
    [
        'description' => 'Installation Alarme',
        'quantity' => 2,
        'unit_price' => 15000,
        'total_price' => 30000
    ]
];

foreach ($invoiceDetails as $row) {
    $data = array(
        $i++, 
        $row['description'], 
        number_format($row['quantity'], 0), 
        number_format($row['unit_price'], 2), 
        number_format($row['total_price'], 2)
    );

    $pdf->AddRow($data);
    $totalAmount += $row['total_price'];
}

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(130, 10, "Total Amount", 1);
$pdf->Cell(35, 10, number_format($totalAmount, 2), 1, 1, 'R');

$pdf->Output('proforma_invoice.pdf', 'I');
?>