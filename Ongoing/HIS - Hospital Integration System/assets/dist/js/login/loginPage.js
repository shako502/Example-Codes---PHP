$(document).ready(function(){

    $('#forget-password-btn').on('click', function(e){
        e.preventDefault();

        $('#main-login-card').hide(400);
        $('#forget-password-card').show(500);

    });

    $('#back-on-login').on('click', function(e){
        e.preventDefault();

        $('#forget-password-card').hide(400);
        $('#main-login-card').show(500);

    });


    /**
     * Password Reset Function
     * Call @Ajax
     * 
     */
    $('#reset-password').on('click', function(){
        var email = $('#email-for-reset').val();

        if(email !== ''){
            $.ajax({
                url: base_url + 'AjaxRequests/passwordReset',
                method: 'POST',
                data: {usermail: email},
                dataType: 'JSON',
                success: function(res){
                    console.log(res);
                }
            });
        } else {
            //Validation Error Here
            console.log(email);
        }
    });


    /**
     * Reset Button
     * 
     */

     $('#submitReset').click(function(e){
        e.preventDefault();

        var pass = $('#newPassword').val();
        var confirmPass = $('#retypePassword').val();

        var userID = $('#userID').val();

        if(pass !== '' && confirmPass !== ''){
            if(pass === confirmPass){
                $.ajax({
                    url: base_url + 'AjaxRequests/newPassword',
                    method: 'POST',
                    data: {userID: userID, newPassword: pass},
                    dataType: 'JSON',
                    success: function(res){
                        console.log(res);
                    }
                });
            }
        }
     });


    
}); 