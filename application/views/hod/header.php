<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $htmlTitle;?>-Campus Cloud</title>
     <script src="<?php echo base_url('asset/editor/tinymce.min.js');?>"></script>
  <script type="text/javascript">
  tinymce.init({
  selector: 'textarea',
  width:600,
  height: 300,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],
  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ]
});
  </script>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("asset");?>/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url("asset");?>/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url("asset");?>/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("asset");?>/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url("asset");?>/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url("asset");?>/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>

<body>

    <div id="wrapper">
        

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url($this->uri->segment(1));?>">Campus Cloud </a>
                 
            </div>
           
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
               
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li data-toggle="modal" data-target="#myProfile"><a href="#"><i class="fa fa-user fa-fw"></i>Edit Profile | <?php echo $_SESSION['name'];?></a>
                        </li>
                        <li data-toggle="modal" data-target="#myModal"><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li><a href="#"><i class="fa fa-lock fa-fw"></i>Role:&nbsp;&nbsp;<?php echo strtoupper($this->session->userdata('usertype'));?></a>
                        </li>
                        <li><a href="#"><i class="fa fa-flag fa-fw"></i>Dept:&nbsp;&nbsp;<?php echo strtoupper($this->session->userdata('dept_name'));?></a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url($this->uri->segment(1));?>/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            
                           
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?php echo base_url("hod");?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Staff<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url("hod/page/createStaff");?>">Create Staff</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("hod/page/manageStaff");?>">Manage Staff</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i>Class<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                
                                <li>
                                    <a href="<?php echo base_url("hod/page/createClass");?>">Create Class</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("hod/page/assignStaff");?>">Assign Staff</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("hod/page/manageClass");?>">Manage Class</a>
                                </li>
                            </ul>
                            
                            
                            
                            
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i>Papers<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                
                                <li>
                                    <a href="<?php echo base_url("hod/page/createCourses");?>">Create Papers</a>
                                </li>
                                 <li>
                                    <a href="<?php echo base_url("hod/page/managePapers");?>">View Papers</a>
                                </li>
                                 <li>
                                    <a href="<?php echo base_url("hod/page/bindCourse");?>">Assign Staff to Papers</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("hod/page/manageBind");?>">Manage Staff Papers</a>
                                </li>
                            </ul>
                            
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pencil fa-fw"></i>Exams<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url("hod/page/createExams");?>">Create Exams</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("hod/page/manageExams");?>">Manage Exams</a>
                                </li>
                                <li>
                            <a href="<?php echo base_url("hod/page/viewMarks");?>">View Marks</a>


                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?php echo base_url('hod/page/manageAttendance');?>"><i class="fa fa-files-o fa-fw"></i>Manage Attendance</a>
                            
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Manage Email<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('hod/page/manageMailStaff');?>">Email-Staff</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('hod/page/mailStudents');?>">Email-Students</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('hod/page/manageUploads');?>">Upload Files</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?php echo base_url('hod/page/manageQuestions');?>"><i class="fa fa-files-o fa-fw"></i>Exam Question Papers</a>
                            
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>