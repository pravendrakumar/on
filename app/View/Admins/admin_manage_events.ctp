 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Events</h3>
              <?php echo $this->Session->flash();?>
              <div class="box-tools">
               <a href="<?php echo SITE_PATH;?>admin/admins/add_event" class="btn btn-success">Add Event</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Start date/time</th>
                <th>End date/time</th>
                <th>Availability</th>
                <th>Actions</th>
                </tr>
                <?php
				        foreach($eventListing as $listing){ 
			         ?>
                <tr>
					<td><?php echo $listing['Event']['name'];?></td>
					<td><?php echo $listing['Event']['location'];?></td>
					<td><?php echo $listing['Event']['start_date'].'/'.$listing['Event']['start_time'];?></td>
					<td><?php echo $listing['Event']['end_date'].'/'.$listing['Event']['end_time'];?></td>
					<td><?php echo ($listing['Event']['avail']==1)?'YES':'NO';?></td>
				
						 
					<td>
						<?php
					echo $this->Html->link($this->Html->image('Admin/edit.png', array('alt'=>'')), '/admin/admins/edit_event/'.$listing['Event']['id'].'/', array('escape'=>false, 'title'=>'Edit'));
					echo '&nbsp;&nbsp;'.$this->Html->link($this->Html->image('Admin/delete.png', array('alt'=>'')), '/admin/admins/delete_event/'.$listing['Event']['id'].'/', array('escape'=>false, 'title'=>'Delete'), 'Do you really want to delete this event?');
					echo '&nbsp;&nbsp;'.$this->Html->link($this->Html->image('Admin/review.png', array('alt'=>'')), '/admin/admins/event_preview/'.$listing['Event']['id'].'/', array('escape'=>false, 'title'=>'Preview'));
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
