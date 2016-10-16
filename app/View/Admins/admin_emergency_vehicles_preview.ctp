    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Vehicle Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
               
                <tr>
                  <td> Name</td>
                  <td><?php echo $this->data['Vehicle']['name']; ?>
                         </td>
                </tr>
                
                 <tr>
                  <td>Station</td>
                  <td>
                  <?php echo $this->data['Station']['name']; ?>
                  </td>
                </tr>
                
                 <tr>
                  <td>Model  no</td>
                  <td>
                   <?php echo $this->data['Vehicle']['model']; ?>
                  </td>
                </tr>
                
                 <tr>
                  <td> Capacity</td>
                  <td>
                
                <?php echo $this->data['Vehicle']['capacity']; ?>
                  </td>
                </tr>
                
                  <tr>
                  <td> Number</td>
                  <td>
                
                <?php echo $this->data['Vehicle']['number']; ?>
                  </td>
                </tr>       
                
             </table>
            </div>
            <!-- /.box-body -->
          </div>
    
    </section>
    <!-- /.content -->
