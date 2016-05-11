var fieldToggle = document.getElementById('field-toggle');

function displayPopup(popup, visible) {
	if (visible) {
		document.getElementById(popup).removeAttribute('style');
	} else {
		document.getElementById(popup).setAttribute('style', 'display: none;');
	}
} 

function sendFetchMorePingsRequest(hostID) {
	$.ajax({
		url: "/ajax.php?action=fetch-more-pings",
		type: "post"
	});
}

function changeToggle() {
	var toggleFields = document.getElementsByClassName('toggle-field');

	for (var i=0; i<toggleFields.length; i++) {
		if (fieldToggle.checked) { //host name
			toggleFields[i].textContent = toggleFields[i].getAttribute('data-host-name');
		} else { //ip address
			toggleFields[i].textContent = toggleFields[i].getAttribute('data-ip-address');
		}
	}
}