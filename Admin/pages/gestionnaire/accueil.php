<?php

if (isset($_SESSION['Gestionnaire'])) {
    $Gestionnaire = $_SESSION['Gestionnaire'];
    $verifs = getAllVerif();
    //var_dump($verifs);
    $mGests = getAllComptebyIdGest($Gestionnaire['idGestionnaire']);
    $infosComs = getAllClientCompte();
    //var_dump($infosComs);
    $infos = getAllClientbyVerif();
    //var_dump($infos);
    if ($infos) {
        foreach ($infos as $info) {
            //var_dump($info);
            $infosCompte = getAllCompte($info['idCompte_FK']);
        }
    }

    $countCl = getCountClient();
    $countCo = getCountCompte();
    $infosGest = getAll($Gestionnaire['idGestionnaire']);
    if ($infosGest['statutGestionnaire'] === 'bloquer') {
        header("Location: index.php?page=ErreurPage");
    }
} else {
    header("Location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accepter'])) {
    extract($_POST);

    $idVerif = $idUserVerif;


    $clientVer = getVerif($idVerif);
    $infosClientCompte = getAllCompte($clientVer['idCompte_FK']);
    //var_dump($infosClientCompte);

    if ($clientVer) {

        $id = $infosClientCompte['idClient'];

        $numCniClient = $clientVer['numCniVerif'];
        $dateNaissClient = $clientVer['dateNaissVerif'];
        $nationnaliteClient = $clientVer['nationnaliterVerif'];
        $adresseClient = $clientVer['adresseResidenceVerif'];
        $codePostalClient = $clientVer['codePostalVerif'];
        $villeClient = $clientVer['villeVerif'];
        $rectoCniClient = $clientVer['rectoCniVerif'];
        $versoCniClient = $clientVer['versoCniVerif'];
        $profilClient = $clientVer['profilVerif'];

        $up = updateClient(
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
        );
        if ($up) {
            updateStatuCompte($infosClientCompte['idStatutCompte'], 'verifier');
            updateVerifAccept($idVerif, 'vrai');
            updateCompte($infosClientCompte['idCompte'], $infosGest['idGestionnaire']);
            $to = $infosClientCompte['emailClient'];
            $subject = "Verification Valide";
            $message = "Bonjour " . $infosClientCompte['nomClient'] . " " . $infosClientCompte['prenomClient']  . ",<br><br>Nous sommes heureux de vous informer que la vérification de votre compte a été effectuée avec succès. Vous pouvez désormais accéder à toutes les fonctionnalités de votre compte et effectuer des opérations en toute sécurité.<br><br>Nous vous remercions pour votre confiance et votre patience.<br><br>Cordialement.";
            sendEmail($to, $subject, $message);
            header("Location: index.php?page=gestionnaire/accueil");
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['refuser'])) {
    extract($_POST);
    $idVerif = $idUserVerif;
    $clientVer = getVerif($idVerif);
    $infosClientCompte = getAllCompte($clientVer['idCompte_FK']);
    updateStatuCompte($infosClientCompte['idStatutCompte'], 'non verifier');
    //echo $idVerif;
    updateVerifAccept($idVerif, 'rejeter');
    updateCompte($infosClientCompte['idCompte'], $infosGest['idGestionnaire']);
    $to = $infosClientCompte['emailClient'];
    $subject = "Verification Refuser";
    $message = "Bonjour " . $infosClientCompte['nomClient'] . " " . $infosClientCompte['prenomClient']  . ",<br><br>Nous vous informons que votre demande de vérification de compte a été refusée. Vous pouvez reprendre le processus de vérification en fournissant des informations supplémentaires ou en corrigeant les erreurs identifiées lors de la première tentative.<br><br>Nous vous remercions pour votre compréhension et votre coopération.<br><br>Cordialement.";
    sendEmail($to, $subject, $message);
    header("Location: index.php?page=gestionnaire/accueil");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bloquer'])) {
    extract($_POST);
    $idVerif = $idUserVerif;
    updateStatuCompte($infosCompte['idStatutCompte'], 'bloquer');
    //echo $idVerif;
    updateVerifAccept($idVerif, 'bloquer');
    updateCompte($infosCompte['idCompte'], $infosGest['idGestionnaire']);
    $to = $infosCompte['emailClient'];
    $subject = "Compte Bloquer";
    $message = "Bonjour " . $infosCompte['nomClient'] . " " . $infosCompte['prenomClient']  . ",<br><br>Nous vous informons que votre compte a été temporairement bloqué pour des raisons de sécurité. Veuillez contacter notre service clientèle pour obtenir de l'aide afin de résoudre ce problème et débloquer votre compte.<br><br>Merci pour votre compréhension.<br><br>Cordialement.";
    sendEmail($to, $subject, $message);
    header("Location: index.php?page=gestionnaire/accueil");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bloquerC'])) {
    extract($_POST);
    $idUse = $idUserClient;
    echo $idUse;
   // updateStatuCompte($idUse, 'bloquer');
    foreach ($infosComs as $infosCom) {
        if ($infosCom['idStatutCompte_FK'] == $idUse) {
            updateStatuCompte($idUse, 'bloquer');
            $to = $infosCom['emailClient'];
            $subject = "Compte Bloquer";
            $message = "Bonjour " . $infosCom['nomClient'] . " " . $infosCom['prenomClient']   . ",<br><br>Nous vous informons que votre compte a été temporairement bloqué pour des raisons de sécurité. Veuillez contacter notre service clientèle pour obtenir de l'aide afin de résoudre ce problème et débloquer votre compte.<br><br>Merci pour votre compréhension.<br><br>Cordialement.";
            sendEmail($to, $subject, $message);
        }
    }
    //echo $idVerif;
     updateCompte($infosCompte['idCompte'], $infosGest['idGestionnaire']);
     header("Location: index.php?page=gestionnaire/accueil");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['debloquer'])) {
    extract($_POST);
    $idUse = $idUserClient;
    foreach ($infosComs as $infosCom) {
        if ($infosCom['numCniClient'] != NULL && $infosCom['idStatutCompte'] == $idUse) {
            updateStatuCompte($idUse, 'verifier');
            $to = $infosCom['emailClient'];
            $subject = "Compte Debloquer";
            $message = "Bonjour " . $infosCom['nomClient'] . " " . $infosCom['prenomClient']  . ",<br><br>Nous sommes heureux de vous informer que votre compte a été débloqué avec succès. Vous pouvez désormais accéder à toutes les fonctionnalités de votre compte.<br><br>Si vous avez des questions ou des préoccupations, n'hésitez pas à nous contacter. Nous sommes là pour vous aider.<br><br>Meilleures salutations.";
            sendEmail($to, $subject, $message);
        } elseif ($infosCom['numCniClient'] == NULL && $infosCom['idStatutCompte'] == $idUse) {
            updateStatuCompte($idUse, 'non verifier');
            $to = $infosCom['emailClient'];
            $subject = "Compte Debloquer";
            $message = "Bonjour " . $infosCom['nomClient'] . " " . $infosCom['prenomClient']  . ",<br><br>Nous sommes heureux de vous informer que votre compte a été débloqué avec succès. Vous pouvez désormais accéder à toutes les fonctionnalités de votre compte.<br><br>Si vous avez des questions ou des préoccupations, n'hésitez pas à nous contacter. Nous sommes là pour vous aider.<br><br>Meilleures salutations.";
            sendEmail($to, $subject, $message);
        }
    }
    //echo $idVerif;
     updateCompte($infosCompte['idCompte'], $infosGest['idGestionnaire']);
     header("Location: index.php?page=gestionnaire/accueil");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <!-- <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'> -->
    <link rel="stylesheet" href="assets/boxicons-master/css/boxicons.min.css">
    <!-- My CSS -->
    <link rel="stylesheet" href="assets/css/gestionnaire/gestionnaire.css">


    <title>AdminHub</title>


</head>

<body class="overflow-y-hidden">


    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text"><?= $infosGest['prenomGestionnaire'] . ' ' . $infosGest['nomGestionnaire']  ?></span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="#dashboard">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#client">
                    <i class='bx bxs-group'></i>
                    <span class="text">Clients</span>
                </a>
            </li>
            <li>
                <a href="#analyze">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Analyze</span>
                </a>
            </li>

        </ul>
        <ul class="side-menu">
            <li>
                <div class="dropdown">
                    <a href="index.php?page=interAuth/updatePassword&message=ergesn4152">
                        <i class='bx bxs-cog'></i>
                        <span class="text">Changer Mot de passe</span>
                        <!-- <span class="text dropbtn">Profil</span>
                        <div class="dropdown-content">
                            <a href="index.php?page=Client/verifier">Verifier</a>
                            <a href="index.php?page=Client/profil">Profil</a>
                        </div> -->
                    </a>
                </div>
            </li>
            <li>
                <a href="index.php?page=deconnexion" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->



    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link">Categories</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="assets/img/inter/Gest/<?= $infosGest['profilGestionnaire']; ?>">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div id="dashboard">

                <div class="head-title">
                    <div class="left">
                        <h1>Dashboard</h1>
                        <ul class="breadcrumb">
                            <li>
                                <a href="#">Dashboard</a>
                            </li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li>
                                <a class="active" href="#">Home</a>
                            </li>
                        </ul>
                    </div>

                </div>

                <ul class="box-info">

                    <li>

                        <i class='bx bxs-calendar-check'></i>


                        <span class="text">
                            <h3><?= $countCl ?></h3>
                            <h3>Client</h3>
                        </span>
                    </li>


                    <li>

                        <i class='bx bxs-group'></i>

                        <span class="text">
                            <h3><?= $countCo ?></h3>
                            <h3>Comptes</h3>
                        </span>
                    </li>

                </ul>


                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>Verification</h3>
                            <i class='bx bx-search'></i>
                            <i class='bx bx-filter'></i>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Numero CNI</th>
                                    <th>Age</th>
                                    <th>Date Soumission</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($verifs as $verif) {
                                    foreach ($infos as $info) {
                                        if ($verif['idCompte_FK'] === $info['idCompte']) {


                                ?>
                                            <tr>
                                                <td>
                                                    <img src="assets/img/Client/Profil/<?php echo $verif['profilVerif']; ?>">
                                                    <p><?php echo $info['nomClient'] . ' ' . $info['prenomClient'] ?></p>
                                                </td>
                                                <td><?= $verif['numCniVerif']; ?></td>
                                                <td><?= $verif['dateNaissVerif']; ?></td>
                                                <td><?= $infosCompte['DateTime']; ?></td>
                                                <td>
                                                    <form action="index.php?page=gestionnaire/accueil" method="post">
                                                        <input type="hidden" name="idUserVerif" value="<?= $verif['idVerif']; ?>">
                                                        <button class="status completed" type="submit" name="accepter">Accepter</button>
                                                        <div class="dropdown">
                                                            <button class="status process dropbtn">Document</button>
                                                            <div class="dropdown-content">
                                                                <a href="assets/img/Client/Verso/<?php echo $verif['versoCniVerif']; ?>" target="_blank">Recto Cni</a>
                                                                <a href="assets/img/Client/Recto/<?php echo $verif['rectoCniVerif']; ?>" target="_blank">Verso CNI</a>
                                                                <a href="assets/img/Client/Profil/<?php echo $verif['profilVerif']; ?>" target="_blank">Profil User</a>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <button class="status pending" type="submit" name="refuser">Refuser</button>
                                                        <button class="status pending" type="submit" name="bloquer">Bloquer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                <?php break;
                                        }
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><br><br><br>
            <!-- Client -->

            <div class="table-data" id="client">
                <div class="order">
                    <div class="head">
                        <h3>Tous Les Clients</h3>
                        <i class='bx bx-search'></i>
                        <i class='bx bx-filter'></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Numero CNI</th>
                                <th>Age</th>
                                <th>Date Ouverture Compte</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($infosComs as $infosCom) {



                            ?>
                                <tr>
                                    <td>
                                        <img src="assets/img/Client/Profil/<?php echo $infosCom['profilClient']; ?>">
                                        <p><?php echo $infosCom['nomClient'] . ' ' . $infosCom['prenomClient'] ?></p>
                                    </td>
                                    <td><?= $infosCom['numCniClient']; ?></td>
                                    <td><?= $infosCom['dateNaissClient']; ?></td>
                                    <td><?= $infosCom['DateTime']; ?></td>
                                    <td>
                                        <form action="index.php?page=gestionnaire/accueil" method="post">
                                            <input type="hidden" name="idUserClient" value="<?= $infosCom['idStatutCompte']; ?>">
                                            <?php if ($infosCom['statutCompte'] === 'bloquer') {

                                            ?>
                                                <button class="status completed" type="submit" name="debloquer">Debloquer</button>
                                                <br>
                                            <?php } else { ?>
                                                <button class="status pending" type="submit" name="bloquerC">Bloquer</button>
                                            <?php } ?>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </div><br><br><br>

            <!--Analyze-->
            <div class="card shadow mb-4" id="analyze">
                <div class="card-header py-3">
                    <h1 class="m-0 font-weight-bold text-primary">Analyze</h1>
                </div>
                <div class="card-body">
                    <div style="width:100%;height:400px;text-align:center">
                        <h2 class="page-header">Analytics Reports </h2>
                        <div>Gestion Client </div>
                        <canvas id="chartjs_bar"></canvas>
                        <div id="legend">
                            <span style="display: inline-block; width: 20px; height: 10px; background-color: #2ec551; margin-right: 5px;"></span><span class="text"> Elevation</span>
                            <span style="display: inline-block; width: 20px; height: 10px; background-color: #ff004e; margin-left: 10px;"></span><span class="text"> Diminution</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- MAIN -->



    </section>
    <!-- CONTENT -->

    <script>
        function accepter(element) {
            var idVerif = element.getAttribute('data-id');
            console.log(idVerif);

        }
    </script>




    <script src="assets/js/gestionnaire/script.js"></script>
    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById("chartjs_bar").getContext('2d');
            var data = <?php echo json_encode($mGests); ?>;

            // Initialisez la couleur à utiliser pour chaque barre
            var barColors = data.map(function(ope, index) {
                if (index > 0) {
                    // Comparer le solde actuel avec le solde précédent pour déterminer la couleur
                    return ope['Solde'] > data[index - 1]['Solde'] ? '#2ec551' : '#ff004e';
                } else {
                    // Si c'est la première barre, utilisez la couleur par défaut
                    return '#2ec551'; // ou '#ff004e' selon votre préférence initiale
                }
            });

            var labels = data.map(function(ope) {
                return ope['numCompte'];
            });

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        backgroundColor: barColors,
                        data: data.map(function(ope) {
                            return ope['Solde'];
                        }),
                    }]
                },
                options: {
                    // ... autres options restent inchangées
                    scales: {
                        x: {
                            beginAtZero: false,
                            ticks: {
                                fontColor: barColors, // Utiliser les couleurs définies pour les étiquettes de l'axe X
                            }
                        },
                        // ... autres options restent inchangées
                    }
                }
            });
        });
    </script>

</body>

</html>