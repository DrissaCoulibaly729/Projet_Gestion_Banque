<?php
if (isset($_SESSION['compte'])) {
    $url = $_SERVER['REQUEST_URI'];
    //echo "L'URL actuelle est : $url";
    $compte = $_SESSION['compte'];
    $idCompte = $compte['idCompte'];
    $opes = getOperationbyId($idCompte);
    $opesNonRs = getOperationbyIdNonR($idCompte);
    //var_dump($opes);
    $benefs = getBeneficiairebyId($idCompte);
    $info = getAll($idCompte);
   // $data = getAccountDataById($idCompte);
    //var_dump($data);
    // Check if the account status is not verified
    if ($info['statutCompte'] === 'non verifier') {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "warning",
                title: "Verification Obligatoire",
                text: "Veuillez vérifier votre compte afin de pouvoir effectuer un dépôt ou un retrait.",
                showCancelButton: true,
                confirmButtonText: "OK",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
            }).then(function(result) {
                if (result.isConfirmed) {
                    window.location.href = "index.php?page=Client/verifier";
                } else {
                    window.location.href = "index.php?page=Client/accueil";
                }
            });
        });
      </script>';
    } elseif ($info['statutCompte'] === 'verification en cours') {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "info",
                title: "Verification en cours",
                text: "Votre compte est en cours de vérification. Veuillez patienter pendant 24 heures.",
                confirmButtonText: "OK",
                closeOnConfirm: false,
            }).then(function(result) {
                if (result.isConfirmed) {
                    // Perform additional actions if needed
                    console.log("User clicked OK");
                }
            });
        });
      </script>';
    } elseif ($info['statutCompte'] === 'bloquer') {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "Bloquer",
                text: "Votre compte est bloqué. Veuillez vous rendre à la banque la plus proche de chez vous afin de régler le problème.",
                confirmButtonText: "OK",
                closeOnConfirm: false,
            }).then(function(result) {
                if (result.isConfirmed) {
                    // Perform additional actions if needed
                    window.location.href = "index.php";
                }
            });
        });
      </script>';
    }

    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        let inactivityTimer;
    
        function resetInactivityTimer() {
            clearTimeout(inactivityTimer);
            inactivityTimer = setTimeout(logoutUser, 60000); // 1 minute timeout
        }
    
        function logoutUser() {
            Swal.fire({
                title: "Inactivity Timeout",
                html: "You will be logged out in <b id=\"countdown\">30</b> seconds. Do you want to continue?",
                timer: 30000,
                timerProgressBar: true,
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                didOpen: () => {
                    const countdownElement = Swal.getHtmlContainer().querySelector("#countdown");
                    let countdown = 30;
    
                    const countdownInterval = setInterval(() => {
                        countdownElement.textContent = countdown;
                        countdown--;
    
                        if (countdown < 0) {
                            clearInterval(countdownInterval);
                            window.location.href = "index.php?page=deconnexion";
                        }
                    }, 1000);
                },
            }).then(function(result) {
                if (result.isConfirmed) {
                    resetInactivityTimer(); // Reset to 1 minute if user clicks "Yes" within 30 seconds
                } else {
                    window.location.href = "index.php?page=deconnexion";
                }
            });
        }
    
        resetInactivityTimer(); // Initial setup
    
        // Reset timer on user activity
        document.addEventListener("mousemove", resetInactivityTimer);
        document.addEventListener("keydown", resetInactivityTimer);
    });
    </script>';

    // Continue with the rest of your existing code
} else {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

    <!-- Boxicons -->
    <!-- <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'> -->
    <link rel="stylesheet" href="assets/boxicons-master/css/boxicons.min.css">
    <!-- My CSS -->
    <link rel="stylesheet" href="assets/css/client/client.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->




    <title>AdminHub</title>



</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text"><?php echo $info['prenomClient'] . ' ';
                                echo $info['nomClient'] ?></span>
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
                    <span class="text">Analytics</span>
                </a>
            </li>
            <li>
                <a href="index.php?page=Client/message">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text">Message</span>
                </a>
            </li>
            <li>
                <a href="index.php?page=Client/profil">
                    <i class='bx bxs-group'></i>
                    <span class="text">Profil</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <!-- <div class="dropdown"> -->
                <a href="index.php?page=userAuthInscrit/updatePassword">
                    <i class='bx bxs-cog'></i>
                    <span class="text dropbtn">changer Mot de passe</span>
                    <!-- <div class="dropdown-content">
                            <a href="javascript:void(0);" onclick="showVerificationStatus('verifier')">Verifier</a> 
                            <a href="index.php?page=Client/profil">Profil</a>
                        </div> -->
                </a>
                <!-- </div> -->
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
            <a href="index.php?page=Client/profil" class="profile">
                <?php if ($info['profilClient'] !== NULL) {
                ?>
                    <img src="../Admin/assets/img/Client/Profil/<?= $info['profilClient'] ?>" alt="avatar">
                <?php } else { ?>
                    <img src="../Admin/assets/img/img/télécharger.jpeg" alt="avatar">
                <?php } ?>
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
                        <a href="javascript:void(0);" onclick="showVerificationStatus('depot')">
                            <i class='bx bxs-calendar-check'></i>
                            <span class="text">
                                <h3>Depot</h3>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript:void(0);" onclick="showVerificationStatus('retrait')">
                            <i class='bx bxs-group'></i>
                            <span class="text">
                                <h3>Retrait</h3>
                            </span>
                        </a>
                    </li>


                    <li>
                        <a href="">
                            <i class='bx bxs-dollar-circle'></i>
                        </a>
                        <span class="text">
                            <h3>$<?php echo $info['Solde'] ?></h3>
                            <p>Compte</p>
                        </span>
                    </li>


                    <li>
                        <a href="">
                            <i class='bx bxs-calendar-check'></i>
                        </a>
                        <span class="text">
                            <h3> <?php echo $info['nomTypeCompte'] ?></h3>
                            <p>Type De Compte</p>
                        </span>
                    </li>


                    <li>
                        <a href="">
                            <i class='bx bxs-calendar-check'></i>
                        </a>
                        <span class="text">
                            <h6> <?php echo $info['numCompte'] ?></h6>
                            <p>Numero Compte</p>
                        </span>
                    </li>

                </ul>


                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>Transaction</h3>
                            <i class='bx bx-search'></i>
                            <i class='bx bx-filter'></i>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Date Order</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Facture</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($opes as $ope) {

                                ?>
                                    <tr>
                                        <td>
                                            <img src="../Admin/assets/img/Client/Profil/<?= $ope['profilClient'] ?>">
                                            <p><?= $ope['nomClient'] . ' ' . $ope['prenomClient'] ?></p>
                                        </td>
                                        <td><?= $ope['dateOperation'] ?></td>
                                        <td><?php if ($ope['typeOperation'] === 'depot') {
                                            ?>
                                                <span class="status completed">Depot</span><?php  } else if ($ope['typeOperation'] === 'retrait') {
                                                                                            ?>
                                                <span class="status process">Retrait</span>
                                            <?php } ?>
                                        </td>
                                        <td><?php if ($ope['acceptationOperation'] === 'vrai') {
                                            ?>
                                                <span class="status completed">Terminer</span><?php  } else if ($ope['acceptationOperation'] === 'faux') {
                                                                                                ?>
                                                <span class="status process">En Cours</span>
                                            <?php } else if ($ope['acceptationOperation'] === 'rejeter') {
                                            ?>
                                                <span class="status pending">Rejeter</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <div class="head-title">
                                                <form action="index.php?page=Client/facture" method="post">
                                                    <button class="btn-download" name="facture">
                                                        <input type="hidden" name="idOpe" value="<?= $ope['idOperation'] ?>">
                                                        <i class='bx bxs-cloud-download'></i>
                                                        <span class="text">Download PDF</span>
                                                    </button>
                                            </div>
                                        </td>
                                        </form>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="todo">
                        <div class="head">
                            <h3>Beneficiaire</h3>
                            <div class="dropdown">
                                <i class='bx bx-plus dropbtn'></i>
                                <div class="dropdown-content">
                                    <a href="javascript:void(0);" onclick="showVerificationStatus('depot')">Depot</a>
                                    <a href="javascript:void(0);" onclick="showVerificationStatus('retrait')">Retrait</a>
                                </div>
                            </div>
                            <i class='bx bx-filter'></i>
                        </div>
                        <ul class="todo-list">
                            <?php foreach ($benefs as $benef) { ?>
                                <li class="completed">
                                    <p><?= $benef['nomClient'] . ' ' . $benef['prenomClient']; ?></p>
                                    <div class="dropdown">
                                        <i class='bx bx-dots-vertical-rounded dropbtn'></i>
                                        <div class="dropdown-content">
                                            <form action="index.php?page=Client/message" method="post">
                                                <input type="hidden" name="numCompte" value="<?= $benef['numCompte']; ?>">
                                                <button class="button" type="submit" name="message">Message</button>
                                            </form>
                                            <form action="index.php?page=Client/retrait" method="post">
                                                <input type="hidden" name="numCompte" value="<?= $benef['numCompte']; ?>">
                                                <button class="button" type="submit" name="retrait">Retrait</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div> <br><br>
            <!--Analyze-->
            <div class="card shadow mb-4" id="analyze">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary">Analyze</h3>
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
            <br><br><br><br><br><br>
            <h1>Courbe d'evolution</h1>
            <canvas id="chartjs_line" width="400" height="200"></canvas>

            <h1>Courbe d'evolution des Soldes du Compte</h1>
            <canvas id="chartjs_lineB" width="800" height="400"></canvas>

        </main>
        <!-- MAIN -->



    </section>
    <!-- CONTENT -->


    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script src="assets/js/client/script.js"></script>
    <script>
        function showVerificationStatus(operationType) {
            <?php
            // Check if the account is not verified
            if ($info['statutCompte'] === 'non verifier') {
                echo 'Swal.fire({
                icon: "warning",
                title: "Verification Obligatoire",
                text: "Veuillez vérifier votre compte afin de pouvoir effectuer un dépôt ou un retrait.",
                showCancelButton: true,
                confirmButtonText: "OK",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
            }).then(function(result) {
                if (result.isConfirmed) {
                    window.location.href = "index.php?page=Client/verifier";
                } else {
                    // User clicked cancel
                    console.log("User clicked Cancel");
                }
            });';
            } elseif ($info['statutCompte'] === 'verification en cours') {
                echo 'Swal.fire({
                icon: "info",
                title: "Verification en cours",
                text: "Votre compte est en cours de vérification. Veuillez patienter pendant 24 heures.",
                confirmButtonText: "OK",
                closeOnConfirm: false,
            }).then(function(result) {
                if (result.isConfirmed) {
                    // Perform additional actions if needed
                    console.log("User clicked OK");
                }
            });';
            } elseif ($info['statutCompte'] === 'bloquer') {
                echo 'Swal.fire({
                icon: "error",
                title: "Bloquer",
                text: "Votre compte est bloqué. Veuillez vous rendre à la banque la plus proche de chez vous afin de régler le problème.",
                confirmButtonText: "OK",
                closeOnConfirm: false,
            }).then(function(result) {
                if (result.isConfirmed) {
                    // Perform additional actions if needed
                    window.location.href = "index.php";
                }
            });';
            } elseif ($info['statutCompte'] === 'verifier') {
                echo "window.location.href = 'index.php?page=Client/' + encodeURIComponent(operationType);";
            } ?>
        }
    </script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById("chartjs_bar").getContext('2d');
            var backgroundColors = <?php echo json_encode(array_map(function ($ope) {
                                        return $ope['typeOperation'] === 'depot' ? '#2ec551' : '#ff004e';
                                    }, $opesNonRs)); ?>

            var legendLabels = <?php echo json_encode(array_map(function ($ope) {
                                    return $ope['typeOperation'] === 'depot' ? 'Dépôt' : 'Retrait';
                                }, $opesNonRs)); ?>

            var labels = <?php echo json_encode(array_column($opesNonRs, 'dateOperation')); ?>;
            var data = <?php echo json_encode(array_column($opesNonRs, 'montantOperation')); ?>;
            //console.log(data);

            var minValue = Math.min.apply(Math, data); // Trouver la valeur minimale dans les données

            var labelColors = labels.map(function(label, index) {
                // Si la valeur est égale à la valeur minimale de l'axe Y, définissez une couleur spécifique, sinon utilisez la couleur d'origine
                console.log(index);
                return data[index] === minValue ? 'blue' : 'black'; // Changer 'black' à la couleur d'origine de l'axe X
            });

            console.log(data);
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

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById("chartjs_line").getContext('2d');
            var backgroundColors = <?php echo json_encode(array_map(function ($ope) {
                                        return $ope['typeOperation'] === 'depot' ? '#4CAF50' : '#FF5733';
                                    }, $opesNonRs)); ?>

            var legendLabels = <?php echo json_encode(array_map(function ($ope) {
                                    return $ope['typeOperation'] === 'depot' ? 'Dépôt' : 'Retrait';
                                }, $opesNonRs)); ?>

            var labels = <?php echo json_encode(array_column($opesNonRs, 'dateOperation')); ?>;
            var data = <?php echo json_encode(array_column($opesNonRs, 'montantOperation')); ?>;
            var minValue = Math.min.apply(Math, data);

            var labelColors = labels.map(function(label, index) {
                return data[index] === minValue ? '#007BFF' : '#000000';
            });

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        borderColor: backgroundColors,
                        borderWidth: 2,
                        pointBackgroundColor: backgroundColors,
                        data: data,
                        fill: false
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
                                fontColor: labelColors,
                            }
                        },
                        y: {
                            beginAtZero: data.some(value => value < 0),
                            ticks: {
                                callback: function(value, index, values) {
                                    return '$' + value;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

    <!--  -->

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById("chartjs_lineB").getContext('2d');

            // Remplacez les données ci-dessous par celles retournées par la fonction getAccountDataById
            var accountData = <?php echo json_encode($data); ?>;

            console.log(accountData['withdrawalTransactions']);

            var labels = accountData['withdrawalTransactions'].map(function(transaction) {
                return transaction.dateOperation;
            });

            var datasets = accountData['withdrawalTransactions'].map(function(account) {
                return {
                    label: accountData['idCompte_FK'],
                    borderColor: getRandomColor(),
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderWidth: 2,
                    pointRadius: 5,
                    pointBackgroundColor: getRandomColor(),
                    data: account['withdrawalTransactions'].map(function(transaction) {
                        return transaction.montantOperation;
                    }),
                    fill: false
                };
            });

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
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