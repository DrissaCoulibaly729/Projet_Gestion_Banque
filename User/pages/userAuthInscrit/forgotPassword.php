<?php
echo $_GET['message'];
if ($_GET['message']==='user1') {
    
        if ($_GET['message']==='user1') {
            $name ='userMdp';
            echo $name;
        }
} else {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Récupération de mot de passe</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
}

.container {
  max-width: 400px;
  margin: 50px auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 20px;
}

input[type="email"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

button {
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}

.error-message {
  color: #dc3545;
  font-size: 12px;
  margin-top: 5px;
}

  </style>
</head>
<body>
  <div class="container">
    <h2>Récupération de mot de passe</h2>
    <form action="index.php" method="post" onsubmit="return validateForm();">
      <div class="form-group">
        <input type="email" id="email" name="email" placeholder="Votre adresse email" required>
        <div class="error-message" id="email-error"></div>
      </div>
      <button type="submit" name="<?= $name?>" onsubmit="validateForm()">Envoyer le lien de récupération</button>
    </form>
  </div>

  <script>
    function validateEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function validateForm() {
  const email = document.getElementById('email').value.trim();
  const emailError = document.getElementById('email-error');
  emailError.textContent = '';

  if (email === '') {
    emailError.textContent = 'Veuillez saisir votre adresse email';
    return false;
  } else if (!validateEmail(email)) {
    emailError.textContent = 'Adresse email invalide';
    return false;
  }

  return true;
}

// document.getElementById('recovery-form').addEventListener('submit', function(event) {
//   event.preventDefault();
//   if (validateForm()) {
//     // Envoyer le lien de récupération
//     alert('Lien de récupération envoyé avec succès !');
//     // Ici, vous pouvez ajouter du code pour envoyer le lien de récupération
//   }
// });

  </script>

</body>
</html>
