const errorOrSuccessMessage = document.querySelector('.error-message');
const username = document.querySelector("#username");
const password = document.querySelector('#password');
const subject = document.querySelector('#subject');
const contact = document.querySelector('#message');
const menuLogo = document.querySelector(".fa-bars");
const menu = $(".header_menu");
const email = document.querySelector('#email');


 function checkRange (min, max , input, errorMessage) {
    input.addEventListener('input', function (event) {
        if (this.value.length > min && this.value.length < max) {
            this.setCustomValidity("");
            this.style.outline = "1px solid green"
;        }
        else {
            this.setCustomValidity(errorMessage);
            this.style.outline = "1px solid red";
        }
    })

}

function checkMail (mail) {
    return mail.match(/[a-z0-9]+@[a-z]+.[a-z]{2,3}/)
}

function mailValidity (input) {
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

if (username) {
    checkRange(4, 40, username, "La longueur du pseudo doit-être comprise entre 4 et 40 caractères.");
}

if(password) {
    checkRange(8, 25, password, "La longueur du password doit-être comprise entre 8 et 25 caractères.");
}

if (subject) {
    checkRange(4, 60, subject, "La longueur de l'objet doit-être comprise entre 4 et 60 caractères.");
}

if (contact) {
    checkRange(4, 60, contact, "La longueur de votre message doit-être comprise entre 20 et 255 caractères.");
}
if (email) {
    mailValidity(email);
    checkRange(email, 6, 150, 'La longueur du mail doit-être comprise entre 6 et 150 caractères');
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




