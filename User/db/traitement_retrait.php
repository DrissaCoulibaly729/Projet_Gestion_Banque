<?php
// Ajoutez ici la logique pour traiter le retrait

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $montant = $_POST["montant"];

    // Ajoutez ici la logique pour effectuer le retrait dans la base de données
    // (par exemple, mise à jour du solde du compte)


// Ajoutez ici la logique pour traiter le retrait

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $montant = $_POST["montant"];

    // Assurez-vous de valider et sécuriser les données avant de les utiliser
    // (par exemple, en utilisant des fonctions telles que filter_var et mysqli_real_escape_string)

    // Supposons que vous avez une connexion à la base de données $conn

    // Vérifiez si le solde est suffisant pour le retrait
    $requete_solde = "SELECT Solde FROM Compte WHERE ID_Client = {id_client}";
    $resultat_solde = mysqli_query($conn, $requete_solde);

    if ($resultat_solde) {
        $solde_actuel = mysqli_fetch_assoc($resultat_solde)["Solde"];
        if ($solde_actuel >= $montant) {
            // Mettez à jour le solde du compte du client
            $requete_retrait = "UPDATE Compte SET Solde = Solde - $montant WHERE ID_Client = {id_client}";

            // Exécutez la requête
            if (mysqli_query($conn, $requete_retrait)) {
                // Redirigez l'utilisateur vers la page du compte après le retrait
                header("Location: compte.php");
                exit();
            } else {
                // Gérez l'erreur (par exemple, affichez un message d'erreur à l'utilisateur)
                echo "Erreur lors du retrait : " . mysqli_error($conn);
            }
        } else {
            // Gérez le cas où le solde n'est pas suffisant
            echo "Solde insuffisant pour effectuer le retrait.";
        }
    } else {
        // Gérez l'erreur lors de la récupération du solde
        echo "Erreur lors de la récupération du solde : " . mysqli_error($conn);
    }
}


    // Redirigez l'utilisateur vers la page du compte après le retrait
    header("Location: compte.php");
    exit();
}
?>
