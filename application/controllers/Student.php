<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Student extends CI_Controller
{
    
    public function __construct()
       {
           {
            parent::__construct();
            if($this->session->userdata('usertype')<>"student")
            {
                
                redirect('error/alone');
           
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
       public function index(){
           $data=array(
               "pageTitle"=>"Home Page| Student  |",
               "name"=>$this->session->userdata('name')
           );
           $this->load->view('student/header.php',$data);
            $this->load->view('student/content.php');
           //echo $this->session->userdata('usertype');
           
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
   
    public function page($id=""){
        switch ($id){
            case "viewProfile":{
                $data=array(
                    'pageTitle'=>'View My Profile',
                    'page'=>'viewProfile'
                );
               $this->load->view('student/header',$data);
                 $this->load->view('student/page');
                
        }break;
    case "viewExams":{
                $data=array(
                    'pageTitle'=>'View My Exams',
                    'page'=>'view_exams'
                );
               $this->load->view('student/header',$data);
                 $this->load->view('student/page');
                
        }break;
    case "viewEbooks":{
                $data=array(
                    'pageTitle'=>'View E Books',
                    'page'=>'view_e_books'
                );
               $this->load->view('student/header',$data);
                 $this->load->view('student/page');
                
        }break;
            case "viewUniversity":{
                $data=array(
                    'pageTitle'=>'University Results',
                    'page'=>'view_university'
                );
               $this->load->view('student/header',$data);
                 $this->load->view('student/page');
                
        }break;
     case "viewMarks":{
                $data=array(
                    'pageTitle'=>'View My Marks',
                    'page'=>'viewMarks'
                );
               $this->load->view('student/header',$data);
                 $this->load->view('student/page');
                
        }break;
     case "viewAttendance":{
                $data=array(
                    'pageTitle'=>'View My Attendance',
                    'page'=>'view_attendance'
                );
               $this->load->view('student/header',$data);
                 $this->load->view('student/page');
                
        }break;
    
            
        }
    }
    
}
