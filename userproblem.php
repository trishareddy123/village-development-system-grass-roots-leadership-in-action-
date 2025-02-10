<?php
include("header.php");
include("dbconnection.php");
session_start();
if(isset($_POST['submit']))
{  
	if(isset($_SESSION['userid']))
	{
		$lastinsid =$_SESSION['userid'];
	}
	else
	{
		$dt = date("Y-m-d");
		$tim = date("H:i:s");
		$sql ="INSERT INTO user(username,admissiondate,admissiontime,address,city,mobileno,loginid,password,gender,dob,status) values('$_POST[usere]','$dt','$tim','$_POST[textarea]','$_POST[city]','$_POST[mobileno]','$_POST[loginid]','$_POST[password]','$_POST[select6]','$_POST[dob]','Active')";
		if($qsql = mysqli_query($con,$sql))
		{
			 echo "<script>alert('user record inserted successfully...');</script>"; 
		}
		else
		{
			echo mysqli_error($con);
		}
		$lastinsid = mysqli_insert_id($con);
	}
	
	$sqlproblem="SELECT * FROM problem WHERE date='$_POST[date]' AND time='$_POST[time]' AND volunteerid='$_POST[vol]'AND panchayatrajid='$_POST[pan]' AND status='Approved'";
	$qsqlproblem = mysqli_query($con,$sqlproblem);
	if(mysqli_num_rows($qsqlproblem) >= 1)
	{
		echo "<script>alert('Problem already scheduled for this time..');</script>";
	}
	else
	{
		$sql ="INSERT INTO problem(type,problemid,date,time,pro_reason,status,departmentid,volunteerid,panchayatrajid) values('ONLINE','$lastinsid','$_POST[date]','$_POST[time]','$_POST[pro_reason]','Pending','$_POST[department]','$_POST[vol]','$_POST[pan]')";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Problem record inserted successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET['editid']))
{
	$sql="SELECT * FROM problem WHERE problemid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
if(isset($_SESSION['userid']))
{
    $sqluser = "SELECT * FROM user WHERE userid=18 ";
    $qsqluser = mysqli_query($con,$sqluser);
    $rsuser = mysqli_fetch_array($qsqluser);
    $readonly = " readonly";
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div class="wrapper col4">
    <div id="container">

        <?php
        if(isset($_POST['submit']))
        {
           if(mysqli_num_rows($qsqlproblem) >= 1)
           {		
             echo "<h2>Problem already scheduled for ". date("d-M-Y", strtotime($_POST['date'])) . " " . date("H:i A", strtotime($_POST['time'])) . " .. </h2>";
         }
         else
         {
          if(isset($_SESSION['userid']))
          {
             echo "<h2 class='text-center'>Problem taken successfully.. </h2>";
             echo "<p class='text-center'>Problem record is in pending process. Kindly check the problem status. </p>";
             echo "<p class='text-center'> <a href='viewproblem.php'>View Problem record</a>. </p>";			
         }
         else
         {
             echo "<h2 class='text-center'>Problem taken successfully.. </h2>";
             echo "<p class='text-center'>Problem record is in pending process. Please wait for confirmation message.. </p>";
             echo "<p class='text-center'> <a href='userlogin.php'>Click here to Login</a>. </p>";	
         }
     }
 }
 else
 {
   ?>
        <!-- Content -->
        <div id="content">



            <!-- Tell the Problem -->
            <section class="main-oppoiment " style="background-image:url('images/problem.jpg');background-repeat: no-repeat;background-size: 75%;" >
                <div class="container">
                    <div class="row">

                        <!-- Tell the Problem -->
                        <div class="col-lg-7">
                            <div class="problem">

                                <!-- Heading -->
                                <div class="heading-block head-left margin-bottom-50">
                                    <h4 style="color:black;font-weight:500;">Tell the Problem</h4>
                                    
                                </div>
                                <form method="post" action="" name="frmuserapp" onSubmit="return validateform()"
                                    class="problem-form">
                                    <ul class="row">
                                        <li class="col-sm-6">
                                            <label>


                                                <input placeholder="User's Name" type="text" class="form-control"
                                                    name="usere" id="usere"
                                                    value="<?php echo $rsuser['username'];  ?>"
                                                    <?php echo $readonly; ?>>
                                                <i class="icon-user"></i>
                                            </label>

                                        </li>

                                        <li class="col-sm-6">
                                            <label><input placeholder="Address" type="text" class="form-control"
                                                    name="textarea" id="textarea"
                                                    value="<?php echo $rsuser['address'];  ?>"
                                                    <?php echo $readonly; ?>><i class="icon-compass"></i>
                                            </label>

                                        </li>
                                        <li class="col-sm-6">
                                            <label><input placeholder="City" type="text" class="form-control"
                                                    name="city" id="city" value="<?php echo $rsuser['city'];  ?>"
                                                    <?php echo $readonly; ?>><i class="icon-pin"></i>
                                            </label>

                                        </li>
                                        <li class="col-sm-6">
                                            <label>
                                                <input placeholder="Contact Number" type="text" class="form-control"
                                                    name="mobileno" id="mobileno"
                                                    value="<?php echo $rsuser['mobileno'];  ?>"
                                                    <?php echo $readonly; ?>><i class="icon-phone"></i>
                                            </label>

                                        </li>
                                        <?php
                            if(!isset($_SESSION['userid']))
                            {        
                                ?>
                                        <li class="col-sm-6">
                                            <label>
                                                <input placeholder="Login ID" type="email" class="form-control"
                                                    name="loginid" id="loginid"
                                                    value="<?php echo $rsuser['loginid'];  ?>"
                                                    <?php echo $readonly; ?>><i class="icon-login"></i>
                                            </label>

                                        </li>
                                        <li class="col-sm-6">
                                            <label>

                                                <input placeholder="Password" type="password" class="form-control"
                                                    name="password" id="password"
                                                    value="<?php echo $rsuser['password'];  ?>"
                                                    <?php echo $readonly; ?>><i class="icon-lock"></i>
                                            </label>

                                        </li>
                                        <?php
                            }
                            ?>
                                        <li class="col-sm-6">
                                            <label>

                                                <?php 
                                    if(isset($_SESSION['userid']))
                                    {
                                       echo $rsuser['gender'];
                                   }
                                   else
                                   {
                                    ?>
                                                <select name="select6" id="select6" class="selectpicker">
                                                    <option value="" selected="" hidden="" value="<?php echo $rsuser['gender']?>">Select Gender</option>
                                                    <?php
                                        $arr = array("Male","Female");
                                        foreach($arr as $val)
                                        {
                                            echo "<option value='$val'>$val</option>";
                                        }
                                        ?>
                                                </select>
                                                <?php
                                }
                                ?>
                                             

                                        </li>
                                        <li class="col-sm-6">
                                            <label>
                                                <input placeholder="Date of birth" type="text" class="form-control"
                                                    name="dob" id="dob" onfocus="(this.type='date')"
                                                    value="<?php echo $rsuser['dob']; ?>" <?php echo $readonly; ?> max="<?php echo date("Y-m-d"); ?>"><i
                                                    class="ion-calendar"></i>
                                            </label>

                                        </li>
                                        <li class="col-sm-6">
                                            <label>
                                                <input placeholder=" Date" type="text" class="form-control"
                                                    min="<?php echo date("Y-m-d"); ?>" name="date"
                                                    onfocus="(this.type='date')" id="date"><i
                                                    class="ion-calendar"></i>
                                            </label>

                                        </li>
                                        <li class="col-sm-6">
                                            <label>
                                                <input placeholder=" Time" type="text"
                                                    onfocus="(this.type='time')" class="form-control"
                                                    name="time" id="time"><i
                                                    class="ion-ios-clock"></i>
                                            </label>

                                        </li>
                                        <li class="col-sm-6">
                                            <label>

                                                <select name="department" class="selectpicker" id="department"
                                                    >
                                                    <option value="">Select Department</option>
                                                    <?php
                                $sqldept = "SELECT * FROM department WHERE status='Active'";
                                $qsqldept = mysqli_query($con,$sqldept);
                                while($rsdept = mysqli_fetch_array($qsqldept))
                                {
                                 echo "<option value='$rsdept[departmentid]'>$rsdept[departmentname]</option>";
                             }
                             ?>
                                                </select>
                                                <i class="ion-university"></i>
                                            </label>

                                        </li>
                                        <li class="col-sm-6">
                                            <label>
                                                <select name="vol" class="selectpicker" id="department"
                                                    >
                                                    <option value="">Select Volunteer</option>
                                                    <?php
                                                    $sqldept = "SELECT * FROM volunteer WHERE status='Active'";
                                                    $qsqldept = mysqli_query($con,$sqldept);
                                                    while($rsdept = mysqli_fetch_array($qsqldept))
                                                    {
                                                        echo "<option value='$rsdept[volunteerid]'>$rsdept[volunteername] (";
                                                        $sqldept = "SELECT * FROM department WHERE departmentid='$rsdept[departmentid]'";
                                                        $qsqldepta = mysqli_query($con,$sqldept);
                                                        $rsdept = mysqli_fetch_array($qsqldepta);
                                                        echo $rsdept['departmentname'];

                                                        echo ")</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <i class="ion-medkit"></i>

                                            </label>

                                        </li>
                                        <li class="col-sm-6">
                                            <label>
                                                <select name="pan" class="selectpicker" id="department"
                                                    >
                                                    <option value="">Select PanchayatRaj</option>
                                                    <?php
                                                    $sqldept = "SELECT * FROM panchayatraj WHERE status='Active'";
                                                    $qsqldept = mysqli_query($con,$sqldept);
                                                    while($rsdept = mysqli_fetch_array($qsqldept))
                                                    {
                                                        echo "<option value='$rsdept[panchayatrajid]'>$rsdept[panchayatrajname] (";
                                                        $sqldept = "SELECT * FROM department WHERE departmentid='$rsdept[departmentid]'";
                                                        $qsqldepta = mysqli_query($con,$sqldept);
                                                        $rsdept = mysqli_fetch_array($qsqldepta);
                                                        echo $rsdept['departmentname'];

                                                        echo ")</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <i class="ion-medkit"></i>

                                            </label>

                                        </li>
                                        <li class="col-sm-12">
                                            <label>
                                                <textarea class="form-control" name="pro_reason"
                                                    placeholder="Problem reason"></textarea>
                                            </label>
                                        </li>
                                        <li class="col-sm-12">
                                            <button type="submit" class="btn" name="submit" id="submit">tell the
                                                problem</button>
                                        </li>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <?php
}
?>

        </div>
    </div>
</div>
</section>
</div>



<?php
include("footer.php");
?>
<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform() {
    if (document.frmuserpro.usere.value == "") {
        alert("User name should not be empty..");
        document.frmuserpro.usere.focus();
        return false;
    } else if (!document.frmuserpro.usere.value.match(alphaspaceExp)) {
        alert("User name not valid..");
        document.frmuserpro.usere.focus();
        return false;
    } else if (document.frmuserpro.textarea.value == "") {
        alert("Address should not be empty..");
        document.frmuserpro.textarea.focus();
        return false;
    } else if (document.frmuserpro.city.value == "") {
        alert("City should not be empty..");
        document.frmuserpro.city.focus();
        return false;
    } else if (!document.frmuserpro.city.value.match(alphaspaceExp)) {
        alert("City name not valid..");
        document.frmuserpro.city.focus();
        return false;
    } else if (document.frmuserpro.mobileno.value == "") {
        alert("Mobile number should not be empty..");
        document.frmuserpro.mobileno.focus();
        return false;
    } else if (!document.frmuserpro.mobileno.value.match(numericExpression)) {
        alert("Mobile number not valid..");
        document.frmuserpro.mobileno.focus();
        return false;
    } else if (document.frmuserpro.loginid.value == "") {
        alert("login ID should not be empty..");
        document.frmuserpro.loginid.focus();
        return false;
    } else if (!document.frmuserpro.loginid.value.match(emailExp)) {
        alert("login ID not valid..");
        document.frmuserpro.loginid.focus();
        return false;
    } else if (document.frmuserpro.password.value == "") {
        alert("Password should not be empty..");
        document.frmuserpro.password.focus();
        return false;
    } else if (document.frmuserpro.password.value.length < 8) {
        alert("Password length should be more than 8 characters...");
        document.frmuserpro.password.focus();
        return false;
    } else if (document.frmuserpro.select6.value == "") {
        alert("Gender should not be empty..");
        document.frmuserpro.select6.focus();
        return false;
    } else if (document.frmuserpro.dob.value == "") {
        alert("Date Of Birth should not be empty..");
        document.frmuserpro.dob.focus();
        return false;
    } else if (document.frmuserpro.date.value == "") {
        alert(" date should not be empty..");
        document.frmuserpro.date.focus();
        return false;
    } else if (document.frmuserpro.time.value == "") {
        alert(" time should not be empty..");
        document.frmuserpro.time.focus();
        return false;
    } else {
        return true;
    }
}

function loadvolunteer(deptid) {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("divdoc").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "departmentVolunteer.php?deptid=" + deptid, true);
    xmlhttp.send();
}
function loadpanchayatraj(deptid) {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("divdoc").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "departmentPanchayatRaj.php?deptid=" + deptid, true);
    xmlhttp.send();
}
</script>         