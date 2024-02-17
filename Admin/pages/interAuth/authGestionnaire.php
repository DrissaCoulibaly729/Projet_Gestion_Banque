<?php


?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Banque||Login Page</title>


	<!-- Bootstrap Core CSS -->
	<link href="assets/css/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
	<!-- Custom CSS -->
	<link href="assets/css/accueil/style.css" rel='stylesheet' type='text/css' />
	<!-- Graph CSS -->
	<link href="assets/fontawesome/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


</head>

<body>
	<div class="error_page">

		<div class="error-top">
			<h2 class="inner-tittle page">Banque</h2>
			<div class="login">

				<div class="buttons login">
					<h3 class="inner-tittle t-inner" style="color: lightblue">Sign In</h3>
					<p id="message" hidden>Login or password invalide</p>
				</div>
				<form  onsubmit="return validateForm();" method="post" action="index.php">
					<input type="text" class="text" data-placeholder="User Name" id="Login" name="Login" onclick="validateLogin()" >
					<input type="password" placeholder="Password" id="Password" name="Password" onclick="validatePassword()" >
					<div class="submit"><input type="submit" onsubmit="validateForm()" value="Login" name="loginGest"></div>
					<div class="clearfix"></div>

					<div class="new">
						<p><a href="index.php?page=interAuth/forgotPassword&message=ergesn4152">Forgot Password?</a></p>
						<p><a href="index.php">Back Home!!</a></p>

						<div class="clearfix"></div>
					</div>
				</form>
			</div>


		</div>


		<!--//login-top-->
		<!--footer section start-->
		<div class="footer">
				<p>Banque System @ 2024</p>
		</div>
		<!--footer section end-->
	</div>

<script src="assets/js/accueil/auth.js"></script>
<script>
    const message="<?php echo $_GET['message']; ?>";
	console.log(message);
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
</body>

</html>