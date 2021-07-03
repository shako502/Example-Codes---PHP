    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <div class="container-fluid">
        <div class="container">

          <form id="patient-ambulatory-form">
            <div class="row">

              <div class="col-lg-6 col-md-12 border-right">

                <!-- Content Header (Page header) -->
                <div class="content-header">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <h1 class="m-0 text-dark">დამატება</h1>
                      </div><!-- /.col -->
                    </div><!-- /.row -->
                  </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <div class="row">
                  <div class="col-lg-12">
                    <div class="dropdown">
                      <input class="form-control" id="search-tests-input" autocomplete="off" type="text" placeholder="მოძებნეთ კვლევა" name="search-tests-input" aria-label="ძებნა">
                      <div class="dropdown-menu dropdown-menu-lg" id="search-tests-dropdown" aria-labelledby="search-tests-input">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="test-parameters" style="display:none;">
                  <!-- Content Header (Page header) -->
                  <div class="content-header">
                    <div class="container-fluid">
                      <div class="row mb-2">
                        <div class="col-sm-6">
                          <h5 class="m-0 text-dark">კვლევის პარამეტრები</h5>
                        </div><!-- /.col -->
                      </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                  </div>
                  <!-- /.content-header -->
                </div>

                <div class="row mt-3">
                  <div class="col-lg-6 col-md-12">
                    <input type="button" id="add-test-btn" value="დამატება" class="btn btn-info" />
                  </div>
                </div>

              </div>

              <div class="col-lg-6 col-md-12">

                <!-- Content Header (Page header) -->
                <div class="content-header">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <h5 class="m-0 text-dark">დამატებული კვლევები/კონსულტაციები</h5>
                      </div><!-- /.col -->
                    </div><!-- /.row -->
                  </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- DataTables For Added Tests -->
                <table id="added-data-table" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>კოდი</th>
                      <th>დასახელება</th>
                      <th>ფასი</th>
                      <th>შეცვლა</th>
                      <th>წაშლა</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
                <!-- /.Datatables -->
              </div>
            </div>
          </form>

        </div><!-- /.container -->
      </div><!-- /.container-fluid -->
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->