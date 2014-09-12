$('#paysafecard_email').live("focusout", function() {

	var email = trim($(this).val());

	console.log('el email fue'+email);

    if(!checkEmail(email)){
    	$(this).css('border','2px solid #FF2F2F');
    	$(this).focus();
    }
    else{
    $(this).css('border','2px inset');
    }
	return false;
});

function checkEmail(email) {

	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(!filter.test(email)) {
		return false;
	}
	return true;
}