
<?php
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['compte'])) {
    $compte = $_SESSION['compte'];
    $idCompte = $compte['idCompte'];
    $info = getAll($idCompte);

    // Vérifier le statut du compte
    if ($info['statutCompte'] === 'bloquer') {
        header("Location: index.php?page=Accueil/error");
    }

    // Traitement de la soumission du formulaire de modification
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
        // Récupération des données du formulaire
        $newNom = trim(htmlspecialchars($_POST['newNom']));
        $newPrenom = trim(htmlspecialchars($_POST['newPrenom']));
        $newLogin = trim(htmlspecialchars($_POST['newLogin']));
        $newEmail = trim(htmlspecialchars($_POST['newEmail']));
        $newTel = trim(htmlspecialchars($_POST['newTel']));

        // Mettre à jour les informations dans la base de données
        updateUser($info['idClient'], $newNom, $newPrenom, $newLogin, $newEmail, $newTel);

        // Rafraîchir les informations après la mise à jour
        $info = getAll($idCompte);
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
    <title>Mon Profil</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
        }

        .card-body {
            padding: 30px;
        }

        .card img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }


        hr {
            border-top: 1px solid #dee2e6;
        }

        .profile-info p {
            margin-bottom: 0;
            font-size: 16px;
            color: #495057;
        }

        .profile-info h5 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #007bff;
        }

        .profile-info .btn-primary {
            font-size: 16px;
        }

        .form-container {
            display: none;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .form-container {
            max-width: 500px;
            margin: auto;
            margin-top: 20px;
        }

        .form-container .card {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .form-container .card-body {
            padding: 20px;
        }

        .form-container h5 {
            color: #007bff;
        }

        .form-container label {
            font-weight: bold;
        }

        .form-container input {
            margin-bottom: 15px;
        }

        .form-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container"  >
        <section style="background-color: #f8f9fa;" >
            <div class="container py-5" id="container"  style="display: block;">
                <!-- Affichage du profil -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <?php if ($info['profilClient'] !== NULL) { ?>
                                    <img src="../Admin/assets/img/Client/Profil/<?= $info['profilClient'] ?>" alt="avatar" class="rounded-circle img-fluid">
                                <?php } else { ?>
                                    <img src="../Admin/assets/img/img/télécharger.jpeg" alt="avatar" class="rounded-circle img-fluid">
                                <?php } ?>
                                <h5 class="my-3"><?php echo $info['nomClient'] . ' ' . $info['prenomClient']; ?></h5>
                                <div class="d-flex justify-content-center mb-2">
                                    <a href="index.php?page=Client/accueil" type="button" class="btn btn-primary">Accueil</a>
                                    <button type="button" class="btn btn-primary ms-1" onclick="toggleForm()">Modifier</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body profile-info">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h5>Nom</h5>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?php echo $info['nomClient']; ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h5>Prénom</h5>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?php echo $info['prenomClient']; ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h5>Login</h5>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?php echo $info['loginClient']; ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h5>Email</h5>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?php echo $info['emailClient']; ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h5>Phone</h5>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?php echo $info['telClient']; ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h5>Adresse</h5>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?php echo $info['adresseClient']; ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h5>Numero Compte</h5>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?php echo $info['numCompte']; ?></p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Formulaire de modification -->
        <div class="container form-container" id="formContainer" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Modifier le profil</h5>
                    <form action="index.php?page=Client/profil" method="post">
                        <div class="mb-3">
                            <label for="newNom" class="form-label">Nouveau Nom</label>
                            <input type="text" class="form-control" id="newNom" name="newNom" value="<?php echo $info['nomClient']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="newPrenom" class="form-label">Nouveau Prénom</label>
                            <input type="text" class="form-control" id="newPrenom" name="newPrenom" value="<?php echo $info['prenomClient']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="newLogin" class="form-label">Nouveau Login</label>
                            <input type="text" class="form-control" id="newLogin" name="newLogin" value="<?php echo $info['loginClient']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="newEmail" class="form-label">Nouvel Email</label>
                            <input type="email" class="form-control" id="newEmail" name="newEmail" value="<?php echo $info['emailClient']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="newTel" class="form-label">Nouveau Numéro de Téléphone</label>
                            <input type="tel" class="form-control" id="newTel" name="newTel" value="<?php echo $info['telClient']; ?>">
                        </div>
                        <div class="text-end">
                            <button type="submit" name="modifier" class="btn btn-primary">Enregistrer les modifications</button>
                            <button type="submit" name="" class="btn btn-info" onclick="toggleForm()" >Retour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleForm() {
            var formContainer = document.getElementById("formContainer");
            formContainer.style.display = formContainer.style.display === "none" ? "block" : "none";
            console.log(formContainer.style.display);
            var container = document.getElementById("container");
            container.style.display = container.style.display === "block" ? "none" : "block";
        }
    </script>
</body>

</html>