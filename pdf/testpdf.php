  
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

//Cell (width, height, text, border, end line 0 : continue 1: new line, align : C / L / R);
$pdf->SetFont("Arial","B","15");
$pdf->Cell(120, 5, "Aerodrome D'Evreux Normandie",0,0);
$pdf->Cell(69, 5, "Compagny & Co",0,1);

//Ln saut de ligne
$pdf->Ln(10);

$pdf->SetFont("Arial","",12);

$pdf->Cell(120, 5, "252 Rue du Faubourg Saint Antoine",0 ,0);
$pdf->Cell(69, 5,"",0,1); //end of line

$pdf->Cell(120, 5, "France, Paris, 75012",0 ,0);
$pdf->Cell(35, 5,"Date",0,0);
$pdf->Cell(34, 5,"dd/mm/yyyy",0,1); //end of line

$pdf->Cell(120, 5, "Phone +33 1 59 97 83 92",0 ,0);
$pdf->Cell(35, 5, "Commande N°",0 ,0);
$pdf->Cell(34, 5,"1845473",0,1); //end of line

$pdf->Cell(120, 5, "mailtest@gmail.com",0 ,0);
$pdf->Cell(35, 5, "Numero client ",0 ,0);
$pdf->Cell(34, 5,"[ID]",0,1); //end of line

//$pdf->Ln(10);
// Empty cell vertical space
$pdf->Cell(189, 10, "",0 ,1);

$pdf->Cell(60,10,"Facturation a Mr",0,1);

$pdf->Cell(60,5,"FirstName : ",0,0);
$pdf->Cell(129,5,$firstname,0,1);

$pdf->Cell(60,5,"lastname : ",0,0);
$pdf->Cell(129,5,$lastname,0,1);

$pdf->Cell(60,5,"mail : ",0,0);
$pdf->Cell(129,5,$mail,0,1);

$pdf->Cell(60,5,"pseudo : ",0,0);
$pdf->Cell(129,5,$pseudo,0,1);

$pdf->Cell(60,5,"phone : ",0,0);
$pdf->Cell(129,5,$phone,0,1);

$pdf->Ln(10);

$pdf->SetFont("Arial","B",12);

$pdf->Cell(130, 5, "Description",1,0);
$pdf->Cell(25, 5, "Taxe",1,0);
$pdf->Cell(35, 5, "Prix HT",1,1);

$pdf->SetFont("Arial","",12);

$pdf->Cell(130, 5, "Reservation 1",1,0);
$pdf->Cell(25, 5, "10 E ",1,0);
$pdf->Cell(35, 5, "187,12 E",1,1, "R");

$pdf->Cell(130, 5, "Reservation 2",1,0);
$pdf->Cell(25, 5, "21 E ",1,0);
$pdf->Cell(35, 5, "257,78 E",1,1, "R");

$pdf->Cell(130, 5, "Reservation 3",1,0);
$pdf->Cell(25, 5, "3 E ",1,0);
$pdf->Cell(35, 5, "87,65 E",1,1, "R");

//resumé

$pdf->Cell(130, 5, "",0,0);
$pdf->Cell(25, 5, "",0,0);
$pdf->Cell(35, 5, "",0,1, "R");

$pdf->Cell(130, 5, "",0,0);
$pdf->Cell(25, 5, "Total HT",0,0);
$pdf->Cell(35, 5, "xxx E",0 ,1, "R");

$pdf->Cell(130, 5, "",0,0);
$pdf->Cell(25, 5, "Total Taxe",0,0);
$pdf->Cell(35, 5, "xxx E",0 ,1, "R");

$pdf->Cell(130, 5, "",0,0);
$pdf->Cell(25, 5, "% taxe",0,0);
$pdf->Cell(35, 5, "xxx E",0 ,1, "R");

$pdf->Cell(130, 5, "",0,0);
$pdf->Cell(25, 5, "Total TTC",0,0);
$pdf->Cell(35, 5, "xxx E",0 ,1, "R");









/*$pdf->Cell(0,5,"Welcome {$firstname}",1,1,"C");

$pdf->Cell(60,5,"FirstName : ",1,0);
$pdf->Cell(60,5,$firstname,1,1);

$pdf->Cell(60,5,"lastname : ",1,0);
$pdf->Cell(60,5,$lastname,1,1);

$pdf->Cell(60,5,"mail : ",1,0);
$pdf->Cell(60,5,$mail,1,1);

$pdf->Cell(60,5,"pseudo : ",1,0);
$pdf->Cell(60,5,$pseudo,1,1);

$pdf->Cell(60,5,"phone : ",1,0);
$pdf->Cell(60,5,$phone,1,1);
*/


$pdf->Output();
?>