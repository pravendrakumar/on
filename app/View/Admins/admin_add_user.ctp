    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-10">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" name="userform" id="userform" enctype="multipart/form-data" action="" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">First Name</label>
                  <input type="text" name="data[User][first_name]" class="form-control" id="exampleInputEmail1" placeholder="Enter First Name">
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Last Name</label>
                  <input type="text" name="data[User][last_name]" class="form-control" id="exampleInputEmail1" placeholder="Enter Last Name">
                </div>
                
                 <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="text" name="data[User][email]" class="form-control" id="exampleInputEmail1" placeholder="Enter Email">
                </div>
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                
                  <div class="form-group">
                  <label for="exampleInputEmail1">Station Number</label>
                  <input type="text" name="data[User][station_number]" class="form-control" id="exampleInputEmail1" placeholder="Enter Station Number">
                </div>
                
                 <div class="form-group">
                  <label for="exampleInputEmail1">Department</label>
                  <input type="text" name="data[User][department]" class="form-control" id="exampleInputEmail1" placeholder="Enter Department">
                </div>
                
                  <div class="form-group">
                  <label for="exampleInputEmail1">Rank</label>
                  <input type="text" name="data[User][rank]" class="form-control" id="exampleInputEmail1" placeholder="Enter Rank">
                </div>
                
                 <div class="form-group">
                  <label for="exampleInputEmail1">Id Number</label>
                  <input type="text" name="data[User][id_number]" class="form-control" id="exampleInputEmail1" placeholder="Enter Id Number">
                </div>
                
                 <div class="form-group">
                  <label for="exampleInputEmail1">Cell Number</label>
                  <input type="text" name="data[User][cell_number]" class="form-control" id="exampleInputEmail1" placeholder="Enter Cell Number">
                </div>
                
                
                 <div class="form-group">
                  <label for="exampleInputEmail1">Emergency Number</label>
                  <input type="text" name="data[User][eme_number]" class="form-control" id="exampleInputEmail1" placeholder="Enter Emergency Number">
                </div>
                
                 <div class="form-group">
                  <label for="exampleInputEmail1">Upload Image</label>
                  <input type="file" name="data[User][image]" class="form-control">
                </div>
                
                 <div class="input-group">Driver
                        <span class="input-group-addon">
                          Yes<input name="data[User][driver]" value="YES"  type="radio">
                        </span>
                   <span class="input-group-addon">
                          No<input name="data[User][driver]" value="NO"  type="radio">
                        </span>
                  </div>
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
