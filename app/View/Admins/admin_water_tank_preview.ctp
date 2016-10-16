    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Water Tank Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
               
                <tr>
                  <td>Water Tank Name</td>
                  <td><?php echo $this->data['Watertank']['name']; ?>
                         </td>
                </tr>
                
                 <tr>
                  <td>Water Capicity</td>
                  <td>
                  <?php echo $this->data['Watertank']['water_capicity']; ?>
                  </td>
                </tr>
                
                 <tr>
                  <td>Location</td>
                  <td>
                   <?php echo $this->data['Watertank']['location']; ?>
                  </td>
                </tr>
                
                 <tr>
                  <td> Description</td>
                  <td>
                
                <?php echo $this->data['Watertank']['description']; ?>
                  </td>
                </tr>
                
             </table>
            </div>
            <!-- /.box-body -->
          </div>
    
    </section>
    <!-- /.content -->
