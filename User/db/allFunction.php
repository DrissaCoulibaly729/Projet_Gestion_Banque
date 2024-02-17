<?php
require_once 'ConnexiondB.php';

//Function add user
function addUser($NomClient, $PrenomClient, $EmailClient, $LoginClient, $Password, $TelClient)
{
    global $conn;

    // Vérifier si l'utilisateur existe déjà
    $checkUserSql = "SELECT * FROM `client` WHERE `LoginClient` = :login";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':login', $LoginClient);
    $checkUserQuery->execute();

    if ($checkUserQuery->rowCount() > 0) {
        // L'utilisateur existe déjà, renvoyer un message
        return false;
    } else {
        // L'utilisateur n'existe pas, procéder à l'insertion
        $sql = "INSERT INTO `client` (`idClient`, `nomClient`, `prenomClient`, `emailClient`, `loginClient`, `passwordClient`, `telClient`)
                VALUES (NULL, '$NomClient', '$PrenomClient', '$EmailClient', '$LoginClient', '$Password', '$TelClient')";

        // Exécuter la requête d'insertion
        $result = $conn->exec($sql);

        // Vérifier si l'insertion a réussi
        if ($result !== false) {
            return true;
        } else {
            return false;
        }
    }
}

//

function getClientbyEmail($email){
    global $conn;

     // Vérifier si l'utilisateur existe
     $checkUserSql = "SELECT * FROM client WHERE emailClient= :email ";
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

function updateUser($idClient,$nom, $prenom,$login,$email,$tel)
{
    global $conn;
    $sql = " UPDATE `client` 
            SET `nomClient` = :n, 
            `prenomClient` = :p, 
            `telClient` = :t, 
            `emailClient` = :e, 
            `loginClient` = :u
            WHERE `client`.`idClient` = :id";

    $exe = $conn->prepare($sql);

    $exe->bindParam(':n', $nom);
    $exe->bindParam(':p', $prenom);
    $exe->bindParam(':t', $tel);
    $exe->bindParam(':e', $email);
    $exe->bindParam(':u', $login);
    $exe->bindParam(':id', $idClient);

    $exe->execute();
}

//Function add Compte

function addCompte($numCompte, $idClient_FK, $idTypeCompte_FK, $idStatutCompte_FK)
{
    global $conn;

    // Vérifier si l'utilisateur existe déjà
    $checkUserSql = "SELECT * FROM `compte` WHERE `numCompte` = :num";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':num', $numCompte);
    $checkUserQuery->execute();

    if ($checkUserQuery->rowCount() > 0) {
        // L'utilisateur existe déjà, renvoyer un message
        return "L'utilisateur existe déjà.";
    } else {
        // L'utilisateur n'existe pas, procéder à l'insertion
        $sql = "INSERT INTO `compte` (`idCompte`,`numCompte`, `solde`, `idClient_FK`, `idTypeCompte_FK`, `idStatutCompte_FK`,`idGestionnaire_FK`)
                VALUES (NULL, '$numCompte', '', '$idClient_FK', '$idTypeCompte_FK', '$idStatutCompte_FK', NULL)";

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

function getComptebyid($idCompte)
{
    global $conn;
    $checkUserSql = "SELECT * FROM compte C, client Cl, typecompte T, statut_compte S 
    WHERE C.idCompte= :code and C.idClient_FK=Cl.idClient and C.idTypeCompte_FK=T.idTypeCompte and C.idStatutCompte_FK=S.idStatutCompte";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':code', $idCompte);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetch();
    if($result)
    {
        return $result;
    }else {
        # code...
    }
    
}

//Function add statut Compte

function addStatutCompte()
{
    global $conn;


    // L'utilisateur n'existe pas, procéder à l'insertion
    $sql = "INSERT INTO statut_Compte (`idStatutCompte`, `statutCompte`)
                VALUES (NULL, 'non verifier')";

    // Exécuter la requête d'insertion
    $result = $conn->exec($sql);
    return  $result;
}

//
// function updateClient($nom, $prenom, $adresse, $tel, $email, $passeport, $username, $idClient)
// {
//     global $conn;
//     $sql = " UPDATE `client` 
//             SET `nomClient` = :n, 
//             `prenomClient` = :p, 
//             `adresseClient` = :a, 
//             `telClient` = :t, 
//             `emailClient` = :e, 
//             `passport` = :pa, 
//             `username` = :u
//             WHERE `client`.`idClient` = :id";

//     $exe = $conn->prepare($sql);

//     $exe->bindParam(':n', $nom);
//     $exe->bindParam(':p', $prenom);
//     $exe->bindParam(':a', $adresse);
//     $exe->bindParam(':t', $tel);
//     $exe->bindParam(':e', $email);
//     $exe->bindParam(':pa', $password);
//     $exe->bindParam(':u', $username);
//     $exe->bindParam(':id', $idClient);

//     $exe->execute();
// }

function updateStatuCompte($id,$motif)
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

//Function get statut Compte

function getLatestStatutCompteId()
{
    global $conn;

    // Requête pour obtenir l'ID du statut de compte le plus récent
    $sql = "SELECT idStatutCompte
            FROM statut_Compte
            ORDER BY DateTime DESC
            LIMIT 1";

    // Exécuter la requête de sélection
    $stmt = $conn->query($sql);

    // Récupérer le résultat
    $result = $stmt->fetch();

    // Vérifier si une ligne a été trouvée
    if ($result) {
        return $result['idStatutCompte'];
    } else {
        // Aucun enregistrement trouvé
        return null;
    }
}



//Function get user

function getAllClientsbyLoginAndPassword($Login, $Password)
{
    //session_start(); // Démarre la session (à placer au début du fichier)

    global $conn;

    // Vérifier si l'utilisateur existe
    $checkUserSql = "SELECT * FROM client WHERE loginClient= :login AND passwordClient = :password";
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
function getClientsbyNumCompte($numCompte)
{
    //session_start(); // Démarre la session (à placer au début du fichier)

    global $conn;

    // Vérifier si l'utilisateur existe
    $checkUserSql = "SELECT * FROM compte C, client Cl WHERE C.numCompte= :co and C.idClient_FK=Cl.idClient";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':co', $numCompte);
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


//get id type Compte

function getIdTypeCompte($codeTypeCompte)
{
    global $conn;
    $checkUserSql = "SELECT * FROM typecompte WHERE codeTypeCompte= :code";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':code', $codeTypeCompte);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetch();
    if ($result) {
        return $result;
    } else {
        // L'utilisateur n'existe pas, renvoyer un message
        echo "Vous devez vous inscrire.";
    }
}

//get id  Compte

function getCompte($idClient_FK)
{
    global $conn;
    $checkUserSql = "SELECT * FROM compte WHERE idClient_FK= :code";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':code', $idClient_FK);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetch();
    return $result;
}

//get ALL  information

function getAll($idCompte)
{
    global $conn;
    $checkUserSql = "SELECT * FROM compte C, client Cl, typecompte T, statut_compte S 
    WHERE C.idCompte= :code and C.idClient_FK=Cl.idClient and C.idTypeCompte_FK=T.idTypeCompte and C.idStatutCompte_FK=S.idStatutCompte";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':code', $idCompte);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetch();
    return $result;
}

//genere

function generateNumeroCompte()
{
    do {
        // Générer 16 chiffres aléatoires
        $numeroCompte = '';
        for ($i = 0; $i < 16; $i++) {
            $numeroCompte .= rand(0, 9);

            // Ajouter un tiret après chaque groupe de 4 chiffres
            if (($i + 1) % 4 === 0 && $i !== 15) {
                $numeroCompte .= '-';
            }
        }
    } while (numeroCompteExists($numeroCompte)); // Vérifier si le numéro existe déjà

    return $numeroCompte;
}

// Fonction pour vérifier si le numéro de compte existe déjà dans la table "compte"
function numeroCompteExists($numeroCompte)
{
    global $conn;

    $sql = "SELECT COUNT(*) AS count FROM compte WHERE numCompte = :numeroCompte";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':numeroCompte', $numeroCompte);
    $stmt->execute();

    $result = $stmt->fetch();

    return $result['count'] > 0;
}


