var sign = document.querySelector('header a.signin');
var cross = document.querySelector('.popup .cross');
var popup = document.querySelector('.wrapper-popup');

var wrapper = document.querySelector('.wrapper');

sign.addEventListener('click', function() {
    popup.classList.remove('closed');
    wrapper.style.zIndex = "5";
});

cross.addEventListener('click', function() {
    popup.classList.add('closed');
    wrapper.style.zIndex = "9";
});

var termes = document.querySelector('header a.termes');
var crossconcours = document.querySelector('.popup-concours .cross');
var popupconcours = document.querySelector('.wrapper-popup-concours');

termes.addEventListener('click', function() {
    popupconcours.classList.remove('closed');
    wrapper.style.zIndex = "5";
});

crossconcours.addEventListener('click', function() {
    popupconcours.classList.add('closed');
    wrapper.style.zIndex = "9";
});



