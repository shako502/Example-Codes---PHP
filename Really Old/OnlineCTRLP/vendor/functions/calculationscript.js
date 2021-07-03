function CalculateIt(gotValues){
	"use strict";
		
		//Get Values
		var tirage = gotValues.getTirage;
		var insidepaperweight = gotValues.getInPaperWeight;
		var insidepages = gotValues.getInPages;
		var printform = gotValues.getPrintForm;
		var printformcover = gotValues.getPrintFormCover;
		var mainpapersize = gotValues.getMainPaperSize;
		var papersizechoice =gotValues.getMainFormat;
		var cover = gotValues.getCoverPages;
		var coverpaperweight = gotValues.getCoverPagesWeight;
		var paperprice = gotValues.getPaperPrice;
		var folding = gotValues.getFolding;
		var stitch = gotValues.getStitch;
		var otherfees = gotValues.getOtherFees;
		var feepercent = gotValues.getFeePercet;
		var printformdata = gotValues.getPrintFormData;
		var printformcoverdata = gotValues.getPrintFormCoverData;
		var otherformatinput = gotValues.getOtherFormatInput;
		
		
		
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
		var parotherformat = parseInt(otherformatinput);
		
		
	
		// Calculate inside pages a3 quantity
		var percent = parseInt($('#pluspercent').val());
		var percentcalculation;
		var insidea3quantity;
		var insidepagesq;
		var insidea3qwper; // Full A3 INSIDE PAGES QUANTITY
		
	
		switch(papersizechoice) {
			case 'a3':
				insidepagesq = parinsidepages / 2;
				insidea3quantity = ( (parinsidepages / 2 ) * partirage );
				percentcalculation = Math.ceil(insidea3quantity * percent / 100);
				insidea3qwper = insidea3quantity + percentcalculation;
				break;
			case 'a4':
				insidepagesq = parinsidepages / 4;
				insidea3quantity = ( (parinsidepages / 4 ) * partirage );
				percentcalculation = Math.ceil(insidea3quantity * percent / 100);
				insidea3qwper = insidea3quantity + percentcalculation;
				break;
			case 'a5':
				insidepagesq = parinsidepages / 8;
				insidea3quantity = ( (parinsidepages / 8 ) * partirage );
				percentcalculation = Math.ceil(insidea3quantity * percent / 100);
				insidea3qwper = insidea3quantity + percentcalculation;
				break;
			case 'a6':
				insidepagesq = parinsidepages / 16;
				insidea3quantity = ( (parinsidepages / 16 ) * partirage );
				percentcalculation = Math.ceil(insidea3quantity * percent / 100);
				insidea3qwper = insidea3quantity + percentcalculation;
				break;
			case '10x21':
				insidepagesq = parinsidepages / 12;
				insidea3quantity = Math.ceil( (parinsidepages / 12 ) * partirage );
				percentcalculation = Math.ceil(insidea3quantity * percent / 100);
				insidea3qwper = insidea3quantity + percentcalculation;
				break;
			case 'other':
				insidepagesq = parinsidepages / parotherformat;
				insidea3quantity = ( (parinsidepages / parotherformat ) * partirage );
				percentcalculation = Math.ceil(insidea3quantity * percent / 100);
				insidea3qwper = insidea3quantity + percentcalculation;
				break;
			}
		var insidepagesmainpaper = insidea3qwper / 4; //მთავარი ქაღალდის ზომა შიგ. გვერდების
	
		//Calculate Inside Pages weight
		var insidefullweight = (parmainpapersize * parpaperweight / 10000000 ) * insidepagesmainpaper;
		var rinsfulw = Math.round(insidefullweight * 100) / 100;
	
		//calculate cover a3 quantity
		var covera3quantity;
		var covera3qwper;
		var fullcovera3q; // FULL A3 COVER QUANTITY
		if(parcover === 4 ) {
			switch(papersizechoice) {
				case 'a4':
					covera3quantity = partirage;
					covera3qwper = Math.ceil(covera3quantity * percent / 100);
					fullcovera3q = covera3quantity + covera3qwper;
					break;
				case 'a5':
					covera3quantity = partirage / 2;
					covera3qwper = Math.ceil(covera3quantity * percent / 100);
					fullcovera3q = covera3quantity + covera3qwper;
					break;
				case 'a6':
					covera3quantity = partirage / 4;
					covera3qwper = Math.ceil(covera3quantity * percent / 100);
					fullcovera3q = covera3quantity + covera3qwper;
					break;
				case '10x21':
					covera3quantity = Math.ceil(partirage / 3);
					covera3qwper = Math.ceil(covera3quantity * percent / 100);
					fullcovera3q = covera3quantity + covera3qwper;
					break;
				}
		}
		else {
			fullcovera3q = 0;
		}
		var covermainpaper = fullcovera3q / 4; //მთავარი ქაღალდის ზომა ყდის
	
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
		var parmainpaperq = lasta3quantity / 4;
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
		
		oneprinthour = Math.ceil(inpagesfortime / 3000); //One Hour of Printing Inside Pages
	
		//console.log('oneprinthour - ' + oneprinthour );
		
		switch(printformdata){ // ONE HOUR PRICE FOR DIFFERENT FORMS
			case 'tt' : 
				oneprinthprice = 60;
				break;
			case 'ff':
				oneprinthprice = 70;
				break;
			case 'oo' :
				oneprinthprice = 50;
				break;
			default:
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
		
		oneprinthourcover = Math.ceil(inpagesfortimecover / 3000); //One Hour of Printing Inside Pages
	
		switch(printformcoverdata){ // ONE HOUR PRICE FOR DIFFERENT FORMS
			case 'tt' : 
				oneprinthpricecover = 60;
				break;
			case 'ff':
				oneprinthpricecover = 70;
				break;
			case 'oo' :
				oneprinthpricecover = 50;
				break;
			default:
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
	
		var fullprintformsprice = printimeprice + printimepricecover;
	
		var returnObject = {
			InAQ: insidea3qwper,
			CovAQ: fullcovera3q,
			AQuantity: lasta3quantity,
			MainPaperQ: mainpaperquantity,
			MainPaperAlmostQ: parmainpaperq,
			FoldPrice: foldingprice,
			StitchPrice: stitchingprice,
			FullWeight: lasta3weight,
			FullPrice: feefullpercent,
			PriceWithoutFee: fullprice,
			FullPrintTimePrice: fullprintformsprice,
			InPagesWeight: rinsfulw,
			CovPagesWeight: rcoverfullweight,
			InPagesFormPrice: printimeprice,
			CovFormPrice: printimepricecover,
			InPagesPrintTime: oneprinthour,
			CovPrintTime: oneprinthourcover
			
		};
	
		return returnObject;
	
		// iNSERt Changed Variables
		//$('#a3quantity').val(lasta3quantity); // iNSERt A3 paper quantity
		//$('#mainpaperquantity-last').val(mainpaperquantity); //iNSERt Main Paper (big Paper) Quantity
		//$('#almost').text('~' + ' ' + parmainpaperq); // iNSERt almost paper quantity
		//$('#fullweight-last').val(lasta3weight); // iNSERt Full Weight
		//$('#fullprice').val(feefullpercent); // iNSERt Full Price
		//$('#printime-last').val(printimeprice + printimepricecover); // iNSERt Print Time Fee
		//$('#pricewithoutfee').val(fullprice); // iNSERt Full Price without Fee
		//$('#insidea3q-last').val(insidea3qwper); //iNSERt Inside A3 quantity
		//$('#covera3q-last').val(fullcovera3q); //iNSERt Cover A3 quantity
		//$('#foldprice-last').val(foldingprice); //iNSERt Folding Price
		//$('#kindzva-last').val(stitchingprice); //iNSERt Stitching Price
	
}


function CalculateItA2(gotValues){
	"use strict";
		
		//Get Values
		var tirage = gotValues.getTirage;
		var insidepaperweight = gotValues.getInPaperWeight;
		var insidepages = gotValues.getInPages;
		var printform = gotValues.getPrintForm;
		var printformcover = gotValues.getPrintFormCover;
		var mainpapersize = gotValues.getMainPaperSize;
		var papersizechoice =gotValues.getMainFormat;
		var cover = gotValues.getCoverPages;
		var coverpaperweight = gotValues.getCoverPagesWeight;
		var paperprice = gotValues.getPaperPrice;
		var folding = gotValues.getFolding;
		var stitch = gotValues.getStitch;
		var otherfees = gotValues.getOtherFees;
		var feepercent = gotValues.getFeePercet;
		var printformdata = gotValues.getPrintFormData;
		var printformcoverdata = gotValues.getPrintFormCoverData;
		var otherformatinput = gotValues.getOtherFormatInput;
		
		
		
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
		var parotherformat = parseInt(otherformatinput);
		
		
	
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
				insidepagesq = parinsidepages / 32;
				insidea3quantity = Math.ceil( (parinsidepages / 32 ) * partirage );
				percentcalculation = Math.ceil(insidea3quantity * percent / 100);
				insidea3qwper = insidea3quantity + percentcalculation;
				break;
			case '10x21':
				insidepagesq = parinsidepages / 64;
				insidea3quantity = Math.ceil( (parinsidepages / 64 ) * partirage );
				percentcalculation = Math.ceil(insidea3quantity * percent / 100);
				insidea3qwper = insidea3quantity + percentcalculation;
				break;
			case 'other':
				insidepagesq = parinsidepages / parotherformat;
				insidea3quantity = ( (parinsidepages / parotherformat ) * partirage );
				percentcalculation = Math.ceil(insidea3quantity * percent / 100);
				insidea3qwper = insidea3quantity + percentcalculation;
				break;
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
		printimepricecover = oneprinthourcover * oneprinthpricecover; 
		
	
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
	
		var fullprintformsprice = printimeprice + printimepricecover;
	
		var returnObject = {
			InAQ: insidea3qwper,
			CovAQ: fullcovera3q,
			AQuantity: lasta3quantity,
			MainPaperQ: mainpaperquantity,
			MainPaperAlmostQ: parmainpaperq,
			FoldPrice: foldingprice,
			StitchPrice: stitchingprice,
			FullWeight: lasta3weight,
			FullPrice: feefullpercent,
			PriceWithoutFee: fullprice,
			FullPrintTimePrice: fullprintformsprice,
			InPagesWeight: rinsfulw,
			CovPagesWeight: rcoverfullweight,
			InPagesFormPrice: printimeprice,
			CovFormPrice: printimepricecover,
			InPagesPrintTime: oneprinthour,
			CovPrintTime: oneprinthourcover
			
		};
	
		return returnObject;
}