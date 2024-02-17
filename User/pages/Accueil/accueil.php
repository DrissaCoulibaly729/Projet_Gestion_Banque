<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accueil - Gestion Bancaire</title>
    <!-- CSS de Bootstrap -->
    <link href="assets/css/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/accueil/style.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="assets/fontawesome/css/all.min.css">-->
</head>

<body>
    <div class="main-container">
        <!-- Barre de navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Gestion Bancaire</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="">Qui Somme Nous ??</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Banque Dans Le Monde</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Actualite</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Nous Rejoindre</a>
                    </li>
                </ul>
            </div>
            <a href="index.php?page=Accueil/choixUser" class="btn btn-outline-warning me-auto">Devenir Client</a>
        </nav>

        <!-- Section header start -->
        <div class="header">
            <!-- <div class="carousel">
                <div class="bg-font1"></div>
                <div class="bg-font1"></div>
                <div class="bg-font1"></div>
                <div>
                    <h1 class="h1">Bienvenue sur Gestion Bancaire</h1>
                </div>
            </div> -->
            <!-- Carousel -->
            <div id="demo" class="carousel slide" data-bs-ride="carousel">

                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                </div>

                <!-- The slideshow/carousel -->
                <div class="carousel-inner">
                    <div class="carousel-item active bg-font1">
                        <div>
                            <h1 class="h1">Bienvenue sur Gestion Bancaire</h1>
                        </div>
                    </div>
                    <div class="carousel-item bg-font2">
                        <div>
                            <h1 class="h1">Bienvenue sur Gestion Bancaire</h1>
                        </div>
                    </div>
                    <div class="carousel-item bg-font3">
                        <div>
                            <h1 class="h1">Bienvenue sur Gestion Bancaire</h1>
                        </div>
                    </div>
                </div>

                <!-- Left and right controls/icons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
        <!--section header end-->
        <!-- Section Client start -->
        <div class="client">
            <div class="-background bg--" style="background-color: #fafafa">
                <div id="client1" class="client1" style="visibility: visible; animation-name: fadeIn;">
                    <div class="container">
                        <h2 class="title h2">
                            Devenir client

                        </h2>
                        <div class="row justify-content-center text-center card-box-r">
                            <!-- Fonctionnalité 1 -->
                            <div class="col-12 col-md-4 card-box-r">
                                <div class="card-box shadow">
                                    <div class="card-img">
                                        <img src="assets/img/cashimg.png" class="card-img-top" alt="Fonctionnalité 1" id="img">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">Fonctionnalité 1</h4>
                                        <p class="card-text">Description de la fonctionnalité 1.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Fonctionnalité 2 -->
                            <div class="col-md-4 card-box-r">
                                <div class="card-box shadow">
                                    <div class="card-img">
                                        <img src="assets/img/user.png" class="card-img-top" alt="Fonctionnalité 1" id="img">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">Fonctionnalité 2</h4>
                                        <p class="card-text">Description de la fonctionnalité 2.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Fonctionnalité 3 -->
                            <div class="col-md-4 card-box-r">
                                <div class="card-box shadow">
                                    <div class="card-img">
                                        <img src="assets/img/cashimg1.jpeg" class="card-img-top" alt="Fonctionnalité 1" id="img">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">Fonctionnalité 3</h4>
                                        <p class="card-text">Description de la fonctionnalité 3.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="etre-client">
                        <a href="#" class="btn btn-primary"><span>Je veux être Client<span></a>
                    </div>

                </div>
            </div>
        </div>
        <!-- Section Client end -->
        <!-- Section Actualite start -->
        <div class="actualite">
            <h2 class="h2">Actualite</h1>
                <div class="row">
                    <div class="col-6 mt-3">
                        <div class="card-box shadow" style="width:400px">
                            <div class="card-img">
                                <img class="img-fluid" src="assets/img/actualite.jpeg" alt="Card image">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">John Doe</h4>
                                <p class="card-text">Some example text.</p>
                                <a href="#" class="btn btn-primary">See Profile</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-3">
                        <div class="card-box shadow" style="width:400px">
                            <div class="card-img">
                                <img class="img-fluid" src="assets/img/actualite1.jpeg" alt="Card image">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">John Doe</h4>
                                <p class="card-text">Some example text.</p>
                                <a href="#" class="btn btn-primary">See Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="card-box shadow" style="width:400px">
                            <div class="card-img">
                                <img class="img-fluid" src="assets/img/actualite2.jpeg" alt="Card image">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">John Doe</h4>
                                <p class="card-text">Some example text.</p>
                                <a href="#" class="btn btn-primary">See Profile</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card-box shadow" style="width:400px">
                            <div class="card-img">
                                <img class="img-fluid" src="assets/img/actualite3.jpeg" alt="Card image">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">John Doe</h4>
                                <p class="card-text">Some example text.</p>
                                <a href="#" class="btn btn-primary">See Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- Section actualite end -->

        <!-- <div class="field__item">

            <div class="has-background--solid bg-custom-- " style="background-color: #fafafa">
                <div id="Devenir-client-CBAO-cest-…-1" class="paragraph paragraph--type--vactory-component paragraph--view-mode--default wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
                    <div class="container">
                        <h2 class="title">
                            Devenir client CBAO, c'est …

                        </h2>
                        <div class="row justify-content-center text-center white-boxes-wrapper vf-slick-slider vf-slick-mobile">
                            <div class="col-12 col-md-4 box-wrapper">
                                <div class="white-box shadow">
                                    <div class="white-box__image">
                                        <img alt="Bénéficier du plus grand réseau d'agences au Sénégal" class="img-fluid img-lazy loaded" src="https://www.cbaobank.com/sites/default/files/2019-07/test_shap_1.png" data-src="https://www.cbaobank.com/sites/default/files/2019-07/test_shap_1.png" data-was-processed="true">
                                    </div>
                                    <div class="white-box__body">
                                        <p>
                                            Bénéficier du plus grand réseau d'agences au Sénégal
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 box-wrapper">
                                <div class="white-box shadow">
                                    <div class="white-box__image">
                                        <img alt="Disposer d'une assistance 24h/24 &amp; 7j/7" class="img-fluid img-lazy loaded" src="https://www.cbaobank.com/sites/default/files/2019-07/Combined%20Shape%20Copy%203%402x.png" data-src="https://www.cbaobank.com/sites/default/files/2019-07/Combined%20Shape%20Copy%203%402x.png" data-was-processed="true">
                                    </div>
                                    <div class="white-box__body">
                                        <p>
                                            Disposer d'une assistance 24h/24 &amp; 7j/7
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 box-wrapper">
                                <div class="white-box shadow">
                                    <div class="white-box__image">
                                        <img alt="Exploiter l'expertise du Groupe AWB sur différentes spécialités" class="img-fluid img-lazy loaded" src="https://www.cbaobank.com/sites/default/files/2019-07/test_shap_1.png" data-src="https://www.cbaobank.com/sites/default/files/2019-07/test_shap_1.png" data-was-processed="true">
                                    </div>
                                    <div class="white-box__body">
                                        <p>
                                            Exploiter l'expertise du Groupe AWB sur différentes spécialités
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center cta-more-link">
                            <a href="/node/12" class="btn btn-outline-primary" target="_self"><span>Je deviens client</span></a>
                        </div>
                    </div>
                </div>
            </div>

        </div> -->

        <!-- Pied de page -->
        <footer class="py-5 bg-dark mt-3">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright © Gestion Bancaire 2023</p>
            </div>
        </footer>
    </div>
    <!-- JS de Bootstrap -->
    <script src="scriptAccueil.js"></script>
</body>

</html>