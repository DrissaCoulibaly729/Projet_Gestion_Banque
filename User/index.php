<?php
session_start();

require_once "db/connexiondb.php";
require_once "db/allFunction.php";

if (isset($_POST['inscription'])) {
    extract($_POST);
    $NomClient = trim(htmlspecialchars($Nom));
    $PrenomClient = trim(htmlspecialchars($Prenom));
    $EmailClient = trim(htmlspecialchars($Email));
    $TelClient = trim(htmlspecialchars($Tel));
    $LoginClient = trim(htmlspecialchars($Login));
    $Password = trim(htmlspecialchars(md5($Password)));
    $codeTypeCompte = trim(htmlspecialchars($Compte));
    echo $codeTypeCompte;
    $User = addUser($NomClient, $PrenomClient, $EmailClient, $LoginClient, $Password, $TelClient);
    if ($User) {
        addStatutCompte();
        $statut = getLatestStatutCompteId();
        $idStatutCompte_FK = $statut;
        $getCompte = getIdTypeCompte($codeTypeCompte);
        $idTypeCompte_FK = $getCompte['idTypeCompte'];
        $get = getAllClientsbyLoginAndPassword($Login, $Password);
        $idClient_FK = $get['idClient'];
        $numCompte = generateNumeroCompte();
        addCompte($numCompte, $idClient_FK, $idTypeCompte_FK, $idStatutCompte_FK);
        
        $to = $EmailClient;
        $subject = "Bienvenue";
        $message = "Bonjour " . $NomClient . " " . $PrenomClient . ",<br><br>Bienvenue !<br><br>Votre compte a été créé avec succès. Nous vous invitons à vérifier votre compte afin de pouvoir profiter pleinement de nos services.<br><br>Merci et à bientôt !";
        sendEmail($to, $subject, $message);
        // $_GET['page']="userAuthInscrit/auth";
        header("Location: index.php?page=userAuthInscrit/auth");
    } else {
        echo 'l utilisateur existe deja';
    }
}

if (isset($_POST['auth'])) {
    extract($_POST);
    $LoginClient = $Login;
    $Password = md5($Password);
    $user = getAllClientsbyLoginAndPassword($LoginClient, $Password);
    var_dump($user);
    echo $user;
    $compte = getCompte($user['idClient']);
    if ($compte) {
        //$_SESSION['user_id'] = $user['idClient'];
        $_SESSION['compte'] = $compte;
        header("Location: index.php?page=Client/accueil");
    } else {
        header("Location: index.php?page=userAuthInscrit/auth&message=failed");
    }
}

if (isset($_POST['verif'])) {
    if (isset($_SESSION['compte'])) {
        $compte = $_SESSION['compte'];
        $idCompte = $compte['idCompte'];
        $info = getAll($idCompte);
        if ($info['statutCompte'] === 'bloquer') {
            header("Location: index.php?page=Accueil/error");
        }
    } else {
        header("Location: index.php");
    }
    extract($_POST);

    $date = trim(htmlspecialchars($DateNaiss));
    //echo $date;
    $nat = trim(htmlspecialchars($nationnaliter));
    $numCni = trim(htmlspecialchars($CNI));
    $adress = trim(htmlspecialchars($Adresse));
    $codePostal = trim(htmlspecialchars($Postal));
    $ville = trim(htmlspecialchars($Ville));

    $recto = "client_" . $info['idClient'] . "_" . time() . "_" . $_FILES["Recto"]["name"];
    //echo $recto;
    $destinationFolderRecto = "../Admin/assets/img/Client/Recto/";
    //$destinationPathRecto= $destinationFolderRecto . $recto;

    $rectoPath = uploadFile($_FILES["Recto"]["tmp_name"], $destinationFolderRecto, $recto);
    //move_uploaded_file($_FILES["Recto"]["tmp_name"], $destinationPathRecto);


    $verso = "client_" . $info['idClient'] . "_" . time() . "_" . $_FILES["Verso"]["name"];
    $destinationFolderVerso = "../Admin/assets/img/Client/Verso/";
    //$destinationPathVerso = $destinationFolderVerso . $verso;

    $versoPath = uploadFile($_FILES["Verso"]["tmp_name"], $destinationFolderVerso, $verso);
    //move_uploaded_file($_FILES["Verso"]["tmp_name"], $destinationPathVerso);

    $profil = "client_" . $info['idClient'] . "_" . time() . "_" . $_FILES["Profil"]["name"];
    $destinationFolderProfil = "../Admin/assets/img/Client/Profil/";
    $destinationPathProfil = $destinationFolderProfil . $profil;

    //echo $_FILES["Profil"]["tmp_name"];

    $profilPath = uploadFile($_FILES["Profil"]["tmp_name"], $destinationFolderProfil, $profil);
    //move_uploaded_file($_FILES["Profil"]["tmp_name"], $destinationPathProfil);

    $idCompte_FK = $info['idCompte'];

    if ($rectoPath !== false && $versoPath !== false && $profilPath !== false) {
        $addVerifi = addverifUser($date, $nat, $numCni, $adress, $codePostal, $ville, $recto, $verso, $profil, $idCompte_FK);
        // echo $info['idStatutCompte_FK'];
        // echo $addVerifi;
        if ($addVerifi) {
            updateStatuCompte($info['idStatutCompte_FK'], "verification en cours");
            $to = $info['emailClient'];
            $subject = "Verification en cours";
            $message = "Bonjour " . $info['nomClient'] . " " . $info['prenomClient'] . ",<br><br>Merci !<br><br>Votre Demande de Verification a été pris avec succès. Veuillez patienter pendant que nous vérifions votre compte. Une fois la vérification terminée, vous pourrez profiter pleinement de nos services.<br><br>Merci pour votre patience et à bientôt !";
            sendEmail($to, $subject, $message);
            header("Location: index.php?page=Client/accueil");
        } else {
            header("Location: index.php?page=Client/verif&message=failed");
        }
    } else {
    }
}

