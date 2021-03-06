    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-10">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Fire Station</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" name="userform" id="userform" enctype="multipart/form-data" action="" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" name="data[Station][name]" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Location</label>
                  <input type="text" name="data[Station][location]" class="form-control" id="exampleInputEmail1" placeholder="Enter location Name">
                </div>
                
                 <div class="form-group">
                  <label for="exampleInputEmail1">Contact No.</label>
                  <input type="text" name="data[Station][contact]" class="form-control" id="exampleInputEmail1" placeholder="Enter contact number">
                </div>
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Station strength</label>
                  <input type="text" name="data[Station][strength]" class="form-control" id="exampleInputPassword1" placeholder="Enter station strength">
                </div>
                
                  <div class="form-group">
                  <label for="exampleInputEmail1">Distance covered by Station</label>
                  <input type="text" name="data[Station][distance]" class="form-control" id="exampleInputEmail1" placeholder="Enter covered distance">
                </div>
                
                 <div class="form-group">
                  <label for="exampleInputEmail1">Distance Type </label>
                  <select name="data[Station][distance_type]">
                    <option value="km">In Km</option>
                    <option value="mile">In Miles</option>
                  </select>
                 
                </div>
                
                  <div class="form-group">
                  <label for="exampleInputEmail1">Alot water vehilces </label>
                  <input type="text" name="data[Station][vehicle]" class="form-control" id="exampleInputEmail1" placeholder="Enter total no. of vehicles">
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
