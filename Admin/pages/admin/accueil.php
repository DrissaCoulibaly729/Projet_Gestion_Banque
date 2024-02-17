<?php

if (isset($_SESSION['Admin'])) {
    $Admin = $_SESSION['Admin'];


    $countCl = getCountClient();
    $countCo = getCountCompte();
    $sumS=getSumSolders();
    $sumD=getSumOperationD();
    $sumR=getSumOperationR();
    $accountData= getAccountData();
    //var_dump($accountData);

    $gests=getAllGestionnaire();
    $caiss=getAllCaissierC();
} else {
    header("Location: index.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bloquer'])) {
    extract($_POST);
    $id = $idGest;
    updateStatutGestionnaire($id, 'bloquer');
    
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['debloquer'])) {
    extract($_POST);
    $id = $idGest;
    updateStatutGestionnaire($id, 'actif');
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
            <span class="text"><?= $Admin['prenomAdmin'] . ' ' . $Admin['nomAdmin']  ?></span>
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
          <!--   <li>
                <a href="index.php?page=Client/message">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text">Message</span>
                </a>
            </li> -->
        </ul>
        <ul class="side-menu">
            <li>
                <div class="dropdown">
                    <a href="index.php?page=interAuth/updatePassword&message=Nimda00">
                        <i class='bx bxs-cog'></i>
                        <span class="text">Change Mot de passe</span>
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
                <img src="assets/img/inter/Admin/<?php echo $Admin['profilAdmin']; ?>">
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
                            <h4>Nombre de Compte</h4>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-calendar-check'></i>
                        <span class="text">
                            <h3>$<?= $sumS ?></h3>
                            <h4>Montant Total</h4>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-calendar-check'></i>
                        <span class="text">
                            <h3>$<?= $sumD ?></h3>
                            <h4>Montant Total Depot</h4>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-calendar-check'></i>
                        <span class="text">
                            <h3>$<?= $sumR ?></h3>
                            <h4>Montant Total Retrait</h4>
                        </span>
                    </li>
                </ul>


                <div class="table-data" id="client">
                    <div class="order">
                        <div class="head">
                            <h3>Gestionnaire</h3>
                            <i class='bx bx-search'></i>
                            <i class='bx bx-filter'></i>
                            <form action="index.php?page=admin/ajout" method="post" >
                                <button class="status pending" type="submit" name="gestionnaire" style="color:white; background-color:brown;box-shadow: 15px; cursor: pointer;">Ajouter Gestionnaire</button>
                            </form>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Numero CNI</th>
                                    <th>Age</th>
                                   <!--  <th></th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($gests as $gest) {
                                   
                                       


                                ?>
                                            <tr>
                                                <td>
                                                    <img src="assets/img/inter/Gest/<?php echo $gest['profilGestionnaire']; ?>">
                                                    <p><?php echo $gest['nomGestionnaire'] . ' ' . $gest['prenomGestionnaire'] ?></p>
                                                </td>
                                                <td><?= $gest['numCniGestionnaire']; ?></td>
                                                <td><?= $gest['dateNaissGestionnaire']; ?></td>
                                                <td>
                                                    <form action="index.php?page=admin/accueil" method="post">
                                                        <input type="hidden" name="idGest" value="<?= $gest['idStatutGestionnaire']; ?>">
                                                        <?php if($gest['statutGestionnaire']==="bloquer"){?>
                                                        <button class="status completed" type="submit" name="debloquer">Debloquer</button>
                                                        <?php } else{?>
                                                        <br>
                                                        <button class="status pending" type="submit" name="bloquer">Bloquer</button>
                                                        <?php } ?>
                                                    </form>
                                                </td>
                                            </tr>
                                <?php 
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><br><br><br>
            <!-- Client -->

            <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>Caissier</h3>
                            <i class='bx bx-search'></i>
                            <i class='bx bx-filter'></i>
                            <form action="index.php?page=admin/ajout" method="post">
                                <button class="status pending" type="submit" name="caissier" style="color:white; background-color:brown;box-shadow: 15px; cursor: pointer;" >Ajouter Caissier</button>
                            </form>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Numero CNI</th>
                                    <th>Age</th>
                                   <!--  <th></th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($caiss as $cais) {
                                   
                                       


                                ?>
                                            <tr>
                                                <td>
                                                    <img src="assets/img/inter/Caissier/<?php echo $cais['profilCaissier']; ?>">
                                                    <p><?php echo $cais['nomCaissier'] . ' ' . $cais['prenomCaissier'] ?></p>
                                                </td>
                                                <td><?= $cais['numCniCaissier']; ?></td>
                                                <td><?= $cais['dateNaissCaissier']; ?></td>
                                                <td>
                                                    <form action="index.php?page=admin/accueil" method="post">
                                                        <input type="hidden" name="idcais" value="<?= $cais['idStatutCaissier']; ?>">
                                                        <?php if($cais['statutCaissier']==="bloquer"){?>
                                                        <button class="status completed" type="submit" name="debloquer">Debloquer</button>
                                                        <?php } else{?>
                                                        <br>
                                                        <button class="status pending" type="submit" name="bloquer">Bloquer</button>
                                                        <?php } ?>
                                                    </form>
                                                </td>
                                            </tr>
                                <?php 
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><br><br><br>
            <!--Analyze-->
       <!--      <div class="card shadow mb-4" id="analyze">
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
            </div> -->
             <!-- annalye client -->
             <h1 id="analyze">Graphique d'opérations par client</h1>
        <canvas id="myChart" width="400" height="200"></canvas>

        <h1>Évolution du Solde par Compte</h1>
    <canvas id="chartjs_line" width="800" height="400"></canvas>

        

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
     <script>
        // Récupération des données depuis PHP
        <?php
        $data = json_encode(getOperationsCountByClient());
        ?>

        // Conversion des données PHP en JavaScript
        var chartData = <?php echo $data; ?>;

        // Création du graphique
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.map(item => item.nomClient),
                datasets: [{
                    label: 'Nombre d\'opérations',
                    data: chartData.map(item => item.operationCount),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById("chartjs_line").getContext('2d');

            // Appel à la fonction côté serveur pour récupérer les données
            var accountData = <?php echo json_encode(getAccountData()); ?>;
            console.log(accountData);
            var datasets = accountData.map(function(account) {
                return {
                    label: account.idCompte_FK,
                    borderColor: getRandomColor(),
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderWidth: 2,
                    pointRadius: 5,
                    pointBackgroundColor: getRandomColor(),
                    data: account.transactions.map(function(transaction) {
                        return transaction.Solde;
                    }),
                    fill: false
                };
            });

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: accountData[0].transactions.map(function(transaction) {
                        return transaction.numCompteBeneficiaire_FK;
                    }),
                    datasets: datasets
                },
                options: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Arial',
                            fontSize: 14,
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: false,
                            ticks: {
                                fontColor: '#000000',
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value, index, values) {
                                    return '$' + value.toFixed(2);
                                }
                            }
                        }
                    }
                }
            });
        });

        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>




</body>

</html>