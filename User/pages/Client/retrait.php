<?php
if (isset($_SESSION['compte'])) {
    $compte = $_SESSION['compte'];
    $idCompte = $compte['idCompte'];
    $info = getAll($idCompte);
    $code = generateUniqueCode();

    if ($info['statutCompte'] === 'bloquer'  || $info['statutCompte'] === 'non verifier' || $info['statutCompte'] === 'verification en cours') {
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
    <title>Faire un Retrait</title>
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
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
            margin-right: 20px;
        }

        label {
            color: #495057;
            font-weight: bold;
            display: block;
            width: 100%;
            margin-bottom: 5px;
        }

        .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 15px;
            width: 100%;
        }

        .input-group {
            margin-bottom: 15px;
            position: relative;
            width: 100%;
        }

        .input-group .copy-icon {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
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

        .account-balance {
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
            margin-top: 20px;
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
        <h1>Faire un Retrait</h1>

        <div class="account-balance">
            Montant total du compte: $<?= $info['Solde']; ?>
        </div><br><br>

        <form  name="retrait" action="index.php" method="post">
            <div class="form-group">
                <label for="montant">Montant du Retrait (minimum 200):</label>
                <div class="input-group">
                    <input type="number" name="montant" id="montant" class="form-control" required>
                </div>
                <div class="error-message" id="montantError"></div>
            </div>
            <div class="form-group">
                <label for="numCompte">Numero du Compte Depot (format: XXXX-XXXX-XXXX-XXXX):</label>
                <div class="input-group">
                    <input type="text" name="numCompte" id="numCompte" class="form-control" required>
                </div>
                <div class="error-message" id="numCompteError"></div>
            </div>
            <div class="form-group" hidden>
                <input type="number" name="idCompte" class="form-control" value="<?= $idCompte; ?>">
            </div>
            <div class="form-group">
                <label for="code">Code de Validation Retrait:</label>
                <div class="input-group">
                    <input type="text" name="codeValid" class="form-control" value="<?= $code; ?>" readonly id="validationCode">
                    <div class="input-group-append">
                        <div class="input-group-text copy-icon" onclick="copyValidationCode()" title="Copier">
                            <i class="fa fa-copy"></i>
                        </div>
                    </div>
                </div>
            </div>

            <button id="retraitForm" type="button" name="retrait" class="btn btn-primary" onclick="validateWithdrawal()">Valider le Retrait</button>
        </form><br><br>

        <a href="index.php?page=Client/accueil" class="btn btn-secondary mt-3">Retour à Mon Compte</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script>
        function validateWithdrawal() {
            // Reset error messages
            document.getElementById("montantError").textContent = "";
            document.getElementById("numCompteError").textContent = "";

            // Get input values
            var montant = document.getElementById("montant").value;
            var numCompte = document.getElementById("numCompte").value;

            // Validate withdrawal amount
            if (montant < 200 || isNaN(montant)) {
                document.getElementById("montantError").textContent = "Montant invalide (minimum 200)";
                return;
            }

            // Validate account number format
            var numCompteRegex = /^\d{4}-\d{4}-\d{4}-\d{4}$/;
            if (!numCompte.match(numCompteRegex)) {
                document.getElementById("numCompteError").textContent = "Format de numéro de compte invalide";
                return;
            }

            // Check if withdrawal amount is greater than account balance
            if (parseFloat(montant) > <?= $info['Solde']; ?>) {
                document.getElementById("montantError").textContent = "Le montant du retrait ne peut pas dépasser le solde du compte";
                return;
            }

            // If all validations pass, show the SweetAlert with the validation code
            var validationCode = "<?= $code; ?>";

            Swal.fire({
                title: 'Valider l\'operation',
                html: 'Votre code de validation est :<br><b id="validationCode">' + validationCode + '</b>',
                icon: 'info',
                showConfirmButton: true,
                confirmButtonText: 'OK',
                showCancelButton: true,
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("retraitForm").type = "submit";
                    document.getElementById("retraitForm").submit();
                }
            });
        }

        function copyValidationCode() {
            var validationCodeElement = document.getElementById("validationCode");
            var tempInput = document.createElement("input");
            tempInput.value = validationCodeElement.value;
            document.body.appendChild(tempInput);

            // Sélectionner et copier le texte
            tempInput.select();
            document.execCommand("copy");

            // Supprimer l'élément temporaire
            document.body.removeChild(tempInput);

            // Afficher une notification de copie réussie
            Swal.fire({
                title: 'Code copié !',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            });
        }
    </script>

</body>

</html>