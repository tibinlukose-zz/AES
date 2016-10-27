

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <?php if(validation_errors()){
                
                
               ?>
            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                               <?php echo validation_errors();?>
                            </div>
            <?php 
            }
              ?>  
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <form action="<?php echo base_url("/office/changepassword");?>" method="post">
                                                <label>Current Password</label><input  required style="width:40%;" type="password" name="current" class="form-control">
                                            <label>New Password</label><input  required style="width:40%;" type="password" name="newpassword" class="form-control">
                                            <label>Confirm Password</label><input required style="width:40%;" type="password" name="confirm" class="form-control">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <input type="submit" value="Save changes" class="btn btn-primary">
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
             <div class="modal fade" id="myProfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <form action="<?php echo base_url("/office/changeprofile");?>" method="post">
                                                <label>Your Name</label><input  value="<?php echo $this->session->userdata('name');?>" required style="width:40%;" type="text" name="name" class="form-control">
                                           <label>Your Email</label><input value="<?php echo $this->session->userdata('email');?>" required style="width:40%;" type="email" name="email" class="form-control">
                                      <label>Your Mobile Number</label><input value="<?php echo $this->session->userdata('phone');?>" required style="width:40%;" type="number" name="phone" class="form-control">

                                           </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <input type="submit" value="Save changes" class="btn btn-primary">
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

            <!-- Included by Sriram for Modal Window-->
            <!-- /.row -->
           
            <!-- /.row -->
           
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url("asset");?>/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("asset");?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url("asset");?>/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url("asset");?>/bower_components/raphael/raphael-min.js"></script>
    <script src="<?php echo base_url("asset");?>/bower_components/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url("asset");?>/js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url("asset");?>/dist/js/sb-admin-2.js"></script>

</body>

</html>
