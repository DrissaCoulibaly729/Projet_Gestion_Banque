<?php
// Ajoutez ici la logique pour traiter le dépôt

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $montant = $_POST["montant"];

    // Ajoutez ici la logique pour effectuer le dépôt dans la base de données
    // (par exemple, mise à jour du solde du compte)

    
// Ajoutez ici la logique pour traiter le dépôt

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $montant = $_POST["montant"];

    // Assurez-vous de valider et sécuriser les données avant de les utiliser
    // (par exemple, en utilisant des fonctions telles que filter_var et mysqli_real_escape_string)

    // Supposons que vous avez une connexion à la base de données $conn

    // Mettez à jour le solde du compte du client
    $requete_depot = "UPDATE Compte SET Solde = Solde + $montant WHERE ID_Client = {id_client}";

    // Exécutez la requête
    if (mysqli_query($conn, $requete_depot)) {
        // Redirigez l'utilisateur vers la page du compte après le dépôt
        header("Location: compte.php");
        exit();
    } else {
        // Gérez l'erreur (par exemple, affichez un message d'erreur à l'utilisateur)
        echo "Erreur lors du dépôt : " . mysqli_error($conn);
    }
}



    // Redirigez l'utilisateur vers la page du compte après le dépôt
    header("Location: compte.php");
    exit();
}
?>
