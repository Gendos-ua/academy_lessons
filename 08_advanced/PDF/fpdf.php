<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/22/18
 * Time: 16:07
 */

ini_set('display_errors', 1);
ini_set('mbstring.func_overload', 1);
error_reporting(E_ALL);
require('vendor/autoload.php');


$sizes = array(
    'a3'=>array(841.89,1190.55),
    'a4'=>array(595.28,841.89),
    'a5'=>array(420.94,595.28),
    'letter'=>array(612,792),
    'legal'=>array(612,1008)
);


$pdf = new FPDF();
$pdf->SetAutoPageBreak(true);

$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->SetX(40);
$pdf->SetY($pdf->GetPageHeight()/2);
$pdf->Write(20, "Hello World!");
//$pdf->Cell(40,10,'Hello World!');

$pdf->SetDrawColor(50, 100, 20);
$pdf->SetFillColor(0,0,0);
$pdf->Rect(5, 5, $pdf->GetPageWidth()-10, 40);
$pdf->Line(5, 50, 5, 55);

$pdf->AddPage('L', [150, 150]);
$pdf->Cell(60,10,'Powered by FPDF.',0,1,'C');


$pdf->Output();