
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
            
            if( ((element.toLowerCase() >= 'a' && element.toLowerCase()<= 'z') ||(element >= 0 || element<= 9) || element ==='@' || element ==='#' || element ==='&' ) && password.length>=8 && password.trim() !== "")
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

function validateForm() {
    if (validateLogin() && validatePassword()) {
        // Your existing logic for successful form validation

        // Display success SweetAlert
        Swal.fire({
            icon: 'success',
            title: 'Login Successful',
            text: 'Welcome!',
        });

        return true; // Allow form submission
    } else {
        // Display error SweetAlert
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: 'Please check and correct the highlighted fields before submitting.',
        });

        return false; // Prevent form submission
    }
}