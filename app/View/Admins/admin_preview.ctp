    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">User Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
               
                <tr>
                  <td>First Name</td>
                  <td><?php echo $this->data['User']['first_name']; ?>
                         </td>
                </tr>
                
                 <tr>
                  <td>Last Name</td>
                  <td>
                  <?php echo $this->data['User']['last_name']; ?>
                  </td>
                </tr>
                
                 <tr>
                  <td>Email</td>
                  <td>
                   <?php echo $this->data['User']['email']; ?>
                  </td>
                </tr>
                
                 <tr>
                  <td> Station Number</td>
                  <td>
                
                <?php echo $this->data['User']['station_number']; ?>
                  </td>
                </tr>
                
                
                 <tr>
                  <td>Department</td>
                  <td>
                  <?php echo $this->data['User']['department']; ?>
                  </td>
                </tr>
                
                
                 <tr>
                  <td>Rank</td>
                  <td>
                   <?php echo $this->data['User']['rank']; ?>
                  </td>
                </tr>
                
                 <tr>
                  <td>Id Number</td>
                  <td>
                 <?php echo $this->data['User']['id_number']; ?>
                  </td>
                </tr>
                
                 <tr>
                  <td>Cell Number</td>
                  <td>
                    <?php echo $this->data['User']['cell_number']; ?>
                  </td>
                </tr>
                
                
                 <tr>
                  <td>Emergency Number</td>
                  <td>
                    <?php echo $this->data['User']['eme_number']; ?>
                  </td>
                </tr>
                
                
                 <tr>
                  <td>Image</td>
                  <td>
                    <?php
								$imagePath = '../webroot/img/Users/'.$this->data['User']['image'];
								if(is_file($imagePath)){
									$imagePath = 'Users/'.$this->data['User']['image'];
									echo $this->Image->resize($imagePath, 100, 100);
								}
							?>
                  </td>
                </tr>
                
                 <td>Image</td>
                  <td>
                <?php echo $this->data['User']['driver']; ?>
                  </td>
                </tr>
                
             </table>
            </div>
            <!-- /.box-body -->
          </div>
    
    </section>
    <!-- /.content -->
