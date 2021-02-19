// @codekit-prepend 'jQuery.3.3.1.js'

function isEmpty(el){
	return !$.trim(el.val());
}

function verifEmail(c) {
	let regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
	return regex.test(c.val());
}