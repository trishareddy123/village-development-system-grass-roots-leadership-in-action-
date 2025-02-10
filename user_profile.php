
<?php 
include('dbconnection.php');
session_start();
		$uid	=$_SESSION['user_id']; 
		$sql	="select * from user_detail where login_id='$uid'";
	
		$row 	= $conn->query($sql);
		$udtl 	= mysqli_fetch_array($row);	
		
?>
<?php

if(isset($_POST['btnsub']))
{
	$uid=$_POST['user_id'];
	$gnd=$_POST['gender'];
	$mob=$_POST['mobile_number'];
	$date=$_POST['dob'];
	$add=$_POST['street_address'];
	$ema=$_POST['email'];
	$tim=$_POST['time'];
	
	$check=$_POST['test'];
	$chkVl="";
	$slNm=$_POST['spl_name'];
	$volNm=$_POST['vol_name'];
	$slNm=$_POST['spl_name'];
	$panNm=$_POST['pan_name'];
	
	//echo count($check).'<br>';exit;
	for($i=0;$i<=count($check);$i++)
	{
		$chkVl.=$check[$i].',';
	}
	
	$sql1="insert into problem_tbl(user_id,time_slot,treatment,vol_special,volid,pan_special,panid,status)values('$uid','$tim','$chkVl','$slNm','$volNm','$slNm',$panNm,'1')";
	
	$row 	= $conn->query($sql1);
	header('Location:problem.php'); 
	

}
?>
	
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Left Sidebar</title>

	<link rel="stylesheet" href="pt_css/assets/demo.css">
	<link rel="stylesheet" href="pt_css/assets/sidebar-left.css">

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	<script src="js/jquery-2.1.1.js"></script>
	<!-- stylesheets -->
	<link rel="stylesheet" href="pt_css/font-awesome.css">
	<link rel="stylesheet" href="pt_css/style.css">
	<link rel="stylesheet" href="css/default.css">
	
	<!-- google fonts  -->
	<link href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Josefin+Sans:300,400,400i,700" rel="stylesheet">

</head>
<style>
body
{
    background-image:url('image/1.jpg');
	background-size:100% 100%;
	
}
label.form-label {
    display: inline-block;
    width: 30%;
	    font-weight: 400;
		letter-spacing: 1px;
		    vertical-align: top;
			text-align: left;
}
</style>
<body>

	<aside class="sidebar-left" style="width: 200px;">

			
		<a class="company-logo" href="#">Logo</a>

		<div class="sidebar-links">
			<a class="link-blue" href="javascript:user_pg(1,<?=$uid?>);"><i class="fa fa-keyboard-o"></i>Add Problem</a>
			<a class="link-red" href="viewproblem.php"><i class="fa fa-keyboard-o"></i>View Problem</a>
			<a class="link-yellow selected" href="user_profile.php"><i class="fa fa-keyboard-o"></i>View Profile</a>
			<a class="link-green" href="logout.php"><i class="fa fa-map-marker"></i>Logout</a>
		</div>

	</aside>

	
	<div class="w3ls-banner">
	<!---728x90--->
	<div class="heading">
				<h1>Choose My Volunteer</h1>
				
	</div>
	<!---728x90--->
	
	<div class="main-content">
		<div class="menu">

		<div id="show_login">
		<div class="container" style="width: 918px; margin-top: -121px;">
		
		
			<div class="heading">
				<h2>Please Enter Users Details</h2>
				<p>Fill the form below and submit your query we will contact you as soon as possible.</p>
			</div>
		
			<div class="agile-form">
				<form action="" method="post">
				<div class="row">
                    <div class="col-md-12">
						 
                    <label class="form-label" style="align:left;"> Full Name 
								<span class="form-required"> * </span>
						</label>
						<div class="form-input" style="align:left;"><?=$udtl['user_name']?></div>
					</div>
					<br/>
					 <div class="col-md-12">
						 
                    <label class="form-label" style="align:left;"> Email
								<span class="form-required" > * </span>
						</label>
						<div class="form-input" style="align:left;"><?=$udtl['email']?></div>
					</div>
					<br/>
					<div class="col-md-12">
						 
                    <label class="form-label" style="align:left;"> DOB
								<span class="form-required"> * </span>
						</label>
						<div class="form-input" style="align:left;"><?=$udtl['dob']?></div>
					</div>
					<br/>
				<div class="col-md-12">
						 
                    <label class="form-label" style="align:left;"> Address
								<span class="form-required"> * </span>
						</label>
						<div class="form-input" style="align:left;"><?=$udtl['street_address']?></div>
					</div>
					<br/>
				
				</form>	
			</div>
		</div>
		</div>
		<!---728x90--->
		
	</div>

		</div>

	</div>
