<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HIS | სისტემაში შესვლა</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/bpg-arial-caps.min.css">
  <style>
    body { font-family: "BPG Arial Caps", sans-serif; }
  </style>
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <span style="color: #008080">HIS</span>ENM
  </div>
  <!-- User name -->
  <div class="lockscreen-name"><?=$firstname . ' ' . $lastname?></div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="<?php echo base_url()?>assets/dist/img/enmedicProfilePlaceholder.png" width="128px" heigh="128px" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <?php $form_attributes = ['class'=>'lockscreen-credentials'];
    echo form_open('UserLogin/returning_user_login', $form_attributes); ?>
      <div class="input-group">
        <input type="password" class="form-control" name="password" placeholder="პაროლი">
        <div class="input-group-append">
          <button type="submit" class="btn">
            <i class="fas fa-arrow-right text-muted"></i>
          </button>
        </div>
      </div>
      <?php echo form_close(); ?>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
<?php if(isset($errorMessage) && $errorMessage !== ''){ ?>
    <div class="alert alert-danger text-center">
        <?=$errorMessage?>
    </div>
<? } ?>
  <div class="help-block text-center">
    სესიის გასაგრძელებლად თავიდან შეიყვანეთ პაროლი
  </div>
  <div class="text-center">
    <a href="login.html">სხვა ექაუნთით შესვლა</a>
  </div>

</div>
<!-- /.center -->

<!-- jQuery -->
<script src="<?php echo base_url()?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>