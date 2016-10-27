<?php 
                                                   
                       
                            switch($page)
                        {
                            case "manage_department":{
                                include('include.php');
                                    $CI =& get_instance();
                                    $data=array(
                               'hod_list'=>$principal_list,
                               'CI'=>$CI
                        );
                                echo '<h1 class="page-header">';
                                echo $pagehead;
                                
                                echo '</h1>';
                                managedepartment($data);break;
                            
                            }break;
                            case "manageSemester":{
                                $CI=&get_instance();
                                include('include.php');
                                $data=array(
                                    'CI'=>$CI
                                );
                                manageSemester($data);
                            }break;
                        case "office_staff":{
                                $CI=&get_instance();
                                include('include.php');
                                $data=array(
                                    'CI'=>$CI
                                );
                                officeStaff($data);
                            }break;
                            case "create_department":{
                                include('include.php');
                                $CI=&get_instance();
                                $data=array(
                                    'CI'=>$CI
                                );
                            
                                echo '<h1 class="page-header">';
                                echo $pagehead;
                                
                                echo '</h1>';
                                createDepartment($data);break;
                            }break;
                        case "create_hod":{
                            include('include.php');
                                $CI=&get_instance();
                                $data=array(
                                    'CI'=>$CI
                                );
                            
                                echo '<h1 class="page-header">';
                                echo $pagehead;
                                
                                echo '</h1>';
                                createHod($data);break;
                            }break;
                            case "manageCourses":{
                                include('include.php');
                            $CI=&get_instance();
                            $data=array(
                                'CI'=>$CI
                            );
                            manageCourses($data);    
                            }break;
                            case "mainCourses":{
                                include('include.php');
                            $CI=&get_instance();
                            $data=array(
                                'CI'=>$CI
                            );
                            mainCourses($data);  
                            }break;
                         case "ac_year_manage":{
                             include('include.php');
                              echo '<h1 class="page-header">';
                                echo $pagehead;
                                
                                echo '</h1>';
                                $CI=&get_instance();
                                $data=array(
                                    'CI'=>$CI
                                );
                              ac_year_manage($data);
                            }break; 
                        case "view_exam":{
                             include('include.php');
                              
                                $CI=&get_instance();
                                $data=array(
                                    'CI'=>$CI
                                );
                                viewMarks($data);
                            }break; 
                            
                            default:show_404();
                        }
                            ?>
                            
                        </h1>
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
</html>

