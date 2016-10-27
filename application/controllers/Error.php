<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Error extends CI_Controller{
    public function index(){
        show_error();
        //Default Show_error Required 
        //header('HTTP/1.1 403 Forbidden');
        //OLD ERROR CODE USED PLAIN HTTP STATUS CODES FOR DISPLAYING THE ERROR
        //Done by Sriram
    }
           
    
}