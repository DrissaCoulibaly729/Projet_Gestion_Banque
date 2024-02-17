<?php
// Ajoutez ici la logique pour traiter le virement

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $beneficiaire = $_POST["beneficiaire"];
    $montant = $_POST["montant"];

    // Ajoutez ici la logique pour effectuer le virement dans la base de données
    // (par exemple, mise à jour des soldes des comptes impliqués)

    
// Ajoutez ici la logique pour traiter le virement

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $beneficiaire = $_POST["beneficiaire"];
    $montant = $_POST["montant"];

    // Assurez-vous de valider et sécuriser les données avant de les utiliser
    // (par exemple, en utilisant des fonctions telles que filter_var et mysqli_real_escape_string)

    // Supposons que vous avez une connexion à la base de données $conn

    // Début de la transaction pour assurer la cohérence des données
    mysqli_autocommit($conn, false);
    $error = false;

    // Mettez à jour le solde du compte du client (expéditeur)
    $requete_debit = "UPDATE Compte SET Solde = Solde - $montant WHERE ID_Client = {id_client_exp}";
    if (!mysqli_query($conn, $requete_debit)) {
        $error = true;
    }

    // Mettez à jour le solde du compte du bénéficiaire
    $requete_credit = "UPDATE Compte SET Solde = Solde + $montant WHERE ID_Client = {id_client_beneficiaire}";
    if (!mysqli_query($conn, $requete_credit)) {
        $error = true;
    }

    // Si aucune erreur n'est survenue, validez la transaction, sinon annulez-la
    if (!$error) {
        mysqli_commit($conn);
        // Redirigez l'utilisateur vers la page du compte après le virement
        header("Location: compte.php");
        exit();
    } else {
        mysqli_rollback($conn);
        // Gérez l'erreur (par exemple, affichez un message d'erreur à l'utilisateur)
    }
}



    // Redirigez l'utilisateur vers la page du compte après le virement
    header("Location: compte.php");
    exit();
}
?>
