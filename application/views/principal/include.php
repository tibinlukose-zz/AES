<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                                    <?php if(validation_errors()){
                                                        if($this->input->post('passform')==1){
                                                            
                                                     
               ?>
              
            <div class="alert alert-danger alert-dismissable">
                                
                               <?php echo validation_errors();?>
                            </div>
            <?php 
                                                        }
            }
              ?> 
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <form action="<?php echo base_url("/principal/changepassword");?>" method="post">
                                                <label>Current Password</label><input  required style="width:40%;" type="password" name="current" class="form-control">
                                            <label>New Password</label><input  required style="width:40%;" type="password" name="newpassword" class="form-control">
                                            <label>Confirm Password</label><input required style="width:40%;" type="password" name="confirm" class="form-control">
                                            <input type="hidden" value="1" name="passform">
                                            </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <input type="submit" value="Save changes" class="btn btn-primary">
                                           
                                        </div>
                                         </form>
                                        
                                    </div>
                                    
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
             <div class="modal fade" id="myProfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <?php if(validation_errors()){
                                            if($this->input->post('passform')<>1){
               ?>
              
            <div class="alert alert-danger alert-dismissable">
                                
                               <?php echo validation_errors();?>
                            </div>
            <?php 
                                        }       }
              ?> 
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <form action="<?php echo base_url("/principal/changeprofile");?>" method="post">
                                                <label>Your Name</label><input  value="<?php echo $this->session->userdata('name');?>" required style="width:40%;" type="text" name="name" class="form-control">
                                           <label>Your Email</label><input value="<?php echo $this->session->userdata('email');?>" required style="width:40%;" type="email" name="email" class="form-control">
                                      <label>Your Mobile Number</label><input value="<?php echo $this->session->userdata('phone');?>" required style="width:40%;" type="number" name="phone" class="form-control">

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
                    <div class="col-lg-12">
                        
                        <h1>
