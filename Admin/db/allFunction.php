<?php
require_once 'ConnexiondB.php';
//

function getAllVerif()
{
    global $conn;

    $sql = "SELECT * FROM verification WHERE acceptationVerif='faux'";
    $exe = $conn->prepare($sql);
    $exe->execute();

    $result = $exe->fetchAll(); // Utilisation correcte de fetchAll

    return $result;
}

//

function getAllClientbyVerif()
{
    global $conn;

    $sql = "SELECT * FROM verification V, client Cl, compte C  WHERE V.idCompte_FK=C.idCompte and C.idClient_FK=Cl.idClient and V.acceptationVerif='faux'";
    $exe = $conn->prepare($sql);
    $exe->execute();

    $result = $exe->fetchAll(); // Utilisation correcte de fetchAll

    return $result;
}

//

function getCountClient()
{
    global $conn;

    $sql = "SELECT COUNT(*) AS clientCount FROM client"; // Correction de la requête SQL

    $exe = $conn->prepare($sql);
    $exe->execute();

    $result = $exe->fetch(); // Utilisation correcte de fetch

    return $result['clientCount']; // Retourne le nombre de clients
}

//

function getCountCompte()
{
    global $conn;

    $sql = "SELECT COUNT(*) AS compteCount FROM compte";

    $exe = $conn->prepare($sql);
    $exe->execute();

    $result = $exe->fetch(); // Utilisation correcte de fetch

    return $result['compteCount']; // Retourne le nombre de compte
}

//

function getVerif($id)
{
    global $conn;

    $sql = "SELECT * FROM verification  WHERE idVerif= :v";
    $exe = $conn->prepare($sql);
    $exe->bindParam(':v', $id);

    $exe->execute();

    $result = $exe->fetch(); // Utilisation correcte de fetch

    return $result;
}


//
function updateStatuCompte($id, $motif)
{
    global $conn;

    $sql = " UPDATE `statut_Compte` 
            SET `statutCompte` = :n,
            `DateTime`= NOW()
            WHERE idStatutCompte = :id";
    $exe = $conn->prepare($sql);

    $exe->bindParam(':n', $motif);
    $exe->bindParam(':id', $id);

    $exe->execute();
}

function updateClient(
    $id,
    $numCniClient,
    $dateNaissClient,
    $nationnaliteClient,
    $adresseClient,
    $codePostalClient,
    $villeClient,
    $rectoCniClient,
    $versoCniClient,
    $profilClient
) {
    global $conn;

    $sql = " UPDATE `client` 
            SET `numCniClient` = :n,
                `dateNaissClient` = :d,
                `nationnaliteClient` = :na,
                `adresseClient` = :a,
                `codePostalClient` = :c,
                `villeClient` = :v,
                `rectoCniClient` = :r,
                `versoCniClient` = :ve,
                `profilClient` = :p
            WHERE idClient = :id";
    $exe = $conn->prepare($sql);

    $exe->bindParam(':n', $numCniClient);
    $exe->bindParam(':d', $dateNaissClient);
    $exe->bindParam(':na', $nationnaliteClient);
    $exe->bindParam(':a', $adresseClient);
    $exe->bindParam(':c', $codePostalClient);
    $exe->bindParam(':v', $villeClient);
    $exe->bindParam(':r', $rectoCniClient);
    $exe->bindParam(':ve', $versoCniClient);
    $exe->bindParam(':p', $profilClient);
    $exe->bindParam(':id', $id);

    $exe->execute();
    if ($exe) {
        return true;
    } else {
        return false;
    }
}

//
function updateVerifAccept($id, $motif)
{
    global $conn;

    $sql = " UPDATE `verification` 
            SET `acceptationVerif` = :n 
            WHERE idVerif = :id";
    $exe = $conn->prepare($sql);

    $exe->bindParam(':n', $motif);
    $exe->bindParam(':id', $id);

    $exe->execute();
}

//

function updateCompte($id, $motif)
{
    global $conn;

    $sql = " UPDATE `compte` 
            SET `idGestionnaire_FK` = :n 
            WHERE idCompte = :id";
    $exe = $conn->prepare($sql);

    $exe->bindParam(':n', $motif);
    $exe->bindParam(':id', $id);

    $exe->execute();
}

