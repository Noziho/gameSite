const errorOrSuccessMessage = document.querySelector('.error-message');
const username = document.querySelector("#username");
const password = document.querySelector('#password');
const subject = document.querySelector('#subject');
const contact = document.querySelector('#message');
const menuLogo = document.querySelector(".fa-bars");
const menu = $(".header_menu");
const email = document.querySelector('#email');


 function checkRange(min, max , input, errorMessage) {
    input.addEventListener("input", function () {
        if (input.value.length > min && input.value.length < max) {
            input.setCustomValidity("");
            input.style.outline = "1px solid green"
;        }
        else {
            input.setCustomValidity(errorMessage);
            input.style.outline = "1px solid red";
        }
    })

}

function checkMail(mail) {
    return mail.match(/[a-z\d]+@[a-z]+.[a-z]{2,3}/)
}

function mailValidity(input) {
     if (input) {
         input.addEventListener("input", function (event) {
             if (checkMail(this.value)) {
                 this.setCustomValidity("");
                 this.style.outline = "1px solid green";
             }else {
                 this.setCustomValidity("Erreur: l'adresse mail n'est pas au bon format : exemple@gmail.com");
                 this.style.outline = "1px solid red";
             }
         })
     }
}

function checkPassword(password) {
    return password.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/);
}

function passwordValidity (input) {
    input.addEventListener("input", function (event) {
        if (checkPassword(this.value)) {
            this.setCustomValidity("");
            this.style.outline = "1px solid green";
        }else {
            this.setCustomValidity("Erreur: Le mot de passe doit contenir au moins 1 majuscule, une minuscule et un chiffre/nombre");
            this.style.outline = "1px solid red";
        }
    })
}


if (username) {
    checkRange(4, 40, username, "La longueur du pseudo doit-être comprise entre 4 et 40 caractères.");
}

if(password) {
    checkRange(8, 25, password, "La longueur du password doit-être comprise entre 8 et 25 caractères.");
    passwordValidity(password);
}

if (subject) {
    checkRange(4, 60, subject, "La longueur de l'objet doit-être comprise entre 4 et 60 caractères.");
}

if (contact) {
    checkRange(4, 60, contact, "La longueur de votre message doit-être comprise entre 20 et 255 caractères.");
}
if (email) {
    checkRange(6 , 150, email, 'La longueur du mail doit-être comprise entre 6 et 150 caractères');
    mailValidity(email);
}


if (errorOrSuccessMessage) {
    setTimeout(function () {
        $('.error-message').slideUp('fast');
    },3000)

    $('.error-message').click( () => {
        $('.error-message').slideUp('fast');
    })
}

menuLogo.addEventListener("click", () => {
    menu.toggleClass('visible')
});




