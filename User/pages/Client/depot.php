<?php
if (isset($_SESSION['compte'])) {
    $compte = $_SESSION['compte'];
    $idCompte = $compte['idCompte'];
    $info = getAll($idCompte);
    if ($info['statutCompte'] === 'bloquer' || $info['statutCompte']==='non verifier' || $info['statutCompte']==='verification en cours') {
        header("Location: index.php?page=Accueil/error");
    }
} else {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faire un Depot</title>
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 50px;
        }

        h1 {
            color: #007bff; 
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            color: #495057;
            font-weight: bold;
        }

        .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 10px;
        }

        .input-group {
            position: relative;
            width: 100%;
        }

        .input-group .input-addon {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .input-addon{
            color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 10px 20px;
        }

        .btn-primary,
        .btn-secondary,
        .btn-outline-secondary {
            color: #ffffff;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="container mt-5">
    <h1>Faire un Depot</h1>

    <form  action="index.php" method="post">
        <div class="form-group">
            <label for="montant">Montant du Depot (minimum 200):</label>
            <input type="number" name="montant" id="montant" class="form-control" required>
            <div class="error-message" id="montantError"></div>
        </div>
        <div class="form-group" hidden>
            <input type="number" name="idCompte" class="form-control" value="<?=$idCompte;?>">
        </div>
        <div class="form-group">
            <label for="codeValid">Code de Validation:</label>
            <div class="input-group">
                <input type="text" name="codeValid" id="codeValid" class="form-control" required>
                <div class="input-addon" onclick="pasteCode()" title="Coller">
                    <i class="fa fa-paste"></i>
                </div>
            </div>
            <div class="error-message" id="codeValidError"></div>
        </div><br>

        <button id="depotForm" name="depot" type="submit" class="btn btn-primary" onclick="validateDeposit()">Valider le Depot</button>
    </form>

    <a href="index.php?page=Client/accueil" class="btn btn-secondary mt-3">Retour à Mon Compte</a>
</div>

<script>
    function validateDeposit() {
        // Reset error messages
        document.getElementById("montantError").textContent = "";
        document.getElementById("codeValidError").textContent = "";

        // Get input values
        var montant = document.getElementById("montant").value;
        var codeValid = document.getElementById("codeValid").value;

        // Validate deposit amount
        if (montant < 200 || isNaN(montant)) {
            document.getElementById("montantError").textContent = "Montant invalide (minimum 200)";
            return;
        }

        // Validate codeValid
        if (codeValid.length === 0) {
            document.getElementById("codeValidError").textContent = "Code de Validation requis";
            return;
        }

        // If all validations pass, submit the form
        document.getElementById("depotForm").submit();
    }

    function pasteCode() {
        navigator.clipboard.readText().then(function (text) {
            document.getElementById("codeValid").value = text;
        });
    }
</script>

</body>
</html>
