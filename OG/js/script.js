(function($){
	/* Instant gratification on form submittal */
	var $contactForm = $('#contactSensibleUX'),
			v = $contactForm.validate({
			submitHandler: function(form) {
				$(form).ajaxSubmit({
					success: formSuccess,
					error: formError
				});
			}
		});
	function formError(jqXHR, textStatus, errorThrown){
		$("#thankYou").html("<strong>This form doesn't really work yet, thanks for trying</strong>").fadeIn();
	}
	function formSuccess(responseText, statusText, xhr, $form){
		$contactForm.find("fieldset").remove().end().find("#thankYou").fadeIn();
		return false;
	}
}(jQuery));