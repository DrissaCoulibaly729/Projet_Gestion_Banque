<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Banque || Home Page</title>

    <script>
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Custom Theme files -->
    <link href="assets/css/css/bootstrap.min.css" type="text/css" rel="stylesheet" media="all">
    <link href="assets/css/accueil/style.css" type="text/css" rel="stylesheet" media="all">
    <!-- font-awesome icons -->
    <link href="assets/fontawesome/css/all.min.css" rel="stylesheet">
    <!-- //Custom Theme files -->
    <!-- online-fonts -->
    <link href="//fonts.googleapis.com/css?family=Amaranth:400,400i,700,700i" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row ">
            <!-- header -->
            <div class="col-lg-2 " id="spy">
                <div class="header-agile">
                    <h1>
                        <a class="navbar-brand" href="index.php">
                            Banque
                        </a>
                    </h1>
                </div>
                <ul class="nav nav-pills flex-column mt-lg-5">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>

                    <button type="button" class="btn btn-block mt-lg-5 mt-3 w3ls-btn p-1 btn-theme text-white  text-uppercase font-weight-bold">
                        <a class="nav-link" href="index.php?page=interAuth/authAdmin">Admin</a>
                    </button>
                    <button type="button" class="btn btn-block mt-lg-5 mt-3 w3ls-btn p-1 btn-theme text-white  text-uppercase font-weight-bold">
                        <a class="nav-link" href="index.php?page=interAuth/authGestionnaire">Gestionnaire</a>
                    </button>
                    <button type="button" class="btn btn-block mt-lg-5 mt-3 w3ls-btn p-1 btn-theme text-white  text-uppercase font-weight-bold">
                        <a class="nav-link" href="index.php?page=interAuth/authCaissier">Caissier</a>
                    </button>
                </ul>

            </div>
            <!-- //header -->
            <!-- main -->
            <div class="col-lg-10 scrollspy-example pr-0 overflow-y-hidden"  data-target="#spy">
                <!-- banner -->
                <div id="home" class="w3ls-banner d-flex  align-items-center justify-content-center">
                    <div class="bnr-w3pvt text-center">
                        <h4>Welcome to!!</h4>
                        <h2 class="bnr-txt-w3">Ma Banque</h2>
                        <p>Pour garantir la sécurité de votre argent, faites confiance à Ma Banque.</p>

                    </div>
                </div>
                <!-- //banner -->

                <!-- //explore -->
                <!-- contact -->
                <div id="contact" class="pt-lg-5">

                    <div class="section">


                        <div class="footer-bottom py-lg-5 py-3">

                            <div class="footer-copy text-center">
                                <p class="text-dark">
                                <footer>
                                    <p>Banque System @ 2024</p>
                                </footer>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- //contact -->
            </div>
            <!-- //main -->
        </div>
    </div>




</body>

</html>