  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo SITE_PATH;?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Welcome <?php echo ucwords($this->Session->read('Auth.Admin.Admin.username'));?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="<?php echo SITE_PATH;?>admin/admins/user">
            <i class="fa fa-dashboard"></i> <span>User Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
         </li>
         
         <li class="active treeview">
          <a href="<?php echo SITE_PATH;?>admin/admins/mange_water_tank">
            <i class="fa fa-dashboard"></i> <span>Water Tanks Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
         </li>
         
         <li class="active treeview">
          <a href="<?php echo SITE_PATH;?>admin/admins/manage_fire_station">
            <i class="fa fa-dashboard"></i> <span>Fire Stations Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
         </li>
         
         <li class="active treeview">
          <a href="<?php echo SITE_PATH;?>admin/admins/manage_group">
            <i class="fa fa-dashboard"></i> <span>Group Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
         </li>
         
         <li class="active treeview">
          <a href="<?php echo SITE_PATH;?>admin/admins/mange_emergency_vehicles">
            <i class="fa fa-dashboard"></i> <span>Emergency Vehicles Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
         </li>
         
          
         <li class="active treeview">
          <a href="<?php echo SITE_PATH;?>admin/admins/manage_log_call">
            <i class="fa fa-dashboard"></i> <span>Call Log Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
         </li>
         <li class="active treeview">
          <a href="<?php echo SITE_PATH;?>admin/admins/manage_events">
            <i class="fa fa-dashboard"></i> <span>Event Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
         </li>         

        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Reports</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">10</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Dashboard Report</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Incident</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Incident By Locations</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> On Scene</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> On Scene (Y M)</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> On Scene Trend</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Incident Contentment</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Incident Contentment (Y-M)</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Incident Contentment (Y-Y)</a></li>
          </ul>
        </li>
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