// Exemple d'utilisation
// $numeroCompte = generateNumeroCompte();
// echo $numeroCompte;

//addVerif

function addverifUser($date, $nat, $numCni, $adress, $codePostal, $ville, $recto, $verso, $profil, $idCompte_FK)
{
    global $conn;
    $sql = "INSERT INTO `verification` (`idVerif`, `dateNaissVerif`,`nationnaliterVerif`,
    `numCniVerif`, `adresseResidenceVerif`, `codePostalVerif`, `villeVerif`, `rectoCniVerif`,
    `versoCniVerif`, `profilVerif`, `acceptationVerif`, `idCompte_FK`)
    VALUES (NULL, '$date','$nat','$numCni','$adress','$codePostal','$ville','$recto','$verso',
    '$profil','faux', '$idCompte_FK')";

    $result = $conn->exec($sql);
    return  $result;
}

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

function addBeneficiaire($idBeneficiaire_FK, $numCompte_FK)
{
    global $conn;

    // Vérifier si l'utilisateur existe déjà
    $checkUserSql = "SELECT * FROM `beneficiaire` WHERE `numCompte_FK` = :num AND `idBeneficiaire_FK` = :id";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->bindParam(':num', $numCompte_FK);
    $checkUserQuery->bindParam(':id', $idBeneficiaire_FK);
    $checkUserQuery->execute();

    if ($checkUserQuery->rowCount() > 0) {
        // L'utilisateur existe déjà, renvoyer un message
        return false;
    } else {
        // L'utilisateur n'existe pas, procéder à l'insertion
        $insertSql = "INSERT INTO `beneficiaire` (`idBeneficiaire_FK`, `numCompte_FK`) VALUES (:id, :num)";
        $insertQuery = $conn->prepare($insertSql);
        $insertQuery->bindParam(':id', $idBeneficiaire_FK);
        $insertQuery->bindParam(':num', $numCompte_FK);

        // Exécuter la requête d'insertion
        $result = $insertQuery->execute();

        // Vérifier si l'insertion a réussi
        return $result;
    }
}