//

function getGestionnairesbyLoginAndPassword($Login, $Password)
{
    //session_start(); // Démarre la session (à placer au début du fichier)

    global $conn;

    // Vérifier si l'utilisateur existe
    $checkUserSql = "SELECT * FROM gestionnaire WHERE loginGestionnaire= :login AND passwordGestionnaire = :password";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':login', $Login);
    $checkUserQuery->bindParam(':password', $Password);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetch();

    // Vérifier si l'utilisateur existe
    if ($result) {
        return $result;
    } else {
        // L'utilisateur n'existe pas, renvoyer un message
        echo "Vous devez vous inscrire.";
    }
}

//

function getGestionnairebyEmail($email)
{
    //session_start(); // Démarre la session (à placer au début du fichier)

    global $conn;

    // Vérifier si l'utilisateur existe
    $checkUserSql = "SELECT * FROM gestionnaire WHERE emailGestionnaire= :email ";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':email', $email);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetch();

    // Vérifier si l'utilisateur existe
    if ($result) {
        return $result;
    } else {
        // L'utilisateur n'existe pas, renvoyer un message
        echo "Vous devez vous inscrire.";
    }
}

//Function add user
function addGestionnaire($NomGestionnaire, $PrenomGestionnaire,$emailGest,$dateNaissGest,$profilGest,$TelGestionnaire, $numCniGestionnaire, $LoginGestionnaire, $Password, $idStatutGestionnaire_FK)
{
    global $conn;

    // Vérifier si l'utilisateur existe déjà
    $checkUserSql = "SELECT * FROM `gestionnaire` WHERE `LoginGestionnaire` = :login";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':login', $LoginGestionnaire);
    $checkUserQuery->execute();

    if ($checkUserQuery->rowCount() > 0) {
        // L'utilisateur existe déjà, renvoyer un message
        return "L'utilisateur existe déjà.";
    } else {
        // L'utilisateur n'existe pas, procéder à l'insertion
        $sql = "INSERT INTO `gestionnaire` (`idGestionnaire`, `nomGestionnaire`, `prenomGestionnaire`,`emailGestionnaire`,`dateNaissGestionnaire`,`profilGestionnaire`, `TelGestionnaire`, `numCniGestionnaire`, `loginGestionnaire`, `passwordGestionnaire`,`idStatutGestionnaire_FK`)
                VALUES (NULL, '$NomGestionnaire', '$PrenomGestionnaire','$emailGest','$dateNaissGest','$profilGest','$TelGestionnaire', '$numCniGestionnaire', '$LoginGestionnaire', '$Password', '$idStatutGestionnaire_FK')";

        // Exécuter la requête d'insertion
        $result = $conn->exec($sql);

        // Vérifier si l'insertion a réussi
        if ($result !== false) {
            return "L'utilisateur a été ajouté avec succès.";
        } else {
            return "Erreur lors de l'ajout de l'utilisateur.";
        }
    }
}

function updatePasswordGest($id, $motif)
{
    global $conn;

    $sql = " UPDATE `gestionnaire` 
            SET `passwordGestionnaire` = :n
            WHERE idGestionnaire = :id";
    $exe = $conn->prepare($sql);

    $exe->bindParam(':n', $motif);
    $exe->bindParam(':id', $id);

    $exe->execute();
}

//add statut Gestionnaire

function addStatutGestionnaire()
{
    global $conn;


    // L'utilisateur n'existe pas, procéder à l'insertion
    $sql = "INSERT INTO `statut_gestionnaire` (`idStatutGestionnaire`, `statutGestionnaire`)
                VALUES (NULL, 'actif')";

    // Exécuter la requête d'insertion
    $result = $conn->exec($sql);
    return  $result;
}

//

function updateStatutGestionnaire($id, $statut)
{
    global $conn;
    $sql = " UPDATE `statut_gestionnaire` 
    SET `statutGestionnaire` = :n 
    WHERE idStatutGestionnaire = :id";
$exe = $conn->prepare($sql);

$exe->bindParam(':n', $statut);
$exe->bindParam(':id', $id);

$exe->execute();
}

