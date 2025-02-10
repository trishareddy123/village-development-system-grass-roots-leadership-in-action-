<?php
include("adheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
	if(isset($_SESSION['volunteerid']))
	{
		$sql ="UPDATE volunteer SET volunteername='$_POST[volunteername]',mobileno='$_POST[mobilenumber]',departmentid='$_POST[select3]',loginid='$_POST[loginid]' WHERE volunteerid='$_SESSION[volunteerid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Volunteer profile updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
        }
	}
	else
	{
		$sql ="INSERT INTO volunteer(volunteername,mobileno,departmentid,loginid,password,status) values('$_POST[volunteername]','$_POST[mobilenumber]','$_POST[select3]','$_POST[loginid]','$_POST[password]','$_POST[select]')";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Volunteer record inserted successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_SESSION['volunteerid']))
{
	$sql="SELECT * FROM volunteer WHERE volunteerid='$_SESSION[volunteerid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>
<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center"> Volunteer's Profile</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">

                <form method="post" action="" name="frmvolprfl" onSubmit="return validateform()" style="padding: 10px">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Volunteer Name</label>
                                <div class="form-line">
                                    <input class="form-control" type="text" name="volunteername" id="volunteername"
                                        value="<?php echo $rsedit['volunteername']; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <div class="form-line">
                                    <input class="form-control" type="text" name="mobilenumber" id="mobilenumber"
                                        value="<?php echo $rsedit['mobileno']; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Department</label>
                                <div class="form-line">
                                    <select name="select3" id="select3" class="form-control show-tick">
                                        <option value="">Select</option>
                                        <?php
													$sqldepartment= "SELECT * FROM department WHERE status='Active'";
													$qsqldepartment = mysqli_query($con,$sqldepartment);
													while($rsdepartment=mysqli_fetch_array($qsqldepartment))
													{
														if($rsdepartment['departmentid'] == $rsedit['departmentid'])
														{
															echo "<option value='$rsdepartment[departmentid]' selected>$rsdepartment[departmentname]</option>";
														}
														else
														{
															echo "<option value='$rsdepartment[departmentid]'>$rsdepartment[departmentname]</option>";
														}

													}
													?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Login ID</label>
                                <div class="form-line">
                                    <input class="form-control" type="text" name="loginid" id="loginid"
                                        value="<?php echo $rsedit['loginid']; ?>" />
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>

                </form>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
</div>
<?php
												include("adfooter.php");
												?>
<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform() {
    if (document.frmvolprfl.volunteername.value == "") {
        alert("Volunteer name should not be empty..");
        document.frmvolprfl.volunteername.focus();
        return false;
    } else if (!document.frmvolprfl.volunteername.value.match(alphaspaceExp)) {
        alert("Volunteer name not valid..");
        document.frmvolprfl.volunteername.focus();
        return false;
    } else if (document.frmvolprfl.mobilenumber.value == "") {
        alert("Mobile number should not be empty..");
        document.frmvolprfl.mobilenumber.focus();
        return false;
    } else if (!document.frmvolprfl.mobilenumber.value.match(numericExpression)) {
        alert("Mobile number not valid..");
        document.frmvolprfl.mobilenumber.focus();
        return false;
    } else if (document.frmvolprfl.select3.value == "") {
        alert("Department ID should not be empty..");
        document.frmvolprfl.select3.focus();
        return false;
    } else if (document.frmvolprfl.loginid.value == "") {
        alert("Login ID should not be empty..");
        document.frmvolprfl.loginid.focus();
        return false;
    } else if (!document.frmvolprfl.loginid.value.match(alphanumericExp)) {
        alert("loginid not valid..");
        document.frmvolprfl.loginid.focus();
        return false;
    } else if (document.frmvolprfl.password.value == "") {
        alert("Password should not be empty..");
        document.frmvolprfl.password.focus();
        return false;
    } else if (document.frmvolprfl.password.value.length < 8) {
        alert("Password length should be more than 8 characters...");
        document.frmvolprfl.password.focus();
        return false;
    } else if (document.frmvolprfl.password.value != document.frmvolprfl.cnfirmpassword.value) {
        alert("Password and confirm password should be equal..");
        document.frmvolprfl.password.focus();
        return false;
    
    } else if (document.frmvolprfl.select.value == "") {
        alert("Kindly select the status..");
        document.frmvolprfl.select.focus();
        return false;
    } else {
        return true;
    }
}
</script>