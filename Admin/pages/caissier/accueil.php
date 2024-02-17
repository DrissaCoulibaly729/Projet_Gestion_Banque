<?php

if (isset($_SESSION['Caissier'])) {
    $Caissier = $_SESSION['Caissier'];
    $countCl = getCountClient();
    $countCo = getCountCompte();
    $ops = getAllOperation();
    $opes = getAllOperationbyIdCais($Caissier['idCaissier']);
    //var_dump($ops);
    $infosCaiss = getAllCaissier($Caissier['idCaissier']);
    if ($infosCaiss['statutCaissier'] === 'bloquer') {
        header("Location: index.php?page=ErreurPage");
    }
} else {
    header("Location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accepter'])) {
    extract($_POST);

    $codeValid = $code;
    $AllCls = getOperation($codeValid);
    $idCais = $Caissier['idCaissier'];
    //var_dump($AllCls);


    foreach ($AllCls as $AllCl) {
        //var_dump($AllCl);

        if ($AllCl['typeOperation'] === 'retrait') {
            $AllCl['Solde'] = $AllCl['Solde'] - $AllCl['montantOperation'];
            //echo $AllCl['Solde'];
            updateSoldeCompte($AllCl['idCompte'], $AllCl['Solde']);
            updateAcceptationCaiOperation($codeValid, 'vrai', $idCais);
            $to = $AllCl['emailClient'];
            $subject = "Retrait Effectuer";
            $message = "Bonjour " . $AllCl['nomClient'] . " " . $AllCl['prenomClient'] . ",<br><br>Nous sommes heureux de vous informer que votre demande de retrait a été validée avec succès. Les fonds ont été transférés avec succès sur votre compte bancaire.<br><br>Nous vous remercions pour votre confiance et votre patience.<br><br>Cordialement.";
            sendEmail($to, $subject, $message);
        } else if ($AllCl['typeOperation'] === 'depot') {
            $AllCl['Solde'] = $AllCl['Solde'] + $AllCl['montantOperation'];
            updateSoldeCompte($AllCl['idCompte'], $AllCl['Solde']);
            updateAcceptationCaiOperation($codeValid, 'vrai', $idCais);
            $to = $AllCl['emailClient'];
            $subject = "Depot Effectuer";
            $message = "Bonjour " . $AllCl['nomClient'] . " " . $AllCl['prenomClient'] . ",<br><br>Nous sommes heureux de vous informer que votre demande de depot a été validée avec succès. Les fonds ont été ajoutés avec succès à votre compte bancaire.<br><br>Nous vous remercions pour votre confiance et votre patience.<br><br>Cordialement.";
            sendEmail($to, $subject, $message);
        }
    }

    header("Location: index.php?page=caissier/accueil");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['refuser'])) {
    extract($_POST);
    $codeValid = $code;
    $AllCls = getOperation($codeValid);
    $idCais = $Caissier['idCaissier'];


    foreach ($AllCls as $AllCl) {
        if ($AllCl['typeOperation'] === 'retrait') {
            updateAcceptationCaiOperation($codeValid, 'rejeter', $idCais);
            $to = $AllCl['emailClient'];
            $subject = "Retrait refuser";
            $message = "Bonjour " . $AllCl['nomClient'] . " " . $AllCl['prenomClient'] . ",<br><br>Nous vous informons que votre demande de retrait a été refusée. Veuillez vous référer aux informations fournies par notre équipe de support pour plus de détails concernant le refus de votre demande.<br><br>Nous vous remercions pour votre compréhension.<br><br>Cordialement.";
            sendEmail($to, $subject, $message);
        } else if ($AllCl['typeOperation'] === 'depot') {
            updateAcceptationCaiOperation($codeValid, 'rejeter', $idCais);
            $to = $AllCl['emailClient'];
            $subject = "Depot refuser";
            $message = "Bonjour " . $AllCl['nomClient'] . " " . $AllCl['prenomClient'] . ",<br><br>Nous vous informons que votre demande de depot a été refusée. Veuillez vous référer aux informations fournies par notre équipe de support pour plus de détails concernant le refus de votre demande.<br><br>Nous vous remercions pour votre compréhension.<br><br>Cordialement.";
            sendEmail($to, $subject, $message);
        }
    }
    header("Location: index.php?page=caissier/accueil");
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

<body>


    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text"><?= $infosCaiss['prenomCaissier'] . ' ' . $infosCaiss['nomCaissier']  ?></span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="#dashboard">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#analyze">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Analyze</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class='bx bxs-group'></i>
                    <span class="text">Clients</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <div class="dropdown">
                    <a href="index.php?page=interAuth/updatePassword&message=reisca120">
                        <i class='bx bxs-cog'></i>
                        <span class="text">Change Mot de Passe</span>
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
                <img src="assets/img/inter/Caissier/<?= $infosCaiss['profilCaissier']; ?>">
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
                                    <th>Numero Compte</th>
                                    <th>Montant</th>
                                    <th>Type Operation</th>
                                    <th>Date Operation</th>
                                    <th>Code Confirmation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($ops as $op) {

                                ?>
                                    <tr>
                                        <td>
                                            <img src="assets/img/Client/Profil/<?php echo $op['profilClient']; ?>">
                                            <p><?php echo $op['nomClient'] . ' ' . $op['prenomClient'] ?></p>
                                        </td>
                                        <td><?= $op['numCompte']; ?></td>
                                        <td><?= $op['montantOperation']; ?></td>
                                        <td><?= $op['typeOperation']; ?></td>
                                        <td><?= $op['dateOperation']; ?></td>
                                        <td><?= $op['codeValidation']; ?></td>
                                        <td>
                                            <form action="index.php?page=caissier/accueil" method="post">
                                                <input type="hidden" name="code" value="<?= $op['codeValidation']; ?>">
                                                <button class="status completed" type="submit" name="accepter">Accepter</button>
                                                <button class="status pending" type="submit" name="refuser">Refuser</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php  }
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
                        <div>Transaction </div>
                        <canvas id="chartjs_bar"></canvas>
                        <div id="legend">
                            <span style="display: inline-block; width: 20px; height: 10px; background-color: #2ec551; margin-right: 5px;"></span><span class="text"> Dépôt</span>
                            <span style="display: inline-block; width: 20px; height: 10px; background-color: #ff004e; margin-left: 10px;"></span><span class="text"> Retrait</span>
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




    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script src="assets/js/gestionnaire/script.js"></script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById("chartjs_bar").getContext('2d');
            var backgroundColors = <?php echo json_encode(array_map(function ($ope) {
                                        return $ope['typeOperation'] === 'depot' ? '#2ec551' : '#ff004e';
                                    }, $opes)); ?>

            var legendLabels = <?php echo json_encode(array_map(function ($ope) {
                                    return $ope['typeOperation'] === 'depot' ? 'Dépôt' : 'Retrait';
                                }, $opes)); ?>

            var labels = <?php echo json_encode(array_column($opes, 'dateOperation')); ?>;
            var data = <?php echo json_encode(array_column($opes, 'montantOperation')); ?>;
            //console.log(data);

            var minValue = Math.min.apply(Math, data); // Trouver la valeur minimale dans les données

            var labelColors = labels.map(function(label, index) {
                // Si la valeur est égale à la valeur minimale de l'axe Y, définissez une couleur spécifique, sinon utilisez la couleur d'origine
                console.log(index);
                return data[index] === minValue ? 'blue' : 'black'; // Changer 'black' à la couleur d'origine de l'axe X
            });

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        backgroundColor: backgroundColors,
                        data: data,
                    }]
                },
                options: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return legendLabels[tooltipItem.index] + ': $' + data['datasets'][0]['data'][tooltipItem.index];
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: false,
                            ticks: {
                                fontColor: labelColors, // Utiliser les couleurs définies pour les étiquettes de l'axe X
                            }
                        },
                        y: {
                            beginAtZero: false,
                            min: minValue > 50 ? 50 : minValue, // Définissez la valeur minimale de l'axe Y à 50 ou la valeur minimale dans les données
                            ticks: {
                                callback: function(value, index, values) {
                                    return '$' + value;
                                }
                            }
                        }
                    }
                }
            });
            //console.log(myChart);
        });
    </script>
</body>

</html>