//

function getLatestStatutGestionnaire()
{
    global $conn;

    // Requête pour obtenir l'ID du statut de compte le plus récent
    $sql = "SELECT idStatutGestionnaire
            FROM statut_gestionnaire
            ORDER BY DateTime DESC
            LIMIT 1";

    // Exécuter la requête de sélection
    $stmt = $conn->query($sql);

    // Récupérer le résultat
    $result = $stmt->fetch();

    // Vérifier si une ligne a été trouvée
    if ($result) {
        return $result['idStatutGestionnaire'];
    } else {
        // Aucun enregistrement trouvé
        return null;
    }
}

//

function getAllGestionnaire(){
    global $conn;

    $checkUserSql = "SELECT * FROM gestionnaire G, statut_gestionnaire S_G where G.idStatutGestionnaire_FK=S_G.idStatutGestionnaire";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetchAll();

    // Vérifier si l'utilisateur existe
    if ($result) {
        return $result;
    } else {
        // L'utilisateur n'existe pas, renvoyer un message
        echo "Vous devez vous inscrire.";
    }

}

function getAll($idGest)
{
    global $conn;
    $checkUserSql = "SELECT * FROM statut_gestionnaire S, gestionnaire G
    WHERE G.idGestionnaire= :code and S.idStatutGestionnaire=G.idStatutGestionnaire_FK";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':code', $idGest);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetch();
    return $result;
}

function getAllCompte($idCompte)
{
    global $conn;
    $checkUserSql = "SELECT * FROM compte C, client Cl, typecompte T, statut_compte S 
    WHERE C.idCompte= :code and C.idClient_FK=Cl.idClient and C.idTypeCompte_FK=T.idTypeCompte and C.idStatutCompte_FK=S.idStatutCompte";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':code', $idCompte);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetch();
    if ($result) {
        return $result;
    } else {
        # code...
    }
}

//

function getAllComptebyIdGest($id)
{
    global $conn;
    $checkUserSql = "SELECT * FROM compte C, verification V
    WHERE C.idGestionnaire_FK= :code and V.idCompte_FK=C.idCompte";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':code', $id);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetchAll();
    if ($result) {
        return $result;
    } else {
        # code...
    }
}

// function getIdClient($idCompte_FK)
// {
//     global $conn;
//     $checkUserSql = "SELECT * FROM verifiaction V, gestionnaire G;
//     WHERE G.idGestionnaire= :code and S.idStatutGestionnaire=G.idStatutGestionnaire_FK";
//     $checkUserQuery = $conn->prepare($checkUserSql);
//     $checkUserQuery->bindParam(':code', $idGest);
//     $checkUserQuery->execute();

//     $result = $checkUserQuery->fetch();
//     return $result;
// }

function getCaissierbyLoginAndPassword($Login, $Password)
{
    //session_start(); // Démarre la session (à placer au début du fichier)

    global $conn;

    // Vérifier si l'utilisateur existe
    $checkUserSql = "SELECT * FROM caissier WHERE loginCaissier= :login AND passwordCaissier = :password";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':login', $Login);
    $checkUserQuery->bindParam(':password', $Password);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetch();

    // Vérifier si l'utilisateur existe
    if ($result) {
        return $result;
    } else {
        // L'utilisateur n'existe pas, renvoyer un message
        echo "Vous devez vous inscrire.";
    }
}

//

function updatePasswordCaiss($id, $motif)
{
    global $conn;

    $sql = " UPDATE `caissier` 
            SET `passwordCaissier` = :n
            WHERE idCaissier = :id";
    $exe = $conn->prepare($sql);

    $exe->bindParam(':n', $motif);
    $exe->bindParam(':id', $id);

    $exe->execute();
}

//

function getCaissierbyEmail($email)
{
    //session_start(); // Démarre la session (à placer au début du fichier)

    global $conn;

    // Vérifier si l'utilisateur existe
    $checkUserSql = "SELECT * FROM caissier WHERE emailCaissier= :email ";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':email', $email);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetch();

    // Vérifier si l'utilisateur existe
    if ($result) {
        return $result;
    } else {
        // L'utilisateur n'existe pas, renvoyer un message
        echo "Vous devez vous inscrire.";
    }
}

