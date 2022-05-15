const errorOrSuccessMessage = document.querySelector('.error-message');
const username = document.querySelector("#username");
const password = document.querySelector('#password');
const subject = document.querySelector('#subject');
const contact = document.querySelector('#message');
const menuLogo = document.querySelector(".fa-bars");
const menu = $(".header_menu");
const email = document.querySelector('#email');
const emailRepeat = document.querySelector("#email-repeat");
const passwordRepeat = document.querySelector('#password-repeat');


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

function checkPassword(password) {
    return password.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/);
}


function checkEqualsMail(input1, input2, min, max, errorMessage) {
    input1.addEventListener("input", function (e) {
        if (input1.value === input2.value && input1.value.length > min && input1.value.length < max && checkMail(input1.value) ) {
            input1.setCustomValidity("");
            input1.style.outline = "1px solid green";
            input2.setCustomValidity("");
            input2.style.outline = "1px solid green";
        }else {
            input1.setCustomValidity(errorMessage);
            input1.style.outline = "1px solid red";
            input2.setCustomValidity(errorMessage);
            input2.style.outline = "1px solid red";
        }
    })

    input2.addEventListener("input", function (e) {
        if (input2.value === input1.value && input2.value.length > min && input2.value.length < max && checkMail(input2.value)) {
            input2.setCustomValidity("");
            input2.style.outline = "1px solid green";
            input1.setCustomValidity("");
            input1.style.outline = "1px solid green";
        }else {
            input2.setCustomValidity(errorMessage);
            input2.style.outline = "1px solid red";
            input1.setCustomValidity(errorMessage);
            input1.style.outline = "1px solid red";
        }
    })
}

function checkEqualsPassword(input1, input2, min, max, errorMessage) {
    input1.addEventListener("input", function (e) {
        if (input1.value === input2.value && input1.value.length >= min && input1.value.length <= max && checkPassword(input1.value) ) {
            input1.setCustomValidity("");
            input1.style.outline = "1px solid green";
            input2.setCustomValidity("");
            input2.style.outline = "1px solid green";
        }else {
            input1.setCustomValidity(errorMessage);
            input1.style.outline = "1px solid red";
            input2.setCustomValidity(errorMessage);
            input2.style.outline = "1px solid red";
        }
    })

    input2.addEventListener("input", function (e) {
        if (input2.value === input1.value && input2.value.length >= min && input2.value.length <= max && checkPassword(input2.value)) {
            input2.setCustomValidity("");
            input2.style.outline = "1px solid green";
            input1.setCustomValidity("");
            input1.style.outline = "1px solid green";
        }else {
            input2.setCustomValidity(errorMessage);
            input2.style.outline = "1px solid red";
            input1.setCustomValidity(errorMessage);
            input1.style.outline = "1px solid red";
        }
    })
}


if (username) {
    checkRange(4, 40, username, "La longueur du pseudo doit-être comprise entre 4 et 40 caractères.");
}

if(password) {
    checkEqualsPassword(password, passwordRepeat, 8, 25, "La longeuur du mot de passe doit-être" +
        " comprise en 8 et 25 caractères, les mots de passes ne sont pas égaux où ne sont" +
        " pas au bon format, les mots de passes doivent contenir au moins une majuscule, une minuscule et un chiffre/nombre");
}

if (subject) {
    checkRange(4, 60, subject, "La longueur de l'objet doit-être comprise entre 4 et 60 caractères.");
}

if (contact) {
    checkRange(4, 60, contact, "La longueur de votre message doit-être comprise entre 20 et 255 caractères.");
}
if (email) {
    checkEqualsMail(email, emailRepeat, 6, 150, 'Les mails ne sont pas égaux ou la longueur du champ' +
        ' n\'est pas valide, le champ mail doit être compris entre 6 et 150 caractères. ');
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




