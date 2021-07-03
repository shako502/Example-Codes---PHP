// JavaScript Document

$(document).ready(function(){
	"use strict";
	$('.savename-row').hide();
	
	
	$('.save-calc-pre').click(function(){
		$('.savename-row').show(300);
	});
	$('.make-offer').click(function(){
		$('.savename-row').show(300);
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
		var papersizechoice = $('#papersizechoice').val();
		var cover = $('#cover').val();
		var coverpaperweight = $('#coverpaperweight').val();
		var paperprice = $('#paperprice').val();
		var folding = $('#folding').val();
		var stitch = $('#stitch').val();
		var formatcut = $('#formatcut').val();
		var otherfees = $('#otherfees').val();
		var feepercent = $('#feepercent').val();
		
	
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
			switch(mainpapersize) {
				case '5760' : 
					mainpapernames = '50 X 70';
					break;
				case '7000' :
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
		
	
	
		// iNSERt UNCHANGED vAriables iNTo ModAl
		$('#tirage-last').val(tirage);           							// ტირაჟი
		$('#paperweight-last').val(insidepaperweight); 						// ქაღალდის წონა
		$('#insidepages-last').val(insidepages); 							// შიგთავსის გვ. რაოდენობა
		$('#printform-last').val(printformnames);     						// საბეჭდი ფორმა
		$('#printformcover-last').val(printformcovernames);     			// საბეჭდი ფორმა ყდა
		$('.mainpapername').text(mainpapernames + ' რაოდენობა');           // ძირითადი ქაღალდის ზომა
		$('#papersizechoice-last').val(papersizechoiceup);      			// საბოლოო ქაღალდის ზომა
		$('#cover-last').val(cover);                       					// ყდა
		$('#paperprice-last').val(paperprice);                  			// ქაღალდის ფასი
		$('#folding-last').val(folding);                     				// კეცვა
		$('#stitch-last').val(stitchtogeo);                     			// აკინძვა
		$('#formatcut-last').val(formatcutfix);                 			// ფორმატზე დაჭრა
		$('#otherfees-last').val(otherfees);                   				// სხვა ხარჯები
		$('#stitchtobase').val(stitch);
		
		// Parse Ints
		var parmainpapersize = parseInt(mainpapersize);
		var parpaperweight = parseInt(insidepaperweight);
		var parpaperprice = parseFloat(paperprice);
		var parprintform = parseInt(printform);
		var parprintcoverform = parseInt(printformcover);
		if( isNaN( $('#printformcover').val() ) ){
			parprintcoverform = 0;
		}
		var parfolding = parseInt(folding);
		var parotherfees = parseFloat(otherfees);
		var parinsidepages = parseInt(insidepages);
		var partirage = parseInt(tirage);
		var parcoverpaperweight = parseInt(coverpaperweight);
		var parcover = parseInt(cover);
		var parfeepercent = parseInt(feepercent);
		
		
	
		// Calculate inside pages a3 quantity
		var percent = parseInt($('#pluspercent').val());
		var percentcalculation;
		var insidea3quantity;
		var insidepagesq;
		var insidea3qwper; // Full A3 INSIDE PAGES QUANTITY
		
	
		switch(papersizechoice) {
			case 'a2':
				insidepagesq = parinsidepages / 2;
				insidea3quantity = ( (parinsidepages / 2 ) * partirage );
				percentcalculation = Math.ceil(insidea3quantity * percent / 100);
				insidea3qwper = insidea3quantity + percentcalculation;
				break;
			case 'a3':
				insidepagesq = parinsidepages / 4;
				insidea3quantity = ( (parinsidepages / 4 ) * partirage );
				percentcalculation = Math.ceil(insidea3quantity * percent / 100);
				insidea3qwper = insidea3quantity + percentcalculation;
				break;
			case 'a4':
				insidepagesq = parinsidepages / 8;
				insidea3quantity = ( (parinsidepages / 8 ) * partirage );
				percentcalculation = Math.ceil(insidea3quantity * percent / 100);
				insidea3qwper = insidea3quantity + percentcalculation;
				break;
			case 'a5':
				insidepagesq = parinsidepages / 16;
				insidea3quantity = ( (parinsidepages / 16 ) * partirage );
				percentcalculation = Math.ceil(insidea3quantity * percent / 100);
				insidea3qwper = insidea3quantity + percentcalculation;
				break;
			case 'a6':
				insidepagesq = parinsidepages / 12;
				insidea3quantity = Math.ceil( (parinsidepages / 12 ) * partirage );
				percentcalculation = Math.ceil(insidea3quantity * percent / 100);
				insidea3qwper = insidea3quantity + percentcalculation;
				break;
			default: 
				alert('ამოირჩიეთ ქაღალდის საბოლოო ზომა!');
							  }
		var insidepagesmainpaper = insidea3qwper / 2; //მთავარი ქაღალდის ზომა შიგ. გვერდების
	
		//Calculate Inside Pages weight
		var insidefullweight = (parmainpapersize * parpaperweight / 10000000 ) * insidepagesmainpaper;
		var rinsfulw = Math.round(insidefullweight * 100) / 100;
	
		//calculate cover a3 quantity
		var covera3quantity;
		var covera3qwper;
		var fullcovera3q; // FULL A3 COVER QUANTITY
		if(parcover === 4 ) {
			switch(papersizechoice) {
				case 'a3':
					covera3quantity = partirage;
					covera3qwper = Math.ceil(covera3quantity * percent / 100);
					fullcovera3q = covera3quantity + covera3qwper;
					break;
				case 'a4':
					covera3quantity = partirage / 2;
					covera3qwper = Math.ceil(covera3quantity * percent / 100);
					fullcovera3q = covera3quantity + covera3qwper;
					break;
				case 'a5':
					covera3quantity = partirage / 4;
					covera3qwper = Math.ceil(covera3quantity * percent / 100);
					fullcovera3q = covera3quantity + covera3qwper;
					break;
				case 'a6':
					covera3quantity = Math.ceil(partirage / 3);
					covera3qwper = Math.ceil(covera3quantity * percent / 100);
					fullcovera3q = covera3quantity + covera3qwper;
					break;
				default:
					alert('ამოირჩიეთ ქაღალდის საბოლოო ზომა!');
								  }
		}
		else {
			fullcovera3q = 0;
		}
		var covermainpaper = fullcovera3q / 2; //მთავარი ქაღალდის ზომა ყდის
	
		//calculate cover full weight
		var coverfullweight, rcoverfullweight;
		if(parcover === 4 && parcoverpaperweight){
			coverfullweight = (parmainpapersize * parcoverpaperweight / 10000000 ) * covermainpaper;
			rcoverfullweight = Math.round(coverfullweight * 100) / 100;
		}
		else {
			rcoverfullweight = 0;
		}
		
		
	
		//Calculate Full a3 quantity
		var lasta3quantity = insidea3qwper + fullcovera3q; //A3 რაოდენობა
	
		//Calculate Full a3 weight
		var lasta3weight = Math.ceil(rinsfulw + rcoverfullweight); //A3 წონა
	
		
		// Calculate Main Paper Quantity
		var parmainpaperq = lasta3quantity / 2;
		var mainpaperquantity = Math.ceil(parmainpaperq);	
	

	
	
	
		/* ------------- Calculate Full Price ----------------- */
		

	
		//Calculate Printing Time - New
	
		//New Shit
	
		//calculate inside pages print time
		var printimeprice, inpagesfortime, oneprinthour, oneprinthprice;
		if(printformdata === 'tt' || printformdata === 'oo' || printformdata === 'ff' ) { //Get Print Forms @ff = 4/4; @tt = 2/2; @oo = 1/1
			inpagesfortime = insidea3qwper * 2;
		}
		else {
			inpagesfortime = insidea3qwper * 1;
		}
		//console.log('inpagesfortime - ' + inpagesfortime);
		
		oneprinthour = Math.ceil(inpagesfortime / 7000); //One Hour of Printing Inside Pages
	
		//console.log('oneprinthour - ' + oneprinthour );
		
		
		if(oneprinthour > 1) {
			oneprinthprice = 90;
		}
		else {
			oneprinthprice = 80;
		}
		//console.log('oneprinthprice - ' + oneprinthprice );
		printimeprice = oneprinthour * oneprinthprice; //Calc PRINTING TIME PRICE
		//console.log('printimeprice - ' + printimeprice);
	
	/* ===== Calculate Cover A3 Print Time ==== */
	var printimepricecover, inpagesfortimecover, oneprinthourcover, oneprinthpricecover;
		if(printformcoverdata === 'tt' || printformcoverdata === 'oo' || printformcoverdata === 'ff' ) { //Get Print Forms @ff = 4/4; @tt = 2/2; @oo = 1/1
			inpagesfortimecover = fullcovera3q * 2;
		}
		else {
			inpagesfortimecover = fullcovera3q * 1;
		}
		
		oneprinthourcover = Math.ceil(inpagesfortimecover / 7000); //One Hour of Printing Inside Pages
	
		if(oneprinthourcover > 1 ){
			oneprinthpricecover = 90;
		}
		else{
			oneprinthpricecover = 80;
		}
		printimepricecover = oneprinthourcover * oneprinthpricecover; //Calc PRINTING TIME PRICE
		
	
		//Calculate Folding 
		var foldingprice = 0;
		if(parfolding !== 0 ) {
			foldingprice = partirage * 0.02;
		}
		else {
			foldingprice = 0;
		}
	
	
		//Calculate stitching
		var stitchingprice = 0;
		if(stitch === 'thermal') {
			stitchingprice = partirage * 0.07;
		}
		else if (stitch === 'stapler') {
			stitchingprice = partirage * 0.04;
		}
		else {
			stitchingprice = 0;
		}
		
		//Calculate Print Forms
		var printformlast = parprintform * insidepagesq + 40;
	
	
		//Calculate Price from full weight
		var kgtoprice = lasta3weight * parpaperprice; 
		var fullpricealmost = kgtoprice + printformlast + printimeprice + printimepricecover + foldingprice + stitchingprice + parotherfees;
		var fullprice = Math.ceil(fullpricealmost);
	
		//calculate price with fee
		var feepercentcalc = Math.round( ( (fullprice * parfeepercent) / 100 ) * 100) / 100;
		var feefullpercent = fullprice + feepercentcalc;
	
	
		// iNSERt Changed Variables
		$('#a3quantity').val(lasta3quantity); // iNSERt A3 paper quantity
		$('#mainpaperquantity-last').val(mainpaperquantity); //iNSERt Main Paper (big Paper) Quantity
		$('#almost').text('~' + ' ' + parmainpaperq); // iNSERt almost paper quantity
		$('#fullweight-last').val(lasta3weight); // iNSERt Full Weight
		$('#fullprice').val(feefullpercent); // iNSERt Full Price
		$('#printime-last').val(printimeprice + printimepricecover); // iNSERt Print Time Fee
		$('#pricewithoutfee').val(fullprice); // iNSERt Full Price without Fee
		$('#insidea3q-last').val(insidea3qwper); //iNSERt Inside A3 quantity
		$('#covera3q-last').val(fullcovera3q); //iNSERt Cover A3 quantity
		$('#foldprice-last').val(foldingprice); //iNSERt Folding Price
		$('#kindzva-last').val(stitchingprice); //iNSERt Stitching Price
	
	
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
			switch(mainpapersize) {
				case '5760' : 
					mainpapernames = '50 X 70';
					break;
				case '7000' :
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
		
	
	
		// iNSERt UNCHANGED vAriables iNTo ModAl
		$('#tirage-last').val(tirage);           							// ტირაჟი
		$('#paperweight-last').val(insidepaperweight); 						// ქაღალდის წონა
		$('#insidepages-last').val(insidepages); 							// შიგთავსის გვ. რაოდენობა
		$('#printform-last').val(printformnames);     						// საბეჭდი ფორმა
		$('#printformcover-last').val(printformcovernames);     			// საბეჭდი ფორმა ყდა
		$('.mainpapername').text(mainpapernames + ' რაოდენობა');           // ძირითადი ქაღალდის ზომა
		$('#papersizechoice-last').val(papersizechoiceup);      			// საბოლოო ქაღალდის ზომა
		$('#cover-last').val(cover);                       					// ყდა
		$('#paperprice-last').val(paperprice);                  			// ქაღალდის ფასი
		$('#folding-last').val(folding);                     				// კეცვა
		$('#stitch-last').val(stitchtogeo);                     			// აკინძვა
		$('#formatcut-last').val(formatcutfix);                 			// ფორმატზე დაჭრა
		$('#otherfees-last').val(otherfees);                   				// სხვა ხარჯები
		$('#stitchtobase').val(stitch);
		
		// Parse Ints
		var parmainpapersize = parseInt(mainpapersize);
		var parpaperweight = parseInt(insidepaperweight);
		var parpaperprice = parseFloat(paperprice);
		var parprintform = parseInt(printform);
		var parprintcoverform = parseInt(printformcover);
		if( isNaN( $('#printformcover').val() ) ){
			parprintcoverform = 0;
		}
		var parfolding = parseInt(folding);
		var parotherfees = parseFloat(otherfees);
		var parinsidepages = parseInt(insidepages);
		var partirage = parseInt(tirage);
		var parcoverpaperweight = parseInt(coverpaperweight);
		var parcover = parseInt(cover);
		var parfeepercent = parseInt(feepercent);
		
		
	
		// Calculate inside pages a3 quantity
		var percent = parseInt($('#pluspercent' + numbercount).val());
		var percentcalculation;
		var insidea3quantity;
		var insidepagesq;
		var insidea3qwper; // Full A3 INSIDE PAGES QUANTITY
		
	
		switch(papersizechoice) {
			case 'a2':
				insidepagesq = parinsidepages / 2;
				insidea3quantity = ( (parinsidepages / 2 ) * partirage );
				percentcalculation = Math.ceil(insidea3quantity * percent / 100);
				insidea3qwper = insidea3quantity + percentcalculation;
				break;
			case 'a3':
				insidepagesq = parinsidepages / 4;
				insidea3quantity = ( (parinsidepages / 4 ) * partirage );
				percentcalculation = Math.ceil(insidea3quantity * percent / 100);
				insidea3qwper = insidea3quantity + percentcalculation;
				break;
			case 'a4':
				insidepagesq = parinsidepages / 8;
				insidea3quantity = ( (parinsidepages / 8 ) * partirage );
				percentcalculation = Math.ceil(insidea3quantity * percent / 100);
				insidea3qwper = insidea3quantity + percentcalculation;
				break;
			case 'a5':
				insidepagesq = parinsidepages / 16;
				insidea3quantity = ( (parinsidepages / 16 ) * partirage );
				percentcalculation = Math.ceil(insidea3quantity * percent / 100);
				insidea3qwper = insidea3quantity + percentcalculation;
				break;
			case 'a6':
				insidepagesq = parinsidepages / 12;
				insidea3quantity = Math.ceil( (parinsidepages / 12 ) * partirage );
				percentcalculation = Math.ceil(insidea3quantity * percent / 100);
				insidea3qwper = insidea3quantity + percentcalculation;
				break;
			default: 
				alert('ამოირჩიეთ ქაღალდის საბოლოო ზომა!');
							  }
		var insidepagesmainpaper = insidea3qwper / 2; //მთავარი ქაღალდის ზომა შიგ. გვერდების
	
		//Calculate Inside Pages weight
		var insidefullweight = (parmainpapersize * parpaperweight / 10000000 ) * insidepagesmainpaper;
		var rinsfulw = Math.round(insidefullweight * 100) / 100;
	
		//calculate cover a3 quantity
		var covera3quantity;
		var covera3qwper;
		var fullcovera3q; // FULL A3 COVER QUANTITY
		if(parcover === 4 ) {
			switch(papersizechoice) {
				case 'a3':
					covera3quantity = partirage;
					covera3qwper = Math.ceil(covera3quantity * percent / 100);
					fullcovera3q = covera3quantity + covera3qwper;
					break;
				case 'a4':
					covera3quantity = partirage / 2;
					covera3qwper = Math.ceil(covera3quantity * percent / 100);
					fullcovera3q = covera3quantity + covera3qwper;
					break;
				case 'a5':
					covera3quantity = partirage / 4;
					covera3qwper = Math.ceil(covera3quantity * percent / 100);
					fullcovera3q = covera3quantity + covera3qwper;
					break;
				case 'a6':
					covera3quantity = Math.ceil(partirage / 3);
					covera3qwper = Math.ceil(covera3quantity * percent / 100);
					fullcovera3q = covera3quantity + covera3qwper;
					break;
				default:
					alert('ამოირჩიეთ ქაღალდის საბოლოო ზომა!');
								  }
		}
		else {
			fullcovera3q = 0;
		}
		var covermainpaper = fullcovera3q / 2; //მთავარი ქაღალდის ზომა ყდის
	
		//calculate cover full weight
		var coverfullweight, rcoverfullweight;
		if(parcover === 4 && parcoverpaperweight){
			coverfullweight = (parmainpapersize * parcoverpaperweight / 10000000 ) * covermainpaper;
			rcoverfullweight = Math.round(coverfullweight * 100) / 100;
		}
		else {
			rcoverfullweight = 0;
		}
		
		
	
		//Calculate Full a3 quantity
		var lasta3quantity = insidea3qwper + fullcovera3q; //A3 რაოდენობა
	
		//Calculate Full a3 weight
		var lasta3weight = Math.ceil(rinsfulw + rcoverfullweight); //A3 წონა
	
		
		// Calculate Main Paper Quantity
		var parmainpaperq = lasta3quantity / 2;
		var mainpaperquantity = Math.ceil(parmainpaperq);	
	

	
	
	
		/* ------------- Calculate Full Price ----------------- */
		

	
			//Calculate Printing Time - New
	
		//New Shit
	
		//calculate inside pages print time
		var printimeprice, inpagesfortime, oneprinthour, oneprinthprice;
		if(printformdata === 'tt' || printformdata === 'oo' || printformdata === 'ff' ) { //Get Print Forms @ff = 4/4; @tt = 2/2; @oo = 1/1
			inpagesfortime = insidea3qwper * 2;
		}
		else {
			inpagesfortime = insidea3qwper * 1;
		}
		//console.log('inpagesfortime - ' + inpagesfortime);
		
		oneprinthour = Math.ceil(inpagesfortime / 7000); //One Hour of Printing Inside Pages
	
		//console.log('oneprinthour - ' + oneprinthour );
		
		
		if(oneprinthour > 1) {
			oneprinthprice = 90;
		}
		else {
			oneprinthprice = 80;
		}
		//console.log('oneprinthprice - ' + oneprinthprice );
		printimeprice = oneprinthour * oneprinthprice; //Calc PRINTING TIME PRICE
		//console.log('printimeprice - ' + printimeprice);
	
	/* ===== Calculate Cover A3 Print Time ==== */
	var printimepricecover, inpagesfortimecover, oneprinthourcover, oneprinthpricecover;
		if(printformcoverdata === 'tt' || printformcoverdata === 'oo' || printformcoverdata === 'ff' ) { //Get Print Forms @ff = 4/4; @tt = 2/2; @oo = 1/1
			inpagesfortimecover = fullcovera3q * 2;
		}
		else {
			inpagesfortimecover = fullcovera3q * 1;
		}
		
		oneprinthourcover = Math.ceil(inpagesfortimecover / 7000); //One Hour of Printing Inside Pages
	
		if(oneprinthourcover > 1 ){
			oneprinthpricecover = 90;
		}
		else{
			oneprinthpricecover = 80;
		}
		printimepricecover = oneprinthourcover * oneprinthpricecover; //Calc PRINTING TIME PRICE
		
	
		//Calculate Folding 
		var foldingprice = 0;
		if(parfolding !== 0 ) {
			foldingprice = partirage * 0.02;
		}
		else {
			foldingprice = 0;
		}
	
	
		//Calculate stitching
		var stitchingprice = 0;
		if(stitch === 'thermal') {
			stitchingprice = partirage * 0.07;
		}
		else if (stitch === 'stapler') {
			stitchingprice = partirage * 0.04;
		}
		else {
			stitchingprice = 0;
		}
		
		//Calculate Print Forms
		var printformlast = parprintform * insidepagesq + 40;
	
	
		//Calculate Price from full weight
		var kgtoprice = lasta3weight * parpaperprice; 
		var fullpricealmost = kgtoprice + printformlast + printimeprice + printimepricecover + foldingprice + stitchingprice + parotherfees;
		var fullprice = Math.ceil(fullpricealmost);
	
		//calculate price with fee
		var feepercentcalc = Math.round( ( (fullprice * parfeepercent) / 100 ) * 100) / 100;
		var feefullpercent = fullprice + feepercentcalc;
	
	
		// iNSERt Changed Variables
		$('#a3quantity').val(lasta3quantity); // iNSERt A3 paper quantity
		$('#mainpaperquantity-last').val(mainpaperquantity); //iNSERt Main Paper (big Paper) Quantity
		$('#almost').text('~' + ' ' + parmainpaperq); // iNSERt almost paper quantity
		$('#fullweight-last').val(lasta3weight); // iNSERt Full Weight
		$('#fullprice').val(feefullpercent); // iNSERt Full Price
		$('#printime-last').val(printimeprice + printimepricecover); // iNSERt Print Time Fee
		$('#pricewithoutfee').val(fullprice); // iNSERt Full Price without Fee
		$('#insidea3q-last').val(insidea3qwper); //iNSERt Inside A3 quantity
		$('#covera3q-last').val(fullcovera3q); //iNSERt Cover A3 quantity
		$('#foldprice-last').val(foldingprice); //iNSERt Folding Price
		$('#kindzva-last').val(stitchingprice); //iNSERt Stitching Price
}