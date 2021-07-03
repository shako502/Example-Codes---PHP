$(document).ready(function(){

     /**
     * DataTables Initialization
     * For LastPatients Table on Patients Page
     */
    $("#added-data-table").DataTable({
        "responsive": true,
        "autoWidth": false,
        "searching": false,
        "paging": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Georgian.json"
        },
        "ordering": false
    });
    /* ./DataTables Initialization ------------- */

    /**
     * Main Search Panel
     * 
     */
    $('#search-tests-input').keyup(keypressDelay(function(e){

        var that = this;
        var keyword = that.value;

        $.ajax({
            url: base_url + 'AjaxRequests/searchTests',
            method: 'POST',
            data: {mainsearchKeyword: keyword},
            dataType: 'JSON',
            success: function(data){
                var res = data.Response;

                if(res.Status == 'True'){

                    var patients = res.Query;
                    $('#search-tests-dropdown').html('');
                    
                    if(patients.length > 0){
                        for(var i = 0; i < patients.length; i++){
                            var col = patients[i];
                            var formattedText = col.name + ' ' + col.lastname + ' | ' + col.idnumber;
                            var patientel = '<a class="dropdown-item" href="/singlepatient?id='+ col.id +'">'+ formattedText +'</a>';
                            $('#search-tests-dropdown').append(patientel);
                            if(i !== (patients.length - 1) ){
                                $('#search-tests-dropdown').append('<div class="dropdown-divider"></div>');
                            }
                        }
                    } else {
                        $('#search-tests-dropdown').append('<h6 class="dropdown-header">პაციენტი ვერ მოიძებნა</h6>');
                    }
                    if( !($('#search-tests-dropdown').hasClass('show')) ){
                        $('#search-tests-dropdown').addClass('show');
                    }
                
                } else {
                    $('#search-tests-dropdown').html('');
                    $('#search-tests-dropdown').removeClass('show');
                }
            
            }
        });

        return false;
    }, 500));


  
/*
    
    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });

    $('#multi-lab-choose').on('select2:selecting', function(e){
        if( $('#lab-choose-accordion .card').length > 0 ){
            $('.collapse').collapse('hide');
        }
    });

    $('#multi-lab-choose').on('select2:select', function(e){
        var data = e.params.data;
        console.log(data);

        var elID = $(data.element).data('id');

        var cardHTML = `<div class="card" id="collapseCard-${elID}">
                            <div class="card-header" id="header-${elID}">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-${elID}" aria-expanded="true" aria-controls="collapse-${elID}">
                                ${data.text}
                                </button>
                            </h2>
                            </div>
                        
                            <div id="collapse-${elID}" class="collapse show" aria-labelledby="header-${elID}" data-parent="#lab-choose-accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="insurance">დაზღვევა</label>
                                    <input type="text" id="insurance" class="form-control" />
                                </div>
                            </div>
                            </div>
                        </div>`;

        $('#lab-choose-accordion').prepend(cardHTML);
    });

    $('#multi-lab-choose').on('select2:unselect', function(e){
    var data = e.params.data;
    console.log(data);
    var elID = $(data.element).data('id');
    
    console.log(elID);

    $('#collapseCard-'+ elID).remove();

    });
*/
});