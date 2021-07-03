(function($) {
	
	$('#klaviyo-email-submit').on('click', function(){
        var email = $('#klaviyo-subscriber-email').val();
        var container = $('.newsletter-response');
        $('.subsc-loader').show();
        $.ajax({
            url: php_vars.baseurl + '/wp-json/fmtcapi/v1/klaviyo-list',
            method: 'POST',
            data: {email: email},
            dataType: 'JSON',
            success: function(res){

                var contMsg = '';

               if( res.Status === 200 ) {
                    if(res.Endpoint === 'list'){
                        if(res.Message[0].id != ''){
                            contMsg = 'You have successfully subscribed to the newsletter';
                        } else {
                            contMsg = 'Error occured. Subscribtion can not be activated';
                        }
                    } else if(res.Endpoint === 'members'){
                        if(res.Message === '1'){
                            contMsg = 'You have successfully subscribed to the newsletter';
                        } else {
                            contMsg = 'Error occured. Subscribtion can not be activated';
                        }
                    }
                } else {
                    contMsg = 'Error occured. Code: 1710';
                }

                $('.subsc-loader').hide();

                container.append(`<p>${contMsg}</p>`);
                
            }
        });
    });
	
})( jQuery );