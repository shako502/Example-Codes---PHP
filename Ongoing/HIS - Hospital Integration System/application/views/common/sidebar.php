 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-cyan elevation-4">
      <!-- Brand Logo -->
      <a href="<?=base_url()?>" class="brand-link">
        <img src="<?=base_url()?>assets/dist/img/logo-sm.png" alt="ENM Logo" class="brand-image" style="opacity: .8">
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="#" class="d-block"><?php echo $firstname . ' ' . $lastname ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar nav-flat flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="/" class="nav-link <?php if($this->uri->segment(1)==""){echo 'active';}?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  მთავარი
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview" id="patient-treeview">
              <a href="<?php echo base_url() ?>patient" class="nav-link <?php if($this->uri->segment(1)=="patient"){echo 'active open-cat';}?>">
                <i class="nav-icon ion ion-person"></i>
                <p>
                  პაციენტი
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">6</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo base_url() ?>ambulatory" class="nav-link <?php if($this->uri->segment(1)=="ambulatory"){echo 'active open-cat';}?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>ამბულატორია</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url() ?>stationary" class="nav-link <?php if($this->uri->segment(1)=="stationary"){echo 'active open-cat';}?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>სტაციონარი</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url() ?>cashier" class="nav-link <?php if($this->uri->segment(1)=="cashier"){echo 'active';}?>">
                <i class="nav-icon ion ion-card"></i>
                <p>
                  სალარო
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon ion ion-fork-repo"></i>
                <p>
                  კვლევები
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>