<?php
//var_dump ($_GET);
if (isset($_SESSION['compte'])) {
   
    $compte = $_SESSION['compte'];
    $idCompte = $compte['idCompte'];
    $info = getAll($idCompte);
    //var_dump ($info);
} else {
    header("Location: index.php");
}

if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['user1']) ){
    
    extract($_POST);
    $email = $info['emailClient'];
   // var_dump($_POST);
   // echo  $email;
    $adm=getClientbyEmail($email);
   // var_dump($adm);
    if ($adm) {
        $id=$adm['idClient'];
       // echo $id;
        $passwordC = trim(htmlspecialchars(md5($currentPassword)));
        $passwordN =  trim(htmlspecialchars(md5($newPassword)));
        $passwordConf =  trim(htmlspecialchars(md5($confirmPassword)));
        //echo $passwordC.' ';
       // echo$adm['passwordClient'];
        //echo '  id='.$id;
        if ($passwordC === $adm['passwordClient'] && $passwordConf === $passwordN) {

        $to = $adm['emailClient'];
        $subject = "Changement de mot de passe";
        $message = "Bonjour " .$adm['nomClient'] . " " . $adm['prenomClient'] . ",<br><br>Votre Mot de passe  a été change avec succès!<br><br>.";
        
        updatePasswordClient($id, $passwordN);
        sendEmail($to, $subject, $message);
        }

    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Changement de mot de passe</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
.form-container {
    max-width: 400px;
    margin: auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-weight: bold;
}

.form-group input[type="password"] {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.btn-primary {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: none;
    background-color: #007bff;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: #0056b3;
}
</style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="form-container">
                <h2 class="text-center">Changer le mot de passe</h2>
                <form action="index.php?page=userAuthInscrit/updatePassword" method="post" onsubmit="return validatePassword()">
                <input type="hidden" name="email" value='<?= $info['emailClient']?>;'>
                    <div class="form-group">
                        <label for="currentPassword">Mot de passe actuel</label>
                        <input type="password" id="currentPassword" name="currentPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">Nouveau mot de passe</label>
                        <input type="password" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirmer le nouveau mot de passe</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" required>
                    </div>
                   
                    <button type="submit" class="btn btn-primary" name="user1" >Changer le mot de passe</button>
                    <a href="index.php?page=Client/accueil" class="btn btn-secondary"  >Retour à l'accueil</a>
                  
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function validatePassword() {
    const password = document.getElementById("newPassword").value;
    // Ajouter vos contrôles spécifiques pour le mot de passe ici
    if (/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_]).{8,}$/.test(password)) {
        document.getElementById("newPassword").style.borderColor = "green";
        return true;
    } else {
        document.getElementById("newPassword").style.borderColor = "red";
        return false;
    }
}
</script>
</body>
</html>
