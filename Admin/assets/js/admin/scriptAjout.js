// Validation du champ nom
function validateNom() {
    const nom = document.getElementById('nom').value.trim();
    const nomError = document.getElementById('nom-error');
    nomError.textContent = '';
    if (!/^[A-Za-z]{2,}$/.test(nom)) {
      nomError.textContent = 'Le nom doit contenir uniquement des lettres alphabétiques et comporter au moins deux caractères';
      return false;
    }
    return true;
  }
  
  // Validation du champ prénom
  function validatePrenom() {
    const prenom = document.getElementById('prenom').value.trim();
    const prenomError = document.getElementById('prenom-error');
    prenomError.textContent = '';
    if (!/^[A-Za-z]{3,}$/.test(prenom)) {
      prenomError.textContent = 'Le prénom doit contenir uniquement des lettres alphabétiques et comporter au moins trois caractères';
      return false;
    }
    return true;
  }
  
  // Validation du champ date de naissance
  function validateDateNaissance() {
    let dateNaissance = new Date(document.getElementById('dateNaissance').value);
    const dateNaissanceError = document.getElementById('dateNaissance-error');
    dateNaissanceError.textContent = '';
    const now = new Date();
    let age = now.getFullYear() - dateNaissance.getFullYear();
    const monthDiff = now.getMonth() - dateNaissance.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && now.getDate() < dateNaissance.getDate())) {
      age--;
    }
    if (age < 18) {
      dateNaissanceError.textContent = 'Vous devez être âgé d\'au moins 18 ans pour vous inscrire';
      return false;
    }
    return true;
}

  
  // Validation du champ email
  function validateEmail() {
    const email = document.getElementById('email').value.trim();
    const emailError = document.getElementById('email-error');
    emailError.textContent = '';
    if (email === '') {
      emailError.textContent = 'L\'email est requis';
      return false;
    } else if (!isValidEmail(email)) {
      emailError.textContent = 'Format d\'email invalide';
      return false;
    }
    return true;
  }
  
  // Validation du champ photo de profil
function validatePhotoProfil() {
    const photoInput = document.getElementById('photoProfil');
    const photoProfilError = document.getElementById('photoProfil-error');
    photoProfilError.textContent = '';
    if (photoInput.files.length === 0) {
      photoProfilError.textContent = 'La photo de profil est requise';
      return false;
    } else {
      const photoFileName = photoInput.value;
      if (!isImageFile(photoFileName)) {
        photoProfilError.textContent = 'Le fichier doit être une image avec les extensions suivantes : jpg, jpeg, png, gif ou bmp';
        return false;
      }
    }
    return true;
  }
  
// Validation du champ login
function validateLogin() {
    const login = document.getElementById('login').value.trim();
    const loginError = document.getElementById('login-error');
    loginError.textContent = '';
    if (login.length < 5) {
      loginError.textContent = 'Le login doit comporter au moins 5 caractères';
      return false;
    }
    return true;
  }
  
  // Validation du champ numéro CNI
  function validateNumCni() {
    const numCni = document.getElementById('numCni').value.trim();
    const numCniError = document.getElementById('numCni-error');
    numCniError.textContent = '';
    if (!/^\d{10}$/.test(numCni)) {
      numCniError.textContent = 'Le numéro CNI doit comporter exactement 10 chiffres';
      return false;
    }
    return true;
  }
  
  // Validation du champ téléphone
  function validateTel() {
    const tel = document.getElementById('tel').value.trim();
    const telError = document.getElementById('tel-error');
    telError.textContent = '';
    if (!/^(77|76|74)\d{7}$/.test(tel)) {
      telError.textContent = 'Le numéro de téléphone doit commencer par 77, 76 ou 74, et comporter exactement 9 chiffres';
      return false;
    }
    return true;
}
  
  // Fonction pour valider l'email
  function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }
  
  // Fonction pour valider le numéro de téléphone (10 chiffres)
  function isValidPhoneNumber(phoneNumber) {
    const phoneRegex = /^\d{10}$/;
    return phoneRegex.test(phoneNumber);
  }

  function isImageFile(filename) {
    const imageExtensions = ["jpg", "jpeg", "png", "gif", "bmp"]; // Ajoutez d'autres extensions si nécessaire
    const fileExtension = filename.split(".").pop().toLowerCase();
    return imageExtensions.includes(fileExtension);
}
  
  // Validation globale du formulaire
  function validateForm() {
    return (
      validateNom() &&
      validatePrenom() &&
      validateDateNaissance() &&
      validateEmail() &&
      validatePhotoProfil() &&
      validateTel() &&
      validateNumCni() &&
      validateLogin()
    );
  }
  
 /*  document.getElementById('inscription-form').addEventListener('submit', function(event) {
    event.preventDefault();
    if (validateForm()) {
      alert('Formulaire soumis avec succès !');
      // Ici, vous pouvez envoyer le formulaire à votre serveur ou effectuer d'autres opérations nécessaires
      // document.getElementById('inscription-form').submit();
    }
  });
   */