// Charger la librairie FPDF
<?php
var_dump(isset($_POST['pdf']));
if (isset($_SESSION['compte']) && isset($_POST['pdf']) && strpos($_SERVER['REQUEST_URI'],'index.php') ) {
    $url = $_SERVER['REQUEST_URI'];
    extract($_POST);
    
    echo "L'URL actuelle est : $url";
    $compte = $_SESSION['compte'];
    //var_dump( $compte);
    $idCompte = $compte['idCompte'];
 
}else{
    header("Location:index.php?page=Accueil/error");
}

require("assets/fpdf/fpdf.php");

// Fonction pour créer la facture en PDF
function createPDF($nomClient, $typeTransaction, $dateTransaction, $montantTransaction, $envoyeur, $receiver,$statut) {
    // Créer un objet FPDF
    if ($nomClient&& $typeTransaction&& $dateTransaction&& $montantTransaction&& $envoyeur&& $receiver&&$statut) {
       
    
    $pdf = new FPDF();

    // Ajouter une page
    $pdf->AddPage();

    // Choisir la police pour le titre
    $pdf->SetFont('Arial', 'B', 14);
    // Couleur du titre
    $pdf->SetTextColor(241, 196, 15);
    // Afficher le titre de la facture
    $pdf->Cell(0, 12, 'Facture de ' . $typeTransaction, 0, 1, 'C');
    $pdf->Ln(12); // Saut de ligne

    // Choisir la police pour les informations du client
    $pdf->SetFont('Arial', '', 14);
    // Couleur du texte
    $pdf->SetTextColor(0);
    // Afficher les informations du client
    $pdf->Cell(0, 10, 'Client: ' . $nomClient, 0, 1);
    $pdf->Cell(0, 10, 'Date: ' . $dateTransaction, 0, 1);
    $pdf->Ln(12); // Saut de ligne

    // Choisir la police pour le type de transaction
    $pdf->SetFont('Arial', 'B', 14);
    // Couleur du texte
    $pdf->SetTextColor(241, 196, 15);
    // Afficher le type de transaction
    $pdf->Cell(0, 10, 'Type de transaction: '.  $typeTransaction, 0, 1);
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(0, 10, 'Statut de transaction: '.  $statut, 0, 1);
    $pdf->SetFont('Arial', '', 14);
    // // Couleur du texte
    // $pdf->SetTextColor(0);
    // // Afficher le type de transaction (Dépôt ou Retrait)
    // $pdf->Cell(0, 10, $typeTransaction, 0, 1);
    $pdf->Ln(12); // Saut de ligne

    // Choisir la police pour le montant
    $pdf->SetFont('Arial', 'B', 14);
    // Couleur du texte
    $pdf->SetTextColor(241, 196, 15);
    // Afficher le montant
    $pdf->Cell(0, 10, 'Montant : '. "$". $montantTransaction , 0, 1);
    $pdf->SetFont('Arial', '', 14);
    // Couleur du texte
    $pdf->SetTextColor(0);

    // Position du texte Envoyeur et Receiver
    $pdf->SetXY(145, 35); // Augmenté la valeur Y pour déplacer davantage vers le haut
    $pdf->SetFont('Arial', 'I', 14); // Italic, taille 10
    $pdf->SetTextColor(0); // Couleur du texte en noir
    $pdf->Cell(0, 10, 'Envoyeur: ' . $envoyeur, 0, 1);

    $pdf->SetXY(145, 45); // Augmenté la valeur Y pour déplacer davantage vers le haut
    $pdf->Cell(0, 10, 'Receiver: ' . $receiver, 0, 1);
    $pdf->Ln(10); // Saut de ligne

    // // Afficher le montant
    // $pdf->Cell(0, 10, $montantTransaction . ' €', 0, 1);
 // Saut de ligne

    // Afficher le total
   
    $dossier = "assets/facture/";
    // Nom du fichier PDF créé
    $file_name = $dossier.'facture_' . $typeTransaction . '.pdf';

    // Créer la facture en PDF
    $pdf->Output('F', $file_name);

    // Retourner le nom du fichier créé
    return $file_name;
    }else{
        return false;
    }
}

// Informations de la facture
$nomClientP =trim(htmlspecialchars($nomClient));
$typeTransactionP = trim(htmlspecialchars($typeTransaction)); // ou "Retrait"
$dateTransactionP =trim(htmlspecialchars($dateTransaction));
$montantTransactionP = trim(htmlspecialchars($montantTransaction)); // Montant du dépôt ou retrait

$envoyeurP = trim(htmlspecialchars($envoyeur));
$receiverP = trim(htmlspecialchars($receiver));

$statutP=trim(htmlspecialchars($statutOp));


// Créer la facture en PDF
$file_name = createPDF($nomClientP, $typeTransactionP, $dateTransactionP, $montantTransactionP, $envoyeurP, $receiverP,$statutP);


// Rediriger vers le fichier PDF créé
if($file_name)
{
    header("Location: $file_name");
}else {
    # code...
}

