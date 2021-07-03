    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">პაციენტის რეგისტრაცია</h1>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="container">
          <form id="patient-form">
            <div class="row">
              <div class="col-lg-12 mb-3 d-flex justify-content-between">
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" id="check-patient-unknown" name="check-patient-unknown" value="unknown" />
                  <label for="check-patient-unknown" class="form-check-label"><b>უცნობი პაციენტი</b></label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" id="check-patient-placement" name="check-patient-placement" value="patient-stationary-value" />
                  <label for="check-patient-placement" class="form-check-label"><b>სტაციონარი</b></label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="patient-idnumber">პირადი ნომერი</label>
                  <input type="text" class="form-control" id="patient-idnumber" placeholder="XXXXXXXXXXX" name="patient-idnumber" />
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="patient-name">სახელი</label>
                  <input type="text" class="form-control" data-geokb="true" id="patient-name" placeholder="სახელი" name="patient-name" required />
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="patient-lastname">გვარი</label>
                  <input type="text" class="form-control"  data-geokb="true" id="patient-lastname" placeholder="გვარი" name="patient-lastname" required />
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="patient-birthdate">დაბადების თარიღი</label>
                  <input type="text" class="form-control" data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'" placeholder="დღე/თვე/წელი" id="patient-birthdate" name="patient-birthdate" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="patient-sex">სქესი</label>
                  <select id="patient-sex" name="patient-sex" class="form-control">
                    <option value="">აირჩიეთ...</option>
                    <option value="male">მამრობითი</option>
                    <option value="female">მდედრობითი</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="patient-phonenumber">მობ. ნომერი</label>
                  <input type="text" class="form-control" id="patient-phonenumber" data-inputmask="'mask': '999-99-99-99'" placeholder="5XX-XX-XX-XX" name="patient-phonenumber" />
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="patient-email">E-Mail</label>
                  <input type="email" class="form-control" id="patient-email" placeholder="name@mail.com" name="patient-email" />
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="patient-address">იურიდიული მისამართი</label>
                  <input type="text" class="form-control" data-geokb="true" placeholder="თბილისი, ..." id="patient-address" name="patient-address" required />
                </div>
              </div>
            </div>

            <div class="row" id="patient-unknown-commentary-box">
              <div class="form-group col-lg-12">
                <label for="patient-unknown-commentary">შენიშვნა / კომენტარი</label>
                <textarea class="form-control" data-geokb="true" name="patient-unknown-commentary" id="patient-unknown-commentary" rows="3"></textarea>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12 d-flex justify-content-between">
                <input type="hidden" id="baseurl" value="<?php echo base_url(); ?>">
                <input type="hidden" name="patient-add-info-checker" id="patient-add-info-checker" value="" />
                <button type="button" id="patient-additional-info-btn" class="btn btn-secondary" data-toggle="modal" data-target="#patient-additional-info"><i class="fa fa-info" aria-hidden="true"></i>&nbsp; დამატებითი ინფორმაცია</button>
                <button type="submit" class="btn btn-info btn-lg"><i class="fa fa-plus" aria-hidden="true"></i> დამატება</button>
              </div>
            </div>
          </form>
        </div><!-- /.container -->

        <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">ბოლო პაციენტები</h1>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="container">
          <table id="lastPatients" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ისტ.N</th>
                <th>სახელი</th>
                <th>გვარი</th>
                <th>პირადი ნომერი</th>
                <th>თარიღი</th>
              </tr>
              </thead>
              <tbody>
                
              </tbody>
          </table>
        </div>

      </div><!-- /.container-fluid -->
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->