<?php
if (isset($_SESSION['compte'])) {
    $compte = $_SESSION['compte'];
    $idCompte = $compte['idCompte'];
    $info = getAll($idCompte);
    if ($info['statutCompte'] === 'bloquer'|| $info['statutCompte'] === 'verification en cours' ||
    $info['statutCompte'] === 'verifier') {
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
    <title>Faire une Vérification</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/css/bootstrap.min.css">
    <link href="assets/select2-develop/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 80%;
            box-sizing: border-box;
        }

        .form-outline {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
        }

        .form-check {
            margin-top: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        

        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
</head>

<body>

    <div class="container">
        <form onsubmit="return validateForm();" action="index.php" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-12 text-center mb-4">
                    <h2 class="text-primary">Faire une Vérification</h2>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="validationDefault01" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="Nom" id="Nom" value="<?php echo $info['nomClient'] ?>" disabled>
                </div>
                <div class="col-md-6">
                    <label for="validationDefault02" class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="Prenom" id="Prenom" value="<?php echo $info['prenomClient'] ?>" disabled>
                </div>
            </div><br>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="validationDefault01" class="form-label">Date de Naissance</label>
                    <input type="date" class="form-control" name="DateNaiss" id="DateNaiss" onchange="validateDateNaiss()">
                </div>
                <div class="col-md-6">
                    <label for="validationDefault01" class="form-label">Nationalité</label>
                    <select class="form-control w-100" name="nationnaliter" data-width="100%" id="single" data-placeholder="Choose one thing">
                        <option></option>
                        <option name="congo">Congo</option>
                        <option name="mali">Mali</option>
                        <option name="mauritanie">Mauritanie</option>
                        <option name="senegal">Senegal</option>
                    </select>
                </div>
            </div><br>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="validationDefault01" class="form-label">Num CNI</label>
                    <input type="number" class="form-control" name="CNI" id="CNI" onchange="validateCni()">
                </div>
                <div class="col-md-6">
                    <label for="validationDefault05" class="form-label">Adresse de Résidence</label>
                    <input type="text" class="form-control" name="Adresse" id="Adresse" onchange="validateAdresseResidence()">
                </div>
            </div><br>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="validationDefault03" class="form-label">Code Postal</label>
                    <input type="number" class="form-control" name="Postal" id="Postal" onchange="validateCodePostal()">
                </div>
                <div class="col-md-6">
                    <label for="validationDefault05" class="form-label">Ville</label>
                    <input type="text" class="form-control" name="Ville" id="Ville" onchange="validateVille()">
                </div>
            </div><br>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="customFile">Recto CNI</label>
                    <input type="file" class="form-control" name="Recto" id="Recto" onchange="validatePhotoRectoCni()">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="customFile">Verso CNI</label>
                    <input type="file" class="form-control" name="Verso" id="Verso" onchange="validatePhotoVersoCni()">
                </div>
            </div><br>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="customFile">Profil</label>
                    <input type="file" class="form-control" name="Profil" id="Profil" onchange="validatePhotoProfil()">
                </div>
            </div><br>
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="Check" onchange="validateCheck()">
                        <label class="form-check-label" for="Check">Agree to terms and conditions</label>
                    </div>
                </div>
            </div><br>
            <div class="row g-3">
                <div class="col-12">
                    <button class="btn btn-primary" type="submit" name="verif" onsubmit="validateForm()">Soumettre le formulaire</button>
                </div>
            </div>
        </form>
    </div>
    <script src="assets/js/client/verif.js"></script>
</body>

</html>
