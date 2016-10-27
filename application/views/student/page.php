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
                                            
                                            <form action="<?php echo base_url("/student/changepassword");?>" method="post">
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
                                            
                                            <form action="<?php echo base_url("/student/changeProfile");?>" method="post">
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
                        case "viewProfile":{
                            $data=array(
                                'CI'=>$CI
                            );
                            //echo "he";
                            viewProfile($data);
                          footerData();
                        }break;
                    case "view_exams":{
                            $data=array(
                                'CI'=>$CI
                            );
                            //echo "he";
                            viewExams($data);
                            footerData();
                        }break;
                    case "view_e_books":{
                            $data=array(
                                'CI'=>$CI
                            );
                            //echo "he";
                            viewEbooks($data);
                            footerData();
                        }break;
                    case "view_attendance":{
                            $data=array(
                                'CI'=>$CI
                            );
                            //echo "he";
                            viewAttendance($data);
                              
                        }break;
                    case "view_university":{
                            $data=array(
                                'CI'=>$CI
                            );
                            //echo "he";
                            viewUniversity($data);
                            footerData();
                        }break;
                    case "viewMarks":{
                            $data=array(
                                'CI'=>$CI
                            );
                            //echo "he";
                            viewMarks($data);
                            footerData();
                        }break;
                        
                    }
                   
                    
                    
                    //function 
                    function viewAttendance($data){
                        ?>
                        <h1>View My Attendance</h1>
                        <hr/>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <?php
                                        $sql1="select * from student_ac_meta where userid={$_SESSION['uid']}";
                                        $sql1=$data['CI']->db->query($sql1);
                                        $sql1=$sql1->row_array();
                                        $year=$sql1['admn_year'];
                                        $course=$sql1['course_id'];
                                        $sql="select semester from semester_logs where academic_year=(select admn_year from student_ac_meta where userid={$_SESSION['uid']})";
                                        $sql=$data['CI']->db->query($sql);
                                        $semester=$sql->row_array();
                                        $semester=$semester['semester'];
                                        //echo $semester;
                                        $admno=  findAdmnFromUserid($_SESSION['uid']);
                                        $sql="select * from attn_data where attn_id=(select attn_id from attendance where course_id={$course} and academic_year={$year} and semester={$semester})and userid={$admno}";
                                        $sql=$data['CI']->db->query($sql);
                                        $AttnData=$sql->row_array();
                                        $AttnInfo="select * from attendance where course_id={$course} and academic_year={$year} and semester={$semester}";
                                        //echo $AttnInfo;
                                        $AttnInfo=$data['CI']->db->query($AttnInfo);
                                        $AttnInfo=$AttnInfo->row_array();
                                       // echo  $AttnInfo['totalDays'].$AttnData['days'];
                                       $dataG['days']=$AttnData['days'];
                                       $dataG['remain']=$AttnInfo['totalDays']-$AttnData['days'];
                                     // echo $dataG['days'];
                                     // echo $dataG['remain'];
                                      
                                        ?>
                                        <div id="aChart">
                                              
                                        </div>
                                        <?php
                                         footerData();
                                        graphData($dataG);
                                        ?>
                                        
                                        
                                    </div>
                            
                                        
                            </div>
                        <?php
                    }
                    function viewMarks($data){
                        ?>
                        <h1>View My Marks</h1>
                        <hr/>
                        <div class="row">
                            <div class="col-lg-8">
                                <?php
                                
                                $sql="select * from student_ac_meta where userid={$_SESSION['uid']}";
                             $sql=$data['CI']->db->query($sql);
                             $sql=$sql->row_array();
                             $sqlC="SELECT classid from deptclass where semester=(select semester from semester_logs where academic_year=(select admn_year from student_ac_meta where userid={$_SESSION['uid']})and course_id={$sql['course_id']})and batch=(select batch from student_ac_meta where userid={$_SESSION['uid']}) and course_id={$sql['course_id']}";
                             $sqlC=$data['CI']->db->query($sqlC);
                             $sqlC=$sqlC->row_array();
                             $sqlE="select exam_id from exams where class_id={$sqlC['classid']}";
                            
                             $admno=  findAdmnFromUserid($_SESSION['uid']);
                                $sql="select * from exam_marks where exam_id IN({$sqlE}) and userid={$admno}";
                                $sql=$data['CI']->db->query($sql);
                                ?>
                                 <div class="panel panel-default">
                        <div class="panel-heading">
                            My Marks
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Exam Name</th>
                                            <th>Paper Name</th>
                                            <th>Staff Name</th>
                                            <th>Max Mark</th>
                                            <th>Pass Mark</th>
                                            <th>Marks Obtained</th>
                                            <th>Result</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                foreach ($sql->result_array() as $row){
                                    ?>
                               
                                        <tr>
                                           <?php
                                           $examInfo=findAllInfoAboutExam($row['exam_id']);
                                           //print_r($examInfo);
                                           ?>
                                            <td><?php echo $examInfo[2];?></td>
                                            <td><?php echo findPaperName($examInfo[3]);?></td>
                                            <td><?php echo findUsername($examInfo[9]);?></td>
                                            <td><?php echo $examInfo[6];?></td>
                                            <td><?php echo $examInfo[7];?></td>
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
                        
                    }
                    function viewUniversity(){
                        ?>
                        <h1>View External Result</h1>
                        <hr/>
                        <div class="row">
                            <div class="col-lg-5">
                                <a target="_BLANK" href="http://mguresult.in"><button class="btn btn-success">MGU RESULT ANALYTICS</button></a>
                                <br> 
                                 <br> 
                                  <br> <p>MGU RESULT ANALYTICS DEVELOPED BY VISHNU KS</p>
                            </div>
                        </div>
                        
                        <?php
                    }
                    function viewExams($data){
                        ?>
                        <h1>View Exams</h1><hr/>
                        <div class="row">
                            <div class="col-lg-8">
                             <?php
                             $sql="select * from student_ac_meta where userid={$_SESSION['uid']}";
                             $sql=$data['CI']->db->query($sql);
                             $sql=$sql->row_array();
                             $sqlC="SELECT classid from deptclass where semester=(select semester from semester_logs where academic_year=(select admn_year from student_ac_meta where userid={$_SESSION['uid']})and course_id={$sql['course_id']})and batch=(select batch from student_ac_meta where userid={$_SESSION['uid']}) and course_id={$sql['course_id']}";
                             $sqlC=$data['CI']->db->query($sqlC);
                             $sqlC=$sqlC->row_array();
                             $sqlE="select * from exams where class_id={$sqlC['classid']}";
                             $sqlE=$data['CI']->db->query($sqlE);
                             ?>
                                <div class="panel panel-default">
                        <div class="panel-heading">
                            My Exams
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Exam Name</th>
                                            <th>Course</th>
                                            <th>Paper</th>
                                            <th>Staff</th>
                                            <th>Exam Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                             foreach ($sqlE->result_array() as $row){
                                 ?>
                                        <tr>
                                    <td><?php echo $row['exam_name'];?></td>
                                    <td><?php echo findCourseName($row['course_id']);?></td>
                                    <td><?php echo findPaperName($row['paper_id']);?></td>
                                    <td><?php echo findUsername(findStaffIdFromClassIdPaperId($row['class_id'], $row['paper_id']));?></td>
                                    <td><?php echo $row['examDate'];?></td>
                                   
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
                    function viewEbooks($data){
                        
                        ?>
                        <h1>E Books</h1>
                        <hr/>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="panel panel-default">
                        <div class="panel-heading">
                            My E Book
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
                                            <th>Download</th>
                                            <th>Author</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stdMeta="select * from student_ac_meta where userid={$_SESSION['uid']}";
                                        $stdMeta=$data['CI']->db->query($stdMeta);
                                        $stdMeta=$stdMeta->row_array();
                                       
                                        $sqlE="select * from epaper where paper_id IN(select paper_id from papers where course_id={$stdMeta['course_id']} and semester=(select semester from semester_logs where academic_year=(select admn_year from student_ac_meta where userid={$_SESSION['uid']})and course_id={$stdMeta['course_id']}))";
                                        $sqlE=$data['CI']->db->query($sqlE);
                                        foreach ($sqlE->result_array() as $row){
                                            ?>
                                        <tr>
                                            <td><?php echo $row['ename'];?> </td>
                                            <td><?php echo findPaperName($row['paper_id']);?></td>
                                            <td><?php echo $row['log'];?></td>
                                            <td><a target="_BLANK" href="<?php echo base_url('uploads/'.$row['file_name']);?>">Download</a></td>
                                            <td><?php echo findUsername($row['author_id']);?></td>
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
                    function viewProfile($data){
                        ?>
                        <h1>
                            View My Profile
                        </h1><hr/>
                        <div class="row">
                            <div class="col-lg-5">
                             <div class="form-group">
                                    <label>Name</label>
                                </div>
                                 <div class="form-group">
                                     <input type="text" disabled="disabled" value="<?php echo strtoupper(findUsername($_SESSION['uid']));?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                </div>
                                 <div class="form-group">
                                     <input type="text" disabled="disabled" value="<?php echo $_SESSION['email'];?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                </div>
                                <div class="form-group">
                                     <input type="text" disabled="disabled" value="<?php echo $_SESSION['email']; ?>" class="form-control">
                                </div>
                                <?php
                                
                                $sql="select * from student_profile where userid={$_SESSION['uid']}";
                                $sql=$data['CI']->db->query($sql);
                                $sql=$sql->row_array();
                                ?>
                                 <div class="form-group">
                                    <label>Date Of Birth</label>
                                </div>
                                <div class="form-group">
                                     <input disabled="disabled" type="date" name="dob" value="<?php echo $sql['dob'];?>" class="form-control">
                                </div>
                               
                                 <div class="form-group">
                                    <label>Religion</label>
                                </div>
                                <div class="form-group">
                                     <input  disabled="disabled" type="text" name="religion" value="<?php echo $sql['Religion'];?>" class="form-control">
                                </div>
                            
                                 <div class="form-group">
                                    <label>Caste</label>
                                </div>
                                <div class="form-group">
                                     <input disabled="disabled"  type="text" name="caste" value="<?php echo $sql['caste'];?>" class="form-control">
                                </div>
                            
                                 <div class="form-group">
                                    <label>Father Name</label>
                                </div>
                                <div class="form-group">
                                     <input disabled="disabled"  type="text" name="fname" value="<?php echo $sql['father_name'];?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Father's Phone</label>
                                </div>
                                <div class="form-group">
                                     <input  disabled="disabled" type="number" name="fphone" value="<?php echo $sql['father_mobile'];?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                </div>
                                <div class="form-group">
                                    <textarea  disabled="disabled"  class='form-control' name='address'><?php echo $sql['address'];?></textarea>
                                </div>
                               
                            </form>
                            </div></div>
                       <?php 
                        
                        
                    }
                    
              function footerData(){
                  ?>
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
  
    <script src="<?php echo base_url("asset");?>/bower_components/raphael/raphael-min.js"></script>
    <script src="<?php echo base_url("asset");?>/bower_components/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url("asset");?>/js/morris-data.js"></script>
    <?php
              }
    function graphData($data){
        //alert('he');
     //print_r($data);
          ?><script>
                      //window.alert('helll');
    Morris.Donut({
                                                element:'aChart',
                                                data:[
                                                    {label:"Present",value:<?php echo $data['days'];?> },
                                                    {label:"Absent",value:<?php echo $data['remain'];?>}
                                                    
                                                ]
                                            });
                                            </script>
                                            <?php
    }
    
    
    