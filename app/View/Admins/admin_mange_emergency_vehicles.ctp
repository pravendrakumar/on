<?php //pr($fireListing); ?>

 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Emergency Vehicles</h3>
              <?php echo $this->Session->flash();?>
              <div class="box-tools">
               <a href="<?php echo SITE_PATH;?>admin/admins/add_emergency_vehicles" class="btn btn-success">Add Vehicle</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                <th>Name</th>
                <th>Station</th>
                <th>Model Number</th>
                <th>Vehicle number</th>
                <th>Capacity</th>
                <th>Actions</th>
                </tr>
                <?php
				        foreach($fireListing as $listing){ //pr($listing);die;
			         ?>
                <tr>
					<td><?php echo $listing['Vehicle']['name'];?></td>
					<td><?php echo $listing['Station']['name'];?></td>
					<td><?php echo $listing['Vehicle']['model'];?></td>
					<td><?php echo $listing['Vehicle']['number'];?></td>
					<td><?php echo $listing['Vehicle']['capacity'];?></td>
				
						 
					<td>
						<?php
					echo $this->Html->link($this->Html->image('Admin/edit.png', array('alt'=>'')), '/admin/admins/edit_emergency_vehicles/'.$listing['Vehicle']['id'].'/', array('escape'=>false, 'title'=>'Edit'));
					echo '&nbsp;&nbsp;'.$this->Html->link($this->Html->image('Admin/delete.png', array('alt'=>'')), '/admin/admins/delete_emergency_vehicles/'.$listing['Vehicle']['id'].'/', array('escape'=>false, 'title'=>'Delete'), 'Do you really want to delete this User?');
					echo '&nbsp;&nbsp;'.$this->Html->link($this->Html->image('Admin/review.png', array('alt'=>'')), '/admin/admins/emergency_vehicles_preview/'.$listing['Vehicle']['id'].'/', array('escape'=>false, 'title'=>'Preview'));
				?>
						 </td>
                </tr>
                <?php }?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
