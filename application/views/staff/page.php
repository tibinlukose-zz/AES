<?php

/* 
 * License under Pirates of mac Valley.
 * Developed by Navas, Sriram and Tibin  * 
 */
?>
 
                    <?php
                    $CI=&get_instance();
                    switch($page)
                    {
                        case "my_papers":{
                            $data=array(
                                'CI'=>$CI
                            );
                            include 'include.php';
                            myPapers($data);
                        }break;
                    case "view_marks":{
                            $data=array(
                                'CI'=>$CI
                            );
                            include 'include.php';
                            viewMarks($data);
                        }break;
                    case "manage_attendance":{
                            $data=array(
                                'CI'=>$CI
                            );
                            include 'include.php';
                            manageAttendance($data);
                        }break;
                    case "manage_files":{
                            $data=array(
                                'CI'=>$CI
                            );
                            include 'include.php';
                            manageFiles($data);
                        }break;
                    case "generate_marks":{
                            $data=array(
                                'CI'=>$CI
                            );
                            include 'include.php';
                            generateMarks($data);
                        }break;
                     case "manage_docs":{
                            $data=array(
                                'CI'=>$CI
                            );
                            include 'include.php';
                            manageDocs($data);
                        }break;
                    case "my_exams":{
                            $data=array(
                                'CI'=>$CI
                            );
                            include 'include.php';
                            manageExams($data);
                        }break;
                    case "class_teacher":{
                            $data=array(
                                'CI'=>$CI
                            );
                            include 'include.php';
                            classTeacher($data);
                        }break;
                    case "mail_students":{
                            $data=array(
                                'CI'=>$CI
                            );
                            include 'include.php';
                            mailStudents($data);
                        }break;
                    case "up_mark":{
                            $data=array(
                                'CI'=>$CI
                            );
                            include 'include.php';
                            upMark($data);
                        }break;
                    case "view_student":{
                            $data=array(
                                'CI'=>$CI
                            );
                            include 'include.php';
                            viewStudent($data);
                        }break;
                    case "create_exam":{
                            $data=array(
                                'CI'=>$CI
                            );
                            include 'include.php';
                            createExams($data);
                        }break;
                    case "manage_questions":{
                            $data=array(
                                'CI'=>$CI
                            );
                            include 'include.php';
                            manageQuestions($data);
                        }break;
                    }
                        
