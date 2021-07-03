// JavaScript Document
jQuery.extend(jQuery.validator.messages, {
	required: "აუცილებელი ველი!",
	 number: "გთხოვთ შეიყვანოთ ციფრი"
	
});

$.validator.setDefaults({
    highlight: function (element) {
		"use strict";
    $(element).closest('.form-group').addClass('has-error');
    $(element).addClass('select-class');                      

},
unhighlight: function (element) {
	"use strict";
    $(element).closest('.form-group').removeClass('has-error');
    $(element).removeClass('select-class');   
},
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function(error, element) {
		"use strict";
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});

$(document).ready(function(){
	"use strict";
	
	
	$.getScript("../vendor/functions/calculationscript.js", function() {
   		console.log('script loaded');
	});
	$('.savename-row').hide();
	
	
	$('.save-calc-pre').click(function(){
		$('.savename-row').show(300);
	});
	
	
	$('#papersizechoice').on('change', function(){
		if($(this).val() === 'other'){
			$('#prodFormatContainer').css('background-color', 'rgb(183, 212, 50)');
			$('#prodFormatContainer').show(100);
			setTimeout(function(){
				$('#prodFormatContainer').css('background-color', 'inherit');
			}, 500);
			
		}
		else {
			$('#prodFormatContainer').hide(100);
		}
	});
	
});

	
	function addmoretirage(event){
		"use strict";
		var tirage_num_id = $('.add-after-it .input-group').length;
		tirage_num_id++;
		
		$('.add-after-it').append('<div class="input-group" style="margin-top: 5px;">'+
												'<input type="number" id="tirage'+ tirage_num_id +'" placeholder="0" value="" class="form-control tirage-control" required />'+
												'<div class="input-group-append">'+
													'<button class="btn btn-danger" onClick="removetiragefield(event);" type="button"><span class="typcn typcn-minus-outline"></span></button>'+
												'</div>'+
											'</div>');
		
		
		//ADD Percent Input
		$('.a3percentcontainer').append('<input type="number" id="pluspercent'+ tirage_num_id +'" placeholder="0" value="0" class="form-control" style="margin-top: 10px;" />');
		
		
		$('.add-after-it .input-group:not(:last) > .input-group-append').remove();
	}

	function removetiragefield(event) {
		"use strict";
		var tirage_num_count = $('.add-after-it .input-group').length;
		if(tirage_num_count !== 2) {
			
		$('.add-after-it .input-group').eq(-2).append('<div class="input-group-append">'+
															'<button class="btn btn-danger" onClick="removetiragefield(event);" type="button"><span class="typcn typcn-minus-outline"></span></button>'+
														'</div>');
		}
		var removetarget = $(event.target);
		removetarget.closest('.input-group').remove();
		
		console.log(tirage_num_count);
		$('#pluspercent' + tirage_num_count).remove();
	}


$('.sumup').click(function(){
	"use strict";
	
	$('#CalcInputValidation').validate({
		rules: {
			insidepaperweight: "required",
			coverpaperweight: {
				required: function(){
					if($('#cover').val() === '4'){
						return true;
					}
					else {
						return false;
					}
				}
			},
			printformcover: {
				required: function(){
					if($('#cover').val() === '4'){
						return true;
					}
					else {
						return false;
					}
				}
			},
			prodFormatInput: {
				required: function(){
					if($('#papersizechoice').val() === 'other'){
						return true;
					}
					else {
						return false;
					}
				},
			}
		},
		messages: {
			prodFormatInput: 'შეიყვანეთ ფორმატის რაოდენობა'
		},
		submitHandler: function() {
	
	//Tirage Changer Function
	var tirage_count = $('.tirage-control').length;
	var tirage_chan_check = $('.tirage-changer-check').length;
	
	if(tirage_chan_check !== 0){
		$('.tirage-changer-check').remove();
	}
	
	if(tirage_count > 1){
		$('.tirage-control').each( function(){
			var tirage_value = $(this).val();
			var tirage_id = $(this).attr('id');
			var timecount = tirage_id.replace('tirage', '');
			$('.tirage-changer-container').append('<div class="col-lg tirage-changer-check">' +
														'<input type="button" onClick="tiragechange(event)" data-timecount="'+ timecount +'" class="btn btn-info btn-block tirage-changer" value="ტირაჟი '+ tirage_value +'">' +
												  '</div>');
			});	
	}
	else {
		$('.tirage-changer-title').hide();
	}
	
	
		// Get Values and Define Variables
		var tirage = $('#tirage').val();
		var insidepaperweight = $('#insidepaperweight').val();
		var insidepages = $('#insidepages').val();
		var printform = $('#printform').val();
		var printformcover = $('#printformcover').val();
		var mainpapersize = $('#mainpapersize').val();
		var mainpaperswitchname = $('#mainpapersize').find(':selected').data('papername');
		var papersizechoice = $('#papersizechoice').val();
		var cover = $('#cover').val();
		var coverpaperweight = $('#coverpaperweight').val();
		var paperprice = $('#paperprice').val();
		var folding = $('#folding').val();
		var stitch = $('#stitch').val();
		var formatcut = $('#formatcut').val();
		var otherfees = $('#otherfees').val();
		var feepercent = $('#feepercent').val();
		var otherformatinput = $('#prodFormatInput').val();
			
		
	
		//Correct Some Values
	 	var printformdata = $('#printform').find(':selected').data('name');
		var printformnames = ''; // Print Form Names Correction
		switch(printformdata) {
			case 'ff': 
				printformnames = '4/4';
				break;
			case 'fz': 
				printformnames = '4/0';
				break;
			case 'ff5': 
				printformnames = '5/5';
				break;
			case 'tt': 
				printformnames = '2/2';
				break;
			case 'tz': 
				printformnames = '2/0';
				break;
			case 'oo': 
				printformnames = '1/1';
				break;
			case 'oz': 
				printformnames = '1/0';
				break;
			default: 
				printformnames = 'არ არის განსაზღვრული';
			}
		
		var printformcoverdata = $('#printformcover').find(':selected').data('name');
		var printformcovernames = '';// Print Form Names Correction
		if( !(isNaN( $('#printformcover').val() ) ) ){
			
			switch(printformcoverdata) {
				case 'ff': 
					printformcovernames = '4/4';
					break;
				case 'fz': 
					printformcovernames = '4/0';
					break;
				case 'ff5': 
					printformcovernames = '5/5';
					break;
				case 'tt': 
					printformcovernames = '2/2';
					break;
				case 'tz': 
					printformcovernames = '2/0';
					break;
				case 'oo': 
					printformcovernames = '1/1';
					break;
				case 'oz': 
					printformcovernames = '1/0';
					break;
				default: 
					printformcovernames = 'არ არის განსაზღვრული';
				}
			}
		else{
			printformcoverdata = 0;
			printformcovernames = 0;
		}	
			var mainpapernames = ''; // Main Paper Names Correction
			switch(mainpaperswitchname) {
				case 'a36490' : 
					mainpapernames = '64 X 90';
					break;
				case 'a370100' :
					mainpapernames = '70 X 100';
					break;
				case 'a25070' :
					mainpapernames = '50 X 70';
					break;
				case 'a24564' :
					mainpapernames = '45 X 64';
					break;
				default: 
					mainpapernames = 'არ არის განსაზღვრული';
			}
	
			var papersizechoiceup = papersizechoice.toUpperCase(); // Upper Case of Last Paper Size
			
			var stitchtogeo = ''; // Correct Georgian Names from English
			switch(stitch) {
				case 'thermal' : 
					stitchtogeo = 'თერმული';
					break;
				case 'stapler' :
					stitchtogeo = 'სტეპლერი';
					break;
				default :
					stitchtogeo = 'არ არის განსაზღვრული';
						 }
			
		var formatcutfix = ''; // FormatCut Logic Yes or No
		if(formatcut === '1') {
			formatcutfix = 'კი';
		}
		else {
			formatcutfix = 'არა';
		}
		
		var sendValues = {
			getTirage: tirage,
			getInPaperWeight: insidepaperweight,
			getInPages: insidepages,
			getPrintForm: printform,
			getPrintFormCover: printformcover,
			getMainPaperSize: mainpapersize,
			getMainFormat: papersizechoice,
			getCoverPages: cover,
			getCoverPagesWeight: coverpaperweight,
			getPaperPrice: paperprice,
			getFolding: folding,
			getStitch: stitch,
			getOtherFees: otherfees,
			getFeePercet: feepercent,
			getPrintFormData: printformdata,
			getPrintFormCoverData: printformcoverdata,
			getOtherFormatInput: otherformatinput
		};
			
		var calcReturnValues;
		if(mainpaperswitchname !== 'a25070' || mainpapernames !== 'a24564'){
			calcReturnValues = CalculateIt(sendValues);
		}
		else {
			calcReturnValues = CalculateItA2(sendValues);
		}
			
		// iNSERt UNCHANGED vAriables iNTo ModAl
		$('#tirage-last').val(tirage);           							// ტირაჟი
		$('#inpaperweight-last').val(insidepaperweight); 						// ქაღალდის წონა
		$('#insidepages-last').val(insidepages); 							// შიგთავსის გვ. რაოდენობა
		$('#printform-last').val(printformnames);     						// საბეჭდი ფორმა
		$('#printformcover-last').val(printformcovernames);     			// საბეჭდი ფორმა ყდა
		$('.mainpapername').val(mainpapernames);           // ძირითადი ქაღალდის ზომა
		$('#papersizechoice-last').val(papersizechoiceup);      			// საბოლოო ქაღალდის ზომა
		$('#cover-last').val(cover);                       					// ყდა
		$('#paperprice-last').val(paperprice);                  			// ქაღალდის ფასი
		$('#folding-last').val(folding);                     				// კეცვა
		$('#stitch-last').val(stitchtogeo);                     			// აკინძვა
		$('#formatcut-last').val(formatcutfix);                 			// ფორმატზე დაჭრა
		$('#otherfees-last').val(otherfees);                   				// სხვა ხარჯები
		$('#stitchtobase').val(stitch);
		$('#pagespercent-last').val($('#pluspercent').val());
		$('#covpaperweight-last').val($('#coverpaperweight').val());
		$('#pricepercent-last').val($('#feepercent').val());
		$('#otherfeescomm-last').val($('#otherfeecomment').val());
		
	
	
		// iNSERt Changed Variables
		$('#a3quantity').val(calcReturnValues.AQuantity); // iNSERt A3 paper quantity
		$('#mainpaperquantity-last').val(calcReturnValues.MainPaperQ); //iNSERt Main Paper (big Paper) Quantity
		$('#almost').text('~' + ' ' + calcReturnValues.MainPaperAlmostQ); // iNSERt almost paper quantity
		$('#fullweight-last').val(calcReturnValues.FullWeight); // iNSERt Full Weight
		$('#fullprice').val(calcReturnValues.FullPrice); // iNSERt Full Price
		$('#printime-last').val(calcReturnValues.FullPrintTimePrice); // iNSERt Print Time Fee
		$('#pricewithoutfee').val(calcReturnValues.PriceWithoutFee); // iNSERt Full Price without Fee
		$('#insidea3q-last').val(calcReturnValues.InAQ); //iNSERt Inside A3 quantity
		$('#covera3q-last').val(calcReturnValues.CovAQ); //iNSERt Cover A3 quantity
		$('#foldprice-last').val(calcReturnValues.FoldPrice); //iNSERt Folding Price
		$('#kindzva-last').val(calcReturnValues.StitchPrice); //iNSERt Stitching Price
		$('#afterinpagesweight-last').val(calcReturnValues.InPagesWeight);
		$('#aftercovweight-last').val(calcReturnValues.CovPagesWeight);
		$('#inpagesprintprice-last').val(calcReturnValues.InPagesFormPrice);
		$('#covprintprice-last').val(calcReturnValues.CovFormPrice);
		$('#inpagesprinttime-last').val(calcReturnValues.InPagesPrintTime);
		$('#covprinttime-last').val(calcReturnValues.CovPrintTime);
		$('#formatcutprice-last').val(0);
			
			$('#calculationmodal').modal('show');
			
		}
		
		});
	
});


function tiragechange(event) {
	
	"use strict";
	
	var parsetirage = event.target.value;
	var tirage = parsetirage.replace('ტირაჟი ', '');
	var numbercount = $(event.target).data('timecount');
	console.log(numbercount);
	
		
		// Get Values and Define Variables
		var insidepaperweight = $('#insidepaperweight').val();
		var insidepages = $('#insidepages').val();
		var printform = $('#printform').val();
		var printformcover = $('#printformcover').val();
		var mainpapersize = $('#mainpapersize').val();
		var papersizechoice = $('#papersizechoice').val();
		var cover = $('#cover').val();
		var coverpaperweight = $('#coverpaperweight').val();
		var paperprice = $('#paperprice').val();
		var folding = $('#folding').val();
		var stitch = $('#stitch').val();
		var formatcut = $('#formatcut').val();
		var otherfees = $('#otherfees').val();
		var feepercent = $('#feepercent').val();
		var otherformatinput = $('#prodFormatInput').val();
		var mainpaperswitchname = $('#mainpapersize').find(':selected').data('papername');
		
	
		//Correct Some Values
	 	var printformdata = $('#printform').find(':selected').data('name');
		console.log(printformdata);
		var printformnames = ''; // Print Form Names Correction
		switch(printformdata) {
			case 'ff': 
				printformnames = '4/4';
				break;
			case 'fz': 
				printformnames = '4/0';
				break;
			case 'ff5': 
				printformnames = '5/5';
				break;
			case 'tt': 
				printformnames = '2/2';
				break;
			case 'tz': 
				printformnames = '2/0';
				break;
			case 'oo': 
				printformnames = '1/1';
				break;
			case 'oz': 
				printformnames = '1/0';
				break;
			default: 
				printformnames = 'არ არის განსაზღვრული';
			}
		
		var printformcoverdata = $('#printformcover').find(':selected').data('name');
		var printformcovernames = '';// Print Form Names Correction
		if( !(isNaN( $('#printformcover').val() ) ) ){
			
			switch(printformcoverdata) {
				case 'ff': 
					printformcovernames = '4/4';
					break;
				case 'fz': 
					printformcovernames = '4/0';
					break;
				case 'ff5': 
					printformcovernames = '5/5';
					break;
				case 'tt': 
					printformcovernames = '2/2';
					break;
				case 'tz': 
					printformcovernames = '2/0';
					break;
				case 'oo': 
					printformcovernames = '1/1';
					break;
				case 'oz': 
					printformcovernames = '1/0';
					break;
				default: 
					printformcovernames = 'არ არის განსაზღვრული';
				}
			}
		else{
			printformcoverdata = 0;
			printformcovernames = 0;
		}	
			var mainpapernames = ''; // Main Paper Names Correction
			switch(mainpaperswitchname) {
				case 'a36490' : 
					mainpapernames = '64 X 90';
					break;
				case 'a370100' :
					mainpapernames = '70 X 100';
					break;
				case 'a25070' :
					mainpapernames = '50 X 70';
					break;
				case 'a24564' :
					mainpapernames = '45 X 64';
					break;
				default: 
					mainpapernames = 'არ არის განსაზღვრული';
			}
	
			var papersizechoiceup = papersizechoice.toUpperCase(); // Upper Case of Last Paper Size
			
			var stitchtogeo = ''; // Correct Georgian Names from English
			switch(stitch) {
				case 'thermal' : 
					stitchtogeo = 'თერმული';
					break;
				case 'stapler' :
					stitchtogeo = 'სტეპლერი';
					break;
				default :
					stitchtogeo = 'არ არის განსაზღვრული';
						 }
			
		var formatcutfix = ''; // FormatCut Logic Yes or No
		if(formatcut === '1') {
			formatcutfix = 'კი';
		}
		else {
			formatcutfix = 'არა';
		}
	
		var sendValues = {
			getTirage: tirage,
			getInPaperWeight: insidepaperweight,
			getInPages: insidepages,
			getPrintForm: printform,
			getPrintFormCover: printformcover,
			getMainPaperSize: mainpapersize,
			getMainFormat: papersizechoice,
			getCoverPages: cover,
			getCoverPagesWeight: coverpaperweight,
			getPaperPrice: paperprice,
			getFolding: folding,
			getStitch: stitch,
			getOtherFees: otherfees,
			getFeePercet: feepercent,
			getPrintFormData: printformdata,
			getPrintFormCoverData: printformcoverdata,
			getOtherFormatInput: otherformatinput
		};
			
		var calcReturnValues;
	
		if(mainpaperswitchname !== 'a25070' || mainpapernames !== 'a24564'){
			calcReturnValues = CalculateIt(sendValues);
		}
		else {
			calcReturnValues = CalculateItA2(sendValues);
		}
	
	
		// iNSERt UNCHANGED vAriables iNTo ModAl
		$('#tirage-last').val(tirage);           							// ტირაჟი
		$('#inpaperweight-last').val(insidepaperweight); 						// ქაღალდის წონა
		$('#insidepages-last').val(insidepages); 							// შიგთავსის გვ. რაოდენობა
		$('#printform-last').val(printformnames);     						// საბეჭდი ფორმა
		$('#printformcover-last').val(printformcovernames);     			// საბეჭდი ფორმა ყდა
		$('.mainpapername').val(mainpapernames);           // ძირითადი ქაღალდის ზომა
		$('#papersizechoice-last').val(papersizechoiceup);      			// საბოლოო ქაღალდის ზომა
		$('#cover-last').val(cover);                       					// ყდა
		$('#paperprice-last').val(paperprice);                  			// ქაღალდის ფასი
		$('#folding-last').val(folding);                     				// კეცვა
		$('#stitch-last').val(stitchtogeo);                     			// აკინძვა
		$('#formatcut-last').val(formatcutfix);                 			// ფორმატზე დაჭრა
		$('#otherfees-last').val(otherfees);                   				// სხვა ხარჯები
		$('#stitchtobase').val(stitch);
		$('#pagespercent-last').val($('#pluspercent').val());
		$('#covpaperweight-last').val($('#coverpaperweight').val());
		$('#pricepercent-last').val($('#feepercent').val());
		$('#otherfeescomm-last').val($('#otherfeecomment').val());
		
		
	
	
		// iNSERt Changed Variables
		$('#a3quantity').val(calcReturnValues.AQuantity); // iNSERt A3 paper quantity
		$('#mainpaperquantity-last').val(calcReturnValues.MainPaperQ); //iNSERt Main Paper (big Paper) Quantity
		$('#almost').text('~' + ' ' + calcReturnValues.MainPaperAlmostQ); // iNSERt almost paper quantity
		$('#fullweight-last').val(calcReturnValues.FullWeight); // iNSERt Full Weight
		$('#fullprice').val(calcReturnValues.FullPrice); // iNSERt Full Price
		$('#printime-last').val(calcReturnValues.FullPrintTimePrice); // iNSERt Print Time Fee
		$('#pricewithoutfee').val(calcReturnValues.PriceWithoutFee); // iNSERt Full Price without Fee
		$('#insidea3q-last').val(calcReturnValues.InAQ); //iNSERt Inside A3 quantity
		$('#covera3q-last').val(calcReturnValues.CovAQ); //iNSERt Cover A3 quantity
		$('#foldprice-last').val(calcReturnValues.FoldPrice); //iNSERt Folding Price
		$('#kindzva-last').val(calcReturnValues.StitchPrice); //iNSERt Stitching Price
		$('#afterinpagesweight-last').val(calcReturnValues.InPagesWeight);
		$('#aftercovweight-last').val(calcReturnValues.CovPagesWeight);
		$('#inpagesprintprice-last').val(calcReturnValues.InPagesFormPrice);
		$('#covprintprice-last').val(calcReturnValues.CovFormPrice);
		$('#inpagesprinttime-last').val(calcReturnValues.InPagesPrintTime);
		$('#covprinttime-last').val(calcReturnValues.CovPrintTime);
		$('#formatcutprice-last').val(0);
}