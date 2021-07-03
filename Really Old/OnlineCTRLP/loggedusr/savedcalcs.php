<?php 

include('../phpvendor/includes/session.php');
include('../phpvendor/includes/connection.php');


$sql = "SELECT * FROM saved";

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
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.bootstrap4.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css"/>
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
				<div class="row" style="margin-top: 20px;">
					<div class="row">
						<div class="col-lg-12" id="example_wrapper">
							
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-hover table-bordered" id="maintable">
						  <thead class="bg-info text-light">
							<tr>
							  <th scope="col">ID</th>
							  <th scope="col">დასახელება</th>
							  <th scope="col">პროდუქტი</th>
							  <th scope="col">ტირაჟი</th>
							  <th scope="col">ფორმატი</th>
							  <th scope="col">ფასი</th>
							  <th scope="col">სტატუსი</th>
							</tr>
						  </thead>
						  <tbody>
							  <?php 
								if($fetched = mysqli_query($db, $sql)){
									if(mysqli_num_rows($fetched) > 0) {
										while($row = mysqli_fetch_array($fetched)){
											$getfullnamequery = "SELECT name FROM company WHERE value='". $row['name'] . "'";
											$fetchname = mysqli_query($db, $getfullnamequery);
											$fullname = mysqli_fetch_array($fetchname);
											
											$orderstatuscolor = '';
											switch($row['orderstatus']){
												case 'შენახული':
													$orderstatuscolor = 'bg-light';
													break;
												case 'შეთავაზებული':
													$orderstatuscolor = 'bg-warning';
													break;
												case 'შეკვეთილი':
													$orderstatuscolor = 'bg-success';
													break;
												default:
													$orderstatuscolor = '';
													
											}
											
											echo '<tr class="redirectclass" data-href="../loggedusr/saved/index.php?orderid='. $row[id] .'">';
												echo '<th scope="row">'. $row['id'] .'</th>';
												echo '<td>'. $fullname['name'] .'</td>';
												echo '<td>'. $row['productname'] .'</td>';
												echo '<td>'. $row['tirage'] .'</td>';
												echo '<td>'. $row['papersizechoice'] .'</td>';
												echo '<td>'. $row['fullprice'] .'</td>';
												echo '<td class=' . $orderstatuscolor . '>'. $row['orderstatus'] .'</td>';
											echo '</tr>';
										}
									}
									else {
										echo '<tr>';
											echo '<td colspan="9">შენახული კალკულაცია არ მოიძებნა</td>';
										echo '</tr>';
									}
								}
								else {
									echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
								}

							  ?>
						  </tbody>
						</table>
					</div>
				</div>		
					
            </div>
        </div 
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>
	<script src="../vendor/functions/savedcalcs.js" type="text/javascript"></script>
	

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
</body>

</html>