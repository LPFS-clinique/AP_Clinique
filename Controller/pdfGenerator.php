<?php
header('Content-Type: text/html; charset=utf-8');

require_once('../Model/config.php');
require('../fpdf186/fpdf.php');
global $conn;

// $id_patient = $_GET['id_patient'];
$id_patient = "1";

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('../images/Clinique_pdf.png',10,6,30);
        $this->SetFont('Arial','B',15);
        $this->Cell(80);
        $this->Cell(30,10,'Clinique LPFS',0,0,'C');
        $this->Ln(20);
        
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

$querry1 = $conn->prepare("SELECT * 
    FROM hospitalisation h
    JOIN medecin m ON h.id_medecin = m.id_medecin
    JOIN salarie s ON m.id_salarie = s.id_salarie
    JOIN chambre c ON h.num_type_chambre = c.num_type_chambre
    JOIN type_hospitalisation th ON h.id_type_hospitalisation = th.id_type_hospitalisation
    WHERE id_patient = :id_patient"
);
$querry1->execute(array(':id_patient' => $id_patient));
$result1 = $querry1->fetch();

$querry2 = $conn->prepare("SELECT *
    FROM patient p
    JOIN civilite c ON p.id_civilite = c.id_civilite
    JOIN documents d ON p.id_doc = d.id_doc
    JOIN couverture_sociale cs ON p.id_secu = cs.id_secu
    WHERE p.id_patient = :id_patient"
);
$querry2->execute(array(':id_patient' => $id_patient));
$result2 = $querry2->fetch();

if ($result1 === false && $result2 === false) {
    echo "Erreur lors de l'exécution de la requête";
    exit;
} else {
    $result = array_merge($result1, $result2);
}


if ($result) {
    $pdf->SetFont('Arial', 'B', 12); 

    $pdf->SetLineWidth(0.2);
    $pdf->Ln(10);
    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->Ln(5);
    

    // Informations patient
    $textePatient = "Patient : " . $result['nom_naissance_pt'];
    if (!empty($result['nom_epouse'])) {
        $textePatient .= " " . $result['nom_epouse_pt'];
    } 
    $textePatient .= " " . $result['prenom_pt'];
    $textePatient = iconv('UTF-8', 'windows-1252', $textePatient);
    $pdf->Cell(50, 10, $textePatient, 0, 0);

    $dateFormatee = date('d-m-Y', strtotime($result['ddn_pt']));
    $texteddn = " Date de Naissance : " . $dateFormatee;
    $texteddn = iconv('UTF-8', 'windows-1252', $texteddn);
    $pdf->Cell(40, 10, $texteddn, 0, 1);

    $texteAdresse = "Adresse : " . $result['adresse_pt'] . ", " . $result['cp_pt'] . ", " . $result['ville_pt'];
    $texteAdresse = iconv('UTF-8', 'windows-1252', $texteAdresse);
    $pdf->Cell(0, 10, $texteAdresse, 0, 1);

    $texteMail = "Mail : " . $result['mail_pt'];
    $texteMail = iconv('UTF-8', 'windows-1252', $texteMail);
    $pdf->Cell(40, 10, $texteMail, 0, 0);

    $texteTel = "Numéro de téléphone : " . $result['num_tel_pt'];
    $texteTel = iconv('UTF-8', 'windows-1252', $texteTel);
    $pdf->Cell(20, 10, $texteTel, 0, 1);

    // Barre 
    $largeurPage = $pdf->GetPageWidth();
    $largeurLigne = 140;
    $margeGauche = ($largeurPage - $largeurLigne) / 2;
    
    $pdf->SetLineWidth(0.2);
    $pdf->Ln(10);
    $pdf->Line($margeGauche, $pdf->GetY(), $margeGauche + $largeurLigne, $pdf->GetY());
    $pdf->Ln(5);
    
    // Informations de la pré-admission
    $pdf->Cell(40, 10, $result['date'], 0, 1);

    $pdf->Cell(40, 10, $result['heure'], 0, 1);

    $pdf->Cell(40, 10, $result['nom_s'], 0, 1);

    $pdf->Cell(40, 10, $result['type_chambre'], 0, 1);

    $pdf->Cell(40, 10, $result['type_hospitalisation'], 0, 1);
} else {
    $pdf->Cell(0, 10, 'Aucune donnée trouvée.', 0, 1, 'C');
}
$pdf->Output();
?>
