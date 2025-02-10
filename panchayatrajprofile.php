<?php
include("adheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
	if(isset($_SESSION['panchayatrajid']))
	{
		$sql ="UPDATE panchayatraj SET panchayatrajname='$_POST[panchayatrajname]',mobileno='$_POST[mobilenumber]',departmentid='$_POST[select3]',loginid='$_POST[loginid]' WHERE panchayatrajid='$_SESSION[panchayatrajid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('PanchayatRaj profile updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
        }
	}
	else
	{
		$sql ="INSERT INTO panchayatraj(panchayatrajname,mobileno,departmentid,loginid,password,status) values('$_POST[panchayatrajname]','$_POST[mobilenumber]','$_POST[select3]','$_POST[loginid]','$_POST[password]','$_POST[select]')";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('PanchayatRaj record inserted successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_SESSION['panchayatrajid']))
{
	$sql="SELECT * FROM panchayatraj WHERE panchayatrajid='$_SESSION[panchayatrajid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>
<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center"> PanchayatRaj's Profile</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">

                <form method="post" action="" name="frmpanprfl" onSubmit="return validateform()" style="padding: 10px">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>PanchayatRaj Name</label>
                                <div class="form-line">
                                    <input class="form-control" type="text" name="panchayatrajname" id="panchayatrajname"
                                        value="<?php echo $rsedit['panchayatrajname']; ?>" />
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
                        
                        <div class="col-sm-4 col-xs-12">
                            
                                
                            

                            <input class="btn btn-raised" type="submit" name="submit" id="submit" value="Submit" />
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
    if (document.frmpanprfl.panchayatrajname.value == "") {
        alert("PanchayatRaj name should not be empty..");
        document.frmpanprfl.panchayatrajname.focus();
        return false;
    } else if (!document.frmpanprfl.panchayatrajname.value.match(alphaspaceExp)) {
        alert("PanchayatRaj name not valid..");
        document.frmpanprfl.panchayatrajname.focus();
        return false;
    } else if (document.frmpanprfl.mobilenumber.value == "") {
        alert("Mobile number should not be empty..");
        document.frmpanprfl.mobilenumber.focus();
        return false;
    } else if (!document.frmpanprfl.mobilenumber.value.match(numericExpression)) {
        alert("Mobile number not valid..");
        document.frmpanprfl.mobilenumber.focus();
        return false;
    } else if (document.frmpanprfl.select3.value == "") {
        alert("Department ID should not be empty..");
        document.frmpanprfl.select3.focus();
        return false;
    } else if (document.frmpanprfl.loginid.value == "") {
        alert("Login ID should not be empty..");
        document.frmpanprfl.loginid.focus();
        return false;
    } else if (!document.frmpanprfl.loginid.value.match(alphanumericExp)) {
        alert("loginid not valid..");
        document.frmpanprfl.loginid.focus();
        return false;
    } else if (document.frmpanprfl.password.value == "") {
        alert("Password should not be empty..");
        document.frmpanprfl.password.focus();
        return false;
    } else if (document.frmpanprfl.password.value.length < 8) {
        alert("Password length should be more than 8 characters...");
        document.frmpanprfl.password.focus();
        return false;
    } else if (document.frmpanprfl.password.value != document.frmpanprfl.cnfirmpassword.value) {
        alert("Password and confirm password should be equal..");
        document.frmpanprfl.password.focus();
        return false;
    
    } else if (document.frmpanprfl.select.value == "") {
        alert("Kindly select the status..");
        document.frmpanprfl.select.focus();
        return false;
    } else {
        return true;
    }
}
</script>