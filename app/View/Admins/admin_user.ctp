 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage User</h3>
              <?php echo $this->Session->flash();?>
              <div class="box-tools">
               <a href="<?php echo SITE_PATH;?>admin/admins/add_user" class="btn btn-success">Add User</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>First Name</th>
                   <th>Last  Name</th>
                   <th>Email </th>
                  <th>Department</th>
                   <th>Station</th>
                  <th>Rank</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                <?php
				foreach($userListing as $listing){ //pr($listing);die;
			   ?>
                <tr>
					<td><?php echo $listing['User']['first_name'];?></td>
					<td><?php echo $listing['User']['last_name'];?></td>
					<td><?php echo $listing['User']['email'];?></td>
					<td><?php echo $listing['User']['department'];?></td>
					<td><?php echo $listing['User']['station_number'];?></td>
					<td><?php echo $listing['User']['rank'];?></td>
					<td>
						<?php
					if($listing['User']['status'] == '1'){
						$title = 'Deactivate';
						$image = 'Admin/activate.png';
						$new_status = '2';
						$msg = 'deactivate';
					}else{
						$title = 'Activate';
						$image = 'Admin/deactivate.png';
						$new_status = '1';
						$msg = 'activate';
					}

					echo $this->Html->link($this->Html->image($image, array('alt'=>'')), '/admin/admins/user_status/'.$listing['User']['id'].'/'.$new_status.'/', array('escape'=>false, 'title'=>$title), 'Are you sure to '.$msg.' this User?');
				?>
					
						 </td>
						 
					<td>
						<?php
					echo $this->Html->link($this->Html->image('Admin/edit.png', array('alt'=>'')), '/admin/admins/edit_user/'.$listing['User']['id'].'/', array('escape'=>false, 'title'=>'Edit'));
					echo '&nbsp;&nbsp;'.$this->Html->link($this->Html->image('Admin/delete.png', array('alt'=>'')), '/admin/admins/delete_user/'.$listing['User']['id'].'/', array('escape'=>false, 'title'=>'Delete'), 'Do you really want to delete this User?');
					echo '&nbsp;&nbsp;'.$this->Html->link($this->Html->image('Admin/review.png', array('alt'=>'')), '/admin/admins/preview/'.$listing['User']['id'].'/', array('escape'=>false, 'title'=>'Preview'));
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
