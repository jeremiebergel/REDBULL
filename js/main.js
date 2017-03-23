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


// creation de compte

var account = document.querySelector('.creation-acc');
var acc_cross = document.querySelector('.creat-acc img.cross');
var new_acc = document.querySelector('p.cta');

new_acc.addEventListener('click', function(){
	account.classList.remove('closed');
	wrapper.style.zIndex = "5";
});


// COMPTEUR

var today = new Date();
		console.log(today);
		var endtime = '2017-03-30';

		function getTimeRemaining(endtime){
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor( (t/1000) % 60 );
  var minutes = Math.floor( (t/1000/60) % 60 );
  var hours = Math.floor( (t/(1000*60*60)) % 24 );
  var days = Math.floor( t/(1000*60*60*24) );
  return {
    'total': t,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}

var days = document.querySelector('.mg-wrapper-days');
var hours = document.querySelector('.mg-wrapper-hours');
var minuts = document.querySelector('.mg-wrapper-minuts');
var seconds = document.querySelector('.mg-wrapper-seconds');
var t = Date.parse(endtime) - Date.parse(new Date());
console.log(t);

function initializeClock(id, endtime){
  var clock = document.querySelector('#clock');
  var timeinterval = setInterval(function(){
    var t = getTimeRemaining(endtime);
    days.innerHTML = t.days + ' <span class="color-black">jours</span>';
    hours.innerHTML = t.hours +' <span class="color-black">heures</span>';
    minuts.innerHTML = t.minutes +' <span class="color-black">minutes</span>';
    seconds.innerHTML = t.seconds +' <span class="color-black">secondes</span>';
    // seconds.innerHTML = t.seconds + '<br>' + ' Seconds';
    // clock.innerHTML = 'days: ' + t.days + '<br>' +
    //                   'hours: '+ t.hours + '<br>' +
    //                   'minutes: ' + t.minutes + '<br>' +
    //                   'seconds: ' + t.seconds;
    if(t.total<=0){
      clearInterval(timeinterval);
    }
  },1000);
}

initializeClock('clockdiv', endtime);