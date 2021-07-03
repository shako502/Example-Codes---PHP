<?php

include( '../phpvendor/includes/session.php' );


?>
<!doctype html>
<html><head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>CtrlP Administration</title>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css" />

	<!-- Custom styles for this template -->
	<link href="../css/simple-sidebar.css" rel="stylesheet">
	<link href="../fonts/typicons.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
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
				<form class="CalcInputValidation needs-validation" novalidate id="CalcInputValidation">
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
										<input type="number" name="tirage" id="tirage" placeholder="0" value="" class="form-control tirage-control" required/>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label for="insidepaperweight">შიგთავსის გრამაჟი:</label>
									<select class="form-control" name="insidepaperweight" id="insidepaperweight" required>
										<option value="">აირჩიეთ გრამაჟი</option>
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
									<input type="number" name="insidepages" id="insidepages" placeholder="0" value="" class="form-control" required/>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label for="printform">ბეჭდვა:</label>
									<select class="form-control" name="printform" id="printform" required>
										<option value="">აირჩიეთ ფორმები</option>
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
									<label for="pluspercent">+% (A3):</label>
									<input type="number" name="pluspercent" id="pluspercent" placeholder="0" value="0" class="form-control"/>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-row">
							<div class="col-lg-12">
								<div class="form-group">
									<label for="mainpapersize">ძირითადი ქაღალდის ზომა:</label>
									<select class="form-control" name="mainpapersize" id="mainpapersize" required>
										<option value="">აირჩიეთ ძირ. ქაღალდის ზომა</option>
										<option value="5760" data-papername="a36490">64 X 90</option>
										<option value="7000" data-papername="a370100">70 X 100</option>
										<option value="5760" data-papername="a25070">50 X 70</option>
										<option value="7000" data-papername="a24564">45 X 64</option>
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label for="papersizechoice">პროდუქტის ფორმატი:</label>
									<select class="form-control" name="papersizechoice" id="papersizechoice" required>
										<option value="">აირჩიეთ პროდუქტის ფორმატი</option>
										<option value="a3">A3</option>
										<option value="a4">A4</option>
										<option value="a5">A5</option>
										<option value="a6">A6</option>
										<option value="10x21">10X21</option>
										<option value="other">სხვა</option>
									</select>
								</div>
							</div>
							<div class="col-lg-12 prodFormatContainer" id="prodFormatContainer">
								<div class="form-group">
									<label for="prodFormatInput">შეიყვანეთ რაოდენობა:</label>
									<input type="number" class="form-control" name="prodFormatInput" id="prodFormatInput" />
								</div>
							</div>

							<div class="col-lg-12">
								<div class="form-group">
									<label for="cover">ყდა:</label>
									<select class="form-control" name="cover" id="cover">
										<option value="0">ყდის გარეშე</option>
										<option value="4">4 გვერდი</option>
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label for="coverpaperweight">ყდის გრამაჟი:</label>
									<select class="form-control" name="coverpaperweight" id="coverpaperweight">
										<option value="">აირჩიეთ გრამაჟი</option>
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
									<select class="form-control" name="printformcover" id="printformcover">
										<option value="">აირჩიეთ ფორმები</option>
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
									<input type="number" class="form-control" placeholder="0.00" id="paperprice" name="paperprice" value="" step="0.01" required/>
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
							<input type="number" class="form-control" placeholder="0" id="otherfees" name="otherfees" value="0"/>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="feepercent">მოგება (%):</label>
									<input type="number" class="form-control" id="feepercent" value="0" placeholder="0" name="feepercent">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="dgg">
										<label class="form-check-label" for="dgg">
											+ დღგ
										</label>
									</div>
								</div>
							</div>
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
							<button class="btn btn-outline-primary sumup">გამოთვლა</button>
						</div>
					</div>
				</div>
					</form>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="calculationmodal" tabindex="-1" role="dialog" aria-labelledby="CalculationModal" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="CalculationModal">ჯამი</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						
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
								<div class="accordion" style="margin-bottom: 20px;">
									<div class="card" id="PaperInfoContainer">
										<div class="card-header" id="PaperInfoHead">
											<h5 class="mb-0">
												<input type="button" class="btn btn-link" data-toggle="collapse" data-target="#PaperInfoCollapse" aria-expanded="true" aria-controls="PaperInfoCollapse" value="ინფორმაცია ქაღალდზე" />
											</h5>
										</div>

										<div id="PaperInfoCollapse" class="collapse" aria-labelledby="PaperInfoHead" data-parent="#PaperInfoContainer">
											<div class="card-body">
												<div class="row">
													 <div class="col-lg-6">
														<div class="form-group">
														  <label for="mainpapersize-last">მთავარი ქაღალდის ზომა:</label>
														  <div class="input-group">
															<input type="text" readonly value="" class="form-control mainpapername" name="mainpapersize-last" aria-describedby="almost">
														  </div>
														</div>
													 </div>
													<div class="col-lg-6">
														<div class="form-group">
														  <label for="mainpaperquantity-last">მთავარი ქაღალდის რაოდენობა:</label>
														  <div class="input-group">
															<input type="number" readonly value="" class="form-control" id="mainpaperquantity-last" name="mainpaperquantity-last" aria-describedby="almost">
															<div class="input-group-append"> <span class="input-group-text" id="almost"></span> </div>
														  </div>
														</div>
													 </div>
												</div>
												<div class="row">
													  <div class="col-lg-6">
														<div class="form-group">
														  <label for="insidepages-last">შიგთავსის გვერდების რაოდენობა:</label>
														  <div class="input-group">
															<input type="number" readonly value="" class="form-control" id="insidepages-last" name="insidepages-last" aria-describedby="page">
															<div class="input-group-append"> <span class="input-group-text" id="page">გვერდი</span> </div>
														  </div>
														</div>
													  </div>
													  <div class="col-lg-6">
														<div class="form-group">
														  <label for="cover-last">ყდის გვერდების რაოდენობა:</label>
														  <div class="input-group">
															<input type="number" readonly value="" class="form-control" id="cover-last" name="cover-last" aria-describedby="page">
															<div class="input-group-append"> <span class="input-group-text" id="page">გვერდი</span> </div>
														  </div>
														</div>
													  </div>
												</div>
												<div class="row">
													  <div class="col-lg-6">
														<div class="form-group">
														  <label for="pagespercent-last">+% (A3 ქაღალდი):</label>
														  <div class="input-group">
															<input type="number" readonly value="" class="form-control" id="pagespercent-last" name="pagespercent-last">
														  </div>
														</div>
													  </div>
													 <div class="col-lg-6">
														<div class="form-group">
														  <label for="otherfees-last">A3 რაოდენობა:</label>
														  <div class="input-group">
															<input type="number" readonly value="" class="form-control" id="a3quantity" name="a3quantity" aria-describedby="quantity">
															<div class="input-group-append"> <span class="input-group-text" id="quantity">ცალი</span> </div>
														  </div>
														</div>
													  </div>
												</div>
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label for="insidea3q-last">შიგთავსის გვ. A3 რაოდენობა:</label>
															<div class="input-group">
																<input type="number" readonly value="" class="form-control" id="insidea3q-last" name="insidea3q-last" aria-describedby="quan">
																<div class="input-group-append">
																	<span class="input-group-text" id="quan">ც</span>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label for="covera3q-last">ყდის A3 რაოდენობა:</label>
															<div class="input-group">
																<input type="number" readonly value="" class="form-control" id="covera3q-last" name="covera3q-last" aria-describedby="quan">
																<div class="input-group-append">
																	<span class="input-group-text" id="quan">ც</span>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									
									<div class="card" id="WeightInfoContainer">
										<div class="card-header" id="WeightInfoHead">
											<h5 class="mb-0">
												<input type="button" class="btn btn-link" data-toggle="collapse" data-target="#WeightInfoCollapse" aria-expanded="true" aria-controls="WeightInfoCollapse" value="ინფორმაცია წონაზე" />
											</h5>
										</div>
										
										<div id="WeightInfoCollapse" class="collapse" aria-labelledby="WeightInfoHead" data-parent="#WeightInfoContainer">
											<div class="card-body">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
														  <label for="inpaperweight-last">შიგთავსის გრამაჟი:</label>
														  <div class="input-group">
															<input type="number" readonly value="" class="form-control" id="inpaperweight-last" name="inpaperweight-last" aria-describedby="gram">
															<div class="input-group-append"> <span class="input-group-text" id="gram">გ</span> </div>
														  </div>
														</div>
													  </div>
													<div class="col-lg-6">
														<div class="form-group">
														  <label for="covpaperweight-last">ყდის გრამაჟი:</label>
														  <div class="input-group">
															<input type="number" readonly value="" class="form-control" id="covpaperweight-last" name="covpaperweight-last" aria-describedby="gram">
															<div class="input-group-append"> <span class="input-group-text" id="gram">გ</span> </div>
														  </div>
														</div>
													  </div>
												</div>
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label for="afterinpagesweight-last">შიგთავსის წონა:</label>
															<div class="input-group">
																<input type="number" readonly value="" class="form-control" id="afterinpagesweight-last" name="afterinpagesweight-last" aria-describedby="kg">
																<div class="input-group-append">
																	<span class="input-group-text" id="kg">კგ</span>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label for="aftercovweight-last">ყდის წონა:</label>
															<div class="input-group">
																<input type="number" readonly value="" class="form-control" id="aftercovweight-last" name="aftercovweight-last" aria-describedby="kg">
																<div class="input-group-append">
																	<span class="input-group-text" id="kg">კგ</span>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<div class="form-group">
															<label for="fullweight-last">წონა სულ:</label>
															<div class="input-group">
																<input type="number" readonly value="" class="form-control" id="fullweight-last" name="fullweight-last" aria-describedby="kg">
																<div class="input-group-append">
																	<span class="input-group-text" id="kg">კგ</span>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="card" id="FormsInfoContainer">
										<div class="card-header" id="FormsInfoHead">
											<h5 class="mb-0">
												<input type="button" class="btn btn-link" data-toggle="collapse" data-target="#FormsInfoCollapse" aria-expanded="true" aria-controls="FormsInfoCollapse" value="ინფორმაცია ფორმებზე" />
											</h5>
										</div>
										
										<div id="FormsInfoCollapse" class="collapse" aria-labelledby="FormsInfoHead" data-parent="#FormsInfoContainer">
											<div class="card-body">
												<div class="row">
													  <div class="col-lg-6">
														<div class="form-group">
														  <label for="printform-last">შიგთავსის ფორმები:</label>
														  <input type="text" readonly value="" class="form-control" id="printform-last" name="printform-last">
														</div>
													  </div>
													<div class="col-lg-6">
														<div class="form-group">
														  <label for="printformcover-last">ყდის ფორმები:</label>
														  <input type="text" readonly value="" class="form-control" id="printformcover-last" name="printformcover-last">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label for="inpagesprintprice-last">შიგთავსის ბეჭდვის ფასი:</label>
															<div class="input-group">
																<input type="number" readonly value="" class="form-control" id="inpagesprintprice-last" name="inpagesprintprice-last" aria-describedby="lari">
																<div class="input-group-append">
																	<span class="input-group-text" id="lari">ლარი</span>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label for="covprintprice-last">ყდის ბეჭდვის ფასი:</label>
															<div class="input-group">
																<input type="number" readonly value="" class="form-control" id="covprintprice-last" name="covprintprice-last" aria-describedby="lari">
																<div class="input-group-append">
																	<span class="input-group-text" id="lari">ლარი</span>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-6">
														<label for="inpagesprinttime-last">შიგთავსის ბეჭდვის დრო:</label>
															<div class="input-group">
																<input type="number" readonly value="" class="form-control" id="inpagesprinttime-last" name="inpagesprinttime-last" aria-describedby="time">
																<div class="input-group-append">
																	<span class="input-group-text" id="time">სთ. - წთ.</span>
																</div>
															</div>
													</div>
													<div class="col-lg-6">
														<label for="covprinttime-last">ყდის ბეჭდვის დრო:</label>
															<div class="input-group">
																<input type="number" readonly value="" class="form-control" id="covprinttime-last" name="covprinttime-last" aria-describedby="time">
																<div class="input-group-append">
																	<span class="input-group-text" id="time">სთ. - წთ.</span>
																</div>
															</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-12">
															<label for="printime-last">ბეჭდვის ფასი (მთლიანად):</label>
															<div class="input-group">
																<input type="number" readonly value="" class="form-control" id="printime-last" name="printime-last" aria-describedby="lari">
																<div class="input-group-append">
																	<span class="input-group-text" id="lari">ლარი</span>
																</div>
															</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="card" id="FinishingInfoContainer">
										<div class="card-header" id="FinishingInfoHead">
											<h5 class="mb-0">
												<input type="button" class="btn btn-link" data-toggle="collapse" data-target="#FinishingInfoCollapse" aria-expanded="true" aria-controls="FinishingInfoCollapse" value="ინფორმაცია ფინიშინგზე" />
											</h5>
										</div>
										
										<div id="FinishingInfoCollapse" class="collapse" aria-labelledby="FinishingInfoHead" data-parent="#FinishingInfoContainer">
											<div class="card-body">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
														  <label for="folding-last">კეცვა:</label>
														  <input type="number" readonly value="" class="form-control" id="folding-last" name="folding-last">
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
														  <label for="stitch-last">აკინძვა:</label>
														  <input type="text" readonly value="" class="form-control" id="stitch-last" name="stitch-last">
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
														  <label for="formatcut-last">ფორმატზე დაჭრა:</label>
														  <input type="text" readonly value="" class="form-control" id="formatcut-last" name="formatcut-last">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<label for="foldprice-last">კეცვის ფასი:</label>
															<div class="input-group">
																<input type="number" readonly value="" class="form-control" id="foldprice-last" name="foldprice-last" aria-describedby="lari">
																<div class="input-group-append">
																	<span class="input-group-text" id="lari">ლარი</span>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label for="kindzva-last">აკინძვის ფასი:</label>
															<div class="input-group">
																<input type="number" readonly value="" class="form-control" id="kindzva-last" name="kindzva-last" aria-describedby="lari">
																<div class="input-group-append">
																	<span class="input-group-text" id="lari">ლარი</span>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label for="formatcutprice-last">ფორმ. დაჭრის ფასი:</label>
															<div class="input-group">
																<input type="number" readonly value="" class="form-control" id="formatcutprice-last" name="formatcutprice-last" aria-describedby="lari">
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
									<div class="card" id="PriceInfoContainer">
										<div class="card-header" id="PriceInfoHead">
											<h5 class="mb-0">
												<input type="button" class="btn btn-link" data-toggle="collapse" data-target="#PriceInfoCollapse" aria-expanded="true" aria-controls="PriceInfoCollapse" value="ინფორმაცია ფასებზე" />
											</h5>
										</div>
										
										<div id="PriceInfoCollapse" class="collapse" aria-labelledby="PriceInfoHead" data-parent="#PriceInfoContainer">
											<div class="card-body">
												<div class="row">
													<div class="col-lg-6">
														  <label for="paperprice-last">ქაღალდის ფასი:</label>
														  <div class="input-group">
															<input type="number" readonly value="" class="form-control" id="paperprice-last" name="paperprice-last" aria-describedby="lari">
															<div class="input-group-append"> <span class="input-group-text" id="lari">ლარი</span> </div>
														  </div>
													</div>
													<div class="col-lg-6">
														  <label for="pricepercent-last">+ მოგება:</label>
														  <div class="input-group">
															<input type="number" readonly value="" class="form-control" id="pricepercent-last" name="pricepercent-last" aria-describedby="percentsymb">
															<div class="input-group-append"> <span class="input-group-text" id="percentsymb">%</span> </div>
														  </div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="card" id="OtherFeeCommentsContainer">
										<div class="card-header" id="OtherFeeCommentsHead">
											<h5 class="mb-0">
												<input type="button" class="btn btn-link" data-toggle="collapse" data-target="#OtherFeeCommentsCollapse" aria-expanded="true" aria-controls="OtherFeeCommentsCollapse" value="ინფორმაცია სხვა ხარჯზე" />
											</h5>
										</div>
										
										<div id="OtherFeeCommentsCollapse" class="collapse" aria-labelledby="OtherFeeCommentsHead" data-parent="#OtherFeeCommentsContainer">
											<div class="card-body">
												<div class="row">
													<div class="col-lg-6">
														  <label for="otherfees-last">სხვა ხარჯი:</label>
														  <div class="input-group">
															<input type="number" readonly value="" class="form-control" id="otherfees-last" name="otherfees-last" aria-describedby="lari">
															<div class="input-group-append"> <span class="input-group-text" id="lari">ლარი</span> </div>
														  </div>
													</div>
													<div class="col-lg-6">
														<label for="otherfeescomm-last">კომენტარი</label>
														<div class="input-group">
															<textarea id="otherfeescomm-last" readonly class="form-control otherfeescomm-last" name="otherfeescomm-last"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
								</div> <!-- End Of Informations -->

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										  <label for="tirage-last">ტირაჟი:</label>
										  <input type="number" readonly value="" class="form-control" name="tirage-last" id="tirage-last">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
										  <label for="papersizechoice-last">ფორმატი:</label>
										  <input type="text" readonly value="" class="form-control" id="papersizechoice-last" name="papersizechoice-last">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
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
								</div>
								<div class="row">
									<div class="col-lg-12">
										<label for="fullprice">ფასი:</label>
										<div class="input-group">
											<input type="text" style="background-color: #9FF082;" readonly value="" name="fullprice" class="form-control" id="fullprice" aria-describedby="lari">
											<div class="input-group-append">
												<span class="input-group-text" id="lari">ლარი</span>
											</div>
										</div>
									</div>
								</div>
								<div class="row" style="margin-top: 10px;">
									<div class="col-lg-12" align="center">
										<button type="button" class="btn make-offer btn-outline-dark btn-lg">შემდეგი</button>
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

			<!-- Offer Details Modal -->
			<div class="modal fade" id="OfferDetailsModal" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">შეთავაზების დეტალები</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
						
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-lg-12 alert alert-success" id="ofSaveSuccessCont" style="display: none;">
									<h4 align="center">შეთავაზების ფურცელი გენერირებულია</h4>
									<p align="center" id="ofSavePdfDownCont"><a href="" target="_blank" id="ofSavePdfDown" data-filename="" data-invoicenum="" class="btn btn-outline-dark">შეთავაზების ნახვა</a></p>
									<div class="row" style="border-top: 1px dashed #b39a9a; padding-top: 10px;">
										<div class="col-lg-4 text-center">
											<input type="button" value="გაგზავნა" id="ofSaveSuccessSend" class="btn btn-outline-success" />
										</div>
										<div class="col-lg-4 text-center">
											<input type="button" value="მხოლოდ შენახვა" id="ofSaveSuccessDBsave" class="btn btn-outline-primary" />
										</div>
										<div class="col-lg-4 text-center">
											<input type="button" value="ფაილის წაშლა" id="ofSaveSuccessDelFile" class="btn btn-outline-danger" />
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="offer-productname">პროდუქტის დასახელება:</label>
										<input type="text" value="" class="form-control" name="offer-productname" id="offer-productname">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="offer-receivername">მიმღების დასახელება:</label>
										<input type="text" value="" class="form-control" name="offer-receivername" id="offer-receivername">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="offer-receiversk">მიმღების ს.კ.:</label>
										<input type="text" value="" class="form-control" required name="offer-receiversk" id="offer-receiversk">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="offer-receiveraddress">მიმღების მისამართი:</label>
										<input type="text" value="" class="form-control" required name="offer-receiveraddress" id="offer-receiveraddress">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="offer-tirage">რაოდენობა:</label>
										<input type="text" value="" required class="form-control" name="offer-tirage" id="offer-tirage">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="offer-fullprice">ფასი:</label>
										<input type="number" step=".01" value="" required class="form-control" name="offer-fullprice" id="offer-fullprice">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="offer-fullpriceverb">ფასი სიტყვიერად:</label>
										<input type="text" value="" required class="form-control" name="offer-fullpriceverb" id="offer-fullpriceverb">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="offer-email">მიმღების მეილი:</label>
										<input type="email" value="" class="form-control" name="offer-email" id="offer-email">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="offer-mailtext">ტექსტი მეილისთვის:</label>
										<textarea id="offer-mailtext" class="form-control" name="offer-mailtext"></textarea>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="offer-copymail">მეილის ასლის ადრესატი:</label>
										<input type="email" value="" class="form-control" name="offer-copymail" id="offer-copymail">
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">დახურვა</button>
							<button type="button" class="btn btn-primary make-offer-pdf">შეთავაზება</button>
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
	<script src="../vendor/bootstrap/js/bootstrap.bundle.js"></script>
	<script src="../vendor/validate/jquery.validate.min.js"></script>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>
	<script src="../vendor/functions/calcfunc.js"></script>
	<script src="../vendor/jspdf/makeofferfunction.js"></script>

	<!-- Menu Toggle Script -->
	<script>
		$( "#menu-toggle" ).click( function ( e ) {
			e.preventDefault();
			$( "#wrapper" ).toggleClass( "toggled" );
		} );
	</script>
	<script>
		$(document).ready(function() {
		  $('#offer-mailtext').summernote();
		});
	</script>

	<script>
		$( '.save-calc' ).click( function () {
			$( '.orderstatus' ).val( 'შენახული' );
			$( '.calculation-form' ).attr( 'action', '../phpvendor/save.php' );
			$( '.calculation-form' ).submit();
		} );
	</script>

	<script>
		function getUrlVars() {
			var vars = [],
				hash;
			var hashes = window.location.href.slice( window.location.href.indexOf( '?' ) + 1 ).split( '&' );
			for ( var i = 0; i < hashes.length; i++ ) {
				hash = hashes[ i ].split( '=' );
				vars.push( hash[ 0 ] );
				vars[ hash[ 0 ] ] = hash[ 1 ];
			}
			return vars;
		}

		if ( getUrlVars()[ "data" ] === 'offered' ) {
			$( '.noticecontainer' ).html( '<div class="alert alert-success" role="alert">შეთავაზება შენახულია!</div>' );
		} else if ( getUrlVars()[ "data" ] === 'saved' ) {
			$( '.noticecontainer' ).html( '<div class="alert alert-success" role="alert">კალკულაცია შენახულია!</div>' );
		}
	</script>

	<script>
		$( '.fillup' ).click( function () {
			$( '#tirage' ).val( 1000 );
			$( '#mainpapersize' ).val( 5760 );
			$( '#papersizechoice' ).val( 'a4' );
			$( '#insidepaperweight' ).val( 170 );
			$( '#insidepages' ).val( 64 );
			$( '#cover' ).val( 4 );
			$( '#printform' ).val( 40 );
			$( '#coverpaperweight' ).val( 250 );
			$( '#pluspercent' ).val( 10 );
			$( '#printformcover' ).val( 40 );
			$( '#paperprice' ).val( 3 );
			$( '#folding' ).val( 2 );
			$( '#stitch' ).val( 'thermal' );
			$( '#formatcut' ).val( 1 );
			$( '#otherfees' ).val( 50 );
			$( '#feepercent' ).val( 20 );
			$( '#otherfeecomment' ).val( 'something' );

		} );
	</script>

</body>

</html>