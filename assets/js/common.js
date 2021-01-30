/**
 * function helps to show dynamic toster
 * @param  {string} message [message text]
 * @param  {String} type    [type of message success, error, warning]
 * @return
 */
function showTosterMessage(message, type ='success'){

	toastr[type](message)

	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "newestOnTop": true,
	  "progressBar": true,
	  "positionClass": "toast-top-right",
	  "preventDuplicates": true,
	  "onclick": null,
	  "showDuration": "300",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}
}

/**
 * function helps to maintain ajax response dynamically
 * @param  object or string response
 * @return 
 */
function maintainAjaxResponse(response){

	response = JSON.parse(response);
	if(response.code == 200 && response.error == false){

		if(!Array.isArray(response.message) && typeof response.message === 'string'){
			showTosterMessage(response.message);return;
		}

		$.each(response.message, function( index, value ) {
		  	showTosterMessage(value );
		});
		return;
	}

	if(!Array.isArray(response.message) && typeof response.message === 'string'){
		showTosterMessage(response.message, 'error');return;
	}

	$.each(response.message, function( index, value ) {
	  	showTosterMessage(value , 'error');
	});
}