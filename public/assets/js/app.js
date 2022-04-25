tinymce.init({
    selector: '#add-news',
    language: 'fr_FR',
    skin_url: '/assets/css/gameSitee',
    content_css: 'gameSite',
    height: '200',
});

tinymce.init({
    selector: '#add-article',
    language: 'fr_FR',
    skin_url: '/assets/css/gameSitee',
    content_css: 'gameSite',
    height: '200',
});

const errorOrSuccessMessage = document.querySelector('.error-message');
const logoMenu = document.getElementById('hoveredMenu');

if (errorOrSuccessMessage) {
    setTimeout(function () {
        $('.error-message').slideUp('fast');
    },2000)
}