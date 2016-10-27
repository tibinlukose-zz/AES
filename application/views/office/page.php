<?php

/* 
 * License under Pirates of mac Valley.
 * Developed by Navas, Sriram and Tibin  * 
 */
?>
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
                                            
                                            <form action="<?php echo base_url("/office/changepassword");?>" method="post">
                                                <label>Current Password</label><input  required style="width:40%;" type="password" name="current" class="form-control">
                                            <label>New Password</label><input  required style="width:40%;" type="password" name="newpassword" class="form-control">
                                            <label>Confirm Password</label><input required style="width:40%;" type="password" name="confirm" class="form-control">
                                            <input type="hidden" value="1" name="passform">
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
                                        <?php if(validation_errors()){
                                            if($this->input->post('profile')==1){
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
                                            
                                            <form action="<?php echo base_url("/office/changeProfile");?>" method="post">
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
                    <?php
                    $CI=&get_instance();
                    switch($page)
                    {
                        case "addStudent":{
                            $data=array(
                                'CI'=>$CI
                            );
                            addStudent($data);
                        }break;
                    case "manage_student":{
                            $data=array(
                                'CI'=>$CI
                            );
                            manageStudent($data);
                        }break;
                     case "view_marks":{
                            $data=array(
                                'CI'=>$CI
                            );
                            viewMarks($data);
                        }break;
                    case "printApplication":{
                            $data=array(
                                'CI'=>$CI
                            );
                            printApplication($data);
                        }break;
                    case "newApplication":{
                            $data=array(
                                'CI'=>$CI
                            );
                            newApplication($data);
                        }break;
                    case "editApplication":{
                            $data=array(
                                'CI'=>$CI
                            );
                            editApplication($data);
                        }break;
                    case "viewApplications":{
                            $data=array(
                                'CI'=>$CI
                            );
                            viewApplications($data);
                        }break;
                    case "updateAttendance":{
                            $data=array(
                                'CI'=>$CI
                            );
                            updateAttendance($data);
                        }break;
                    case "viewAttendance":{
                            $data=array(
                                'CI'=>$CI
                            );
                            viewAttendance($data);
                        }break;
                    }
function printApplication($data){
    $appNo=$data['CI']->uri->segment(4);
    if($appNo){
        if(findValidApplicationNo($appNo)){
            
            redirect(base_url('office/page/getAppnForm').'/'.$appNo);    
        }else{
           alert('Invalid Application Number');
           jsRedirect(base_url('office/page/printApplication'));
        }
        
    }else{
        ?>
                        <h1>Print Application</h1>
                        <hr/>
                        <div class='col-lg-4'>
                            
                                <div class='form-group'>
                                    <label>
                                        Application No
                                    </label>
                                    <input id='appNo' type='number' class='form-control' name='appNo'>
                                </div>
                            <div class='form-group'>
                                <button onclick="printAppn();" class='btn btn-primary'>Print</button>
                            </div>
                        </div>
                        <script>
                            function printAppn(){
                                if(document.getElementById('appNo').value==''){
                                    window.alert('Required');
                                }else{
                                   location.href='<?php echo base_url('office/page/printApplication');?>/'+document.getElementById('appNo').value;
                                }
                            }
                            </script>
        <?php
        
    }
}
function updateAttendance($data){
    ?>
                            <h1>Update Attendance</h1>
                            <div class="row">
                              
                                   <?php  

                                if($data['CI']->input->post('level')==1)
                                {
                                    ?>
                             <div class='col-lg-4'>
                                    <form action='' method='post'>
                                    <input type='hidden' name='course' value='<?php echo $data['CI']->input->post('course');?>'>
                                    <input type='hidden' name='year' value='<?php echo $data['CI']->input->post('year');?>'>

                                       
                                    
                                    
                                            <div class='form-group'>
                                            <label>Batch</label>
                                        </div>
                                    <div class='form-group'>
                                        <select name='batch' class='form-control'>
                                            <?php
                                            $course=$data['CI']->input->post('course');
                                            $courseId=$data['CI']->encryption->decrypt($course);
                                            $sql="select batches from courses where id={$courseId}";
                                            //echo $sql;
                                            $sql=$data['CI']->db->query($sql);
                                            $sql=$sql->row_array();
                                            $i=1;
                                            echo $sql['batches'];
                                            while($sql['batches']>=$i){
                                                ?>
                                            <option value='<?php echo $data['CI']->encryption->encrypt($i);?>'><?php echo $i;?></option>
                                            <?php
                                            $i++;
                                            }
                                            
                                            
                                            ?>
                                        </select>
                                        </div>
                                    <div class='form-group'><input type='hidden' name='level' value='2'>
                                        <input type='submit' class='btn btn-primary' value='Next'>
                                    </div>
                             </div>
                                        <?php
                                    
                                    
                                }elseif($data['CI']->input->post('level')==2){
                                    
                                    ?>
                                    <form action='<?php echo base_url('manageStudent');?>' method='post'>
                                        <input type='hidden' name='course' value='<?php echo $data['CI']->input->post('course');?>'>
                                        <input type='hidden' name='year' value='<?php echo $data['CI']->input->post('year');?>'>
                                        <input type='hidden' name='batch' value='<?php echo $data['CI']->input->post('batch');?>'>
                                        <?php
                                        $course=$data['CI']->input->post('course');
                                        $courseId=$data['CI']->encryption->decrypt($course);
                                         $year=$data['CI']->input->post('year');
                                        $yearId=$data['CI']->encryption->decrypt($year);
                                         $batch=$data['CI']->input->post('batch');
                                        $batchId=$data['CI']->encryption->decrypt($batch);
                                        
                                        
                                        
                                        ?>
                                        <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Student Data
                        </div>
                        <!-- /.panel-heading -->
                        <div class='col col-lg-6'>
                            <form acti
                            
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Admn No</th>
                                            <th>Name</th>
                                            
                                            <th>Attendance(Tick For Absent)</th>
                                        </tr>
                                    </thead>
                                    <script>
                                    function markAbsent(id){
                                        
                                     if(document.getElementById(id).checked==true){
                                         document.getElementById(id).checked=false;
                                     }else{
                                         document.getElementById(id).checked=true;
                                     }  
                                    }
                                    </script>
                                    <tbody>
                                       <?php
                                       $sql="select * from student_ac_meta where course_id={$courseId} and batch={$batchId} and admn_year={$yearId}";
                                      $sql=$data['CI']->db->query($sql);
                                      $id=0;
                                      foreach($sql->result_array() as $row){
                                          $id++;
                                          ?>
                                        <tr>
                                            <td onclick="markAbsent('<?=$id;?>');"><?php echo $row['admn_no'];?></td>
                                            <td onclick="markAbsent('<?=$id;?>');"><?php echo findUsername($row['userid']);?></td>
                                            
                                            <td>
                                                <input id='<?=$id;?>' type="checkbox" value="<?=$data['CI']->encryption->encrypt($row['userid']);?>" name="absent[]">
                                            </td>
                                        </tr>
                                            
                                        
                                        
                                        <?php
                                      }
                                       
                                       
                                       
                                       ?>
                                       
                                     
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                                            
                                        
                                <?php    
                           
                                    
                                }
                                else{
                                    ?>
                                <div class='col-lg-4'>
                                    <form action='' method='post'>
                                        <div class='form-group'>
                                            <label>Course Name</label>
                                        </div>
                                         <div class='form-group'>
                                            <?php
                                            $sql="select * from courses where active=1";
                                            $sql=$data['CI']->db->query($sql);
                                            ?>
                                             <select name='course' class='form-control'>
                                                 <?php
                                                 foreach($sql->result_array() as $row){
                                                     ?>
                                                 <option value='<?php echo $data['CI']->encryption->encrypt($row['id']);?>'><?php echo $row['courseName'];?></option>
                                                 <?php
                                                 }
                                                 ?>
                                             </select>
                                            
                                        </div>
                                        <div class='form-group'>
                                            <label>Academic Year</label>
                                        </div>
                                         <div class='form-group'>
                                            <?php
                                            $sql="SELECT * FROM `academic_year` ORDER BY `year` DESC";
                                            $sql=$data['CI']->db->query($sql);
                                            ?>
                                             <select name='year' class='form-control'>
                                                 <?php
                                                 foreach($sql->result_array() as $row){
                                                     ?>
                                                 <option value='<?php echo $data['CI']->encryption->encrypt($row['year']);?>'><?php echo $row['year'];?></option>
                                                 <?php
                                                 }
                                                 ?>
                                             </select>
                                            
                                        </div>
                                        <div class='form-group'>
                                            <input type='hidden' name='level' value="1">
                                           <input type='submit' value='Next' class='btn btn-primary'>
                                        </div>
                                    </form>
                                    
                                </div>
                                    <?php
                                    
                                }
                                
                            
                                
                                ?>
                                    
                                
                                
                            </div>
                                
<?php 

}
function viewApplications($data){
    ?>
                        <h1>View Applications</h1><hr/>
                        <div class="row">
                             <div class="col-lg-6">
                             <div class="alert alert-info">
                                    <form action="">
                                    <label>Department</label>
                                    <select style="width: 60%;" name="department" class="form-control">
                                        <option>All</option>
                                        <?php
                                        
                                        $sql="select * from courses where active=1";
                                        $sql=$data['CI']->db->query($sql);
                                        foreach ($sql->result_array() as $row){
                                            ?>
                                        <option><?php echo $row['courseName'];?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                     <label>Admission Category</label>
                                    <select style="width: 60%;" name="category" class="form-control">
                                        <option>All</option>
                                        <option value='Uni. Allotment'>Uni. Allotment</option>
                                     <option value='Spot'>Spot</option>
                                     <option value='Management'>Management</option>
                                    </select><br>
                                     <input type="submit" class="btn btn-primary" style="width: 50%;" value="Filter">
                                </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="panel panel-default">
                        <div class="panel-heading">
                            View Applications
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                               
                                
                                </form>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Appn ID</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Father's Name</th>
                                            <th>Admn Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($data['CI']->input->get('department') and $data['CI']->input->get('category')){
                                        
                                        $sql="select * from admission";
                                        if($data['CI']->input->get('department')=='All'){
                                            
                                            
                                        }else{
                                            $sql.=" where courses='".$data['CI']->input->get('department')."'";
                                        }
                                         if($data['CI']->input->get('category')=='All'){
                                            
                                            
                                        }else{
                                            if($_GET['department']=='All'){
                                                $sql.=" where ";
                                            }else{
                                                $sql.=" and ";
                                            }
                                            $sql.="admCat='".$data['CI']->input->get('category')."'";
                                        }
                                        
                                        }else{
                                            $sql="SELECT * FROM admission";
                                        }
                                       
                                        $sql=$data['CI']->db->query($sql);
                                        foreach ($sql->result_array() as $row){
                                            extract($row);
                                            ?><tr>
                                                <td><?php echo $appNo;?> </td>
                                                 <td><?php echo $name;?> </td>
                                                  <td><?php echo $courses;?> </td>
                                                   <td><?php echo $fname;?> </td>
                                                    <td><?php echo $admCat;?> </td>
                                                    <td><a href='<?php echo base_url('office/page/editApplication?id='.$appNo);?>'>Edit</a>   |    <a href='<?php echo base_url('office/page/printApplication/'.$appNo);?>'>Print/View</a></td>
                                                        </tr>
                                                        <?php
                                        }
                                        
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                            
                        </div>
                           
                        </div>
                        <?php
}
function editApplication($data){
    
    ?>
                        <h1>Edit  Application</h1>
                        <hr/>
                        <?php
                        if(validation_errors()){
                            ?>
                        <div class="alert alert-info">
                       <?php echo validation_errors();?>
                            
                            
                        </div>
                        <?php
                        }
                       
                        if($data['CI']->input->post('level')==1){
                            $appNo=$_POST['appNo'];
                            if(is_numeric($appNo)){
                                
                            
                            $sql="select * from admission where appNo={$appNo}";
                            $sql=$data['CI']->db->query($sql);
                            if($sql->num_rows()==0){
                                alert('No Application found with that ID');
                                jsRedirect(base_url('office/page/editApplication'));
                                }else{
                                    $sql=$sql->row_array();
                                    extract($sql);
                                    
                                ?>
                        <div class='col-lg-4'>
                          <form action="<?php echo base_url('office/editApplication');?>" method="post">
                            <div class="form-group">
                                <label>Application No:</label>
                                <input disabled="" value="<?php echo $appNo;?>" type="number" class="form-control" name="appNo">
                            </div>
                            <div class="form-group">
                                <label>Course</label>
                                
                                <select name="courses" class="form-control">
                                    <option value="0">SELECT COURSE</option>
                                    
                                    <?php
                                    echo $courses;
                                    $sql="select * from courses where active=1";
                                    $sql=$data['CI']->db->query($sql);
                                    foreach ($sql->result_array() as $row){
                                        extract($row);
                                        //  print_r($row);
                                        ?>
                                    <option value="<?php echo $courseName;?>" 
                                    <?php 
                                    
                                    if($courseName==$courses){
                                        echo 'selected="true"';
                                    }
                                    ?>
                                    ><?php echo $courseName;?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                               <div class="form-group">
                                <label>Residential</label>
                                <select name='residential' class="form-control">
                                   
                                     <option value='Hosteller' <?php
                                     if($residential=='Hosteller'){
                                         echo 'selected="true"';
                                     }
                                     ?>
                                             >Hosteller</option>
                                     <option value='Day Scholar' <?php
                                     if($residential=='Day Scholar'){
                                         echo 'selected="true"';
                                     }
                                     ?>
                                             >Day Scholar</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input value="<?php echo $name;?>" type="text" class="form-control" name="name">
                            </div>
                                 
                            <div class="form-group">
                                <label>Plus 2(Group)</label>
                                <select name='plus2group' class="form-control">
                                   
                                     <option value='SCIENCE' <?php
                                     if($plus2group=='SCIENCE'){
                                         echo 'selected="true"';
                                     }
                                     ?>
                                             >SCIENCE</option>
                                     <option value='COMMERCE' <?php
                                     if($plus2group=='COMMERCE'){
                                         echo 'selected="true"';
                                     }
                                     ?>
                                             >COMMERCE</option>
                                     <option value='HUMANITIES' <?php
                                     if($plus2group=='HUMANITIES'){
                                         echo 'selected="true"';
                                     }
                                     ?>
                                             >HUMANITIES</option>
                                </select>
                            </div>
                             
                         <div class="form-group">
                                <label>Recognition Need</label>
                                <select name="recNeed" class="form-control">
                                    
                                     <option value='YES' <?php
                                     if($recNeed=='YES'){
                                         echo 'selected="true"';
                                     }
                                     ?>
                                             >YES</option>
                                     <option value="NO" <?php
                                     if($recNeed=='NO'){
                                         echo 'selected="true"';
                                     }
                                     ?>
                                             >NO</option>
                                </select>
                            </div>
                        <div class="form-group">
                                <label>Gender</label>
                                <select name="gender" class="form-control">
                                    
                                     <option value='Male'  <?php
                                     if($gender=='Male'){
                                         echo 'selected="true"';
                                     }
                                     ?>
                                             >MALE</option>
                                     <option value='Female' <?php
                                     if($gender=='Female'){
                                         echo 'selected="true"';
                                     }
                                     ?>
                                             >FEMALE</option>
                                </select>
                            </div>
                              <div class="form-group">
                                    <label>Blood Group</label>
                                    <select class="form-control" name="blood">
                                            <option  <?php
                                     if($blood=='A+'){
                                         echo 'selected="true"';
                                     }
                                     ?>
                                             >A+</option>
                                            <option <?php
                                     if($blood=='A-'){
                                         echo 'selected="true"';
                                     }
                                     ?>>A-</option>
                                           
                                            <option<?php
                                     if($blood=='B+'){
                                         echo 'selected="true"';
                                     }
                                     ?>>B+</option>
                                            <option <?php
                                     if($blood=='B-'){
                                         echo 'selected="true"';
                                     }
                                     ?>>B-</option>
                                            
                                            <option <?php
                                     if($blood=='AB+'){
                                         echo 'selected="true"';
                                     }
                                     ?>>AB+</option>
                                            <option <?php
                                     if($blood=='AB-'){
                                         echo 'selected="true"';
                                     }
                                     ?>>AB-</option>
                                            
                                            <option <?php
                                     if($blood=='O+'){
                                         echo 'selected="true"';
                                     }
                                     ?>>O+</option>
                                            <option <?php
                                     if($blood=='O-'){
                                         echo 'selected="true"';
                                     }
                                     ?>>O-</option>
                                            
                                            
                                        </select>
                                </div>
                        <div class="form-group">
                                <label>Date Of Birth</label>
                                <input value="<?php echo $dob;?>" type="date" class="form-control" name="dob">
                            </div>
                        <div class="form-group">
                                <label>Admission Category</label>
                                <select name="admnCat" class="form-control">
                                    
                                     <option value='Uni. Allotment' <?php
                                     if($admCat=='Uni. Allotment'){
                                         echo 'selected="true"';
                                     }
                                     ?>>Uni. Allotment</option>
                                     <option value='Spot'<?php
                                     if($admCat=='Spot'){
                                         echo 'selected="true"';
                                     }
                                     ?>>Spot</option>
                                     <option value='Management' <?php
                                     if($admCat=='Management'){
                                         echo 'selected="true"';
                                     }
                                     ?>>Management</option>
                                </select>
                            </div>
                                 <div class="form-group">
                                <label>Parent's Annual Income</label>
                                <input value="<?php echo $aIncome;?>" type="number" class="form-control" name="aIncome">
                            </div>
                                <div class="form-group">
                                <label>Student's Mob No</label>
                                <input value="<?php echo $stMobile;?>" type="number" class="form-control" name="stMobile">
                            </div>
                                 <div class="form-group">
                                <label>Parent's Mob No</label>
                                <input value="<?php echo $ptMobile;?>" type="number" class="form-control" name="ptMobile">
                            </div>
                                 <div class="form-group">
                                <label>Religion & Caste</label>
                                <input value="<?php echo $religion;?>" type="text" class="form-control" name="religion">
                            </div>
                                <div class="form-group">
                                <label>Category</label>
                                <select name="category" class="form-control">
                                   
                                     <option value='GEN' <?php if($category=='GEN'){echo 'selected="true"';}?>>GENERAL</option>
                                    <option value='SC' <?php if($category=='SC'){echo 'selected="true"';}?>>SC</option>
                                     <option value='ST'<?php if($category=='ST'){echo 'selected="true"';}?>>St</option>
                                      <option value='OEC' <?php if($category=='OEC'){echo 'selected="true"';}?>>OEC</option>
                                     <option value='OBC' <?php if($category=='OBC'){echo 'selected="true"';}?>>OBC</option>
                                      
                                    
                                </select>
                            </div>
                                <div class="form-group">
                                <label>Name of Father</label>
                                <input value="<?php echo $fname;?>" type="text" class="form-control" name="fname">
                            </div>
                                <div class="form-group">
                                <label>Father's Occupation</label>
                                <input value="<?php echo $fOccu;?>" type="text" class="form-control" name="fOccu">
                            </div>
                                 <div class="form-group">
                                <label>Name of Mother</label>
                                <input value="<?php echo $mname;?>" type="text" class="form-control" name="mname">
                            </div>
                            <div class="form-group">
                                <label>Mother's Occupation</label>
                                <input value="<?php echo $mOccu;?>" type="text" class="form-control" name="mOccu">
                            </div>
                                <div class="form-group">
                                <label>Permanent Address</label>
                                <input type="text" name="padr1" id="padr1" class="form-control" value="<?php echo $padr1;?>">
                                <input type="text" name="padr2" id="padr2" class="form-control" value="<?php echo $padr2;?>">
                                <input type="text" name="padr3" id="padr3" class="form-control" value="<?php echo $padr3;?>">
                                <input type="text" name="padr4" id="padr4" class="form-control" value="<?php echo $padr4;?>">
                            </div>
                            <div class="form-group">
                                <label>Pin Code</label>
                               <input value="<?php echo $ppin;?>" id='ppin' type="number" class="form-control" name="ppin">
                            </div>
                    </div>
                              <div class='col-lg-4'>
                            
                            
                            <script>
                            function sameAddr(data){
                                
                                if(data.checked){
                               
                                document.getElementById('cadr1').value=document.getElementById('padr1').value;
                                document.getElementById('cadr2').value=document.getElementById('padr2').value;
                                document.getElementById('cadr3').value=document.getElementById('padr3').value;
                                document.getElementById('cadr4').value=document.getElementById('padr4').value;
                                document.getElementById('cpin').value=document.getElementById('ppin').value;

                                window.alert('Copied');
                               
                                }else{
                                    window.alert('Cleared');
                                document.getElementById('cadr1').value=''
                                document.getElementById('cadr2').value=''
                                document.getElementById('cadr3').value=''
                                document.getElementById('cadr4').value=''

                                    document.getElementById('cAddress').value='';
                                }
                            }
                            </script>
                             <div class="form-group">
                                <label>Address to Which Communication to be send</label>
                                <input onchange="sameAddr(this);"type='checkbox'>Same As Above
                                <input type="text" name="cadr1" id="cadr1" class="form-control" value="<?php echo $cadr1;?>">
                                <input type="text" name="cadr2" id="cadr2" class="form-control" value="<?php echo $cadr2;?>">
                                <input type="text" name="cadr3" id="cadr3" class="form-control" value="<?php echo $cadr3;?>">
                                <input type="text" name="cadr4" id="cadr4" class="form-control" value="<?php echo $cadr4;?>">
                             
                            </div>
                            <div class="form-group">
                                <label>Pin Code</label>
                               <input id='cpin' type="number" class="form-control" value="<?php echo $cpin;?>" name="cpin">
                            </div>
                            <div class="panel panel-default">
                        <div class="panel-heading">
                            Details of 10<sup>th</sup> SSLC/CBSE/ICSE Other State's Board
                        </div>
                        <div class="panel-body">
                             <div class="form-group">
                                <label>Roll No</label>
                                <input value="<?php echo $tenRoll;?>" type="text" class="form-control" name="tenRoll">
                            </div>
                            <div class="form-group">
                                <label>Month</label>
                                <select name='tenMonth' class='form-control'>
                                     <option selected value='Janaury' <?php if($tenMonth=='Janaury'){echo 'selected="true"';}?>>Janaury</option>
                                    <option value='February' <?php if($tenMonth=='February'){echo 'selected="true"';}?>>February</option>
                                    <option value='March' <?php if($tenMonth=='March'){echo 'selected="true"';}?>>March</option>
                                    <option value='April' <?php if($tenMonth=='April'){echo 'selected="true"';}?>>April</option>
                                    <option value='May' <?php if($tenMonth=='May'){echo 'selected="true"';}?>>May</option>
                                    <option value='June' <?php if($tenMonth=='June'){echo 'selected="true"';}?>>June</option>
                                    <option value='July' <?php if($tenMonth=='July'){echo 'selected="true"';}?>>July</option>
                                    <option value='August' <?php if($tenMonth=='August'){echo 'selected="true"';}?>>August</option>
                                    <option value='September' <?php if($tenMonth=='September'){echo 'selected="true"';}?>>September</option>
                                    <option value='October' <?php if($tenMonth=='October'){echo 'selected="true"';}?>>October</option>
                                    <option value='November' <?php if($tenMonth=='November'){echo 'selected="true"';}?>>November</option>
                                    <option value='December' <?php if($tenMonth=='December'){echo 'selected="true"';}?>>December</option>
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label>Year</label>
                                <input value="<?php echo $tenYear;?>" type="number" class="form-control" name="tenYear">
                            </div>
                             <div class="form-group">
                                <label>Mark Scored</label>
                                <input value="<?php echo $tenMark;?>" type="number" class="form-control" name="tenMark">
                            </div>
                            <div class="form-group">
                                <label>10th Board Exam Name<sup>th</sup> School</label>
                                <input value="<?php echo $tenBoard;?>" type="text" class="form-control" name="tenBoard">
                            </div>
                            <div class="form-group">
                                <label>Name & Place of 10<sup>th</sup> School</label>
                                <input value="<?php echo $tenSchool;?>" type="text" class="form-control" name="tenSchool">
                            </div>
                            
                        </div>
                            </div>
                                <div class="panel panel-primary">
                        <div class="panel-heading">
                            Details of 12<sup> th</sup> Examination
                        </div>
                        <div class="panel-body">
                           
                                <div class="form-group">
                                <label>Plus 2(Group)</label>
                                <select name='plus2group' class="form-control">
                                    <option>SELECT GROUP</option>
                                     <option value='SCIENCE'  <?php if($plus2group=='SCIENCE'){echo 'selected="true"';}?>>SCIENCE</option>
                                     <option value='COMMERCE' <?php if($plus2group=='COMMERCE'){echo 'selected="true"';}?>>COMMERCE</option>
                                     <option value='HUMANITIES' <?php if($plus2group=='HUMANITIES'){echo 'selected="true"';}?>>HUMANITIES</option>
                                </select>
                            </div>  
                            <div class="form-group">
                                <label>Reg No</label>
                                <input value="<?php echo $plus2roll;?>" type="text" class="form-control" name="plus2roll">
                            </div>
                            <div class="form-group">
                                <label>Month</label>
                                <select name='twoMonth' class='form-control'>
                                      <option selected value='Janaury' <?php if($twoMonths=='Janaury'){echo 'selected="true"';}?>>Janaury</option>
                                    <option value='February' <?php if($twoMonths=='February'){echo 'selected="true"';}?>>February</option>
                                    <option value='March' <?php if($twoMonths=='March'){echo 'selected="true"';}?>>March</option>
                                    <option value='April' <?php if($twoMonths=='April'){echo 'selected="true"';}?>>April</option>
                                    <option value='May' <?php if($twoMonths=='May'){echo 'selected="true"';}?>>May</option>
                                    <option value='June' <?php if($twoMonths=='June'){echo 'selected="true"';}?>>June</option>
                                    <option value='July' <?php if($twoMonths=='July'){echo 'selected="true"';}?>>July</option>
                                    <option value='August' <?php if($twoMonths=='August'){echo 'selected="true"';}?>>August</option>
                                    <option value='September' <?php if($twoMonths=='September'){echo 'selected="true"';}?>>September</option>
                                    <option value='October' <?php if($twoMonths=='October'){echo 'selected="true"';}?>>October</option>
                                    <option value='November' <?php if($twoMonths=='November'){echo 'selected="true"';}?>>November</option>
                                    <option value='December' <?php if($twoMonths=='December'){echo 'selected="true"';}?>>December</option>
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label>Year</label>
                                <input  value="<?php echo $twoYear;?>" type="number" class="form-control" name="twoYear">
                            </div>
                              <div class="form-group">
                                <label>Plus 2 (12th) Mark</label>
                                <input value="<?php echo $plus2mark;?>" type="text" class="form-control" name="plus2mark">
                            </div>
                            <div class="form-group">
                                <label>12th School Name & Place</label>
                                <input value="<?php echo $twoSchoolName;?>" type="text" class="form-control" name="twoSchoolName">
                            </div>
                            <div class="form-group">
                                <label>Name of 12th Exam</label>
                                <input value="<?php echo $twoExamName;?>" type="text" class="form-control" name="twoExamName">
                            </div>
                            <div class="form-group">
                                <label>12th Board Exam name</label>
                                <input value="<?php echo $twoBoardName;?>"  type="text" class="form-control" name="twoBoardName">
                            </div>
                        </div>
                      
                    </div>
                           
                             
                                </div>
                       
                            <div class="col col-lg-4">  
                                <div class="panel panel-info">
                        <div class="panel-heading">
                            Name and Address of the Local Guardian if any
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                
                                <textarea placeholder="Name & Address"name='guardian' rows="5" class="form-control"><?php echo $guardian;?></textarea>
                            </div>
                            
                        </div>
                       
                    </div>
                                 <div class="panel panel-success">
                        <div class="panel-heading">
                            Details of T C
                        </div>
                        <div class="panel-body">
                          <div class="form-group">
                                <label>T C No:</label>
                                <input value="<?php echo $tcno;?>" type="text" class="form-control" name="tcno">
                            </div> 
                             <div class="form-group">
                                <label>Date</label>
                                <input value="<?php echo $tcdate;?>" type="date" class="form-control" name="tcdate">
                            </div> 
                            <div class="form-group">
                                <label>TC</label>
                                <input value="<?php echo $tcname;?>" type="text" class="form-control" name="tcname">
                            </div> 
                        </div>
                       
                    </div>
                        <div class="panel panel-info">
                        <div class="panel-heading">
                            Uni.Cap FEE REmittance Details(Only for CAP) 
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Chalan No</label>
                                <input value="<?php echo $chalan;?>" type="number" class="form-control" name="chalan">
                            </div>
                             <div class="form-group">
                                <label>Date</label>
                                <input value="<?php echo $chlndate;?>" type="date" class="form-control" name="chlndate">
                            </div>
                             <div class="form-group">
                                <label>SBT BRANCH</label>
                                <input value="<?php echo $chlnbranch;?>" type="text" class="form-control" name="chlnbranch">
                            </div>
                        </div>
                       
                    </div>
                                <div class="panel panel-info">
                        <div class="panel-heading">
                            Student's Brothers and Sisters
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="rel1" value='<?php echo $rel1;?>' placeholder="Name">
                                <input type="text" class="form-control" name="rel1Job" value='<?php echo $rel1Job;?>' placeholder="Job">
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="rel2" value='<?php echo $rel2;?>' placeholder="Name">
                                <input type="text" class="form-control" name="rel2Job" value='<?php echo $rel2Job;?>' placeholder="Job">
                            </div>
                             <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="rel3" value='<?php echo $rel3;?>' placeholder="Name">
                                <input type="text" class="form-control" name="rel3Job" value='<?php echo $rel3Job;?>' placeholder="Job">
                            </div>
                        </div>
                       
                    </div>
                                <div class="panel panel-info">
                        <div class="panel-heading">
                            Your ExtraCurricular Activities
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Item</label>
                                <input type="text" class="form-control" name="extra1" value='<?php echo $extra1;?>'>
                                <input type="text" class="form-control" name="extra2" value='<?php echo $extra2 ;?>'>
                            </div>
                            
                        </div>
                       
                    </div>
                                <div class="panel panel-info">
                        <div class="panel-heading">
                           Vehicle Details
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Item</label>
                                <input type="text" class="form-control" placeholder="CAR OR BIKE"name="vehicle" value='<?php echo $vehicle;?>'>
                                <input type="text" class="form-control" placeholder="Reg No"name="vehicleNo" value='<?php echo $vehicleNo ;?>'>
                            </div>
                            
                        </div>
                       
                    </div>
                                </div>
                         
                   
                            
                            
                       
                    </div>
                   
                            
                            
                        </div>
                        <div class='col-lg-8'>
                        <input type='hidden' name='currentAppNo' value='<?php echo $appNo;?>'>
                        <input type='submit' value='Verify & Save' class='btn btn-success btn-lg btn-block'>
                </div>
                        <?php
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                }
                            }else{
                                show_error('Only Numeric');
                            }    
                            
                        }else{
                            
                            
                        ?>
                        <div class="col-lg-4">
                            
                            <form action="<?php echo base_url('office/page/editApplication');?>" method="post">
                                <div class="form-group">
                                    <label>Application No</label>
                                    <input value="<?php echo $data['CI']->input->get('id');?>" type="number" name="appNo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" value="1" name='level'>
                                    <input type="submit" value="Next" class="btn btn-primary">
                                    
                                </div>
                            </form>
                        </div>
                        <?php
                        }
                       
}

function newApplication($data){
    ?>
                        <h1>New Application</h1>
                        <hr/>
                        <div class="col-lg-4">
                            <?php
                            if(validation_errors()){
                                ?>
                            <div class="alert alert-danger">
                                <?php echo validation_errors();?>
                               
                            </div>
                            <?php
                            
                            }
                            ?>
                            <form action="<?php echo base_url('office/newApplication');?>" method="post">
                            <div class="form-group">
                                <label>Application No:</label>
                                <input value="<?php echo set_value('appNo');?>" type="number" class="form-control" name="appNo">
                            </div>
                               <div class="form-group">
                                <label>Course</label>
                                <select name="residential" class="form-control">
                                   
                                    
                                    <option value="Hosteller">Hosteller</option>
                                    <option value="Day Scholar">Day Scholar</option>
                                  
                                </select>
                            </div>  
                                <div class="form-group">
                                <label>Hostel Name</label>
                                <input value="<?php echo set_value('hostelName');?>" type="text" class="form-control" name="hostelName">
                            </div>
                                  <div class="form-group">
                                <label>Class No</label>
                                <input <?php echo set_value('classNo');?> name="classNo" class="form-control">
                            </div>  
                            <div class="form-group">
                                <label>Course</label>
                                <select name="courses" class="form-control">
                                   
                                    <?php
                                    $sql="select * from courses where active=1";
                                    $sql=$data['CI']->db->query($sql);
                                    foreach ($sql->result_array() as $row){
                                        extract($row);
                                        //  print_r($row);
                                        ?>
                                    <option value="<?php echo $courseName;?>"><?php echo $courseName;?></option>
                                    <?php
                                    }
                                    
                                    
                                    
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input value="<?php echo set_value('name');?>" type="text" class="form-control" name="name">
                            </div>
                                 
                            <div class="form-group">
                                <label>Plus 2(Group)</label>
                                <select name='plus2group' class="form-control">
                                    <option>SELECT GROUP</option>
                                     <option value='SCIENCE'>SCIENCE</option>
                                     <option value='COMMERCE'>COMMERCE</option>
                                     <option value='HUMANITIES'>HUMANITIES</option>
                                </select>
                            </div>
                                 <div class="form-group">
                                <label>Plus 2 (12th) Mark</label>
                                <input value="<?php echo set_value('plus2mark');?>" type="text" class="form-control" name="plus2mark">
                            </div>
                         <div class="form-group">
                                <label>Recognition Need</label>
                                <select name="recNeed" class="form-control">
                                    
                                     <option value='YES'>YES</option>
                                     <option value="NO">NO</option>
                                </select>
                            </div>
                        <div class="form-group">
                                <label>Gender</label>
                                <select name="gender" class="form-control">
                                    <option>Select Geneder</option>
                                     <option value='Male'>MALE</option>
                                     <option value='Female'>FEMALE</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Vehicle</label>
                                <select name="vehicle" class="form-control">
                                   
                                    <option value="">Select</option>
                                    <option value="Bike">Bike</option>
                                    <option value="Car">Car</option>
                                  
                                </select>
                            </div> 
                                <div class="form-group">
                                    <label>Vehicle No</label>
                                    <input value="<?php echo set_value('vehicleNo');?>"  name="vehicleNo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Blood Group</label>
                                    <select class="form-control" name="blood">
                                            <option>A+</option>
                                            <option>A-</option>
                                           
                                            <option>B+</option>
                                            <option>B-</option>
                                            
                                            <option>AB+</option>
                                            <option>AB-</option>
                                            
                                            <option>O+</option>
                                            <option>O-</option>
                                            
                                            
                                        </select>
                                </div>
                        <div class="form-group">
                                <label>Date Of Birth</label>
                                <input value="<?php echo set_value('dob');?>" type="date" class="form-control" name="dob">
                            </div>
                        <div class="form-group">
                                <label>Admission Category</label>
                                <select name="admnCat" class="form-control">
                                    <option>Select Category</option>
                                     <option value='Uni. Allotment'>Uni. Allotment</option>
                                     <option value='Spot'>Spot</option>
                                     <option value='Management'>Management</option>
                                </select>
                            </div>
                                 <div class="form-group">
                                <label>Parent's Annual Income</label>
                                <input value="<?php echo set_value('aIncome');?>" type="number" class="form-control" name="aIncome">
                            </div>
                                <div class="form-group">
                                <label>Student's Mob No</label>
                                <input value="<?php echo set_value('stMobile');?>" type="number" class="form-control" name="stMobile">
                            </div>
                                 <div class="form-group">
                                <label>Parent's Mob No</label>
                                <input value="<?php echo set_value('ptMobile');?>" type="number" class="form-control" name="ptMobile">
                            </div>
                                 <div class="form-group">
                                <label>Religion & Caste</label>
                                <input value="<?php echo set_value('religion');?>" type="text" class="form-control" name="religion">
                            </div>
                                <div class="form-group">
                                <label>Category</label>
                                <select name="category" class="form-control">
                                    <option>Select Category</option>
                                     <option value='GEN'>GENERAL</option>
                                    <option value='SC'>SC</option>
                                     <option value='ST'>St</option>
                                      <option value='OEC'>OEC</option>
                                     <option value='OBC'>OBC</option>
                                      
                                    
                                </select>
                            </div>
                                <div class="form-group">
                                <label>Name of Father</label>
                                <input value="<?php echo set_value('fname');?>" type="text" class="form-control" name="fname">
                            </div>
                                <div class="form-group">
                                <label>Father's Occupation</label>
                                <input value="<?php echo set_value('fOccu');?>" type="text" class="form-control" name="fOccu">
                            </div>
                                <div class="form-group">
                                <label>Office Phone</label>
                                <input value="<?php echo set_value('officePhone');?>" type="text" class="form-control" name="officePhone">
                            </div>
                                 <div class="form-group">
                                <label>Name of Mother</label>
                                <input value="<?php echo set_value('mname');?>" type="text" class="form-control" name="mname">
                            </div>
                            <div class="form-group">
                                <label>Mother's Occupation</label>
                                <input value="<?php echo set_value('mOccu');?>" type="text" class="form-control" name="mOccu">
                            </div>
                                <div class="form-group">
                                <label>Permanent Address</label>
                                <input type="text" name="padr1" id="padr1" class="form-control" placeholder="Address Line 1">
                                <input type="text" name="padr2" id="padr2" class="form-control"  placeholder="Address Line 2">
                                <input type="text" name="padr3" id="padr3" class="form-control" placeholder="Address Line 3">
                                <input type="text" name="padr4" id="padr4" class="form-control" placeholder="Address Line 4">
                            </div>
                            <div class="form-group">
                                <label>Pin Code</label>
                               <input value="<?php echo set_value('ppin');?>" id='ppin' type="number" class="form-control" name="ppin">
                            </div>
                        </div>
                        <div class='col-lg-4'>
                            
                            
                            <script>
                            function sameAddr(data){
                                
                                if(data.checked){
                               
                                document.getElementById('cadr1').value=document.getElementById('padr1').value;
                                document.getElementById('cadr2').value=document.getElementById('padr2').value;
                                document.getElementById('cadr3').value=document.getElementById('padr3').value;
                                document.getElementById('cadr4').value=document.getElementById('padr4').value;
                                document.getElementById('cpin').value=document.getElementById('ppin').value;

                                window.alert('Copied');
                               
                                }else{
                                    window.alert('Cleared');
                                document.getElementById('cadr1').value=''
                                document.getElementById('cadr2').value=''
                                document.getElementById('cadr3').value=''
                                document.getElementById('cadr4').value=''

                                    document.getElementById('cAddress').value='';
                                }
                            }
                            </script>
                             <div class="form-group">
                                <label>Address to Which Communication to be send</label>
                                <input onchange="sameAddr(this);"type='checkbox'>Same As Above
                                <div class="form-group">
                                
                                <input type="text" name="cadr1" id="cadr1" class="form-control" placeholder="Address Line 1">
                                <input type="text" name="cadr2" id="cadr2" class="form-control"  placeholder="Address Line 2">
                                <input type="text" name="cadr3" id="cadr3" class="form-control" placeholder="Address Line 3">
                                <input type="text" name="cadr4" id="cadr4" class="form-control" placeholder="Address Line 4">
                            </div>
                             
                            </div>
                            <div class="form-group">
                                <label>Pin Code</label>
                               <input id='cpin' type="number" class="form-control" name="cpin">
                            </div>
                            <div class="panel panel-default">
                        <div class="panel-heading">
                            Details of 10<sup>th</sup> SSLC/CBSE/ICSE Other State's Board
                        </div>
                        <div class="panel-body">
                             <div class="form-group">
                                <label>Roll No</label>
                                <input value="<?php echo set_value('tenRoll');?>" type="text" class="form-control" name="tenRoll">
                            </div>
                             <div class="form-group">
                                <label>Mark Secured</label>
                                <input value="<?php echo set_value('tenMark');?>" type="text" class="form-control" name="tenMark">
                            </div>
                            <div class="form-group">
                                <label>Month</label>
                                <select name='tenMonth' class='form-control'>
                                     <option selected value='Janaury'>Janaury</option>
                                    <option value='February'>February</option>
                                    <option value='March'>March</option>
                                    <option value='April'>April</option>
                                    <option value='May'>May</option>
                                    <option value='June'>June</option>
                                    <option value='July'>July</option>
                                    <option value='August'>August</option>
                                    <option value='September'>September</option>
                                    <option value='October'>October</option>
                                    <option value='November'>November</option>
                                    <option value='December'>December</option>
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label>Year</label>
                                <input value="<?php echo set_value('tenYear');?>" type="number" class="form-control" name="tenYear">
                            </div>
                            <div class="form-group">
                                <label>Name & Place of 10<sup>th</sup> School</label>
                                <input value="<?php echo set_value('tenSchool');?>" type="text" class="form-control" name="tenSchool">
                            </div>
                            <div class="form-group">
                                <label>10th Board Exam Name</label>
                                <input value="<?php echo set_value('tenBoard');?>" type="text" class="form-control" name="tenBoard">
                            
                            </div>
                            
                        </div>
                            </div>
                                <div class="panel panel-primary">
                        <div class="panel-heading">
                            Details of 12<sup> th</sup> Examination
                        </div>
                        <div class="panel-body">
                           
                                <div class="form-group">
                                <label>Plus 2(Group)</label>
                                <select name='plus2group' class="form-control">
                                    <option>SELECT GROUP</option>
                                     <option value='SCIENCE'>SCIENCE</option>
                                     <option value='COMMERCE'>COMMERCE</option>
                                     <option value='HUMANITIES'>HUMANITIES</option>
                                </select>
                            </div>  
                            <div class="form-group">
                                <label>Reg No</label>
                                <input value="<?php echo set_value('plus2roll');?>" type="text" class="form-control" name="plus2roll">
                            </div>
                            <div class="form-group">
                                <label>Month</label>
                                <select name='twoMonth' class='form-control'>
                                     <option selected value='Janaury'>Janaury</option>
                                    <option value='February'>February</option>
                                    <option value='March'>March</option>
                                    <option value='April'>April</option>
                                    <option value='May'>May</option>
                                    <option value='June'>June</option>
                                    <option value='July'>July</option>
                                    <option value='August'>August</option>
                                    <option value='September'>September</option>
                                    <option value='October'>October</option>
                                    <option value='November'>November</option>
                                    <option value='December'>December</option>
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label>Year</label>
                                <input  value="<?php echo set_value('twoYear');?>" type="number" class="form-control" name="twoYear">
                            </div>
                            <div class="form-group">
                                <label>12th School Name & Place</label>
                                <input value="<?php echo set_value('twoSchoolName');?>" type="text" class="form-control" name="twoSchoolName">
                            </div>
                            <div class="form-group">
                                <label>Name of 12th Exam</label>
                                <input value="<?php echo set_value('twoExamName');?>" type="text" class="form-control" name="twoExamName">
                            </div>
                            <div class="form-group">
                                <label>12th Board Exam name</label>
                                <input value="<?php echo set_value('twoBoardName');?>"  type="text" class="form-control" name="twoBoardName">
                            </div>
                        </div>
                      
                    </div>
                            <div class="panel panel-success">
                        <div class="panel-heading">
                            Details of T C
                        </div>
                        <div class="panel-body">
                          <div class="form-group">
                                <label>T C No:</label>
                                <input value="<?php echo set_value('tcno');?>" type="text" class="form-control" name="tcno">
                            </div> 
                             <div class="form-group">
                                <label>Date</label>
                                <input value="<?php echo set_value('tcdate');?>" type="date" class="form-control" name="tcdate">
                            </div> 
                            <div class="form-group">
                                <label>TC</label>
                                <input value="<?php echo set_value('tcname');?>" type="text" class="form-control" name="tcname">
                            </div> 
                        </div>
                       
                    </div>
                          
                        <div class="panel panel-info">
                        <div class="panel-heading">
                            Your ExtraCurricular Activities
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Item</label>
                                <input type="text" class="form-control" name="extra1" value='<?php echo set_value('extra1');?>'>
                                <input type="text" class="form-control" name="extra2" value='<?php echo set_value('extra2');?>'>
                            </div>
                            
                        </div>
                       
                    </div>
                           
                             </div>
                       
                            <div class="col col-lg-4">  
                                <div class="panel panel-info">
                        <div class="panel-heading">
                            Name and Address of the Local Guardian if any
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                
                                <textarea placeholder="Name & Address"name='guardian' rows="5" class="form-control"><?php echo set_value('guardian');?></textarea>
                            </div>
                            
                        </div>
                       
                    </div>
                                 <div class="panel panel-info">
                        <div class="panel-heading">
                            Uni.Cap FEE REmittance Details(Only for CAP) 
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Chalan No</label>
                                <input  type="number" class="form-control" name="chalan">
                            </div>
                             <div class="form-group">
                                <label>Date</label>
                                <input type="date" class="form-control" name="chlndate">
                            </div>
                             <div class="form-group">
                                <label>SBT BRANCH</label>
                                <input  type="text" class="form-control" name="chlnbranch">
                            </div>
                        </div>
                       
                    </div>
                        <div class="panel panel-info">
                        <div class="panel-heading">
                            Student's Brothers and Sisters
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="rel1" value='<?php echo set_value('rel1');?>' placeholder="Name">
                                <input type="text" class="form-control" name="rel1Job" value='<?php echo set_value('rel1Job');?>' placeholder="Job">
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="rel2" value='<?php echo set_value('rel2');?>' placeholder="Name">
                                <input type="text" class="form-control" name="rel2Job" value='<?php echo set_value('rel2Job');?>' placeholder="Job">
                            </div>
                             <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="rel3" value='<?php echo set_value('rel3');?>' placeholder="Name">
                                <input type="text" class="form-control" name="rel3Job" value='<?php echo set_value('rel3Job');?>' placeholder="Job">
                            </div>
                        </div>
                       
                    </div>
                            </div>
                         
                   
                            
                            
                       
                    </div>
                    
               
                <div class='col-lg-8'>
                        <input type='submit' value='Verify & Save' class='btn btn-success btn-lg btn-block'>
                </div>
                      </div>           
                        
                            
                                
                            </form>
                        
                        
                        <?php
}
                    
                    
                    function viewMarks($data){

?>
<h1>View Exam Results</h1>
<hr/>
<div class='row'>
    <div class='col-lg-8'>
        <?php
        
        if($data['CI']->input->post('level')==2){
            $course=$data['CI']->encryption->decrypt($data['CI']->input->post('course'));
            $exam_id=$data['CI']->encryption->decrypt($data['CI']->input->post('exam'));

         
        ?>
        
        <div class="panel panel-default">
                        <div class="panel-heading">
                            View Exam Results
                            
                        </div>
           
            <?php
            //$exam_id=$data['CI']->encryption->decrypt($data['CI']->input->get('exam_id'));
            if($exam_id){
            $sqlExamData="select * from exams where exam_id={$exam_id}";
            $sqlExamData=$data['CI']->db->query($sqlExamData);
            $sqlExamData=$sqlExamData->row_array();
            ?>
            <div class='alert alert-info'>
            
                Exam Name: <?php echo $sqlExamData['exam_name'];?> | Class: <?php echo findClassName($sqlExamData['class_id']);?> <br>
                Paper Name: <?php echo findPaperName($sqlExamData['paper_id']);?> | Semester: <?php echo $sqlExamData['semester'];?>
                <p onclick="window.print();">   <b>Print Report</b></p>
            
            </div>
            <?php
            }
            ?>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Roll No</th>
                                            <th>Name</th>
                                            <th>Max Mark</th>
                                            <th>Mark</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                       
                                        
                                        $sql="select * from exam_marks where exam_id={$exam_id}";
                                        $sql=$data['CI']->db->query($sql);
                                        
                                        foreach($sql->result_array() as $row){
                                                    ?>
                                        <tr>
                                            <td>
                                            <?php echo $row['userid'];?></td>
                                            <td> <?php echo findNameFromUsername($row['userid']);?></td>
                                            <td> <?php echo $sqlExamData['maxMark'];?></td>
                                            <td><?php echo $row['mark'];?></td>
                                             <td><?php
                                            if($row['mark']>=$sqlExamData['minMark']){
                                                ?>
                                            <button type="button" class="btn btn-outline btn-success">Pass</button>
                                            <?php
                                            
                                            }else
                                            {
                                                ?>
                                            <button type="button" class="btn btn-outline btn-danger">Fail</button>
                                            <?php
                                            }
                                            
                                            
                                            ?></td>
 
                                            
                                            
                                        </tr>
                                            <?php
                                            
                                            }
                                        
                                                     
                                        
                                        
                                        
                                        
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
    </div>
    
</div><?php
            
        }elseif($data['CI']->input->post('level')==1){
              ?>
<div class="col-lg-6">
<form action="" method="post">
    <div class="form-group">
        <label>Exam Name</label>
        <input type="hidden" name="course" value="<?php echo $data['CI']->input->post('course');?>">

    </div>
    <div class="form-group">
        <select name="exam" class="form-control">
            <?php
            $course=$data['CI']->encryption->decrypt($data['CI']->input->post('course'));
            $sql="select * from exams where course_id={$course} and state IN('DECLARED','CLOSED')";
            
            $sql=$data['CI']->db->query($sql);
            foreach ($sql->result_array() as $row){
                ?>
            <option value="<?php echo $data['CI']->encryption->encrypt($row['exam_id']);?>"><?php echo $row['exam_name'];?></option>
            <?php            
            }
           ?>
        </select>
    </div>
    <div class="form-group">
        <input type="hidden" value="2" name="level">
        <input type="submit" class="btn btn-primary" value="Next">
    </div>
</form>

            <?php
        }
            
        else{
            
                ?>
<div class="col-lg-6">
<form action="" method="post">
    <div class="form-group">
        <label>Course Name</label>
    </div>
    <div class="form-group">
        <select name="course" class="form-control">
            <?php
            $sql="select * from courses where active=1";
            $sql=$data['CI']->db->query($sql);
            foreach ($sql->result_array() as $row){
                ?>
            <option value="<?php echo $data['CI']->encryption->encrypt($row['id']);?>"><?php echo $row['courseName'];?></option>
            <?php            
            }
           ?>
        </select>
    </div>
    <div class="form-group">
        <input type="hidden" value="1" name="level">
        <input type="submit" class="btn btn-primary" value="Next">
    </div>
</form>

            <?php
        }
    }
                     function manageStudent($data){
                        ?>
                        <h1>
                            Edit Student Profile
                        </h1><hr/>
                        <div class="row">
                           
                                <?php
                                
                                if($data['CI']->input->get('edit')){
                              $userid=$data['CI']->encryption->decrypt($data['CI']->input->get('edit'));
                              if($userid){
                                  
                                ?>
                              <div class="col-lg-5">
                            <form action="<?php echo base_url('office/updateProfile');?>" method="post">
                                <div class="form-group">
                                    <label>Name</label>
                                </div>
                                 <div class="form-group">
                                     <input type="text" name='name' value="<?php echo strtoupper(findUsername($userid));?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                </div>
                                 <div class="form-group">
                                     <input type="text" name='email' value="<?php echo findEmailFromUserId($userid);?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" name='phone' value="<?php echo findPhoneFromUserId($userid); ?>" class="form-control">
                                </div>
                                 <div class="form-group">
                                    <label>Date Of Birth</label>
                                </div>
                                <div class="form-group">
                                     <input type="date" name="dob" value="<?php set_value('dob');?>" class="form-control">
                                </div>
                               
                                 <div class="form-group">
                                    <label>Religion</label>
                                </div>
                                <div class="form-group">
                                     <input type="text" name="religion" value="<?php set_value('religion');?>" class="form-control">
                                </div>
                            
                                 <div class="form-group">
                                    <label>Caste</label>
                                </div>
                                <div class="form-group">
                                     <input type="text" name="caste" value="<?php set_value('caste');?>" class="form-control">
                                </div>
                            
                                 <div class="form-group">
                                    <label>Father Name</label>
                                </div>
                                <div class="form-group">
                                     <input type="text" name="fname" value="<?php set_value('fname');?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Father's Phone</label>
                                </div>
                                <div class="form-group">
                                     <input type="number" name="fphone" value="<?php set_value('fphone');?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                </div>
                                <div class="form-group">
                                    <textarea class='form-control' name='address'><?php set_value('address');?></textarea>
                                </div>
                                <div class='form-group'>
                                    <input type='hidden' name='userid' value='<?php echo $data['CI']->encryption->encrypt($userid);?>'>
                                    <input type='submit' class='btn btn-primary' value='Save'>
                                </div>
                            </form>
                            </div>
                            <?php
                                  
                                  
                                  
                              
                                  
                                  
                              }
                                
                                
                            }else{
                                if($data['CI']->input->post('level')==1)
                                {
                                    ?>
                             <div class='col-lg-4'>
                                    <form action='' method='post'>
                                    <input type='hidden' name='course' value='<?php echo $data['CI']->input->post('course');?>'>
                                    <input type='hidden' name='year' value='<?php echo $data['CI']->input->post('year');?>'>

                                       
                                    
                                    
                                            <div class='form-group'>
                                            <label>Batch</label>
                                        </div>
                                    <div class='form-group'>
                                        <select name='batch' class='form-control'>
                                            <?php
                                            $course=$data['CI']->input->post('course');
                                            $courseId=$data['CI']->encryption->decrypt($course);
                                            $sql="select batches from courses where id={$courseId}";
                                            //echo $sql;
                                            $sql=$data['CI']->db->query($sql);
                                            $sql=$sql->row_array();
                                            $i=1;
                                            echo $sql['batches'];
                                            while($sql['batches']>=$i){
                                                ?>
                                            <option value='<?php echo $data['CI']->encryption->encrypt($i);?>'><?php echo $i;?></option>
                                            <?php
                                            $i++;
                                            }
                                            
                                            
                                            ?>
                                        </select>
                                        </div>
                                    <div class='form-group'><input type='hidden' name='level' value='2'>
                                        <input type='submit' class='btn btn-primary' value='Next'>
                                    </div>
                                        <?php
                                    
                                    
                                }elseif($data['CI']->input->post('level')==2){
                                    
                                    ?>
                                    <form action='<?php echo base_url('manageStudent');?>' method='post'>
                                        <input type='hidden' name='course' value='<?php echo $data['CI']->input->post('course');?>'>
                                        <input type='hidden' name='year' value='<?php echo $data['CI']->input->post('year');?>'>
                                        <input type='hidden' name='batch' value='<?php echo $data['CI']->input->post('batch');?>'>
                                        <?php
                                        $course=$data['CI']->input->post('course');
                                        $courseId=$data['CI']->encryption->decrypt($course);
                                         $year=$data['CI']->input->post('year');
                                        $yearId=$data['CI']->encryption->decrypt($year);
                                         $batch=$data['CI']->input->post('batch');
                                        $batchId=$data['CI']->encryption->decrypt($batch);
                                        
                                        
                                        
                                        ?>
                                        <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Student Data
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Admn No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       $sql="select * from student_ac_meta where course_id={$courseId} and batch={$batchId} and admn_year={$yearId}";
                                      $sql=$data['CI']->db->query($sql);
                                      foreach($sql->result_array() as $row){
                                          ?>
                                        <tr>
                                            <td><?php echo $row['admn_no'];?></td>
                                            <td><?php echo findUsername($row['userid']);?></td>
                                            <td><?php echo findEmailFromUserId($row['userid']);?></td>
                                            <td><?php echo findPhoneFromUserId($row['userid']);?></td>
                                            <td><a href="?edit=<?php echo urlencode($data['CI']->encryption->encrypt($row['userid']));?>">Edit</a></td>
                                        </tr>
                                            
                                        
                                        
                                        <?php
                                      }
                                       
                                       
                                       
                                       ?>
                                       
                                     
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                                            
                                        
                                <?php    
                           
                                    
                                }
                                else{
                                    ?>
                                <div class='col-lg-4'>
                                    <form action='' method='post'>
                                        <div class='form-group'>
                                            <label>Course Name</label>
                                        </div>
                                         <div class='form-group'>
                                            <?php
                                            $sql="select * from courses where active=1";
                                            $sql=$data['CI']->db->query($sql);
                                            ?>
                                             <select name='course' class='form-control'>
                                                 <?php
                                                 foreach($sql->result_array() as $row){
                                                     ?>
                                                 <option value='<?php echo $data['CI']->encryption->encrypt($row['id']);?>'><?php echo $row['courseName'];?></option>
                                                 <?php
                                                 }
                                                 ?>
                                             </select>
                                            
                                        </div>
                                        <div class='form-group'>
                                            <label>Academic Year</label>
                                        </div>
                                         <div class='form-group'>
                                            <?php
                                            $sql="SELECT * FROM `academic_year` ORDER BY `year` DESC";
                                            $sql=$data['CI']->db->query($sql);
                                            ?>
                                             <select name='year' class='form-control'>
                                                 <?php
                                                 foreach($sql->result_array() as $row){
                                                     ?>
                                                 <option value='<?php echo $data['CI']->encryption->encrypt($row['year']);?>'><?php echo $row['year'];?></option>
                                                 <?php
                                                 }
                                                 ?>
                                             </select>
                                            
                                        </div>
                                        <div class='form-group'>
                                            <input type='hidden' name='level' value="1">
                                           <input type='submit' value='Next' class='btn btn-primary'>
                                        </div>
                                    </form>
                                    
                                </div>
                                    <?php
                                    
                                }
                                
                            }
                                
                                ?>
                          
                          </div>
                            
                            <?php
                            
                            
                            
                            
                            
                            
                      
                        
                        
                    }
                    function addStudent($data){
                        extract($data);
                      ?> 
                        
                        <h1>Add Student</h1>
                        <div class="row">
                            
                          <div class="col-lg-6">
                              <?php
                            if(validation_errors()){
                                ?>
                            <div class="alert alert-danger">
                                <?php echo validation_errors();?>
                                
                            </div>
                            <?php
                            
                            }
                            
                            ?>
                              <div class="alert alert-info">
                                  Username will be the admission number!
                                  <br>Password will be the phone Number!
                              </div>
                              <form action="<?php echo base_url("/office/addStudent");?>" method="post">
                            <div class="form-group">
                              <label>Admission No</label>
                              <input value="<?php echo set_value('admno');?>" style="width:50%;" type="text" class="form-control" name="admno">
                          </div>
                                   <div class="form-group">
                                  <label>Course</label>
                                  <select name='course' class='form-control' style='width:60%;'>
                                      <?php
                                if(get_cookie('course')!=NULL){
                                    $course=$data['CI']->encryption->decrypt(get_cookie('course'));
                                if($course){
                                   
                                    
                                    ?><option value="<?php echo $data['CI']->encryption->encrypt($course);?>"><?php 
                                    $sql="select courseName from courses where id={$course}";
                                    $sql=$data['CI']->db->query($sql);
                                    $row=$sql->row_array();
                                    echo $row['courseName'];
                                    ?></option>
                                    <?php
                                }
                                    
                                }
                                else
                                {
                                    ?><option>Select Course from Easy Form</option><?php
                                }
?>
                                  </select>
                              </div>
                                   <div class="form-group">
                                  <label>Batch</label>
                                  <select name='batch' class='form-control' style='width:60%;'>
                                      <?php
                                if(get_cookie('batch')!=NULL){
                                    $batch=$data['CI']->encryption->decrypt(get_cookie('batch'));
                                    if($batch){
                                        ?>
                                      <option value="<?php echo get_cookie('batch');?>"><?php echo $batch;?></option>
                                      <?php
                                    }
                                }else{
                                    ?><option>Select a Batch from Easy From</option><?php
                                }
                                ?>
                                  </select>
                              </div>
                                   <div class="form-group">
                                      <label>Year of Admission</label>
                                      <select style="width:60%;" name="admnyear" class="form-control">
                                           <?php
                                          
                                if(get_cookie('admnyear')!=NULL){
                                    
                                    $admnyear=$data['CI']->encryption->decrypt(get_cookie('admnyear'));
                                
                                    if($admnyear){
                                   
                                    
                                    ?><option value="<?php echo get_cookie('admnyear');?>"><?php 
                                  echo $admnyear;
                                  ?>
                                    </option>
                                    <?php
                                }
                                    
                                }
                                else
                                {
                                    ?><option>Select Year from Easy Form</option><?php
                                }
                                          ?>
                                          
                                      </select>
                                  </div> 
                              <div class="form-group">
                                  <label>Name</label>
                                 <input name="name" value="<?php echo set_value('name');?>" style="width:50%;" type="text" class="form-control" >
                              </div>
                                  <div class="form-group">
                                  <label>Email</label>
                                 <input name="email" value="<?php echo set_value('email');?>" style="width:50%;" type="text" class="form-control" >
                              </div>
                                  
                                  <div class="form-group">
                                      <label>Phone no</label>
                                      <input name="phone" value="<?php echo set_value('phone');?>" style="width:50%;" type="text" class="form-control" >
                                  </div>
                                 
                                  <div class="form-group">
                                      <input type="submit" class="btn btn-primary">
                                  </div>
                                  
                                  
                              </form>
                              
                          </div>
                            <div class="col col-lg-4">
                                <div class="panel panel-primary">
                        <div class="panel-heading">
                            Easy Form 
                        </div>
                        <div class="panel-body">
                            <form action="<?php echo base_url('/office/easyForm');?>" method="post">
                            <div class="form-group">
                                <script>
                                   function courseSelect(url){
                                       location.href="<?php echo  base_url('office/page/addStudent?course=');?>"+url.value;
                                       
                                   }
                                    
                                    </script>
                                <label> Default Course</label>
                                <select onChange="courseSelect(this);" name="course" class="form-control">
                                    <?php   
                                    if($data['CI']->input->get('course')){
                                        $courseGet=$data['CI']->input->get('course');
                                        $courseId=$data['CI']->encryption->decrypt($courseGet);
                                        $course=findCourseName($courseId);
                                        ?>
                                    <option value="<?php echo $data['CI']->input->get('course');?>"><?php echo $course;?></option>
                                    <?php
                                    }else{
                                        ?>
                                    <option>Course</option><?php
                                    }
                                    
                               
                                
                                   $sql="select * from courses where active=1";
                                   $sql=$data['CI']->db->query($sql);
                                   foreach ($sql->result_array() as $result){
                                       ?>
                                    <option value="<?php echo urlencode($data['CI']->encryption->encrypt($result['id']))    ;?>"><?php echo $result['courseName'];?></option>
                                    <?php
                                   }
                                   
                                   ?>
                                    
                                </select>
                                
                                <div class="form-group">
                           
                            
                                <label> Default Admission Year</label>
                                <select name="admnyear" class="form-control">
                                     <?php
                                   $sql="SELECT * FROM `academic_year` ORDER BY `academic_year`.`year` DESC";
                                   $sql=$data['CI']->db->query($sql);
                                   foreach ($sql->result_array() as $result){
                                       ?>
                                    <option value="<?php echo $data['CI']->encryption->encrypt($result['year']);?>"><?php echo $result['year'];?></option>
                                    <?php
                                   }
                                   
                                   ?>
                                    
                                </select>
                                
                                
                          
                        </div>
                                <div class="form-group">
                                    <label>Batch</label>
                                    <select name="batch" class="form-control">
                                        <?php
                                        if($data['CI']->input->get('course')){
                                            
                                        
                                        $sql="select batches from courses where id={$courseId}";
                                        $sql=$data['CI']->db->query($sql);
                                        $row=$sql->row_array();
                                        $i=1;
                                        //echo $row['batches'];
                                        while($row['batches']>=$i){
                                            ?><option value="<?php echo $data['CI']->encryption->encrypt($i);?>"><?php echo $i;?></option><?php
                                            $i++;
                                        }
                                        }else{
                                            ?><option><?php echo $data['CI']->encryption->decrypt(get_cookie('batch'));?></option><?php
                                        }
                                        
                                        ?>
                                    </select>
                                    
                                </div>  
                                <div class='form-group'>
                                    <input  type='submit' class='btn btn-primary' value='Save'>
                                </div>
                                  </form>
                        </div>
                        <div class="panel-footer">
                            <a href="<?php echo base_url('office/page/addStudent');?>?clearEasyForm=TRUE">Clear Easy Form Data</a>
                        </div>
                    </div>
                            </div>
                        </div>
                        <?php
                            
                        if(isset($_GET['clearEasyForm'])){
                            delete_cookie('admnyear');
                            delete_cookie('course');
                             delete_cookie('batch');
                            redirect(base_url('/office/page/addStudent'));
                        }
                        
                    }
                    
                    
                    ?>
  <!-- Insert your code here, in this div only -->

                        
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url("asset");?> /bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("asset");?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url("asset");?>/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url("asset");?>/dist/js/sb-admin-2.js"></script>

                        
       
