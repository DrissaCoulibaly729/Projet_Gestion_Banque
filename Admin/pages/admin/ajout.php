<?php
if (isset($_SESSION['Admin'])) {
    if (isset($_POST['caissier']) || isset($_POST['gestionnaire'])) {
        if (isset($_POST['caissier'])) {
            $name ='caissierC';
            echo $name;
        } elseif (isset($_POST['gestionnaire'])) {
            $name = 'gestionnaireG';
            echo $name;
        }
    } else {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>
  <link rel="stylesheet" href="assets/css/admin/styleAjout.css">
</head>
<body>
  <div class="container">
    <h2>Inscription</h2>
    <form onsubmit="return validateForm();" action="index.php" method="post" enctype="multipart/form-data" >
      <div class="form-group">
        <input type="text" id="nom" placeholder="Nom" name="nom" onblur="validateNom()">
        <div class="error-message" id="nom-error"></div>
      </div>
      <div class="form-group">
        <input type="text" id="prenom" placeholder="Prénom" name="prenom" onblur="validatePrenom()">
        <div class="error-message" id="prenom-error"></div>
      </div>
      <div class="form-group">
        <input type="date" id="dateNaissance" placeholder="Date de naissance" name="dateNaiss" onblur="validateDateNaissance()">
        <div class="error-message" id="dateNaissance-error"></div>
      </div>
      <div class="form-group">
        <input type="email" id="email" placeholder="Email" name="email" onblur="validateEmail()">
        <div class="error-message" id="email-error"></div>
      </div>
      <div class="form-group">
        <input type="file" id="photoProfil" placeholder="Photo de profil" name="profil" onblur="validatePhotoProfil()">
        <div class="error-message" id="photoProfil-error"></div>
      </div>
      <div class="form-group">
        <input type="tel" id="tel" placeholder="Téléphone" name="tel" onblur="validateTel()">
        <div class="error-message" id="tel-error"></div>
      </div>
      <div class="form-group">
        <input type="text" id="numCni" placeholder="Numéro CNI" name="cni" onblur="validateNumCni()">
        <div class="error-message" id="numCni-error"></div>
      </div>
      <div class="form-group">
        <input type="text" id="login" placeholder="Login" name="Login" onblur="validateLogin()">
        <div class="error-message" id="login-error"></div>
      </div>
      <button type="submit" name="<?= $name?>" onsubmit="validateForm()">S'inscrire</button>
    </form>
  </div>

  <script src="assets/js/admin/scriptAjout.js"></script>
</body>
</html>
