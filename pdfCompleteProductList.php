<?php

include 'includes/db_inc.php';
include 'includes/formatFunctions_inc.php';
require 'lib/FPDF/fpdf.php';

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(60);
        $this->Cell(60, 10, 'Project shopping', 1, 0, 'C');
        $this->ln(20);
    }

    function Footer()
    {
        $this->Sety(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Blz. ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$query = 'SELECT * FROM product';
$stmt = $db->query($query);
$results = $stmt->fetchAll();


$pdf = new PDF();
$pdf->AliasNbPages();
foreach ($results as $result) {
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(100, 10, 'Productdetails van: ' . $result['name']);
    $pdf->Image('productImages/' . $result['image'], 10, 40, 35);
    $pdf->Ln(50);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(100, 10, 'Beschrijving');
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 5, strip_tags($result['description']));
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(100, 10, 'Prijs');
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(100, 10, convertDecimalPoint($result['price']) . ' euro');
}

$pdf->Output();
?>