function viewMarks($data){

$sql="select * from deptclass where staffID={$_SESSION['uid']} and active=1";
$sql=$data['CI']->db->query($sql);
        
        if($sql->num_rows()>0){
    ?>
<h1>View Exam Results</h1>
<hr/>
<div class='row'>
    <div class='col-lg-8'>
        <div class="panel panel-default">
                        <div class="panel-heading">
                            View Exam Results
                            <select onChange='findExam(this);' name='examId' class='form-control' style="width:40%;">
                             <?php
                             $sql="select * from exams where class_id=(select classid from deptclass where staffID={$_SESSION['uid']} and active=1) and state IN('CLOSED','DECLARED');";
                             $sql=$data['CI']->db->query($sql);
                             foreach($sql->result_array() as $row){
                                 ?>
                                <option>Select Exam</option>
                                <option value='<?php echo urlencode($data['CI']->encryption->encrypt($row['exam_id']));?>'><?php echo $row['exam_name'];?></option>
                            <?php
                                }
                             ?>
                             
                             
                            </select>
                        </div>
            <script>
            function findExam(data){
             location.href="<?php echo base_url('staff/page/viewMarks?exam_id=');?>"+data.value;
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
    }else{
        alert('Need Authorization | Role: Class Teacher');
        jsRedirect(base_url('staff'));
    }
}
function manageQuestions($data){
    ?>
<h1>Manage Exam Question Papers</h1><hr/>
<div class="row">


                <div class="col-lg-5">
                    <b>Upload Questions</b><br><br>
                    <?php
              if(validation_errors()){
                  ?><div class="alert alert-danger">
                      <?php echo validation_errors();?>
                </div>
                <?php
             
                }
              
              
                if($data['CI']->input->post('level')==1){
                     echo form_open_multipart('staff/page/manageQuestions');?>
                <div class="form-group">
                        <label>Exam-Name</label>
                        
                </div>
                    <div class="form-group">
                        <select name="exam" class="form-control">
                        <?php
                       $paper=$data['CI']->encryption->decrypt($data['CI']->input->post('paper'));
                       //$paper=  findAllInfoAboutPaper($paper);
                       $sql="select * from exams where paper_id={$paper} and state='DECLARED'";
                       $sql=$data['CI']->db->query($sql);
                       foreach ($sql->result_array() as $row){
                           ?>
                            <option value="<?php echo $data['CI']->encryption->encrypt($row['exam_id']);?>"><?php echo $row['exam_name']." | | ".  findClassName($row['class_id']);?></option>
                       <?php
                       
                       }
                       ?>
                        </select>
                </div>
                    <div class="form-group">
                        <input type="hidden" value="<?php echo $data['CI']->input->post('paper');?>" name="paper">
                    <input type="hidden" value="<?php echo $data['CI']->input->post('ename');?>" name="ename">

                        <input type="hidden" value="2" name="level">
                        <input type="submit" value="Next" class="btn btn-primary">
                        
                    </div>
                </form>
                    <?php
                    
                    
                }elseif($data['CI']->input->post('level')==2){
                    
                    $paper=$data['CI']->input->post('paper');
                     $exam=$data['CI']->input->post('exam');
                      $ename=$data['CI']->input->post('ename');
                     echo form_open_multipart('staff/manageQuestions');?>
                <div class="form-group">
                        <label>Question Paper</label>
                        
                </div>
                    <div class="form-group">
                        <input type="file" name="efile" class="form-control" placeholder="2013 MODEL PAPER">
                        
                </div>
                <div class="form-group">
                      <input type="hidden" value="<?php echo $data['CI']->input->post('paper');?>" name="paper">
                    <input type="hidden" value="<?php echo $data['CI']->input->post('ename');?>" name="ename">
                     <input type="hidden" value="<?php echo $data['CI']->input->post('exam');?>" name="exam">
                    <input type="submit" class="btn btn-primary" value="Upload">
                </div>
                      
                  <?php   
                      
                }else{
                    
                
                echo form_open_multipart('staff/page/manageQuestions');?>
                <div class="form-group">
                        <label>Question-Paper Name</label>
                        
                </div>
                    <div class="form-group">
                        <input type="text" name="ename" class="form-control" placeholder="2013 MODEL  QUESTION PAPER">
                        
                </div>
                    
                
               
                <div class="form-group">
                    <label>Select Paper</label>
                </div>
                
                <div class="form-group">
                <select class="form-control" name="paper">
                     <?php
                     $sql="select * from staffpaper where userid={$_SESSION['uid']} order by paper_id";
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
                    <input type="hidden" value="1" name="level">
                    <input type="submit" value="Next" class="btn btn-primary">
                </div>
                
            </form>
            <?php
                }
                ?>
            
            
</div>
    
    <div class="col-lg-12">
        <hr/><b>Manage Questions</b><br><br>
        <div class="panel panel-default">
                        <div class="panel-heading">
                          Question Paper Management
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
                                           
                                           $sql="select * from question_papers where author_id={$_SESSION['uid']} and active=1";
                                           $sql=$data['CI']->db->query($sql);
                                           foreach($sql->result_array() as $row){
                                               ?>
                                            <tr>
                                                <td><?php echo findExamNamefromId($row['exam_id']);?></td>
                                            <td><?php echo findPaperName($row['paper_id']);?></td>
                                            <td><?php echo findClassName(findClassIdFromExamId($row['exam_id']));?></td>
                                            <td><a target="_BLANK" href='?download=<?php echo urlencode($data['CI']->encryption->encrypt($row['file_name']));?>'>Download</a></td>
                                            <td><button class="btn btn-warning"><?php echo $row['state'];?></button></td>
                                            <td><?php echo findUsername($row['author_id']);?></td>
                                            <td><a href='<?php echo base_url('staff/page/manageQuestions?del='); echo urlencode($data['CI']->encryption->encrypt($row['qid']));?>'>Delete</a></td>

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
if($data['CI']->input->get('download')){
    
    $url="./Questions/".$data['CI']->encryption->decrypt($data['CI']->input->get('download'));
    
    force_download($url, NULL);
}

    if($data['CI']->encryption->decrypt($data['CI']->input->get('del'))){
        
        $sql="update question_papers set active=0 where qid={$data['CI']->encryption->decrypt($data['CI']->input->get('del'))}";
       echo $sql;
        $sql=$data['CI']->db->query($sql);
        ?>
        <script>
            window.alert('File Deleted');
            location.href="<?php echo base_url('staff/page/manageQuestions');?>";
            </script>
            <?php
    }


}
function manageDocs($data){
    ?>
<h1>Manage My E-Library</h1><hr/>
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
            
                    
                <?php echo form_open_multipart('staff/manageDocs');?>
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
                     $sql="select * from staffpaper where userid={$_SESSION['uid']} order by paper_id";
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
                                           
                                           $sql="select * from epaper where paper_id IN(select paper_id from staffpaper where userid={$_SESSION['uid']}) and active=1";
                                           $sql=$data['CI']->db->query($sql);
                                           foreach($sql->result_array() as $row){
                                               ?>
                                            <tr>
                                            <td><?php echo $row['ename'];?></td>
                                            <td><?php echo findPaperName($row['paper_id']);?></td>
                                            <td><?php echo $row['log'];?></td>
                                            <td><p onClick='prompt("File URL","<?php echo base_url('uploads/'.$row['file_name']);?>");'>Click Here |</p> <a target="_BLANK" href='<?php echo base_url('uploads/'.$row['file_name']);?>'>View</a></td>
                                            <td><a href='<?php echo base_url('staff/page/manageDocs?del='); echo urlencode($data['CI']->encryption->encrypt($row['id']));?>'>Delete</a></td>
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
            location.href="<?php echo base_url('staff/page/manageDocs');?>";
            </script>
            <?php
    }


}
function manageFiles($data){
    ?>
    <h1>Manage Files</h1><hr/><div class="row">
        <div class="col-lg-4">
            
                <?php echo form_open_multipart('staff/manageUploads');?>
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
                                            <td><a href='<?php echo base_url('staff/page/manageUploads?del='); echo urlencode($data['CI']->encryption->encrypt($row['id']));?>'>Delete</a></td>
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
            location.href="<?php echo base_url('staff/page/manageUploads');?>";
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
            if($data['CI']->input->post('level')==2){
                $paperId=$data['CI']->encryption->decrypt($data['CI']->input->post('paper'));
                $paperInfo=findAllStaffInfoFromPaperId($paperId);
                $classId=$data['CI']->encryption->decrypt($data['CI']->input->post('class'));
                ?>
            <div class="col-lg-6">
                <div class="alert alert-success">
                    Staff Name:<?php echo findUsername($_SESSION['uid']);?>
                    <br>Class Name:<?php echo findClassName($classId);?>
                </div>
         
              
                <form action="<?php echo base_url('staff/mailStudents');?>" method="post">
                <input type="hidden" name="class" value="<?php echo $data['CI']->encryption->encrypt($classId);?>">
                <input type="hidden" name="paper" value="<?php echo  $data['CI']->input->post('paper');?>">   
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
                
                
            
                
            }elseif($data['CI']->input->post('level')==1){
                ?>
                <div class="col-lg-4">
                <form action="" method="post">
                    <input type="hidden" name="paper" value="<?php echo $data['CI']->input->post('paper');?>">
                    
                    <div class="form-group">
                        <label>Class</label>
                        
                    </div>
                    <div class="form-group">
                        <select name="class" class="form-control">
                            <?php
                            $paper=$data['CI']->input->post('paper');
                            $paperId=$data['CI']->encryption->decrypt($paper);
                            if($paperId){
                                $sql="select * from staffpaper where paper_id={$paperId}";
                                $sql=$data['CI']->db->query($sql);
                                foreach($sql->result_array() as $row){
                                    ?><option value="<?php echo $data['CI']->encryption->encrypt($row['classid']);?>"><?php echo findClassName($row['classid']);?></option>
                                    <?php
                                }
                                
                            }
                            
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="level" value="2">
                        <input type="submit" class="btn btn-primary" value="Next">
                    </div>
                    
                </form>
                
                
                <?php
                
            }
            else{
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
                    Select Paper
                </div>
                <div class="form-group">
                    <select class="form-control" name="paper">
                     <?php
                     $sql="select * from staffpaper where userid={$_SESSION['uid']} order by paper_id";
                     $sql=$data['CI']->db->query($sql);
                     foreach($sql->result_array() as $row){
                       ?>
                        <option value="<?php echo $data['CI']->encryption->encrypt($row['paper_id']);?>"><?php echo findPaperName($row['paper_id']);?></option>
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
function generateMarks($data){
    ?><h1>Report Card </h1>
    <hr/>
        <div class="row">
        <?php if($data['CI']->input->post('level')==1){
            ?>
        <div class="col-lg-4">
            
            <form action="<?php echo base_url('staff/page/generateMarks');?>" method="POST">
                <div class="form-group">
                    
                    <label>Select Paper</label>
                    <select name="paperName" class="form-control">
                        <?php
                        $classId=$data['CI']->encryption->decrypt($data['CI']->input->post('className'));
                        if($classId){
                        $sql="select * from staffpaper where userid={$_SESSION['uid']} and classid={$classId}";
                        $sql=$data['CI']->db->query($sql);
                        foreach ($sql->result_array() as $row){
                            ?>
                        <option value="<?php echo $data['CI']->encryption->encrypt($row['paper_id']);?>"><?php echo findPaperName($row['paper_id']);?></option>
                        <?php
                        }
                        }
                        
                        ?>
                        
                    </select>
                    <input type="hidden" value="<?php echo $data['CI']->input->post('className');?>" name="className">
                    
                    <input type="hidden" value="2" name="level">
                    
                </div>
                
                <div class="form-group">
                    <input type="submit" value="Next" class="btn btn-primary">
                </div>
                
            </form>
            
        </div>
        
            <?php
            
        }elseif($data['CI']->input->post('level')==2){
            ?>
        <div class="col-lg-4">
        <form action="" method="post">
            <div class="form-group">
                <label>
                    Exam
                </label>
                 </div>
            <div class="form-group">
                <select name="exam" class="form-control">
                    <?php
                    $paperName=$data['CI']->input->post('paperName');
                    $className=$data['CI']->input->post('className');
                    $paper=$data['CI']->encryption->decrypt($paperName);
                    $class=$data['CI']->encryption->decrypt($className);
                    $semester=  findSemesterFromPaperId($paper);
                    
                    $sql="select * from exams where class_id={$class} and paper_id={$paper} and state='DECLARED' or state='CLOSED'";
                    //echo $sql;
                    $sql=$data['CI']->db->query($sql);
                    foreach ($sql->result_array() as $row){
                        ?>
                    <option value="<?php echo $data['CI']->encryption->encrypt($row['exam_id']);?>"><?php echo $row['exam_name'];?></option>
                    <?php
                    }
                    
                    
                    
                    
                    
                    ?>
                </select>
            </div>
                
            <input type="hidden" name="level" value="3">
            <input type="hidden" name="paperName" value="<?php echo $paperName;?>">
            <input type="hidden" name="className" value="<?php echo $className;?>">
            <div class="form-group">
                <input type="submit" value="Next" class="btn btn-primary">
            </div>
        </form>
        </div>
        
        
        <?php
            
        
        }elseif($data['CI']->input->post('level')==3){
             $paperName=$data['CI']->input->post('paperName');
                    $className=$data['CI']->input->post('className');
            $examName=$data['CI']->input->post('exam');
                    $paper=$data['CI']->encryption->decrypt($paperName);
                    $class=$data['CI']->encryption->decrypt($className);
                    $exam=$data['CI']->encryption->decrypt($examName);
                    $semester=  findSemesterFromPaperId($paper);
            if($exam){
                
            
           ?>
            <div class="col-lg-8">
            <div class="alert alert-success">
                Exam Name: <?php echo findExamNamefromId($exam);?> | Class: <?php echo findClassName($class);?> <br>
                Paper Name: <?php echo findPaperName($paper);?> | Semester: <?php echo $semester;?> | Staff Name: <?php echo findUsername($_SESSION['uid']);?>
                <p onclick="window.print();">   <b>Print Report</b></p>
            </div>
                <div class="panel panel-default">
                        <div class="panel-heading">
                            Report 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
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
                                        <tr class="success">
                                           <?php
                                           $sql="select * from exam_marks where exam_id={$exam};";
                                           $sql=$data['CI']->db->query($sql);
                                           foreach ($sql->result_array() as $row){
                                               ?><tr>
                                            <td><?php echo $row['userid'];?></td>
                                            <td><?php echo findStudentNameFromUsername($row['userid']);?></td>
                                            <td><?php $examInfo=  findAllInfoAboutExam($exam); echo $examInfo[6];?></td>
                                            <td><?php echo $row['mark'];?></td>
                                            <td><?php
                                            if($row['mark']>=$examInfo[7]){
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
                                        </tr>
                                       
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
            <?php
            }else{
                show_error('No Exam Selecteted.. Goto Previous page');
            }
            }else{
                 
        ?>
        <div class="col-lg-4">
            
            <form action="<?php echo base_url('staff/page/generateMarks');?>" method="POST">
                <div class="form-group">
                    
                    <label>Class Name</label>
                    <select name="className" class="form-control">
                        <?php
                        $sql="select * from staffpaper where userid={$_SESSION['uid']}";
                        $sql=$data['CI']->db->query($sql);
                        foreach ($sql->result_array() as $row){
                            ?>
                        <option value="<?php echo $data['CI']->encryption->encrypt($row['classid']);?>"><?php echo findClassName($row['classid']);?></option>
                        <?php
                        }
                        
                        ?>
                        
                    </select>
                    <input type="hidden" value="1" name="level">
                    
                </div>
                
                <div class="form-group">
                    <input type="submit" value="Next" class="btn btn-primary">
                </div>
                
            </form>
            
        </div>
        <?php
            
            
        }
    
        


}                    
function manageExams($data){
    ?>
                     <h1>Manage Exams</h1><div class="row">
                         <hr/>
                         <script>
                        function examState(j){
                        location.href="<?php echo base_url('staff/page/myExams/?state=');?>"+j.value;    
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
                                        $paper_id= findPapersInfoFromStaff($_SESSION['uid']);
                                        
                                        foreach($paper_id as $paperData){
                                          
                                       // echo .$paperData[1];
                                        
                                        if($state=='DECLARED' or $state=='CLOSED'){
                                       $sql="select * from exams where state='{$state}' and dept_id={$_SESSION['dept_id']} and paper_id={$paperData[0]} and class_id={$paperData[1]}";
                                        }else
                                        {
                                    $sql="select * from exams where dept_id={$_SESSION['dept_id']} and state NOT IN('DELETED') and paper_id={$paperData[0]} and class_id={$paperData[1]}";
                                        }
                                       // echo $sql;  
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
            location.href="<?php echo base_url('staff/page/myExams');?>";
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
            window.alert("Exam Closes successfully | No more provision to update mark sheet | To re-open the exam | Contact the concern HOD");
        location.href="<?php echo base_url('staff/page/myExams');?>";
            </script><?php
            
        
    }
   
    
}                  
function createExams($data){
    ?>
<h1>Create Exams</h1>
<hr/>
<div class="row">
    <div class="col-lg-4">
     <?php if($data['CI']->input->post('level')==1){
            ?>
        
            
            <form action="<?php echo base_url('staff/page/createExams');?>" method="POST">
                <div class="form-group">
                    
                    <label>Select Paper</label>
                    <select name="paperName" class="form-control">
                        <?php
                        $classId=$data['CI']->encryption->decrypt($data['CI']->input->post('className'));
                        if($classId){
                        $sql="select * from staffpaper where userid={$_SESSION['uid']} and classid={$classId}";
                        $sql=$data['CI']->db->query($sql);
                        foreach ($sql->result_array() as $row){
                            ?>
                        <option value="<?php echo $data['CI']->encryption->encrypt($row['paper_id']);?>"><?php echo findPaperName($row['paper_id']);?></option>
                        <?php
                        }
                        }
                        
                        ?>
                        
                    </select>
                    <input type="hidden" value="<?php echo $data['CI']->input->post('className');?>" name="className">
                    
                    <input type="hidden" value="2" name="level">
                    
                </div>
                
                <div class="form-group">
                    <input type="submit" value="Next" class="btn btn-primary">
                </div>
                
            </form>
            
        </div>
        
            <?php
            
        }elseif ($data['CI']->input->post('level')==2) {
          ?>
    
    <form action="<?php echo base_url('staff/page/createExams');?>" method="post">
<input type="hidden" value="<?php echo $data['CI']->input->post('className');?>" name="className">
<input type="hidden" value="<?php echo $data['CI']->input->post('paperName');?>" name="paperName">

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
                                         <input type="hidden" name="level" value="3">
                                         <input type="submit" name="Level2" class="btn btn-primary" value="Preview Exam Card">
                                     </div>

    </form>
    
    
    
    
    <?php
                
            
            
            
        }elseif($data['CI']->input->post('level')==3){
                                     
        $className=$data['CI']->input->post('className');
        $paperName=$data['CI']->input->post('paperName');
        if($className and $paperName){
            
        
        $className=$data['CI']->encryption->decrypt($className);
        $paperId=$data['CI']->encryption->decrypt($paperName);
        
        
        
        
        $semester=  findSemesterFromPaperId($paperId);
        $course=  findCourseIdFromPapaerId($paperId);
        
       
            ?>
                             </div></div>
                             <div class="col col-lg-8">
                    <div class="panel panel-yellow">
                        <form action="<?php echo base_url('staff/createExams');?>" method="post">
                            <input type="hidden" name="examName" value="<?php echo $data['CI']->input->post('examName');?>">
                            <input type="hidden" name="examDate" value="<?php echo $data['CI']->input->post('examDate');?>">
                            <input type="hidden" name="maxMark" value="<?php echo $data['CI']->input->post('maxMark');?>">
                            <input type="hidden" name="minMark" value="<?php echo $data['CI']->input->post('minMark');?>">
                            <input type="hidden" name="course" value="<?php echo $data['CI']->encryption->encrypt(findCourseIdFromPapaerId($paperId));?>">
                            <input type="hidden" name="semester" value="<?php echo $data['CI']->encryption->encrypt(findSemesterFromPaperId($paperId));?>">
                           
                            
                        <div class="panel-heading">
                            Exam Data Card | Preview
                        </div>
                        <div class="panel-body">
                            <div class="alert alert-success">
                                Exam Name:<?php echo $data['CI']->input->post('examName');?><br>
                                Exam Date:<?php echo $data['CI']->input->post('examDate');?>  <br>
                                Exam Max Mark:<?php echo $data['CI']->input->post('maxMark');?> <br>
                                Exam Pass Mark:<?php echo $data['CI']->input->post('minMark');?><br>
                                
                                
                                <div class="alert alert-warning">
                                    
                                    <?php
                                    echo "Exam Scheduled for ".  findClassName($className);
                                    ?>
                                    <div class="alert alert-info">
                                    <?php 
                                   
                                    echo "Paper Name: ".findPaperName($paperId)." | Staff:".findStaffNamePaper($paperId,$className)."<br>";
                                    
                                    
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
                                'classNameId'=>$className,
                                'paperNameId'=>$paperId
                            );
                            $data['CI']->session->set_userdata($createExam);
                            ?>
                            <input type="submit" class="btn btn-primary" value="Save Exam">
                            </form>
                        </div>
                    </div>
                             </div>
                                 <?php
           
            
        
            
            
            
        
                                
                                     
                                     
                                     
        }
        else
        {
            
        ?>
        
            
            <form action="<?php echo base_url('staff/page/createExams');?>" method="POST">
                <div class="form-group">
                    
                    <label>Class Name</label>
                    <select name="className" class="form-control">
                        <?php
                        $sql="select * from staffpaper where userid={$_SESSION['uid']}";
                        $sql=$data['CI']->db->query($sql);
                        foreach ($sql->result_array() as $row){
                            ?>
                        <option value="<?php echo $data['CI']->encryption->encrypt($row['classid']);?>"><?php echo findClassName($row['classid']);?></option>
                        <?php
                        }
                        
                        ?>
                        
                    </select>
                    <input type="hidden" value="1" name="level">
                    
                </div>
                
                <div class="form-group">
                    <input type="submit" value="Next" class="btn btn-primary">
                </div>
                
            </form>
            
        </div>
        <?php
        }
?>    
</div>
</div>
<?php
}
                    
                    function viewStudent($data){
                        ?>
<h1>
    View Students
</h1>
<hr>
<div class='row'>
    <div class='col col-lg-12'>
        <div class='alert alert-info'>
            
            <div class='form-group'>
                <label>Select Class</label>
                <select onchange="classId(this);" style="width:40%;" name='classId' class="form-control">
                    <option>Select a class</option>   
                 <?php
                    $sql="select distinct classid from staffpaper where userid={$_SESSION['uid']}";
                    $sql=$data['CI']->db->query($sql);
                    foreach ($sql->result_array() as $row){
                        ?><option value="<?php echo urlencode($data['CI']->encryption->encrypt($row['classid']));?>"><?php echo findClassName($row['classid']);?></option>
                    <?php
                    
                    }
                    
                    
                    
                    ?>
                    
                </select>
            
            <script>
                
            function classId(url){
                
            location.href="<?php echo base_url('staff/page/viewStudent?class=');?>"+url.value;

            
            }</script>
        </div>
        
    </div>
        
        
        <?php
        $class=$data['CI']->input->get('class');
       
        $class=$data['CI']->encryption->decrypt($class);
        
        
       
        if($class){
$courseId=  findCourseFromClassId($class);

$sql="select * from users where userid in(select userid from student_ac_meta where admn_year=(select academic_year from semester_logs where     course_id={$courseId} and semester=(SELECT semester FROM deptclass d WHERE classid={$class})) and course_id=(select course_id from deptclass where classid={$class}) and batch=(select batch from deptclass where classid={$class}))and active=1";
//echo $sql;        
$sql=$data['CI']->db->query($sql);
        ?>
        <div class="panel panel-default">
                        
           
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                       <tr>
                                            <th>Roll No</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            
                                            <th>More</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                                foreach ($sql->result_array() as $row){
                                                ?>
                                    <tr><td><?php echo $row['username'];?>   </td><?php
                                    ?><td><?php echo $row['name'];?></td> 
                                    <td><?php echo $row['phone'];?></td> 
                                     <td><?php echo $row['email'];?></td> 
                                      
                                     <td><a href="?profile=<?php echo urlencode($data['CI']->encryption->encrypt($row['username']));?>"><button class='btn btn-primary'>View Profile</button></a>
                                      </td>
                                      
                                     
                                           </tr><?php 
                                                    
                                                    
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
         $username=$data['CI']->encryption->decrypt($data['CI']->input->get('profile'));
         
         if($username){
            // alert($username);
             $sqlUsers="select * from users where username={$username}";
            $sqlUsers=$data['CI']->db->query($sqlUsers);
             $sqlUsers=$sqlUsers->row_array();//BASIC INFO STUDENT
             //print_r($sqlUsers);    
             $sqlMeta="select * from student_profile where userid={$sqlUsers['userid']}";
             //echo $sqlMeta;  
             $sqlMeta=$data['CI']->db->query($sqlMeta);
             $sqlMeta=$sqlMeta->row_array();//PROFILE INFO STUDENT
               // print_r($sqlMeta);
         ?>
    </div>
    <div class="col-lg-5">
                     <div class="form-group">
                                    <label>Name</label>
                                </div>
                                 <div class="form-group">
                                     <input type="text" name='name' value="<?php echo strtoupper(findUsername($sqlUsers['userid']));?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                </div>
                                 <div class="form-group">
                                     <input type="text" name='email' value="<?php echo findEmailFromUserId($sqlUsers['userid']);?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" name='phone' value="<?php echo findPhoneFromUserId($sqlUsers['userid']); ?>" class="form-control">
                                </div>
                                 <div class="form-group">
                                    <label>Date Of Birth</label>
                                </div>
                                <div class="form-group">
                                     <input type="date" name="dob" value="<?php echo $sqlMeta['dob'];?>" class="form-control">
                                </div>
                               
                                 <div class="form-group">
                                    <label>Religion</label>
                                </div>
                                <div class="form-group">
                                     <input type="text" name="religion" value="<?php echo $sqlMeta['Religion'];?>" class="form-control">
                                </div>
                            
                                 <div class="form-group">
                                    <label>Caste</label>
                                </div>
                                <div class="form-group">
                                     <input type="text" name="caste" value="<?php echo $sqlMeta['caste'];?>" class="form-control">
                                </div>
                            
                                 <div class="form-group">
                                    <label>Father Name</label>
                                </div>
                                <div class="form-group">
                                     <input type="text" name="fname" value="<?php echo $sqlMeta['father_name'];?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Father's Phone</label>
                                </div>
                                <div class="form-group">
                                     <input type="number" name="fphone" value="<?php echo $sqlMeta['father_mobile'];?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                </div>
                                <div class="form-group">
                                    <textarea class='form-control' name='address'><b><h3><?php echo $sqlMeta['address'];?></b></h3></textarea>
                                </div>
        
        
        
            <?php
             
         }
        
        ?>
</div>





</div>        
                        
                        
                    <?php
                    }
                    
                   
                    
                    
                    function myPapers($data){
                        ?>
                            

<h1>My Papers</h1>
<hr>
<div class="row">
    <div class="col-lg-8">
      <div class="panel panel-default">
                        <div class="panel-heading">
                           Papers.
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Course</th>
                                            <th>Paper Name</th>
                                            <th>Semester</th>
                                            <th>Class </th>
                                             <th>View Class </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql="select * from staffpaper where userid={$_SESSION['uid']}";
                                       $sql=$data['CI']->db->query($sql);
                                       foreach ($sql->result_array() as $row){
                                           ?>
                                        <tr>
                                            <td><?php echo findCourseName($row['course_id']);?></td>
                                            <td><?php echo findPaperName($row['paper_id']);?></td>
                                            <td><?php echo $row['semester'];?></td>
                                            <td><?php echo findClassName($row['classid']);?></td>
                                            <td><a href="<?php echo base_url('/staff/page/viewStudent?paper='.urlencode($data['CI']->encryption->encrypt($row['paper_id'])));?>"<button class="btn btn-outline btn-info">View Class</button></a></td>
                                            
                                            
                                            
                                        
                                        </tr>
                                        
                                        <?php
                                       }
                                        ?>
                                        <tr>
                                          
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>  
        
    </div>
        <?php                
                        
                    }
                    
                function classTeacher($data){
    $sql="select * from deptclass where staffID={$_SESSION['uid']} and active=1";
        $sql=$data['CI']->db->query($sql);
        
        if($sql->num_rows()>0){
                    ?>
    <h1>Class Teacher</h1>
    <div class="row">
        <hr/>
        <?php
        
            $sql=$sql->row_array();
           ?>
         <div class="col-lg-12">
             <div class='alert alert-info'>
                 
                 <p>Class Name: <?php echo findClassName($sql['classid']);?></p>
                 <p>Semester:<?php echo $sql['semester'];?></p>
                 <p>Course: <?php echo findCourseName($sql['course_id']);?></p>
                <p>Batch: <?php echo $sql['batch'];?></p>
                <?php
                $classStudents=array(
                    'classid'=>$sql['classid'],
                    'semester'=>$sql['semester'],
                    'course'=>$sql['course_id'],
                    'batch'=>$sql['batch']
                );
                
                ?>
                
             </div>
             <?php
            // $sql="select * from users where userid IN(select userid from student_ac_meta where course_id IN(select course_id from deptclass where course_id={$classStudents['course']} and semester={$classStudents['semester']} )))";
            $sql="select * from users where userid IN(";
             $sql.="select userid from student_ac_meta where course_id=";
             $sql.="(select course_id from deptclass where semester={$classStudents['semester']} and batch={$classStudents['batch']} and classid={$classStudents['classid']})";
             $sql.="and batch={$classStudents['batch']} and admn_year=";
             $sql.="(select academic_year from semester_logs where course_id={$classStudents['course']} and semester={$classStudents['semester']})) and active=1 order by name";
             
             //echo $sql;
             ?>
             <div class="panel panel-default">
                        <div class="panel-heading">
                           Students
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Roll No</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            
                                            <th>More</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                           <?php
                                           $sql=$data['CI']->db->query($sql);
                                           foreach ($sql->result_array() as $row){
                                               
                                               ?>
                                    <tr><td><?php echo $row['username'];?>   </td><?php
                                    ?><td><?php echo $row['name'];?></td> 
                                    <td><?php echo $row['phone'];?></td> 
                                     <td><?php echo $row['email'];?></td> 
                                     <td><a href="<?php echo base_url('staff/page/viewStudent?profile=').urlencode($data['CI']->encryption->encrypt($row['username']));?>"><button class='btn btn-primary'>View Profile</button></a>

                                      
                                     
                                           </tr><?php    
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
            <?php
            
            
            
        }else{
            
            alert('Need Authorization | Role: Class Teacher');
            jsRedirect(base_url('/staff'));
            
        }
       
   
                    
                }
 function manageAttendance($data){
     $sql="select * from deptclass where staffID={$_SESSION['uid']} and active=1";
        $sql=$data['CI']->db->query($sql);
        
        if($sql->num_rows()>0){
                    ?>
    <h1>Class Teacher</h1>
    
        <hr/>
        <?php
        
            $sql=$sql->row_array();
           ?>
         <div class="col-lg-12">
             <div class='alert alert-info'>
                <form action='<?php echo base_url('staff/manageAttendance');?>' method="post">

                 <p>Class Name: <?php echo findClassName($sql['classid']);?></p>
                 <p>Semester:<?php echo $sql['semester'];?></p>
                 <p>Course: <?php echo findCourseName($sql['course_id']);?></p>
                <p>Batch: <?php echo $sql['batch'];?></p>
                <?php
               
                $year=  findAcademicYearByCourseIdSemester($sql['course_id'],$sql['semester']);
                if(!$year){
                    alert('Error with Year');
                    
                }else{
                    
                
                ?>
                <p><b>Total Days: <?php $attendance=findAttendanceAllData($sql['course_id'],$year, $sql['semester']);
                if($attendance[4]){
                echo $attendance[4];
                ?>    
                    
                    </b></p>
                <?php
                
                $classStudents=array(
                    'classid'=>$sql['classid'],
                    'semester'=>$sql['semester'],
                    'course'=>$sql['course_id'],
                    'batch'=>$sql['batch']
                );
                
                ?>
                
             </div>
             <?php
             $sql1="select * from attn_data where attn_id={$attendance[0]}";
             $sql1=$data['CI']->db->query($sql1);
              if($sql1->num_rows()!=0){
                   //alert('Attendance Data Already Present');
                   //$sql="delete from attn_data where attn_id={$attendance[0]}";
                   //$data['CI']->db->query($sql);
                   ?>
             <input type='hidden' name='type' value='update'>
             <?php
                   $sql="select users.name as name,attn_data.userid as username from users,attn_data where attn_data.userid=users.username and attn_data.attn_id={$attendance[0]} ";
                   
              }else{
                 
              
            // $sql="select * from users where userid IN(select userid from student_ac_meta where course_id IN(select course_id from deptclass where course_id={$classStudents['course']} and semester={$classStudents['semester']} )))";
            $sql="select * from users where userid IN(";
             $sql.="select userid from student_ac_meta where course_id=";
             $sql.="(select course_id from deptclass where semester={$classStudents['semester']} and batch={$classStudents['batch']} and classid={$classStudents['classid']})";
            $sql.="and batch={$classStudents['batch']} and admn_year=";
             $sql.="(select academic_year from semester_logs where course_id={$classStudents['course']} and semester={$classStudents['semester']})) and active=1 order by name";
              }
            // echo $sql;
             ?>
                 <input type='hidden' name='atnId' value="<?php echo $data['CI']->encryption->encrypt($attendance[0]);?>">
                 <div class="panel panel-default">
                        <div class="panel-heading">
                           Students
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Roll No</th>
                                            <th>Name</th>
                                            <th>Attendance</th> 
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                           <?php
                                           $sql=$data['CI']->db->query($sql);
                                           foreach ($sql->result_array() as $row){
                                               
                                               ?>
                                    <tr><td><?php echo $row['username'];?>   </td><?php
                                    ?><td><?php echo $row['name'];?></td> 
                                    <input type="hidden" name="sId[]" value="<?php echo $data['CI']->encryption->encrypt($row['username']);?>">

                                    <td> 
                                    <input value="0" onChange="checkDays(this);" type="number" name="days[]" class="form-control" style="width:20%;"></td>
                                        
                                      
                                     
                                    
                                      
                                     
                                           </tr><?php    
                                           }
                                           
                                           
                                           
                                           ?>
                                        
                                           
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            <div class='form-group'>
                     <input type='submit' value='Save' class='btn btn-primary'>
                             </form>
                 </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                 
                 <script>
                        function checkDays(data){
                            if(data.value><?php echo $attendance[4];?> | data.value<0){
                                    
                                window.alert('Days should be within the limit of Max Days');    
                               data.value=0;
                                }
                        }
                        
                        </script>
         </div>
                
            
       
            <?php
            
                }else{
                    alert('Attendance Data is not updated by the the HOD.. Contact HOD');
                }
                }
            
        }else{
            
           alert('Need Authorization | Role: Class Teacher');
           jsRedirect(base_url('staff'));
            
        }
       
   
                    
                }
                    function upMark($data){
                        ?>
    <h1>Update Marks</h1>
    <hr/>
    <div class="row">
        <?php if($data['CI']->input->post('level')==1){
            ?>
        <div class="col-lg-4">
            
            <form action="<?php echo base_url('staff/page/upMark');?>" method="POST">
                <div class="form-group">
                    
                    <label>Select Paper</label>
                    <select name="paperName" class="form-control">
                        <?php
                        $classId=$data['CI']->encryption->decrypt($data['CI']->input->post('className'));
                        if($classId){
                        $sql="select * from staffpaper where userid={$_SESSION['uid']} and classid={$classId}";
                        $sql=$data['CI']->db->query($sql);
                        foreach ($sql->result_array() as $row){
                            ?>
                        <option value="<?php echo $data['CI']->encryption->encrypt($row['paper_id']);?>"><?php echo findPaperName($row['paper_id']);?></option>
                        <?php
                        }
                        }
                        
                        ?>
                        
                    </select>
                    <input type="hidden" value="<?php echo $data['CI']->input->post('className');?>" name="className">
                    
                    <input type="hidden" value="2" name="level">
                    
                </div>
                
                <div class="form-group">
                    <input type="submit" value="Next" class="btn btn-primary">
                </div>
                
            </form>
            
        </div>
        
            <?php
            
        }elseif($data['CI']->input->post('level')==2){
            ?>
        <div class="col-lg-4">
        <form action="" method="post">
            <div class="form-group">
                <label>
                    Exam
                </label>
                 </div>
            <div class="form-group">
                <select name="exam" class="form-control">
                    <?php
                    $paperName=$data['CI']->input->post('paperName');
                    $className=$data['CI']->input->post('className');
                    $paper=$data['CI']->encryption->decrypt($paperName);
                    $class=$data['CI']->encryption->decrypt($className);
                    $semester=  findSemesterFromPaperId($paper);
                    
                    $sql="select * from exams where class_id={$class} and paper_id={$paper} and state='DECLARED'";
                    //echo $sql;
                    $sql=$data['CI']->db->query($sql);
                    foreach ($sql->result_array() as $row){
                        ?>
                    <option value="<?php echo $data['CI']->encryption->encrypt($row['exam_id']);?>"><?php echo $row['exam_name'];?></option>
                    <?php
                    }
                    
                    
                    
                    
                    
                    ?>
                </select>
            </div>
                
            <input type="hidden" name="level" value="3">
            <input type="hidden" name="paperName" value="<?php echo $paperName;?>">
            <input type="hidden" name="className" value="<?php echo $className;?>">
            <div class="form-group">
                <input type="submit" value="Next" class="btn btn-primary">
            </div>
        </form>
        </div>
        
        
        <?php
            
        
        }elseif($data['CI']->input->post('level')==3){
        $paperName=$data['CI']->input->post('paperName');
        $className=$data['CI']->input->post('className');
        $exam=$data['CI']->input->post('exam');
        $paper=$data['CI']->encryption->decrypt($paperName);
        $class=$data['CI']->encryption->decrypt($className);
        $exam=$data['CI']->encryption->decrypt($exam);
        if($paper and $class and $exam){
            
        
        ?>
        
        <div class="row">
            <div class="col-lg-12">
                <form action="<?php echo base_url('staff/upMark');?>" method="post">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-heading">
                            Paper Name:<B><?php echo findPaperName($paper);?></B> | Course Name:<b> <?php echo findCourseNameFromPaperId($paper);?></b><br>
                            Semester:<b><?php echo findSemesterFromPaperId($paper);?></b> | Class Name: <b><?php echo findClassName($class);?></b>  
                            Exam:<b><?php echo findExamNamefromId($exam);?></b>
                                <hr/>
                                <?php
                                $sql="select * from exams where exam_id={$exam}";
                                $sql=$data['CI']->db->query($sql);
                                $sql=$sql->row_array();
                                ?>
                                Exam Date:<b><?php echo $sql['examDate'];?> </b>  |  Created By :  <b><?php echo findUsername($sql['author_id']);?></b><br>
                                Maximum Mark: <b><?php echo $sql['maxMark'];?></b>  |  Minimum Mark:<b><?php echo $sql['minMark'];?></b>
                                
                        </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                    <input type="hidden" name="exam_id" value="<?php echo $data['CI']->input->post('exam');?>">
                                    <input type="hidden" name="aca_year" value="<?php echo $data['CI']->encryption->encrypt(findAcademicYearByCourseIdSemester(findCourseIdFromPapaerId($paper),findSemesterFromPaperId($paper)))?>">
                                    
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Roll No</th>
                                            <th>Name</th>
                                            <th>Max Mark</th>
                                            <th>Scored Mark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$sqlexam_marks="select * from exam_marks where exam_id={$exam}";
$batch=findBatchFromClassid($class);
$sqlexam_marks=$data['CI']->db->query($sqlexam_marks);
if($sqlexam_marks->num_rows()==0){
$courseId=  findCourseFromClassId($class);
$sql2="select * from users where userid in(select userid from student_ac_meta where admn_year=(select academic_year from semester_logs where     course_id={$courseId} and semester=(SELECT semester FROM deptclass d WHERE classid={$class})) and course_id=(select course_id from deptclass where classid={$class}) and batch=(select batch from deptclass where classid={$class}))and active=1";
//echo $sql;    
   
$sql2=$data['CI']->db->query($sql2);
foreach ($sql2->result_array() as $row2){
    
?>
                                    <tr>

                                        <td><?php echo $row2['username'];?></td>
                                        <td><?php echo $row2['name'];?></td>
                                        <td><?php echo $sql['maxMark'];?></td>
                                        <td>
                                    <input type="hidden" name="sId[]" value="<?php echo $data['CI']->encryption->encrypt($row2['username']);?>">

                                    <input value="0" onChange="checkMark(this);" type="number" name="mark[]" class="form-control" style="width:20%;">
                                        </td>
                                   
                                    </tr>
  <?php
    
}


    
}else{
     $course_id=  findCourseIdFromPapaerId($paper);
$sql2="select * from exam_marks where exam_id={$exam}"; 
$sql2=$data['CI']->db->query($sql2);
foreach ($sql2->result_array() as $row2){
    
?>
                                    <tr><td><?php echo $row2['userid'];;?></td>
                                        <td><?php echo findStudentNameFromUsername($row2['userid']);?></td>
                                        <?php
                                        //echo $exam;
                                        
                                        $exam_info=findAllInfoAboutExam($exam);
                                       // it returns an  index array of sql query
                                        ?>
                                        <td><?php echo $exam_info[6];?></td>
                                        <td>
                                    <input type="hidden" name="sId[]" value="<?php echo $data['CI']->encryption->encrypt($row2['userid']);?>">

                                    <input value="<?php echo $row2['mark'];?>" onChange="checkMark(this);" type="number" name="mark[]" class="form-control" style="width:20%;">
                                        </td>
                                   
                                    </tr>
                                        
  <?php
    
}
 ?>
<input type="hidden" name="markAction" value="update">
                    
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
                    <script>
                        function checkMark(data){
                            if(data.value><?php echo $sql['maxMark'];?> | data.value<0){
                                    
                                window.alert('Mark should be within the limit of exam marks');    
                               data.value=0;
                                }
                        }
                        
                        </script>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-lg btn-block" value="Save Marks">
                        </div>
                </form>
            </div>
            
        </div>
        
        <?php
            
            
        }else
            show_404 ();
        }
        else
        {
            
        ?>
        <div class="col-lg-4">
            
            <form action="<?php echo base_url('staff/page/upMark');?>" method="POST">
                <div class="form-group">
                    
                    <label>Class Name</label>
                    <select name="className" class="form-control">
                        <?php
                        $sql="select * from staffpaper where userid={$_SESSION['uid']}";
                        $sql=$data['CI']->db->query($sql);
                        foreach ($sql->result_array() as $row){
                            ?>
                        <option value="<?php echo $data['CI']->encryption->encrypt($row['classid']);?>"><?php echo findClassName($row['classid']);?></option>
                        <?php
                        }
                        
                        ?>
                        
                    </select>
                    <input type="hidden" value="1" name="level">
                    
                </div>
                
                <div class="form-group">
                    <input type="submit" value="Next" class="btn btn-primary">
                </div>
                
            </form>
            
        </div>
        <?php
        }
        ?>
    </div>
    <?php
                    
                        
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

                        
       
