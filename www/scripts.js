// @license magnet:?xt=urn:btih:c80d50af7d3db9be66a4d0a86db0286e4fd33292&dn=bsd-3-clause.txt  BSD 3 Clause

function checkSubmit() {
	try {
		var u = document.getElementById('username');
		var p = document.getElementById('password');
		if (!u.value) {
			u.focus();
			return false;
		}
		if (!p.value) {
			p.focus();
			return false;
		}
		var s = document.getElementById('submit');
		s.setAttribute('class', 'active');
		setTimeout(function(){
				s.removeAttribute('class');
			}, 250);
	} catch (e) {
	}
	return true;
}
function setSubmit() {
	try {
		var u = document.getElementById('username');
		var p = document.getElementById('password');
		var s = document.getElementById('submit');
		if (u.value && p.value) {
			s.removeAttribute('class');
		} else {
			s.setAttribute('class', 'disabled');
		}
	} catch (e) {
		s.removeAttribute('class');
	}
}
document.getElementById('loginform').onsubmit = checkSubmit;
document.getElementById('username').onsubmit = setSubmit;
document.getElementById('password').onsubmit = setSubmit;
setSubmit();

document.getElementById('username').removeAttribute('required');
document.getElementById('password').removeAttribute('required');

// @license-end
