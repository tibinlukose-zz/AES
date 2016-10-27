<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class PrincipalModel extends CI_Model{
    function __construct() {
  
        parent::__construct();
        if(!$this->session->userdata('usertype')=="principal"){
           //exit();
        }
    }
    
    function listDepartment(){
       
         $query = $this->db->query('SELECT u.name,d.* from users u,department d where u.userid=d.dept_user_hod_id');
         return $query->result_array();
  
    }
    
}
