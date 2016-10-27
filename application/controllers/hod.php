<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class hod extends CI_Controller
{
    
    public function __construct()
       {
           {
            parent::__construct();
            if($this->session->userdata('usertype')<>"hod")
            {
                
                redirect('error/alone');
           
            }
       }
       }
       public function index(){
           $data=array(
               "htmlTitle"=>"Home Page| HOD |",
               "name"=>$this->session->userdata('name')
           );
           $this->load->view('hod/header.php',$data);
            $this->load->view('hod/content.php');
           //echo $this->session->userdata('usertype');
           
       }
       public function editClass(){
           $this->form_validation->set_rules('className','Class Name','trim|required|alpha_dash|max_length[20]|min_length[5]|is_unique[deptclass.className]');
           $classId=  $this->encryption->decrypt($this->input->post('classid'));
           if($this->form_validation->run()){
               $className=  $this->input->post('className');
               $sql="update deptclass set className=? where classid=?";
               $this->db->query($sql,array($className,$classId));
               alert('Saved Successfully'); 
               jsRedirect(base_url('hod/page/manageClass'));
           }else{
               //echo validation_errors();
               alert('Error with Course Name | Please Verify | Class Name must be unique');
               jsRedirect(base_url('hod/page/manageClass?edit=').urlencode($this->input->post('classid')));
           }
       }
       public function logout(){

           $this->session->unset_userdata('usertype','uid','username','name');
           //echo $this->session->userdata('usertype');
           $error=array(
                      'flag'=>0,
                      'message'=>"You Have Successfully Logged Out"
                  );
          $this->load->view('loginpage',$error);
          $this->session->sess_destroy();
}
            public function changepassword(){
        $this->form_validation->set_rules('current','Current Password','trim|required');
        $this->form_validation->set_rules('newpassword','New Password','trim|required|min_length[5]|max_length[15]');
        $this->form_validation->set_rules('confirm','Confirmation','trim|required|min_length[5]|max_length[15]|matches[newpassword]',array(
            'min_length'=>"Password Policy Violation",'max_length'=>"Password Policy Violation"
        ));
        if($this->form_validation->run()==FALSE){
            $this->index();
            
        }
        else
        {
            
                
            
            $this->load->model('LoginModel');
            $data=array(
                'current'=>$this->input->post('current'),
                'newpassword'=>$this->input->post('newpassword'),
                'confirm'=>$this->input->post('confirm')
            );
            if($this->LoginModel->userPasswordChange($data))
            {
                ?><script> alert("Password Changed Successfully");</script><?php
                $this->index();
            }
            else
            {
               ?> <script> alert("Authentication Failed");</script><?php
               $this->index();
            }
              
        
        }
        
    }
    public function changeprofile(){
        $this->form_validation->set_rules('name','Name','trim|required|min_length[7]|max_length[30]|alpha_numeric_spaces');
        $this->form_validation->set_rules('email','Email','trim|required|min_length[5]|max_length[40]|valid_email');
        $this->form_validation->set_rules('phone','Phone Number','trim|required|min_length[10]|max_length[18]');

       
        if($this->form_validation->run()==FALSE){
            $this->index();
            
        }
        else
        {
            
                
            
            $this->load->model('LoginModel');
            $data=array(
                'name'=>$this->input->post('name'),
                'email'=>$this->input->post('email'),
                'phone'=>$this->input->post('phone')
               
            );
            if($this->LoginModel->userProfile($data))
            {
                ?><script> alert("Profile Updated Successfully");</script><?php
                $this->index();
            }
            else
            {
               ?> <script> alert("Internal Error");</script><?php
               $this->index();
            }
              
        
        }
        
    }
    public function test(){
        
    }
    public function createExams(){
        
        $this->form_validation->set_rules('examName','Exam Name','trim|required|max_length[20]|min_length[5]|alpha_dash|is_unique[exams.exam_name]',array('is_unique'=>'An Exam is already present with that name'));
        $this->form_validation->set_rules('maxMark','Maximum Mark','trim|required|numeric|greater_than[1]|less_than[1000]');
        $this->form_validation->set_rules('minMark','Pass Mark','trim|required|numeric|greater_than[0]|less_than[1000]');
        $this->form_validation->set_rules('examDate','Exam Date','trim|required');
        
        $className=$this->session->userdata('classNameId');
        $paperName=$this->session->userdata('paperNameId');
        
        $semester=$this->encryption->decrypt($this->input->post('semester'));
        $course=$this->encryption->decrypt($this->input->post('course'));
        
        if(count($className)>=1 and count($paperName)>=1 and $semester and $course){
           
            if($this->form_validation->run()){
            $exam=array(
                'examName'=>strtoupper($this->input->post('examName')),
                'maxMark'=>$this->input->post('maxMark'),
                'minMark'=>$this->input->post('minMark'),
                'examDate'=>$this->input->post('examDate'),
                'semester'=>$this->input->post('semester'),
                'course'=>$this->input->post('course'),
                
            );
            foreach($className as $cid){
                
                foreach ($paperName as $pid){
                $year=  findAcademicYearByCourseIdSemester($course, $semester);
                //echo var_dump($year);
                if($year){
                    
                
                $sql="INSERT INTO `exams`(`class_id`, `exam_name`, `paper_id`, `course_id`, `semester`, `maxMark`, `minMark`, `examDate`, `author_id`, `state`,`academic_year`,`dept_id`) VALUES ({$cid},'{$exam['examName']}',{$pid},{$course},{$semester},{$exam['maxMark']},{$exam['minMark']},'{$exam['examDate']}',{$_SESSION['uid']},'DECLARED',{$year},{$_SESSION['dept_id']})";
                
                $sql=  $this->db->query($sql);
                if($sql){
                    ?>
                        <script>
                            window.alert("Exam Scheduled Successfully");
                            location.href="<?php echo base_url('/hod/page/createExams');?>";
                            </script>
                            <?php
                }else{
                    echo "<h1>System Error</h1>".show_404();
                }
                }else{
                    ?>
                            <script>
                                window.alert('Exam declaration failed, There is no  Academic year found for this semester and course. Contact Super user for clarity');
                            location.href="<?php echo base_url('/hod/page/createExams');?>";    
                            </script>
                                <?php
                }   
                }
                
//               
                
            }
                
            
                
            }else{
               $data=array(
                'htmlTitle'=>'Create Exams',
                'page'=>'create_exams'
            );
            $this->load->view('hod/header',$data);
            $this->load->view('hod/page');
                
            }
         
            
            
        }else
        {
            
            show_404();
        }

        
    }
  
   
    public function bindCourse(){
        $data=array(
                'htmlTitle'=>'Assign Staff to a Course',
                'page'=>'bind_course'
            );
        $this->form_validation->set_rules('papername','Paper Name','trim|required');
        $this->form_validation->set_rules('className','Class Name','trim|required');
        $this->form_validation->set_rules('course','Semester Paper','trim|required');
       $this->form_validation->set_rules('staff','Staff Name','trim|required');
       if($this->form_validation->run()){
           
           $staffid=$this->encryption->decrypt($this->input->post('staff'));
           $paperid=$this->encryption->decrypt($this->input->post('papername'));
          
           $classid=$this->encryption->decrypt($this->input->post('className'));
           $courseid=$this->encryption->decrypt($this->input->post('course'));
           
           
           
           $semester=findSemesterFromClassDept($classid);
           
           $query="select * from staffpaper where userid=$staffid and paper_id=$paperid and semester=$semester and classid=$classid";
           $result=$this->db->query($query);
           if($result->num_rows()==0){
            $sql="select * from staffpaper where classid={$classid} and paper_id={$paperid}";
           $sql=$this->db->query($sql);
           if($sql->num_rows()==0){
               
           
            $query="INSERT INTO `staffpaper`(`userid`, `dept_id`, `paper_id`, `semester`, `classid`, `course_id`) VALUES ({$staffid},{$_SESSION['dept_id']},{$paperid},{$semester},{$classid},{$courseid})";
            $query=$this->db->simple_query($query);
               ?>
               <script>
                   window.alert("Saved Successfully.");
                   location.href="<?php echo base_url('/hod/page/bindCourse');?>";
                   </script>
                   <?php
           }else{
                ?>
               <script>
                   window.alert("Another staff is already assigned to this paper");
                   location.href="<?php echo base_url('/hod/page/bindCourse');?>";
                   </script>
                   <?php
           }
               
            }else{
               ?>
               <script>
                   window.alert("Same type of data already present in the system...");
                   location.href="<?php echo base_url('/hod/page/bindCourse');?>";
                   </script>
                   <?php
           }
           
       }
        else{
            
        $this->load->view('hod/header',$data);
          $this->load->view('hod/page',$data);
        }
           
       
    }
public function manageBind(){
    
}    
    public function assignStaff(){
        $this->form_validation->set_rules('staffid','Staff Name','trim|required');
        $this->form_validation->set_rules('classid','Class ','trim|required');
       if($this->form_validation->run()==FALSE)
       {
          $data=array(
            "htmlTitle"=>"Assign Staff | HOD | ",
            "page"=>"assign_staff",
            );
          $this->load->view('hod/header',$data);
          $this->load->view('hod/page',$data);
       }
       else
       {
           $classid=$this->encryption->decrypt($this->input->post('classid'));
           $staffid=$this->encryption->decrypt($this->input->post('staffid'));
           if($this->db->query("update deptclass set staffID={$staffid} where classid={$classid}"))
           {
               ?>
               <script>
               window.alert('Class Assigned Successfully');
               location.href="<?php echo base_url("/hod/page/assignStaff");?>";
               </script>
               <?php 
           }
           else
           {
               ?>
               <script>
                   window.alert("Some unknown error occured");
               </script>
               <?php 
           }
           
           $data=array(
            "htmlTitle"=>"Assign Staff | HOD | ",
            "page"=>"assign_staff",
            );
          $this->load->view('hod/header',$data);
          $this->load->view('hod/page',$data);
       }
        
        
    }
    public function addStudent(){
        
    }
    public function page($id=''){
       
        if($this->uri->segment(3)!=NULL)
        {
            
        
        if($id=="createStaff"){
            $data=array(
                'htmlTitle'=>'Create new staff'
            
            );
        $this->load->view('hod/header',$data);
        $info=array(
            'page'=>'create_staff'
        );
        $this->load->view('hod/page',$info);
       
        }
        elseif($id=='mainCourses'){
            $data=array(
                'htmlTitle'=>"Create New Course",
                'page'=>'mainCourses'
            );
            $this->load->view('hod/header',$data);
            $this->load->view('hod/page');
        }
        elseif($id=='viewMarks'){
            $data=array(
                'htmlTitle'=>"View Examination Marks",
                'page'=>'viewMarks'
            );
            $this->load->view('hod/header',$data);
            $this->load->view('hod/page');
        }
        
        elseif($id=='manageUploads'){
            $data=array(
                'htmlTitle'=>"Manage File Uploads",
                'page'=>'manage_uploads'
            );
            $this->load->view('hod/header',$data);
            $this->load->view('hod/page');
        }
        elseif($id=='manageQuestions'){
            $data=array(
                'htmlTitle'=>"Manage Exam Questions",
                'page'=>'manage_questions'
            );
            $this->load->view('hod/header',$data);
            $this->load->view('hod/page');
        }
         elseif($id=='manageAttendance'){
            $data=array(
                'htmlTitle'=>"Manage Attendance",
                'page'=>'manage_attendance'
            );
            $this->load->view('hod/header',$data);
            $this->load->view('hod/page');
        }
        elseif($id=='addStudent'){
            $data=array(
                'htmlTitle'=>"Create new students",
                'page'=>'createStudents'
            );
            $this->load->view('hod/header',$data);
            $this->load->view('hod/page');
        
            
        }
        elseif($id=='createExams'){
            $data=array(
                'htmlTitle'=>'Create Exams',
                'page'=>'create_exams'
            );
            $this->load->view('hod/header',$data);
            $this->load->view('hod/page');
        }
         elseif($id=='manageMailStaff'){
            $data=array(
                'htmlTitle'=>'Send Emails | Staff',
                'page'=>'mail_manage_staff'
            );
            $this->load->view('hod/header',$data);
            $this->load->view('hod/page');
        }
        elseif($id=='manageExams'){
            $data=array(
                'htmlTitle'=>'Manage Exams',
                'page'=>'manage_exams'
            );
            $this->load->view('hod/header',$data);
            $this->load->view('hod/page');
        }
        elseif($id=='bindCourse'){
            $data=array(
                'htmlTitle'=>'Assign Staff to a Course',
                'page'=>'bind_course'
            );
            $this->load->view('hod/header',$data);
            $this->load->view('hod/page',$data);
            
            
        }
        elseif($id=='managePapers'){
            $data=array(
                'htmlTitle'=>'Manage Course Papers',
                'page'=>'manage_papers'
            );
            $this->load->view('hod/header',$data);
            $this->load->view('hod/page',$data);
            
            
        }
        elseif($id=='manageBind'){
            $data=array(
                'htmlTitle'=>'Manage Staff Papers',
                'page'=>'manage_bind'
            );
            $this->load->view('hod/header',$data);
            $this->load->view('hod/page',$data);
            
            
        }
        
        elseif ($id=='manageStaff') {
             $data=array(
                'htmlTitle'=>'Manage Staff'
            
            );
        $this->load->view('hod/header',$data);
        $info=array(
            'page'=>'manage_staff'
        );
        $this->load->view('hod/page',$info);
       
           
            
        
    }
    elseif ($id=='createClass') {
             $data=array(
                'htmlTitle'=>'Create Class'
            
            );
        $this->load->view('hod/header',$data);
        $info=array(
            'page'=>'create_class'
        );
        $this->load->view('hod/page',$info);
       
           
            
        
    }
    elseif ($id=='assignStaff') {
             $data=array(
                'htmlTitle'=>'Assign Staff'
            
            );
        $this->load->view('hod/header',$data);
        $info=array(
            'page'=>'assign_staff'
        );
        $this->load->view('hod/page',$info);
  
        
    }
        elseif ($id=='mailStudents') {
             $data=array(
                'htmlTitle'=>'Mail Students'
            
            );
        $this->load->view('hod/header',$data);
        $info=array(
            'page'=>'mail_students'
        );
        $this->load->view('hod/page',$info);
  
        
    }
    elseif ($id=='createCourses') {
             $data=array(
                'htmlTitle'=>'Create Courses / Papers'
            
            );
        $this->load->view('hod/header',$data);
        $info=array(
            'page'=>'create_courses'
        );
        $this->load->view('hod/page',$info);
       
           
            
        
    }
    elseif ($id=='manageClass') {
             $data=array(
                'htmlTitle'=>'Manage Class'
            
            );
        $this->load->view('hod/header',$data);
        $info=array(
            'page'=>'manage_class'
        );
        $this->load->view('hod/page',$info);
       
           
            
        
    }
    
    
    else
    {
        show_404();
    }
    }
 else {
        show_404();    
    }
    }
    public function manageAttendance(){
        $semester=$this->input->post('semester');
        $course=$this->input->post('course');
        $year=$this->input->post('year');
        $semester=$this->encryption->decrypt($semester);
        $course=$this->encryption->decrypt($course);
        $year=$this->encryption->decrypt($year);
        $totalDays=$this->input->post('totalDays');
        
        if($semester and $course and $year){
        $this->form_validation->set_rules('totalDays','Total Days','trim|required|numeric|less_than[1000]|greater_than[1]');    
        if($this->form_validation->run()){
            $days=$this->input->post('totalDays');
         $sql="delete from attendance where course_id={$course} and semester={$semester} and academic_year={$year}";
         $this->db->query($sql);
         $sql="INSERT INTO `attendance`(`course_id`, `academic_year`, `semester`, `totalDays`) VALUES ({$course},{$year},{$semester},{$days})";
         if($sql=$this->db->query($sql))
         {
             ?>
               <script> window.alert('Attendance Data Saved Successfully');
                   location.href="<?php echo base_url('hod/page/manageAttendance');?>";
                   </script>
                   <?php
         }
         
         
            
        }else{
             $data=array(
                'htmlTitle'=>"Manage Attendance",
                'page'=>'manage_attendance'
            );
            $this->load->view('hod/header',$data);
            $this->load->view('hod/page');
            
        }
        
        
        
        }else{
            show_error('SECURITY EXCEPTION');
        }
    }
    public function manageDocs(){
         $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'zip|gif|jpg|png|JPG|JPEG|PDF|pdf|docx|xls|txt|htm|html|c|cpp|java';
                $config['max_size']             = 80000 ;
                //$config['file_name']='aes';
                //print_r($config);
                $this->form_validation->set_rules('ename','E-Paper Name','trim|required|alpha_numeric_spaces|max_length[150]|min_length[5]');
              //  $this->form_validation->set_rules('ef','E-Paper Name','trim|required|alpha_numeric_spaces|max_length[150]|min_length[5]');
                  if($this->form_validation->run()){
                      
                    
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('efile'))
                {
                        $error = array('error' => $this->upload->display_errors());
                       print_r($error);    
                        
                      ?>
                     <script>window.alert("Upload Failed | Contact Sys Admin");
                     location.href="<?php echo base_url('hod/page/manageDocs');?>";    
                     </script>
                         <?php
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        $ename=$this->input->post('ename');
                        $paper=$this->encryption->decrypt($this->input->post('paper'));
                        $sql="INSERT INTO `epaper`(`ename`, `file_name`, `author_id`,`paper_id`) VALUES ('{$ename}','{$data['upload_data']['file_name']}',{$_SESSION['uid']},$paper)";
                       $this->db->query($sql);
                       
                        
                         
                         
                         
                         
                         ?>
                      <script>window.alert("Upload Success");
                    location.href="<?php echo base_url('hod/page/manageDocs');?>";    
                     </script>
                         <?php
                  }}else{
                      $data=array(
                    'htmlTitle'=>'E-Library',
                    'page'=>'manage_docs'
                );
                $this->load->view('hod/header',$data);
                $this->load->view('hod/page');
                
                  }
                  
    }
    public function manageUploads(){
         $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png|JPG|JPEG|PDF|pdf|docx|xls|txt|htm|html|c|cpp|java';
                $config['max_size']             = 80000 ;
                $config['file_name']='aes';
                //print_r($config);

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('files'))
                {
                        $error = array('error' => $this->upload->display_errors());
                       // print_r($error);    
                        
                      ?>
                     <script>window.alert("Upload Failed | Contact Sys Admin");
                     location.href="<?php echo base_url('hod/page/manageUploads');?>";    
                     </script>
                         <?php
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        
                       $sql="INSERT INTO `email_files`(`file_name`, `author_id`, `active`) VALUES ('{$data['upload_data']['file_name']}',{$_SESSION['uid']},1)";
                       $this->db->query($sql);
                       
                        
                         
                         
                         
                         
                         ?>
                      <script>window.alert("Upload Success");
                    location.href="<?php echo base_url('hod/page/manageUploads');?>";    
                     </script>
                         <?php
                }
    }
    public function mailStudents(){
$classId=$this->encryption->decrypt($this->input->post('class'));
$classInfo=  findAllInfoAboutClass($classId);
$sql="select * from users where userid IN(";
$sql.="select userid from student_ac_meta where course_id=";
$sql.="(select course_id from deptclass where semester={$classInfo[3]} and batch={$classInfo[1]} and classid={$classInfo[0]})";
$sql.="and admn_year=";
$sql.="(select academic_year from semester_logs where course_id={$classInfo[7]} and semester={$classInfo[3]})) and active=1 order by name";

$sql=$this->db->query($sql);


         $email='';
         foreach ($sql->result_array() as $row){
             $email.=$row['email'].',';
         }
        
        $email=str_split($email);
        array_pop($email);
       // print_r($email);
        $bccEmail='';
        foreach($email as $val){
            $bccEmail.=$val;
        }
     //   echo $bccEmail;
        $this->form_validation->set_rules('subject','Email Subject','required|max_length[50]|min_length[3]',array('min_length'=>'Email Subject should contain atleast 5 characters'));
        $this->form_validation->set_rules('body','Email Message','required|max_length[4000]|min_length[20]',array('min_length'=>'Email Message should contain atleast 20 characters'));
       
        if($this->form_validation->run()){
            
            
          $subject=  $this->input->post('subject');
          $body=$this->input->post('body');
          
            $this->load->library('email'); // load email library
            $this->email->from('aes@mac.edu.in', 'AES, Campus Cloud');
            $this->email->to('aes@mac.edu.in');
            $this->email->bcc($bccEmail);
            $subject.='|AES|Campus Cloud';
            $this->email->subject($subject);
            $this->email->message($body);
            
            if($this->email->send()){
                
            
          
          ?><script>
              window.alert("Email sent");
          location.href="<?php echo base_url('/hod/page/mailStudents');?>";
              </script>
              <?php
        }else{
        
            echo show_error($message='Error Establishing Secure connection with Remote Host');
        }
        }else{
             $data=array(
                'htmlTitle'=>'Send Emails | Students',
                'page'=>'mail_students'
            );
            $this->load->view('hod/header',$data);
            $this->load->view('hod/page');
        }
    }
    public function manageMailStaff(){
        $userid=$_SESSION['temp_data'];
         $email='';
        foreach ($userid as $id=>$value){
            $userid[$id]=$this->encryption->decrypt($value);
            if(!$userid[$id]){
                die(show_error());
            }
           
            $email.=  findMailFromUserId($userid[$id]).",";
            
        }
        $email=str_split($email);
        array_pop($email);
       // print_r($email);
        $bccEmail='';
        foreach($email as $val){
            $bccEmail.=$val;
        }
        //echo $bccEmail;
        $this->form_validation->set_rules('subject','Email Subject','required|max_length[50]|min_length[3]',array('min_length'=>'Email Subject should contain atleast 5 characters'));
        $this->form_validation->set_rules('body','Email Message','required|max_length[4000]|min_length[20]',array('min_length'=>'Email Message should contain atleast 20 characters'));
       
        if($this->form_validation->run()){
            
            
          $subject=  $this->input->post('subject');
          $body=$this->input->post('body');
          
            $this->load->library('email'); // load email library
            $this->email->from('aes@mac.edu.in', 'AES, Campus Cloud');
            $this->email->to('aes@mac.edu.in');
            $this->email->bcc($bccEmail);
            $subject.='|AES|Campus Cloud';
            $this->email->subject($subject);
            
            $this->email->message($body);
            
            if($this->email->send()){
                
            
          
          ?><script>
              window.alert("Email sent");
              location.href="<?php echo base_url('/hod/page/manageMailStaff');?>";
              </script>
              <?php
        }else{
        
            echo show_error($message='Error Establishing Secure connection with Remote Host');
        }
        }else{
             $data=array(
                'htmlTitle'=>'Send Emails | Staff',
                'page'=>'mail_manage_staff'
            );
            $this->load->view('hod/header',$data);
            $this->load->view('hod/page');
        }
    }
    public function createStaff()
   {
                $error_email=array(
            'is_unique'=>'Email address is already found in our system, use any other'
        );
                 $error_phone=array(
            'is_unique'=>'Phone Number is already found in our system,use any other'
        );
       $this->form_validation->set_rules('name','Name','trim|required|max_length[50]|min_length[5]');
       $this->form_validation->set_rules('email','Email','trim|required|is_unique[users.email]|valid_email',$error_email);
       $this->form_validation->set_rules('phone','Phone','trim|required|is_unique[users.phone]|numeric|min_length[10]|max_length[15]',$error_phone);
       $this->form_validation->set_rules('username','Username','trim|required|is_unique[users.username]|alpha_numeric|min_length[5]|max_length[10]');
       if($this->form_validation->run()==FALSE)
       {
           $data=array(
            "htmlTitle"=>"Create New Staff | HOD | ",
            "page"=>"create_staff",
            "pagehead"=>"Create New Staff"
       
        );

        $this->load->view($this->uri->segment(1).'/header',$data);
        $this->load->view($this->uri->segment(1).'/page',$data);
       }
        else {
         extract($this->input->post());
         $password=md5("password@123");
        $query="INSERT INTO `users`(`username`, `password`, `active`, `user_type`, `name`, `email`, `phone`) VALUES ('{$username}','{$password}',1,'staff','{$name}','{$email}','{$phone}')";
        
        //echo $query;
        
        if($this->db->query($query))
        {
            $query="select userid from users where username='{$this->input->post('username')}'";
            $query=$this->db->query($query);
            foreach ($query->result_array() as $row){
                $userid=$row['userid'];
            }
            $query="insert into staffdept values({$userid},{$_SESSION['dept_id']})";
            $this->db->query($query);
            ?><script>alert("Staff Created Successfully");</script><?php 
           $data=array(
            "htmlTitle"=>"Create New staff | HOD | ",
            "page"=>"create_staff",
            "pagehead"=>"Create New Staff"
       
        );

            $this->load->view($this->uri->segment(1).'/header',$data);
        $this->load->view($this->uri->segment(1).'/page',$data);
           
        
        
        
        }
        
        }
       
      
    }
    public function createClass(){
         $data=array(
            "htmlTitle"=>"Create New Class | HOD | ",
            "page"=>"create_class",
            "pagehead"=>"Create New Class"
       
        );
         $course=$this->encryption->decrypt($this->input->post('course'));
        $GLOBALS['course_class_sem']=$course;
         $this->form_validation->set_rules('classname','Class Name','trim|required|is_unique[deptclass.className]|max_length[8]|min_length[3]|alpha_dash',array('is_unique'=>'A Class Name with this name is already found in our system. Please use any other!'));
      
        $this->form_validation->set_rules('semester','Semester',array(
           'trim',
           'required',
           'numeric',
           'greater_than_equal_to[1]',
           array(
               'check_semester',
               function($value){
                   $course=$GLOBALS['course_class_sem'];
                   $sql="select * from courses where id={$course}";
            $sql=$this->db->query($sql);
            $row=$sql->row_array();
            
                    if($value>$row['semesters']){   
                        return FALSE;
                    }else
                    {
                        return TRUE;
                    }
               }
           )
       ),array(
           'check_semester'=>"Semester value should be less than course's max semester"
       ));
        
        if(is_numeric($course))
        {
            
        
        if($this->form_validation->run()==FALSE)
        {
            $this->load->view('hod/header',$data);
             $this->load->view('hod/page',$data);
            
        }
        else
        {
             $semester=$this->input->post('semester');
             $batches=$this->encryption->decrypt($this->input->post('batches'));
            $sql="select * from deptclass where semester={$semester} and batch={$batches} and course_id={$course}";
            
            $sql=  $this->db->query($sql);
            if($sql->num_rows()>0){
                ?>
            <script>
                window.alert("Failed! Possible Reason : A Class Found with same semester and batch information");
                location.href="<?php echo base_url('hod/page/createClass');?>";
                </script>
                <?php  
                
            }else{
                   
            
            
            ?>
            <script>
                window.alert("Class Created Successfully");
                </script>
                <?php 
            $dept=$this->session->userdata('dept_id');
            $className=strtoupper($this->input->post('classname'));
           
            $this->db->query("insert into deptclass(className,semester,active,dept_id,course_id,batch) values('{$className}','{$semester}',1,{$dept},{$course},{$batches})");
           
            $this->load->view('hod/header',$data);
            $this->load->view('hod/page',$data);
        }
        }
        }
        else
        {
            show_error();
        }
    }
    public function createCourses(){
        $sem=$this->encryption->decrypt($this->input->post('semester'));
       // echo $_POST['course'];
        $id=$this->encryption->decrypt(urldecode($this->input->post('course')));
        
        $this->form_validation->set_rules('papername','Paper Name','trim|required|min_length[5]|max_length[30]|alpha_numeric_spaces|is_unique[papers.paper_name]');
        $this->form_validation->set_rules('papercode','Paper Code','trim|required|min_length[3]|max_length[60]|alpha_numeric|is_unique[papers.paper_code]');
        if(is_numeric($sem)){
        if($this->form_validation->run())
        {
            $papername=  strtoupper($this->input->post('papername'));
            $papercode=strtoupper($this->input->post('papercode'));
            
            $query="insert into papers (semester,dept_code,paper_name,paper_code,course_id)values(?,?,?,?,?)";
            $query=$this->db->query($query,array($sem,$_SESSION['dept_id'],$papername,$papercode,$id,));
            ?>
                <script>
                    window.alert("Courses updated successfully");
                    </script>
            <?php 
               $data=array(
                'htmlTitle'=>'Create Courses / Papers'
            
            );
        $this->load->view('hod/header',$data);
        $info=array(
            'page'=>'create_courses'
        );
        $this->load->view('hod/page',$info);
        
        }
        else
        {            
             $data=array(
                'htmlTitle'=>'Create Courses / Papers'
            
            );
        $this->load->view('hod/header',$data);
        $info=array(
            'page'=>'create_courses'
        );
        $this->load->view('hod/page',$info);
        }
        }
        else
        {
            show_error();
        }
    }
    
    
}
