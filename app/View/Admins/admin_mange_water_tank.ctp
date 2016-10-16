 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Water Tanks</h3>
              <?php echo $this->Session->flash();?>
              <div class="box-tools">
               <a href="<?php echo SITE_PATH;?>admin/admins/add_water_tank" class="btn btn-success">Add Water Tank</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Water Tank Name</th>
                   <th>Water Capicity</th>
                   <th>Water Location </th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                <?php
				foreach($userListing as $listing){ //pr($listing);die;
			   ?>
                <tr>
					<td><?php echo $listing['Watertank']['name'];?></td>
					<td><?php echo $listing['Watertank']['water_capicity'];?></td>
					<td><?php echo $listing['Watertank']['location'];?></td>
					<td><?php echo $listing['Watertank']['description'];?></td>
					<td>
						<?php
					if($listing['Watertank']['status'] == '1'){
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

					echo $this->Html->link($this->Html->image($image, array('alt'=>'')), '/admin/admins/water_tank_status/'.$listing['Watertank']['id'].'/'.$new_status.'/', array('escape'=>false, 'title'=>$title), 'Are you sure to '.$msg.' this Water Tank?');
				?>
					
						 </td>
						 
					<td>
						<?php
					echo $this->Html->link($this->Html->image('Admin/edit.png', array('alt'=>'')), '/admin/admins/edit_water_tank/'.$listing['Watertank']['id'].'/', array('escape'=>false, 'title'=>'Edit'));
					echo '&nbsp;&nbsp;'.$this->Html->link($this->Html->image('Admin/delete.png', array('alt'=>'')), '/admin/admins/delete_water_tank/'.$listing['Watertank']['id'].'/', array('escape'=>false, 'title'=>'Delete'), 'Do you really want to delete this water tank?');
					echo '&nbsp;&nbsp;'.$this->Html->link($this->Html->image('Admin/review.png', array('alt'=>'')), '/admin/admins/water_tank_preview/'.$listing['Watertank']['id'].'/', array('escape'=>false, 'title'=>'Preview'));
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
