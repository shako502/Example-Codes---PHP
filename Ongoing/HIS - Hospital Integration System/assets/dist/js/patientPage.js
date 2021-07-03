$(document).ready(function(){
    
    /**
     * Mask Inputs
     */
    $('#patient-birthdate').inputmask();
    $('#patient-phonenumber').inputmask();
     /* ./Mask Inputs ------------- */

    /**
     * Jquery Patient Registration Validation
     * 
     * Validate Required Fields
     */
    var patientFormValidation = $('#patient-form').validate({
        rules: {
            'patient-name': "required",
            'patient-lastname': "required",
            'patient-address': "required",
            'patient-sex': "required",
            'patient-birthdate': "required",
        },
        messages: {
            'patient-name': 'გთხოვთ შეიყვანოთ პაციენტის სახელი',
            'patient-lastname': 'გთხოვთ შეიყვანოთ პაციენტის გვარი',
            'patient-address': 'გთხოვთ შეიყვანოთ პაციენტის მისამართი',
            'patient-sex': 'გთხოვთ აირჩიოთ პაციენტის სქესი',
            'patient-birthdate': 'შეიყვანეთ პაციენტის დაბადების თარიღი'
        },
        submitHandler: function(form){
            var sendData = $(form).serialize();
            if($('#patient-add-info-checker').val() == 'true'){
                sendData = $('#patient-form, #patient-additional-form').serialize();
            }
            $.ajax({
                url: 'AjaxRequests/patientRegister',
                method: 'POST',
                data: sendData,
                dataType: 'JSON',
                success: function(res){
                    if(res.Connection === 'Success'){
                        if(res.Status === 'Success'){
                            window.location.href = base_url + 'patient/ambulatory?id=' + res.rowID;
                        } else {
                            alert(res.Message);
                        }
                    } else {
                        alert('Connection Problem');
                    }
                }
            });
            return false;
        }
        
        
    });
    /* ./Validation ------------- */


    /**
     * 
     * Unknow Patient Checkbox
     */

    $('#check-patient-unknown').change(function(){
        if(this.checked){
            $('input[name^="patient"]').prop('disabled', true);
            //$('select[name^="patient"]').prop('disabled', true);
            $('#patient-additional-info-btn').attr('disabled', 'disabled');
            $('#patient-unknown-commentary-box').show(300);

            if(!($('#check-patient-placement').is(':checked'))){
                $('#check-patient-placement').prop('checked', true);
            }

            patientFormValidation.resetForm();
            $('#patient-form input').removeClass('is-invalid');

        } else {
            $('input[name^="patient"]').prop('disabled', false);
            //$('select[name^="patient"]').prop('disabled', false);
            $('#patient-additional-info-btn').attr('disabled', false);
            $('#patient-unknown-commentary-box').hide(300);

            if($('#check-patient-placement').is(':checked')){
                $('#check-patient-placement').prop('checked', false);
            }
        }
     });
     /* ./Unknown Patient Checkbox ------------- */


     /**
     * Check ID Number Existense
     * 
     */
    $('#patient-idnumber').keyup(keypressDelay(function(e){

        var that = this;
        var idnumber = that.value;

        $.ajax({
            url: 'AjaxRequests/checkIDnumber',
            method: 'POST',
            data: {idnumber: idnumber},
            dataType: 'JSON',
            success: function(res){
                if(res[0].Status === 'Found'){
                    if($('.patient-registeredPatientError').length == 0){
                        $('#patient-idnumber').after('<span class="patient-registeredPatientError">რეგისტრირებული პაციენტი: <a href="'+ base_url +'singlepatient?id='+ res[0].ID +'">' + res[0].FirstName + ' ' + res[0].LastName + '</a></span>');
                    }
                } else {
                    if($('.patient-registeredPatientError').length != 0){
                        $('.patient-registeredPatientError').remove();
                    }
                }
            }
        });

        return false;
    }, 1000));
    /* ./Check ID Number Existence ------------- */


    /**
     * DataTables Initialization
     * For LastPatients Table on Patients Page
     */
    $("#lastPatients").DataTable({
        "responsive": true,
        "autoWidth": false,
        "searching": false,
        "paging": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Georgian.json"
        },
        "ordering": false,
        "serverSide": true,
        "ajax": {
            url: 'AjaxRequests/dataTables_LastPatients',
            type: 'POST'
        }
    });
    /* ./DataTables Initialization ------------- */

     /**
      * Patient Additional Info Modal
      * 
      * Handling
      */
     $('#save-patient-add-info').click(function(e){
        e.preventDefault();

        $('#patient-add-info-checker').val('true');
        $('#patient-additional-info').modal('hide');
    });

    $('#dissmis-patient-add-info').click(function(){
        $('#patient-additional-info :input').val('');
        $('#patient-add-info-checker').val('');
    });

});

