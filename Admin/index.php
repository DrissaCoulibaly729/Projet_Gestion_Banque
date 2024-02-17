<?php
session_start();

require_once "db/connexiondb.php";
require_once "db/allFunction.php";

if (isset($_POST['inscription'])) {
}

if (isset($_POST['loginAdm'])) {

    extract($_POST);

    $LoginAdmin =trim(htmlspecialchars($Login));
    $passwordAdmin = trim(htmlspecialchars(md5($Password)));

    $adm = getAdminbyLoginAndPassword($LoginAdmin, $passwordAdmin);

    if ($adm) {
        $_SESSION['Admin'] = $adm;
        header("Location: index.php?page=admin/accueil");
    } else {
        header("Location: index.php?page=interAuth/authAdmin&message=failed");
    }
}

if (isset($_POST['loginGest'])) {
    extract($_POST);

    $LoginGestionnaire = trim(htmlspecialchars($Login));
    $password = trim(htmlspecialchars(md5($Password)));
    echo $password;
    $gest = getGestionnairesbyLoginAndPassword($LoginGestionnaire, $password);
    var_dump($gest);
    if ($gest) {
        $_SESSION['Gestionnaire'] = $gest;
        header("Location: index.php?page=gestionnaire/accueil");
    } else {
        header("Location: index.php?page=interAuth/authGestionnaire&message=failed");
    }
}

if (isset($_POST['loginCais'])) {
    extract($_POST);

    //var_dump($_POST);
    $LoginCaissier = trim(htmlspecialchars($Login));
    $password = trim(htmlspecialchars(md5($Password)));

    //echo $password;

    $cais = getCaissierbyLoginAndPassword($LoginCaissier, $password);
    if ($cais) {
        $_SESSION['Caissier'] = $cais;
        header("Location: index.php?page=caissier/accueil");
    } else {
        header("Location: index.php?page=interAuth/authCaissier&message=failed");
    }
}

if (isset($_POST['caissierC'])) {
    extract($_POST);

    var_dump($_POST);
    $name = trim(htmlspecialchars($nom));
    $lastName = trim(htmlspecialchars($prenom));
    $dateNaissance = trim(htmlspecialchars($dateNaiss));
    $emailC = trim(htmlspecialchars($email));
    $LoginC = $Login;
    //echo $_FILES["profil"]["name"];
    $profilC = "caissier" .  $LoginC . "_" . time() . "_" . $_FILES["profil"]["name"];
    $destinationFolderProfilC = "assets/img/inter/Caissier/";
    $rectoPath = uploadFile($_FILES["profil"]["tmp_name"], $destinationFolderProfilC, $profilC);
    $telC = trim(htmlspecialchars($tel));
    $numCniC = trim(htmlspecialchars($cni));
    $passwordC = generatePassword();
    $password = trim(htmlspecialchars(md5($passwordC)));
    $to = $emailC;
    $subject = "Votre nouveau compte";
    $message = "Bonjour " . $name . " " . $lastName . ",<br><br>Votre nouveau compte a été créé avec succès!<br><br>Votre nouveau mot de passe est : " . $passwordC . "<br><br>Vous pouvez vous connecter à votre compte en cliquant sur le lien suivant :<br><br><a href='http://localhost/Touts_Projet/Projet_Banque/Admin/index.php?page=interAuth/authCaissier" . "'>Cliquez ici pour vous connecter</a><br><br>Nous vous recommandons de modifier votre mot de passe après la connexion pour des raisons de sécurité.";
    //var_dump($rectoPath);



    if ($rectoPath) {
        $statut =  addStatutCaissier();
        if ($statut) {


            $idStatutCaissier_FK = getLatestStatutCaissier();
            $addC = addCaissier($name, $lastName, $numCniC, $LoginC, $password, $telC, $emailC, $profilC, $dateNaissance, $idStatutCaissier_FK);
            var_dump($addC);
            if ($addC) {
               
                sendEmail($to, $subject, $message);
                if (sendEmail($to, $subject, $message)) {
                    echo "Email sent";
                }
                 header("Location: index.php?page=admin/accueil");
            } else {
                header("Location: index.php?page=ajout&message=failed");
            }
        }
    }
}