//

function getBeneficiairebyId($id)
{
    global $conn;
    $checkUserSql = "SELECT * FROM beneficiaire B, compte C, client Cl
    WHERE B.idBeneficiaire_FK=$id and  B.numCompte_FK=C.numCompte and C.idClient_FK = Cl.idClient";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetchAll();
    return $result;
}

//
function addOperation($montantOperation,$typeOperation,$numCompteBeneficiaire_FK,$codeValidation,$idCompte_FK){
    global $conn;
    $sql = "INSERT INTO `operation` (`idOperation`, `dateOperation`,`montantOperation`,`typeOperation`,`numCompteBeneficiaire_FK`,`codeValidation`,`idCompte_FK`)
                VALUES (NULL, NOW(),'$montantOperation','$typeOperation','$numCompteBeneficiaire_FK','$codeValidation','$idCompte_FK')";

        // Exécuter la requête d'insertion
        $result = $conn->exec($sql);

        // Vérifier si l'insertion a réussi
        if ($result !== false) {
            return true;
        } else {
            return false;
        }
}

//

function getOperation($codeValidation)
{
    global $conn;
    $checkUserSql = "SELECT * FROM operation O, compte C, client Cl
    WHERE O.codeValidation='$codeValidation' and  O.numCompteBeneficiaire_FK=C.numCompte and C.idClient_FK = Cl.idClient and O.acceptationOperation='faux'";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetch();
    return $result;
}

//

function getOperationbyId($id)
{
    global $conn;
    $checkUserSql = "SELECT * FROM operation O, compte C, client Cl
    WHERE O.idCompte_FK='$id' and  O.idCompte_FK=C.idCompte and C.idClient_FK = Cl.idClient";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetchAll();
    return $result;
}

function getOperationbyIdNonR($id)
{
    global $conn;
    $checkUserSql = "SELECT * FROM operation O, compte C, client Cl
    WHERE O.idCompte_FK='$id' and  O.idCompte_FK=C.idCompte and C.idClient_FK = Cl.idClient and O.acceptationOperation='vrai'";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetchAll();
    return $result;
}

//

function getOperationbyIdOpe($id)
{
    global $conn;
    $checkUserSql = "SELECT * FROM operation O, compte C, client Cl
    WHERE O.idOperation='$id' and  O.numCompteBeneficiaire_FK=C.numCompte and C.idClient_FK = Cl.idClient";
    $checkUserQuery = $conn->prepare($checkUserSql);
    $checkUserQuery->execute();

    $result = $checkUserQuery->fetch();
    return $result;
}

//

function generateUniqueCode() {
    global $conn;  // Assurez-vous que la connexion à la base de données est disponible

    // Générer un code initial
    $uniqueId = uniqid();
    $code = 'CODE_' . $uniqueId;

    // Vérifier si le code existe déjà dans la table "operation"
    $sql = "SELECT COUNT(*) AS count FROM operation WHERE codeValidation = :code";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':code', $code);
    $stmt->execute();
    $result = $stmt->fetch();

    // Si le code existe, générez un nouveau code de manière récursive
    if ($result['count'] > 0) {
        return generateUniqueCode();  // Appel récursif pour générer un nouveau code
    }

    // Si le code est unique, retournez-le
    return $code;
}