//

function addCaissier($NomCaissier, $PrenomCaissier, $numCniCaissier, $LoginCaissier, $Password, $telCaissier,$emailCaissier,$profilCaissier,$dateNaissCaissier, $idStatutCaissier_FK)
{
    global $conn;

    // Vérifier si l'utilisateur existe déjà
    $checkUserSql = "SELECT * FROM `caissier` WHERE `LoginCaissier` = :login";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':login', $LoginCaissier);
    $checkUserQuery->execute();

    if ($checkUserQuery->rowCount() > 0) {
        // L'utilisateur existe déjà, renvoyer un message
        return "L'utilisateur existe déjà.";
    } else {
        // L'utilisateur n'existe pas, procéder à l'insertion
        $sql = "INSERT INTO `caissier` (`idCaissier`, `nomCaissier`, `prenomCaissier`, `emailCaissier`, `dateNaissCaissier`, `profilCaissier`, `telCaissier`, `numCniCaissier`, `loginCaissier`, `passwordCaissier`, `idStatutCaissier_FK`)
                VALUES (NULL, '$NomCaissier', '$PrenomCaissier','$emailCaissier','$dateNaissCaissier','$profilCaissier','$telCaissier', '$numCniCaissier', '$LoginCaissier', '$Password', '$idStatutCaissier_FK')";

        // Exécuter la requête d'insertion
        $result = $conn->exec($sql);

        // Vérifier si l'insertion a réussi
        if ($result !== false) {
            return "L'utilisateur a été ajouté avec succès.";
        } else {
            return "Erreur lors de l'ajout de l'utilisateur.";
        }
    }
}

//

function getAllCaissier($idCais)
{
    global $conn;
    $checkUserSql = "SELECT * FROM statut_caissier S, caissier C
    WHERE C.idCaissier= :code and S.idStatutCaissier=C.idStatutCaissier_FK";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':code', $idCais);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetch();
    return $result;
}

function getAllOperation()
{
    global $conn;
    $checkUserSql = "SELECT * FROM operation O, compte C, client Cl
    WHERE  O.idCompte_FK=C.idCompte and C.idClient_FK = Cl.idClient and O.acceptationOperation='faux'";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetchAll();
    return $result;
}

//

function addStatutCaissier()
{
    global $conn;


    // L'utilisateur n'existe pas, procéder à l'insertion
    $sql = "INSERT INTO `statut_caissier` (`idStatutCaissier`, `statutCaissier`)
                VALUES (NULL, 'actif')";

    // Exécuter la requête d'insertion
    $result = $conn->exec($sql);
    return  $result;
}

//

function getLatestStatutCaissier()
{
    global $conn;

    // Requête pour obtenir l'ID du statut de compte le plus récent
    $sql = "SELECT idStatutCaissier
            FROM statut_caissier
            ORDER BY DateTime DESC
            LIMIT 1";

    // Exécuter la requête de sélection
    $stmt = $conn->query($sql);

    // Récupérer le résultat
    $result = $stmt->fetch();

    // Vérifier si une ligne a été trouvée
    if ($result) {
        return $result['idStatutCaissier'];
    } else {
        // Aucun enregistrement trouvé
        return null;
    }
}

//

function getAllCaissierC(){
    global $conn;

    $checkUserSql = "SELECT * FROM caissier C, statut_caissier S_C where C.idStatutCaissier_FK=S_C.idStatutCaissier";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetchAll();

    // Vérifier si l'utilisateur existe
    if ($result) {
        return $result;
    } else {
        // L'utilisateur n'existe pas, renvoyer un message
        echo "Vous devez vous inscrire.";
    }

}

//
function getOperation($codeValidation)
{
    global $conn;
    $checkUserSql = "SELECT * FROM operation O, compte C, client Cl
    WHERE O.codeValidation='$codeValidation' and  O.idCompte_FK=C.idCompte and C.idClient_FK = Cl.idClient and O.acceptationOperation='faux'";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetchAll();
    return $result;
}

