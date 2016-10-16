 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Calls</h3>
              <?php echo $this->Session->flash();?>
              <div class="box-tools">
               <a href="<?php echo SITE_PATH;?>admin/admins/add_fire_station" class="btn btn-success">Add Station</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                <th>Station Name</th>
                <th>Location</th>
                <th>Contact No </th>
                <th>Strength</th>
                <th>Distance</th>
                <th>Actions</th>
                </tr>
                <?php
				foreach($fireListing as $listing){ //pr($listing);die;
			   ?>
                <tr>
					<td><?php echo $listing['Station']['name'];?></td>
					<td><?php echo $listing['Station']['location'];?></td>
					<td><?php echo $listing['Station']['contact'];?></td>
					<td><?php echo $listing['Station']['strength'];?></td>
					<td><?php echo $listing['Station']['distance'].' '.$listing['Station']['distance_type'];?></td>
				
						 
					<td>
						<?php
					echo $this->Html->link($this->Html->image('Admin/edit.png', array('alt'=>'')), '/admin/admins/edit_station/'.$listing['Station']['id'].'/', array('escape'=>false, 'title'=>'Edit'));
					echo '&nbsp;&nbsp;'.$this->Html->link($this->Html->image('Admin/delete.png', array('alt'=>'')), '/admin/admins/delete_station/'.$listing['Station']['id'].'/', array('escape'=>false, 'title'=>'Delete'), 'Do you really want to delete this User?');
					echo '&nbsp;&nbsp;'.$this->Html->link($this->Html->image('Admin/review.png', array('alt'=>'')), '/admin/admins/fire_preview/'.$listing['Station']['id'].'/', array('escape'=>false, 'title'=>'Preview'));
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
