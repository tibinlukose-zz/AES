<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class principal extends CI_Controller
{
    
    public function __construct()
       {
           {
            parent::__construct();
            if($this->session->userdata('usertype')<>"principal")
            {
                
                redirect('error/alone');
           
            }
       }
       }
       public function index(){
           $data=array(
               "htmlTitle"=>"Home Page | PRINCIPAL | CS |",
               "name"=>$this->session->userdata('name')
           );
           $this->load->view('principal/header.php',$data);
            $this->load->view('principal/content.php');
           //echo $this->session->userdata('usertype');
           
       }
       public function mainCourses(){
        $this->form_validation->set_rules('department','Department','required');   
        $this->form_validation->set_rules('totalSemesters','Total Semesters','trim|required|numeric|greater_than_equal_to[1]|less_than[10]');
        $this->form_validation->set_rules('course','Main Course','trim|required|alpha_numeric_spaces|max_length[50]|min_length[5]');
        $this->form_validation->set_rules('code','Course Code','trim|required|alpha|min_length[3]|max_length[8]|is_unique[courses.code]');
        $this->form_validation->set_rules('totalBatches','Total Number of batches','trim|required|numeric|less_than[10]|greater_than[0]');
        $dept=$this->encryption->decrypt($this->input->post('department'));
        if($dept){
            
        
        if($this->form_validation->run())
        {
           $course=$this->input->post('course');
           $code=  strtoupper($this->input->post('code'));
           $dept_id=$dept;
           $semesters=$this->input->post('totalSemesters');
           $batches=$this->input->post('totalBatches');
           $sql="insert into courses (courseName,code,semesters,dept_id,batches) values(?,?,?,?,?)";
           $this->db->query($sql,array($course,$code,$semesters,$dept_id,$batches));
           ?>
               <script>
                   window.alert("Course Saved Successfully");
                   </script>
                   <?php
                    $data=array(
                'htmlTitle'=>'Create Main Courses',
                'page'=>'mainCourses'
            );
            $this->load->view('principal/header',$data);
            $this->load->view('principal/page');
            
        
        }
        
        
        else
        {
            $data=array(
                'htmlTitle'=>'Create Main Courses',
                'page'=>'mainCourses'
            );
            $this->load->view('principal/header',$data);
            $this->load->view('principal/page');
        }
        }
 else {
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
    public function page($id){
        if($id=="department"){
            $this->load->model('PrincipalModel');
            
            
        
        $data=array(
            "htmlTitle"=>"Manage Department | Principal | ",
            "page"=>"manage_department",
            "pagehead"=>"Manage Department",
            "principal_list"=>$this->PrincipalModel->listDepartment()
                        
                
            
        );
        
        
        $this->load->view($this->uri->segment(1).'/header',$data);
        $this->load->view($this->uri->segment(1).'/page',$data);
                                              
    }
    elseif($id=='manageSemester'){
        $data=array(
            'htmlTitle'=>'Manage Semesters',
            'page'=>'manageSemester'
        );
        $this->load->view('principal/header',$data);
        $this->load->view('principal/page');
    }
     elseif($id=='viewExamMark'){
        $data=array(
            'htmlTitle'=>'View Exam Mark',
            'page'=>'view_exam'
        );
        $this->load->view('principal/header',$data);
        $this->load->view('principal/page');
    }
     elseif($id=='officeStaff'){
        $data=array(
            'htmlTitle'=>'Manage Semesters',
            'page'=>'office_staff'
        );
        $this->load->view('principal/header',$data);
        $this->load->view('principal/page');
    }
    elseif($id=="mainCourses"){
        $data=array(
            'htmlTitle'=>'Create Courses',
            'page'=>'mainCourses'
        );
        $this->load->view('principal/header',$data);
        $this->load->view('principal/page');
    }
    else if($id=="createDepartment"){
            $this->load->model('PrincipalModel');
            
            
        
        $data=array(
            "htmlTitle"=>"Create Department | Principal | ",
            "page"=>"create_department",
            "pagehead"=>"Create Department"
            
        );
        
        
        $this->load->view($this->uri->segment(1).'/header',$data);
        $this->load->view($this->uri->segment(1).'/page',$data);
                                              
    }
    else if($id=="createHOD"){
            $this->load->model('PrincipalModel');
            
            
        
        $data=array(
            "htmlTitle"=>"Create HOD | Principal | ",
            "page"=>"create_hod",
            "pagehead"=>"Create New HOD"
            
        );
        
        
        $this->load->view($this->uri->segment(1).'/header',$data);
        $this->load->view($this->uri->segment(1).'/page',$data);
                                              
    }
    else if($id=="manageCourses"){
        $data=array(
            'htmlTitle'=>"Manage Courses",
            'page'=>'manageCourses'
        );
        $this->load->view('principal/header',$data);
        $this->load->view('principal/page');
    }
    else if($id=="ManageYear")
    {
        
        $data=array(
            "htmlTitle"=>"Manage  Academic Year | Principal | ",
            "page"=>"ac_year_manage",
            "pagehead"=>"Manage Academic Year"
             );
    $this->load->view('principal/header',$data);
     $this->load->view('principal/page',$data);
    
        
    }
    else
    {
        show_404();
    }
    }
    public function saveDept(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('departname','Department Name','required');
        $this->form_validation->set_rules('departcode','Department Code','required|is_unique[department.dept_code]|alpha|max_length[6]|min_length[2]');
        $this->form_validation->set_rules('hod','HOD Name','required');
        if($this->form_validation->run()==FALSE){
           
        
        $data=array(
            "htmlTitle"=>"Create Department | Principal | ",
            "page"=>"create_department",
            "pagehead"=>"Create Department"
       
        );

        $this->load->view($this->uri->segment(1).'/header',$data);
        $this->load->view($this->uri->segment(1).'/page',$data);
        }
        else
        {
        $sql="INSERT INTO `department`(`dept_name`, `dept_user_hod_id`, `dept_code`, `active`) VALUES ('{$this->input->post('departname')}' ,'{$this->input->post('hod')}','{$this->input->post('departcode')}','1')"; 
        $this->db->query($sql);
        ?><script>alert("Department Saved Sucessfully");
        location.href='';    
        </script><?php 
        
        
        }
    }
    public function officeStaff(){
        $this->form_validation->set_rules('username','User Name','trim|required|alpha_dash|min_length[5]|max_length[20]|is_unique[users.username]',array('is_unique'=>'Oops .. this %s its already taken.. '));
        $this->form_validation->set_rules('name','Name','trim|required|alpha_numeric_spaces|min_length[5]|max_length[30]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('phone','Phone Number','trim|required|numeric|is_unique[users.phone]');
        if($this->form_validation->run()){
            
        extract($this->input->post());
         $password=md5("office@mac");
        $query="INSERT INTO `users`(`username`, `password`, `active`, `user_type`, `name`, `email`, `phone`) VALUES ('{$username}','{$password}',1,'office','{$name}','{$email}','{$phone}')";
        //echo $query;
        
        $this->db->query($query);
       
        ?>
        <script>
               window.alert('Office staff created successfully');
               location.href="<?php echo base_url('principal/page/officeStaff');?>";
               </script>
               <?php
        }else
        {
            $data=array(
            'htmlTitle'=>'Manage Semesters',
            'page'=>'office_staff'
        );
        $this->load->view('principal/header',$data);
        $this->load->view('principal/page');
        }
    }
    public function manageSemester(){
        $semester=$this->encryption->decrypt($this->input->post('semester'));
        $course=$this->encryption->decrypt($this->input->post('course'));
        $year=$this->encryption->decrypt($this->input->post('year'));
        
        if($semester and $course and $year){
            $sql="select * from semester_logs where course_id={$course} and semester={$semester}";
                
            $query=  $this->db->query($sql);
            $sql=$query->row_array();
            
            if($query->num_rows()==0){
            
            $sql="select * from semester_logs where course_id={$course} and academic_year={$year}";
            $query=  $this->db->query($sql);
            if($query->num_rows()==0)
            {
                $sql="INSERT INTO `semester_logs`(`course_id`, `academic_year`, `semester`) VALUES (?,?,?)";
                $sql=$this->db->query($sql,array($course,$year,$semester));
               redirect(base_url('principal/page/manageSemester?msg=sem_change'));
            }
            else
            {
                $sql="update semester_logs set semester={$semester} where course_id={$course} and academic_year={$year}";
                $sql=$this->db->query($sql);
               redirect(base_url('principal/page/manageSemester?msg=sem_change'));
                    
                
            }}else{
    show_error('Semester already binded with an year | Verify data');
            }
            
        }
        else
        {
            show_error();
        }

    }
    public function createHOD()
   {
                $error_email=array(
            'is_unique'=>'Email address is already found in our system, use any other'
        );
                 $error_phone=array(
            'is_unique'=>'Phone Number is already found in our system,use any other'
        );
       $this->form_validation->set_rules('name','Name','required|max_length[50]|min_length[5]');
       $this->form_validation->set_rules('email','Email','required|is_unique[users.email]|valid_email',$error_email);
       $this->form_validation->set_rules('phone','Phone','required|is_unique[users.phone]|numeric|min_length[10]|max_length[15]',$error_phone);
       $this->form_validation->set_rules('username','Username','required|is_unique[users.username]|alpha_numeric|min_length[5]|max_length[10]');
       if($this->form_validation->run()==FALSE)
       {
           $data=array(
            "htmlTitle"=>"Create New HOD | Principal | ",
            "page"=>"create_hod",
            "pagehead"=>"Create New HOD"
       
        );

        $this->load->view($this->uri->segment(1).'/header',$data);
        $this->load->view($this->uri->segment(1).'/page',$data);
       }
        else {
         extract($this->input->post());
         $password=md5("password@123");
        $query="INSERT INTO `users`(`username`, `password`, `active`, `user_type`, `name`, `email`, `phone`) VALUES ('{$username}','{$password}',1,'hod','{$name}','{$email}','{$phone}')";
        //echo $query;
        
        if($this->db->query($query))
        {
            ?><script>alert("HOD Created Successfully");</script><?php 
           $data=array(
            "htmlTitle"=>"Create New HOD | Principal | ",
            "page"=>"create_hod",
            "pagehead"=>"Create New HOD"
       
        );

            $this->load->view($this->uri->segment(1).'/header',$data);
        $this->load->view($this->uri->segment(1).'/page',$data);
           
        
        
        
        }
        
        }
       
      
    }
    public function ManageYearSave(){
         $this->form_validation->set_rules('year','Academic Year','required|is_unique[academic_year.year]|numeric|greater_than[2000]|less_than[2020]');
          $data=array(
                "htmlTitle"=>"Manage  Academic Year | Principal | ",
                "page"=>"ac_year_manage",
                "pagehead"=>"Manage Academic Year"
                );       
         if($this->form_validation->run()==FALSE)
                {
                  
                   
                    $this->load->view('principal/header',$data);
                    $this->load->view('principal/page',$data);
                }
                else
                {
                       $year=$this->input->post('year');
                       $this->db->query("insert into academic_year values('',$year);");
                    ?><script>
                                window.alert("Year Updated  Successfully");
                               location.href="<?php echo base_url('/principal/page/ManageYear');?>";
                             </script>
                             <?php 
                    $this->load->view('principal/header',$data);
                    $this->load->view('principal/page',$data);
                  
                    
                }
          
    
       
    }
}