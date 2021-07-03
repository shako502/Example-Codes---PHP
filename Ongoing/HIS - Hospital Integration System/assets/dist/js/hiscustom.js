jQuery.validator.setDefaults({
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    }
});

/**
 * KeyPress Delay Function
 */
function keypressDelay(fn, ms) {
    let timer = 0
    return function(...args) {
        clearTimeout(timer)
        timer = setTimeout(fn.bind(this, ...args), ms || 0)
    }
}

$(document).ready(function(){
    var path = window.location.pathname;

    if(path === '/patient' || path === '/ambulatory' || path === '/stationary'){
        $('#patient-treeview').addClass('menu-open');
    }


    $("#ambulatoryPatients").DataTable({
        "responsive": true,
        "autoWidth": false,
        "searching": false,
        "paging": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Georgian.json"
        }
    });
    
    $("#stationaryPatients").DataTable({
        "responsive": true,
        "autoWidth": false,
        "searching": false,
        "paging": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Georgian.json"
        }
    });


    /**
     * Main Search Panel
     * 
     */
    $('#mainsearchKeyword').keyup(keypressDelay(function(e){

        var that = this;
        var keyword = that.value;

        $.ajax({
            url: base_url + 'AjaxRequests/patientSearch',
            method: 'POST',
            data: {mainsearchKeyword: keyword},
            dataType: 'JSON',
            success: function(data){
                var res = data.Response;

                if(res.Status == 'True'){

                    var patients = res.Query;
                    $('#mainsearchDropdown').html('');
                    
                    if(patients.length > 0){
                        for(var i = 0; i < patients.length; i++){
                            var col = patients[i];
                            var formattedText = col.name + ' ' + col.lastname + ' | ' + col.idnumber;
                            var patientel = '<a class="dropdown-item" href="/singlepatient?id='+ col.id +'">'+ formattedText +'</a>';
                            $('#mainsearchDropdown').append(patientel);
                            if(i !== (patients.length - 1) ){
                                $('#mainsearchDropdown').append('<div class="dropdown-divider"></div>');
                            }
                        }
                    } else {
                        $('#mainsearchDropdown').append('<h6 class="dropdown-header">პაციენტი ვერ მოიძებნა</h6>');
                    }
                    if( !($('#mainsearchDropdown').hasClass('show')) ){
                        $('#mainsearchDropdown').addClass('show');
                    }
                
                } else {
                    $('#mainsearchDropdown').html('');
                    $('#mainsearchDropdown').removeClass('show');
                }
            
            }
        });

        return false;
    }, 500));

    $('#mainsearchKeyword').focus(function(){
        $(this).select();
    });



    /**
     * Georgian Keyboard
     * Changer
     * 
     */
    var letters = 'abgdevzTiklmnopJrstufqRySCcZwWxjh';
    var addend = 4304;
    var inputs = [];
    var inputTexts = $('input[data-geokb], textarea[data-geokb]');
    for (var i = 0; i < inputTexts.length; i++) {
        inputs.push(inputTexts[i]);
    }
    
    for (var i = 0; i < inputs.length; i++) {
        var elem = inputs[i];
        var parent = elem.parentElement;

        elem.addEventListener('keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        
            var charIndex = letters.indexOf(String.fromCharCode(keyCode));
            if (charIndex > -1) {
            var newIndex = this.selectionStart + 1;
            var leftText = this.value.substring(0, this.selectionStart);
            var rightText = this.value.substring(this.selectionEnd);
            this.value = leftText + String.fromCharCode(charIndex + addend) + rightText;
            this.setSelectionRange(newIndex, newIndex);
            e.preventDefault();
            }
        });
    }

/*

    //-------------
    //- BAR CHART -
    //-------------
    var areaChartData = {
        labels  : ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'],
        datasets: [
          {
            label               : '',
            backgroundColor     : '#28a745',
            borderColor         : '#28a745',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : [1500, 2000, 500, 70, 3000, 400, 1360, 500, 3000, 400, 1360, 500]
          },
          {
            label               : '',
            backgroundColor     : '#dc3545',
            borderColor         : '#dc3545',
            pointRadius         : false,
            pointColor          : 'rgba(210, 214, 222, 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : [150, 500, 80, 230, 40, 1360, 3000, 400, 1360, 500, 2000, 2190]
          },
        ]
    }


    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      datasetFill: false,
      legend: {
          display: false
      },
      tooltips: {
          enabled: false
      },

      scales: {
        xAxes: [{
            display: true,
            scaleLabel: {
                display: false,
                labelString: 'Month'
            }
        }],
        yAxes: [{
            display: true,
            scaleLabel: {
                display: true,
                labelString: 'Value'
            },
            ticks: {
                min: 0,
                max: 5000,

                // forces step size to be 5 units
                stepSize: 1000
            }
        }]
        }
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    });
      */


});


