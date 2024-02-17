<?php
if (isset($_SESSION['compte']) && isset($_POST['facture'])) {
    $url = $_SERVER['REQUEST_URI'];
    extract($_POST);
    $id = $idOpe;
    echo "L'URL actuelle est : $url";
    $compte = $_SESSION['compte'];
    //var_dump( $compte);
    $idCompte = $compte['idCompte'];
    $info = getAll($idCompte);
    $ope = getOperationbyIdOpe($id);
}else{
    header("Location: index.php?page=Accueil/error");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture de Dépôt</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #3498db;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }

        td.total {
            font-weight: bold;
        }

        .download-link {
            margin-top: 20px;
        }

        .download-link .button {
            text-decoration: none;
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php
        // Informations de la facture
        $nomClient = $info['prenomClient'] . ' ' . $info['nomClient'];
        $typeTransaction = $ope['typeOperation']; // ou "Retrait"
        $dateTransaction = $ope['dateOperation'];
        $montantTransaction = $ope['montantOperation']; // Montant du dépôt ou retrait
        if ($ope['typeOperation'] === 'depot') {
            $envoyeur = $ope['prenomClient'] . ' ' . $ope['nomClient'];
            $receiver = $info['prenomClient'] . ' ' . $info['nomClient'];
        } else {
            $envoyeur =  $info['prenomClient'] . ' ' . $info['nomClient'];
            $receiver = $ope['prenomClient'] . ' ' . $ope['nomClient'];
        }
        if($ope['acceptationOperation']==='vrai'){
            $statut = "Terminer";
        }elseif ($ope['acceptationOperation']==='faux') {
            $statut = "En Cours";
        }else{
            $statut = "Rejeter";
        }
        
        ?>

        <h1>Facture de <?php echo $typeTransaction; ?></h1>
        <p>Client: <?php echo $nomClient; ?></p>
        <p>Date: <?php echo $dateTransaction; ?></p>
        <p>Statut Operation: <?php echo $statut; ?></p>
        <p>Envoyeur: <?php echo $envoyeur; ?></p>
        <p>Receiver: <?php echo $receiver; ?></p>

        <table>
            <thead>
                <tr>
                    <th>Type de transaction</th>
                    <th>Montant</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $typeTransaction; ?></td>
                    <td>$<?php echo $montantTransaction; ?></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td class="total" colspan="2">Total: $<?php echo $montantTransaction; ?> </td>
                </tr>
            </tfoot>
        </table>

        <form action="index.php?page=Client/generatePdf" method="post">
            <input type="hidden" name="nomClient" value="<?=$nomClient?>">
            <input type="hidden" name="typeTransaction" value="<?=$typeTransaction?>">
            <input type="hidden" name="dateTransaction" value="<?=$dateTransaction?>">
            <input type="hidden" name="montantTransaction" value="<?=$montantTransaction?>">
            <input type="hidden" name="statutOp" value="<?=$statut?>">
            <input type="hidden" name="envoyeur" value="<?=$envoyeur?>">
            <input type="hidden" name="receiver" value="<?=$receiver?>">
            <div class="download-link">
                <button class="button" name="pdf">Télécharger la facture au format PDF</button>
            </div>
            <div class="download-link">
                <a href="index.php?page=Client/accueil" class="button" name="">Retour à L'accueil</a>
            </div>
        </form>


    </div>

</body>

</html>