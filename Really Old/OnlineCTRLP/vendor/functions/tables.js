$(document).ready(function(){
	"use strict";
	var table = $('#offertable').DataTable({
		"processing": true,
		"deferRender": true,
		"order": [[ 0, "desc" ]],
		"ajax" : "../../phpvendor/getoffers.php",
		"columns": [
			{data: "ID", visible: false},
			{data: "ProductName"},
			{data: "ProductReceiver"},
			{data: "Tirage"},
			{data: "Date"},
			{data: null, defaultContent: '<button type="button" class="btn btn-success offermore-btn"><span class="typcn typcn-arrow-right-thick" aria-hidden="true"></span></button>'}
		]
	});


	$('#offertable tbody').on('click', 'button', function(){
		var data = table.row( $(this).parents('tr') ).data();
		var id = data['ID'];
		
		window.location.href = '../../loggedusr/saved/index.php?orderid=' + id;
	});
});