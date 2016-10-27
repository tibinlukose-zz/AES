<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Login extends CI_Controller{
    public function index(){
        $error=array(
                      'flag'=>0,
                      'message'=>""
                  );
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required');
        
        if($this->form_validation->run()==FALSE)
        {
            $this->load->view('loginpage.php',$error);
        }
        else
        {
            $data=array(
                'username'=>$this->input->post('username'),
                'password'=>$this->input->post('password'),
                'date'=>date("d-m-Y")
            );
            $this->load->model('LoginModel');
            //echo $this->LoginModel->logincheck($data);
            if($this->LoginModel->logincheck($data))
            {
               // echo "login success";
                //echo $_SESSION['user_type']; 
                    $this->userTypeCheck();
             
            }
            else{
                  $error=array(
                      'flag'=>1,
                      'message'=>""
                  );
                 $this->load->view('loginpage.php',$error);
            }
        }
        
        
    }
    public function userTypeCheck(){
        switch ($this->session->userdata("usertype")){
                        case "principal": redirect(base_url("/principal"));break;
                        case "hod":redirect(base_url("/hod"));break;
                        case "office":redirect(base_url("/office"));break;
                        case "staff":redirect(base_url("/staff"));break;
                        case "student":redirect(base_url("/student"));break;
                        default:redirect(base_url("/erro1r.php"));break;
                    }
    }
    public function getMyPass(){
        $this->form_validation->set_rules('username','UserName','trim|required');
                
       if($this->form_validation->run()){
         $sql="select * from users where username=? and active=1";
         $sql=$this->db->query($sql,array('username'=>$this->input->post('username')));
        
         if($sql->num_rows()==1){
             $user=$this->input->post('username');
             $data=$sql->row_array();
             //$this->email->initialize($config);
              $this->load->library('email'); // load email library
            $this->email->from('aes@mac.edu.in', 'AES, Campus Cloud');
            $this->email->to($data['email']);
            $this->email->cc('aes@mac.edu.in'); 
            $this->email->subject('Password Reset | Campus Cloud');
             $key=md5($data['name'].$data['password'].time());
             $sql="delete from recovery where userid='{$user}'";
             $sql=  $this->db->query($sql);
             $sql="INSERT INTO `recovery`(`userid`, `auth`) VALUES ('{$user}','{$key}')";
             $sql=$this->db->query($sql);
             
             $link=base_url('login/getMyPass?key=').$key;
            $message="Hello {$data['name']},<div><br></div><div>Someone has requested for password reset for<b> AES | Campus Cloud </b>Profile.</div><div><br></div><div>If its you. Click below to proceed</div><div><br></div><div><a href='{$link}'>{$link}</a></div><div><br></div><div>or <u>leave it</u></div>";
           //  echo $message;   
           $this->email->message($message);
           
    if ($this->email->send()){
        ?>
            <script>
                window.alert("Recovery email is sent to your registered email address  .:.Check Spam/Junk MailBox also");
                location.href="<?php echo base_url();?>";
                </script>
                <?php
                
    }
       
    else
        echo "There is error in mail Server! Sorry";
          
             
             
             
             
         }else{
             $data=array(
                 'error'=>'Oops. No User found for this username!'
             );
             $this->load->view('getMyPass',$data);
         }
         
       }else
       {
           $this->load->view('getMyPass',$data=FALSE);
       }
    }
    public function changePassword(){
        $this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[15]');
        $this->form_validation->set_rules('conpassword','Password Confirmation','trim|required|min_length[6]|max_length[15]|matches[password]');
        
        if($this->form_validation->run()){
            $key=$this->input->post('key');
             $sql="select * from recovery where auth='{$key}'";
                    $sql=$this->db->query($sql);
                    $data=$sql->row_array();
                    if($data['auth']==$key){
                        
                        $password=md5($this->input->post('password'));
                        $sql="update users set password='{$password}' where username='{$data['userid']}'";
                        if($this->db->query($sql)){
                         $sql="delete from recovery where auth='{$key}'";
                         $this->db->query($sql);
                         ?>
                <script>window.alert('Password Changed Successfully');
                    location.href="<?php echo base_url();?>";
                    </script>
                    <?php
                        }
                    }
         
            
            
        }else
        {
            $data=array(
                'key'=>$this->input->post('key')
            );
            $this->load->view('getMyPass',$data); 
            
        }
        
    }
    
}

