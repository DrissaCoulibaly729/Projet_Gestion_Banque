

//My function validate Prenom

function validatePrenom() {
    const prenom = document.getElementById("Prenom").value;
    // Ajouter vos contrôles spécifiques pour le prénom ici
    console.log(prenom);
        for (let index = 0; index < prenom.length; index++) {
            var element = prenom[index];
            console.log(element);
            
            if( (element.toLowerCase() >= 'a' && element.toLowerCase()<= 'z') && prenom.length>=2 && prenom.trim() !== "")
            {
                document.getElementById("Prenom").style.borderColor = "green";
            }else
            {
                document.getElementById("Prenom").style.borderColor = "red";
                return false;
            }
            
        }
        return true;
    
    // Autres validations pour le prénom si nécessaire
    
}

//My function validate Name

function validateName() {
    const nom = document.getElementById("Nom").value;
    // Ajouter vos contrôles spécifiques pour le prénom ici
    console.log(nom);
        for (let index = 0; index < nom.length; index++) {
            var element = nom[index];
            console.log(element);
            
            if( (element.toLowerCase() >= 'a' && element.toLowerCase()<= 'z') && nom.length>=2 && nom.trim() !== "")
            {
                document.getElementById("Nom").style.borderColor = "green";
            }else
            {
                document.getElementById("Nom").style.borderColor = "red";
                return false;
            }
            
        }
        return true;
    
    // Autres validations pour le prénom si nécessaire
    
}

//My Function Validate Email

function validateEmail() {
    const email = document.getElementById("Email").value;
    // Ajouter vos contrôles spécifiques pour le prénom ici
    console.log(email);
    var machaine = email.slice(-10);
    if(email.length>10)
    {
        for (let index = 0; index < email.length-10; index++) {
            var element = email[index];
            console.log(element);
            
            if(((element.toLowerCase() >= 'a' && element.toLowerCase()<= 'z') || (element >= 0 || element<= 9)) && machaine==="@gmail.com")
            {
                document.getElementById("Email").style.borderColor = "green";
            }else
            {
                document.getElementById("Email").style.borderColor = "red";
                return false;
            }
            
        }
    }else
    {
        document.getElementById("Email").style.borderColor = "red";
                return false;
    }
        return true;
    
    // Autres validations pour le prénom si nécessaire
    
}

//validate Tel

function validateTel() {
    const tel = document.getElementById("Tel").value;
    // Ajouter vos contrôles spécifiques pour le prénom ici
    console.log(tel);
    console.log(tel.length);
        for (let index = 0; index < tel.length; index++) {
            var element = tel[index];
            console.log(element);
            
            if( (element >= 0 || element<= 9) && tel.length==9 && tel.trim() !== "")
            {
                document.getElementById("Tel").style.borderColor = "green";
            }else
            {
                document.getElementById("Tel").style.borderColor = "red";
                return false;
            }
            
        }
        return true;
    
    // Autres validations pour le prénom si nécessaire
    
}

//validation login

function validateLogin() {
    const login = document.getElementById("Login").value;
    // Ajouter vos contrôles spécifiques pour le prénom ici
    console.log(login);
        for (let index = 0; index < login.length; index++) {
            var element = login[index];
            console.log(element);
            
            if( (element.toLowerCase() >= 'a' && element.toLowerCase()<= 'z') && login.length>=5 && login.trim() !== "")
            {
                document.getElementById("Login").style.borderColor = "green";
            }else
            {
                document.getElementById("Login").style.borderColor = "red";
                return false;
            }
            
        }
        return true;
    
    // Autres validations pour le prénom si nécessaire
    
}

//Validation Password

function validatePassword() {
    const password = document.getElementById("Password").value;
    // Ajouter vos contrôles spécifiques pour le prénom ici
    console.log(password);
        for (let index = 0; index < password.length; index++) {
            var element = password[index];
            console.log(element);
            
            if( ((element.toLowerCase() >= 'a' && element.toLowerCase()<= 'z') ||(element >= 0 || element<= 9) || element =='@' || element =='#' ) && password.length>=8 && password.trim() !== "")
            {
                if (/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_]).*$/.test(password)) {
                    document.getElementById("Password").style.borderColor = "green";
                } else {
                    // Le mot de passe contient deux types de caractères (lettres, chiffres, caractères spéciaux)
                    document.getElementById("Password").style.borderColor = "yellow";
                }
                
            }else
            {
                document.getElementById("Password").style.borderColor = "red";
                return false;
            }
            
        }
        return true;
    
    // Autres validations pour le prénom si nécessaire
    
}

//validation Compte

function validateCompte() {
    const compte = document.getElementById("Compte").value;
    // Ajouter vos contrôles spécifiques pour le prénom ici
    console.log(compte);
      
    document.getElementById("Compte").style.borderColor = "green";
       
    return true;
    
    // Autres validations pour le prénom si nécessaire
    
}


//validation Compte

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

//Validation Form

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

