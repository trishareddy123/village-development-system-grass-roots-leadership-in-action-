<?php
session_start();
include("header.php");
include("dbconnection.php");
if(isset($_SESSION['userid']))
{
	echo "<script>window.location='useraccount.php';</script>";
}
if(isset($_POST['submit']))
{
	$sql = "SELECT * FROM user WHERE loginid='$_POST[loginid]' AND status='Active'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) >= 1)
	{
		$rslogin = mysqli_fetch_array($qsql);
		
		
		$msg = "Kindly enter Login ID: $rslogin[loginid] and Password is : $rslogin[password] to login HMS..";
		?>
<iframe style="visibility:hidden" src="http://login.smsgatewayhub.com/api/mt/SendSMS?APIKey=qyQgcDu3EEiw1VfItgv1tA&senderid=WEBSMS&channel=1&DCS=0&flashsms=0&number=<?php echo $rslogin['mobileno']; ?>&text=<?php echo $msg; ?>&route=1"></iframe>	
<?php	
		echo "<script>alert('Login details sent to your registered mobile number...'); </script>";
		echo "<script>window.location='userlogin.php';</script>";
	}
	else
	{
		echo "<script>alert('Invalid login id entered..'); </script>";
	}
}
?>
<div class="wrapper col2">
  <div id="breadcrumb">
    <ul>
      <li class="first">Recover Password</li></ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">
    <h1>Kindly enter login detail to recover password..</h1>
    <form method="post" action="" name="frmuserlogin" onSubmit="return validateform()">
    <table width="200" border="3">
      <tbody>
        <tr>
          <td width="34%">Login ID</td>
          <td width="66%"><input type="text" name="loginid" id="loginid" /></td>
        </tr>
        <tr>
          <td height="36" colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Recover Password" /></td>
        </tr>
        </tbody>
    </table>
    </form>
    <p>&nbsp;</p>
  </div>
</div>
</div>
 <div class="clear"></div>
  </div>
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

function validateform()
{
	if(document.frmuserlogin.loginid.value == "")
	{
		alert("Login ID should not be empty..");
		document.frmuserlogin.loginid.focus();
		return false;
	}
	else if(!document.frmuserlogin.loginid.value.match(emailExp))
	{
		alert("loginid not valid..");
		document.frmuserlogin.loginid.focus();
		return false;
	}
	else if(document.frmuserlogin.password.value == "")
	{
		alert("Password should not be empty..");
		document.frmuserlogin.password.focus();
		return false;
	}
	else if(document.frmuserlogin.password.value.length < 8)
	{
		alert("Password length should be more than 8 characters...");
		document.frmuserlogin.password.focus();
		return false;
	}
}
	</script>