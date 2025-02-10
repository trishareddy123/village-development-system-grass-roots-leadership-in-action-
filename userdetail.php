<?php
include("dbconnection.php");
if(isset($_POST['submitusr']))
{
	$sql ="INSERT INTO user(username,admissiondate,admissiontime,address,mobileno,gender,dob) values('$_POST[username]','$_POST[admissiondate]','$_POST[admissiontime]','$_POST[address]','$_POST[mobilenumber]','$_POST[select]','$_POST[dateofbirth]')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('users record inserted successfully...');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}

if(isset($_GET['editid']))
{
	$sql="SELECT * FROM user WHERE userid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>
<?php
if(!isset($_GET['userid']))
{
?>
<div class="container-fluid">
        <div class="block-header">
            <h2>Tell the Problem</h2>
            
        </div>
        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					
					<div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="username" id="username"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="userid" id="userid" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea name="address" id="address" cols="45" rows="5"> </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <div class="form-group drop-custum">
                                    <select class="form-control show-tick">
                                        <option value="">-- Gender --</option>
                                        <option value="10">Male</option>
                                        <option value="20">Female</option>
                                    </select>
                                </div>
                            </div>
                         
                            <div class="col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="mobilenumber" id="mobilenumber"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" name="dateofbirth" id="dateofbirth" />
                                    </div>
                                </div>
                            </div>
                    
                            <div class="col-sm-12">
                                <input type="submit" class="btn btn-raised" name="submitusr" id="submitusr" value="Submit" />
                                
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
    </div>
<form method="post" action="" name="frmusrdet" onSubmit="return validateform()">
      <table class="table table-bordered table-striped">
      <tbody>
     <tr>
                <td width="17%"><strong>User Name </strong></td>
                <td width="41%"><input type="text" name="username" id="username"/></td>
                <td width="16%"><strong>User ID</strong></td>
                <td width="26%"><input type="text" name="userid" id="userid" /></td>
        </tr>
              <tr>
                <td><strong>Address</strong></td>
                <td align="right"><textarea name="address" id="address" cols="45" rows="5"> </textarea></td>
                <td><strong>Gender</strong></td>
                <td><label for="select"></label>
                  <select name="select" id="select">
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select></td>
              </tr>
              <tr>
                <td><strong>Contact Number</strong></td>
                <td><input type="text" name="mobilenumber" id="mobilenumber"/></td>
                <td><strong>Date Of Birth </strong></td>
                <td><input type="date" name="dateofbirth" id="dateofbirth" /></td>
              </tr>
              <tr>
                <td colspan="4" align="center"><input type="submit" name="submitusr" id="submitusr" value="Submit" /></td>
              </tr>
        </tbody>
  </table>       
    </form>
<?php
}
else
{
$sqluser = "SELECT * FROM user where userid='$_GET[userid]'";
$qsqluser = mysqli_query($con,$sqluser);
$rsuser=mysqli_fetch_array($qsqluser);
?>

    <table class="table table-bordered table-striped">
      <tbody>
        <tr>
          <td width="16%"><strong>User Name </strong></td>
          <td width="34%">&nbsp;<?php echo $rsuser['username']; ?></td>
          <td width="16%"><strong>User ID</strong></td>
          <td width="34%">&nbsp;<?php echo $rsuser['userid']; ?></td>
        </tr>
        <tr>
          <td><strong>Address</strong></td>
          <td>&nbsp;<?php echo $rsuser['address']; ?></td>
          <td><strong>Gender</strong></td>
          <td> <?php echo $rsuser['gender'];?></td>
        </tr>
        <tr>
          <td><strong>Contact Number</strong></td>
          <td>&nbsp;<?php echo $rsuser['mobileno']; ?></td>
          <td><strong>Date Of Birth </strong></td>
          <td>&nbsp;<?php echo $rsuser['dob']; ?></td>
        </tr>
      </tbody>
    </table>
<?php
}

?>


<script type="application/javascript">
function validateform()
{
	if(document.frmuserdet.username.value == "")
	{
		alert("User name should not be empty..");
		document.frmuserdet.username.focus();
		return false;
	}
	else if(document.frmuserdet.userid.value == "")
	{
		alert("User ID should not be empty..");
		document.frmuserdet.userid.focus();
		return false;
	}
	else if(document.frmuserdet.admissiondate.value == "")
	{
		alert("Admission date should not be empty..");
		document.frmuserdet.admissiondate.focus();
		return false;
	}
	else if(document.frmuserdet.admissiontime.value == "")
	{
		alert("Admission time should not be empty..");
		document.frmuserdet.admissiontime.focus();
		return false;
	}
	else if(document.frmuserdet.address.value == "")
	{
		alert("Address should not be empty..");
		document.frmuserdet.address.focus();
		return false;
	}
	else if(document.frmuserdet.select.value == "")
	{
		alert("Gender should not be empty..");
		document.frmuserdet.select.focus();
		return false;
	}
	else if(document.frmuserdet.mobilenumber.value == "")
	{
		alert("Contact number should not be empty..");
		document.frmuserdet.mobilenumber.focus();
		return false;
	}
	else if(document.frmuserdet.dateofbirth.value == "")
	{
		alert("Date Of Birth should not be empty..");
		document.frmuserdet.dateofbirth.focus();
		return false;
	}
	
	else
	{
		return true;
	}
}
</script>