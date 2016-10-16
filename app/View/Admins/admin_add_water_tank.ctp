    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-10">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Water Tank</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" name="userform" id="userform" enctype="multipart/form-data" action="" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Water Tank Name</label>
                  <input type="text" name="data[Watertank][name]" class="form-control" id="exampleInputEmail1" placeholder="Enter Water Tank Name">
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Water Capicity</label>
                  <input type="text" name="data[Watertank][water_capicity]" class="form-control" id="exampleInputEmail1" placeholder="Enter Water Capicity">
                </div>
                
                 <div class="form-group">
                  <label for="exampleInputEmail1">Location</label>
                  <input type="text" name="data[Watertank][location]" class="form-control" id="exampleInputEmail1" placeholder="Enter Location">
                </div>
                
                              
                  <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <textarea type="text" name="data[Watertank][description]" class="form-control" id="exampleInputEmail1" placeholder="Enter Description"></textarea>
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
