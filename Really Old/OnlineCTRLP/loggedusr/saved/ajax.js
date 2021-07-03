$(document).ready(function(){
"use strict";
	$('.offerdownloadcontainer').hide();
	$('.makesavedoffered').hide();
	$('.makeofferorder').hide();
	
	
	   function getUrlVars(){
			var vars = [], hash;
			var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
			for(var i = 0; i < hashes.length; i++)
			{
				hash = hashes[i].split('=');
				vars.push(hash[0]);
				vars[hash[0]] = hash[1];
			}
			return vars;
		}
		
		var id = getUrlVars().orderid;
	   
     $.ajax({
		 url: '../../phpvendor/getproductinfo.php',
		 data: 'id=' + id,
		 dataType: 'json',
		 success: function(data){
			 $('.product-info-type').text(data[0].productname);
			 $('.product-info-tirage').text(data[0].tirage);
			 $('.product-info-mainpaperq').text(data[0].mainpaperquantity);
			 $('.product-info-inpapweight').text(data[0].paperweight);
			 $('.product-info-a3q').text(data[0].a3quantity);
			 $('.product-info-format').text(data[0].papersizechoice);
			 $('.product-info-insidepquantity').text(data[0].insidepages);
			 $('.product-info-cover').text(data[0].cover);
			 $('.product-info-printforms').text(data[0].printform);
			 $('.product-info-paperprice').text(data[0].paperprice);
			 $('.product-info-folding').text(data[0].folding);
			 $('.product-info-stitch').text(data[0].stitch);
			 $('.product-info-formatcut').text(data[0].formatcut);
			 $('.product-info-otherfees').text(data[0].otherfees);
			 $('.product-info-insidea3q').text(data[0].insidea3q);
			 $('.product-info-covera3q').text(data[0].covera3q);
			 $('.product-info-fullweight').text(data[0].fullweight);
			 $('.product-info-printimeprice').text(data[0].printimeprice);
			 $('.product-info-foldingprice').text(data[0].foldprice);
			 $('.product-info-stitchprice').text(data[0].stitchprice);
			 $('.product-info-pricewofee').text(data[0].pricewithoutfee);
			 $('.product-info-fullprice').text(data[0].fullprice);
			 $('.orderstatus').text(data[0].orderstatus);
			 
			 var filepath = data[0].filepath;
			 var filenameindex = filepath.lastIndexOf("/") + 1;
			 var filename = filepath.substr(filenameindex);
			 
			 if(filepath !== '0') {
				 $('.makeofferorder').show();
				 $('.offerdownloadcontainer').show();
				 $('.pdfdownloadlink').attr('href', filepath);
				 $('.pdfdownload').text(filename);
			 }
			 else if(filepath === '0') {
				 $('.makesavedoffered').show();
			 }
			 
		 }
	 
	 });
		   
	$.ajax({
		url: '../../phpvendor/getclientinfo.php',
		data: 'orderid=' + id,
		dataType: 'json',
		success: function(clientdata){
			$('.product-info-name').text('#' + id + ' | ' + clientdata[0].name );
			$('.company-name').text(clientdata[0].name);
			$('.company-address').text(clientdata[0].address);
			$('.company-contact').text(clientdata[0].contact);
			
		}
	});
	
	$.ajax({
		url: '../../phpvendor/getnotes.php',
		data: 'orderid=' + id,
		dataType: 'json',
		encode: true
	})
	.done(function(notesarray){
		if(!notesarray.message){
			$.each(notesarray, function(k, v){
				$('.notes-container').prepend('<div class="card notescard">'+
											 '<div class="card-header">'+
											 v.useradded +
											 '</div>'+
											 '<div class="card-body">'+
											 '<blockquote class="blockquote mb-0">'+
											 '<p>'+ v.maintext + '</p>'+
											 '<footer class="blockquote-footer">'+ v.date + '</footer>'+
											 '</blockquote>'+
											 '</div>'+
											 '</div>');
			});
		}
		else{
			$('.notes-container').append('<div class="alert alert-black">' + notesarray.message + '</div>');
		}
		});
	
	
	$('#notesforsaved').submit(function(event){
		$('.form-group').removeClass('has-error');
		$('.help-block').remove();
		
		var formdata = {
			'note' : $('#notes').val(),
			'orderid' : id
		};
		
		$.ajax({
			type: 'POST',
			url: '../../phpvendor/savenotes.php',
			data: formdata,
			dataType: 'json',
			encode : true
		})
		
		.done(function(maindata){
			if(!maindata.success) {
				if(maindata.errors.note) {
					$('.note-group').addClass('has-error');
					$('.note-group').append('<div class="help-block alert alert-danger">' + maindata.errors.note + '</div>');
				}
			} 
			else {
				$('#notesforsaved').append('<div class="alert alert-success">' + maindata.message + '</div>');
				
			}
			
			
		});
		
		
		event.preventDefault();
	});
		 
	
	$('.sendofferbtn').click(function(){
		$('.mailalertblock').remove();
		
		var maildata = {
			'destaddress': $('.sendoffermail').val(),
			'mailtext' : $('.sendoffertext').val(),
			'filelocation' : $('.pdfdownloadlink').attr('href'),
			'companyname' : $('.company-name').text(),
			'filename' : $('.pdfdownload').text()
		};
		
		
		$.ajax({
			type: 'POST',
			url: '../../phpvendor/sendoffermail.php',
			data: maildata,
			dataType: 'text'
		})
		
		.done(function(responsefmail){
			if(responsefmail === 'Success') {
				$('.sendoffermail').val('');
				$('.sendoffertext').val('');
				$('.sendoffermailcontainer').append('<div class="alert alert-success mailalertblock">შეთავაზება გაგზავნილია</div>');
			}
			else {
				$('.sendoffermailcontainer').append('<div class="alert alert-danger mailalertblock">შეთავაზება ვერ გაიგზავნა</div>');
			}
		});
		
	});
	
});