<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Office extends CI_Controller
{
    
    public function __construct()
       {
           {
            parent::__construct();
            if($this->session->userdata('usertype')<>"office")
            {
                
                redirect('error/alone');
           
            }
       }
       }
       
       public function index(){
           $data=array(
               "pageTitle"=>"Home Page| OFFICE  |",
               "name"=>$this->session->userdata('name')
           );
           $this->load->view('office/header.php',$data);
            $this->load->view('office/content.php');
           //echo $this->session->userdata('usertype');
           
       }
        public function changeprofile(){
        $this->form_validation->set_rules('name','Name','required|min_length[7]|max_length[30]');
        $this->form_validation->set_rules('email','Email','required|min_length[5]|max_length[40]|valid_email');
        $this->form_validation->set_rules('phone','Phone Number','required|min_length[10]|max_length[18]');

       
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
    
       public function updateProfile(){
        $useridOriginal=  $this->encryption->decrypt($this->input->post('userid'));
        if($useridOriginal){
            $this->form_validation->set_rules('email','Email','trim|required|valid_email');
             $this->form_validation->set_rules('phone','Phone','trim|required|numeric');
               $this->form_validation->set_rules('dob','Date Of Birth','required');
                 $this->form_validation->set_rules('religion','Religion','trim|required|alpha');
                   $this->form_validation->set_rules('caste','caste','trim|required|alpha');
                     $this->form_validation->set_rules('fname','Fathers Name','trim|required|alpha');
                       $this->form_validation->set_rules('fphone','Fathers Phone','trim|required|numeric');
  $this->form_validation->set_rules('address','Address','trim|required|min_length[5]|max_length[1000]');
  if($this->form_validation->run()){
      extract($this->input->post());
      $sql="delete from student_profile where userid={$useridOriginal}";
      $this->db->query($sql);
      $sql="INSERT INTO `student_profile`(`userid`, `dob`, `Religion`, `caste`, `father_name`, `father_mobile`, `address`) VALUES ({$useridOriginal},'{$dob}','{$religion}','{$caste}','{$fname}',{$fphone},'{$address}')";
      $sql=  $this->db->query($sql);
       
     ?>
     
               <script>
                   
                   window.alert('Data Saved Successfully');
                   location.href="<?php echo base_url('office/page/manageStudent');?>";
                   </script>
                   <?php
      
  }else{
     //echo validation_errors();
     
     ?>
     
               <script>
                   
                   window.alert('ERROR');
                   location.href="<?php echo base_url('office/page/manageStudent?edit='.urlencode($this->input->post('userid')));?>";
                   </script>
                   <?php
  
      
  }
            
            
            
            
        }else{
            show_error();
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
    public function addStudent(){
        $course=$this->encryption->decrypt($this->input->post('course'));
        $admnyear=$this->encryption->decrypt($this->input->post('admnyear'));
        $batch=$this->encryption->decrypt($this->input->post('batch'));
        //echo $admnyear;
        if($course and $admnyear and $batch){
           $this->form_validation->set_rules('name','Name','trim|required|alpha_numeric_spaces|min_length[5]|max_length[30]');
           $this->form_validation->set_rules('email','Email','valid_email|is_unique[users.email]',array('is_unique'=>'This Email address is already found in the system'));
            $this->form_validation->set_rules('phone','phone','trim|required|numeric|min_length[8]|max_length[18]|is_unique[users.phone]',array('is_unique'=>'This phone number is already found in the system'));
          // $this->form_validation->set_rules('admno','Admission Number','trim|required|numeric');
           $this->form_validation->set_rules('admno','Admission Number','trim|required|numeric|is_unique[users.username]',array('is_unique'=>'A Student with this username is already present in the System'));
           
           if($this->form_validation->run()){
              
               $name=$this->input->post('name');
               $email=$this->input->post('email');
               $phone=$this->input->post('phone');
               $password=md5($phone);
               $username=$this->input->post('admno');
              // $sql="insert into users('username','password','user_type','name','email','phone') values('{$username}','{$password}','student','{$name}','{$name}',{$phone})";
               $sql="INSERT INTO `users`(`active`, `username`, `password`,`user_type`, `name`, `email`, `phone`) VALUES (?,?,?,?,?,?,?)";
               $sql=$this->db->query($sql,array(1,$username,$password,'student',$name,$email,$phone));
               $sql="select userid from users where username='{$username}'";
               $sql=  $this->db->query($sql);
               $userId=$sql->row_array();
               $sql="INSERT INTO `student_ac_meta`(`userid`, `admn_year`, `course_id`, `batch`, `admn_no`) VALUES (?,?,?,?,?)";
               $sql=$this->db->query($sql,array($userId['userid'],$admnyear,$course,$batch,$username));
                ?><script>
                   window.alert('Student Data Saved Successfully');
                   location.href="<?php echo base_url('office/page/addStudent');?>";
               </script>
                   
                   <?php
           }
           else
           {
               $data=array(
                   'pageTitle'=>'Add New Student',
                   'page'=>'addStudent'
               );
               $this->load->view('office/header',$data);
               $this->load->view('office/page',$data);
               
               
                
           }
        }
        else
        {
            show_error();
        }
        
    }
    public function easyForm(){
        $course=$this->encryption->decrypt($this->input->post('course'));
        $admnyear=$this->encryption->decrypt($this->input->post('admnyear'));
        $batch=$this->encryption->decrypt($this->input->post('batch'));
        if($course and $admnyear and $batch){
            
            delete_cookie('course');
            delete_cookie('admnyear');
            delete_cookie('batch');
                
            
            $data=array(
                'name'=>'course',
                'value'=>$this->input->post('course'),
                'httponly'=>TRUE,
                'expire'=>0
                
            );
            set_cookie($data);    
            $data=array(
                'name'=>'admnyear',
                'value'=>$this->input->post('admnyear'),
                'httponly'=>TRUE,
                'expire'=>0
                
            );
            set_cookie($data); 
            $data=array(
                'name'=>'batch',
                'value'=>$this->input->post('batch'),
                'httponly'=>TRUE,
                'expire'=>0
                
            );
            set_cookie($data); 
           
        redirect(base_url('office/page/addStudent'));
        }
 else {
            show_error();
 }
        
    }
    public function page($id=""){
        switch ($id){
            case "addStudent":{
                $data=array(
                    'pageTitle'=>'Add Student',
                    'page'=>'addStudent'
                );
               $this->load->view('office/header',$data);
                 $this->load->view('office/page');
                
        }break;
            
    
            case "manageStudent":{
             $data=array(
                    'pageTitle'=>'Manage Student',
                    'page'=>'manage_student'
                );
               $this->load->view('office/header',$data);
                 $this->load->view('office/page');
            }break;
        case "viewExamMark":{
             $data=array(
                    'pageTitle'=>'View Exam Marks',
                    'page'=>'view_marks'
                );
               $this->load->view('office/header',$data);
                 $this->load->view('office/page');
            }break;
        case "getAppnForm":{
             $data=array(
                    'pageTitle'=>'Application Form',
                    'page'=>'getAppnForm'
                );
               $this->load->view('office/getAppnForm');
            }break;
        
        case "viewApplications":{
             $data=array(
                    'pageTitle'=>'View Applications',
                    'page'=>'viewApplications'
                );
               $this->load->view('office/header',$data);
                 $this->load->view('office/page');
            }break;
         case "viewAttendance":{
             $data=array(
                    'pageTitle'=>'View Attendance',
                    'page'=>'viewAttendance'
                );
               $this->load->view('office/header',$data);
                 $this->load->view('office/page');
            }break;
        case "updateAttendance":{
             $data=array(
                    'pageTitle'=>'Update Attendance',
                    'page'=>'updateAttendance'
                );
               $this->load->view('office/header',$data);
                 $this->load->view('office/page');
            }break;
         case "newApplication":{
             $data=array(
                    'pageTitle'=>'New Application',
                    'page'=>'newApplication'
                );
               $this->load->view('office/header',$data);
                 $this->load->view('office/page');
            }break;
        case "printApplication":{
             $data=array(
                    'pageTitle'=>'Print Application',
                    'page'=>'printApplication'
                );
               $this->load->view('office/header',$data);
                 $this->load->view('office/page');
            }break;
        case "editApplication":{
             $data=array(
                    'pageTitle'=>'Edit Application',
                    'page'=>'editApplication'
                );
               $this->load->view('office/header',$data);
                 $this->load->view('office/page');
            }break;
        }
    }
     public function editApplication(){
         if($this->input->post('currentAppNo')){
             
         $rules=array(
         
          array(
             'field'=>'residential',
             'label'=>'Residential Status',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
          array(
             'field'=>'classNo',
             'label'=>'Class Number',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
          array(
             'field'=>'vehicle',
             'label'=>'Vehicle Type',
             'rules'=>'trim'
         ),
          array(
             'field'=>'vehicleNo',
             'label'=>'Vehicle Number',
             'rules'=>'trim'
         ),
          array(
             'field'=>'extra1',
             'label'=>'Extra Curricular1',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
          array(
             'field'=>'extra2',
             'label'=>'Extra Curricular 2',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
          array(
             'field'=>'rel1',
             'label'=>'Relation Ship 1',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
         array(
             'field'=>'rel2',
             'label'=>'Relation Ship 2',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
         array(
             'field'=>'rel3',
             'label'=>'Relation Ship 3',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
         array(
             'field'=>'rel1Job',
             'label'=>'Relation Ship 1 Job',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
          array(
             'field'=>'rel2Job',
             'label'=>'Relation Ship 2 Job',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
          array(
             'field'=>'rel3Job',
             'label'=>'Relation Ship 3 Job',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
         array(
             'field'=>'name',
             'label'=>'Student Name',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'courses',
             'label'=>'Courses',
             'rules'=>'trim|required'
         ),
         array(
             'field'=>'plus2group',
             'label'=>'Plus Two Group',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'tenBoard',
             'label'=>'Ten Board',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'recNeed',
             'label'=>'Recognition Needed',
             'rules'=>'trim|required'
         ),
         array(
             'field'=>'gender',
             'label'=>'Gender',
             'rules'=>'required'
         ),
         array(
             'field'=>'admnCat',
             'label'=>'Admission Category',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'aIncome',
             'label'=>'Annual Income',
             'rules'=>'trim|required|numeric'
         ),
         array(
             'field'=>'stMobile',
             'label'=>'Student Mobile',
             'rules'=>'trim|required|numeric'
         ),
         array(
             'field'=>'ptMobile',
             'label'=>'Parent Mobile',
             'rules'=>'trim|required|numeric'
         ),
         array(
             'field'=>'religion',
             'label'=>'Religion',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'category',
             'label'=>'Category',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'fname',
             'label'=>'Fathers Name',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'fOccu',
             'label'=>'Fathers Occupation',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'mname',
             'label'=>'Mothers Name',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'mOccu',
             'label'=>'Mothers Occupation',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'padr1',
             'label'=>'Permanent Address Name Line 1',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'padr2',
             'label'=>'Permanent Address Name Line 2',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'padr3',
             'label'=>'Permanent Address Name Line 3',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'padr4',
             'label'=>'Permanent Address Name Line 4',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'ppin',
             'label'=>'Permanent PIN',
             'rules'=>'trim|required|numeric'
         ),
         array(
             'field'=>'cadr1',
             'label'=>'Communication Address',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'cadr2',
             'label'=>'Communication Address Name Line 2',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'cadr3',
             'label'=>'Communication Address Name Line 3',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'cadr4',
             'label'=>'Communication Address Name Line 4',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'blood',
             'label'=>'Blood Group',
             'rules'=>'trim|required'
         ),
          array(
             'field'=>'plus2mark',
             'label'=>'Plus 2 Mark',
             'rules'=>'trim|required'
         ),
         array(
             'field'=>'cpin',
             'label'=>'Communication PIN',
             'rules'=>'trim|required|numeric'
         ),
         array(
             'field'=>'tenRoll',
             'label'=>'Ten Roll No',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'tenYear',
             'label'=>'Ten Year',
             'rules'=>'trim|required|numeric'
         ),
         array(
             'field'=>'tenSchool',
             'label'=>'Ten School Name',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'plus2roll',
             'label'=>'Plus 2 Roll',
             'rules'=>'trim|required'
         ),
         array(
             'field'=>'twoMonth',
             'label'=>'Plus 2 Month',
             'rules'=>'trim|required|alpha'
         ),
         array(
             'field'=>'twoYear',
             'label'=>'Plus Two Year',
             'rules'=>'trim|required|numeric'
         ),
         array(
             'field'=>'twoExamName',
             'label'=>'Plus Two Exam Name',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'twoSchoolName',
             'label'=>'Plus Two School Name',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'twoBoardName',
             'label'=>'Plus 2 Board Name',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
             array(
             'field'=>'guardian',
             'label'=>'Local Guardian',
             'rules'=>'trim'
         ),
        array(
             'field'=>'tcno',
             'label'=>'TC No',
             'rules'=>'trim|required'
         ),
         array(
             'field'=>'tcdate',
             'label'=>'TC DATE',
             'rules'=>'trim|required'
         ),
         array(
             'field'=>'tcname',
             'label'=>'TC Instition Name',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'chalan',
             'label'=>'Chalan Number',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
         array(
             'field'=>'chlndate',
             'label'=>'Chalan Date',
             'rules'=>'trim'
             
         ),
         array(
             'field'=>'chlnbranch',
             'label'=>'Bank Branch',
             'rules'=>'trim|alpha_numeric_spaces'
         )
         
         
     );
   
    
     
     $this->form_validation->set_rules($rules);
     if($this->form_validation->run()){
       
        extract($_POST);
        
            
       // print_r($_POST);
        
      $sql="UPDATE `admission` SET `name`='{$name}',`courses`='{$courses}',`plus2group`='{$plus2group}',`recNeed`='{$recNeed}',`gender`='{$gender}',`dob`='{$dob}',`admCat`='{$admnCat}',`aIncome`='{$aIncome}',`stMobile`='{$stMobile}',`ptMobile`='{$ptMobile}',`religion`='{$religion}',`category`='{$category}',`fname`='{$fname}',`mname`='{$mname}',`fOccu`='{$fOccu}',`mOccu`='{$mOccu}',`padr1`='{$padr1}',`padr2`='{$padr2}',`padr3`='{$padr3}',`padr4`='{$padr4}',`ppin`='{$ppin}',`cadr1`='{$cadr1}',`cadr2`='{$cadr2}',`cadr3`='{$cadr3}',`cadr4`='{$cadr4}',`cpin`='{$cpin}',`tenRoll`='{$tenRoll}',`tenMonth`='{$tenMonth}',`tenYear`='{$tenYear}',`tenSchool`='{$tenSchool}',`plus2roll`='{$plus2roll}',`twoMonths`='{$twoMonth}',`twoYear`='{$twoYear}',`twoExamName`='{$twoExamName}',`twoSchoolName`='{$twoSchoolName}',`twoBoardName`='{$twoBoardName}',`tcno`='{$tcno}',`tcdate`='{$tcdate}',`tcname`='{$tcname}',`chalan`='{$chalan}',`chlndate`='{$chlndate}',`chlnbranch`='{$chlnbranch}',`blood`='{$blood}',`plus2mark`='{$plus2mark}',`tenBoard`='{$tenBoard}',`guardian`='{$guardian}' WHERE appNo={$currentAppNo}";
      //echo $sql;
      if($this->db->query($sql))
      {
          alert('Data Uploaded Successfully');
      }else{
          alert('Some Errors with supplied data, avoid un-neccessary quotes,brackets,comma etc');
          
      }
      jsRedirect(base_url('office/page/editApplication'));
         
        
         
     }  else {
         $data=array(
                    'pageTitle'=>'Edit Application',
                    'page'=>'editApplication'
                );
               $this->load->view('office/header',$data);
                 $this->load->view('office/page');
         
     }
         }else{
             show_error();
         }
     
    }

    public function newApplication(){
        
     $rules=array(
         array(
             'field'=>'appNo',
             'label'=>'Application No',
             'rules'=>'trim|required|numeric|is_unique[admission.appNo]'
         ),
          array(
             'field'=>'residential',
             'label'=>'Residential Status',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
         array(
             'field'=>'hostelName',
             'label'=>'Hostel Name',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
          array(
             'field'=>'classNo',
             'label'=>'Class Number',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
          array(
             'field'=>'vehicle',
             'label'=>'Vehicle Type',
             'rules'=>'trim'
         ),
          array(
             'field'=>'vehicleNo',
             'label'=>'Vehicle Number',
             'rules'=>'trim'
         ),
          array(
             'field'=>'extra1',
             'label'=>'Extra Curricular1',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
          array(
             'field'=>'extra2',
             'label'=>'Extra Curricular 2',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
          array(
             'field'=>'rel1',
             'label'=>'Relation Ship 1',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
         array(
             'field'=>'rel2',
             'label'=>'Relation Ship 2',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
         array(
             'field'=>'rel3',
             'label'=>'Relation Ship 3',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
         array(
             'field'=>'rel1Job',
             'label'=>'Relation Ship 1 Job',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
          array(
             'field'=>'rel2Job',
             'label'=>'Relation Ship 2 Job',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
          array(
             'field'=>'rel3Job',
             'label'=>'Relation Ship 3 Job',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
         array(
             'field'=>'name',
             'label'=>'Student Name',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'courses',
             'label'=>'Courses',
             'rules'=>'trim|required'
         ),
         array(
             'field'=>'plus2group',
             'label'=>'Plus Two Group',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'tenBoard',
             'label'=>'Ten Board',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'recNeed',
             'label'=>'Recognition Needed',
             'rules'=>'trim|required'
         ),
         array(
             'field'=>'gender',
             'label'=>'Gender',
             'rules'=>'required'
         ),
         array(
             'field'=>'admnCat',
             'label'=>'Admission Category',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'aIncome',
             'label'=>'Annual Income',
             'rules'=>'trim|required|numeric'
         ),
         array(
             'field'=>'stMobile',
             'label'=>'Student Mobile',
             'rules'=>'trim|required|numeric'
         ),
         array(
             'field'=>'ptMobile',
             'label'=>'Parent Mobile',
             'rules'=>'trim|required|numeric'
         ),
         array(
             'field'=>'religion',
             'label'=>'Religion',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'category',
             'label'=>'Category',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'fname',
             'label'=>'Fathers Name',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'fOccu',
             'label'=>'Fathers Occupation',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'mname',
             'label'=>'Mothers Name',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'mOccu',
             'label'=>'Mothers Occupation',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'padr1',
             'label'=>'Permanent Address Name Line 1',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'padr2',
             'label'=>'Permanent Address Name Line 2',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'padr3',
             'label'=>'Permanent Address Name Line 3',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'padr4',
             'label'=>'Permanent Address Name Line 4',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'ppin',
             'label'=>'Permanent PIN',
             'rules'=>'trim|required|numeric'
         ),
         array(
             'field'=>'cadr1',
             'label'=>'Communication Address',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'cadr2',
             'label'=>'Communication Address Name Line 2',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'cadr3',
             'label'=>'Communication Address Name Line 3',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'cadr4',
             'label'=>'Communication Address Name Line 4',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'blood',
             'label'=>'Blood Group',
             'rules'=>'trim|required'
         ),
          array(
             'field'=>'plus2mark',
             'label'=>'Plus 2 Mark',
             'rules'=>'trim|required'
         ),
         array(
             'field'=>'cpin',
             'label'=>'Communication PIN',
             'rules'=>'trim|required|numeric'
         ),
         array(
             'field'=>'tenRoll',
             'label'=>'Ten Roll No',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'tenYear',
             'label'=>'Ten Year',
             'rules'=>'trim|required|numeric'
         ),
         array(
             'field'=>'tenSchool',
             'label'=>'Ten School Name',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'plus2roll',
             'label'=>'Plus 2 Roll',
             'rules'=>'trim|required'
         ),
         array(
             'field'=>'twoMonth',
             'label'=>'Plus 2 Month',
             'rules'=>'trim|required|alpha'
         ),
         array(
             'field'=>'twoYear',
             'label'=>'Plus Two Year',
             'rules'=>'trim|required|numeric'
         ),
         array(
             'field'=>'twoExamName',
             'label'=>'Plus Two Exam Name',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'twoSchoolName',
             'label'=>'Plus Two School Name',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'twoBoardName',
             'label'=>'Plus 2 Board Name',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
        array(
             'field'=>'tcno',
             'label'=>'TC No',
             'rules'=>'trim|required'
         ),
         array(
             'field'=>'tcdate',
             'label'=>'TC DATE',
             'rules'=>'trim|required'
         ),
         array(
             'field'=>'tcname',
             'label'=>'TC Instition Name',
             'rules'=>'trim|required|alpha_numeric_spaces'
         ),
         array(
             'field'=>'chalan',
             'label'=>'Chalan Number',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
         array(
             'field'=>'chlndate',
             'label'=>'Chalan Date',
             'rules'=>'trim'
             
         ),
         array(
             'field'=>'chlnbranch',
             'label'=>'Bank Branch',
             'rules'=>'trim|alpha_numeric_spaces'
         ),
         array(
             'field'=>'guardian',
             'label'=>'Local Guardian',
             'rules'=>'trim'
         )
         
         
     );
              //print_r($_POST);

     $this->form_validation->set_rules($rules);
     if($this->form_validation->run()){
       $vehicleNo="kl-35a-22";
         extract($_POST);
        
      $sql="INSERT INTO `admission`(`appNo`, `name`, `courses`, `plus2group`, `recNeed`, `gender`, `dob`, `admCat`, `aIncome`, `stMobile`, `ptMobile`, `religion`, `category`, `fname`, `mname`, `fOccu`, `mOccu`, `padr1`,`padr2`,`padr3`,`padr4`, `ppin`, `cadr1`,`cadr2`,`cadr3`,`cadr4`, `cpin`, `tenRoll`, `tenMonth`, `tenYear`, `tenSchool`, `plus2roll`, `twoMonths`, `twoYear`, `twoExamName`, `twoSchoolName`, `twoBoardName`, `tcno`, `tcdate`, `tcname`, `chalan`, `chlndate`, `chlnbranch`, `blood`,`plus2mark`,`tenBoard`,`residential`,`classNo`,`vehicleNo`,`vehicle`,`extra1`,`extra2`,`rel1`,`rel2`,`rel3`,`rel1Job`,`rel2Job`,`rel3Job`,`tenMark`,`hostelName`,`guardian`) VALUES ({$appNo},'{$name}','{$courses}','{$plus2group}','{$recNeed}','{$gender}','{$dob}','{$admnCat}','{$aIncome}','{$stMobile}','{$ptMobile}','{$religion}','{$category}','{$fname}','{$mname}','{$fOccu}','{$mOccu}','{$padr1}','{$padr2}','{$padr3}','{$padr4}','{$ppin}','{$cadr1}','{$cadr2}','{$cadr3}','{$cadr4}','{$cpin}','{$tenRoll}','{$tenMonth}','{$tenYear}','{$tenSchool}','{$plus2roll}','{$twoMonth}','{$twoYear}','{$twoExamName}','{$twoSchoolName}','{$twoBoardName}','{$tcno}','{$tcdate}','{$tcname}','{$chalan}','{$chlndate}','{$chlnbranch}','{$blood}','{$plus2mark}','{$tenBoard}','{$residential}','{$classNo}','{$vehicleNo}','{$vehicle}','{$extra1}','{$extra2}','{$rel1}','{$rel2}','{$rel3}','{$rel1Job}','{$rel2Job}','{$rel3Job}','{$tenMark}','{$hostelName}','{$guardian}')";
      if($this->db->query($sql))
      {
          alert('Data Uploaded Successfully');
      }else{
          alert('Some Errors with supplied data, avoid un-neccessary quotes,brackets,comma etc');
          
      }
      jsRedirect(base_url('office/page/newApplication'));
         
        
         
     }  else {
         $data=array(
                    'pageTitle'=>'New Application',
                    'page'=>'newApplication'
                );
               $this->load->view('office/header',$data);
                 $this->load->view('office/page');
         
     }
    }
}
