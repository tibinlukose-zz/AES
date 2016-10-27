<?php

/* 
 * License under Pirates of mac Valley.
 * Developed by Navas, Sriram and Tibin  * 
 */
class Staff extends CI_Controller{
    
    public function __construct()
       {
           {
            parent::__construct();
            if($this->session->userdata('usertype')<>"staff")
            {
                
                redirect('error/alone');
           
            }
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
}
 public function mailStudents(){
$classId=$this->encryption->decrypt($this->input->post('class'));
if($classId){
    

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
          location.href="<?php echo base_url('/staff/page/mailStudents');?>";
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
            $this->load->view('staff/header',$data);
            $this->load->view('staff/page');
        }
    }else{
        show_error('Something wrong had happened  .:..:..:..:..:. Goto mailStudents page again.'); 
    }
 }
      public function upMark(){
        
         
        $exam_id=$this->input->post('exam_id');
       
        $aca_year=$this->input->post('aca_year');
        $markArray=$this->input->post('mark');
       $idArray=$this->input->post('sId');
       $exam_id=$this->encryption->decrypt($exam_id);
       $aca_year=$this->encryption->decrypt($aca_year);
       $maxMark=findAllInfoAboutExam($exam_id);
        $maxMark=$maxMark[6];
       foreach ($markArray as $key=>$value){
           if($value==NULL){
            $markArray[$key]=0;  
           }
           if($value>$maxMark){
               die(show_error($message='Mark range Erro'));
           }
           
          
       }
       foreach ($idArray as $key=>$value){
           
        if($this->encryption->decrypt($value)){
            $idArray[$key]=$this->encryption->decrypt($value);
        }else{
            die(show_error($message='Error Decrypting Student IDs, XSS DETECTED BY PIRATES OF MAC VALLEY'));
            break;
        }
           
       }
       
       if($this->input->post('markAction')=='update'){
           $sql="delete from exam_marks where exam_id={$exam_id} and aca_year={$aca_year}";
           $this->db->query($sql);
       }
       //print_r($markArray);
       if($exam_id and $aca_year){
           foreach ($idArray as $key=>$value){
$sql="INSERT INTO `exam_marks`(`exam_id`, `userid`, `mark`, `aca_year`) VALUES ({$exam_id},'{$idArray[$key]}',{$markArray[$key]},{$aca_year})";
$this->db->query($sql);
?><script>
    window.alert("Mark Updated Successfully");
    location.href="<?php echo base_url('staff/page/upMark');?>";
    </script>
    <?php

}           

           
            
           
           
           
           
           
           
       }else{
           show_404();
       }
     
       
       
      }
    
