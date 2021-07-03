(function( $ ) {
	'use strict';

	$('.checkinout-main-container').css('display', 'none');

	var tomorrow = new Date();
	tomorrow.setDate(tomorrow.getDate() + 1);
	flatpickr('#checkinout-checkin', {
		dateFormat: 'm-d-Y',
		altInput: true,
		altFormat: 'd/m',
		defaultDate: new Date(),
		minDate: new Date(),
		disableMobile: true
	});

	flatpickr('#checkinout-checkout', {
		dateFormat: 'm-d-Y',
		altInput: true,
		altFormat: 'd/m',
		defaultDate: tomorrow,
		minDate: tomorrow,
		disableMobile: true
	});

	const template = document.getElementById('numberTippy');
	const tippyInstance = tippy(document.querySelectorAll('.checkinout-number-input'), {
		content: template.innerHTML,
		trigger: 'click',
		interactive: true,
		placement: 'bottom'
	});

	$(document).on('click', '.checkinout-numbers button', function(e){
		e.preventDefault();
		var value = $(this).val();
		var activeTippy;
		$.each(tippyInstance, function(i, obj){
			if(obj.state.isMounted){
				activeTippy = obj;
			}
		});
		var inputID = activeTippy.reference.id;
		$('#'+inputID).val(value);
		activeTippy.hide();
	});


	$(document).on('click', '#checkinout-submit', function(){
		var redUrl = $(this).attr('data-redURL');
		var arrive = $('#checkinout-checkin').val();
		var depart = $('#checkinout-checkout').val();
		var child = $('#checkinout-child').val();
		var adult = $('#checkinout-adults').val();
		var childString = '';
		var adultString = '';
		if(child !== '0' && child !== undefined){
			childString = '&' + jsVars.queryChild + '=' + child;
		}
		if(adult !== '0' && adult !== undefined){
			adultString = '&' + jsVars.queryAdults + '=' + adult;
		}
		var arriveString = jsVars.queryCheckin + '=' + arrive;
		var departString = '&' + jsVars.queryCheckout + '=' + depart;

		var fullQueryString = arriveString + departString + adultString + childString;

		var queryString = '';
		if(redUrl.indexOf("?") != -1){
			queryString = '&' + fullQueryString;
		}
		else {
			queryString = '?' + fullQueryString;
		}

		window.open( redUrl + queryString, '_blank');
	});

})( jQuery );
