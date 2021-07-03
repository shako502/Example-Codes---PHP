<?php 

include('../../phpvendor/includes/session.php');

?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CtrlP Administration</title>
    <!-- Bootstrap core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/simple-sidebar.css" rel="stylesheet">
    <link href="../../fonts/typicons.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.bootstrap4.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css"/>
	<link href="../../css/adminstyle.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <?php include('../../phpvendor/menutemplate.php');?>
        
        <!-- Page Content -->
        <div id="page-content-wrapper">
           		<!--Navigation -->
				<?php include('../../phpvendor/headmenutempl.php'); ?>
				
			<div class="container-fluid">
				<div class="row" style="margin-top: 20px;">
					<div class="col-lg-12">
						<h1 align="center" class="product-info-name"></h1>
						<div class="row" style="margin-bottom: 0;">
						<div class="col-lg-12">
							<div style="position: absolute; bottom: 20px;"><span>სტატუსი: </span>
							<span class="orderstatus badge badge-success"></span>
							</div>
							<span class="typcn typcn-times-outline gobacktosaved float-right"></span>
						</div>
						</div>
					</div>
				</div>
           		<div class="row">
           			<div class="col-lg-8">
           			<div class="jumbotron jumbotron-fluid">
           			<div class="container">
           				<div class="row">
           					<div class="col-lg-12">
           						<h5 align="center" class="display-4">პროდუქტის ინფორმაცია</h5>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">პროდუქტის დასახელება</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-type"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">ტირაჟი</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-tirage"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-12">
								<span class="product-info-divider"></span>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">ძირითადი ქაღალდის რაოდენობა</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-mainpaperq"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">შიგთავსის ქაღალდის გრამაჟი</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-inpapweight"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-12">
								<span class="product-info-divider"></span>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">A3 რაოდენობა</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-a3q"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">ფორმატი</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-format"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-12">
								<span class="product-info-divider"></span>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">შიგთავსის გვერდების რაოდენობა</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-insidepquantity"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">ყდა</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-cover"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-12">
								<span class="product-info-divider"></span>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">საბეჭდი ფორმები</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-printforms"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">ქაღალდის ფასი</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-paperprice"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-12">
								<span class="product-info-divider"></span>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">კეცვა</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-folding"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">კინძვა</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-stitch"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-12">
								<span class="product-info-divider"></span>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">ფორმატზე დაჭრა</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-formatcut"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">სხვა ხარჯები</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-otherfees"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-12">
								<span class="product-info-divider"></span>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">შიგთ. საჭირო A3 რაოდენობა</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-insidea3q"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">ყდისთვის საჭირო A3 რაოდენობა</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-covera3q"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-12">
								<span class="product-info-divider"></span>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">სრული წონა</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-fullweight"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">ბეჭდვის დროის ფასი</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-printimeprice"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-12">
								<span class="product-info-divider"></span>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">კეცვის ფასი</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-foldingprice"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">კინძვის ფასი</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-stitchprice"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-12">
								<span class="product-info-divider"></span>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">ფასი მოგების გარეშე</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-pricewofee"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-6 text-center">
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="text-info">ფასი( +მოგება )</span>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col-lg-12">
           								<span class="product-info-text product-info-fullprice"></span>
           							</div>
           						</div>
           					</div>
           					<div class="col-lg-12">
								<span class="product-info-divider"></span>
           					</div>
           					<div class="col-lg-12 offerdownloadcontainer" style="margin-top: 10%;">
           					  <div class="row">
           						<div class="col-lg-12 sendoffermailcontainer">
										<h6 align="center">შეთავაზების ჩამოტვირთვა</h6>
										<a href="" class="pdfdownloadlink" download>
										<div class="alert alert-dark text-center">
											<img src="../../img/Adobe_PDF_file_icon_32x32.png" alt="pdf" /><span > - </span><span class="pdfdownload"></span>
										</div>
										</a>
           								<div class="form-group">
           									<label for="sendoffermail">ადრესატის E-Mail:
           									</label>
           									<input type="email" class="form-control sendoffermail" value="" placeholder="ჩაწერეთ მეილი" name="sendoffermail" />
           								</div>
           								<div class="form-group">
           									<label for="sendoffertext">მეილის შიგთავსი:</label>
           									<textarea class="form-control sendoffertext" name="sendoffertext" rows="3"></textarea>
           								</div>
           								<input type="button" class="btn btn-success sendofferbtn" value="მეილის გაგზავნა" />
           							</div>
           						</div>	
           					</div>
							<div class="col-lg-12 makesavedoffered">
								<input type="button" value="შეთავაზება" class="btn btn-warning makesavedofferedbtn" /> 
							</div>
							<div class="col-lg-12 makeofferorder">
								<input type="button" value="შეკვეთა" class="btn btn-success makeofferorderbtn" />
							</div>
           				</div>
           				</div>
           				</div>
           			</div>
					<div class="col-lg-4 text-center">
						<div class="jumbotron jumbotron-fluid">
							<div class="container">
								<h5 align="center" style="margin-bottom: 30px; font-size: 34pt;">დამკვეთის ინფორმაცია</h5>
								<h6 class="company-info-heading"><b>დასახელება</b></h6>
								<h6 class="company-info-text company-name"></h6>
								<h6 class="company-info-heading"><b>მისამართი</b></h6>
								<h6 class="company-info-text company-address"></h6>
								<h6 class="company-info-heading"><b>საკონტაქტო ნომერი</b></h6>
								<h6 class="company-info-text company-contact"></h6>
							</div>
						</div>
						<div class="jumbotron jumbotron-fluid">
							<div class="container">
								<h5 align="center" style="margin-bottom: 30px; font-size: 34pt;">ჩანაწერები</h5>
								<div class="row">
									<div class="col-lg-12">
										<span>არსებული ჩანაწერები</span>
										<div class="notes-container">
									
										</div>
									</div>
								</div>
								<form id="notesforsaved" action="../../phpvendor/savenotes.php">
									<div class="form-group note-group">
										<label for="notes">ჩანაწერის დამატება</label>
										<textarea class="form-control" id="notes" name="notes" rows="5" ></textarea>
									</div>
									<button type="submit" id="submitnotes" class="btn btn-info">შენახვა</button>
								</form>
							</div>
						</div>
					</div>
           		</div>
            </div>
		</div> 

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="ajax.js"></script>

    <!-- Menu Toggle Script -->
	<script>
	$('.gobacktosaved').click(function(){
		parent.history.back();
		return false;
	});
	</script>
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
</body>

</html>