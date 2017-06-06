  
<?php 

$lastname = filter_input(INPUT_POST, 'lastname');
$firstname = filter_input(INPUT_POST, 'firstname');
$mail = filter_input(INPUT_POST, 'mail');
$pseudo = filter_input(INPUT_POST, 'pseudo');
$pass = filter_input(INPUT_POST, 'pass');
$pass_validation = filter_input(INPUT_POST, 'pass_validation');
$phone = filter_input(INPUT_POST, 'phone');
$comments = filter_input(INPUT_POST, 'comments');

require('fpdf.php');

$pdf = new FPDF();

$pdf->AddPage();

$pdf->SetFont("Arial","B","15");
$pdf->Cell(0,10,"Welcome {$firstname}",1,1,"C");
$pdf->Cell(60,10,"FirstName : ",1,0);
$pdf->Cell(60,10,$firstname,1,1);

$pdf->Cell(60,10,"lastname : ",1,0);
$pdf->Cell(60,10,$lastname,1,1);

$pdf->Cell(60,10,"mail : ",1,0);
$pdf->Cell(60,10,$mail,1,1);

$pdf->Cell(60,10,"pseudo : ",1,0);
$pdf->Cell(60,10,$pseudo,1,1);

$pdf->Cell(60,10,"phone : ",1,0);
$pdf->Cell(60,10,$phone,1,1);



$pdf->Output();
?>