const errorOrSuccessMessage = document.querySelector('.error-message');

if (errorOrSuccessMessage) {
    setTimeout(function () {
        $('.error-message').slideUp('fast');
    },2000)
}