<?php

include("adheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
	$sql = "UPDATE volunteer SET password='$_POST[newpassword]' WHERE password='$_POST[oldpassword]' AND volunteerid='$_SESSION[volunteerid]'";
	$qsql= mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Password has been updated successfully..');</script>";
	}
	else
	{
		echo "<script>alert('Failed to update password..');</script>";		
	}
}
?>

<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center"> Volunteer's Password</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <form method="post" action="" name="frmvolchangepass" onSubmit="return validateform()"
                    style="padding: 10px">
                    <div class="form-group">
                        <label>Old Password</label>
                        <div class="form-line">
                            <input class="form-control" type="password" name="oldpassword" id="oldpassword" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <div class="form-line">
                            <input class="form-control" type="password" name="newpassword" id="newpassword" />

                        </div>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <div class="form-line">
                            <input class="form-control" type="password" name="password" id="password" />
                        </div>
                    </div>

                    <input class="btn btn-raised g-bg-cyan" type="submit" name="submit" id="submit" value="Submit" />


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
function validateform1() {
    if (document.frmvolchangepass.oldpassword.value == "") {
        alert("Old password should not be empty..");
        document.frmvolchangepass.oldpassword.focus();
        return false;
    } else if (document.frmvolchangepass.newpassword.value == "") {
        alert("New Password should not be empty..");
        document.frmvolchangepass.newpassword.focus();
        return false;
    } else if (document.frmvolchangepass.newpassword.value.length < 8) {
        alert("New Password length should be more than 8 characters...");
        document.frmvolchangepass.newpassword.focus();
        return false;
    } else if (document.frmvolchangepass.newpassword.value != document.frmvolchangepass.password.value) {
        alert(" New Password and confirm password should be equal..");
        document.frmvolchangepass.password.focus();
        return false;
    } else {
        return true;
    }
}
</script>