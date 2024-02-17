<?php
  require_once "db/connexiondb.php";
  require_once "db/allFunction.php";
 
?>
<!DOCTYPE html> 
<html lang="en">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initi<!--al-scale=1.0">
  <title>Document</title>
  <link href="assets/css/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


  <!--<link href="assets/css/Style.css" rel="stylesheet">-->
</head>

<body style="background-color:#eee;">
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="assets/img/img1.webp" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                  <form onsubmit="return validateFormCon();"  action="index.php" method="post">

                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <span class="h1 fw-bold mb-0">Logo</span>
                    </div>

                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;" id="message" hidden>Login ou Password invalid</h5>
                    <div class="form-outline mb-4">
                      <label class="form-label" for="form2Example17">Login</label>
                      <input type="text" id="Login" name="Login" class="form-control form-control-lg" onblur="validateLogin()">
                    </div>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="form2Example27">Password</label>
                      <input type="password" id="Password" name="Password" class="form-control form-control-lg" onkeydown="validatePassword()">
                    </div>

                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" name="auth" type="submit" onsubmit="validateFormCon()">Connexion</button>
                    </div>

                    <a class="small text-muted" href="index.php?page=userAuthInscrit/forgotPassword&message=user1">Forgot password?</a>
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!" style="color: #393f81;">Register here</a></p>
                    <a href="#!" class="small text-muted">Terms of use.</a>
                    <a href="#!" class="small text-muted">Privacy policy</a>
                  </form>

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
    const message="<?php echo $_GET['message']; ?>";
    const messageD=document.getElementById("message")
    if (message ==="failed"){
        messageD.removeAttribute("hidden");
        document.getElementById('message').style.color= "red";
        Swal.fire({
        icon: 'error',
        title: 'Login Error',
        text: 'Login or Password is invalid.',
      });
    }
</script>
<script>
  function validateFormCon() {
    if (
        validateLogin() &&
        validatePassword()
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