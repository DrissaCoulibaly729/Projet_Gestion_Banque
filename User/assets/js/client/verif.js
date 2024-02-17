// $(document).ready(function() {
//     $('#single').select2({
//         theme: "bootstrap-5",
//         // width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
//         placeholder: $(this).data('placeholder'),
//         allowClear: true
//     });

//     // Ajouter la classe form-control à l'élément select après l'initialisation de Select2
//     $('#single').next().find('.select2-selection').addClass('form-control');
// });

function validateDateNaiss() {
    const dateNaissInput = document.getElementById("DateNaiss");
    const dateNaissValue = dateNaissInput.value;

    console.log("date : "+dateNaissValue);

    // Créer un objet Date pour la date de naissance saisie
    const dateNaiss = new Date(dateNaissValue);

    
    

    // Obtenir la date actuelle
    const currentDate = new Date();

    // Calculer la différence en années
    const ageDifference = currentDate.getFullYear() - dateNaiss.getFullYear();

    // Vérifier si la date de naissance n'a pas encore eu lieu cette année
    const hasBirthdayOccurred = (
        currentDate.getMonth() > dateNaiss.getMonth() ||
        (currentDate.getMonth() === dateNaiss.getMonth() && currentDate.getDate() >= dateNaiss.getDate())
    );

    // Prendre en compte la différence en années selon si l'anniversaire a eu lieu cette année
    const age = hasBirthdayOccurred ? ageDifference : ageDifference - 1;
    console.log("date : ",age);
    // Vérifier si l'âge est inférieur à 18 ans
    if (dateNaissValue.trim<18 || age < 18) {
        // Si moins de 18 ans, définir la bordure en rouge
        dateNaissInput.style.border = "2px solid red";
        return false;
    } else {
        // Sinon, définir la bordure en vert
        dateNaissInput.style.border = "2px solid green";
        return true;
    }

}

function validateCni() {
    const cniInput = document.getElementById("CNI");
    const cniValue = cniInput.value;

    // Définir les critères de validation (par exemple, longueur du numéro de CNI)
    const cniLength = 10;  // À adapter selon les spécifications de votre CNI

    // Vérifier la longueur du numéro de CNI
    if (cniValue.length !== cniLength) {
        // Si la longueur est incorrecte, définir la bordure en rouge
        cniInput.style.border = "2px solid red";
    } else {
        // Vérifier si le numéro de CNI ne contient que des chiffres
        if (/^\d+$/.test(cniValue)) {
            // Si la validation réussit, définir la bordure en vert
            cniInput.style.border = "2px solid green";
            return true;
        } else {
            // Si le numéro de CNI contient des caractères non numériques, définir la bordure en rouge
            cniInput.style.border = "2px solid red";
            return false;
        }
    }
}

function validateAdresseResidence() {
    const adresseInput = document.getElementById("Adresse");
    const adresseValue = adresseInput.value;

    // Vérifier si l'adresse contient au moins deux mots séparés par une virgule
    const mots = adresseValue.split(',').map(mot => mot.trim()).filter(mot => mot !== '');
    const contientDeuxMots = mots.length >= 2;

    // Vérifier si au moins deux mots sont présents
    if (contientDeuxMots) {
        // Si au moins deux mots sont trouvés, définir la bordure en vert
        adresseInput.style.border = "2px solid green";
        return true;
    } else {
        // Si moins de deux mots sont trouvés, définir la bordure en rouge
        adresseInput.style.border = "2px solid red";
        return false;
    }
}

function validateCodePostal() {
    const postalInput = document.getElementById("Postal");
    const postalValue = postalInput.value;

    // Expression régulière pour un code postal composé de cinq chiffres
    const regex = /^\d{5}$/;

    // Vérifier si le code postal correspond au format spécifié
    if (regex.test(postalValue)) {
        // Si le format est correct, définir la bordure en vert
        postalInput.style.border = "2px solid green";
        return true;
    } else {
        // Si le format est incorrect, définir la bordure en rouge
        postalInput.style.border = "2px solid red";
        return false;
    }
}

function validateVille() {
    const villeInput = document.getElementById("Ville");
    const villeValue = villeInput.value;

    // Expression régulière pour une ville composée de lettres et espaces
    const regex = /^[a-zA-Z\s]+$/;

    // Vérifier si la ville correspond au format spécifié
    if (regex.test(villeValue)) {
        // Si le format est correct, définir la bordure en vert
        villeInput.style.border = "2px solid green";
        return true;
    } else {
        // Si le format est incorrect, définir la bordure en rouge
        villeInput.style.border = "2px solid red";
        return false;
    }
}

function validatePhotoRectoCni() {
    const rectoInput = document.getElementById("Recto");
    const rectoValue = rectoInput.value;

    // Vérifier si le champ n'est pas vide et s'il contient une extension d'image
    if (rectoValue.trim() !== "" && isImageFile(rectoValue)) {
        // Si le fichier est une image, définir la bordure en vert
        rectoInput.style.border = "2px solid green";
        return true;
    } else {
        // Si le fichier n'est pas une image ou le champ est vide, définir la bordure en rouge
        rectoInput.style.border = "2px solid red";
        return false;
    }
}
function validatePhotoVersoCni() {
    const VersoInput = document.getElementById("Verso");
    const VersoValue = VersoInput.value;

    // Vérifier si le champ n'est pas vide et s'il contient une extension d'image
    if (VersoValue.trim() !== "" && isImageFile(VersoValue)) {
        // Si le fichier est une image, définir la bordure en vert
        VersoInput.style.border = "2px solid green";
        return true;
    } else {
        // Si le fichier n'est pas une image ou le champ est vide, définir la bordure en rouge
        VersoInput.style.border = "2px solid red";
        return false;
    }
}
function validatePhotoProfil() {
    const profilInput = document.getElementById("Profil");
    const profilValue = profilInput.value;
    //console.log(profilValue);

    // Vérifier si le champ n'est pas vide et s'il contient une extension d'image
    if (profilValue.trim() !== "" && isImageFile(profilValue)) {
        // Si le fichier est une image, définir la bordure en vert
        profilInput.style.border = "2px solid green";
        return true;
    } else {
        // Si le fichier n'est pas une image ou le champ est vide, définir la bordure en rouge
        profilInput.style.border = "2px solid red";
        return false;
    }
}
// Fonction pour vérifier si le fichier a une extension d'image
function isImageFile(filename) {
    const imageExtensions = ["jpg", "jpeg", "png", "gif", "bmp"]; // Ajoutez d'autres extensions si nécessaire
    const fileExtension = filename.split(".").pop().toLowerCase();
    return imageExtensions.includes(fileExtension);
}

function validateCheck() {
    const checkBox = document.getElementById("Check").checked;
    // Ajouter vos contrôles spécifiques pour le prénom ici
    console.log(checkBox);
      if(checkBox)
      {
        document.getElementById("Check").style.borderColor = "green";
       
        return true;
      }else
      {
        return false;
      }
    
    
    // Autres validations pour le prénom si nécessaire
    
}

// Your existing verif.js file

function validateForm() {
    if (
        validateDateNaiss() &&
        validateCni() &&
        validateAdresseResidence() &&
        validateCodePostal() &&
        validateVille() &&
        validatePhotoRectoCni() &&
        validatePhotoVersoCni() &&
        validatePhotoProfil() &&
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

