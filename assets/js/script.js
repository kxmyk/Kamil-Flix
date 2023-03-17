function volumeToggle(btn) {
	let muted = $('.previewVideo').prop('muted');
	$('.previewVideo').prop('muted', !muted);

	$(btn).find('i').toggleClass('fa-solid fa-volume-xmark');
	$(btn).find('i').toggleClass('fa-solid fa-volume-high');
}

function previewEnded() {
	$('.previewVideo').toggle();
	$('.previewImage').toggle();
}
