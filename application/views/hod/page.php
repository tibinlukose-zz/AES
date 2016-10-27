    <?php 
                                                   
                       $CI=&get_instance();
                            switch($page)
                        {
                            case "create_staff":{
                            include('includes.php');
                                      
                                    create_staff();
                            }break;
                        case "viewMarks":{
                            include('includes.php');
                                   $data=array(
                                    'CI'=>$CI
                                );   
                                    viewMarks($data);
                            }break;
                        case "mail_manage_staff":{
                            include('includes.php');
                                      $data=array(
                                    'CI'=>$CI
                                );
                                    mailManageStaff($data);
                            }break;
                        case "manage_questions":{
                            include('includes.php');
                                      $data=array(
                                    'CI'=>$CI
                                );
                                manageQuestions($data);
                            }break;
                        case "manage_uploads":{
                            include('includes.php');
                                      $data=array(
                                    'CI'=>$CI
                                );
                                    manageUploads($data);
                            }break;
                        case "mail_students":{
                            include('includes.php');
                                      $data=array(
                                    'CI'=>$CI
                                );
                                    mailStudents($data);
                            }break;
                            case "bind_course":{
                                include('includes.php');
                                $data=array(
                                    'CI'=>$CI
                                );
                            bind_course($data);
                                
                            }break;
                        case "manage_bind":{
                            include('includes.php');
                                $data=array(
                                    'CI'=>$CI
                                );
                            manage_bind($data);
                                
                            }break;
                            case "create_department":{
                            include('includes.php');
                                
                            }break;
                            case "create_courses":{
                                include('includes.php');
                                $data=array(
                                    'CI'=>$CI
                                );
                                      
                                    create_courses($data);
                            }break;
                            case "create_exams":{
                                include('includes.php');
                                $data=array(
                                    'CI'=>$CI
                                );
                                createExams($data);
                                
                            }break;
                        case "manage_papers":{
                            include('includes.php');
                                $data=array(
                                    'CI'=>$CI
                                );
                                      
                                    manage_papers($data);
                            }break;
                            case "create_department":{
                                include('includes.php');
                                
                            }break;
                        case "manage_staff":{
                            include('includes.php');
                            
                            $data=array(
                                'CI'=>$CI
                            );
                                manageStaff($data);
                               
                            }break;
                         case "manage_exams":{
                            include('includes.php');
                            
                            $data=array(
                                'CI'=>$CI
                            );
                            manageExams($data);
                               
                            }break;
                        case "create_class":{
                            include('includes.php');
                            $data=array(
                                'CI'=>$CI
                            );
                                createClass($data);
                               
                            }break;
                        case "manage_attendance":{
                            include('includes.php');
                            $data=array(
                                'CI'=>$CI
                            );
                                manageAttendance($data);
                               
                            }break;
                        case "manage_docs":{
                            include('includes.php');
                            $data=array(
                                'CI'=>$CI
                            );
                            manageDocs($data);
                               
                            }break;
                         case "assign_staff":{
                             include('includes.php');
                             $data=array(
                                'CI'=>$CI
                            );
                                assignStaff($data);
                               
                            }break;
                        case "manage_class":{
                            include('includes.php');
                            $data=array(
                                'CI'=>$CI
                            );
                                manageClass($data);
                               
                            }break;
                         
                        
                            
                            default:show_404();
                        }
                            ?>
                            
                       <hr/>
                       <p style="text-align:right; font-size: 11px;">Powered by Department of CS</p>
                        <!-- Insert your code here, in this div only -->

                        
                    
                  
               
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


<?php

