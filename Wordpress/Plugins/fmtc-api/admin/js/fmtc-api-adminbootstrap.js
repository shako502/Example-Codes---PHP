(function( $ ) {
	'use strict';

	function updateChart(dateint, apiAction, chartEl){
		if(dateint === 'undefined'){
			dateint = 0;
		}

		if(apiAction === 'undefined'){
			apiAction = 'none';
		}

		$.ajax({
			url: jsVars.ajax_url,
			method: 'POST',
			data: {
				'action': 'get_statistics',
				'dateInterval': dateint,
				'apiAction': apiAction
			},
			dataType: 'json',
			success: function(statData){
				var newStores = statData['stores'];
				var newDeals = statData['deals'];
				var newCats = statData['cats'];
				chartEl.data.datasets[0].data = [newDeals, newCats, newStores];
				chartEl.update();
			}
		});
	}

	$(document).ready(function(){
		$(document).on('click', '.callApi', function(){
			var endpoint = $(this).attr("data-url");
			$('.loader_slh').fadeIn();
			$.ajax({
				url: 'https://whypayfullprice.ca/wp-json/fmtcapi/v1/' + endpoint,
				method: 'GET',
				timeout: 0,
				success: function(res){
					$('.loader_slh').fadeOut();
					$('#responseModalTitle').text(res.Log);
					$('#responseContent').html('');
					var array = $.makeArray(res);
					$.map(array, function(obj, i){
						$.each(obj, function(key, value){
							$('#responseContent').append(
								'<p>' + key + ': ' + value + '</p>'
							);
						});
					});
					$('#responseModal').modal('show')
				}
			});
		});

		var statPie = document.getElementById("statPie").getContext('2d');
		var pieChartEl = new Chart(statPie, {
			type: 'doughnut',
			data: {
				labels: ["Get Deals", "Get Categories", "Get Stores"],
				datasets: [{
					data: [25, 0, 5],
					backgroundColor: ["#ff5b38", "#734afe", "#8de142"],
					hoverBackgroundColor: ["#ff9984", "#a084ff", "#a5e46c"]
				}]
			},
			options: {
				responsive: true
			}
		});

		updateChart(undefined, undefined, pieChartEl);


		$('#statDateSel').on('change', function(){
			var days = $(this).find('option:selected').val();
			updateChart(days, undefined, pieChartEl);
		});
	});

})( jQuery );
