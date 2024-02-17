<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accueil - Gestion Bancaire</title>
    <!-- CSS de Bootstrap -->
    <link href="assets/css/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/accueil/style.css" rel="stylesheet">
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
            <a href="#" class="btn btn-outline-warning me-auto">Primary link</a>
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
                            Inscription ou Connexion

                        </h2>
                        <div class="row justify-content-center text-center card-box-r">
                            <!-- Fonctionnalité 1 -->
                            <div class="col-12 col-md-4 card-box-r">
                                <div class="card-box shadow">
                                    <div class="card-img">
                                    <a href="index.php?page=userAuthInscrit/inscri"> <img src="assets/img/user.png" class="card-img-top" alt="Fonctionnalité 1" id="img"></a>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">Inscription</h4>
                                        <p class="card-text">Description de la fonctionnalité 1.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Fonctionnalité 2 -->
                            <div class="col-md-4 card-box-r">
                                <div class="card-box shadow">
                                    <div class="card-img">
                                    <a href="index.php?page=userAuthInscrit/auth"> <img src="assets/img/user.png" class="card-img-top" alt="Fonctionnalité 1" id="img"></a>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">Connexion</h4>
                                        <p class="card-text">Description de la fonctionnalité 2.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Section Client end -->

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