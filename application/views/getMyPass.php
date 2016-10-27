<?php

/* 
 * License under Pirates of mac Valley.
 * Developed by Navas, Sriram and Tibin  * 
 */


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Recover Password - Campus Cloud</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>asset/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>asset/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>asset/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>asset/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
    .apptitle
    {
        text-align:center;
        color:black;
        letter-spacing: 2px;
        font-size:50px;
    }
</style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <?php
                if(validation_errors()){
                    ?>
                
                <div class="alert alert-danger"><?php echo validation_errors();?></div>   
                 <?php
                }
                
                if(isset($error)){
                    ?>
                
                <div class="alert alert-danger"><?php echo $error;?></div>   
                 <?php
                }
                ?>
               
                <div class="apptitle">
                        Campus Cloud
                </div>  
                <?php
                
                if($this->input->get('key') or isset($key)){
                    if($this->input->get('key'))
                        $key=$this->input->get('key');
                   
                    $sql="select * from recovery where auth='{$key}'";
                    $sql=$this->db->query($sql);
                    $data=$sql->row_array();
                    if($data['auth']==$key){
                       ?>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Change Password | username:<b><?php echo $data['userid'];?></b></h3>
                    </div>
                    <div class="panel-body">
                        <form method ="post" role="form" action="<?php echo base_url("login/changePassword");?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="New Password" name="password" type="password" autofocus>
                                </div>
                                 <div class="form-group">
                                    <input class="form-control" placeholder="Confirm Password" name="conpassword" type="password" autofocus>
                                </div>
                                <input type='hidden' name='key' value='<?php echo $key;?>'>
                                
                               
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" value="Change Password" class="btn btn-lg btn-success btn-block">
                                <br>
                                 <br>
                                <i class="fa fa-lock">&nbsp;&nbsp;&nbsp;</i><a href="<?php echo base_url('login');?>">Go Home!</a>
                           
                               
                            </fieldset>
                        </form>
                    </div>
                </div>
                
                
                
                
                <?php
                    }else
                    {
                        ?>
                <div class="alert alert-danger">
                    Invalid Authorization
                </div>
                <?php
                    }
                    
                    
                    
                    
                    
                }else{
                  
                ?>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Recover Password</h3>
                    </div>
                    <div class="panel-body">
                        <form method ="post" role="form" action="<?php echo base_url("login/getMyPass");?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                               
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" value="Recover" class="btn btn-lg btn-success btn-block">
                                <br>
                                 <br>
                                <i class="fa fa-lock">&nbsp;&nbsp;&nbsp;</i><a href="<?php echo base_url('login');?>">Go Home!</a>
                            
                            </fieldset>
                        </form>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url();?>asset/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>asset/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>asset/dist/js/sb-admin-2.js"></script>

</body>

</html>


