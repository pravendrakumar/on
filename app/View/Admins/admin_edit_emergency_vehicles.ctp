    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-10">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Emergency Vehicle</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" name="userform" id="userform" enctype="multipart/form-data" action="" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" name="data[Vehicle][name]" value="<?php echo $this->data['Vehicle']['name']?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Station</label>
                  <select name="data[Vehicle][station_id]">
                  <?php
                  foreach($stationData as $listing){ 
                    if($listing['Station']['id']==$this->data['Vehicle']['station_id']){
                    echo '<option selected="selected" value="' .$listing['Station']['id'].'">'. $listing['Station']['name'].'</option>';
                    }else{
                     echo '<option  value="' .$listing['Station']['id'].'">'. $listing['Station']['name'].'</option>';
                    }
                   } ?>
                  </select>
                 
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Vehicle Model</label>
                  <input type="text" name="data[Vehicle][model]" value="<?php echo $this->data['Vehicle']['model']?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Model">
                </div>
                
                 <div class="form-group">
                  <label for="exampleInputEmail1">Capacity</label>
                  <input type="text" name="data[Vehicle][capacity]" value="<?php echo $this->data['Vehicle']['capacity']?>" class="form-control" id="exampleInputEmail1" placeholder="Enter capacity">
                </div>
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Vehicle Number</label>
                  <input type="text" name="data[Vehicle][number]" value="<?php echo $this->data['Vehicle']['number']?>"class="form-control" id="exampleInputPassword1" placeholder="Enter station strength">
                </div>
                
                <input type="hidden" name="data[Vehicle][id]" value="<?php echo $this->data['Vehicle']['id']?>"class="form-control" >
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
