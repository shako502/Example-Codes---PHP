//Stacked Modals Fade Behind Function
	$(document).on('show.bs.modal', '.modal', function () {
		"use strict";
		var zIndex = 1040 + (10 * $('.modal:visible').length);
		$(this).css('z-index', zIndex);
		setTimeout(function() {
			$('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
		}, 0);
	});

$('.make-offer').click(function(){
	"use strict";
	
	var tiragelast = $('#tirage-last').val();
	var fullprice = $('#fullprice').val();
	
	$('#offer-tirage').val(tiragelast);
	$('#offer-fullprice').val(fullprice);
	
	$('#OfferDetailsModal').modal('show');
});


$('.make-offer-pdf').click(function(){
"use strict";
	//Get Values For PDF
	var Quantity = $('#offer-tirage').val();
	var ProductName = $('#offer-productname').val();
	var ReceiverName = $('#offer-receivername').val();
	var ReceiverSK = $('#offer-receiversk').val();
	var ReceiverAddress = $('#offer-receiveraddress').val();
	var Price = $('#offer-fullprice').val();
	var PriceVerb = $('#offer-fullpriceverb').val();
	var ReceiverEmail = $('#offer-email').val();
	
	
	var PostObj = {
		MainPost: {
			Quantity: Quantity,
			ProductName: ProductName,
			ReceiverName: ReceiverName,
			ReceiverSK: ReceiverSK,
			ReceiverAddress: ReceiverAddress,
			Price: Price,
			PriceVerb: PriceVerb,
			ReceiverEmail: ReceiverEmail
		}
	};
	
	
	$.ajax({
		url: '../../phpvendor/pdf/generateOffer.php',
		method: 'POST',
		data: PostObj,
		dataType: 'json',
		success: function(res){
			if(res.Code === 201){
				$('#ofSavePdfDown').attr('href', 'https://onlinectrlp.ge/Invoices/' + res.FileName );
				$('#ofSavePdfDown').attr('data-invoicenum' , res.InvoiceNum);
				$('#ofSavePdfDown').attr('data-filename' , res.FileName);
				$('#ofSaveSuccessCont').show(200);
			}
			else if(res.Code === 204 || res.Code === 444){
				console.log(res);
			}
			else{
				console.log(res);
				alert('გაუთვალისწინებელი შეცდომა! ნახეთ კონსოლი!');
			}
		}
	});
});

$('#ofSaveSuccessDelFile').click(function(){
	"use strict";
	
	var filename = $('#ofSavePdfDown').data('FileName');
	var datapost = {Filename: filename};
	$.ajax({
		url: '../../phpvendor/pdf/deleteFile.php',
		method: 'POST',
		data: datapost,
		dataType: 'text',
		success: function(delres){
			alert(delres);
		}
	});
});

$('#ofSaveSuccessDBsave').click(function(){
	
	"use strict";
	//Get Values For Database
	var Quantity = $('#tirage-last').val();
	var ProductName = $('#offer-productname').val();
	var ReceiverName = $('#offer-receivername').val();
	var ReceiverSK = $('#offer-receiversk').val();
	var ReceiverAddress = $('#offer-receiveraddress').val();
	var Price = $('#fullprice').val();
	var PriceVerb = $('#offer-fullpriceverb').val();
	var ReceiverEmail = $('#offer-email').val();
	var MainPaperSize = $('.mainpapername').val();
	var ProductFormat = $('#papersizechoice-last').val();
	var InPagesWeight = $('#inpaperweight-last').val();
	var InPagesQuantity = $('#insidepages-last').val();
	var InPagesForms = $('#printform-last').val();
	var CovPagesWeight = $('#covpaperweight-last').val();
	var CovPagesQuantity = $('#cover-last').val();
	var CovPagesForms = $('#printformcover-last').val();
	var PagesPercent = $('#pagespercent-last').val();
	var PaperPrice = $('#paperprice-last').val();
	var Folding = $('#folding-last').val();
	var Stitch = $('#stitch-last').val();
	var FormatCut = $('#formatcut-last').val(); // conv
	var OtherFee = $('#otherfees-last').val();
	var PricePercent = $('#pricepercent-last').val();
	var CalcComment = $('#otherfeescomm-last').val();
	var AfterMainPaperQ = $('#mainpaperquantity-last').val();
	var AfterAQuantity = $('#a3quantity').val();
	var AfterInPagesAQuantity = $('#insidea3q-last').val();
	var AfterCovAQuantity = $('#covera3q-last').val();
	var AfterFullWeight = $('#fullweight-last').val();
	var AfterCovWeight = $('#aftercovweight-last').val();
	var AfterInPagesWeight = $('#afterinpagesweight-last').val();
	var AfterFullFormPrice = $('#printime-last').val();
	var AfterInPagesPrintTime = $('#inpagesprinttime-last').val();
	var AfterCovFormPrice = $('#covprintprice-last').val();
	var AfterCovPrintTime = $('#covprinttime-last').val();
	var AfterInPagesFormPrice = $('#inpagesprintprice-last').val();
	var AfterFoldPrice = $('#folding-last').val();
	var AfterStitchPrice = $('#stitch-last').val();
	var AfterFormatCutPrice = $('#formatcutprice-last').val();
	var AfterFullPrice = $('#pricewithoutfee').val();
	var AfterFullPricePercent = $('#fullprice').val();
	var InvoiceNum = $('#ofSavePdfDown').attr('data-invoicenum');
	var User = $('.userCheckName').text();
	var FileName = $('#ofSavePdfDown').attr('data-filename');
	var Status = 'შენახული';
	
	var PostOBJ = {
		BasePost: {
			Quantity: Quantity,
			ProductName: ProductName,
			ReceiverName: ReceiverName,
			ReceiverSK: ReceiverSK,
			ReceiverAddress: ReceiverAddress,
			Price: Price,
			PriceVerb: PriceVerb,
			ReceiverEmail: ReceiverEmail,
			MainPaperSize: MainPaperSize,
			ProductFormat: ProductFormat,
			InPagesWeight: InPagesWeight,
			InPagesQuantity: InPagesQuantity,
			InPagesForms: InPagesForms,
			CovPagesWeight: CovPagesWeight,
			CovPagesQuantity: CovPagesQuantity,
			CovPagesForms: CovPagesForms,
			PagesPercent: PagesPercent,
			PaperPrice: PaperPrice,
			Folding: Folding,
			Stitch: Stitch,
			FormatCut: FormatCut,
			OtherFee: OtherFee,
			PricePercent: PricePercent,
			CalcComment: CalcComment,
			AfterMainPaperQ: AfterMainPaperQ,
			AfterAQuantity: AfterAQuantity,
			AfterInPagesAQuantity: AfterInPagesAQuantity,
			AfterCovAQuantity: AfterCovAQuantity,
			AfterFullWeight: AfterFullWeight,
			AfterCovWeight: AfterCovWeight,
			AfterInPagesWeight: AfterInPagesWeight,
			AfterFullFormPrice: AfterFullFormPrice,
			AfterCovFormPrice: AfterCovFormPrice,
			AfterCovPrintTime: AfterCovPrintTime,
			AfterInPagesFormPrice: AfterInPagesFormPrice,
			AfterInPagesPrintTime: AfterInPagesPrintTime,
			AfterFoldPrice: AfterFoldPrice,
			AfterStitchPrice: AfterStitchPrice,
			AfterFormatCutPrice: AfterFormatCutPrice,
			AfterFullPrice: AfterFullPrice,
			AfterFullPricePercent: AfterFullPricePercent,
			InvoiceNum: InvoiceNum,
			FileName: FileName,
			User: User,
			Status: Status
		}
	};
	
	$.ajax({
		url: '../../phpvendor/savetobase.php',
		method: 'POST',
		data: PostOBJ,
		dataType: 'json',
		success: function(res){
			alert(res.Message);
		}
	});
	
});


$('#ofSaveSuccessSend').click(function(){
	
	
	"use strict";
	//Get Values For Database
	var Quantity = $('#tirage-last').val();
	var ProductName = $('#offer-productname').val();
	var ReceiverName = $('#offer-receivername').val();
	var ReceiverSK = $('#offer-receiversk').val();
	var ReceiverAddress = $('#offer-receiveraddress').val();
	var Price = $('#offer-fullprice').val();
	var PriceVerb = $('#offer-fullpriceverb').val();
	var ReceiverEmail = $('#offer-email').val();
	var MainPaperSize = $('.mainpapername').val();
	var ProductFormat = $('#papersizechoice-last').val();
	var InPagesWeight = $('#inpaperweight-last').val();
	var InPagesQuantity = $('#insidepages-last').val();
	var InPagesForms = $('#printform-last').val();
	var CovPagesWeight = $('#covpaperweight-last').val();
	var CovPagesQuantity = $('#cover-last').val();
	var CovPagesForms = $('#printformcover-last').val();
	var PagesPercent = $('#pagespercent-last').val();
	var PaperPrice = $('#paperprice-last').val();
	var Folding = $('#folding-last').val();
	var Stitch = $('#stitch-last').val();
	var FormatCut = $('#formatcut-last').val(); // conv
	var OtherFee = $('#otherfees-last').val();
	var PricePercent = $('#pricepercent-last').val();
	var CalcComment = $('#otherfeescomm-last').val();
	var AfterMainPaperQ = $('#mainpaperquantity-last').val();
	var AfterAQuantity = $('#a3quantity').val();
	var AfterInPagesAQuantity = $('#insidea3q-last').val();
	var AfterCovAQuantity = $('#covera3q-last').val();
	var AfterFullWeight = $('#fullweight-last').val();
	var AfterCovWeight = $('#aftercovweight-last').val();
	var AfterInPagesWeight = $('#afterinpagesweight-last').val();
	var AfterFullFormPrice = $('#printime-last').val();
	var AfterInPagesPrintTime = $('#inpagesprinttime-last').val();
	var AfterCovFormPrice = $('#covprintprice-last').val();
	var AfterCovPrintTime = $('#covprinttime-last').val();
	var AfterInPagesFormPrice = $('#inpagesprintprice-last').val();
	var AfterFoldPrice = $('#folding-last').val();
	var AfterStitchPrice = $('#stitch-last').val();
	var AfterFormatCutPrice = $('#formatcutprice-last').val();
	var AfterFullPrice = $('#pricewithoutfee').val();
	var AfterFullPricePercent = $('#fullprice').val();
	var InvoiceNum = $('#ofSavePdfDown').attr('data-invoicenum');
	var User = $('.userCheckName').text();
	var FileName = $('#ofSavePdfDown').attr('data-filename');
	var Status = 'შენახული';
	
	var PostOBJ = {
		BasePost: {
			Quantity: Quantity,
			ProductName: ProductName,
			ReceiverName: ReceiverName,
			ReceiverSK: ReceiverSK,
			ReceiverAddress: ReceiverAddress,
			Price: Price,
			PriceVerb: PriceVerb,
			ReceiverEmail: ReceiverEmail,
			MainPaperSize: MainPaperSize,
			ProductFormat: ProductFormat,
			InPagesWeight: InPagesWeight,
			InPagesQuantity: InPagesQuantity,
			InPagesForms: InPagesForms,
			CovPagesWeight: CovPagesWeight,
			CovPagesQuantity: CovPagesQuantity,
			CovPagesForms: CovPagesForms,
			PagesPercent: PagesPercent,
			PaperPrice: PaperPrice,
			Folding: Folding,
			Stitch: Stitch,
			FormatCut: FormatCut,
			OtherFee: OtherFee,
			PricePercent: PricePercent,
			CalcComment: CalcComment,
			AfterMainPaperQ: AfterMainPaperQ,
			AfterAQuantity: AfterAQuantity,
			AfterInPagesAQuantity: AfterInPagesAQuantity,
			AfterCovAQuantity: AfterCovAQuantity,
			AfterFullWeight: AfterFullWeight,
			AfterCovWeight: AfterCovWeight,
			AfterInPagesWeight: AfterInPagesWeight,
			AfterFullFormPrice: AfterFullFormPrice,
			AfterCovFormPrice: AfterCovFormPrice,
			AfterCovPrintTime: AfterCovPrintTime,
			AfterInPagesFormPrice: AfterInPagesFormPrice,
			AfterInPagesPrintTime: AfterInPagesPrintTime,
			AfterFoldPrice: AfterFoldPrice,
			AfterStitchPrice: AfterStitchPrice,
			AfterFormatCutPrice: AfterFormatCutPrice,
			AfterFullPrice: AfterFullPrice,
			AfterFullPricePercent: AfterFullPricePercent,
			InvoiceNum: InvoiceNum,
			FileName: FileName,
			User: User,
			Status: Status
		}
	};
	
	var MainMail = $('#offer-email').val();
	var CopyMail = $('#offer-copymail').val();
	var MailText = $('#offer-mailtext').summernote('code');
	var OfferQuantity = $('#offer-tirage').val();
	
	var maildata = {
		Mail: {
			Status: 'შეთავაზებული',
			MainMail: MainMail,
			CopyMail: CopyMail,
			MailText: MailText,
			FileName: FileName,
			InvoiceNumber: InvoiceNum,
			ProductName: ProductName,
			ReceiverName: ReceiverName,
			ReceiverSK: ReceiverSK,
			ReceiverAddress: ReceiverAddress,
			PriceVerb: PriceVerb,
			OfferQuantity: OfferQuantity,
			OfferPrice: Price
		}
	};
	
	$.ajax({
		url: '../../phpvendor/savetobase.php',
		method: 'POST',
		data: PostOBJ,
		dataType: 'json',
		success: function(res){
			if(res.Code === 200){
				$.ajax({
					url: '../../phpvendor/sendoffermail.php',
					method: 'POST',
					data: maildata,
					dataType: 'json',
					success: function(mailres){
						alert(mailres.Message);
					}
				});
			}
			else {
				alert(res.Message);
			}
		}
	});
	
	
	
});
