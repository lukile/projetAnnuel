<?php 

$i = 0;
if( $lastname = filter_input(INPUT_POST, 'lastname')){
	$lastname = filter_input(INPUT_POST, 'lastname');
	$i++;
	
}

if( $firstname = filter_input(INPUT_POST, 'firstname')){
	$firstname = filter_input(INPUT_POST, 'firstname');
	//echo $i." firstname ".$firstname;
	$i++;
}
if($mail = filter_input(INPUT_POST, 'mail')){
	$mail = filter_input(INPUT_POST, 'mail');
	$i++;
}

if($pseudo = filter_input(INPUT_POST, 'pseudo')){
	$pseudo = filter_input(INPUT_POST, 'pseudo');
	$i++;
}

if($phone = filter_input(INPUT_POST, 'phone')){
	$phone = filter_input(INPUT_POST, 'phone');
	$i++;
}



require('fpdf.php');
class PDF extends FPDF {
	function Header() {
		$this->Cell(12);

		$this->Image("../img/logoAEN.png",10,10,13);
	}

	function Footer() {

		$this->SetY(-15);

		$this->SetFont("Arial","",8);

		$this->Cell(0,10,"Page ".$this->PageNo()." / {pages}",0,0,"C");

	}
}

setlocale(LC_TIME, 'fr_FR.utf8','fra');

$date = strftime("%d %B %Y");
$pdf = new PDF();

define('EURO',chr(128));
$euro = EURO;

$rand = rand(5000,15000);
$commande = $rand;
$pdf->AliasNbPages("{pages}");
$pdf->AddPage();
$pdf->SetTitle(utf8_decode("Reservation N° : {$rand}"));

//Cell (width, height, text, border, end line 0 : continue 1: new line, align : C / L / R);
$pdf->SetFont("Arial","B","15");
$pdf->Cell(120, 5,utf8_decode("Aérodrome D'Evreux Normandie"),0,0);
$pdf->Cell(69, 5, "Compagny & Co",0,1);

//Ln saut de ligne
$pdf->Ln(10);

$pdf->SetFont("Arial","",12);

$pdf->Cell(120, 5, "43 Rue des Fleurs",0 ,0);
$pdf->Cell(69, 5,"",0,1); //end of line

$pdf->Cell(120, 5, "France, Saint-Michel, 68200",0 ,0);
$pdf->Cell(35, 5,"Date",0,0);
$pdf->Cell(34, 5,$date,0,1); //end of line

$pdf->Cell(120, 5, "+33 1 59 97 83 92",0 ,0);
$pdf->Cell(35, 5, utf8_decode("Commande N°"),0 ,0);
$pdf->Cell(34, 5,"{$commande}",0,1); //end of line

$pdf->Cell(120, 5, "aen@gmail.com",0 ,0);
$pdf->Cell(35, 5, "Numero client ",0 ,0);
$pdf->Cell(34, 5,"[ID]",0,1); //end of line

//$pdf->Ln(10);
// Empty cell vertical space
$pdf->Cell(189, 10, "",0 ,1);

$pdf->Cell(60,10,utf8_decode("Récapitulatif de la réservation"),0,1);

//echo $i."CACA";
//echo $lastname."lastname";
if ($i >= 1){			
	//echo "pouet";
$pdf->Cell(60,5,"Nom : ",0,0);
$pdf->Cell(129,5,$lastname,0,1);
//echo $lastname."lastname";
			
	if($i >= 2){
		$pdf->Cell(60,5,utf8_decode("Prénom : "),0,0);
		$pdf->Cell(129,5,$firstname,0,1);
		
		if($i >= 3){	
			$pdf->Cell(60,5,"Email : ",0,0);
			$pdf->Cell(129,5,$mail,0,1);
			
			if($i >= 4){		
				$pdf->Cell(60,5,"Nom d'utilisateur : ",0,0);
				$pdf->Cell(129,5,$pseudo,0,1);
					
					if($i == 5){
						$pdf->Cell(60,5,utf8_decode("Téléphone : "),0,0);
						$pdf->Cell(129,5,$phone,0,1);
							}
						}
					}
				}
			}

						
$pdf->Ln(10);

$pdf->SetFont("Arial","B",12);

