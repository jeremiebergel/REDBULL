var count = document.querySelector('span.count');
var like = document.querySelector('#shareBtn');
var counter = 0;



like.addEventListener('click', function(){
	counter++;
	count.innerHTML = counter;
});