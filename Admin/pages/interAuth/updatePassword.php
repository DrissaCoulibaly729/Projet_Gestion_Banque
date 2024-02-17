<?php
//var_dump ($_GET);
if (isset($_SESSION['Admin']) || isset($_SESSION['Caissier']) || isset($_SESSION['Gestionnaire']) ) {
    if ($_GET['message']==='Nimda00' || $_GET['message']==='reisca120' || $_GET['message']==='ergesn4152') {
    
        if ($_GET['message']==='Nimda00') {
            $values =$_SESSION['Admin'];
            $value = $values["emailAdmin"];
            $name = 'Nimda00';
            //var_dump($value);
        } elseif ($_GET['message']==='reisca120') {
            $values =$_SESSION['Caissier'];
            $value = $values["emailCaissier"];
            $name = 'reisca120';
        }elseif ($_GET['message']==='ergesn4152') {
            $values =$_SESSION['Gestionnaire'];
            $value = $values["emailGestionnaire"];
            $name = 'ergesn4152';
        }
   
} 
} else {
    header("Location: index.php");
}

if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['reisca120']) ){
    
    extract($_POST);

    $adm=getCaissierbyEmail($value);
    if ($adm) {
        $id=$adm['idCaissier'];
        
        $passwordC = trim(htmlspecialchars(md5($currentPassword)));
        $passwordN =  trim(htmlspecialchars(md5($newPassword)));
        $passwordConf =  trim(htmlspecialchars(md5($confirmPassword)));
       /*  echo $passwordC.' ';
        echo$adm['passwordCaissier'];
        echo '  id='.$id; */
        if ($passwordC === $adm['passwordCaissier'] && $passwordConf === $passwordN) {

        $to = $value;
        $subject = "Changement de mot de passe";
        $message = "Bonjour " .$adm['nomCaissier'] . " " . $adm['prenomCaissier'] . ",<br><br>Votre Mot de passe  a été change avec succès!<br><br>.";
        
        updatePasswordCaiss($id, $passwordN);
        sendEmail($to, $subject, $message);
        }

    }

}

if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['Nimda00']) ){
    
    extract($_POST);

    $adm=getAdminbyEmail($value);
    if ($adm) {
        $id=$adm['idAdmin'];
        
        $passwordC = trim(htmlspecialchars(md5($currentPassword)));
        $passwordN =  trim(htmlspecialchars(md5($newPassword)));
        $passwordConf =  trim(htmlspecialchars(md5($confirmPassword)));
       /*  echo $passwordC.' ';
        echo$adm['passwordAdmin'];
        echo '  id='.$id; */
        if ($passwordC === $adm['passwordAdmin'] && $passwordConf === $passwordN) {

        $to = $value;
        $subject = "Changement de mot de passe";
        $message = "Bonjour " .$adm['nomAdmin'] . " " . $adm['prenomAdmin'] . ",<br><br>Votre Mot de passe  a été change avec succès!<br><br>.";
        
        updatePasswordAdm($id, $passwordN);
        sendEmail($to, $subject, $message);
        }else{
            header("Location: index.php?page=");
        }

    }

}

if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['ergesn4152']) ){
    
    extract($_POST);

    $adm=getGestionnairebyEmail($value);
    if ($adm) {
        $id=$adm['idGestionnaire'];
        
        $passwordC = trim(htmlspecialchars(md5($currentPassword)));
        $passwordN =  trim(htmlspecialchars(md5($newPassword)));
        $passwordConf =  trim(htmlspecialchars(md5($confirmPassword)));
       /*  echo $passwordC.' ';
        echo$adm['passwordGestionnaire'];
        echo '  id='.$id; */
        if ($passwordC === $adm['passwordGestionnaire'] && $passwordConf === $passwordN) {

        $to = $value;
        $subject = "Changement de mot de passe";
        $message = "Bonjour " .$adm['nomGestionnaire'] . " " . $adm['prenomGestionnaire'] . ",<br><br>Votre Mot de passe  a été change avec succès!<br><br>.";
        
        updatePasswordGest($id, $passwordN);
        sendEmail($to, $subject, $message);
        }else{
            header("Location: index.php?");
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
                <form action="index.php?page=interAuth/updatePassword&message=<?=$name;?>" method="post" onsubmit="return validatePassword()">
                <input type="hidden" name="id" value='<?= $value?>;'>
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
                    <?php if(isset($_SESSION['Caissier'])){
                    if ( $values === $_SESSION['Caissier']) {
                       
                    ?>
                    <button type="submit" class="btn btn-primary" name="reisca120" >Changer le mot de passe</button>
                    <a href="index.php?page=caissier/accueil" class="btn btn-secondary"  >Retour à l'accueil</a>
                    <?php  } 
                    } 
                    if ( isset($_SESSION['Gestionnaire'])) {
                    if( $values === $_SESSION['Gestionnaire']){?>
                    <button type="submit" class="btn btn-primary" name="ergesn4152" >Changer le mot de passe</button>
                    <a href="index.php?page=gestionnaire/accueil" class="btn btn-secondary"  >Retour à l'accueil</a>
                        <?php } } 
                         if(isset($_SESSION['Admin'])){
                        if ( $values === $_SESSION['Admin']) {?>
                        <button type="submit" class="btn btn-primary" name="Nimda00" >Changer le mot de passe</button>
                    <a href="index.php?page=admin/accueil" class="btn btn-secondary"  >Retour à l'accueil</a>
                            <?php } }?>
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
