const errorOrSuccessMessage = document.querySelector('.error-message');
const username = document.querySelector("#username");
const password = document.querySelector('#password');
const subject = document.querySelector('#subject');
const contact = document.querySelector('#message');
const menuLogo = document.querySelector(".fa-bars");
const menu = $(".header_menu");


 function checkRange (min, max , input, errorMessage) {
    input.addEventListener('keypress', function () {
        if (input.value.length < min || input.value.length > max) {
            input.setCustomValidity(errorMessage);
        }
        else {
            input.setCustomValidity("");
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