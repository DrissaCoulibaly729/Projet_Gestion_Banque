<?php
if (isset($_SESSION['compte'])) {
    $compte = $_SESSION['compte'];
    $idCompte = $compte['idCompte'];
    $me = getClientsbyNumCompte($compte['numCompte']);
    $benefs = getBeneficiairebyId($idCompte);

    $info = getAll($idCompte);
    if ($info['statutCompte'] === 'bloquer') {
        header("Location: index.php?page=Accueil/error");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

if (($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userMessage'])) || ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['messageSend']))) {

    extract($_POST);
    if ($idDestinateurMessage_FK) {
        $idDest = $idDestinateurMessage_FK;
    }


    echo $idDest;
    $mdest = getComptebyid($idDest);
    //var_dump($mdest);
    $mesExps = getAllMessage($idDest, $idCompte);
    //getAllMessageDest($idDest);
    //var_dump($mesExps);
    // //var_dump($messagesByBenef[$benef['idCompte']]);
    $mesDests = getAllMessage($idCompte, $idDest);
    //getAllMessageExp($idCompte);
    // echo $idCompte;
    //var_dump($mesDests);
    //var_dump($messagesByExp[$benef['idCompte']]);
    //$allMs=getAllMessage($idDest, $idCompte);

    $mesCs = combinerTableaux($mesExps, $mesDests);
    //var_dump( $mesCs);

    updateStatutMessage($idDest, $idCompte, 'lue');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['messageSend'])) {
        extract($_POST);
        $message = $messageM;
        $idDestinateur = $idDestinateurMessage_FK;
        echo $idDestinateur;
        addMessage($message, $idDestinateur, $idCompte);
        $numCompte_FK = $compte['numCompte'];
        addBeneficiaire($idDestinateur, $numCompte_FK);
        //header("Location: index.php?page=Client/message");
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestion des Message</title>
        <link rel="stylesheet" href="assets/css/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/client/client.css">
        <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    </head>

    <body>
        <div class="container-fluid">
            <section>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card-default" id="chat3" style="border-radius: 15px;">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0 overflow-auto">

                                        <div class="p-3">
                                            <a href="index.php?page=Client/accueil" btn btn-button> retour</a>

                                            <div class="input-group rounded mb-3">
                                                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                                <span class="input-group-text border-0" id="search-addon">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                            </div>

                                            <!-- profil -->
                                            <div data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px">
                                                <ul class="list-unstyled mb-0">
                                                    <?php foreach ($benefs as $benef) {
                                                        $nbMessNonLue = getCountMessageNonLue($benef['idCompte'], $idCompte);
                                                        $lastmeExp = getLastMessage($idCompte,  $benef['idCompte']);
                                                        $lastmeDest = getLastMessage($benef['idCompte'], $idCompte);
                                                    ?>
                                                        <li class="p-2 border-bottom">
                                                            <form action="index.php?page=Client/message" method="post" id="userForm">
                                                                <input type="hidden" name="idDestinateurMessage_FK" value="<?= $benef['idCompte'] ?>">
                                                                <button class="d-flex justify-content-between btn btn-info" name="userMessage" style="width:400px; padding:5px;">
                                                                    <div class="d-flex flex-row">
                                                                        <div>
                                                                            <img src="../Admin/assets/img/Client/Profil/<?= $benef['profilClient'] ?>" alt="avatar" class="d-flex align-self-center me-3" width="60">
                                                                            <span class="badge bg-success badge-dot"></span>
                                                                        </div>
                                                                        <div class="pt-1">
                                                                            <p class="fw-bold mb-0"><?= $benef['prenomClient'] . ' ' . $benef['nomClient'] ?></p>
                                                                            <?php if ($lastmeDest && $lastmeExp) {
                                                                                if ($lastmeDest['dateHeureMessage'] > $lastmeExp['dateHeureMessage']) {

                                                                            ?>
                                                                                    <p class="small text-muted"><?= $lastmeDest['message'] ?></p>
                                                                                <?php } else { ?>
                                                                                    <p class="small text-muted"><?= $lastmeExp['message'] ?></p>
                                                                                <?php }
                                                                            } elseif ($lastmeDest) {
                                                                                # code...
                                                                                ?>
                                                                                <p class="small text-muted"><?= $lastmeDest['message'] ?></p>
                                                                            <?php } elseif ($lastmeExp) {
                                                                                # code...
                                                                            ?>
                                                                                <p class="small text-muted"><?= $lastmeExp['message'] ?></p>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="pt-1">
                                                                        <p class="small text-muted mb-1">Just now</p>
                                                                        <span class="badge bg-danger rounded-pill float-end"><?= $nbMessNonLue ?></span>
                                                                    </div>
                                                                </button>
                                                            </form>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- Message -->
                                    <div class="col-md-6 col-lg-7 col-xl-8 overflow-auto">

                                        <div class="pt-3 pe-3" data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px">
                                            <?php
                                            foreach ($mesCs as $mesC) {

                                                //echo $mesDest['idDestinateurMessage_FK'].' ';
                                                // echo $messageE['dateHeureMessage'];
                                                if ($mesC['idExpediteurMessage_FK'] == $idCompte) {
                                                    // echo $mesC['idExpediteurMessage_FK'];

                                            ?>
                                                    <div class="d-flex flex-row justify-content-end">
                                                        <div>
                                                            <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">
                                                                <?= $mesC['message'] ?>
                                                            </p>
                                                            <p class="small ms-3 mb-3 rounded-3 text-muted float-end"><?= $mesC['dateHeureMessage'] ?></p>
                                                        </div>
                                                        <img src="../Admin/assets/img/Client/Profil/<?= $me['profilClient'] ?>" alt="avatar 1" style="width: 45px; height: 100%;">
                                                    </div>
                                                <?php
                                                }
                                                if ($mesC['idExpediteurMessage_FK'] == $idDest) {
                                                    //echo $mesC['idExpediteurMessage_FK'];
                                                ?>
                                                    <div class="d-flex flex-row justify-content-start">
                                                        <img src="../Admin/assets/img/Client/Profil/<?= $mdest['profilClient'] ?>" alt="avatar 1" style="width: 45px; height: 100%;">
                                                        <div>
                                                            <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;"><?= $mesC['message'] ?></p>
                                                            <p class="small me-3 mb-3 rounded-3 text-muted"><?= $mesC['dateHeureMessage'] ?></p>
                                                        </div>
                                                    </div>
                                            <?php

                                                }
                                            }

                                            ?>

                                        </div>

                                        <br><br><br><br>
                                        <!-- formulaire -->
                                        <div class=" col-md-6 col-lg-7 col-xl-8  text-muted d-flex justify-content-start align-items-center pe-3 pt-3 mt-2 position-absolute mt-3">
                                            <form action="index.php?page=Client/message" method="post">
                                                <div class="row">
                                                    <div class="col-1">
                                                        <img src="../Admin/assets/img/Client/Profil/<?= $me['profilClient'] ?>" alt="avatar 3" style="width: 40px; height: 100%;">
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" class="form-control form-control-lg" id="exampleFormControlInput2" placeholder="Type message" name="messageM" width="100%">
                                                        <input type="hidden" class="form-control form-control-lg" id="exampleFormControlInput2" placeholder="Type message" name="idDestinateurMessage_FK" value="<?= $mdest['idCompte'] ?>" width="100%">
                                                    </div>
                                                    <div class="col-1">
                                                        <a class="ms-1 text-muted" href="#!"><i class="fas fa-paperclip"></i></a>
                                                    </div>
                                                    <div class="col-1">
                                                        <a class="ms-3 text-muted" href="#!"><i class="fas fa-smile"></i></a>
                                                    </div>
                                                    <div class="col-1">
                                                        <button class="ms-3" type="submit" name="messageSend"><i class="fas fa-paper-plane"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>


                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </body>

    </html>
<?php } else { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestion des Message</title>
        <link rel="stylesheet" href="assets/css/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/client/client.css">
        <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    </head>

    <body>
        <div class="container-fluid">
            <section>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card-default" id="chat3" style="border-radius: 15px;">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0 overflow-auto">

                                        <div class="p-3">
                                            <a href="index.php?page=Client/accueil" btn btn-button> retour</a>

                                            <div class="input-group rounded mb-3">
                                                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                                <span class="input-group-text border-0" id="search-addon">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                            </div>

                                            <!-- profil -->
                                            <div data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px">
                                                <ul class="list-unstyled mb-0">
                                                    <?php foreach ($benefs as $benef) {
                                                        $nbMessNonLue = getCountMessageNonLue($benef['idCompte'], $idCompte);
                                                        $lastmeExp = getLastMessage($idCompte,  $benef['idCompte']);
                                                        $lastmeDest = getLastMessage($benef['idCompte'], $idCompte);
                                                    ?>
                                                        <li class="p-2 border-bottom">
                                                            <form action="index.php?page=Client/message" method="post" id="userForm">
                                                                <input type="hidden" name="idDestinateurMessage_FK" value="<?= $benef['idClient'] ?>">
                                                                <button class="d-flex justify-content-between btn btn-info" name="userMessage" style="width:400px; padding:5px;">
                                                                    <div class="d-flex flex-row">
                                                                        <div>
                                                                            <img src="../Admin/assets/img/Client/Profil/<?= $benef['profilClient'] ?>" alt="avatar" class="d-flex align-self-center me-3" width="60">
                                                                            <span class="badge bg-success badge-dot"></span>
                                                                        </div>
                                                                        <div class="pt-1">
                                                                            <p class="fw-bold mb-0"><?= $benef['prenomClient'] . ' ' . $benef['nomClient'] ?></p>
                                                                            <?php
                                                                            if ($lastmeDest && $lastmeExp) {


                                                                                if ($lastmeDest['dateHeureMessage'] > $lastmeExp['dateHeureMessage']) {

                                                                            ?>
                                                                                    <p class="small text-muted"><?= $lastmeDest['message'] ?></p>
                                                                                <?php } else { ?>
                                                                                    <p class="small text-muted"><?= $lastmeExp['message'] ?></p>
                                                                                <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="pt-1">
                                                                        <p class="small text-muted mb-1">Just now</p>
                                                                        <span class="badge bg-danger rounded-pill float-end"><?= $nbMessNonLue ?></span>
                                                                    </div>
                                                                </button>
                                                            </form>
                                                        </li>
                                                    <?php } elseif ($lastmeDest) {
                                                    ?>
                                                        <p class="small text-muted"><?= $lastmeDest['message'] ?></p>
                                                    <?php } elseif ($lastmeExp) {
                                                    ?>
                                                        <p class="small text-muted"><?= $lastmeExp['message'] ?></p>
                                                <?php }
                                                                        } ?>
                                                </ul>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- Message -->
                                    <div class="col-md-6 col-lg-7 col-xl-8 overflow-auto">

                                        <div class="pt-3 pe-3" data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px">


                                            <div class="d-flex flex-row justify-content-end">
                                                <!-- <div>
                                                    <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">
                                                       
                                                    </p>
                                                    <p class="small ms-3 mb-3 rounded-3 text-muted float-end"></p>
                                                </div>
                                                <img src="../Admin/assets/img/Client/Profil/" alt="avatar 1" style="width: 45px; height: 100%;"> -->
                                            </div>

                                            <div class="d-flex flex-row justify-content-start">
                                                <!-- <img  alt="avatar 1" style="width: 45px; height: 100%;"> -->
                                                <!-- <div>
                                                    <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;"></p>
                                                    <p class="small me-3 mb-3 rounded-3 text-muted"></p>
                                                </div> -->
                                            </div>


                                        </div>

                                        <br><br><br><br>
                                        <!-- formulaire -->
                                        <div class=" col-md-6 col-lg-7 col-xl-8  text-muted d-flex justify-content-start align-items-center pe-3 pt-3 mt-2 position-absolute mt-3">
                                            <!-- <form action="index.php?page=Client/message" method="post">
                                                <div class="row">
                                                    <div class="col-1">
                                                        <img src="../Admin/assets/img/Client/Profil/<?= $me['profilClient'] ?>" alt="avatar 3" style="width: 40px; height: 100%;">
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" class="form-control form-control-lg" id="exampleFormControlInput2" placeholder="Type message" name="messageM" width="100%">
                                                        <input type="hidden" class="form-control form-control-lg" id="exampleFormControlInput2" placeholder="Type message" name="idDestinateurMessage_FK" value="<?= $benef['idCompte'] ?>" width="100%">
                                                    </div>
                                                    <div class="col-1">
                                                        <a class="ms-1 text-muted" href="#!"><i class="fas fa-paperclip"></i></a>
                                                    </div>
                                                    <div class="col-1">
                                                        <a class="ms-3 text-muted" href="#!"><i class="fas fa-smile"></i></a>
                                                    </div>
                                                    <div class="col-1">
                                                        <button class="ms-3" type="submit" name="messageSend"><i class="fas fa-paper-plane"></i></button>
                                                    </div>
                                                </div>
                                            </form> -->
                                        </div>


                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </body>

    </html>

<?php } ?>