$pdf->Cell(130, 5, "Description",1,0);
$pdf->Cell(25, 5, "Taxe",1,0);
$pdf->Cell(35, 5, "Prix HT",1,1);

$pdf->SetFont("Arial","",12);

$pdf->Cell(130, 5, "Service 1",0,0);
$pdf->Cell(25, 5, utf8_decode("10{$euro}"),0,0);
$pdf->Cell(35, 5, "187,12 E",0,1, "R");

$pdf->SetFont("Arial","",10);

$pdf->Cell(20,5,"",0,0);
$pdf->Cell(50,5,utf8_decode("Détails de l'activité"),0,0);
$pdf->Cell(119,5, "",0,1);

$pdf->Cell(20,5,"",0,0);
$pdf->Cell(50,5,utf8_decode("Date de l'activité"),0,0);
$pdf->Cell(119,5, "",0,1);

$pdf->Cell(20,5,"",0,0);
$pdf->Cell(50,5,utf8_decode("Heure de l'activité"),0,0);
$pdf->Cell(119,5, "",0,1);
$pdf->ln(2);

$pdf->SetFont("Arial","",12);

$pdf->Cell(130, 5, "Service 2",0,0);
$pdf->Cell(25, 5, "21 E ",0,0);
$pdf->Cell(35, 5, "257,78 E",0,1, "R");

$pdf->SetFont("Arial","",10);

$pdf->Cell(20,5,"",0,0);
$pdf->Cell(50,5,utf8_decode("Détails de l'activité"),0,0);
$pdf->Cell(119,5, "",0,1);

$pdf->Cell(20,5,"",0,0);
$pdf->Cell(50,5,utf8_decode("Date de l'activité"),0,0);
$pdf->Cell(119,5, "",0,1);

$pdf->Cell(20,5,"",0,0);
$pdf->Cell(50,5,utf8_decode("Heure de l'activité"),0,0);
$pdf->Cell(119,5, "",0,1);
$pdf->ln(2);

$pdf->SetFont("Arial","",12);

$pdf->Cell(130, 5, "Service 3",0,0);
$pdf->Cell(25, 5, "3 E ",0,0);
$pdf->Cell(35, 5, "87,65 E",0,1, "R");

$pdf->SetFont("Arial","",10);

$pdf->Cell(20,5,"",0,0);
$pdf->Cell(50,5,utf8_decode("Détails de l'activité"),0,0);
$pdf->Cell(119,5, "",0,1);

$pdf->Cell(20,5,"",0,0);
$pdf->Cell(50,5,utf8_decode("Date de l'activité"),0,0);
$pdf->Cell(119,5, "",0,1);

$pdf->Cell(20,5,"",0,0);
$pdf->Cell(50,5,utf8_decode("Heure de l'activité"),0,0);
$pdf->Cell(119,5, "",0,1);
$pdf->ln(2);

//resumé

$pdf->Cell(130, 5, "",0,0);
$pdf->Cell(25, 5, "",0,0);
$pdf->Cell(35, 5, "",0,1, "R");

// TT HT
$pdf->Cell(130, 5, "",0,0);
$pdf->Cell(25, 5, "Total HT",0,0);
$pdf->Cell(35, 5, "xxx E",0 ,1, "R");


// ligne pour souligné
$pdf->Ln(1);
$pdf->Cell(150,0,"",0,0);
$pdf->Cell(39,0,"",1,1, "R");

$pdf->Cell(130, 5, "",0,0);
$pdf->Cell(25, 5, "TVA 20%",0,0);
$pdf->Cell(35, 5, "xxx E",0 ,1, "R");

$pdf->Ln(1);
$pdf->Cell(150,0,"",0,0);
$pdf->Cell(39,0,"",1,1, "R");

$pdf->SetFont("Arial","B",12);
$pdf->Cell(130, 5, "",0,0);
$pdf->Cell(25, 5, "Total TTC",0,0);
$pdf->Cell(35, 5, "xxx E",0 ,1, "R");

$pdf->Ln(1);
$pdf->Cell(150,0,"",0,0);
$pdf->Cell(39,0,"",1,1, "R");

$pdf->Ln(50);

$pdf->SetFont("Arial","",12);
$pdf->Cell(189, 5, utf8_decode("Merci de vous présenter 30 min avant le début de vos activités"),0,0, "C");



$pdf->Output();
?>