<div class="copyright">
		<p>© 2017 Choose My Volunteer Form. All rights reserved | Design by <a href="www.w3layouts.com">W3layouts</a></p> 
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>

		$(function () {

			var links = $('.sidebar-links > a');

			links.on('click', function () {

				links.removeClass('selected');
				$(this).addClass('selected');

			})
		});

	</script>
	<script>
	function valtimeslot(id)
	{
		var time='';
		$('#show_err').load('checktime.php?id='+id+'&time='+time);
	}
	function user_pg(page,id){
		if(page==1)
		{
				$('#show_login').load('adduser.php?id='+id);}
				if(page==2)
				{
					$('#show_login').load('viewproblem.php');
				}
					if(page==3)
				{
					$('#show_login').load('viewuser.php');
				}
				
				if(page==4)
				{
					$('#show_login').load('logout.php');
				}	
				
		}
		function showvolunteer(id)
		{
			$('#show_volnm').load('show_vol.php?id='+id);
			
		}
		
		</script>
		<div class="w3ls-banner">
	<!---728x90--->
	<div class="heading">
				<h1>Choose My PanchayatRaj</h1>
				
	</div>
	<!---728x90--->
	
	<div class="main-content">
		<div class="menu">

		<div id="show_login">
		<div class="container" style="width: 918px; margin-top: -121px;">
		
		
			<div class="heading">
				<h2>Please Enter Users Details</h2>
				<p>Fill the form below and submit your query we will contact you as soon as possible.</p>
			</div>
		
			<div class="agile-form">
				<form action="" method="post">
				<div class="row">
                    <div class="col-md-12">
						 
                    <label class="form-label" style="align:left;"> Full Name 
								<span class="form-required"> * </span>
						</label>
						<div class="form-input" style="align:left;"><?=$udtl['user_name']?></div>
					</div>
					<br/>
					 <div class="col-md-12">
						 
                    <label class="form-label" style="align:left;"> Email
								<span class="form-required" > * </span>
						</label>
						<div class="form-input" style="align:left;"><?=$udtl['email']?></div>
					</div>
					<br/>
					<div class="col-md-12">
						 
                    <label class="form-label" style="align:left;"> DOB
								<span class="form-required"> * </span>
						</label>
						<div class="form-input" style="align:left;"><?=$udtl['dob']?></div>
					</div>
					<br/>
				<div class="col-md-12">
						 
                    <label class="form-label" style="align:left;"> Address
								<span class="form-required"> * </span>
						</label>
						<div class="form-input" style="align:left;"><?=$udtl['street_address']?></div>
					</div>
					<br/>
				
				</form>	
			</div>
		</div>
		</div>
		<!---728x90--->
		
	</div>

		</div>

	</div>
<div class="copyright">
		<p>© 2017 Choose My Panchayatraj Form. All rights reserved | Design by <a href="www.w3layouts.com">W3layouts</a></p> 
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>

		$(function () {

			var links = $('.sidebar-links > a');

			links.on('click', function () {

				links.removeClass('selected');
				$(this).addClass('selected');

			})
		});

	</script>
	<script>
	function valtimeslot(id)
	{
		var time='';
		$('#show_err').load('checktime.php?id='+id+'&time='+time);
	}
	function user_pg(page,id){
		if(page==1)
		{
				$('#show_login').load('adduser.php?id='+id);}
				if(page==2)
				{
					$('#show_login').load('viewproblem.php');
				}
					if(page==3)
				{
					$('#show_login').load('viewuser.php');
				}
				
				if(page==4)
				{
					$('#show_login').load('logout.php');
				}	
				
		}
		function showpanchayatraj(id)
		{
			$('#show_pannm').load('show_pan.php?id='+id);
			
		}
		
		</script>
		

</body>

</html>
