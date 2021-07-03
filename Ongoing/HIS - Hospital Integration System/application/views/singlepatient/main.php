    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <div class="container-fluid">

        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-lg-2 text-center">
                <h1 class="m-0 text-dark"><?php echo $patient_fullName ?></h1>
                <img class="img-thumbnail rounded singlepatient-picture" width="" src="<?php echo base_url()?>assets/dist/img/enmedicProfilePlaceholder.png" />
              </div>
              <div class="col-lg-8 border rounded-right text-center">
                <div class="d-inline-block mx-2">
                  <h4 class="mt-3 text-secondary singlepatient-info-heading">პირადი ნომერი</h4>
                  <span class="mt-1 singlepatient-info"><?php echo $patient_ID ?></span>
                </div>
                <div class="d-inline-block mx-2">
                  <h4 class="mt-3 text-secondary singlepatient-info-heading">დაბადების თარიღი</h4>
                  <span class="mt-1 singlepatient-info"><?php echo $patient_birthdate ?></span>
                </div>
                <div class="d-inline-block mx-2">
                  <h4 class="mt-3 text-secondary singlepatient-info-heading">სქესი</h4>
                  <span class="mt-1 singlepatient-info"><?php echo $patient_sex ?></span>
                </div>
                <div class="d-inline-block mx-2">
                  <h4 class="mt-3 text-secondary singlepatient-info-heading">მობ. ნომერი</h4>
                  <span class="mt-1 singlepatient-info singlepatient-i-editable"><?php echo $patient_phoneNumber ?></span>
                </div>
                <div class="d-inline-block mx-2">
                  <h4 class="mt-3 text-secondary singlepatient-info-heading">Email</h4>
                  <span class="mt-1 singlepatient-info singlepatient-longtext singlepatient-i-editable text-truncate"><?php echo $patient_email ?></span>
                </div>
              </div>
            </div>
            <!-- <div class="row mb-2 ">
            <div class="col-sm-6 col-lg-2 d-flex justify-content-center">
                <img class="img-thumbnail rounded" width="auto" height="20%" src="<?php echo base_url()?>assets/dist/img/enmedicProfilePlaceholder.png" />
            </div>
              <div class="col-sm-6 col-lg-2 text-center">
                <h1 class="m-0 text-dark"><?php echo $patient_fullName ?></h1>
                <h4 class="mt-3 text-secondary">პირადი ნომერი</h4>
                <span class="mt-1 singlepatient-info singlepatient-i-editable"><?php echo $patient_ID ?></span>
                <h4 class="mt-3 text-secondary">დაბადების თარიღი</h4>
                <span class="mt-1 singlepatient-info singlepatient-i-editable"><?php echo $patient_birthdate ?></span>
                <h4 class="mt-3 text-secondary">სქესი</h4>
                <span class="mt-1 singlepatient-info"><?php echo $patient_sex ?></span>
                <h4 class="mt-3 text-secondary">ტელეფონის ნომერი</h4>
                <span class="mt-1 singlepatient-info singlepatient-i-editable"><?php echo $patient_phoneNumber ?></span>
              </div>
            </div> .row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

      </div><!-- /.container-fluid -->
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->