//

function addMessage($message, $idDestinateurMessage_FK, $idExpediteurMessage_FK) {
    global $conn;

    // Utilisation d'une requête préparée avec des paramètres liés
    $sql = "INSERT INTO `message` (`idMessage`, `message`, `statutMessage`, `dateHeureMessage`, `idDestinateurMessage_FK`, `idExpediteurMessage_FK`) 
            VALUES (NULL, :message, 'non lue', NOW(), :idDestinateurMessage_FK, :idExpediteurMessage_FK)";

    // Préparation de la requête
    $stmt = $conn->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':idDestinateurMessage_FK', $idDestinateurMessage_FK);
    $stmt->bindParam(':idExpediteurMessage_FK', $idExpediteurMessage_FK);

    // Exécution de la requête
    $result = $stmt->execute();

    // Vérification si l'insertion a réussi
    return $result;
}


//

function getAllMessageDest($idDest)
{
    global $conn;

    $sql = "SELECT * FROM message WHERE idDestinateurMessage_FK = :idDest ORDER BY dateHeureMessage ASC";
    
    $query = $conn->prepare($sql);
    $query->bindParam(':idDest', $idDest);
    $query->execute();

    $result = $query->fetchAll();
    return $result;
}

//

function updateStatutMessage($idDest, $idExp,$motif)
{
    global $conn;

    $sql = " UPDATE `message` 
            SET `statutMessage` = :n
            WHERE idDestinateurMessage_FK = :idDest and idExpediteurMessage_FK = :idExp";
    $exe = $conn->prepare($sql);

    $exe->bindParam(':n', $motif);
    $exe->bindParam(':idDest', $idDest);
    $exe->bindParam(':idExp', $idExp);


    $exe->execute();
}

//

function getCountMessageNonLue($idDest, $idExp)
{
    global $conn;

    $sql = "SELECT count(*) AS messageCount FROM message WHERE idDestinateurMessage_FK = :idDest and idExpediteurMessage_FK = :idExp and statutMessage='non lue'";
    $query = $conn->prepare($sql);
    $query->bindParam(':idDest', $idDest);
    $query->bindParam(':idExp', $idExp);
    $query->execute();

    $result = $query->fetch();
    return $result['messageCount'];
}

//
function getAllMessageExp($idExp)
{
    global $conn;

    $sql = "SELECT * FROM message WHERE idExpediteurMessage_FK = :idExp ORDER BY dateHeureMessage ASC";
    
    $query = $conn->prepare($sql);
    $query->bindParam(':idExp', $idExp);
    $query->execute();

    $result = $query->fetchAll();
    return $result;
}

//

function getAllMessage($idDest, $idExp)
{
    global $conn;

    $sql = "SELECT * FROM message 
            WHERE idExpediteurMessage_FK = :idExp 
            AND idDestinateurMessage_FK = :idDest
            ORDER BY dateHeureMessage ASC
            ";
    
    $query = $conn->prepare($sql);
    $query->bindParam(':idExp', $idExp);
    $query->bindParam(':idDest', $idDest);
    $query->execute();

    $result = $query->fetchAll();  // Utilisation de fetch pour récupérer seulement un résultat
    return $result;
}

//

function getLastMessage($idDest, $idExp)
{
    global $conn;

    $sql = "SELECT * FROM message 
            WHERE idExpediteurMessage_FK = :idExp 
            AND idDestinateurMessage_FK = :idDest
            ORDER BY dateHeureMessage DESC
            LIMIT 1";
    
    $query = $conn->prepare($sql);
    $query->bindParam(':idExp', $idExp);
    $query->bindParam(':idDest', $idDest);
    $query->execute();

    $result = $query->fetch();  // Utilisation de fetch pour récupérer seulement un résultat
    return $result;
}

//

function combinerTableaux($tableau1, $tableau2) {
    // Fusionner les deux tableaux
    $tableauCombine = array_merge($tableau1, $tableau2);

    // Trier le tableau combiné dans l'ordre décroissant
    sort($tableauCombine);

    return $tableauCombine;

    // Afficher la combinaison des tableaux
   // echo "Combinaison des tableaux dans l'ordre décroissant : " . implode(", ", $tableauCombine);
}