    //}
       public function manageAttendance(){
        
        $atnId=$this->encryption->decrypt($this->input->post('atnId'));
       $sql="select * from attendance where attn_id={$atnId}";
       $sql=  $this->db->query($sql);
       $sql=$sql->row_array();
      
        
        $daysArray=$this->input->post('days');
       $idArray=$this->input->post('sId');
       
      
       foreach ($daysArray as $key=>$value){
           if($value==NULL){
            $daysArray[$key]=0;  
           }
           if($value>$sql['totalDays']){
               die(show_error($message='Mark range Error'));
           }
           
          
       }
       foreach ($idArray as $key=>$value){
           
        if($this->encryption->decrypt($value)){
            $idArray[$key]=$this->encryption->decrypt($value);
        }else{
            die(show_error($message='Error Decrypting Student IDs, XSS DETECTED BY PIRATES OF MAC VALLEY'));
            break;
        }
           
       }
       //($idArray);
       
       if($this->input->post('type')=='update'){
           $sql="delete from attn_data where attn_id={$atnId}";
           //echo $sql;
           $this->db->query($sql);
       }
       //print_r($markArray);
       if($atnId){
           foreach ($idArray as $key=>$value){
$sql="INSERT INTO `attn_data`(`attn_id`, `userid`, `days`) VALUES ({$atnId},'{$idArray[$key]}',{$daysArray[$key]})";
$this->db->query($sql);
?><script>
    window.alert("Attendance Updated Successfully");
    location.href="<?php echo base_url('staff/page/manageAttendance');?>";
    </script>
    <?php

}           

           
            
           
           
           
           
           
           
       }else{
           show_404();
       }
     
       
       
      }
    public function index(){
         $data=array(
               "htmlTitle"=>"Home Page | Staff | AES |",
               "name"=>$this->session->userdata('name')
           );
           $this->load->view('staff/header.php',$data);
            $this->load->view('staff/content.php');
           //echo $this->session->userdata('usertype');
           
       }
         public function changepassword(){
        $this->form_validation->set_rules('current','Current Password','required');
        $this->form_validation->set_rules('newpassword','New Password','required|min_length[5]|max_length[15]');
        $this->form_validation->set_rules('confirm','Confirmation','required|min_length[5]|max_length[15]|matches[newpassword]',array(
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
    
    public function page($id=''){
        switch ($id){
            case 'myPapers':
                $data=array(
                    'htmlTitle'=>'My Papers',
                    'page'=>'my_papers'
                );
                $this->load->view('staff/header',$data);
                $this->load->view('staff/page');
                break;
            case 'manageAttendance':
                $data=array(
                    'htmlTitle'=>'Manage Attendance',
                    'page'=>'manage_attendance'
                );
                $this->load->view('staff/header',$data);
                $this->load->view('staff/page');
                break;
            case 'manageDocs':
                $data=array(
                    'htmlTitle'=>'E-Library',
                    'page'=>'manage_docs'
                );
                $this->load->view('staff/header',$data);
                $this->load->view('staff/page');
                break;
            case 'manageQuestions':
                $data=array(
                    'htmlTitle'=>'Question Papers',
                    'page'=>'manage_questions'
                );
                $this->load->view('staff/header',$data);
                $this->load->view('staff/page');
                break;
            case 'generateMarks':
                $data=array(
                    'htmlTitle'=>'My Papers',
                    'page'=>'generate_marks'
                );
                $this->load->view('staff/header',$data);
                $this->load->view('staff/page');
                break;
            case 'viewMarks':
                $data=array(
                    'htmlTitle'=>'View Exam Marks',
                    'page'=>'view_marks'
                );
                $this->load->view('staff/header',$data);
                $this->load->view('staff/page');
                break;
            case 'mailStudents':
                $data=array(
                    'htmlTitle'=>'Mail Students',
                    'page'=>'mail_students'
                );
                $this->load->view('staff/header',$data);
                $this->load->view('staff/page');
                break;
            case 'manageFiles':
                $data=array(
                    'htmlTitle'=>'Manage Files',
                    'page'=>'manage_files'
                );
                $this->load->view('staff/header',$data);
                $this->load->view('staff/page');
                break;
            case 'myExams':
                $data=array(
                    'htmlTitle'=>'Manage Exams',
                    'page'=>'my_exams'
                );
                $this->load->view('staff/header',$data);
                $this->load->view('staff/page');
                break;
            case 'classTeacher':
                $data=array(
                    'htmlTitle'=>'Class Teacher',
                    'page'=>'class_teacher'
                );
                $this->load->view('staff/header',$data);
                $this->load->view('staff/page');
                break;
            case 'createExams':
                $data=array(
                    'htmlTitle'=>'Create Exam',
                    'page'=>'create_exam'
                );
                $this->load->view('staff/header',$data);
                $this->load->view('staff/page');
                break;
            case 'upMark':
                $data=array(
                    'htmlTitle'=>'Upload Mark',
                    'page'=>'up_mark'
                );
                $this->load->view('staff/header',$data);
                $this->load->view('staff/page');
                break;
            case 'viewStudent':
                $data=array(
                    'htmlTitle'=>'View Students',
                    'page'=>'view_student'
                );
                $this->load->view('staff/header',$data);
                $this->load->view('staff/page');
                break;
            default:show_404($msg='error    ');
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
                     location.href="<?php echo base_url('staff/page/manageDocs');?>";    
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
                    location.href="<?php echo base_url('staff/page/manageDocs');?>";    
                     </script>
                         <?php
                  }}else{
                      $data=array(
                    'htmlTitle'=>'E-Library',
                    'page'=>'manage_docs'
                );
                $this->load->view('staff/header',$data);
                $this->load->view('staff/page');
                
                  }
                  
    }
    public function manageQuestions(){
         $config['upload_path']          = './Questions/';
                $config['allowed_types']        = 'zip|gif|jpg|png|JPG|JPEG|PDF|pdf|docx|xls|txt|htm|html|c|cpp|java';
                $config['max_size']             = 80000 ;
                //$config['file_name']='aes';
                //print_r($config);
                $paper=$this->encryption->decrypt($this->input->post('paper'));
                 $exam=$this->encryption->decrypt($this->input->post('exam'));
                if($paper and $exam){
                    
                
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
                     location.href="<?php echo base_url('staff/page/manageQuestions');?>";    
                     </script>
                         <?php
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        $ename=$this->input->post('ename');
                        $paper=$this->encryption->decrypt($this->input->post('paper'));
                        
                        $sql="INSERT INTO `question_papers`(`exam_id`, `question_name`, `author_id`,`file_name`,`paper_id`) VALUES ({$exam},'{$ename}',{$_SESSION['uid']},'{$data['upload_data']['file_name']}',{$paper})";
                        
                       $this->db->query($sql);
                       
                        
                         
                         
                         
                         
                         ?>
                      <script>window.alert("Upload Success");
                    location.href="<?php echo base_url('staff/page/manageQuestions');?>";    
                     </script>
                         <?php
                  }}else{
                      $data=array(
                    'htmlTitle'=>'Manage Question Papers',
                    'page'=>'manage_questions'
                );
                $this->load->view('staff/header',$data);
                $this->load->view('staff/page');
                
                  }
                }else{
                    show_error('SECURITY EXCEPTION');
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
                     location.href="<?php echo base_url('staff/page/manageFiles');?>";    
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
                    location.href="<?php echo base_url('staff/page/manageFiles');?>";    
                     </script>
                         <?php
                }
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
        

           
            if($this->form_validation->run()){
            $exam=array(
                'examName'=>strtoupper($this->input->post('examName')),
                'maxMark'=>$this->input->post('maxMark'),
                'minMark'=>$this->input->post('minMark'),
                'examDate'=>$this->input->post('examDate'),
                'semester'=>$this->input->post('semester'),
                'course'=>$this->input->post('course'),
                
            );
            $year=  findAcademicYearByCourseIdSemester($course, $semester);
            if($year){
                
                //print_r($_SESSION);
$sql="INSERT INTO `exams`(`class_id`, `exam_name`, `paper_id`, `course_id`, `semester`, `maxMark`, `minMark`, `examDate`, `author_id`, `state`,`academic_year`,`dept_id`) VALUES ({$className},'{$exam['examName']}',{$paperName},{$course},{$semester},{$exam['maxMark']},{$exam['minMark']},'{$exam['examDate']}',{$_SESSION['uid']},'DECLARED',{$year},{$_SESSION['dept_id']})";
$this->db->query($sql);
?><Script>
    window.alert('Exam Created Successfully');
    location.href="<?php echo base_url('staff');?>";
    </script>
    <?php

                
                
            }else{
                show_error($message='No Academic Year found for this semester and course! Please verify or contact Super User');
                
            }
        }
        
    }
}


