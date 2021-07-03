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

        <?php include('../phpvendor/menutemplate.php'); ?>

        <!-- Page Content -->
        <div id="page-content-wrapper">
				<!--Navigation -->
				<?php include('../phpvendor/headmenutempl.php'); ?>
				
 
       
       
       			<div class="container-fluid" style="margin-top: 50px;">
<?php if($role === 'admin') {
					?>
       				
       				<div class="row justify-content-center">
       					<div class="col-lg-3">
							<div align="center">
       						<button class="btn btn-success" data-toggle="modal" data-target="#registrationmodal">ახალი მომხმარებლის რეგისტრაცია</button>
							</div>
       					</div>
						
       				</div>
					<div class="row justify-content-center" style="margin-top: 20px;">
						<div class="col-lg-3">
							<div align="center">
							<input type="button" class="btn btn-info" data-toggle="modal" data-target="#companymodal" value="კლიენტის დამატება" />
							</div>
						</div>
					</div>
       	
	
<?php } ?>
       	
       			</div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

   	<!--  Registration Modal -->
			<div class="modal fade" id="registrationmodal" tabindex="-1" role="dialog" aria-labelledby="RegistrationModal" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="RegistrationModal">მომხმარებლის რეგისტრაცია</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
				  <form action="../phpvendor/newuser.php" class="needs-validation" id="newuserform" method="post" novalidate>
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="username">მომხმარებლის სახელი:</label>
								<input type="text" id="username" class="form-control" name="newusername" value="" required placeholder="მომხმარებლის სახელი">
								<div class="invalid-feedback">შეავსეთ მომხმარებლის სახელი</div>
							</div>
						</div>
					  </div>
					  <div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="newpassword">პაროლი:</label>
								<input type="password" id="newpassword" class="form-control" name="newpassword" required value="" placeholder="პაროლი">
								<div class="invalid-feedback">შეიყვანეთ პაროლი</div>
							</div>
						</div>
					   </div>
					   <div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="retypepassword">გაიმეორეთ პაროლი:</label>
								<input type="password" id="retypepassword" class="form-control" value="" required placeholder="გაიმეორეთ პაროლი">
								<div class="invalid-feedback">გაიმეორეთ პაროლი</div>
							</div>
						</div>
					   </div>
					   <div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="role">სტატუსი:</label>
								<select id="role" name="role" class="form-control" required>
									<option value="admin">ადმინისტრატორი</option>
									<option value="manager">მენეჯერი</option>
									<option value="user">მომხმარებელი</option>
								</select>
							</div>
						</div>
					   </div>

				  </div>
				  <div class="modal-footer">
				  	<button type="submit" id="newusereg" class="btn btn-success">დამატება</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">დახურვა</button>
				  </div>
				  </form>
				</div>
			  </div>
			</div>
		</div>
	
	
   <!--  Client Add Modal -->
			<div class="modal fade" id="companymodal" tabindex="-1" role="dialog" aria-labelledby="CompanyModal" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="CompanyModal">კლიენტის დამატება</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
				  <form action="../phpvendor/newclient.php" class="needs-validation" method="post" novalidate>
					<div class="form-row">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="clientname">კომპანიის (კლიენტის) დასახელება:</label>
								<input type="text" required class="form-control" name="clientname" value="" placeholder="დასახელება">
								<div class="invalid-feedback">შეავსეთ კლიენტის დასახელება</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label for="address">მისამართი:</label>
								<input type="text" class="form-control" name="address" value="" placeholder="კლიენტის მისამართი">
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label for="contactnumber">საკონტაქტო ნომერი:</label>
								<input type="number" required class="form-control" name="contactnumber" value="" placeholder="საკონტაქტო ნომერი">
								<div class="invalid-feedback">შეავსეთ საკონტაქტო ნომერი</div>
							</div>
						</div>
					  </div>
				  </div>
				  <div class="modal-footer">
				  	<button type="submit" id="submitnewuser" class="btn btn-success">დამატება</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">დახურვა</button>
				  </div>
				  </form>
				</div>
			  </div>
			</div>
		</div>
   
   
    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<script>
		$('#newusereg').click(function(e){
			if( ($('#newpassword').val() !== $('#retypepassword').val()) ) {
				
				alert('პაროლები არ ემთხვევა');
				return false;
			}
			else {
				return true;
			}
		});
	</script> 

	<!-- validation -->
	<script>
	// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
		  'use strict';
		  window.addEventListener('load', function() {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.getElementsByClassName('needs-validation');
			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
			  form.addEventListener('submit', function(event) {
				if (form.checkValidity() === false) {
				  event.preventDefault();
				  event.stopPropagation();
				}
				form.classList.add('was-validated');
			  }, false);
			});
		  }, false);
		})();
	</script>


    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
		
		
    </script>

</body>

</html>