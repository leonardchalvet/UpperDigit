// @codekit-prepend 'jQuery.3.3.1.js'

function isEmpty(el){
	return !$.trim(el.val());
}

function verifEmail(c) {
	let regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
	return regex.test(c.val());
}

function getCookie(cname) {
	let name = cname + "=";
	let decodedCookie = decodeURIComponent(document.cookie);
	let ca = decodedCookie.split(';');
	for(let i = 0; i <ca.length; i++) {
		let c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return true;
		}
	}
	return false;
}

function setCookie(cname, cvalue, exdays) {
	let d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	let expires = "expires="+ d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function checkCookie() {
	if(!getCookie('cookie')) {

		$('.container-cookies').addClass('style-show');

		$('.container-cookies .btn:nth-child(1)').click(function(){
			$('.container-cookies').removeClass('style-show');
		});

		$('.container-cookies .btn:nth-child(2)').click(function(){
			$('.container-cookies').removeClass('style-show');
			setCookie('cookie');
		});
	}
}
checkCookie();