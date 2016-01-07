<?php

include 'includes/db_inc.php';
require 'lib/FPDF/fpdf.php';

$query = 'SELECT * FROM product WHERE id=:id';
$stmt = $db->prepare($query);

$stmt->execute([
    'id' => $_GET['id']
]);

$result = $stmt->fetch();

function convertDecimalPoint($input)
{
    $float = (float)$input;
    return number_format($float, 2, ',', ' ');
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(100, 10, 'Project Shopping', 1, 1);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(100, 10, 'Productdetails van: ' . $result['name']);
$pdf->Image('productImages/' . $result['image'], 10, 30, 35);
$pdf->Ln(50);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 10, 'Beschrijving');
$pdf->Ln();
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 5, $result['description']);
$pdf->Ln(10);
$pdf->Cell(100, 10, 'Prijs');
$pdf->Ln();
$pdf->Cell(100, 10, convertDecimalPoint($result['price']) . ' euro');
$pdf->Output();

?>
