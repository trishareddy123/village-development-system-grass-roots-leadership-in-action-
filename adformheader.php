<?php
session_start();
error_reporting(0);
include("dbconnection.php");
$dt = date("Y-m-d");
$tim = date("H:i:s");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title>Grassroots Leadership in Action</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<!-- JQuery DataTable Css -->
<link href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="assets/css/main.css" rel="stylesheet">
<!-- Custom Css -->

<!-- Swift Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="assets/css/themes/all-themes.css" rel="stylesheet" />
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
</head>

<body class="theme-cyan" style="background-color:#663399">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-cyan">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"  style="background-color:#663399"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Morphing Search  -->

    <!-- Top Bar -->
    <nav class="navbar clearHeader" style="background-color:#8B008B">
        <div class="col-12">
            <div class="navbar-header"> <a href="javascript:void(0);" class="bars"></a> <a class="navbar-brand"
                    href="#">Grassroots Leadership in Action</a> </div>
            <ul class="nav navbar-nav navbar-right">
                <!-- Notifications -->
                <li>
                    <a data-placement="bottom" title="Full Screen" href="logout.php"><i
                            class="zmdi zmdi-sign-in"></i></a>
                </li>               

            </ul>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <?php
                if(isset($_SESSION['adminid']))
                {
            ?>
            <!--Admin Menu -->
            <div class="menu" style="background-color:#663399">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active open"><a href="adminaccount.php"><i
                                class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>


                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Profile</span> </a>
                        <ul class="ml-menu">
                            <li><a href="adminprofile.php">Admin Profile</a></li>
                            <li><a href="adminchangepassword.php">Change Password</a></li>
                            <li><a href="admin.php">Add Admin</a></li>
                            <li><a href="viewadmin.php">View Admin</a></li>
                        </ul>
                    </li>

                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Problem</span> </a>
                        <ul class="ml-menu">
                            <li><a href="problem.php">New Problem</a></li>
                            <li><a href="viewproblempending.php">View Pending Problems</a>
                            </li>
                            <li><a href="viewproblemapproved.php">View Approved
                                    Problems</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-add"></i><span>Volunteers</span> </a>
                        <ul class="ml-menu">
                            <li><a href="volunteer.php">Add Volunteer</a>
                            </li>
                            <li><a href="viewvolunteer.php">View Volunteer</a></li>
                           
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-add"></i><span>PanchayatRaj</span> </a>
                        <ul class="ml-menu">
                            <li><a href="panchayatraj.php">Add PanchayatRaj</a>
                            </li>
                            <li><a href="viewpanchayatraj.php">View PanchayatRaj</a></li>
                           
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-o"></i><span>Users</span> </a>
                        <ul class="ml-menu">
                            <li><a href="user.php">Add User</a></li>
                            <li><a href="viewuser.php">View User Records</a></li>
                        </ul>
                    </li>


                    <li> <a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-settings-square"></i><span>Service</span> </a>
                        <ul class="ml-menu">
                            <li><a href="department.php">Add Department</a></li>
                            <li><a href="viewdepartment.php">View Department</a></li>
                            
                        </ul>
                    </li>

                </ul>
            </div>
            <!-- Admin Menu -->
            <?php }?>


            <!-- volunteer Menu -->
            <?php
            if(isset($_SESSION['volunteerid']))
            {
            ?>
            <div class="menu" style="background-color:#663399">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active open"><a href="volunteeraccount.php"><i
                                class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>


                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Profile</span> </a>
                        <ul class="ml-menu">
                            <li><a href="volunteerprofile.php">Profile</a></li>
                            <li><a href="volunteerchangepassword.php">Change Password</a></li>
                        </ul>
                    </li>

                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Problem</span> </a>
                        <ul class="ml-menu">
                            <li><a href="viewproblempending.php" style="width:250px;">View Pending Problems</a>
                            </li>
                            <li><a href="viewproblemapproved.php" style="width:250px;">View Approved
                                    Problems</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-add"></i><span>Volunteers</span> </a>
                        <ul class="ml-menu">
                           
                            <li><a href="volunteertimings.php">Add Visiting Hour</a></li>
                            <li><a href="viewvolunteertimings.php">View Visiting Hour</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-add"></i><span>PanchayatRaj</span> </a>
                        <ul class="ml-menu">
                           
                            <li><a href="panchaaytrajtimings.php">Add Visiting Hour</a></li>
                            <li><a href="viewpanchayatrajtimings.php">View Visiting Hour</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-o"></i><span>Users</span> </a>
                        <ul class="ml-menu">
                            <li><a href="viewuser.php">View User</a>
                            </li>
                        </ul>
                    </li>

                    


                    <li> <a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-settings-square"></i><span>Service</span> </a>
                        <ul class="ml-menu">
                            <li><a href="viewactionrecord.php">View Action Records</a></li>
                            
                        </ul>
                    </li>

                </ul>
            </div>

            <?php }; ?>
            <!-- volunteer Menu -->
             <!-- panchayatraj Menu -->
            <?php
            if(isset($_SESSION['panchayatrajid']))
            {
            ?>
            <div class="menu" style="background-color:#663399">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active open"><a href="panchayatrajaccount.php"><i
                                class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>


                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Profile</span> </a>
                        <ul class="ml-menu">
                            <li><a href="panchayatrajprofile.php">Profile</a></li>
                            <li><a href="panchayatrajchangepassword.php">Change Password</a></li>
                        </ul>
                    </li>

                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Problem</span> </a>
                        <ul class="ml-menu">
                            <li><a href="viewproblempending.php" style="width:250px;">View Pending Problems</a>
                            </li>
                            <li><a href="viewproblemapproved.php" style="width:250px;">View Approved
                                    Problems</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-add"></i><span>Volunteers</span> </a>
                        <ul class="ml-menu">
                           
                            <li><a href="volunteertimings.php">Add Visiting Hour</a></li>
                            <li><a href="viewvolunteertimings.php">View Visiting Hour</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-add"></i><span>PanchayatRaj</span> </a>
                        <ul class="ml-menu">
                           
                            <li><a href="panchaaytrajtimings.php">Add Visiting Hour</a></li>
                            <li><a href="viewpanchayatrajtimings.php">View Visiting Hour</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-o"></i><span>Users</span> </a>
                        <ul class="ml-menu">
                            <li><a href="viewuser.php">View User</a>
                            </li>
                        </ul>
                    </li>

                    


                    <li> <a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-settings-square"></i><span>Service</span> </a>
                        <ul class="ml-menu">
                            <li><a href="viewactionrecord.php">View Action Records</a></li>
                            
                        </ul>
                    </li>

                </ul>
            </div>

            <?php }; ?>
            <!-- panchayatraj Menu -->




            <!-- user Menu -->
            <?php
            if(isset($_SESSION['userid']))
            {
            ?>
            <div class="menu" style="background-color:#663399">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active open"><a href="useraccount.php"><i
                                class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>


                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Profile</span> </a>
                        <ul class="ml-menu">
                            <li><a href="userprofile.php">View Profile</a></li>
                            <li><a href="userchangepassword.php">Change Password</a></li>
                        </ul>
                    </li>

                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Problem</span> </a>
                        <ul class="ml-menu">
                            <li><a href="userproblem.php" >Add Problem</a></li>
                            <li><a href="viewproblem.php" >View Problems</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-o"></i><span>Action</span> </a>
                        <ul class="ml-menu">
                            <li><a href="viewactionrecord.php">View Action Records</a></li>
                    </li>
                </ul>
                </li>


                </ul>
            </div>

            <?php }; ?>
            <!-- user Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
     
    </section>
     <section class="content home"></section>

