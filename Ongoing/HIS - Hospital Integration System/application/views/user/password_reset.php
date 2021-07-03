<!DOCTYPE html>
<html>
<?php
if (isset($this->session->userdata['logged_in'])) {
  $baseurl = base_url();
  header("location: ". $baseurl ."UserLogin/user_login_process");
}
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HIS | სისტემაში შესვლა</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro 
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->

  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/bpg-arial-caps.min.css">
  <style>
    body {
      font-family: "BPG Arial Caps", sans-serif;
    }

    .icheck-primary label {
      font-size: 10pt;
    }
  </style>
  <script>var base_url = '<?php echo base_url() ?>';</script>
</head>

<body class="hold-transition login-page">

  <div class="login-box">
    <div class="login-logo">
      <img src="<?=base_url()?>assets/dist/img/logo-sm.png" alt="Logo">
    </div>
    <!-- /.login-logo -->
    <?php if(!isset($Error) || $Error == ''){ ?>
    <div class="card" id="main-login-card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">შეიყვანეთ ახალი პაროლი</p>

        <div class="input-group mb-3">
          <input type="password" name="newPassword" id="newPassword" class="form-control" placeholder="ახალი პაროლი">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="retypePassword" id="retypePassword" class="form-control" placeholder="გაიმეორეთ პაროლი">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <input type="hidden" value="<?=$UserID?>" id="userID" name="userID" />
            <button type="button" id="submitReset" class="btn btn-info btn-block">შეცვლა</button>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.login-card-body -->
    </div>
    <?php }
      else {?>
        <div class="text-center"><?=$Error?></div>
      <?php }
    ?>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?php echo base_url()?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url()?>assets/dist/js/adminlte.min.js"></script>
  <!-- Login Handler JS -->
  <script src="<?=base_url()?>assets/dist/js/login/loginPage.js"></script>

</body>

</html>