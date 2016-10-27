    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-10">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update  Event</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" name="userform" id="eventform" enctype="multipart/form-data" action="" method="post">
              <div class="box-body">
                <?php echo $this->Form->input('Event.id',array('type'=>'hidden')); ?>
                <div class="form-group">
                  <?php echo $this->Form->input('Event.name',array('label'=>false,'div'=>false,'type'=>'text','required'=>true,'placeholder'=>'Event Name','class'=>'form-control')); ?>
                
                </div>
                <div class="form-group">
                
                <?php echo $this->Form->input('Event.location',array('label'=>false,'div'=>false,'type'=>'text','required'=>true,'placeholder'=>'Enter Event Location','class'=>'form-control')); ?>
                </div>
                
                 <div class="form-group">
                  <label for="exampleInputEmail1">Start</label>
                  <div class="row">
                    <div class="col-md-6">
                    <?php echo $this->Form->input('Event.start_date',array('label'=>false,'div'=>false,'type'=>'text','required'=>true,'placeholder'=>'pick  start date','class'=>'form-control','id'=>'startdate1')); ?>
                   </div>
                   <div class="col-md-4">
                  
                    <?php echo $this->Form->input('Event.start_time',array('label'=>false,'div'=>false,'type'=>'text','required'=>true,'placeholder'=>'pick  time','class'=>'form-control','id'=>'starttime1')); ?>
                   </div>
                  </div>
                </div>
                
                <div class="form-group">
                   <label for="exampleInputPassword1">End</label>
                  <div class="row">
                  <div class="col-md-6">
                   <?php echo $this->Form->input('Event.end_date',array('label'=>false,'div'=>false,'type'=>'text','required'=>true,'placeholder'=>'pick  end date','class'=>'form-control','id'=>'endtdate1')); ?>
                  </div>
                   <div class="col-md-4">
                   
                     <?php echo $this->Form->input('Event.end_time',array('label'=>false,'div'=>false,'type'=>'text','required'=>true,'placeholder'=>'pick  time','class'=>'form-control','id'=>'endtime1')); ?>
                  </div>
                </div>
                </div>
                
                <div class="form-group">
                  <?php echo $this->Form->input('Event.description',array('label'=>false,'div'=>false,'type'=>'textarea','required'=>true,'placeholder'=>'Description','class'=>'form-control')); ?>
                 
                </div>
                  
                <div class="form-group">
                  <label for="exampleInputEmail1">Reminder</label>
                  <div class="row">
                  <div class="col-md-6">
                   <?php echo $this->Form->input('Event.reminder_date',array('label'=>false,'div'=>false,'type'=>'text','required'=>true,'placeholder'=>'pick date','class'=>'form-control','id'=>'reminderdate')); ?>
                  </div>
                   <div class="col-md-4">
                   
                     <?php echo $this->Form->input('Event.reminder_time',array('label'=>false,'div'=>false,'type'=>'text','required'=>true,'placeholder'=>'pick  time','class'=>'form-control','id'=>'remindertime')); ?>
                  </div>
                </div>
                 
                </div>  
                <div class="form-group">
                  <label for="exampleInputEmail1">Participants</label>
               <?php  
                $puserArr = explode(',',$this->data['Event']['participant']);
               foreach($userData as $listing){ ?>
                  <div class="row">
                    <div class="col-md-6">
                      <?php echo $listing['User']['name'];?>
                    </div>
                    <div class="col-md-6">
                    <input value="<?php echo $listing['User']['id'];?>" type="checkbox" <?php if(in_array($listing['User']['id'], $puserArr)){ echo 'checked="checked"';}?> name="data[Event][participant][]">
                    </div>
                  </div>
                  <?php } ?>
                 
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Available</label>
                  <?php
            $options = array(
                '1' => 'YES',
                '0' => 'NO'
            );

            $attributes = array(
                'legend' => false,
                //'value' => 1
            );

            echo $this->Form->radio('Event.avail', $options, $attributes);

                  ?>
                </div>

              <!-- /.box-body -->
              <div class="box-footer">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
