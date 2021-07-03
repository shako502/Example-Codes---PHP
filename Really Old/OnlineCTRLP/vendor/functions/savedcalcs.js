// JavaScript Document
$(document).ready(function(){
	"use strict";
	
	$('.redirectclass').click(function(){
		var url = $(this).data("href");
		window.location.href = url;
	});
							  
							  
	
	$('#maintable').DataTable({
		"order": [[ 0, "desc" ]],
		"dom": "Bfrtip",
		buttons: [ 'excel', {
								extend: 'print',
								title: function () {
									var d = new Date();
									var month = d.getMonth();
									month++;
									var year = d.getFullYear();
									var date = d.getDate();
									var text = 'Ctrl + P' + ' - ' + date + '/' + month + '/' + year;
									return text;
								},
								customize : function(win) {
									$(win.document.body).find('h1').css('font-size', '13pt');
									$(win.document.body).find('h1').css('text-align', 'center');
								}
							}
				 
				 ],
		"language": {
						"sEmptyTable":     "ცხრილში არ არის მონაცემები",
						"sInfo":           "ნაჩვენებია ჩანაწერები _START_–დან _END_–მდე, _TOTAL_ ჩანაწერიდან",
						"sInfoEmpty":      "ნაჩვენებია ჩანაწერები 0–დან 0–მდე, 0 ჩანაწერიდან",
						"sInfoFiltered":   "(გაფილტრული შედეგი _MAX_ ჩანაწერიდან)",
						"sInfoPostFix":    "",
						"sInfoThousands":  ".",
						"sLengthMenu":     "აჩვენე _MENU_ ჩანაწერი",
						"sLoadingRecords": "იტვირთება...",
						"sProcessing":     "მუშავდება...",
						"sSearch":         "ძიება:",
						"sZeroRecords":    "არაფერი მოიძებნა",
						"oPaginate": {
							"sFirst":    "პირველი",
							"sLast":     "ბოლო",
							"sNext":     "შემდეგი",
							"sPrevious": "წინა"
						},
						"oAria": {
							"sSortAscending":  ": სვეტის დალაგება ზრდის მიხედვით",
							"sSortDescending": ": სვეტის დალაგება კლების მიხედვით"
						},
						"buttons": {
							"excel": "Excel ექსპორტი",
							"print": "ამობეჭდვა"
						}
					}

	});
});