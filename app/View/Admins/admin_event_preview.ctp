    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Event Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
               
                <tr>
                  <td> Name</td>
                  <td><?php echo $this->data['Event']['name']; ?>
                         </td>
                </tr>
                
                 <tr>
                  <td>Location</td>
                  <td>
                  <?php echo $this->data['Event']['location']; ?>
                  </td>
                </tr>
                
                 <tr>
                  <td>Start date/time</td>
                  <td>
                   <?php echo $this->data['Event']['start_date'].'/'.$this->data['Event']['start_time']; ?>
                  </td>
                </tr>
                
                 <tr>
                  <td> End date time</td>
                  <td>
                
               <?php echo $this->data['Event']['end_date'].'/'.$this->data['Event']['end_time']; ?>
                  </td>
                </tr>
                
                  <tr>
                  <td> Reminder date / time</td>
                  <td>
                
                <?php echo $this->data['Event']['reminder_date'].'/'.$this->data['Event']['reminder_time']; ?>
                  </td>
                </tr>  
                  <tr>
                  <td> Participants</td>
                  <td>
                
                <?php echo ($this->data['Event']['users'])?$this->data['Event']['users']:'No one'; ?>
                  </td>
                </tr> 
                <tr>
                  <td> Availability</td>
                  <td>
                
                <?php echo ($this->data['Event']['avail']==1)?'YES':'NO'; ?>
                  </td>
                </tr>      
                
             </table>
            </div>
            <!-- /.box-body -->
          </div>
    
    </section>
    <!-- /.content -->
