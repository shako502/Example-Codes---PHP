<footer class="main-footer">
      <strong>Copyright &copy; 2020 HypnoPhobics.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.5
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?=base_url()?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?=base_url()?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.js"></script>
  <!-- Select2 -->
  <script src="<?=base_url()?>assets/plugins/select2/js/select2.full.min.js"></script>
  <!-- DataTables -->
  <script src="<?=base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?=base_url()?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?=base_url()?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?=base_url()?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- ChartJS -->
  <script src="<?=base_url()?>assets/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline 
  <script src="assets/plugins/sparklines/sparkline.js"></script> -->
  <!-- JQVMap 
  <script src="assets/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
  <!-- jQuery Knob Chart -->
  <script src="<?=base_url()?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- jQuery Validator --> 
    <script src="<?=base_url()?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?=base_url()?>assets/plugins/moment/moment.min.js"></script>
  <script src="<?=base_url()?>assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?=base_url()?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?=base_url()?>assets/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- Input Mask -->
  <script src="<?=base_url()?>assets/plugins/inputmask/jquery.inputmask.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?=base_url()?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?=base_url()?>assets/dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?=base_url()?>assets/dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?=base_url()?>assets/dist/js/demo.js"></script>
  <!-- Custom HIS JS -->
  <script src="<?=base_url()?>assets/dist/js/hiscustom.js"></script>
  <!-- Needed html code here -->

  <?php if (isset($js_singlepatient) && $js_singlepatient != '') : ?>

  <script type="text/javascript" src="<?=base_url()?>assets/dist/js/<?=$js_singlepatient;?>"></script>

  <?php endif;?>

  <?php if (isset($js_patientPage) && $js_patientPage != '') : ?>

  <script type="text/javascript" src="<?=base_url()?>assets/dist/js/<?=$js_patientPage;?>"></script>

  <?php endif;?>

  <?php if (isset($js_registerAmbulatory) && $js_registerAmbulatory != '') : ?>
  
  <script type="text/javascript" src="<?=base_url()?>assets/dist/js/<?=$js_registerAmbulatory;?>"></script>

  <?php endif;?>

</body>

</html>