if (isset($_POST['adminMdp'])) {

    extract($_POST);

    $adm=getAdminbyEmail($email);
   
    if ($adm) {
        $id=$adm['idAdmin'];
        $passwordC = generatePassword();
        $password = trim(htmlspecialchars(md5($passwordC)));
        $to = $email;
        $subject = "Votre nouveau Mot de passe";
        $message = "Bonjour " .$adm['nomAdmin'] . " " . $adm['prenomCaissier'] . ",<br><br>Votre Mot de passe  a été change avec succès!<br><br>Votre nouveau mot de passe est :<strong> " . $passwordC . "</strong><br><strong>Nous vous recommandons de modifier votre mot de passe après la connexion pour des raisons de sécurité</strong>.";
        
        updatePasswordAdm($id, $password);
        sendEmail($to, $subject, $message);
        header("Location: index.php?page=interAuth/authAdmin"); 

    }
    
   
}
//var_dump( $_POST);
if (isset($_POST['caisMdp'])) {

    extract($_POST);
    echo $_POST;
    $adm=getCaissierbyEmail($email);
    var_dump($adm);
   
    if ($adm) {
        $id=$adm['idCaissier'];
        $passwordC = generatePassword();
        $password = trim(htmlspecialchars(md5($passwordC)));
        //echo $password;
        $to = $email;
        $subject = "Votre nouveau Mot de passe";
        $message = "Bonjour " . $adm['nomCaissier'] . " " .$adm['prenomCaissier'] . ",<br><br>Votre Mot de passe  a été change avec succès!<br><br>Votre nouveau mot de passe est :<strong> " . $passwordC . "</strong><br><strong>Nous vous recommandons de modifier votre mot de passe après la connexion pour des raisons de sécurité</strong>.";
        
        updatePasswordCaiss($id, $password);
        sendEmail($to, $subject, $message);
        header("Location: index.php?page=interAuth/authCaissier"); 
    }
   
}

if (isset($_POST['gestMdp'])) {

    extract($_POST);
    //echo $_POST;
    $adm=getGestionnairebyEmail($email);
    var_dump($adm);
   
    if ($adm) {
        $id=$adm['idGestionnaire'];
        $passwordC = generatePassword();
        $password = trim(htmlspecialchars(md5($passwordC)));
        echo $password;
        $to = $email;
        $subject = "Votre nouveau Mot de passe";
        $message = "Bonjour " . $adm['nomGestionnaire'] . " " .$adm['prenomGestionnaire'] . ",<br><br>Votre Mot de passe  a été change avec succès!<br><br>Votre nouveau mot de passe est :<strong> " . $passwordC . "</strong><br><strong>Nous vous recommandons de modifier votre mot de passe après la connexion pour des raisons de sécurité</strong>.";
        
        updatePasswordGest($id, $password);
        sendEmail($to, $subject, $message);
       header("Location: index.php?page=interAuth/authGestionnaire"); 
    }
   
}

if (isset($_POST['gestionnaireG'])) {
    extract($_POST);

    var_dump($_POST);
    $name = trim(htmlspecialchars($nom));
    $lastName = trim(htmlspecialchars($prenom));
    $dateNaissance = trim(htmlspecialchars($dateNaiss));
    $emailC = trim(htmlspecialchars($email));
    $LoginC = $Login;
    echo $_FILES["profil"]["name"];
    $profilC = "gestionnaire" .  $LoginC . "_" . time() . "_" . $_FILES["profil"]["name"];
    $destinationFolderProfilC = "assets/img/inter/Gest/";
    $rectoPath = uploadFile($_FILES["profil"]["tmp_name"], $destinationFolderProfilC, $profilC);
    $telC = trim(htmlspecialchars($tel));
    $numCniC = trim(htmlspecialchars($cni));
    $passwordC = generatePassword();
    $password = trim(htmlspecialchars(md5($passwordC)));
    $to = $emailC;
    $subject = "Votre nouveau compte";
    $message = "Bonjour " . $name . " " . $lastName . ",<br><br>Votre nouveau compte a été créé avec succès!<br><br>Votre nouveau mot de passe est : " . $passwordC . "<br><br>Vous pouvez vous connecter à votre compte en cliquant sur le lien suivant :<br><br><a href='http://localhost/Touts_Projet/Projet_Banque/Admin/index.php?page=interAuth/authGestionnaire" . "'>Cliquez ici pour vous connecter</a><br><br>Nous vous recommandons de modifier votre mot de passe après la connexion pour des raisons de sécurité.";
    var_dump($rectoPath);



    if ($rectoPath) {
        $statut =  addStatutGestionnaire();
        if ($statut) {
            $idStatutGestionnaire_FK = getLatestStatutGestionnaire();
            $addG = addGestionnaire($name, $lastName,$emailC,$dateNaissance,$profilC, $telC, $numCniC, $LoginC, $password, $idStatutGestionnaire_FK);
            var_dump($addG);
            if ($addG) {
               
                //sendEmail($to, $subject, $message);
                if (sendEmail($to, $subject, $message)) {
                    echo "Email sent";
                }
                 header("Location: index.php?page=admin/accueil");
            } else {
                header("Location: index.php?page=ajout&message=failed");
            }
        }
    }
}

if (isset($_GET['page'])) {
    if ($_GET['page'] == "deconnexion") {
        if (isset($_SESSION['Gestionnaire'])) {
            unset($_SESSION['Gestionnaire']);
        }
        if (isset($_SESSION['Caissier'])) {
            unset($_SESSION['Caissier']);
        }
        if (isset($_SESSION['Admin'])) {
            unset($_SESSION['Admin']);
        }

        header("Location: index.php");
    }
    include_once "pages/" . $_GET['page'] . ".php";
} else {
    include_once 'pages/accueil/accueil.php';
}
