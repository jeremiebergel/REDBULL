var sign = document.querySelector('header a');
var cross = document.querySelector('.cross');
var popup = document.querySelector('.wrapper-popup');

sign.addEventListener('click', function() {
    popup.classList.remove('closed');
});

cross.addEventListener('click', function() {
    popup.classList.add('closed');
});