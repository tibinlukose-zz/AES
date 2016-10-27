<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LoginModel extends CI_Model{
    public function logincheck($data){
        $password=md5($data['password']);
        $query="select * from users where username=? and password=?";
        $query=$this->db->query($query,array($data['username'],$password));
        $row=$query->row_array();
        
      
        if($row['username']==$data['username']&&$row['password']==$password){
            
           $this->session->unset_userdata('usertype','uid','username','name');
                
                    // $row['userid'];
            if($row['active']==0){
                return FALSE;
                
            }
           
            
            $aesuser=array(
                "uid"=>$row['userid'],
                "username"=>$row['username'],
                "usertype"=>$row['user_type'],
                "name"=>$row['name'],
                "email"=>$row['email'],
                "phone"=>$row['phone']
                    
                );
            
            //login process for specific users, checking whether they have been disabled or not
            if($aesuser['usertype']=='hod')
            {
              
            
            $sql="select * from department where dept_user_hod_id='{$aesuser['uid']}'";
            
            $query=$this->db->query($sql);
            
            $row=$query->row_array();
            //user_specific session data 
            $aeshod=array(
                'dept_id'=>$row['dept_id'],
                'dept_name'=>$row['dept_name'],
                'dept_code'=>$row['dept_code']
            );
            $this->session->set_userdata($aeshod);
            if($row['active']==1)
            {
            $this->session->set_userdata($aesuser);
            return TRUE; 
            }
             
            else
            {
                return FALSE;
            }
            }
            if($aesuser['usertype']=='staff')
            {
              
            
            $sql="select * from staffdept where id={$aesuser['uid']}";
            
            $query=$this->db->query($sql);
            
            $row=$query->row_array();
            //user_specific session data 
            $aeshod=array(
                'dept_id'=>$row['dept_id']
                
            );
            $this->session->set_userdata($aeshod);
           $sql="select active from users where userid={$aesuser['uid']}";
           $sql=$this->db->query($sql);
           $sql=$sql->row_array();
           if($sql['active']==1){
               
           
            
            $this->session->set_userdata($aesuser);
            return TRUE; 
           }
           else{
               return FALSE;
           }
            }
           
            if($aesuser['usertype']=='student')
            {
             
            
           $this->session->set_userdata($aesuser);
            return TRUE; 
           
            }
            
            // login validate type ends
            
            //login process continues for every other users->
            $this->session->set_userdata($aesuser);
            //echo $_SESSION['usertype'];
            return TRUE; 
            
            
            
            
        }
        else
        {  
            return FALSE;
            
        }
    }
    public function userPasswordChange($data){
        
        if($this->session->userdata('usertype')=='principal' or $this->session->userdata('usertype')=='student' or $this->session->userdata('usertype')=='hod' or $this->session->userdata('usertype')=='office' or $this->session->userdata('usertype')=='staff'){
            $dbq="select * from users where username='{$this->session->userdata('username')}'";
            
            $query=$this->db->query($dbq);
            
            $row = $query->row_array();
            //echo $row['password'];
            //echo "<br>".$data['confirm'];
            if($row['password']==md5($data['current'])){
                $newPassword=md5($data['confirm']);
                $dbq="update users set password='{$newPassword}' where username='{$this->session->userdata('username')}'";
                //echo $dbq;
                if($this->db->simple_query($dbq)){
                    
                    return TRUE;
                    
                }
                    else{
                       return false;
                    }
            
                   
                    
                 
                    
                    
                
            }
            else
            {
              Return FALSE;
            }
            
        }
        else
        {
            show_error();
        }
          
    }
    public function userProfile($data){
        
        if($this->session->userdata('usertype')=='principal' or $this->session->userdata('usertype')=='staff' or $this->session->userdata('usertype')=='student' or $this->session->userdata('usertype')=='hod' or $this->session->userdata('usertype')=='office')
        {
        $sql="select * from users where email='{$data['email']}'";
        $sql=$this->db->query($sql);
        if($sql->num_rows()==0){
         $sql="update users set email='{$data['email']}' where username='{$_SESSION['username']}'";
         $_SESSION['email']=$data['email'];
        }
        $sql="select * from users where phone={$data['phone']}";
        $sql=$this->db->query($sql);
        if($sql->num_rows()==0){
         $sql="update users set phone={$data['email']} where username='{$_SESSION['username']}'";
         $_SESSION['phone']=$data['phone'];
        }
        $sql="update users set name='{$data['name']}' where username='{$_SESSION['username']}'";
        $sql=  $this->db->simple_query($sql);
        $_SESSION['name']=$data['name'];
        return TRUE;
            

        }
        else
        {
            show_error();
        }
          
    }
    
}