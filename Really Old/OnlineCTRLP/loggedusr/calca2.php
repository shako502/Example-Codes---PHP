<?php 

include('../phpvendor/includes/session.php');
	

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
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/simple-sidebar.css" rel="stylesheet">
    <link href="../fonts/typicons.min.css" rel="stylesheet">
	<link href="../css/adminstyle.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <?php include('../phpvendor/menutemplate.php');?>

        <!-- Page Content -->
        <div id="page-content-wrapper">
           		<!--Navigation -->
				<?php include('../phpvendor/headmenutempl.php'); ?>
				
				
				 <div class="container">
					<div class="row">
						<div class="col-lg-12 justify-content-center noticecontainer" style="margin-top: 20px;">
							
						</div>
						<div class="col-lg-12 justify-content-center" style="margin-top: 20px;">
							<h4 align="center">სპეციფიკაციები</h4>
						</div>
						 <div class="col-lg-12"> 
							<span class="seperator"></span>
						 </div>
						<div class="col-lg-6">
							<div class="form-row">
								<div class="col-lg-12 tirageformcontainer">
									<div class="form-group add-after-it">
										<label for="tirage">ტირაჟი:</label>
										<button class="btn btn-success" onClick="addmoretirage(event);" type="button"><span class="typcn typcn-plus-outline"></span></button>
										<div class="input-group">
											<input type="number" id="tirage" placeholder="0" value="" class="form-control tirage-control" required />
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
									<label for="insidepaperweight">შიგთავსის გრამაჟი:</label>
									<select class="form-control" id="insidepaperweight" required>
										<option>აირჩიეთ გრამაჟი</option>
										<option value="70">70 გრამი</option>	
										<option value="80">80 გრამი</option>	
										<option value="90">90 გრამი</option>	
										<option value="100">100 გრამი</option>	
										<option value="115">115 გრამი</option>	
										<option value="120">120 გრამი</option>	
										<option value="130">130 გრამი</option>
										<option value="150">150 გრამი</option>
										<option value="170">170 გრამი</option>	
										<option value="200">200 გრამი</option>	
										<option value="250">250 გრამი</option>	
										<option value="300">300 გრამი</option>	
										<option value="350">350 გრამი</option>	
									</select>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
									<label for="insidepages">შიგთავსის გვ. რაოდენობა:</label>
									<input type="number" id="insidepages" placeholder="0" value="" class="form-control" required />
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
									<label for="printform">ბეჭდვა:</label>
									<select class="form-control" id="printform" required>
										<option>აირჩიეთ ფორმები</option>
										<option data-name="ff" value="40">4/4</option>	
										<option data-name="fz" value="20">4/0</option>
										<option data-name="ff5" value="50">5/5</option>	
										<option data-name="tt" value="20">2/2</option>	
										<option data-name="tz" value="10">2/0</option>	
										<option data-name="oo" value="10">1/1</option>	
										<option data-name="oz" value="5">1/0</option>		
									</select>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group a3percentcontainer">
									<label for="pluspercent">+% (A2):</label>
									<input type="number" id="pluspercent" placeholder="0" value="0" class="form-control" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-row">
								<div class="col-lg-12">
									<div class="form-group">
									<label for="mainpapersize">ძირითადი ქაღალდის ზომა:</label>
									<select class="form-control" id="mainpapersize" required>
										<option>აირჩიეთ ძირ. ქაღალდის ზომა</option>
										<option value="5760">50 X 70</option>	
										<option value="7000">45 X 64</option>	
									</select>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label for="papersizechoice">პროდუქტის ფორმატი:</label>
										<select class="form-control" id="papersizechoice" required>
											<option>აირჩიეთ პროდუქტის ფორმატი</option>
											<option value="a2">A2</option>
											<option value="a3">A3</option>
											<option value="a4">A4</option>	
											<option value="a5">A5</option>	
											<option value="a6">A6</option>	
										</select>
									</div>
								</div>
								
								<div class="col-lg-12">
									<div class="form-group">
									<label for="cover">ყდა:</label>
									<select class="form-control" id="cover">
										<option value="0">ყდის გარეშე</option>
										<option value="4">4 გვერდი</option>		
									</select>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
									<label for="coverpaperweight">ყდის გრამაჟი:</label>
									<select class="form-control" id="coverpaperweight" required >
										<option>აირჩიეთ გრამაჟი</option>
										<option value="70">70 გრამი</option>	
										<option value="80">80 გრამი</option>	
										<option value="90">90 გრამი</option>	
										<option value="100">100 გრამი</option>	
										<option value="115">115 გრამი</option>	
										<option value="120">120 გრამი</option>	
										<option value="130">130 გრამი</option>
										<option value="150">150 გრამი</option>
										<option value="170">170 გრამი</option>	
										<option value="200">200 გრამი</option>	
										<option value="250">250 გრამი</option>	
										<option value="300">300 გრამი</option>	
										<option value="350">350 გრამი</option>	
									</select>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
									<label for="printformcover">ყდის ბეჭდვა:</label>
									<select class="form-control" id="printformcover" required>
										<option>აირჩიეთ ფორმები</option>
										<option data-name="ff" value="40">4/4</option>	
										<option data-name="fz" value="20">4/0</option>
										<option data-name="ff5" value="50">5/5</option>	
										<option data-name="tt" value="20">2/2</option>	
										<option data-name="tz" value="10">2/0</option>	
										<option data-name="oo" value="10">1/1</option>	
										<option data-name="oz" value="5">1/0</option>		
									</select>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label for="peperprice">ქაღალდის ფასი:</label>
										<input type="number" class="form-control" placeholder="0.00" id="paperprice" name="paperprice" value="" step="0.01" required />
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top: 50px;">
						<div class="col-lg-12 justify-content-center">
							<h4 align="center">ფინიშინგი</h4>
						</div>
					</div>
					 <div class="col-lg-12"> 
						<span class="seperator"></span>
					</div>
					<div class="form-row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="folding">კეცვა:</label>
								<select class="form-control" id="folding" required>
									<option value="0">არა</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="stitch">აკინძვა:</label>
								<select class="form-control" id="stitch" required>
									<option value="0">არა</option>
									<option value="thermal">თერმული</option>
									<option value="stapler">სტეპლერი</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="formatcut">ფორმატზე დაჭრა:</label>
								<select class="form-control" id="formatcut" required>
									<option value="0">არა</option>
									<option value="1">კი</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="otherfees">სხვა ხარჯი:</label>
								<input type="number" class="form-control" placeholder="0" id="otherfees" name="otherfees" value="0" />
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="feepercent">მოგება (%):</label>
								<input type="number" class="form-control" id="feepercent" value="0" placeholder="0" name="feepercent">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="otherfeecomment">კომენტარი:</label>
								<textarea class="otherfeecomment form-control" id="otherfeecomment"></textarea>
							</div>
						</div>
					</div>
					<div class="row justify-content-center" style="margin-top: 40px;">
						<div class="col-lg-12">
							<div align="center">
							<button  class="btn btn-outline-primary sumup" data-toggle="modal" data-target="#calculationmodal">გამოთვლა</button>
								</div>
						</div>
					</div>
            </div>
			<!-- Modal -->
			<div class="modal fade" id="calculationmodal" tabindex="-1" role="dialog" aria-labelledby="CalculationModal" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="CalculationModal">ჯამი</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					  <div class="row">
					  	<div class="col-lg-12">
					  		<h5 align="center" class="tirage-changer-title">ტირაჟის შეცვლა:</h5>
					  	</div>
					  </div>
				  	<div class="row tirage-changer-container">
						
				  	</div>
					  <form class="calculation-form" method="post">
						  <div id="accordion" style="margin-bottom: 20px;">
							  <div class="card">
								<div class="card-header" id="headingOne">
								  <h5 class="mb-0">
									<input type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" value="ინფორმაცია" />
								  </h5>
								</div>

								<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
								  <div class="card-body">
									 <div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="tirage-last">ტირაჟი:</label>
												<input type="text" readonly value="" class="form-control" name="tirage-last" id="tirage-last">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="mainpaperquantity-last" class="mainpapername"></label>
												<div class="input-group">
													<input type="text" readonly value="" class="form-control" id="mainpaperquantity-last" name="mainpaperquantity-last" aria-describedby="almost">
													<div class="input-group-append">
														<span class="input-group-text" id="almost"></span>
													</div>
												</div>
											</div>
										</div>  
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="paperweight-last">გრამაჟი:</label>
												<div class="input-group">
													<input type="text" readonly value="" class="form-control" id="paperweight-last" name="paperweight-last" aria-describedby="gram">
													<div class="input-group-append">
														<span class="input-group-text" id="gram">გ</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="otherfees-last">A2 რაოდენობა:</label>
												<div class="input-group">
													<input type="text" readonly value="" class="form-control" id="a3quantity" name="a3quantity" aria-describedby="quantity">
													<div class="input-group-append">
														<span class="input-group-text" id="quantity">ცალი</span>
													</div>
												</div>
											</div>
										</div>
									 </div>
									  <div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="papersizechoice-last">ფორმატი:</label>
												<input type="text" readonly value="" class="form-control" id="papersizechoice-last" name="papersizechoice-last">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="insidepages-last">შიგთავსის გვერდების რაოდენობა:</label>
												<div class="input-group">
													<input type="text" readonly value="" class="form-control" id="insidepages-last" name="insidepages-last" aria-describedby="page">
													<div class="input-group-append">
														<span class="input-group-text" id="page">გვერდი</span>
													</div>
												</div>
											</div>
										</div>  
									</div>
								  	<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="cover-last">ყდა:</label>
												<div class="input-group">
													<input type="text" readonly value="" class="form-control" id="cover-last" name="cover-last" aria-describedby="page">
													<div class="input-group-append">
														<span class="input-group-text" id="page">გვერდი</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="printform-last">ბეჭდვა(შიგთ. გვერდები):</label>
												<input type="text" readonly value="" class="form-control" id="printform-last" name="printform-last">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="printformcover-last">ბეჭდვა(ყდა):</label>
												<input type="text" readonly value="" class="form-control" id="printformcover-last" name="printformcover-last">
											</div>
										</div>  
									</div>
									  <div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="paperprice-last">ქაღალდის ფასი:</label>
												<div class="input-group">
													<input type="text" readonly value="" class="form-control" id="paperprice-last" name="paperprice-last" aria-describedby="lari">
													<div class="input-group-append">
														<span class="input-group-text" id="lari">ლარი</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="folding-last">კეცვა:</label>
												<input type="text" readonly value="" class="form-control" id="folding-last" name="folding-last">
											</div>
										</div>  
									</div>
									 <div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="stitch-last">აკინძვა:</label>
												<input type="text" readonly value="" class="form-control" id="stitch-last" name="stitch-last">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="formatcut-last">ფორმატზე დაჭრა:</label>
												<input type="text" readonly value="" class="form-control" id="formatcut-last" name="formatcut-last">
											</div>
										</div>  
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="otherfees-last">სხვა ხარჯი:</label>
												<div class="input-group">
													<input type="text" readonly value="" class="form-control" id="otherfees-last" name="otherfees-last" aria-describedby="lari">
													<div class="input-group-append">
														<span class="input-group-text" id="lari">ლარი</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									  
								 </div>
								</div>
							  </div>
						  </div>
						  
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="insidea3q-last">შიგთავსის გვ. A2 რაოდენობა:</label>
									<div class="input-group">
										<input type="text" readonly value="" class="form-control" id="insidea3q-last" name="insidea3q-last" aria-describedby="quan">
										<div class="input-group-append">
											<span class="input-group-text" id="quan">ც</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="covera3q-last">ყდის A2 რაოდენობა:</label>
									<div class="input-group">
										<input type="text" readonly value="" class="form-control" id="covera3q-last" name="covera3q-last" aria-describedby="quan">
										<div class="input-group-append">
											<span class="input-group-text" id="quan">ც</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="fullweight-last">წონა სულ:</label>
									<div class="input-group">
										<input type="text" readonly value="" class="form-control" id="fullweight-last" name="fullweight-last" aria-describedby="kg">
										<div class="input-group-append">
											<span class="input-group-text" id="kg">კგ</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="printime-last">ბეჭდვა:</label>
									<div class="input-group">
										<input type="text" readonly value="" class="form-control" id="printime-last" name="printime-last" aria-describedby="lari">
										<div class="input-group-append">
											<span class="input-group-text" id="lari">ლარი</span>
										</div>
									</div>
								</div>
							</div>
						</div>
							<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="foldprice-last">კეცვის ფასი:</label>
									<div class="input-group">
										<input type="text" readonly value="" class="form-control" id="foldprice-last" name="foldprice-last" aria-describedby="lari">
										<div class="input-group-append">
											<span class="input-group-text" id="lari">ლარი</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="kindzva-last">აკინძვის ფასი:</label>
									<div class="input-group">
										<input type="text" readonly value="" class="form-control" id="kindzva-last" name="kindzva-last" aria-describedby="lari">
										<div class="input-group-append">
											<span class="input-group-text" id="lari">ლარი</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="pricewithoutfee">ფასი ( - მოგება):</label>
									<div class="input-group">
										<input type="text" readonly value="" class="form-control" id="pricewithoutfee" name="pricewithoutfee" aria-describedby="lari">
										<div class="input-group-append">
											<span class="input-group-text" id="lari">ლარი</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="fullprice">ფასი:</label>
									<div class="input-group">
										<input type="text" style="background-color: #9FF082;" readonly value="" name="fullprice" class="form-control" id="fullprice" aria-describedby="lari">
										<div class="input-group-append">
											<span class="input-group-text" id="lari">ლარი</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row savename-row bg-secondary text-light" style="padding-top:15px; padding-bottom: 15px;">
							<div class="col-lg-12">
								<div class="form-group">
									<label for="savename">კომპანიის დასახელება:</label>
									<select class="form-control" id="savename" name="savename">
										<?php
										$getcompany = "SELECT * FROM company";
											if($fetched = mysqli_query($db, $getcompany)){
												if(mysqli_num_rows($fetched) > 0) {
													while($row = mysqli_fetch_array($fetched)){ 
														echo '<option value="'. $row['value'] . '">' . $row['name'] . '</option>';
													}
												}
												else {
													echo '<option value="0">კლიენტები არ მოიძებნა</option>';
												}
											}
											else {
												echo 'mysql error ' . mysqli_error($db);
											}
										
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="productname">პროდუქტის დასახელება:</label>
									<input type="text" class="form-control productname" value="" placeholder="ჩაწერეთ პროდუქტის დასახელება" name="productname" />
								</div>
							</div>
							<div class="col-lg-6">
								<div align="center">
								<input type="button" value="შენახვა" class="btn btn-info save-calc btn-lg btn-block">
								</div>
							</div>
							<div class="col-lg-6">
								<div align="center">
									<input type="button" value="შეთავაზება" class="btn btn-info make-offer-save btn-lg btn-block" />
								</div>
							</div>
						</div>
						<input type="hidden" value="" name="orderstatus" class="orderstatus" />
						<input type="hidden" value="0" name="filepath" class="filepath" />
						<div class="row" style="margin-top: 10px;">
							<div class="col-lg-12" align="center">
					  			<button type="button" class="btn save-calc-pre btn-outline-dark btn-lg">შენახვა</button>
					  			<button type="button" class="btn make-offer btn-outline-dark btn-lg">შეთავაზება</button>
								<button type="button" class="btn make-order btn-outline-success btn-lg">შეკვეთა</button>
							</div>
						</div>
					</form>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">დახურვა</button>
				  </div>
				</div>
			  </div>
			</div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="../vendor/mask/jquery.mask.min.js"></script>
	<script src="../vendor/jspdf/jspdf.min.js"></script>
	<script src="../vendor/jspdf/jspdf.customfonts.min.js"></script>
	<script src="../vendor/jspdf/default_vfs.js"></script>
	<script src="../vendor/jspdf/makeofferfunction.js"></script>
	<script src="../vendor/functions/calcfunca2.js"></script>
	
	<script>
		$('#printime').mask('00:00');
	</script>
    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
	
	<script>
		
		$('.save-calc').click(function(){
			$('.orderstatus').val('შენახული');
			$('.calculation-form').attr('action', '../phpvendor/save.php');
			$('.calculation-form').submit();
		});
	</script>
	
	<script>
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
		
		if(getUrlVars()["data"] === 'offered') {
			$('.noticecontainer').html('<div class="alert alert-success" role="alert">შეთავაზება შენახულია!</div>');
		}
		else if(getUrlVars()["data"] === 'saved') {
			$('.noticecontainer').html('<div class="alert alert-success" role="alert">კალკულაცია შენახულია!</div>');
		}
	</script>

</body>

</html>