//

// function getAccountDataById($accountId)
// {
//     global $conn;

//     // Récupération de la somme des dépôts
//     $sumDepositsSql = "SELECT SUM(montantOperation)AS sumDeposits
//         FROM operation
//         WHERE idCompte_FK = :accountId AND typeOperation = 'depot' AND acceptationOperation = 'vrai'";

//     $sumDepositsQuery = $conn->prepare($sumDepositsSql);
//     $sumDepositsQuery->bindParam(':accountId', $accountId);
//     $sumDepositsQuery->execute();
//     $sumDepositsResult = $sumDepositsQuery->fetch();
//     $sumDeposits = $sumDepositsResult['sumDeposits'];

//     // Récupération de la somme des retraits
//     $sumWithdrawalsSql = "SELECT SUM(montantOperation)AS sumWithdrawals
//         FROM operation
//         WHERE idCompte_FK = :accountId AND typeOperation = 'retrait' AND acceptationOperation = 'vrai'";

//     $sumWithdrawalsQuery = $conn->prepare($sumWithdrawalsSql);
//     $sumWithdrawalsQuery->bindParam(':accountId', $accountId);
//     $sumWithdrawalsQuery->execute();
//     $sumWithdrawalsResult = $sumWithdrawalsQuery->fetch();
//     $sumWithdrawals = $sumWithdrawalsResult['sumWithdrawals'];

//     // Récupération du solde actuel du compte
//     $currentBalanceSql = "SELECT COALESCE(Solde, 0) AS currentBalance FROM compte WHERE idCompte = :accountId";

//     $currentBalanceQuery = $conn->prepare($currentBalanceSql);
//     $currentBalanceQuery->bindParam(':accountId', $accountId, PDO::PARAM_INT);
//     $currentBalanceQuery->execute();
//     $currentBalanceResult = $currentBalanceQuery->fetch(PDO::FETCH_ASSOC);
//     $currentBalance = $currentBalanceResult['currentBalance'];

//     // Calcul du solde initial
//     $initialBalance = $currentBalance + $sumWithdrawals - $sumDeposits;

//     // Récupération des transactions de dépôt
//     $depositTransactionsSql = "SELECT * FROM operation
//         WHERE idCompte_FK = :accountId AND typeOperation = 'depot' AND acceptationOperation = 'vrai'";

//     $depositTransactionsQuery = $conn->prepare($depositTransactionsSql);
//     $depositTransactionsQuery->bindParam(':accountId', $accountId, PDO::PARAM_INT);
//     $depositTransactionsQuery->execute();
//     $depositTransactions = $depositTransactionsQuery->fetchAll(PDO::FETCH_ASSOC);

//     // Récupération des transactions de retrait
//     $withdrawalTransactionsSql = "SELECT * FROM operation
//         WHERE idCompte_FK = :accountId AND typeOperation = 'retrait' AND acceptationOperation = 'vrai'";

//     $withdrawalTransactionsQuery = $conn->prepare($withdrawalTransactionsSql);
//     $withdrawalTransactionsQuery->bindParam(':accountId', $accountId, PDO::PARAM_INT);
//     $withdrawalTransactionsQuery->execute();
//     $withdrawalTransactions = $withdrawalTransactionsQuery->fetchAll(PDO::FETCH_ASSOC);

//     // Retourner les données complètes
//     return array(
//         'idCompte' => $accountId,
//         'initialBalance' => $initialBalance,
//         'depositTransactions' => $depositTransactions,
//         'withdrawalTransactions' => $withdrawalTransactions
//     );
// }

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

  //

  function updatePasswordClient($id, $motif)
{
    global $conn;

    $sql = " UPDATE `client` 
            SET `passwordClient` = :n
            WHERE idClient = :id";
    $exe = $conn->prepare($sql);

    $exe->bindParam(':n', $motif);
    $exe->bindParam(':id', $id);

    $exe->execute();
}

//

function sendEmail($to, $subject, $message) {
    // Headers pour indiquer l'expéditeur et le format du message
    $headers = "From: Banque <dc377303@gmail.com>\r\n";
    $headers .= "Reply-To: dc377303@gmail.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    return mail($to, $subject, $message, $headers);
}

//var_dump(getAccountDataById(4));




//('', 'Salut', 'non lue', current_timestamp(), '8', '4'); 

//

// function updateOperation(){

// }