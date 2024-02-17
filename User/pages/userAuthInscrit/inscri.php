<?php
  require_once "db/connexiondb.php";
  require_once "db/allFunction.php";
 
  
?>

<!DOCTYPE html>
<html lang="en">
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css"> -->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="assets/css/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  


</head>

<body style="background-color: #eee;">
  <section class="vh-100">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                  <form class="mx-1 mx-md-4" onsubmit="return validateForm();" id="myForm" action="index.php" method="post">

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">Nom</label>
                        <input type="text" id="Nom" name="Nom" class="form-control" onblur="validateName()">
                      </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">Prenom</label>
                        <input type="text" id="Prenom" name="Prenom" class="form-control" onblur="validatePrenom()">
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example3c">Email</label>
                        <input type="email" id="Email" name="Email" class="form-control" onblur="validateEmail()">
                      </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-phone fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example3c">Telephone</label>
                        <input type="number" id="Tel" name="Tel" class="form-control" onblur="validateTel()">
                      </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-university fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example3c">Type Compte</label>
                        <select name="Compte" id="Compte" class="form-control" onblur="validateCompte()">
                          <option value="CCOU" name="CCOU" >Compte Courant</option>
                          <option value="CEPA" name="CEPA" >Compte Epargne</option>
                          <option value="CBUS" name="CBUS" >Compte Business</option>
                          <option value="CCOM" name="CCOM" >Compte Commercial</option>
                        </select>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example4c">Login</label>
                        <input type="text" id="Login" name="Login" class="form-control" onblur="validateLogin()">
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example4cd">Password</label>
                        <input type="password" id="Password" name="Password" class="form-control" onkeydown="validatePassword()">
                      </div>
                    </div>

                    <div class="form-check d-flex justify-content-center mb-5">
                      <input class="form-check-input me-2" type="checkbox" value="" id="Check" name="Check" onblur="validateCheck()" >
                      <label class="form-check-label" for="form2Example3">
                        I agree all statements in <a href="#!">Terms of service</a>
                      </label>
                    </div>

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" name="inscription" class="btn btn-primary btn-lg" onsubmit="validateForm()">Register</button>
                    </div>

                  </form>

                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                  <img src="assets/img/img1.webp" class="img-fluid" alt="Sample image">

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="assets/js/accueil/scriptauth.js"></script>
<script>
  

  function validateForm() {
    if (
        validatePrenom() &&
        validateName() &&
        validateEmail() &&
        validateTel() &&
        validateLogin() &&
        validateCompte() &&
        validatePassword() &&
        validateCheck()
    ) {
       // Your existing logic for successful form validation
       Swal.fire({
        icon: 'success',
        title: 'Form Submitted Successfully',
        text: 'Thank you for submitting the form!',
    });
    return true; // Allow form submission
} else {
    Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: 'Please check and correct the highlighted fields before submitting.',
    });
    return false; // Prevent form submission
}
}
</script>
</body>

</html>