//

function getAllOperationbyIdCais($id)
{
    global $conn;
    $checkUserSql = "SELECT * FROM operation O
    WHERE  O.idCaissier_FK='$id'";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetchALL();
    return $result;
}

//

function updateAcceptationCaiOperation($codeValid, $motif, $idCais)
{
    global $conn;

    $sql = " UPDATE `operation` 
            SET `acceptationOperation` = :n,
            `idCaissier_FK` = :i,
            `dateOperation`= NOW()
            WHERE codeValidation = :id";
    $exe = $conn->prepare($sql);

    $exe->bindParam(':n', $motif);
    $exe->bindParam(':i', $idCais);
    $exe->bindParam(':id', $codeValid);

    $exe->execute();
}

//

function updateSoldeCompte($idClient, $motif)
{
    global $conn;

    $sql = " UPDATE `compte` 
            SET `Solde` = :n
            WHERE idCompte = :id";
    $exe = $conn->prepare($sql);

    $exe->bindParam(':n', $motif);
    $exe->bindParam(':id', $idClient);

    $exe->execute();
}

//

function getAllClientCompte()
{
    global $conn;
    $checkUserSql = "SELECT * FROM compte C, client Cl, typecompte T, statut_compte S, gestionnaire G
    WHERE C.idClient_FK=Cl.idClient and C.idTypeCompte_FK=T.idTypeCompte and C.idStatutCompte_FK=S.idStatutCompte and S.statutCompte!= 'verification en cours' and C.idGestionnaire_FK=G.idGestionnaire";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetchAll();
    if ($result) {
        return $result;
    } else {
        return false;
    }
}

//

function updatePasswordAdm($id, $motif)
{
    global $conn;

    $sql = " UPDATE `admin` 
            SET `passwordAdmin` = :n
            WHERE idAdmin = :id";
    $exe = $conn->prepare($sql);

    $exe->bindParam(':n', $motif);
    $exe->bindParam(':id', $id);

    $exe->execute();
}

//

function getAdminbyEmail($email)
{
    //session_start(); // Démarre la session (à placer au début du fichier)

    global $conn;

    // Vérifier si l'utilisateur existe
    $checkUserSql = "SELECT * FROM admin WHERE emailAdmin= :email ";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':email', $email);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetch();

    // Vérifier si l'utilisateur existe
    if ($result) {
        return $result;
    } else {
        // L'utilisateur n'existe pas, renvoyer un message
        echo "Vous devez vous inscrire.";
    }
}

//

function getAdminbyLoginAndPassword($Login, $Password)
{
    //session_start(); // Démarre la session (à placer au début du fichier)

    global $conn;

    // Vérifier si l'utilisateur existe
    $checkUserSql = "SELECT * FROM admin WHERE loginAdmin= :login AND passwordAdmin = :password";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':login', $Login);
    $checkUserQuery->bindParam(':password', $Password);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetch();

    // Vérifier si l'utilisateur existe
    if ($result) {
        return $result;
    } else {
        // L'utilisateur n'existe pas, renvoyer un message
        echo "Vous devez vous inscrire.";
    }
}

//

function getSumSolders()
{
    global $conn;
    $checkUserSql = "SELECT SUM(Solde) as TotalSolde FROM compte";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->execute();
    $result = $checkUserQuery->fetch();
    return $result['TotalSolde'];
}

//

function getSumOperationD()
{
    global $conn;
    $checkUserSql = "SELECT SUM(montantOperation) as TotalSolde FROM operation
    WHERE  acceptationOperation='vrai' and typeOperation='depot'";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetch();
    return $result['TotalSolde'];
}

//

function getSumOperationR()
{
    global $conn;
    $checkUserSql = "SELECT SUM(montantOperation) as TotalSolde FROM operation
    WHERE  acceptationOperation='vrai' and typeOperation='retrait'";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetch();
    return $result['TotalSolde'];
}

//

function getAllOperationVrai()
{
    global $conn;
    $checkUserSql = "SELECT * FROM operation O, compte C, client Cl
    WHERE  O.idCompte_FK=C.idCompte and C.idClient_FK = Cl.idClient and O.acceptationOperation='vrai'";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetchAll();
    return $result;
}

