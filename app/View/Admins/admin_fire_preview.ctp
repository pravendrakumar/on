    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Station Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
               
                <tr>
                  <td>Station Name</td>
                  <td><?php echo $this->data['Station']['name']; ?>
                         </td>
                </tr>
                
                 <tr>
                  <td>Location</td>
                  <td>
                  <?php echo $this->data['Station']['location']; ?>
                  </td>
                </tr>
                
                 <tr>
                  <td>Contact no</td>
                  <td>
                   <?php echo $this->data['Station']['contact']; ?>
                  </td>
                </tr>
                
                 <tr>
                  <td> Station strength</td>
                  <td>
                
                <?php echo $this->data['Station']['strength']; ?>
                  </td>
                </tr>
                
                
                 <tr>
                  <td>Distance</td>
                  <td>
                  <?php echo $this->data['Station']['distance']; ?>
                  </td>
                </tr>
                
                
                 <tr>
                  <td>Distance type </td>
                  <td>
                   <?php echo $this->data['Station']['distance_type']; ?>
                  </td>
                </tr>
               
                
             </table>
            </div>
            <!-- /.box-body -->
          </div>
    
    </section>
    <!-- /.content -->