<?php 
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
function officeStaff($data){
    
    ?>
<h1>Manage Office Staff</h1>
<hr/>
<div class='row'>
    <div class='col-lg-4'>
        <?php if(validation_errors()){
            ?><div class='alert alert-danger'><?php echo validation_errors();?></div>
        <?php
        
        }
        ?>
        
         
                    <div class="alert alert-success">
                               Default Password will be :   office@mac
                            </div>
                                <form action="<?php echo base_url('principal/officeStaff');?>" method="post">
                
                 <div class="form-group">
                    <label>UserName</label>
                    <input  type="text" class="form-control" name="username">
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email">
                </div>
                                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control" name="phone">
                </div>
                                <div class="form-group">
                    
                                    <input  type="submit" class="btn btn-primary" value="Save">
                </div>
            </form>

    </div>


            <div class="col-lg-8">
                
                <div class="panel panel-default">
                        <div class="panel-heading">
                            Manage Office Staff Users    &nbsp;&nbsp;&nbsp;&nbsp;[Profile]
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                            <script>
                                function resetPassword(id){
                                    var con=confirm("Do you want to reset password!");
                                    if(con){
                                        location.href="officeStaff?reset="+id;
                                    }
                                    else
                                    {
                                        location.href="officeStaff";
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
                                        $query=$data['CI']->db->query("select * from users where user_type='office'");
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
                                            $password=md5("office@mac");
                                            if($data['CI']->db->query("update users set password='{$password}' where userid={$id}"))
                                            {
                                                ?>
                                    <script>
                                        window.alert("Password reset to:   office@mac");
                                        location.href="<?php echo base_url("principal/page/officeStaff");?>";
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
      
      location.href="<?php echo base_url("principal/page/officeStaff");?>";
    </script>
    <?php
       
    }
    if(isset($_GET['unlock']))
   {
      $id=$data['CI']->encryption->decrypt($_GET['unlock']);
      $data['CI']->db->query("update users set active=1 where userid={$id}");
     ?>
            <script>
            location.href="<?php echo base_url("principal/page/officeStaff");?>";
            </script>
                <?php
       
       }
        



}
function manageSemester($data){
    ?>
<h1>Manage Semster</h1>
<div class="row">
    <div class="col col-lg-4">
        
        <?php 
        if(isset($_GET['msg'])){
            if($_GET['msg']=='sem_change')
            {
                ?>
        <div class="alert alert-success">
            Semester Changed successfully
        </div>
                  <?php
            }
        }
        
        if(!isset($_POST['course']))
        {
            $course=0;
        }
        else{
           $course=$_POST['course'];
        }
        if(!isset($_POST['year']))
        {
            $year=0;
        }else{
            $year=$_POST['year'];
        }
        $course=$data['CI']->encryption->decrypt($course);
        $year=$data['CI']->encryption->decrypt($year);
        if($course and $year){
           
            ?>
        <br>
        <form action="<?php echo base_url('/principal/manageSemester');?>" method="post">
       <input type="hidden" name="course" value="<?php echo $_POST['course'];?>">
       <input type="hidden" name="year" value="<?php echo $_POST['year'];?>">
            <div class="form-group">
            <label>Current Semester</label>
            <?php
            $sql="select * from semester_logs where course_id={$course} and academic_year={$year}";
            $sql=$data['CI']->db->query($sql);
            $row=$sql->row_array();
            
            ?>
            <input type="text" disabled="disabled" value="<?php 
            if($row['semester'])
            {
                echo $row['semester'];
            }
            else{
                
                echo "No records available";
            }
            ?>" class="form-control">
        </div>
            <div class="form-group">
                <label>New Semester</label>
                <select name="semester" class="form-control">
                    <?php
                    $sql="select * from courses where id={$course}";
                    $sql=$data['CI']->db->query($sql);
                    $i=1;
                    $row=$sql->row_array();
                    $j=$row['semesters'];
                        while($j>=$i)
                    {
                        ?>
                    
                    <option value="<?php echo $data['CI']->encryption->encrypt($j);?>"><?php echo $j;?></option>
                    <?php
                    $j--;
                    }
                 
                   
                    
                    
                    ?>
                    <option value='<?php echo $data['CI']->encryption->encrypt('-1');?>'>Expire</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </form>
          <?php  
            
        }
        else
        {
            
        
        ?>
        <form action="<?php echo base_url('principal/page/manageSemester');?>" method="post">
            <div class="form-group">
                <label>
                    Course
                </label>
                <select name="course" class="form-control">
                    <option>Select a course</option>
                    <?php
                    $sql="select * from courses where active=1";
                    $sql=$data['CI']->db->query($sql);
                    foreach($sql->result_array() as $row):
                        ?>
                    <option value="<?php  echo $data['CI']->encryption->encrypt($row['id']);?>"><?php echo $row['courseName'];?></option>
                    <?php
                    endforeach;
                            
                            ?>
                </select>
            </div>
            <div class="form-group">
                <label>Academic Year</label>
                <select name="year" class="form-control">
                   <option>Select a Academic year</option>
                    <?php
                    $sql="SELECT * FROM `academic_year`";
                    $sql=$data['CI']->db->query($sql);
                    foreach($sql->result_array() as $row):
                        ?>
                    <option value="<?php  echo $data['CI']->encryption->encrypt($row['year']);?>"><?php echo $row['year'];?></option>
                    <?php
                    endforeach;
                            
                            ?>
                </select>
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Next">
            </div>
        </form>
        <?php 
        }
        ?>
        
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
                        <div class="panel-heading">
                            View Semester Position in year!
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Course</th>
                                            <th>Academic Year</th>
                                            <th>Current Semester</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            <?php
                                            $sql="select * from semester_logs";
                                            $sql=$data['CI']->db->query($sql);
                                            foreach ($sql->result_array() as $row){
                                                ?>
                                        <tr>
                                            <td><?php echo findCourseName($row['course_id']);?></td>
                                            <td><?php echo $row['academic_year'];?></td>
                                            <td><?php if($row['semester']=='-1'){
                                                echo 'EXPIRED';
                                            }else{
                                                echo $row['semester'];
                                            }
?></td>
                                            <td><a href="?delete=1&course=<?php
                                            echo urlencode($data['CI']->encryption->encrypt($row['course_id']));
                                            echo "&semester=";
                                            echo urlencode($data['CI']->encryption->encrypt($row['semester']));
                                            ?>">Delete</a>
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
$course=$data['CI']->encryption->decrypt($data['CI']->input->get('course'));
$semester=$data['CI']->encryption->decrypt($data['CI']->input->get('semester'));
if($data['CI']->input->get('delete')==1){
    if($course and $semester){
        $sql="DELETE FROM `semester_logs` WHERE course_id={$course} and semester={$semester}";
        if($data['CI']->db->query($sql)){
            alert('Semester Data Deleted Successfully');
            jsRedirect(base_url('principal/page/manageSemester'));
        }
    }
}

}
function manageCourses($data){
    ?>
    <h1>Manage Courses</h1>
    <div class="row">
        <div class="col-lg-8">
           <div class="panel panel-default">
                        <div class="panel-heading">
                            Manage Courses
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Course Name</th>
                                            <th>Department</th>
                                            <th>Semester</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                       
                                        
                                            <?php
                                            $sql="SELECT courses.*,department.dept_name FROM `courses`,department WHERE courses.dept_id=department.dept_id";
                                            $sql=$data['CI']->db->query($sql);
                                            foreach ($sql->result_array() as $row)
                                            {
                                                
                                                ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['code'];?>
                                            </td>
                                            <td>
                                                <?php echo $row['courseName'];?>
                                            </td>
                                            <td>
                                                <?php echo $row['dept_name'];?>
                                            </td>
                                            <td>
                                                <?php echo $row['semesters'];?>
                                            </td>
                                            <td>
                                                <?php
                                                if($row['active']==1)
                                                {
                                                    ?><a href="?deactivate=<?php echo urlencode($data['CI']->encryption->encrypt($row['code']));?>"><button class="btn btn-warning">De-Activate</button></a>
                                                    <?php
                                                }
                                                else
                                                {
                                                  ?><a href="?activate=<?php echo urlencode($data['CI']->encryption->encrypt($row['code']));?>"><button class="btn btn-primary">Activate</button></a><?php
                                                  
                                                }
                                                ?>
                                                
                                            </td>
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
if(isset($_GET['deactivate'])){
    $code=$data['CI']->encryption->decrypt($_GET['deactivate']);
    if($code){
       $sql="update courses set active=0 where code='{$code}'";
       
       $data['CI']->db->simple_query($sql);
       ?><script>
           window.alert('Deactivation only affect for new admissions');
           location.href='<?php echo current_url();?>';
           </script>
           <?php
    }
            
    
}
if(isset($_GET['activate'])){
    $code=$data['CI']->encryption->decrypt($_GET['activate']);
    if($code){
       $sql="update courses set active=1 where code='{$code}'";
       
       $data['CI']->db->simple_query($sql);
       ?><script>
           location.href='<?php echo current_url();?>';
           </script>
           <?php
    }
            
    
}
}
function mainCourses($data){
  ?>
    <h1>Create Core Courses</h1>
    
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
            <form action="<?php echo base_url("/principal/mainCourses");?>" method="post">
            <div class="form-group">
                <label>Department</label>
                <select class="form-control" name="department" style="width:40%">
                    <?php
                    $sql="select * from department where active=1";
                    $sql=$data['CI']->db->query($sql);
                    foreach ($sql->result_array() as $row)
                    {
                        ?>
                    <option value="<?php echo $data['CI']->encryption->encrypt($row['dept_id']);?>"><?php echo $row['dept_name'];?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
                <div class="form-group">
                <label>Course Name</label>
                <input value="<?php echo set_value('course');?>"type="text" name="course" style="width:50%;" class="form-control">
            </div>
            <div class="form-group">
                <label>Course Short Code</label>
                <input value="<?php echo set_value('code');?>"type="text" name="code" style="width:50%;" class="form-control">
            </div>
                <div class="form-group">
                <label>Total Semesters</label>
                <input name="totalSemesters" value="<?php echo set_value('totalSemesters');?>" style="width:50%;" class="form-control">
            </div>
                 <div class="form-group">
                <label>Total Batches</label>
                <input type="number" name="totalBatches" value="<?php echo set_value('totalBatches');?>" style="width:50%;" class="form-control">
            </div>
                
                 <div class="form-group">
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
                
            </form>
            
            
        </div>
            
    </div>
<?php
}

function managedepartment($hod_list){
    if(isset($_GET['deactive']))
    {
        $query="update department set active=0 where dept_code='{$_GET['deactive']}'";
        if($hod_list['CI']->db->simple_query($query))
        {
            ?><script>alert("Department Deactivated");
            location.href="department";
            </script><?php
            
        }
            
   
    }
            if(isset($_GET['active']))
    {
        $query="update department set active=1 where dept_code='{$_GET['active']}'";
        
        if($hod_list['CI']->db->simple_query($query))
        {
            ?><script>alert("Department Activated");
            location.href="department";
            </script>
                
                <?php 
                
        }
            
   
    }

    
    //var_dump($hod_list['CI']);
    //echo $hod_list['CI']->uri->segment(1);
            
    ?>
<div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Departments
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                           
                                            <th>Department Name</th>
                                            <th>HOD</th>
                                            <th>Department Code</th>
                                            <th>Management</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                           <?php
                                           foreach($hod_list['hod_list'] as $hod_table)
                                           {
                                             
                                          ?>
                                             <tr> 
                                                 
                                            <td><?php echo $hod_table['dept_name'];?></td>
                                            <td><?php echo $hod_table['name'];?></td>
                                            <td><?php echo $hod_table['dept_code'];?></td>
                                            <?php 
                                            $query="select active from department where dept_id={$hod_table['dept_id']}";
                                            $query=$hod_list['CI']->db->query($query);
                                            $row=$query->row_array();
                                            
                                               if($row['active']==1)
                                               {
                                                   ?>
                                               
                                                   
                                            
                                            <td><a href="?deactive=<?php echo $hod_table['dept_code'];?>"><button type="button" class="btn btn-warning">Deactivate</button></a></td>
                                               <?php }
                                               else
                                               {
                                                   ?><td><a href="?active=<?php echo $hod_table['dept_code'];?>"><button type="button" class="btn btn-warning">Activate</button></a></td><?php
                                               }
                                               ?>
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
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
               
            </div>

<?php
}
function createDepartment($data){
    ?><div class="row">
                <div class="col-lg-6">
                   <?php if(validation_errors()){?><div class="alert alert-danger"><?php echo validation_errors();?></div><?php }?>
                  
                    <form action="<?php echo site_url("/");?>principal/saveDept" method="post">
                        <div class="form-group">
                        <label>Department Name</label>
                        <input style="width:50%;" type="text" name="departname" class="form-control">
                        </div>
                         <div class="form-group">
                         <label>Department Short Code</label>
                         <input style="width:50%;" type="text" name="departcode" class="form-control">
                         </div>
                        <div class="form-group">
                            <label>Assign HOD</label>
                            <select name="hod" style="width:50%;"class="form-control">
                            <?php 
                            $sql="SELECT * FROM `users` WHERE user_type='hod' and userid not IN (SELECT dept_user_hod_id from department)";
                           
                                    $query=$data['CI']->db->query($sql);
                                    
                            
                            foreach($query->result_array() as $row)
                            {
                                
                            
                            ?>
                                <option value='<?php echo $row['userid'];?>'><?php echo $row['name'];?></option>
                                               <?php
                            }
                            ?>
                                            </select>
                           
                        </div>
                        <input type="submit" class="btn btn-primary" value="Save">
                        
                         
                         
                    </form>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
               
          
    <?php
   
}
function createHod($data)

{
    ?><div class="row">
                <div class="col-lg-6">
                    <div class="alert alert-success">
                               Default Password will be :    password@123
                            </div>
                    <?php if(validation_errors()){?><div class="alert alert-danger"><?php echo validation_errors();?></div><?php }?>
            <form action="<?php echo base_url("/principal/createHOD");?>" method="post">
                
                 <div class="form-group">
                    <label>UserName</label>
                    <input style="width:50%;" type="text" class="form-control" name="username">
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input style="width:50%;" type="text" class="form-control" name="name">
                </div>
                                <div class="form-group">
                    <label>Email</label>
                    <input style="width:50%;" type="text" class="form-control" name="email">
                </div>
                                <div class="form-group">
                    <label>Phone</label>
                    <input style="width:50%;" type="text" class="form-control" name="phone">
                </div>
                                <div class="form-group">
                    
                                    <input style="width:50%;" type="submit" class="btn btn-primary" value="Save">
                </div>
            </form>
                                
                    
    <?php
}
function ac_year_manage($data){
  //var_dump($data['CI']);
    ?>
          <div class="row">
                <div class="col-lg-6">
   <?php if(validation_errors()){?><div class="alert alert-danger"><?php echo validation_errors();?></div><?php }?>
<hr/>
                     <form action="<?php echo base_url("/principal/ManageYearSave");?>" method="post">
                
                 <div class="form-group">
                    <label>Academic Year</label>
                    <input type="number" style="width:50%;" type="text" class="form-control" name="year">
                </div>
                         <div class="form-group">
                    
                                    <input style="width:50%;" type="submit" class="btn btn-primary" value="Save">
                </div>
                     </form>
                         
<hr/>
                </div>
          </div>
                    <div class="row">
                    <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Academic Years | List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Year</th>
                                            <th>Manage</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $query=$data['CI']->db->query("select * from academic_year order by year desc");
                                        foreach($query->result_array() as $result)
                                        {
                                           ?>
                                        <tr>
                                           <td><?php echo $result['id'];?></td>
                                            <td><?php echo $result['year'];?></td>
                                            <td><a href="?del=<?php echo $result['id'];?>"<button type="button" class="btn btn-outline btn-danger">Delete</button></a></td>  
                                        </tr>   
                                                <?php 
                                        
                                        }
                                        ?>
                                        
                                           
                                            
                                            
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            <?php
                            if(isset($_GET['del'])){
                             $data['CI']->db->query("delete from academic_year where id={$_GET['del']}")
                             ?>
                            <script>
                                window.alert("Deleted Successfully");
                                location.href="<?php echo base_url('/principal/page/ManageYear');?>";
                             </script>
                             <?php 
                            }
                            ?>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                    </div>

                         
                     <?php 
}