function viewMarks($data){

?>
<h1>View Exam Results</h1>
<hr/>
<div class='row'>
    <div class='col-lg-8'>
        <div class="panel panel-default">
                        <div class="panel-heading">
                            View Exam Results
                            <select onChange='findExam(this);' name='examId' class='form-control' style="width:40%;">
                              <option>Select Exam</option>
                                <?php
                             $sql="select * from exams where course_id IN(select distinct id from courses where dept_id={$_SESSION['dept_id']} and active=1) and state IN('CLOSED','DECLARED');";
                             echo $sql;
                             $sql=$data['CI']->db->query($sql);
                             foreach($sql->result_array() as $row){
                                 ?>
                               
                                <option value='<?php echo urlencode($data['CI']->encryption->encrypt($row['exam_id']));?>'><?php echo $row['exam_name'];?></option>
                            <?php
                                }
                             ?>
                             
                             
                            </select>
                        </div>
            <script>
            function findExam(data){
             location.href="<?php echo base_url('hod/page/viewMarks?exam_id=');?>"+data.value;
            }
            </script>
            <?php
            $exam_id=$data['CI']->encryption->decrypt($data['CI']->input->get('exam_id'));
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
                                        $exam_id=$data['CI']->encryption->decrypt($data['CI']->input->get('exam_id'));
                                        if($exam_id){
                                        
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
function manageAttendance($data){
   
    ?><h1>Manage Attendance</h1><div class="row">
        <hr/>
        <div class="col-lg-4">
            
            <?php
            if(validation_errors()){
                ?><div class='alert alert-danger'>
                    <?php echo validation_errors();?>
                </div>
            <?php
            }
            
            
            if($data['CI']->input->post('level')==1){
                ?>
            <form action="<?php echo base_url('/hod/page/manageAttendance');?>" method="post">
                <input type="hidden" name="course" value="<?php echo $data['CI']->input->post('course');?>">
                <div class="form-group">
                    <label>Semester</label>
                </div>
                 <div class="form-group">
                     <select name="semester" class="form-control">
                         <?php
                         $courseId=$data['CI']->encryption->decrypt($data['CI']->input->post('course'));
                         if($courseId){
                             
                         
                         $sql="select semesters from courses where id={$courseId}";
                         $sql=$data['CI']->db->query($sql);
                            $sql=$sql->row_array();
                         $i=1;
                            while($sql['semesters']>=$i){
                              ?>
                         <option value="<?php echo $data['CI']->encryption->encrypt($i);?>"><?php echo $i;?></option>
                         <?php
                         $i++;
                            }
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
            
            }elseif($data['CI']->input->post('level')==2){
            $course=$data['CI']->input->post('course');
            $courseId=$data['CI']->encryption->decrypt($course);
             $semester=$data['CI']->input->post('semester');
            $semsterId=$data['CI']->encryption->decrypt($semester);
            if($courseId and $semsterId){
                
                 $year=findAcademicYearByCourseIdSemester($courseId, $semsterId); 
                 if($year){
                     ?>
            <form action="<?php echo base_url('hod/manageAttendance');?>" method="post">
                <div class="form-group">
                    <label>Academic Year</label>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" disabled="disabled" name="year" value="<?php echo $year;?>">
                </div>
                <div class="form-group">
                    <label>Total Attendance</label>
                </div>
                <div class="form-group">
                    <input name='totalDays' class="form-control" type="number">
                </div>
                 <div class="form-group">
                     <input type="hidden" name="semester" value="<?php echo $semester;?>">
                     <input type="hidden" name="course" value="<?php echo $course;?>">
                     <input type="hidden" name="year" value="<?php echo $data['CI']->encryption->encrypt($year);?>">
                    <input type="submit" value="Save" class="btn btn-primary">
                </div>
            </form>
                     <?php
                     
                     
                 }else{
                     show_error('No Academic Year found with this data | Contact Super User');
                 }
                
            }
           
            }
                else{
                
            
                ?>
            
            <form action="<?php echo base_url('/hod/page/manageAttendance');?>" method="post">
                <div class="form-group">
                    <label>Course Name</label>
                </div>
                <div class="form-group">
                    <select name="course" class="form-control">
                        <?php
                        $sql="select * from courses where dept_id={$_SESSION['dept_id']} and active=1";
                        $sql=$data['CI']->db->query($sql);
                        foreach($sql->result_array() as $row){
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
            ?>
        </div>
        
</div>
    <?php
}
function manageUploads($data){
    ?>
    <h1>Manage Files</h1><hr/><div class="row">
        <div class="col-lg-4">
            
                <?php echo form_open_multipart('hod/manageUploads');?>
                <div class="form-group">
                    <label>File <label>
                    
                </div>
                 <div class="form-group">
                     <input type="file" class="form-control" name="files">
                    
                </div>
                <div class="form-group">
                     <input type="submit" class="btn btn-primary" name="Upload">
                    
                </div>
            </form>
            
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                        <div class="panel-heading">
                           Public File Management
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>File Name</th>
                                            <th>Log</th>
                                            <th>URL | View</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                           <?php
                                           $sql="select * from email_files where author_id={$_SESSION['uid']} and active=1";
                                           $sql=$data['CI']->db->query($sql);
                                           foreach($sql->result_array() as $row){
                                               ?>
                                            <tr>
                                            <td><?php echo $row['file_name'];?></td>
                                            <td><?php echo $row['log'];?></td>
                                            <td><p onClick='prompt("File URL","<?php echo base_url('uploads/'.$row['file_name']);?>");'>Click Here |</p> <a target="_BLANK" href='<?php echo base_url('uploads/'.$row['file_name']);?>'>View</a></td>
                                            <td><a href='<?php echo base_url('hod/page/manageUploads?del='); echo urlencode($data['CI']->encryption->encrypt($row['id']));?>'>Delete</a></td>
                                            </tr>
<?php
                                           }
                                           
                                           
                                           ?>
                                        </tr>
                                        
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
    if($data['CI']->encryption->decrypt($data['CI']->input->get('del'))){
        
        $sql="update email_files set active=0 where id={$data['CI']->encryption->decrypt($data['CI']->input->get('del'))}";
       echo $sql;
        $sql=$data['CI']->db->query($sql);
        ?>
        <script>
            window.alert('File Deleted');
            location.href="<?php echo base_url('hod/page/manageUploads');?>";
            </script>
            <?php
    }
    
   
}
function manageDocs($data){
    ?>
<h1>Manage E-Library</h1><hr/>
<div class="row">


                <div class="col-lg-3">
                    <?php
              if(validation_errors()){
                  ?><div class="alert alert-danger">
                      <?php echo validation_errors();?>
                </div>
                <?php
             
                }
              
              
              
              ?>
            
                    
                <?php echo form_open_multipart('hod/manageDocs');?>
                <div class="form-group">
                        <label>E-Paper Name</label>
                        
                </div>
                    <div class="form-group">
                        <input type="text" name="ename" class="form-control" placeholder="2013 MG QUESTION PAPER">
                        
                </div>
                <div class="form-group">
                    <label>Select Paper</label>
                </div>
                
                <div class="form-group">
                <select class="form-control" name="paper">
                     <?php
                     $sql="select * from papers where dept_code={$_SESSION['dept_id']} order by paper_name";
                     $sql=$data['CI']->db->query($sql);
                     foreach($sql->result_array() as $row){
                       ?>
                        <option value="<?php echo $data['CI']->encryption->encrypt($row['paper_id']);?>"><?php echo findPaperName($row['paper_id']);?></option>
                        <?php
                         
                     }
                     
                     
                     ?>
                    </select>
                    
                </div>
                <div class="form-group">
                    <input type="file" name="efile" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" value="Upload" class="btn btn-primary">
                </div>
                
            </form>
            
            
</div>
    <div class="col-lg-8">
        <div class="panel panel-default">
                        <div class="panel-heading">
                           E-Library Management
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>File Name</th>
                                            <th>Paper Name</th>
                                            <th>Log</th>
                                            <th>URL | View</th>
                                            <th>Action</th>
                                            <th>Author</th>
                                                                                        

                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                           <?php
                                           $sql="select * from epaper where paper_id in(select paper_id from papers where dept_code={$_SESSION['dept_id']}) and active=1";
                                           $sql=$data['CI']->db->query($sql);
                                           foreach($sql->result_array() as $row){
                                               ?>
                                            <tr>
                                            <td><?php echo $row['ename'];?></td>
                                            <td><?php echo findPaperName($row['paper_id']);?></td>
                                            <td><?php echo $row['log'];?></td>
                                            <td><p onClick='prompt("File URL","<?php echo base_url('uploads/'.$row['file_name']);?>");'>Click Here |</p> <a target="_BLANK" href='<?php echo base_url('uploads/'.$row['file_name']);?>'>View</a></td>
                                            <td><a href='<?php echo base_url('hod/page/manageDocs?del='); echo urlencode($data['CI']->encryption->encrypt($row['id']));?>'>Delete</a></td>
                                            <td><?php echo findUsername($row['author_id']);?></td>
                                            </tr>
<?php
                                           }
                                           
                                           
                                           ?>
                                        </tr>
                                        
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
    if($data['CI']->encryption->decrypt($data['CI']->input->get('del'))){
        
        $sql="update epaper set active=0 where id={$data['CI']->encryption->decrypt($data['CI']->input->get('del'))}";
       echo $sql;
        $sql=$data['CI']->db->query($sql);
        ?>
        <script>
            window.alert('File Deleted');
            location.href="<?php echo base_url('hod/page/manageDocs');?>";
            </script>
            <?php
    }


}
function mailStudents($data){
    ?>
    <h1>Email Students</h1>
    <hr/>
    <div class="row">
        
            <?php
            if($data['CI']->input->post('level')==1){
                $classId=$data['CI']->encryption->decrypt($data['CI']->input->post('class'));
                ?>
            <div class="col-lg-6">
                <div class="alert alert-success">
                    Class Teacher Name:<?php echo findUsername(findClassTeacherFromClassId($classId));?>
                    <br>Class Name:<?php echo findClassName($classId);?>
                </div>
         
              
                <form action="<?php echo base_url('hod/mailStudents');?>" method="post">
                <input type="hidden" name="class" value="<?php echo $data['CI']->encryption->encrypt($classId);?>">
                    <div class="form-group">
                    <label>Subject</label>
                </div>
                <div class="form-group">
                    <input required="" type="text" name="subject" class="form-control" placeholder="Email Subject Goes here...">
                </div>
                <div class="form-group"><textarea name="body">Hello, Type here..<br><hr/>Powered By AES</textarea>
            </div>
                <div class="form-group"><input type="submit" class="btn btn-primary" value="Send Email">
                </div>
                </form>
                <?php
                
                
            
                
            }else{
                ?>
                <div class="col-lg-4">
                    <?php
              if(validation_errors()){
                  ?><div class="alert alert-danger">
                      <?php echo validation_errors();?>
                </div>
                <?php
             
                }
              
              
              
              ?>
            <form action="" method="post">
                <div class="form-group">
                    Select Class
                </div>
                <div class="form-group">
                    <select class="form-control" name="class">
                     <?php
                     $sql="select * from deptclass where dept_id={$_SESSION['dept_id']} order by className";
                     $sql=$data['CI']->db->query($sql);
                     foreach($sql->result_array() as $row){
                       ?>
                        <option value="<?php echo $data['CI']->encryption->encrypt($row['classid']);?>"><?php echo $row['className'];?></option>
                        <?php
                         
                     }
                     
                     
                     ?>
                    </select>
                    <input type="hidden" name="level" value="1">
                </div>
                <div class="form-group">
                    <input type="submit" value="Next" class="btn btn-primary">
                </div>
                
            </form>
            
            <?php    
            }
            
            
            ?>
        </div>
        
    </div>
    
    
    <?php
    
}
function mailManageStaff($data){
    ?>
    <h1>Manage Email</h1>
    <hr/>
    <div class="row">
        <div class="col-lg-6">
            
            <?php
            
            if(validation_errors()){
                ?>
            <div class="alert alert-danger">
                    <?php echo validation_errors();?>
            </div>
                <?php
            }else{}
            if($data['CI']->input->post('level')==1){
               if($data['CI']->input->post('staff')){
                   
               
                   ?>
            <form action="<?php echo base_url('hod/manageMailStaff');?>" method="post">
                <div class="form-group">
                    <?php
                    $_SESSION['temp_data']=$data['CI']->input->post('staff');
                    
                    
                    
                    ?>
                    <label>Subject</label>
                </div>
                <div class="form-group">
                    <input required="" type="text" name="subject" class="form-control" placeholder="Email Subject Goes here...">
                </div>
                <div class="form-group"><textarea name="body">Hello, Type here..<br><hr/>Powered By AES</textarea>
            </div>
                <div class="form-group"><input type="submit" class="btn btn-primary" value="Send Email">
                </div>
                 <?php
               
               }
               else{
                   show_error($message='At Least a staff');
               }
               }else{
                
            ?>
            <form action="<?php echo base_url('/hod/page/manageMailStaff');?>" method="post">
                <div class="form-group">
                    <label class="checkbox-inlines">Staff</label>
                    
                        <?php
                    $sql="select * from users where user_type='staff' and userid IN(select id from staffdept where dept_id={$_SESSION['dept_id']})";
                    $sql=$data['CI']->db->query($sql);
                    foreach ($sql->result_array() as $row){
                        ?>
                    <br>
                        <input value="<?php echo $data['CI']->encryption->encrypt($row['userid']);?>" type="checkbox" name="staff[]"><?php echo findUsername($row['userid']);?>
                        
                    <?php
                    
                    }
                    ?>
                    
                    
                        <br> <input type="checkbox" onclick="selectAll(this);"><b>Select All</b>
                </div>
                <div class="form-group">
                    <input type="hidden" value="1" name="level">
                    <input type="submit" value="Next" class="btn btn-primary">
                </div>
                
                
                
            </form>
          <script>
              function selectAll(source) {
  checkboxes = document.getElementsByName('staff[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
          <?php
            }
           ?>
          
          
          
            
        </div>
        
    </div>
        <?php
    
}
function create_staff($data='')
{
    ?>
    <h1>Create Staff User</h1>

<div class="row">
                <div class="col-lg-6">
                    <div class="alert alert-success">
                               Default Password will be :    password@123
                            </div>
                     <?php if(validation_errors()){?><div class="alert alert-danger"><?php echo validation_errors();?></div><?php }?>
            <form action="<?php echo base_url("/hod/createStaff");?>" method="post">
                
                 <div class="form-group">
                    <label>UserName</label>
                    <input value="<?php echo set_value('username');?>" style="width:50%;" type="text" class="form-control" name="username">
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input value="<?php echo set_value('name');?>" style="width:50%;" type="text" class="form-control" name="name">
                </div>
                                <div class="form-group">
                    <label>Email</label>
                    <input value="<?php echo set_value('email');?>" style="width:50%;" type="text" class="form-control" name="email">
                </div>
                                <div class="form-group">
                    <label>Phone</label>
                    <input value="<?php echo set_value('phone');?>" style="width:50%;" type="text" class="form-control" name="phone">
                </div>
                                <div class="form-group">
                    
                                    <input style="width:50%;" type="submit" class="btn btn-primary" value="Save">
                </div>
            </form>
                                
                    
    <?php
}
function manage_papers($data){
    ?>
        <h1>Manage Course Papers</h1>
        <div class="row">
                <hr/>
                <div class="lg col-lg-8">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                            Semester
                            <select onChange="paperSem(this);" style="width:30%;"name="semester" class="form-control">
                                <option>Select Semester</option>
                                <?php 

                                $query="select distinct semester from papers where dept_code={$_SESSION['dept_id']} order by semester"; 
                                
                                $result=$data['CI']->db->query($query);
                                foreach($result->result_array() as $row)
                                {
                                    ?>
                                <option value="<?php echo urlencode($data['CI']->encryption->encrypt($row['semester']));?>"><?php echo $row['semester'];?></option>
                                <?php 
                                }
                                ?>
                                <option value="all">All Semester</option>
                            </select>
                            <script>
                            function paperSem(url){
                                if(url.value=="all")
                                {
                                 location.href="<?php echo base_url("hod/page/managePapers");?>";
                                }
                                else
                                {
                                    
                                  location.href="<?php echo base_url("hod/page/managePapers");?>?sem="+url.value;     
                                }
                              
                            }
                                
                                
                                </script>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            
                                            <th>Semester</th>
                                            <th>Paper Name</th>
                                            <th>Code</th>
                                            <th>Course</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(isset($_GET['sem']) and is_numeric($data['CI']->encryption->decrypt($_GET['sem'])))
                                        {
                                         $sem=$data['CI']->encryption->decrypt($_GET['sem']);
                                        $query="select * from papers where dept_code={$_SESSION['dept_id']} and semester={$sem} order by semester ";
                                        }
                                        else{
                                        $query="select * from papers where dept_code={$_SESSION['dept_id']} order by semester ";
                                        }
                                        
                                        
                                        $result=$data['CI']->db->query($query);
                                        foreach ($result->result_array() as $row)
                                        {
                                            
                                        ?>
                                        <tr>
                                            <td><?php echo $row['semester'];?></td>
                                            <td><?php echo $row['paper_name'];?></td>
                                            <td><?php echo $row['paper_code'];?></td>
                                            <td><?php 
                                            $sqlCourse="select courseName from courses where id={$row['course_id']}";
                                            $sqlCourse=$data['CI']->db->query($sqlCourse);
                                            $sqlCourse=$sqlCourse->row_array();
                                            echo $sqlCourse['courseName'];?>
                                            </td>
                                            
                                            <td>
                                   <button onclick="removePaper();"class="btn btn-outline">Delete Paper</button>
                                            </td>
                                            
                                        </tr>
                                        <?php 
                                        }
                                        ?>
                                                                                              
                                        
                                    </tbody>
                                </table>
                                <script>
                                    function removePaper()
                                    {
                                      var con=confirm("Staff Linked with this paper will be removed . Action cannot be undone!! ");  
                                      if(con)
                                      {
                                             location.href="<?php echo base_url("hod/page/managePapers?remove=");?>"+"<?php echo urlencode($data['CI']->encryption->encrypt($row['paper_id']));?>";
                                      }
                                      else
                                      {
                                          
                                          location.href="<?php echo base_url("hod/page/managePapers");?>";
                                        }
                                          
                                    }
                                    </script>
                                                        </div>
                            <!-- /.table-responsive -->
                            <?php
                            if(isset($_GET['remove']) and is_numeric($data['CI']->encryption->decrypt($_GET['remove']))){
                             $query="delete from papers where paper_id=?";
                             $remove=$data['CI']->encryption->decrypt($_GET['remove']);
                             
                             $data['CI']->db->query($query,array($remove));
                             $query="delete from staffpaper where paper_id=?";
                             $data['CI']->db->query($query,array($remove));
                             
                             ?>
                            <script>
                                window.alert("Paper Deleted Successfully");
                                location.href="<?php echo base_url("hod/page/managePapers");?>";
                            </script>
                             <?php
                            }
                            ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
        
     
                             
                           
                    
                    
                    
                    
                 </div>
        </div>
    <?php 
}
function bind_course($data){
    

    ?>
                     <h1>Assign staff to Class Papers</h1>
                     <hr/>
         <div class="row">            
<div class="col-lg-4">
    <script type="text/javascript">
    function bindCourse(j){
        location.href="<?php echo base_url('hod/page/bindCourse/?course=');?>"+j.value;
    }
    </script> 
    
                <?php
                if(!isset($_POST['className'])){
                    ?>
                
                    <form action="<?php echo base_url('/hod/page/bindCourse');?>" method="post">
                         <div class="form-group">
                            <label>Course</label>
                            <?php
                            $course=$data['CI']->input->get('course');
                            
                            $course=$data['CI']->encryption->decrypt($course);
                            if($course){
                                
                                ?><input class='form-control' disabled="" type="text" value="<?php echo findCourseName($course);?>">
                                  <input type='hidden' value='<?php echo $data['CI']->encryption->encrypt($course);?>' name='course'>
                                  
                             <?php
                                
                            }else{
                                
                            ?>
                            <select onchange="bindCourse(this);"class="form-control">
                                 <option>Select A Course</option>
                                 <?php
                                 $sql="select * from courses where dept_id={$_SESSION['dept_id']} and active=1";
                                 $sql=$data['CI']->db->query($sql);
                                 foreach ($sql->result_array() as $row){
                                     ?>
                                 <option value="<?php echo urlencode($data['CI']->encryption->encrypt($row['id']));?>"><?php echo $row['courseName'];?></option>
                                 <?php
                                 }
                                 ?>
                             </select>
                         <?php
                            }?>
                            </div>
                        <div class="form-group">
                            <label>Class Name</label>
                            <select name="className" class="form-control">
                                
                               
                                <?php 
                                if($course){
                                   $sql="select * from deptClass where course_id={$course}";
                                   $sql=$data['CI']->db->query($sql);
                                   foreach($sql->result_array() as $row){
                                       
                                       ?>
                                <option value='<?php echo $data['CI']->encryption->encrypt($row['classid']);?>'><?php echo $row['className'];?></option>
                                    <?php
                                       
                                   }
                                   
                                }else{
                                     ?><option>Select a semester</option><?php
                                }
                                  ?>
                            </select>
                            
                        </div>
                        <div class="form-group">
                            <input class='btn btn-primary' type='submit' name='submit1' value='Next'>
                        </div>
                    </form>
    <?php
                }  else {
                    
                    ?>
    <form action='<?php echo base_url('hod/bindCourse');?>' method='post'>
        <div class='form-group'>
            <label>
                Paper Name
                 </label>
                <select name='papername' class='form-control'>
                    <?php
                    $course=$data['CI']->input->post('course');
                    $classId=$data['CI']->input->post('className');
                    
                    $courseW=$data['CI']->encryption->decrypt($course);
                    $classIdW=$data['CI']->encryption->decrypt($classId);
                    if($course and $classId){
                    $sql="select * from papers where course_id={$courseW} and semester=(select semester from deptclass where classid={$classIdW})";
                      //echo $sql;
                     $sql=$data['CI']->db->query($sql);
                     foreach ($sql->result_array() as $row){
                        
                         ?>
                    <option value='<?php echo $data['CI']->encryption->encrypt($row['paper_id']);?>'><?php echo $row['paper_name'];?></option>
                       <?php
                       }
                      }
                   
                    ?>
                   
                </select>
           <input type="hidden" name="course" value="<?php echo $course;?>">
           <input type="hidden" name="className" value="<?php echo $classId;?>">
           
        </div>
        <div class='form-group'>
            <label>Staff Name</label>
            <select name='staff' class='form-control'>
                <?php
                $sql="select * from users where active=1 and userid IN(select id from staffdept where dept_id={$_SESSION['dept_id']})";
                $sql=$data['CI']->db->query($sql);
                foreach ($sql->result_array() as $row){
                    ?>
                <option value="<?php echo $data['CI']->encryption->encrypt($row['userid']);?>"><?php echo $row['name'];?></option>
               <?php
                }
                ?>
                
            </select>
        </div>
        <div class='form-group'>
            <input type="submit" value="Bind Course" class="btn btn-primary">
            
        </div>
    </form>
               <?php     
                }
                ?>
            </div>
    </div>
                     <?php 
}
function manageQuestions($data){
    ?>
                     <h1>Manage Question Papers</h1><div class="row">
                         <hr/>
                         <script>
                        function examState(j){
                        location.href="<?php echo base_url('hod/page/manageQuestions/?state=');?>"+j.value;    
                        }
                         </script>
                         <div class="col-lg-12">
                             <div class="panel panel-default">
                        <div class="panel-heading">
                            Manage Exam Question Papers
                            <br><label>Paper State</label><select style="width: 40%;"onChange="examState(this);" class="form-control" name="examState">
                                <option>Select Exam state | [Displays all state]</option>
                                <option value="PENDING">PENDING</option>
                                <option value="REJECTED">REJECTED</option>
                                <option value="APPROVED">APPROVED</option>
                              
                                
                                
                            </select>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                         <tr>
                                            <th>Exam Name</th>
                                            <th>Paper Name</th>
                                            <th>Class Name</th>
                                            <th>Download</th>
                                            <th>Status</th>
                                            <th>Author</th>
                                            <th>Action</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $state=$data['CI']->input->get('state');
                                        if($state=='PENDING' or $state=='REJECTED' or $state=='APPROVED' or $state=='PENDING'){
                                       $sql="select * from question_papers where state='{$state}' and active=1 and paper_id IN(select paper_id from papers where dept_code={$_SESSION['dept_id']})";
                                        }else
                                        {
                                    $sql="select * from question_papers where active=1 and paper_id IN(select paper_id from papers where dept_code={$_SESSION['dept_id']})";
                                        }
                                       // echo $sql;
                                    $sql=$data['CI']->db->query($sql);
                                    
                                    ?>
                                       <?php
                                           
                                           //$sql="select * from question_papers where author_id={$_SESSION['uid']} and active=1";
                                           //$sql=$data['CI']->db->query($sql);
                                           foreach($sql->result_array() as $row){
                                               ?>
                                            <tr>
                                                <td><?php echo findExamNamefromId($row['exam_id']);?></td>
                                            <td><?php echo findPaperName($row['paper_id']);?></td>
                                            <td><?php echo findClassName(findClassIdFromExamId($row['exam_id']));?></td>
                                            <td><a target="_BLANK" href='?download=<?php echo urlencode($data['CI']->encryption->encrypt($row['file_name']));?>'>Download</a></td>
                                            <td><button class="btn btn-warning"><?php echo $row['state'];?></button></td>
                                            <td><?php echo findUsername($row['author_id']);?></td>
                                            <td>
                                            <a href='<?php echo base_url('hod/page/manageQuestions?del='); echo urlencode($data['CI']->encryption->encrypt($row['qid']));?>'>Delete</a>
                                            <a href='<?php echo base_url('hod/page/manageQuestions?approve='); echo urlencode($data['CI']->encryption->encrypt($row['qid']));?>'>Approve</a>
                                            <a href='<?php echo base_url('hod/page/manageQuestions?reject='); echo urlencode($data['CI']->encryption->encrypt($row['qid']));?>'>Reject</a>
                                            <a href='<?php echo base_url('hod/page/manageQuestions?pending='); echo urlencode($data['CI']->encryption->encrypt($row['qid']));?>'>Pending</a>

                                            
                                            </td>

                                            </tr>
                                            <?php
                                           }
                                           
                                           
                                           ?>
    
                                <?php
                                
                                          
                                        
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
    if($data['CI']->input->get('del')){
        $exam_id=$data['CI']->input->get('del');
        $exam_id=$data['CI']->encryption->decrypt($exam_id);
        
        $sql="update question_papers set active=0 where qid={$exam_id}";
      // echo $sql;
        $data['CI']->db->query($sql);
        ?><script>
            window.alert("Question Paper deleted successfully");
            location.href="<?php echo base_url('hod/page/manageQuestions');?>";
            </script><?php
            
        
    }
        if($data['CI']->input->get('approve')){
        $exam_id=$data['CI']->input->get('approve');
        $exam_id=$data['CI']->encryption->decrypt($exam_id);
        
        $sql="update question_papers set state='APPROVED' where qid={$exam_id}";
      // echo $sql;
        $data['CI']->db->query($sql);
        ?><script>
            window.alert("Question Paper Apporved successfully");
            location.href="<?php echo base_url('hod/page/manageQuestions');?>";
            </script><?php
            
        
    }
            if($data['CI']->input->get('pending')){
        $exam_id=$data['CI']->input->get('pending');
        $exam_id=$data['CI']->encryption->decrypt($exam_id);
        
        $sql="update question_papers set state='PENDING' where qid={$exam_id}";
      // echo $sql;
        $data['CI']->db->query($sql);
        ?><script>
            window.alert("Question Paper  successfully changed to Pending State");
            location.href="<?php echo base_url('hod/page/manageQuestions');?>";
            </script><?php
            
        
    }
            if($data['CI']->input->get('reject')){
        $exam_id=$data['CI']->input->get('reject');
        $exam_id=$data['CI']->encryption->decrypt($exam_id);
        
        $sql="update question_papers set state='REJECTED' where qid={$exam_id}";
      // echo $sql;
        $data['CI']->db->query($sql);
        ?><script>
            window.alert("Question Paper Rejected successfully");
            location.href="<?php echo base_url('hod/page/manageQuestions');?>";
            </script><?php
            
        
    }
    if($data['CI']->input->get('download')){
    
    $url="./Questions/".$data['CI']->encryption->decrypt($data['CI']->input->get('download'));
    
    force_download($url, NULL);
}
   
    
    
}
function manageExams($data){
    ?>
                     <h1>Manage Examss</h1><div class="row">
                         <hr/>
                         <script>
                        function examState(j){
                        location.href="<?php echo base_url('hod/page/manageExams/?state=');?>"+j.value;    
                        }
                         </script>
                         <div class="col-lg-12">
                             <div class="panel panel-default">
                        <div class="panel-heading">
                            Manage Exams
                            <br><label>Exam State</label><select style="width: 40%;"onChange="examState(this);" class="form-control" name="examState">
                                <option>Select Exam state | [Displays all state]</option>
                                <option value="DECLARED">Declared</option>
                                <option value="CLOSED">Closed</option>
                                
                            </select>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Exam Name</th>
                                            <th>Class Name</th>
                                            
                                            <th>Course</th>
                                            <th>Paper</th>
                                            <th>Semester</th>
                                            <th>Staff</th>
                                            <th>Year</th>
                                            <th>Exam Date</th>
                                            <th>Created By</th>
                                            <th>Actions</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $state=$data['CI']->input->get('state');
                                        if($state=='DECLARED' or $state=='CLOSED'){
                                       $sql="select * from exams where state='{$state}' and dept_id={$_SESSION['dept_id']}";
                                        }else
                                        {
                                    $sql="select * from exams where dept_id={$_SESSION['dept_id']} and state NOT IN('DELETED')";
                                        }
                                    $sql=$data['CI']->db->query($sql);
                                    foreach ($sql->result_array() as $row){
                                    ?>
                                        <tr>
                                            <td><?php echo $row['exam_name'];?></td>   
                                            <td><?php echo findClassName($row['class_id'])?></td> 
                                            <td><?php echo findCourseName($row['course_id'])?></td>
                                            <td><?php echo findPaperName($row['paper_id']);?></td>
                                            <td><?php echo $row['semester'];?></td> 
                                            <td><?php echo findStaffNamePaper($row['paper_id'],$row['class_id']);?></td>
                                             <td><?php echo $row['academic_year'];?></td> 
                                             <td><?php echo $row['examDate'];?></td> 
                                             <td><?php echo findUsername($row['author_id']);?></td> 
                                             <td>
                                                 <a href="?del=<?php echo urlencode($data['CI']->encryption->encrypt($row['exam_id']));?>"> <button class="btn btn-primary">Delete Exam</button></a>
                                                <?php 
                                                if($row['state']=='CLOSED'){
                                                 ?>
                                            <br><br><a href="?open=<?php echo urlencode($data['CI']->encryption->encrypt($row['exam_id']));?>"> <button class="btn btn-danger">Re-Open Exam</button></a>
                                            <?php                                                        
                                                }else
                                                {
                                                 ?>
                                            <br><br><a href="?close=<?php echo urlencode($data['CI']->encryption->encrypt($row['exam_id']));?>"> <button class="btn btn-danger">Close Exam</button></a>
                                                 <?php
                                                }
                                               ?>  
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
                             
                         </div>
                     </div>
                     
                     
                   
    <?php
    if($data['CI']->input->get('del')){
        $exam_id=$data['CI']->input->get('del');
        $exam_id=$data['CI']->encryption->decrypt($exam_id);
        
        $sql="update exams set state='DELETED' where exam_id={$exam_id}";
       
        $data['CI']->db->query($sql);
        ?><script>
            window.alert("Exam deleted successfully");
            location.href="<?php echo base_url('hod/page/manageExams');?>";
            </script><?php
            
        
    }
    if($data['CI']->input->get('close')){
        $exam_id=$data['CI']->input->get('close');
       //  echo $exam_id;
        $exam_id=$data['CI']->encryption->decrypt($exam_id);
       
        $sql="update exams set state='CLOSED' where exam_id={$exam_id}";
       //echo $sql;
       $data['CI']->db->query($sql);
        ?><script>
            window.alert("Exam Closes successfully | No more provision to update mark sheet");
        location.href="<?php echo base_url('hod/page/manageExams');?>";
            </script><?php
            
        
    }
    if($data['CI']->input->get('open')){
        $exam_id=$data['CI']->input->get('open');
       //  echo $exam_id;
        $exam_id=$data['CI']->encryption->decrypt($exam_id);
       
        $sql="update exams set state='DECLARED' where exam_id={$exam_id}";
       //echo $sql;
       $data['CI']->db->query($sql);
        ?><script>
            window.alert("Exam Re Opened successfully | Exam marks can be now updated");
        location.href="<?php echo base_url('hod/page/manageExams');?>";
            </script><?php
            
        
    }
    
}

function createExams($data){
    ?>
                     
                          <script type="text/javascript">
    function bindCourse(j){
        location.href="<?php echo base_url('hod/page/createExams/?course=');?>"+j.value;
    }
    </script> 
                         <h1>Create Exams</h1>
                         <hr/>
                         <div class="row">
                              <?php
                             if(validation_errors()){
                                 ?>
                             <div class=" alert alert-danger">
                                 <?php 
                                 echo validation_errors();
                                 ?>
                             </div>
                             <?php
                             
                             }
                             ?>
                             <div class="col-lg-4">
                                
                                 <?php
                                
                                 if($data['CI']->input->post('level')==1){
                                  ?>
                                 <form action="<?php echo base_url('/hod/page/createExams');?>" method="post">
                                     
                                     <input type="hidden" name="semester" value="<?php echo $data['CI']->input->post('semester');?>">
                                     <input type="hidden" name="course" value="<?php echo $data['CI']->input->post('course');?>">
                                     <div class="form-group">
                                     <label>
                                         Select Class
                                     </label> 
                                         <br>
                                       <?php 
                                       $courseId=$data['CI']->encryption->decrypt($data['CI']->input->post('course'));
                                       $semesterId=$data['CI']->encryption->decrypt($data['CI']->input->post('semester'));
                                       if($courseId and $semesterId){
                                           
                                       
                                       $sql="select * from deptclass where course_id={$courseId} and semester={$semesterId}";
                                       $sql=$data['CI']->db->query($sql);
                                       foreach ($sql->result_array() as $row){
                                           ?>
                                         <label class="checkbox-inline">
                                               <input type="checkbox" name="className[]" value="<?php echo $data['CI']->encryption->encrypt($row['classid']);?>"><?php echo  $row['className'];
                                               ?></label><?php  
                                       }
                                       ?>
                                       
                                         
                                     </div>
                                     <div class="form-group">
                                         <label>Papers</label>
                                         <?php
                                         $courseId=$data['CI']->encryption->decrypt($data['CI']->input->post('course'));
                                       $semesterId=$data['CI']->encryption->decrypt($data['CI']->input->post('semester'));
                                       $sql="select * from papers where course_id={$courseId} and semester={$semesterId}";
                                       $sql=$data['CI']->db->query($sql);
                                       foreach ($sql->result_array() as $row){
                                           ?>
                                         <br>
                                         <label class="checkbox-inline">
                                               <input type="checkbox" name="paperName[]" value="<?php echo $data['CI']->encryption->encrypt($row['paper_id']);?>"><?php echo  $row['paper_name'];
                                               ?></label><?php  
                                       }
                                       ?>
                                         
                                     </div>
                                     <div class="form-group">
                                         <label>Exam Name</label>
                                         <input placeholder=" BCA-2013-INTERNAL4-SEM4" type="text" name="examName" class="form-control">
                                         
                                     </div>
                                     <div class="form-group">
                                         <label>Maximum Mark</label>
                                         <input type="number" name="maxMark" class="form-control">
                                         
                                     </div>
                                     <div class="form-group">
                                         <label>Minimum Mark</label>
                                         <input type="number" name="minMark" class="form-control">
                                         
                                     </div>
                                     <div class="form-group">
                                         <label>Exam Date</label>
                                         <input type="date" name="examDate" class="form-control">
                                         
                                     </div>
                                     <div class="form-group">
                                         <input type="hidden" name="level" value="2">
                                         <input type="submit" name="Level2" class="btn btn-primary" value="Preview Exam Card">
                                     </div>
                                     
                                 
                                 </form>
                                   
                                 <?php
                                       }
                                       else{
                                           show_404();
                                       }
                                 }elseif($data['CI']->input->post('level')==2){
                                     
        $className=$data['CI']->input->post('className');
        $paperName=$data['CI']->input->post('paperName');
        if($className and $paperName){
            
        
        $classNameId=array();
        
        foreach ($className as $id){
            $classNameId[]=$data['CI']->encryption->decrypt($id);
        }
        $paperNameId=array();
        foreach ($paperName as $id){
            $paperNameId[]=$data['CI']->encryption->decrypt($id);
        }
        
        
        $semester=$data['CI']->encryption->decrypt($data['CI']->input->post('semester'));
        $course=$data['CI']->encryption->decrypt($data['CI']->input->post('course'));
        
        if(count($className)>=1 and count($paperName)>=1 and $semester and $course){
            ?>
                             </div></div>
                             <div class="col col-lg-8">
                    <div class="panel panel-yellow">
                        <form action="<?php echo base_url('hod/createExams');?>" method="post">
                            <input type="hidden" name="examName" value="<?php echo $data['CI']->input->post('examName');?>">
                            <input type="hidden" name="examDate" value="<?php echo $data['CI']->input->post('examDate');?>">
                            <input type="hidden" name="maxMark" value="<?php echo $data['CI']->input->post('maxMark');?>">
                            <input type="hidden" name="minMark" value="<?php echo $data['CI']->input->post('minMark');?>">
                            <input type="hidden" name="course" value="<?php echo $data['CI']->input->post('course');?>">
                            <input type="hidden" name="semester" value="<?php echo $data['CI']->input->post('semester');?>">
                            
                            
                        <div class="panel-heading">
                            Exam Data Card | Preview
                        </div>
                        <div class="panel-body">
                            <div class="alert alert-success">
                                Exam Name:<?php echo $data['CI']->input->post('examName');?><br>
                                Exam Date:<?php echo $data['CI']->input->post('examDate');?>  <br>
                                Exam Max Mark:<?php echo $data['CI']->input->post('maxMark');?> <br>
                                Exam Pass Mark:<?php echo $data['CI']->input->post('minMark');?><br>
                                
                                <?php
                                            foreach ($classNameId as $id){
                                                
                                                ?>
                                <div class="alert alert-warning">
                                    
                                    <?php
                                    echo "Exam Scheduled for ".  findClassName($id);
                                    ?>
                                    <div class="alert alert-info">
                                    <?php 
                                    foreach ($paperNameId as $pid){
                                        echo "Paper Name: ".findPaperName($pid)." | Staff:".findStaffNamePaper($pid,$id)."<br>";
                                    }
                                    
                                    ?>
                                        
                                    </div>
                                    
                                    
                                    
                                </div>
                                    <?php            
                                            
                                                
                                                
                                            }
                                
                                
                                
                                ?>
                                
                                
                            </div>

                        </div>
                        <div class="panel-footer">
                            <?php
                            $createExam=array(
                                'classNameId'=>$classNameId,
                                'paperNameId'=>$paperNameId
                            );
                            $data['CI']->session->set_userdata($createExam);
                            ?>
                            <input type="submit" class="btn btn-primary" value="Save Exam">
                            </form>
                        </div>
                    </div>
                             </div>
                                 <?php
           
            
        
            
            
            
        }else
        {
            show_404();
        }
        }else{
            show_404();
        }
                                     
                                     
                                     
                                     
                                 }
                                 else
                                 {
                                     
                                 
                                     
                                 
                                     ?>
                                 <form action="<?php echo base_url('/hod/page/createExams');?>" method="post">
                                    <div class="form-group">
                            <label>Course</label>
                            <?php
                            $course=$data['CI']->input->get('course');
                            
                            $course=$data['CI']->encryption->decrypt($course);
                            if($course){
                                
                                ?><input class='form-control' disabled="" type="text" value="<?php echo findCourseName($course);?>">
                                  <input type='hidden' value='<?php echo $data['CI']->encryption->encrypt($course);?>' name='course'>
                                  
                             <?php
                                
                            }else{
                                
                            ?>
                            <select onchange="bindCourse(this);" class="form-control">
                                 <option>Select A Course</option>
                                 <?php
                                 $sql="select * from courses where dept_id={$_SESSION['dept_id']} and active=1";
                                 $sql=$data['CI']->db->query($sql);
                                 foreach ($sql->result_array() as $row){
                                     ?>
                                 <option value="<?php echo urlencode($data['CI']->encryption->encrypt($row['id']));?>"><?php echo $row['courseName'];?></option>
                                 <?php
                                 }
                                 ?>
                             </select>
                         <?php
                            }?>
                            </div>
                                     <div class="form-group">
                                         <label>Semester</label>
                                         <select class="form-control" name="semester">
                                             <?php
                                             if($course){
                                             $sql="select distinct semester from deptclass where course_id={$course}";
                                             $sql=$data['CI']->db->query($sql);
                                             foreach($sql->result_array() as $row){
                                               ?>
                                             <option value="<?php echo $data['CI']->encryption->encrypt($row['semester']);?>"><?php echo $row['semester'];?></option>
                                             <?php
                                             }
                                             }else
                                             {
                                                 ?>
                                             <option>Select a semester</option><?php
                                             
                                             }
                                             //echo $sql;
                                             ?>
                                             
                                         </select>
                                         
                                         
                                     </div>
                                     <input type="hidden" name="level" value="1">
                                     <div class="form-group">
                                         <input name="Level1" type="submit" class="btn btn-primary" value="Next">
                                     </div>
                                 
                                 </form>
                                 <?php
                                 }
                                 
                                 
                                 ?>
                                 
                                 
                                 
                             </div>
                         </div>
                     
    
    
<?php                    
}

function manage_bind($data){
    ?>
                     <h1>Manage Staff Papers</h1>
<hr/>
<div class="row">
    <div class="lg col-lg-10">
        <div class="panel panel-default">
                        <div class="panel-heading">
                            Semester
                            <select onChange="paperSem(this);" style="width:20%;"name="semester" class="form-control">
                                <option>Select Semester</option>
                                <?php 

                                $query="select distinct semester from deptclass where dept_id={$_SESSION['dept_id']} order by semester"; 
                                
                                $result=$data['CI']->db->query($query);
                                foreach($result->result_array() as $row)
                                {
                                    ?>
                                <option value="<?php echo urlencode($data['CI']->encryption->encrypt($row['semester']));?>"><?php echo $row['semester'];?></option>
                                <?php 
                                }
                                ?>
                                <option value="all">All Semester</option>
                            </select>
                            <script>
                            function paperSem(url){
                                if(url.value=="all")
                                {
                                 location.href="<?php echo base_url('hod/page/manageBind');?>";
                                }
                                else
                                {
                                    
                                  location.href="<?php echo base_url('hod/page/manageBind?sem=');?>"+url.value;     
                                }
                              
                            }
                                
                                
                                </script>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            
                                            <th>Staff Name</th>
                                            <th>Paper Name</th>
                                            <th>Class Name</th>
                                            <th>Semester</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(!empty($_GET['sem']))
                                        {
                                        $sem=$data['CI']->encryption->decrypt($_GET['sem']);
                                        }
                                        if(isset($_GET['sem']) and is_numeric($sem))
                                        {
                                            $sem=$data['CI']->encryption->decrypt($_GET['sem']);
                                            $query="select users.name,staffpaper.*,papers.paper_name,deptclass.className,deptclass.classid from users,staffpaper,papers,deptclass where staffpaper.userid=users.userid and staffpaper.paper_id=papers.paper_id and papers.dept_code={$_SESSION['dept_id']} and deptclass.semester=papers.semester and staffpaper.classid=deptclass.classid and deptclass.dept_id={$_SESSION['dept_id']} and staffpaper.semester={$sem}";
                                            //$query="select users.name,staffpaper.*,papers.paper_name,deptclass.className from users,staffpaper,papers,deptclass where staffpaper.userid=users.userid andstaffpaper.paper_id=papers.paper_id and papers.dept_code={$_SESSION['dept_id']} and deptclass.semester=papers.semester and deptclass.dept_id={$_SESSION['dept_id']}";
                                        }
                                        else
                                        {
                                            $query="select users.name,staffpaper.*,papers.paper_name,deptclass.className,deptclass.classid from users,staffpaper,papers,deptclass where staffpaper.userid=users.userid and staffpaper.paper_id=papers.paper_id and papers.dept_code={$_SESSION['dept_id']} and deptclass.semester=papers.semester and staffpaper.classid=deptclass.classid and deptclass.dept_id={$_SESSION['dept_id']}";
                                        //  $query="select users.name,staffpaper.*,papers.paper_name,deptclass.className from users,staffpaper,papers,deptclass where staffpaper.userid=users.userid and staffpaper.paper_id=papers.paper_id and papers.dept_code={$_SESSION['dept_id']} and deptclass.semester=papers.semester";

                                        }
                                        
                                        $result=$data['CI']->db->query($query);
                                        //echo $query;
                                        foreach ($result->result_array() as $row)
                                        {
                                       
                                        ?>
                                        <tr>
                                            <td><?php echo $row['name'];?></td>
                                            <td><?php echo $row['paper_name'];?></td>
                                            <td><?php echo $row['className'];?></td>
                                            <td><?php echo $row['semester'];?></td>
                                            <td>
                                                <?php
                                                
                                                $staffId=urlencode($data['CI']->encryption->encrypt($row['userid']));
                                                $paperId=urlencode($data['CI']->encryption->encrypt($row['paper_id']));;
                                                $classId=urlencode($data['CI']->encryption->encrypt($row['classid']));;
                                                ?>
                                                <button onclick="unBind('<?php echo $paperId;?>','<?php echo $staffId;?>','<?php echo $classId;?>');"class="btn btn-outline">Unlink Staff</button>
                                            </td>
                                            
                                        </tr>
                                        <?php
                                        }
                                        if($data['CI']->db->affected_rows()==0)
                                        {
                                            ?>
                                    <script>
                                    window.alert("No Data found for this semester!");
                                        </script>
                                        <?php
                                        
                                        }
                                        
                                        ?>
                                        
                                        
                                    </tbody>
                                </table>
                                <script>
                                    function unBind(paperId,staffId,classId)
                                    {
                                       
                                      location.href="<?php echo base_url("/hod/page/manageBind?unBind=go&staffId=");?>"+staffId+"&paperId="+paperId+"&classId="+classId;
                                      
                                    
                                    }
                                    </script>
                            <?php
                            if(isset($_GET['unBind']))
                            { 
                                $staffId=$data['CI']->encryption->decrypt($_GET['staffId']);
                                $paperId=$data['CI']->encryption->decrypt($_GET['paperId']);
                                $classId=$data['CI']->encryption->decrypt($_GET['classId']);
                                if(isset($classId,$paperId,$staffId))
                                {
                                    
                                //$sql="delete from staffpaper where userid={$staffId} and paper_id={$paperId} and classid={$classId}";
                                ///echo $sql;
                                $query="delete from staffpaper where userid=? and paper_id=? and classId=?";
                                $data['CI']->db->query($query,array($staffId,$paperId,$classId));
                                ?><script>
                                
                                window.alert("Staff removed from particular paper");
                                location.href="<?php echo base_url("hod/page/manageBind");?>";
                                </script>  
                            <?php 
                                }
                            }
                            ?>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
        
    </div>
</div>
                     
                         
                         
                         
                         
 <?php
    
}
function manageStaff($data){
    ?><h1>Manage Staff Users</h1>
        
        <div class="row">
            <div class="col-lg-10">
                <hr/>
                <div class="panel panel-default">
                        <div class="panel-heading">
                            Manage Staff Users    &nbsp;&nbsp;&nbsp;&nbsp;[Profile]
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                            <script>
                                function resetPassword(id){
                                    var con=confirm("Do you want to reset password!");
                                    if(con){
                                        location.href="manageStaff?reset="+id;
                                    }
                                    else
                                    {
                                        location.href="manageStaff";
                                    }
                                    
                                }
                                </script>
                                
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                           
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query=$data['CI']->db->query("select * from users where user_type='staff' and userid in(select id from staffdept where dept_id={$data['CI']->session->userdata('dept_id')})");
                                        foreach($query->result_array() as $row)
                                        {
                                           ?> 
                                        <tr>
                                            
                                            <td><?php echo $row['username'];?></td>
                                            <td><?php echo $row['name'];?></td>
                                            <td><?php echo $row['email'];?></td>
                                            <td><?php echo $row['phone'];?></td>
                                            <td>
                                                <button onclick="resetPassword('<?php echo urlencode($data['CI']->encryption->encrypt($row['userid'])); ?>');" type="button" class="btn btn-outline btn-link">Reset Password</button>
                                                <?php if($row['active']==1){
                                                   ?>
                                                <a href="?lock=<?php echo urlencode($data['CI']->encryption->encrypt($row['userid']));?>">
                                                        <button type="button" class="btn btn-outline btn-link">Lock</button></a>
                                                            <?php
                                                
                                                }
                                                else
                                                {
                                                 ?>
                                                <a href="?unlock=<?php echo urlencode($data['CI']->encryption->encrypt($row['userid']));?>"><button type="button" class="btn btn-outline btn-link">Unlock</button></a>
                                                 <?php   
                                                }
                                                 ?>
                                               
                                            </td>
                                            </tr>
                                                <?php 
                                        }
                                        if(isset($_GET['reset']))
                                        {
                                            $id=$data['CI']->encryption->decrypt($_GET['reset']);
                                            $password=md5("mac@password");
                                            if($data['CI']->db->query("update users set password='{$password}' where userid={$id}"))
                                            {
                                                ?>
                                    <script>
                                        window.alert("Password reset to:   mac@password");
                                        location.href="<?php echo base_url("hod/page/manageStaff");?>";
                                        </script>
                                        <?php 
                                            }
                                            else{
                                                ?><script>
                                                    window.alert("Unknown Error Occured");
                                                    </script><?php 
                                            }
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
                                        
   if(isset($_GET['lock']))
   {
       $id=$data['CI']->encryption->decrypt($_GET['lock']);
      $data['CI']->db->query("update users set active=0 where userid={$id}");
   ?>
   
    <script>    
      
      location.href="<?php echo base_url("/hod/page/manageStaff");?>";
    </script>
    <?php
       
    }
    if(isset($_GET['unlock']))
   {
      $id=$data['CI']->encryption->decrypt($_GET['unlock']);
      $data['CI']->db->query("update users set active=1 where userid={$id}");
     ?>
            <script>
            location.href="<?php echo base_url("/hod/page/manageStaff");?>";
            </script>
                <?php
       
       }
}
function createClass($data){
    ?><h1>Create Class</h1>
         <hr/>
        <div class="row">
            <div class="col-lg-8">
            <?php if(validation_errors()){?><div class="alert alert-danger"><?php echo validation_errors();?></div><?php }?>

            
              <?php if($data['CI']->input->post('level')==1){  
                   ?>
            <form action="<?php echo base_url("/hod/createClass");?>" method="post">
               
                  <div class="form-group">
                    <label>Course</label>
                    <input type="hidden" name="course" value="<?php echo $data['CI']->input->post('course');?>">
                   <?php
                   $course=$data['CI']->input->post('course');
                   $course=$data['CI']->encryption->decrypt($course);
                   ?>
                    <?php
                    //echo $data['CI']->input->post('course');
                    
                    ?>
                    <input style="width:50%;" type="text" disabled value="<?php echo findCourseName($course);?>" class="form-control">
                  </div>
                    <div class="form-group">
                    <label>Class Name</label>
                    <input value="<?php echo set_value('classname');?>" style="width:50%;" type="text" class="form-control" name="classname" placeholder="1BCA or 1 BSCELE">
                </div>
                    <div class="form-group">
                    <label>Semester</label>
                    <input value="<?php echo set_value('semester');?>" style="width:50%;" type="number" class="form-control" name="semester" placeholder="1">
                </div>
                <div class="form-group">
                    <label>Batch</label>
                    <select class="form-control" style="width: 50%;" name="batches">
                    <?php
                    $sql="select batches from courses where id={$course}";
                    $sql=$data['CI']->db->query($sql);
                    $row=$sql->row_array();
                    $i=1;
                    while($row['batches']>=$i){
                        ?>
                    <option value="<?php echo $data['CI']->encryption->encrypt($i);?>"><?php echo $i; $i++;?></option>
                    <?php
                    }
                    
                    ?>
                    </select>
                    
                </div>
                   
               
                    <input type="hidden" name="dept_id" value="<?php echo $_SESSION['dept_id'];?>";
                           
                     <div class="form-group">
                         
                                    <input style="width:50%;" type="submit" class="btn btn-primary" value="Save">
                </form>
                <?php
              }
              else{
                  ?>
            <form action="<?php echo base_url("/hod/page/createClass");?>" method="post">
               
                  <div class="form-group">
                    <label>Course</label>
                    <select class="form-control" name="course" style="width:50%">
                        <?php
                        $sql="select * from courses where dept_id={$_SESSION['dept_id']} ";
                        $sql=$data['CI']->db->query($sql);
                        foreach ($sql->result_array() as $row)
                        {
                            ?>
                        <option value="<?php echo $data['CI']->encryption->encrypt($row['id']);?>"><?php
                        echo $row['courseName'];?>
                        </option>
                        <?php
                        
                        }
                        ?>
                    </select>
                    
                  </div>
                <div class="form-group">
                     <input type="hidden" name="level" value="1">
                    <input type="submit" class="btn btn-primary" value="Next">
                </div>
            </form>
                    <?php
                  
                  
              }
              ?>
           
                    </div>
            </div>
            
                                
               
      
    <?php
}

function assignStaff($data){
    ?><h1>Assign Class Teacher </h1>
        <hr>
        <div class="row">
            <div class ="col-lg-6">
                 <?php if(validation_errors()){?><div class="alert alert-danger"><?php echo validation_errors();?></div><?php }?>
            <form action="<?php echo base_url("/hod/assignStaff");?>" method="post">
                <div class="form-group">
                                            <label>Select Satff</label>
                                            <select name="staffid" style="width:50%;" class="form-control">
                                                
                                                
                                                     <?php 
                                                $query="select * from users where user_type='staff' and userid in(select id from staffdept where dept_id={$data['CI']->session->userdata('dept_id')})and userid not in(select staffID from deptclass)";
                                                $query=$data['CI']->db->query($query);
                                                foreach($query->result_array() as $row)
                                                {
                                                    ?><option value="<?php echo $data['CI']->encryption->encrypt($row['userid']);?>"><?php echo $row['name'];?></option><?php
                                                }
                                                ?>
                                                
                                            </select>
                </div>
                <div class="form-group">
                                            <label>Select Class </label>
                                            <select name="classid" style="width:50%;" class="form-control">
                                                <?php 
                                                $query="select * from deptclass where staffID='-1' and dept_id={$_SESSION['dept_id']}";
                                                $query=$data['CI']->db->query($query);
                                                foreach($query->result_array() as $row)
                                                {
                                                    ?><option value="<?php echo $data['CI']->encryption->encrypt($row['classid']);?>"><?php echo $row['className'];?></option><?php
                                                }
                                                ?>
                                                
                                            </select>
                                            
                                        </div>
                <div class="form-group">
                    
         <input type="submit" value="Save changes" class="btn btn-primary">
            </div>
            </div>
        </div>
            <?php 
    
    
    
}
function manageClass($data){
    $classId=$data['CI']->encryption->decrypt($data['CI']->input->get('edit'));
    if($classId){
        ?>
        <h1>Edit Class</h1>
        <hr/>
        <div class="row">
            <div class="col-lg-4">
                
                <?php
                $sql="select * from deptclass where classid={$classId}";
                $sql=$data['CI']->db->query($sql);
                $sql=$sql->row_array();
                
                
                ?>
                
                
                <form action="<?php echo base_url('hod/editClass');?>" method="post">
                    <div class="form-group">
                        <label>
                            Class Name
                        </label>
                        
                    </div>
                    <div class="form-group">
                        <input type="hidden" value="<?php echo $data['CI']->input->get('edit');?>" name="classid">
                        <input class="form-control" type="text" name="className" value="<?php echo $sql['className'];?>">
                        
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary">
                    </div>
                   
                </form>
            </div>
        </div>
        <?php
        
    }else{
        
    
    ?><h1>Manage Class</h1>
    <div class="row">
            
                
                <hr/>
                <div class ="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Classes
                        </div>
                        <!-- /.panel-heading -->
                      <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Class Name</th>
                                            <th>Course</th>
                                            <th>Batch</th>
                                            <th>Semester</th>
                                            <th>Class Teacher</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            
                                            $query="select * from deptclass where active=1 and dept_id={$_SESSION['dept_id']} order by semester";
                                            $query=$data['CI']->db->query($query);
                                            foreach ($query->result_array() as $row)
                                            {
                                                ?>
                                            <!--<td><?php //echo $row['classid'];?></td>-->
                                            <td><?php echo $row['className'];?></td>
                                            <td>
                                                <?php
                                                $sql="select courseName from courses where id={$row['course_id']}";
                                                $sql=$data['CI']->db->query($sql);
                                                $sql=$sql->row_array();
                                                echo $sql['courseName'];
                                                ?>
                                            </td>
                                             <td><?php echo $row['batch'];?></td>
                                            <td><?php echo $row['semester'];?></td>
                                            <td><?php 
                                            if($row['staffID']==-1)
                                            {
                                                echo "<i>Not Assigned</i>";
                                            }
                                            else
                                            {
                                                $query="select * from users where userid=?";
                                                $query=$data['CI']->db->query($query,array($row['staffID']));
                                                foreach ($query->result_array() as $row2)
                                                {
                                                    echo "<b>".$row2['name']."</b>";
                                                }
                                            }
                                            ?> </td>
                                            <td> <button onclick="deleteClass('<?php echo urlencode($data['CI']->encryption->encrypt($row['classid']));?>');" type="button" class="btn btn-outline btn-link">Delete Class</button>
                                            <a href="<?php echo base_url('/hod/page/manageClass?unassign=').urlencode($data['CI']->encryption->encrypt($row['classid']));?>"<button type="button" class="btn btn-outline btn-link">Unassign Staff</button></a>
                                            <a href="<?php echo base_url('/hod/page/manageClass?edit=').urlencode($data['CI']->encryption->encrypt($row['classid']));?>"<button type="button" class="btn btn-outline btn-link">Edit Class</button></a>

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
                    
                </div>
            </div> 
   
    <script>
        function deleteClass(id){
            var con=confirm("Deleteing a class will automatically delete all the courses present in this class. This action cannot be undone!! ");
          if(con)
          {
              location.href="<?php echo base_url('/hod/page/manageClass?del=');?>"+id;
          }
          
              
        }
        </script>
        <?php 
          
       if(isset($_GET['del']) and is_numeric($data['CI']->encryption->decrypt($_GET['del'])))
                {
           
                                        $classid=$data['CI']->encryption->decrypt($_GET['del']);
                                        $data['CI']->db->query("delete from deptclass where dept_id={$_SESSION['dept_id']} and classid={$classid}");
                                        $data['CI']->db->query("delete from staffpaper where classid={$classid}");
                                        ?>
                                        <script>
                                            window.alert("Class Deleted Successfully");
                                            location.href="<?php echo base_url('hod/page/manageClass');?>";
                                            </script>
                                            <?php 
                                                
                }
        if(isset($_GET['unassign']) and is_numeric($data['CI']->encryption->decrypt($_GET['unassign']))){
            $classid=$data['CI']->encryption->decrypt($_GET['unassign']);
            $data['CI']->db->query("update deptclass set staffID='-1' where dept_id={$_SESSION['dept_id']} and classid={$classid}");
          ?>
                                        <script>
                                            window.alert("Unassigned Successfully");
                                            location.href="<?php echo base_url('hod/page/manageClass');?>";
                                            </script>
                                            <?php    
        }
    }
        
}
function create_courses($data){
    ?>
                                            <h1>Create Courses / Papers</h1>
    <div class="row">
            
                
                <hr/>
                <div class ="col-lg-8">
                    <?php if(validation_errors()){
                        ?>
                    <div class="alert alert-danger"><?php echo validation_errors();?>
                    </div>
                    
                    <?php
                    }
                    ?>
                    <script>
                        function courseSem(data)
                        {
                            location.href="<?php echo base_url("hod/page/createCourses/?courseSem=");?>"+ data.value;
                        }
                        </script>
                        
                    <form action="<?php echo base_url("/hod/createCourses");?>" method="post">
                        <div class="form-group">
                            <label>Course</label>
                             
                              <select name="course" <?php if(isset($_GET['courseSem'])){echo "onChange";} else{ echo"onClick";}?>="courseSem(this);" style="width: 50%;" class="form-control">
                               <?php
                               
                               
                               if(isset($_GET['courseSem']))
                               {
                                   $coursSem=$_GET['courseSem'];
                               }  else {
                                   
                               $coursSem=0;
                               
                               }
                                
                                
                               
                               
                              $course=$data['CI']->encryption->decrypt($coursSem);
                               
                              
                               if($course)
                               {
                                   $courseSql="select * from courses where active=1 and id={$course} and dept_id={$_SESSION['dept_id']}";
                                   $queryCourse=$data['CI']->db->query($courseSql);
                                   foreach ($queryCourse->result_array() as $row)
                                   {
                                      
                                   
                                  ?>
                                  
                                  <option value="<?php echo urlencode($data['CI']->encryption->encrypt($row['id']));?>"> <?php echo $row['courseName'];?>  | Selected</option>
                                  <?php 
                                }
                               }
                               $sql="select * from courses where active=1 and dept_id={$_SESSION['dept_id']}";
                                   $queryComp=$data['CI']->db->query($sql);
                                   foreach ($queryComp->result_array() as $row){
                                       
                                       $value=urlencode($data["CI"]->encryption->encrypt($row['id']));
                                       echo "<option value='{$value}'>{$row['courseName']}</option>";
                               }
                               
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Paper Name</label>
                            <input type="text" name="papername" value="<?php echo set_value('papername');?>" class="form-control" style="width:40%;">
                        </div>
                        <div class="form-group">
                            <label>Paper Short Code</label>
                            <input name="papercode" type="text" value="<?php echo set_value('papercode');?>" class="form-control" style="width:40%;  ">
                        </div>
                        
                    <div class="form-group">
                            <label>Semester</label>
                            <select style="width:50%;"name="semester" class="form-control"> 
                               <?php 
                               if($course)
                               {
                                   
                               $query="select semesters from courses where id={$course}";
                               echo $query; 
                               $query=$data['CI']->db->query($query);
                               $row=$query->row_array();
                               echo $row['semesters'];   
                               $i=1;
                                while($i<=$row['semesters'])
                               {
                                   ?>
                                
                                <option style="width:40%;" class="form-control" value="<?php echo $data['CI']->encryption->encrypt($i);?>"type="text"><?php echo $i;?></option>
                               
                                <?php
                                $i++;
                               }
                               }
                               ?>
                            </select> 
                            
                        </div>
                        
                        
                        <div class='form-group'>
                            <input type='submit' class="btn btn-primary">
                            
                        </div>
                    </form>
                    
                    
                    
                </div>
    <?php
}