if (isset($_POST['depot'])) {
    extract($_POST);

    $montantOperation = trim(htmlspecialchars($montant));
    $codeValidation = trim(htmlspecialchars($codeValid));
    $idCompte_FK = trim(htmlspecialchars($idCompte));
    echo  $idCompte_FK . '      ';
    $ope = getOperation($codeValidation);
    $compteD = getComptebyid($idCompte_FK);
    echo $compteD['numCompte'];
    //var_dump($ope);
    //echo $ope['numCompteBeneficiaire_FK'];

    if ($compteD['numCompte'] === $ope['numCompteBeneficiaire_FK']) {
        $compteR = getComptebyid($ope['idCompte_FK']);
        // var_dump($compteR);
        $numCompteBeneficiaire_FK = $compteR['numCompte'];
        //echo $numCompteBeneficiaire_FK;
        $benef = addBeneficiaire($idCompte_FK, $numCompteBeneficiaire_FK);
        var_dump($benef);

        addOperation($montantOperation, 'depot', $numCompteBeneficiaire_FK, $codeValidation, $idCompte_FK);
        $to = $compteD['idClient'];
        $subject = "Verification en cours";
        $message = "Bonjour " . $compteD['nomClient'] . " " . $compteD['prenomClient'] . ",<br><br>Nous vous informons que votre dépôt a été enregistré avec succès et est actuellement en cours de traitement. Veuillez patienter pendant que nous traitons votre transaction. Une fois le traitement terminé, vous recevrez une confirmation par e-mail.<br><br>Nous vous remercions pour votre confiance et votre patience.<br><br>Cordialement.";
        sendEmail($to, $subject, $message);
        header("Location: index.php?page=Client/accueil");
        
    } else {
        header("Location: index.php?page=Client/depot&message=failed");
    }

    //var_dump($user);
    //echo $user;

}

if (isset($_POST['retrait'])) {
    extract($_POST);

    $montantOperation = trim(htmlspecialchars($montant));
    $numCompteBeneficiaire_FK = trim(htmlspecialchars($numCompte));
    $idCompte_FK = trim(htmlspecialchars($idCompte));
    $codeValidation = trim(htmlspecialchars($codeValid));

    $compteR = getComptebyid($idCompte);

    echo $compteR['Solde'];

    if ($compteR['Solde'] >= $montantOperation) {

        addBeneficiaire($idCompte_FK, $numCompteBeneficiaire_FK);

        addOperation($montantOperation, 'retrait', $numCompteBeneficiaire_FK, $codeValidation, $idCompte_FK);
        $to = $compteR['emailClient'];
        $subject = "Verification en cours";
        $message = "Bonjour " . $compteR['nomClient'] . " " . $compteR['prenomClient'] . ",<br><br>Nous vous informons que votre Retrait a été enregistré avec succès et est actuellement en cours de traitement. Veuillez patienter pendant que nous traitons votre transaction. Une fois le traitement terminé, vous recevrez une confirmation par e-mail.<br><br>Nous vous remercions pour votre confiance et votre patience.<br><br>Cordialement.";
        sendEmail($to, $subject, $message);
        header("Location: index.php?page=Client/accueil");
    } else {
        header("Location: index.php?page=Client/retrait&message=failed");
    }

    //var_dump($user);
    //echo $user;

}

if(isset($_POST['userMdp']))
{
    extract($_POST);

    $adm=getClientbyEmail($email);
   
    if ($adm) {
        $id=$adm['idClient'];
        $passwordC = generatePassword();
        $password = trim(htmlspecialchars(md5($passwordC)));
        $to = $email;
        $subject = "Votre nouveau Mot de passe";
        $message = "Bonjour " .$adm['nomClient'] . " " . $adm['prenomClient'] . ",<br><br>Votre Mot de passe  a été change avec succès!<br><br>Votre nouveau mot de passe est :<strong> " . $passwordC . "</strong><br><strong>Nous vous recommandons de modifier votre mot de passe après la connexion pour des raisons de sécurité</strong>.";
        
        updatePasswordClient($id, $password);
        sendEmail($to, $subject, $message);
        header("Location: index.php?page=userAuthInscrit/auth");

    }
}

if (isset($_GET['page'])) {
    if ($_GET['page'] == "deconnexion") {
        if (isset($_SESSION['compte'])) {
            unset($_SESSION['compte']);
        }
        header("Location: index.php");
    }
    include_once "pages/" . $_GET['page'] . ".php";
} else {
    include_once 'pages/Accueil/accueil.php';
}
