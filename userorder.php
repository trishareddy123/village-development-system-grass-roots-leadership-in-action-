<?php
include("header.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
	
	$sql ="INSERT INTO `orders`( `userid`, `orderdate`,  `address`, `mobileno`)  values('$_POST[select2]','$_POST[orderdate]','$_POST[address]','$_POST[mobilenumber]')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('User order record inserted successfully...');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}

if(isset($_GET['editid']))
{
	$sql="SELECT * FROM orders WHERE orderid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>

<div class="wrapper col2">
  <div id="breadcrumb">
    <ul>
      <li class="first">Add New Order</li></ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">
    <h1>Add new Order record</h1>
      <form method="post" action="" name="frmusrorder" onSubmit="return validateform()">
    <table width="200" border="3">
      <tbody>
        <tr>
          <td width="34%">User</td>
          <td width="66%"><select name="select2" id="select2">
           <option value="">Select</option>
            <?php
		  	$sqluser= "SELECT * FROM user WHERE status='Active'";
			$qsqluser = mysqli_query($con,$sqluser);
			while($rsuser=mysqli_fetch_array($qsqluser))
			{
				if($rsuser['userid'] == $rsedit['userid'])
				{
				echo "<option value='$rsuser[userid]' selected>$rsuser[userid] - $rsuser[username]</option>";
				}
				else
				{
					echo "<option value='$rsuser[userid]'>$rsuser[userid] - $rsuser[username]</option>";
				}
				
			}
		  ?>
          </select></td>
        </tr>
        <tr>
          <td>Order Date</td>
          <td><input type="date" name="orderdate" id="orderdate" value="<?php echo $rsedit['orderdate']; ?>" /></td>
        </tr>
        <tr>
          <td>Address</td>
          <td><textarea name="address" id="address" cols="45" rows="5"><?php echo $rsedit['address']; ?></textarea></td>
        </tr>
        <tr>
          <td>Mobile Number</td>
          <td><input type="text" name="mobilenumber" id="mobilenumber" value="<?php echo $rsedit['mobileno']; ?>" /></td>
        </tr>

        <tr>
          <td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Submit" /></td>
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
	if(document.frmuserorder.select2.value == "")
	{
		alert("User name should not be empty..");
		document.frmuserorder.select2.focus();
		return false;
	}
	
	else if(document.frmuserorder.orderdate.value == "")
	{
		alert("Order date should not be empty..");
		document.frmuserorder.orderdate.focus();
		return false;
	}
	else if(document.frmuserorder.address.value == "")
	{
		alert("Address should not be empty..");
		document.frmuserorder.address.focus();
		return false;
	}
	else if(document.frmuserorder.mobilenumber.value == "")
	{
		alert("Mobile number should not be empty..");
		document.frmusrorder.mobilenumber.focus();
		return false;
	}
	else if(!document.frmuserorder.mobilenumber.value.match(numericExpression))
	{
		alert("Mobile number not valid..");
		document.frmuserorder.mobilenumber.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>