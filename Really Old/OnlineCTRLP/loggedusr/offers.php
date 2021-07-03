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
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-html5-1.5.4/b-print-1.5.4/r-2.2.2/sl-1.2.6/datatables.min.css"/>
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
					<div class="col-lg-12">
						<h3 align="center">შეთავაზებები</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<table id="offertable" class="table table-striped" style="width: 100%">
							<thead>
								<tr>
									<th>ID</th>
									<th>დასახელება</th>
									<th>დამკვეთი</th>
									<th>ტირაჟი</th>
									<th>თარიღი</th>
									<th>მეტი</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
			
		</div>
		<!-- /#page-content-wrapper -->

	</div>
	<!-- /#wrapper -->

	<!-- Bootstrap core JavaScript -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="../vendor/bootstrap/js/bootstrap.bundle.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-html5-1.5.4/b-print-1.5.4/r-2.2.2/sl-1.2.6/datatables.min.js"></script>
	<script src="../vendor/functions/tables.js"></script>

	<!-- Menu Toggle Script -->
	<script>
		$( "#menu-toggle" ).click( function ( e ) {
			e.preventDefault();
			$( "#wrapper" ).toggleClass( "toggled" );
		} );
	</script>

</body>

</html>