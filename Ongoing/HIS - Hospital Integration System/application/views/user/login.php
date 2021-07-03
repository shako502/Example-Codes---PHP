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

    #forget-password-card {
      display: none;
    }
  </style>
  <script>var base_url = '<?php echo base_url() ?>';</script>
</head>

<body class="hold-transition login-page">

  <div class="login-box">
    <div class="login-logo">
      <img src="<?=base_url()?>assets/dist/img/logo-sm.png" alt="Logo">
    </div>
    <?php if(isset($message_display) && $message_display != ''){
    ?>
    <div class="alert alert-info text-center"><?=$message_display?></div>
    <?php
    } ?>
    <!-- /.login-logo -->
    <div class="card" id="main-login-card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">შეიყვანეთ თქვენი მონაცემები</p>

        <?php echo form_open('UserLogin/user_login_process'); ?>
        <?php
        echo "<div class='error_msg'>";

        if (isset($error_message)) {
          echo $error_message;
        }

        echo validation_errors();
        echo "</div>";
        ?>
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="მომხმარებლის სახელი">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="პაროლი">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember-me" value="yes" id="remember-me">
              <label for="remember-me">
                ავტომატური შესვლა
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="submit" class="btn btn-info btn-block">შესვლა</button>
          </div>
          <!-- /.col -->
        </div>
        <?php echo form_close(); ?>

        <p class="mb-1">
          <a href="#" id="forget-password-btn">პაროლი დამავიწყდა</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>

    <div class="card" id="forget-password-card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">შეიყვანეთ თქვენი Email</p>

        <div class="input-group mb-3">
          <input type="email" id="email-for-reset" name="email-for-reset" class="form-control" placeholder="თქვენი E-mail">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
       
        <div class="row">
          <div class="col-lg-4">
            <button type="button" id="back-on-login" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> უკან</button>
          </div>
          <div class="col-lg-8">
            <button type="button" id="reset-password" class="btn btn-info btn-block">პაროლის აღდგენა</button>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.login-card-body -->
    </div>
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