//

function getOperationsCountByClient()
{
    global $conn;
    $checkUserSql = "SELECT Cl.nomClient, COUNT(*) as operationCount
                     FROM operation O, compte C, client Cl
                     WHERE O.idCompte_FK = C.idCompte
                     AND C.idClient_FK = Cl.idClient
                     AND O.acceptationOperation = 'vrai'
                     GROUP BY Cl.nomClient";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetchAll();
    return $result;
}

//

function getAllSCompte()
{
    global $conn;
    $checkUserSql = "SELECT * FROM compte C, statut_compte S
    WHERE C.idStatutCompte_FK = S.idstatutCompte and S.StatutCompte='verifier'";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetchAll();
    if ($result) {
        return $result;
    } else {
        # code...
    }
}

//


function getAccountData()
{
    global $conn;

    // Récupération des données de chaque compte avec le solde initial
    $accountDataSql = "SELECT idCompte_FK, numCompteBeneficiaire_FK,
        COALESCE((SELECT Solde FROM compte WHERE idCompte = idCompte_FK), 0) AS initialBalance
    FROM operation
    WHERE acceptationOperation = 'vrai'
    GROUP BY idCompte_FK, numCompteBeneficiaire_FK";

    $accountDataQuery = $conn->prepare($accountDataSql);
    $accountDataQuery->execute();
    $allAccountData = array();

    while ($row = $accountDataQuery->fetch()) {
        $accountId = $row['idCompte_FK'];
        $initialBalance = $row['initialBalance'];

        // Récupération des données de chaque compte avec le solde mis à jour
        $individualAccountDataSql = "SELECT numCompteBeneficiaire_FK,
        typeOperation,
        dateOperation,
        montantOperation,
        idCompte_FK,
        :initialBalance +
        SUM(CASE 
            WHEN typeOperation = 'depot' THEN montantOperation
            WHEN typeOperation = 'retrait' THEN -montantOperation
            ELSE 0 
        END) OVER (ORDER BY dateOperation) AS Solde
    FROM operation
    WHERE idCompte_FK = :accountId AND acceptationOperation='vrai'
    GROUP BY numCompteBeneficiaire_FK, typeOperation, dateOperation, montantOperation, idCompte_FK";

        $individualAccountDataQuery = $conn->prepare($individualAccountDataSql);
        $individualAccountDataQuery->bindParam(':accountId', $accountId);
        $individualAccountDataQuery->bindParam(':initialBalance', $initialBalance);
        $individualAccountDataQuery->execute();
        $individualAccountData = $individualAccountDataQuery->fetchAll();
        
        // Ajouter les données de chaque compte dans le tableau final
        $allAccountData[] = array(
            'idCompte_FK' => $accountId,
            'initialBalance' => $initialBalance,
            'transactions' => $individualAccountData
        );
    }

    return $allAccountData;
}



// Utilisation de la fonction pour récupérer les données des comptes
//$accountData = getAccountData();

function uploadFile($file, $destinationFolder, $newFileName)
{

    $destinationPath = $destinationFolder . $newFileName;
    echo $destinationPath;

    if (move_uploaded_file($file, $destinationPath)) {
        return $destinationPath;
    } else {
        // Gestion de l'erreur de téléchargement
        return false;
    }
}

//

function generatePassword() {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@';
    $passwordLength = 8; // Longueur minimale du mot de passe
    
    $password = '';
    $maxIndex = strlen($characters) - 1;
    for ($i = 0; $i < $passwordLength; $i++) {
      $randomIndex = mt_rand(0, $maxIndex);
      $password .= $characters[$randomIndex];
    }
    
    return $password;
  }
  
 /*  // Exemple d'utilisation :
  $password = generatePassword();
  echo $password; */ // Affiche le mot de passe généré
  
  //

  function sendEmail($to, $subject, $message) {
    // Headers pour indiquer l'expéditeur et le format du message
    $headers = "From: Banque <dc377303@gmail.com>\r\n";
    $headers .= "Reply-To: dc377303@gmail.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    return mail($to, $subject, $message, $headers);
}
