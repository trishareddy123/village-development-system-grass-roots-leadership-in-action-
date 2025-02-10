<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE user SET username='$_POST[username]',admissiondate='$_POST[admissiondate]',admissiontime='$_POST[admissiontme]',address='$_POST[address]',mobileno='$_POST[mobilenumber]',city='$_POST[city]',pincode='$_POST[pincode]',loginid='$_POST[loginid]',password='$_POST[password]',bloodgroup='$_POST[select2]',gender='$_POST[select3]',dob='$_POST[dateofbirth]',status='$_POST[select]' WHERE userid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('user record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
		$sql ="INSERT INTO user(username,admissiondate,admissiontime,address,mobileno,city,pincode,loginid,password,bloodgroup,gender,dob,status) values('$_POST[username]','$dt','$tim','$_POST[address]','$_POST[mobilenumber]','$_POST[city]','$_POST[pincode]','$_POST[loginid]','$_POST[password]','$_POST[select2]','$_POST[select3]','$_POST[dateofbirth]','Active')";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('users record inserted successfully...');</script>";
			$insid= mysqli_insert_id($con);
			if(isset($_SESSION['adminid']))
			{
				echo "<script>window.location='problem.php?usrid=$insid';</script>";	
			}
			else
			{
				echo "<script>window.location='userlogin.php';</script>";	
			}		
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET['editid']))
{
	$sql="SELECT * FROM user WHERE userid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>


<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">User Registration Panel</h2>

    </div>
    <div class="card">

        <form method="post" action="" name="frmuser" onSubmit="return validateform()" style="padding: 10px">



            <div class="form-group"><label>User Name</label>
                <div class="form-line">
                    <input class="form-control" type="text" name="username" id="username"
                        value="<?php echo $rsedit['username']; ?>" />
                </div>
            </div>

            <?php
			if(isset($_GET['editid']))
			{
				?>

            <div class="form-group"><label>Admission Date</label>
                <div class="form-line">
                    <input class="form-control" type="date" name="admissiondate" id="admissiondate"
                        value="<?php echo $rsedit['admissiondate']; ?>" readonly />
                </div>
            </div>


            <div class="form-group"><label>Admission Time</label>
                <div class="form-line">
                    <input class="form-control" type="time" name="admissiontme" id="admissiontme"
                        value="<?php echo $rsedit['admissiontime']; ?>" readonly />
                </div>
            </div>

            <?php
			}
			?>
            <div class="form-group">
                <label>Address</label>
                <div class="form-line">
                    <input class="form-control " name="address" id="tinymce" value="<?php echo $rsedit['address']; ?>">
                </div>
            </div>

            <div class="form-group"><label>Mobile Number</label>
                <div class="form-line">
                    <input class="form-control" type="text" name="mobilenumber" id="mobilenumber"
                        value="<?php echo $rsedit['mobileno']; ?>" />
                </div>
            </div>


            <div class="form-group"><label>City</label>
                <div class="form-line">
                    <input class="form-control" type="text" name="city" id="city"
                        value="<?php echo $rsedit['city']; ?>" />
                </div>
            </div>


            <div class="form-group"><label>PIN Code</label>
                <div class="form-line">
                    <input class="form-control" type="text" name="pincode" id="pincode"
                        value="<?php echo $rsedit['pincode']; ?>" />
                </div>
            </div>


            <div class="form-group"><label>Login ID</label>
                <div class="form-line">
                    <input class="form-control" type="text" name="loginid" id="loginid"
                        value="<?php echo $rsedit['loginid']; ?>" />
                </div>
            </div>


            <div class="form-group"><label>Password</label>
                <div class="form-line">
                    <input class="form-control" type="password" name="password" id="password"
                        value="<?php echo $rsedit['password']; ?>" />
                </div>
            </div>


            <div class="form-group"><label>Confirm Password</label>
                <div class="form-line">
                    <input class="form-control" type="password" name="confirmpassword" id="confirmpassword"
                        value="<?php echo $rsedit['confirmpassword']; ?>" />
                </div>
            </div>


            <div class="form-group"><label>Blood Group</label>
                <div class="form-line"><select class="form-control show-tick" name="select2" id="select2">
                        <option value="">Select</option>
                        <?php
					$arr = array("A+","A-","B+","B-","O+","O-","AB+","AB-");
					foreach($arr as $val)
					{
						if($val == $rsedit['bloodgroup'])
						{
							echo "<option value='$val' selected>$val</option>";
						}
						else
						{
							echo "<option value='$val'>$val</option>";			  
						}
					}
					?>
                    </select>
                </div>
            </div>


            <div class="form-group"><label>Gender</label>
                <div class="form-line"><select class="form-control show-tick" name="select3" id="select3">
                        <option value="">Select</option>
                        <?php
				$arr = array("MALE","FEMALE");
				foreach($arr as $val)
				{
					if($val == $rsedit['gender'])
					{
						echo "<option value='$val' selected>$val</option>";
					}
					else
					{
						echo "<option value='$val'>$val</option>";			  
					}
				}
				?>
                    </select>
                </div>
            </div>


            <div class="form-group"><label>Date Of Birth</label>
                <div class="form-line">
                    <input class="form-control" type="date" name="dateofbirth" max="<?php echo date("Y-m-d"); ?>"
                        id="dateofbirth" value="<?php echo $rsedit['dob']; ?>" />
                </div>
            </div>





            <input class="btn btn-default" type="submit" name="submit" id="submit" value="Submit" />




        </form>
        <p>&nbsp;</p>
    </div>
</div>
</div>
<div class="clear"></div>
</div>
</div>
<?php
include("adformfooter.php");
?>
<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform() {
    if (document.frmuser.username.value == "") {
        alert("User name should not be empty..");
        document.frmuser.username.focus();
        return false;
    } else if (!document.frmuser.username.value.match(alphaspaceExp)) {
        alert("User name not valid..");
        document.frmuser.username.focus();
        return false;
    } else if (document.frmuser.admissiondate.value == "") {
        alert("Admission date should not be empty..");
        document.frmuser.admissiondate.focus();
        return false;
    } else if (document.frmuser.admissiontme.value == "") {
        alert("Admission time should not be empty..");
        document.frmuser.admissiontme.focus();
        return false;
    } else if (document.frmuser.address.value == "") {
        alert("Address should not be empty..");
        document.frmuser.address.focus();
        return false;
    } else if (document.frmuser.mobilenumber.value == "") {
        alert("Mobile number should not be empty..");
        document.frmuser.mobilenumber.focus();
        return false;
    } else if (!document.frmuser.mobilenumber.value.match(numericExpression)) {
        alert("Mobile number not valid..");
        document.frmuser.mobilenumber.focus();
        return false;
    } else if (document.frmuser.city.value == "") {
        alert("City should not be empty..");
        document.frmuser.city.focus();
        return false;
    } else if (!document.frmuser.city.value.match(alphaspaceExp)) {
        alert("City not valid..");
        document.frmuser.city.focus();
        return false;
    } else if (document.frmuser.pincode.value == "") {
        alert("Pincode should not be empty..");
        document.frmuser.pincode.focus();
        return false;
    } else if (!document.frmuser.pincode.value.match(numericExpression)) {
        alert("Pincode not valid..");
        document.frmuser.pincode.focus();
        return false;
    } else if (document.frmuser.loginid.value == "") {
        alert("Login ID should not be empty..");
        document.frmuser.loginid.focus();
        return false;
    } else if (!document.frmuser.loginid.value.match(alphanumericExp)) {
        alert("Login ID not valid..");
        document.frmuser.loginid.focus();
        return false;
    } else if (document.frmuser.password.value == "") {
        alert("Password should not be empty..");
        document.frmuser.password.focus();
        return false;
    } else if (document.frmuser.password.value.length < 8) {
        alert("Password length should be more than 8 characters...");
        document.frmuser.password.focus();
        return false;
    } else if (document.frmuser.password.value != document.frmuser.confirmpassword.value) {
        alert("Password and confirm password should be equal..");
        document.frmuser.confirmpassword.focus();
        return false;
    } else if (document.frmuser.select2.value == "") {
        alert("Blood Group should not be empty..");
        document.frmuser.select2.focus();
        return false;
    } else if (document.frmuser.select3.value == "") {
        alert("Gender should not be empty..");
        document.frmuser.select3.focus();
        return false;
    } else if (document.frmuser.dateofbirth.value == "") {
        alert("Date Of Birth should not be empty..");
        document.frmuser.dateofbirth.focus();
        return false;
    } else if (document.frmuser.select.value == "") {
        alert("Kindly select the status..");
        document.frmuser.select.focus();
        return false;
    } else {
        return true;
    }
}
</script>