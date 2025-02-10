<?php
include("adheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
			$sql ="UPDATE panchayatraj SET panchayatrajname='$_POST[panchayatrajname]',mobileno='$_POST[mobilenumber]',departmentid='$_POST[select3]',loginid='$_POST[loginid]',password='$_POST[password]',status='$_POST[select]' WHERE panchayatrajid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('panchayatraj record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$sql ="INSERT INTO panchayatraj(panchayatrajname,mobileno,departmentid,loginid,password,status) values('$_POST[panchayatrajname]','$_POST[mobilenumber]','$_POST[select3]','$_POST[loginid]','$_POST[password]','Active')";
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
if(isset($_GET['editid']))
{
	$sql="SELECT * FROM panchayatraj WHERE panchayatrajid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>

<div class="container-fluid">
	<div class="block-header">
		<h2 class="text-center"> Add New PanchayatRaj </h2>
	</div>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">


				<form method="post" action="" name="frmvol" onSubmit="return validateform()" style="padding: 10px">


					
					<div class="form-group"><label>PanchayatRaj Name</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="panchayatrajname" id="panchayatrajname" value="<?php echo $rsedit['panchayatrajname']; ?>" />
				</div>
				</div>


					<div class="form-group"><label>Mobile Number</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="mobilenumber" id="mobilenumber" value="<?php echo $rsedit['mobileno']; ?>"/>
				</div>
				</div>


					<div class="form-group"><label>Department</label> 
						<div class="form-line">
					<select  name="select3" id="select3" class="form-control show-tick">
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

					<div class="form-group"><label>Login ID</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="loginid" id="loginid" value="<?php echo $rsedit['loginid']; ?>"/>
				</div>
				</div>


					<div class="form-group"><label>Password</label> 
					<div class="form-line">
					<input class="form-control" type="password" name="password" id="password" value="<?php echo $rsedit['password']; ?>"/>
				</div>
				</div>


					<div class="form-group"><label>Confirm Password</label> 
					<div class="form-line">
					<input class="form-control" type="password" name="cnfirmpassword" id="cnfirmpassword" value="<?php echo $rsedit['password']; ?>"/>
				</div>
				</div>


					


					

					<div class="form-group">
					<label>Status</label> 
					<div class="form-line">
					<select class="form-control show-tick" name="select" id="select">
						<option value="" selected="" hidden>Select</option>
						<?php
						$arr= array("Active","Inactive");
						foreach($arr as $val)
						{
							if($val == $rsedit['status'])
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


					
					<input class="btn btn-default" type="submit" name="submit" id="submit" value="Submit" />
				


				</form>
			</div>
		</div>
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

function validateform()
{
	if(document.frmpan.panchayatrajname.value == "")
	{
		alert("PanchayatRaj name should not be empty..");
		document.frmpan.panchayatrajname.focus();
		return false;
	}
	else if(!document.frmpan.panchayatrajname.value.match(alphaspaceExp))
	{
		alert("PanchayatRaj name not valid..");
		document.frmpan.panchayatrajname.focus();
		return false;
	}
	else if(document.frmpan.mobilenumber.value == "")
	{
		alert("Mobile number should not be empty..");
		document.frmpan.mobilenumber.focus();
		return false;
	}
	else if(!document.frmpan.mobilenumber.value.match(numericExpression))
	{
		alert("Mobile number not valid..");
		document.frmpan.mobilenumber.focus();
		return false;
	}
	else if(document.frmpan.select3.value == "")
	{
		alert("Department ID should not be empty..");
		document.frmpan.select3.focus();
		return false;
	}
	else if(document.frmpan.loginid.value == "")
	{
		alert("loginid should not be empty..");
		document.frmpan.loginid.focus();
		return false;
	}
	else if(!document.frmpan.loginid.value.match(alphanumericExp))
	{
		alert("loginid not valid..");
		document.frmpan.loginid.focus();
		return false;
	}
	else if(document.frmpan.password.value == "")
	{
		alert("Password should not be empty..");
		document.frmpan.password.focus();
		return false;
	}
	else if(document.frmpan.password.value.length < 8)
	{
		alert("Password length should be more than 8 characters...");
		document.frmpan.password.focus();
		return false;
	}
	else if(document.frmpan.password.value != document.frmpan.cnfirmpassword.value )
	{
		alert("Password and confirm password should be equal..");
		document.frmpan.password.focus();
		return false;
	}
	
	else if(document.frmpan.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmpan.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>